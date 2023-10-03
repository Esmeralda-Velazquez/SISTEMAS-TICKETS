document.addEventListener('DOMContentLoaded', () => {
    const notificacionContainer = document.getElementById('notificacion-container');
    
    if ('Notification' in window) {
        Notification.requestPermission().then((permission) => {
            if (permission === 'granted') {
                console.log("Las alertas estan activadas.");
            } else if (permission === 'denied') {
                console.log("Los permisos estan denegados.");
            }
        });
    } else {
        alert('Tu navegador no admite notificaciones push.');
    }
    
});
