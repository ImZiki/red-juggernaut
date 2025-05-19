import './bootstrap';
import Alpine from 'alpinejs';
import '@justinribeiro/lite-youtube';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';
import ApexCharts from 'apexcharts';

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


function stripeCheckout() {
    return {
        stripe: null,
        elements: null,
        card: null,
        paymentMethod: '',
        loading: false,
        errorMessages: {
            'Your card number is incorrect.': 'El número de tarjeta es incorrecto.',
            'Your card has expired.': 'La tarjeta ha expirado.',
            'Your card was declined.': 'La tarjeta fue rechazada.',
            'Your card does not support this type of purchase.': 'La tarjeta no soporta este tipo de compra.',
            'Your card does not have sufficient funds.': 'La tarjeta no tiene fondos suficientes.',
            'Your card has been reported lost.': 'La tarjeta ha sido reportada como perdida.',
            'Your card has been reported stolen.': 'La tarjeta ha sido reportada como robada.',
            'Your card\'s security code is incorrect.': 'El código de seguridad de la tarjeta es incorrecto.',
            'Your card number is invalid.': 'El número de tarjeta es inválido.',
            'This card number is not supported.': 'Este número de tarjeta no es soportado.',
            'The card has expired.': 'La tarjeta ha expirado.',
            'Processing error.': 'Error de procesamiento.',
            'Your card was declined. This transaction requires authentication.': 'La tarjeta fue rechazada. Esta transacción requiere autenticación.',
            'Incorrect CVC.': 'Código de seguridad incorrecto.',
            'Incorrect zip code.': 'Código postal incorrecto.',
            'Amount is too large to process.': 'El monto es demasiado grande para procesar.',
            'Amount is too small to process.': 'El monto es demasiado pequeño para procesar.',
            'Card declined.': 'Tarjeta rechazada.',
        },

        initStripe() {
            this.stripe = Stripe(window.STRIPE_KEY)
            const elements = this.stripe.elements({ locale: 'es' }); // UI en español

            this.card = elements.create('card');
            this.card.mount('#card-element');

            this.card.on('change', (event) => {
                if (event.error) {
                    const mensajeUsuario = this.errorMessages[event.error.message] || 'Error en el campo de tarjeta.';
                    alert(mensajeUsuario);
                }
            });

            const form = document.getElementById('payment-form');
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                this.loading = true;

                try {
                    const { paymentMethod, error } = await this.stripe.createPaymentMethod({
                        type: 'card',
                        card: this.card,
                    });

                    if (error) {

                        const mensajeUsuario = this.errorMessages[error.message] || 'Ha ocurrido un error al procesar el pago.';
                        alert(mensajeUsuario);
                        this.loading = false;
                        return;
                    }

                    this.paymentMethod = paymentMethod.id;
                    this.$refs.paymentMethod.value = paymentMethod.id;

                    if (!this.paymentMethod) {
                        alert('Error: No se pudo obtener el método de pago.');
                        this.loading = false;
                        return;
                    }

                    form.submit();
                } catch (err) {
                    alert('Error al procesar el pago.');
                    this.loading = false;
                }
            });
        }
    }
}

//Graficos con ApexCharts
document.addEventListener('DOMContentLoaded', function () {
    // Función para generar un gráfico
    function renderChart(chartId, chartType, chartTitle, data) {
        const options = {
            chart: {
                type: chartType,
                height: 350
            },
            series: [{
                name: chartTitle,
                data: data
            }],
            xaxis: {
                type: 'datetime',
                labels: {
                    format: 'dd MMM'
                }
            },
            title: {
                text: chartTitle,
                align: 'center'
            }
        };

        const chart = new ApexCharts(document.querySelector(chartId), options);
        chart.render();
    }

    // Obtener los datos de los gráficos desde los atributos data-* en el HTML
    const usersData = JSON.parse(document.getElementById('users-chart').dataset.users);
    const ordersData = JSON.parse(document.getElementById('orders-chart').dataset.orders);

    // Renderizar los gráficos
    renderChart("#users-chart", "line", "Usuarios en los Últimos 30 Días", usersData);
    renderChart("#orders-chart", "bar", "Pedidos en los Últimos 30 Días", ordersData);
});


// Regístralo globalmente para Alpine.js si usas Alpine 3
window.stripeCheckout = stripeCheckout;
window.ApexCharts = ApexCharts;
window.Alpine = Alpine;
Alpine.start();
