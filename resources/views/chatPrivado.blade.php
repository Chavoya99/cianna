@section('title') {{ 'Chat' }} @endsection

<br>
<section id="chat">
    <ul id="messages"></ul>
    <form id="form">
        <input type="text" name="message" id="input" placeholder="Type a message" autocomplete="off" />
        <button type="submit">Enviar</button>
    </form>
</section>

<script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>
<script>
    // Inicialización de socket.io
    const socket = io('http://localhost:3000', {
        auth: {
            user_id: {{ Auth::id() }},
            username: "{{ Auth::user()->name }}",
            serverOffset: 0
        }
    });

    // Variables de usuario
    const user_id = socket.auth.user_id;
    const username = socket.auth.username;
    const form = document.getElementById('form');
    const input = document.getElementById('input');
    const messages = document.getElementById('messages');

    // Unirse a la sala privada entre el usuario actual y otro usuario
    const otherUserId = {{$_GET['id']}};  // Reemplaza con el ID del otro usuario
    socket.emit('join room', { userId: user_id, otherUserId: otherUserId });

    // Escuchar mensajes privados
    socket.on('chat message', (msg, serverOffset, username, user_id, fecha) => {
        const item = `<li>
            <p>${msg}</p>
            <small>${username} ${user_id}</small>
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
            socket.emit('chat message', input.value, user_id, otherUserId, fecha);
            input.value = "";
        }
    });
</script>
