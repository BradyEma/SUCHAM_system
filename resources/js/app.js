import './bootstrap';
import Alpine from 'alpinejs';
import Echo from 'laravel-echo';

window.Alpine = Alpine;
Alpine.start();

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

// Define the marker update function
function updateMarkerPosition(id, lat, lng) {
    console.log(`Updating marker ${id} to (${lat}, ${lng})`);
    // Your map logic here (e.g., update Leaflet/Google Maps marker)
}

// Loop through logistics data and subscribe to channels
window.logisticsData.forEach(logistic => {
    window.Echo.channel(`logistics.${logistic.id}`)
        .listen('LogisticsUpdated', (e) => {
            updateMarkerPosition(logistic.id, e.logistic.latitude, e.logistic.longitude);
        });
});