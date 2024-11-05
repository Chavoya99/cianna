import express from 'express'
import logger from 'morgan'
import {Server} from 'socket.io'
import {createServer} from 'node:http'
import mysql from 'mysql2/promise'
import { Result } from 'postcss'

const port = 3000

//Conexion a BD
const connection = await mysql.createConnection({
    host: "localhost",
    user: "root",
    port: 3306,
    password: "",
    database: "cianna"
    });

const app = express()
const server = createServer(app)
const io = new Server(server, {
    cors: {
        origin: "*"
    },

    connectionStateRecovery:{
    }
});


io.on('connection', async (socket) => {
    console.log('A user has connected', socket.id);

    // Aquí puedes agregar más eventos para manejar mensajes, desconexión, etc.
    socket.on('disconnect', () => {
        console.log('A user has disconnected', socket.id);
    })
    
    socket.on('chat message', async (msg, username, user_id, fecha) => {
        let result;
        
        try {
            const username = socket.handshake.auth.username ?? 'anonymous'
            const fechaTimeStamp = formatoTimestamp(fecha)
            result = await connection.execute(
                'INSERT INTO mensajes (contenido, username, user_id_emisor, fecha) values (?, ?, ?, ?)',
                [msg.toString(), username.toString(), user_id, fechaTimeStamp])
        } catch (e) {
            console.error(e)
            return
        }


        fecha = formatoFecha(fecha)
        io.emit('chat message', msg, result[0].insertId.toString(), username, fecha)
    })

    if(!socket.recovered){
        try{
            const results = await connection.execute(
                'SELECT * FROM mensajes WHERE id > ?',
                [socket.handshake.auth.serverOffset ?? 0]
            )
            results[0].forEach(row => {
                let fecha = formatoFecha(row.fecha)
                socket.emit('chat message', row.contenido, row.id.toString(), row.user_id_emisor, row.username, fecha)
            })
        } catch (e){
            console.error(e)
            return 
        }
    } 
})

app.use(logger('dev'))

app.get('/', (req, res) => {
    res.sendFile('/client/chat.html', { root: '..'})
})

server.listen(port, () => {
    console.log('Server running on port', port)
})


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
