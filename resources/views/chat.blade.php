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
    const socket = io('localhost:3000')

    const form = document.getElementById('form')
    const input = document.getElementById('input')
    const messages = document.getElementById('messages')

    socket.on('chat message', (msg) =>{
        const item = `<li>${msg}</li>`
        messages.insertAdjacentHTML('beforeend', item)
    })
    
    form.addEventListener('submit', (e) => {
        e.preventDefault()
        if(input.value){
            socket.emit('chat message', input.value)
            input.value=""
        }
    })
</script>