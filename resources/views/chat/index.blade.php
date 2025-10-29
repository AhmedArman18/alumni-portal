@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row shadow rounded" style="height: 80vh; background: #f8f9fa;">
        <!-- Sidebar -->
        <div class="col-md-3 bg-white border-end p-0 overflow-auto" style="height: 100%;">
            <div class="p-3 border-bottom bg-light">
                <h5 class="mb-0">Users</h5>
            </div>
            @foreach($users as $u)
            <div class="d-flex align-items-center p-2 user-item" onclick="openChat({{ $u->id }}, '{{ $u->name }}')">
                <div class="avatar rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-2" style="width:40px; height:40px;">
                    {{ strtoupper(substr($u->name,0,1)) }}
                </div>
                <span>{{ $u->name }}</span>
            </div>
            @endforeach
        </div>

        <!-- Chat Area -->
        <div class="col-md-9 d-flex flex-column p-0" style="height: 100%;">
            <div class="p-3 border-bottom bg-white">
                <h5 id="chatWith" class="mb-0">Select a user to chat</h5>
            </div>
            <div id="messages" class="flex-grow-1 p-3 overflow-auto" style="background:#e9ecef;"></div>
            <div class="p-3 border-top bg-white d-flex">
                <input type="text" id="msg" class="form-control me-2" placeholder="Type a message...">
                <button class="btn btn-primary" onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.user-item:hover {
    background-color: #f1f3f5;
    cursor: pointer;
}
.message {
    max-width: 70%;
    padding: 8px 12px;
    border-radius: 15px;
    margin-bottom: 8px;
}
.sent {
    background-color: #0d6efd;
    color: white;
    margin-left: auto;
}
.received {
    background-color: #ffffff;
    border: 1px solid #ced4da;
    margin-right: auto;
}
#messages {
    display: flex;
    flex-direction: column;
}
</style>
@endpush

@push('scripts')
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="{{ mix('js/app.js') }}"></script> <!-- app.js must import Echo -->

<script>
let activeUser = null;

function openChat(id, name) {
    activeUser = id;
    document.getElementById('chatWith').innerText = "Chat with " + name;
    fetch(`/chat/${id}/messages`).then(r => r.json()).then(data => {
        const box = document.getElementById('messages');
        box.innerHTML = '';
        data.forEach(m => {
            const div = document.createElement('div');
            div.classList.add('message', m.from_id === {{ Auth::id() }} ? 'sent' : 'received');
            div.innerText = m.body;
            box.appendChild(div);
        });
        box.scrollTop = box.scrollHeight;
    });
}

function sendMessage() {
    const msgInput = document.getElementById('msg');
    const msg = msgInput.value.trim();
    if(!activeUser || !msg) return;

    // Add the message to the chat box immediately
    const box = document.getElementById('messages');
    const div = document.createElement('div');
    div.classList.add('message', 'sent');
    div.innerText = msg;
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;

    // Clear input
    msgInput.value = '';

    // Send to server
    fetch('/chat/send', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({to_id: activeUser, body: msg})
    });
}

// Real-time messages
document.addEventListener('DOMContentLoaded', () => {

        window.Echo.private('chat.{{ Auth::id() }}')
            .listen('MessageSent', (e) => {
                const box = document.getElementById('messages');
                const div = document.createElement('div');
                div.classList.add('message', e.message.from_id === {{ Auth::id() }} ? 'sent' : 'received');
                div.innerText = e.message.body;
                box.appendChild(div);
                box.scrollTop = box.scrollHeight;
            });
  
});

</script>
@endpush
