@section('title') {{ 'Lista Chats' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <ul>
        @foreach ($chats as $chat)
            <a href="{{route('chat_privado', [$chat->pivot->id, $chat->pivot->room_id, $chat])}}"><li>{{$chat->user->name}}</li></a>
        @endforeach
    </ul>
    
</x-home-layout>