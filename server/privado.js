import express from 'express';
import logger from 'morgan';
import { Server } from 'socket.io';
import { createServer } from 'node:http';
import mysql from 'mysql2/promise';

const port = 3000;

// Conexión a la base de datos
const connection = await mysql.createConnection({
    host: "localhost",
    user: "root",
    port: 3306,
    password: "",
    database: "cianna"
});

const app = express();
const server = createServer(app);
const io = new Server(server, {
    cors: {
        origin: "*"
    },
    connectionStateRecovery: {}
});

// Función para crear una sala única para cada par de usuarios
function createRoomId(user1, user2) {
    return [user1, user2].sort().join('_');
}

io.on('connection', async (socket) => {
    console.log('A user has connected', socket.id);

    socket.on('disconnect', () => {
        console.log('A user has disconnected', socket.id);
    });

    // Evento para unirse a una sala específica para una conversación privada
    socket.on('join room', async ({ userId, otherUserId }) => {
        const roomId = createRoomId(userId, otherUserId);
        socket.join(roomId); // Une al usuario a la sala
        console.log(`User ${userId} joined room ${roomId}`);

        try {
            // Realiza la consulta para obtener el nombre de 'otherUserId'
            const [rows] = await connection.execute(
                'SELECT name, apellido FROM users WHERE id = ?', [otherUserId]
            );
    
            if (rows.length > 0) {
                const otherUserName = rows[0].name;
                const otherUserApellido = rows[0].apellido;
                //console.log(`El nombre de otherUserId (${otherUserId}) es ${otherUserName} ${otherUserApellido}`);
    
                // Puedes enviar el nombre al cliente si es necesario
                socket.emit('other_user_name', { otherUserId, otherUserName, otherUserApellido });
            } else {
                console.log(`No se encontró un usuario con ID: ${otherUserId}`);
            }
        } catch (e) {
            console.error('Error al obtener el nombre del usuario:', e);
        }

        
        try {
            // Realiza la consulta para obtener la imagen de 'otherUserId'
            const [rows] = await connection.execute(
                `SELECT ruta_archivo FROM archivos WHERE archivo_type = 'img_perf' AND user_id = ?`,
                [otherUserId]
            );
        
            if (rows.length > 0) {
                const otherUserProfImg = rows[0].ruta_archivo;
                //console.log(`La ruta de (${otherUserId}) es ${otherUserProfImg}`);
                //console.log(socket);
                // Envía la ruta de la imagen al cliente
                socket.emit('other_user_prof_img', { otherUserProfImg });
            } else {
                console.log(`No se encontró un usuario con ID: ${otherUserId}`);
            }
        } catch (e) {
            console.error('Error al obtener la ruta de la imagen del usuario:', e);
        }
        //const otherUserProfImg = socket.handshake.auth.otherUserProfImg;

        // Recupera mensajes anteriores solo para la sala privada
        if (!socket.recovered) {
            try {
                const results = await connection.execute(
                    'SELECT * FROM mensajes WHERE room_id = ? && id > ?',
                    [roomId, socket.handshake.auth.serverOffset ?? 0]
                );

                results[0].forEach(row => {
                    const fecha = formatoFecha(row.fecha_hora);
                    socket.emit('chat message', row.contenido, row.id.toString(), row.username, fecha);
                });
                
            } catch (e) {
                console.error(e);
                return;
            }
        }
    });
    
    // Evento para enviar mensaje privado a otro usuario
    socket.on('chat message', async (msg, userId, otherUserId, room_id, chat_id, fecha) => {
        const roomId = room_id//createRoomId(userId, otherUserId);
        const username = socket.handshake.auth.username ?? 'anonymous';
        const fechaTimeStamp = formatoTimestamp(fecha);
        const chatId = chat_id;

        let result;
        try {
            result = await connection.execute(
                'INSERT INTO mensajes (room_id, chat_id, contenido, username, user_id_emisor, user_id_receptor, fecha_hora) VALUES (?, ?, ?, ?, ?, ?, ?)',
                [roomId, chatId, msg.toString(), username.toString(), userId, otherUserId, fechaTimeStamp]
            );

            let update = connection.execute("Update chats set fecha_ultimo_mensaje = ? where room_id = ? ", [fechaTimeStamp, roomId]);
        } catch (e) {
            console.error(e);
            return;
        }

        fecha = formatoFecha(fecha);

        // Emite el mensaje solo a la sala privada
        io.to(roomId).emit('chat message', msg, result[0].insertId.toString(), username, fecha);
    });

    
});

app.use(logger('dev'));

app.get('/', (req, res) => {
    res.sendFile('/client/chat.html', { root: '..' });
});

server.listen(port, () => {
    console.log('Server running on port', port);
});

function formatoFecha(fecha){
    const nuevaFecha = new Date(fecha)
    
    const formatoFecha = nuevaFecha.toLocaleDateString('es-ES', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    });
    const formatoHora = nuevaFecha.toLocaleTimeString('es-ES', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });

    const fechaCompleta = `${formatoFecha} ${formatoHora}`;


    return fechaCompleta
}

function formatoTimestamp(fecha) {
    // Verifica si 'fecha' es un objeto de tipo Date; si no, intenta convertirlo
    if (!(fecha instanceof Date)) {
        fecha = new Date(fecha); // Convierte el string o valor recibido a Date
    }

    // Asegúrate de que la conversión fue exitosa
    if (isNaN(fecha)) {
        throw new Error("Fecha inválida");
    }

    const year = fecha.getFullYear();
    const month = String(fecha.getMonth() + 1).padStart(2, '0');
    const day = String(fecha.getDate()).padStart(2, '0');
    const hours = String(fecha.getHours()).padStart(2, '0');
    const minutes = String(fecha.getMinutes()).padStart(2, '0');
    const seconds = String(fecha.getSeconds()).padStart(2, '0');

    const timestamp = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    return timestamp;
}