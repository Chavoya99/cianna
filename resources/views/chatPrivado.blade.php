@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
@section('title') {{ 'Chat privado' }} @endsection

<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <div class="w-full h-full flex justify-center">
            <div class="w-1/3 mx-2">
                <!-- CONTENEDOR NOMBRE ROOMIE -->
                <div id="chatting-with" class="flex pt-4 text-3xl font-bold justify-center"></div>
                <!-- CONTENEDOR FOTO ROOMIE -->
                <div class="flex mt-10 items-center justify-center">
                    <img id="roomie-prof-img-1" src="" alt="Imagen de perfil del usuario" 
                    class="w-64 h-64 rounded-full object-cover">
                </div>
                <!-- CONTENEDOR LINK AL PERFIL -->
                <div class="px-16 mt-8 flex justify-center items-center">
                    <a id="profile-link" href="">
                        <div class="text-lg px-8 py-4 bg-cianna-blue text-white font-bold mr-4 
                            rounded hover:bg-cianna-blue transition-transform transform 
                            hover:bg-sky-900 hover:scale-110">
                            <i class="fa-solid fa-address-card mr-1"></i>
                            VER PERFIL
                        </div>
                    </a>
                </div>
                <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
                <div class="absolute bottom-4 px-8">
                    <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                        rounded focus:outline-none focus:shadow-outline" 
                        onclick="window.history.back()">
                        <i class="fa-solid fa-left-long mr-2"></i>Regresar
                    </button>
                </div>
            </div>
            <div class="w-2/3 p-4 bg-gray-200">
                <ul id="messages" class="space-y-2 px-8 py-2 mb-4 h-[38rem] rounded-lg 
                    overflow-y-auto bg-gray-100">
                    <!-- Aquí se agregarán los mensajes dinámicamente -->
                </ul>
                <div>
                    <form id="form_msg" class="flex items-center space-x-2">
                        <textarea 
                            name="message" 
                            id="input" 
                            placeholder="Escribe un mensaje"
                            autocomplete="off"
                            rows="1"
                            class="flex-1 px-4 py-2 border rounded-md focus:outline-none 
                                focus:ring-2 focus:ring-cianna-orange focus:border-cianna-orange 
                                resize-none overflow-y-auto"
                            style="max-height: calc(1.5em * 3); line-height: 1.5;"
                            oninput="adjustHeight(this)"
                            onkeydown="handleEnter(event)"
                        ></textarea>
                        <button 
                            type="submit"
                            class="px-8 py-2 text-white bg-cianna-blue rounded-md hover:bg-sky-900
                                focus:outline-none focus:ring-2 focus:ring-sky-900"
                        >
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        
    </div>
</x-home-layout>

<script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>
<script>

    const chat_url = "{{env('CHAT_SERVER_URL')}}";
    // Inicialización de socket.io
    const socket = io(chat_url, {
        auth: {
            user_id: {{ Auth::id() }},
            other_user_id: {{$otherUserId}},
            username: "{{ Auth::user()->name.Auth::id() }}",
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
    const form_msg = document.getElementById('form_msg');
    const input = document.getElementById('input');
    const messages = document.getElementById('messages');

    // Función para enviar mensaje
    function sendMessage() {
        if (input.value.trim()) {
            const fecha = new Date();
            socket.emit('chat message', input.value.trim(), user_id, socket.auth.other_user_id,
            room_id, chat_id, fecha);
            
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

    // Ajustar la altura dinámica del textarea y del contenedor
    function adjustHeight(element) {
        // Restablece la altura al mínimo para recalcularla
        element.style.height = 'auto';

        // Calcula el nuevo tamaño basado en el contenido
        const scrollHeight = element.scrollHeight;

        // Establece el límite máximo (3 líneas)
        const maxHeight = parseFloat(getComputedStyle(element).lineHeight) * 3;

        // Aplica la nueva altura o activa el scroll si se supera el máximo
        if (scrollHeight > maxHeight) {
            element.style.height = `${maxHeight}px`;
            element.style.overflowY = 'auto';
        } else {
            element.style.height = `${scrollHeight}px`;
            element.style.overflowY = 'hidden';
        }
    }

    // Enviar mensaje con el formulario
    form_msg.addEventListener('submit', (e) => {
        e.preventDefault();
        sendMessage();
    });

    // Unirse a la sala privada entre el usuario actual y otro usuario
    const otherUserId = socket.auth.other_user_id;  // Reemplaza con el ID del otro usuario
    socket.emit('join room', { userId: user_id, otherUserId: otherUserId });

    // Variables
    let lastDate = null;  // Variable para almacenar la última fecha mostrada
    let profileImage = '';
    

    // Escuchar mensajes privados
    socket.on('chat message', (msg, serverOffset, username, fecha) => {
        // Verificar si el mensaje es del usuario actual o de otro usuario
        const isOwnMessage = username === socket.auth.username;
        //console.log(profileImage);
        //console.log('Username:', socket.auth.username);
        //const otherUserProfImg = socket.auth.otherUserProfImg;
        //console.log('Imagen del perfil:', socket.auth.otherUserProfImg);
        
        // Clases para las burbujas
        const bubbleClass = isOwnMessage 
            ? 'bg-cianna-orange text-white self-end rounded-br-none' 
            : 'bg-white text-black self-start rounded-bl-none';
        const alignmentClass = isOwnMessage ? 'flex-row-reverse' : 'flex-row';
        const marginClass = isOwnMessage ? 'ml-auto' : 'mr-auto';

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

        userMessageName = isOwnMessage ? "Tú" : username;

        // Crear el mensaje
        const item = `
            ${dateElement}
            <li class="flex items-end space-x-3 ${alignmentClass} ${marginClass}">
                ${!isOwnMessage ? `<img src="${profileImage}" alt="Imagen de perfil del usuario" 
                class="w-10 h-10 rounded-full object-cover">` : ''}
                <div class="p-3 max-w-xs md:max-w-md text-sm shadow-md ${bubbleClass} rounded-2xl">
                    <p class="break-words">${msg}</p>
                    <small class="block mt-1 text-right opacity-75">${formatTime(fecha)}</small>
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
            const formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]} ${timeParts[0]}:${timeParts[1]}:${timeParts[2]}`;
            
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
    form_msg.addEventListener('submit', (e) => {
        e.preventDefault();
        if (input.value) {
            const fecha = new Date();
            socket.emit('chat message', input.value, user_id, otherUserId, room_id, chat_id, fecha);
            
            // Desplazar automáticamente al último mensaje
            messages.scrollTop = messages.scrollHeight;

            input.value = "";
        }
    });

    //Asigna las varibles del otro usuario desde el servidor
    socket.on('other_user_name', ({ otherUserId, otherUserName, otherUserApellido }) => {
        //console.log('Datos recibidos del servidor:', { otherUserId, otherUserName });
        //const userDisplay = document.getElementById('userDisplay');
        const chattingWith = document.getElementById('chatting-with');
        const profileLink = document.getElementById('profile-link');
        //userDisplay.innerHTML = `ID del otro usuario: ${otherUserId}, Nombre: ${otherUserName}`;
        chattingWith.innerHTML = `${otherUserName} ${otherUserApellido}`;
        profileLink.href = `/ver_detalles_roomie/${otherUserId}`;
    });

    socket.on('other_user_prof_img', ({ otherUserProfImg }) => {
        const roomieProfImg1 = document.getElementById('roomie-prof-img-1');
        profileImage = `/storage/${otherUserProfImg}`;  // Asignar el valor a la variable global
        //const roomieProfImg2 = document.getElementById('roomie-prof-img-2');
        //console.log('Imagen del perfil del otro usuario:', otherUserProfImg);
        roomieProfImg1.src = `/storage/${otherUserProfImg}`;
        //roomieProfImg2.src = `/storage/${otherUserProfImg}`;
    });

</script>
