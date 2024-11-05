@section('title') {{ 'Chat' }} @endsection

<br>
<section id="chat">
    <ul id="messages"></ul>
    <form id="form">
        <input type="text" name="message" id="input" placeholder="Escribe un mensaje" autocomplete="off" />
        <button type="submit">Enviar</button>
    </form>
</section>

<script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>
<script>
    // Inicialización de socket.io
    const socket = io('http://localhost:3000', {
        auth: {
            user_id: {{ Auth::id() }},
            other_user_id: {{$otherUserId}},
            username: "{{ Auth::user()->name }}",
            serverOffset: 0,
            room_id: "{{$room_id}}",
            chat_id: "{{$chat_id}}"
        }
    });
    // Variables de usuario
    const user_id = socket.auth.user_id;
    const username = socket.auth.username;
    const room_id = socket.auth.room_id;
    const chat_id = socket.auth.chat_id;
    const form = document.getElementById('form');
    const input = document.getElementById('input');
    const messages = document.getElementById('messages');

    // Unirse a la sala privada entre el usuario actual y otro usuario
    const otherUserId = socket.auth.other_user_id;  // Reemplaza con el ID del otro usuario
    socket.emit('join room', { userId: user_id, otherUserId: otherUserId });

    // Escuchar mensajes privados
    socket.on('chat message', (msg, serverOffset, username, fecha) => {
        const item = `<li>
            <small>${username}</small><br>
            <p>${msg}</p>
            <small>${fecha}</small>
        </li>`;
        messages.insertAdjacentHTML('beforeend', item);
        socket.auth.serverOffset = serverOffset;
    });

    // Enviar un mensaje privado
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (input.value) {
            const fecha = new Date();
            socket.emit('chat message', input.value, user_id, otherUserId, room_id, chat_id, fecha);
            input.value = "";
        }
    });
</script>
