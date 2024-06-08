import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':8080' // Cambia el puerto si es diferente
});

window.Echo.channel('messages')
    .listen('MessageSent', (e) => {
        console.log(e);
    });

