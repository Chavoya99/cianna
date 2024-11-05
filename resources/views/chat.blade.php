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
        //const socket = io('https://dbfe-2806-103e-19-196d-bdc3-c18b-a2c5-1ad1.ngrok-free.app/')
        const socket = io('localhost:3000',{
            auth:{
                user_id: {{Auth::id()}},
                username: "{{Auth::user()->name}}",
                serverOffset: 0
            }
        })
        const user_id = socket.auth.user_id
        const username = socket.auth.username
        const form = document.getElementById('form')
        const input = document.getElementById('input')
        const messages = document.getElementById('messages')

        socket.on('chat message', (msg, serverOffset, username, user_id, fecha) =>{
            const item = `<li>
            <p>${msg}</p>
            <small>${username} ${user_id}</small>
            <small>${fecha}</small></li>`
            messages.insertAdjacentHTML('beforeend', item)
            socket.auth.serverOffset = serverOffset
        })
        
        form.addEventListener('submit', (e) => {
            e.preventDefault()
            if(input.value){
                const fecha = new Date(); 
                socket.emit('chat message', input.value, username, user_id, fecha)
                input.value=""
            }
        })
    </script>