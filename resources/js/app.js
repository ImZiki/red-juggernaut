import './bootstrap';
import Alpine from 'alpinejs';
import '@justinribeiro/lite-youtube';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';

//Calendario
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

//Pagos con Stripe
// const paymentIntentUrl = document.querySelector('meta[name="payment-intent-url"]').content;
//
// Alpine.data('payment', () => ({
//     amount: 0,
//     showPaymentForm: false,
//     stripe: null,
//     card: null,
//     clientSecret: null,
//     message: '',
//
//     async initPayment() {
//         if (this.amount <= 0) {
//             this.message = 'Por favor, ingresa un monto válido.';
//             return;
//         }
//
//         try {
//             const response = await fetch(paymentIntentUrl, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
//                 },
//                 body: JSON.stringify({ amount: this.amount })
//             });
//
//             if (!response.ok) {
//                 throw new Error(`Error en la respuesta: ${response.statusText}`);
//             }
//
//             const data = await response.json();
//             this.clientSecret = data.clientSecret;
//
//             // Inicializa Stripe solo una vez
//             if (!this.stripe) {
//                 this.stripe = Stripe(document.querySelector('meta[name="stripe-key"]').content);
//             }
//
//             const elements = this.stripe.elements();
//
//             // Desmontar el elemento de la tarjeta si ya existe
//             if (this.card) {
//                 this.card.destroy();
//             }
//
//             this.card = elements.create('card');
//             this.card.mount('#card-element');
//
//             this.showPaymentForm = true;
//             this.message = '';
//         } catch (error) {
//             console.error('Error al iniciar el pago:', error);
//             this.message = 'Error al iniciar el pago: ' + error.message;
//         }
//     },
//
//     async confirmPayment() {
//         try {
//             const { paymentIntent, error } = await this.stripe.confirmCardPayment(this.clientSecret, {
//                 payment_method: {
//                     card: this.card,
//                     billing_details: { name: 'Cliente' },
//                 },
//             });
//
//             if (error) {
//                 this.message = 'Error en el pago: ' + error.message;
//             } else if (paymentIntent.status === 'succeeded') {
//                 this.message = 'Pago exitoso.';
//                 this.showPaymentForm = false;
//             } else {
//                 this.message = 'Estado del pago: ' + paymentIntent.status;
//             }
//         } catch (error) {
//             console.error('Error en la confirmación del pago:', error);
//             this.message = 'Error en la confirmación del pago: ' + error.message;
//         }
//     }
// }));

window.Alpine = Alpine;
Alpine.start();
