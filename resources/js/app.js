import './bootstrap';
import Alpine from 'alpinejs';
import '@justinribeiro/lite-youtube';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es'; // Importa el idioma español


document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            locale: esLocale,
            events: `http://localhost:8000/api/concerts`,  // URL de la API para cargar conciertos
            eventClick: function (info) {
                if (info.event.url) {
                    window.open(info.event.url, '_blank');
                }
                info.jsEvent.preventDefault();
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día'
            },
            eventTimeFormat: { // Formato de la hora del evento
                hour: '2-digit',
                minute: '2-digit',
                hour12: false // Usa formato de 24 horas
            },
            eventContent: function(info) {
                // Obtenemos la hora del evento, el título y la localización
                const eventTitle = info.event.title;
                const eventTime = info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                const eventLocation = info.event.extendedProps.location || 'Ubicación no disponible'; // Asegúrate de tener el campo 'location' en tus datos

                // Retornamos HTML con la hora, el título y la localización
                return {
                    html: `<div><strong>${eventTime}</strong><br><strong>${eventTitle}</strong><br><em>${eventLocation}</em></div>`
                };
            }
        });
        calendar.render();
    }
});

window.Alpine = Alpine;
Alpine.start();
