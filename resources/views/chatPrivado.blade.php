@section('title') {{ 'Chat' }} @endsection

<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <div class="w-full h-full">
        <section id="chat" class="flex flex-col items-center py-4 h-full">
            <div class="w-full max-w-md p-4 bg-white shadow-md rounded-lg bg-blue-300">
                <ul id="messages" class="space-y-2 px-8 py-2 mb-4 h-[36rem] overflow-y-auto bg-red-200">
                    <!-- Aquí se agregarán los mensajes dinámicamente -->
                </ul>
                <form id="form" class="flex items-center space-x-2">
                    <textarea 
                        name="message" 
                        id="input" 
                        placeholder="Escribe un mensaje"
                        autocomplete="off"
                        rows="1"
                        class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none overflow-hidden"
                        oninput="adjustHeight(this)"
                        onkeydown="handleEnter(event)"
                    ></textarea>
                    <button 
                        type="submit"
                        class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        Enviar
                    </button>
                </form>
            </div>
        </section>
    </div>
</x-home-layout>

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

    // Función para enviar mensaje
    function sendMessage() {
        if (input.value.trim()) {
            const fecha = new Date();
            socket.emit('chat message', input.value.trim(), user_id, socket.auth.other_user_id, room_id, chat_id, fecha);
            
            // Limpiar el campo y ajustar su altura
            input.value = '';
            adjustHeight(input);
        }
    }

    // Función para manejar Enter
    function handleEnter(event) {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault(); // Evita el salto de línea
            sendMessage(); // Envía el mensaje
        }
    }

    // Ajustar la altura dinámica del textarea
    function adjustHeight(element) {
        element.style.height = 'auto'; // Resetea la altura
        element.style.height = `${element.scrollHeight}px`; // Ajusta según el contenido
    }

    // Enviar mensaje con el formulario
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        sendMessage();
    });

    // Unirse a la sala privada entre el usuario actual y otro usuario
    const otherUserId = socket.auth.other_user_id;  // Reemplaza con el ID del otro usuario
    socket.emit('join room', { userId: user_id, otherUserId: otherUserId });

    // Variables
    let lastDate = null;  // Variable para almacenar la última fecha mostrada

    // Escuchar mensajes privados
    socket.on('chat message', (msg, serverOffset, username, fecha) => {
        // Verificar si el mensaje es del usuario actual o de otro usuario
        const isOwnMessage = username === socket.auth.username;
        
        // Crear el HTML del mensaje con la alineación correcta
        const messageClass = isOwnMessage ? 'text-right bg-blue-200 ml-8' : 'text-left bg-gray-200 mr-8';
        
        // Formatear la fecha
        const messageDate = formatDate(fecha);
        
        // Si la fecha es diferente a la última, mostrar la fecha antes del primer mensaje
        let dateElement = '';
        if (lastDate !== messageDate) {
            dateElement = `
                <li class="w-full text-center p-2 text-sm text-gray-500">
                    ${messageDate}
                </li>
            `;
            lastDate = messageDate;  // Actualizar la última fecha
        }

        // Crear el mensaje
        const item = `
            ${dateElement}
            <li class="p-2 px-4 rounded-lg ${messageClass}">
                <div class="bg-white flex flex-col justify-${isOwnMessage ? 'end' : 'start'}">
                    <p><strong>${username}</strong></p>
                    <p class="break-words overflow-wrap-break-word">${msg}</p>
                    <small>${formatTime(fecha)}</small>
                </div>
            </li>
        `;
        
        // Insertar el mensaje
        messages.insertAdjacentHTML('beforeend', item);
        
        // Desplazar automáticamente al último mensaje
        messages.scrollTop = messages.scrollHeight;

        // Función para formatear la fecha a 'YYYY-MM-DD'
        function formatDate(fecha) {
            const parts = fecha.split(' ');
            const dateParts = parts[0].split('/');
            return `${dateParts[0]}/${dateParts[1]}/${dateParts[2]}`;  // Formato DD/MM/YYYY
        }

        // Función para formatear la hora a 'HH:MM AM/PM'
        function formatTime(fecha) {
            // Convertir el formato 'DD/MM/YYYY HH:MM:SS' a 'YYYY-MM-DDTHH:MM:SS'
            const parts = fecha.split(' ');
            const dateParts = parts[0].split('/');
            const timeParts = parts[1].split(':');
            
            // Crear una nueva fecha en formato 'YYYY-MM-DDTHH:MM:SS'
            const formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}T${timeParts[0]}:${timeParts[1]}:${timeParts[2]}`;
            
            const date = new Date(formattedDate);
            
            if (isNaN(date)) {
                console.error('Fecha inválida:', fecha);
                return ''; // Si la fecha no es válida, retorna una cadena vacía o el valor predeterminado
            }
            
            // Retornar la hora en formato de 12 horas con AM/PM
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });
        }
    });

    // Enviar un mensaje privado
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (input.value) {
            const fecha = new Date();
            socket.emit('chat message', input.value, user_id, otherUserId, room_id, chat_id, fecha);
            
            // Desplazar automáticamente al último mensaje
            messages.scrollTop = messages.scrollHeight;

            input.value = "";
        }
    });
</script>
