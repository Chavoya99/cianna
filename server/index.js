import express from 'express'
import logger from 'morgan'
import {Server} from 'socket.io'
import {createServer} from 'node:http'

const port = 3000

const app = express()
const server = createServer(app)
const io = new Server(server, {
    cors: {
        origin: "*"
    }
});


io.on('connection', (socket) => {
    console.log('A user has connected', socket.id);

    // Aquí puedes agregar más eventos para manejar mensajes, desconexión, etc.
    socket.on('disconnect', () => {
        console.log('A user has disconnected', socket.id);
    })

    socket.on('chat message', (msg) => {
        io.emit('chat message', msg)
    })
})

app.use(logger('dev'))

app.get('/', (req, res) => {
    res.send('<h1>Esto es el chat</h1>')
})

server.listen(port, () => {
    console.log('Server running on port', port)
})
