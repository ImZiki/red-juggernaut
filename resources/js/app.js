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

    // Obtener datos con seguridad
    const usersChartEl = document.getElementById('users-chart');
    const ordersChartEl = document.getElementById('orders-chart');

    const usersData = usersChartEl?.dataset?.users ? JSON.parse(usersChartEl.dataset.users) : null;
    const ordersData = ordersChartEl?.dataset?.orders ? JSON.parse(ordersChartEl.dataset.orders) : null;

    // Renderizar sólo si hay datos
    if (usersData) {
        renderChart("#users-chart", "line", "Usuarios en los Últimos 30 Días", usersData);
    }
    if (ordersData) {
        renderChart("#orders-chart", "bar", "Pedidos en los Últimos 30 Días", ordersData);
    }
});


//Creacion de productos:
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('images');
    if (!input) return; // Si no hay input, no hacer nada

    const preview = document.getElementById('image-preview');
    let filesArray = [];

    function renderPreview() {
        preview.innerHTML = '';

        filesArray.forEach((file, index) => {
            const fileReader = new FileReader();

            const container = document.createElement('div');
            container.classList.add('relative', 'inline-block');

            fileReader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('h-24', 'w-auto', 'rounded', 'shadow', 'border');
                container.appendChild(img);
            };

            fileReader.readAsDataURL(file);

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.innerHTML = '✕';
            btn.title = 'Eliminar imagen';
            btn.classList.add(
                'absolute', 'top-0', 'right-0', 'bg-red-600', 'text-white',
                'rounded-full', 'w-6', 'h-6', 'flex', 'items-center', 'justify-center',
                'hover:bg-red-700', 'cursor-pointer', 'select-none'
            );

            btn.addEventListener('click', () => {
                filesArray.splice(index, 1);
                updateInputFiles();
                renderPreview();
            });

            container.appendChild(btn);
            preview.appendChild(container);
        });
    }

    function updateInputFiles() {
        const dataTransfer = new DataTransfer();

        filesArray.forEach(file => {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    }

    input.addEventListener('change', (event) => {
        const selectedFiles = Array.from(event.target.files);

        for (const file of selectedFiles) {
            if (file.size > 104857600) { // 100MB
                alert(`La imagen "${file.name}" supera los 100MB y no será añadida.`);
                continue;
            }

            if (!filesArray.some(f => f.name === file.name && f.size === file.size)) {
                filesArray.push(file);
            }
        }

        updateInputFiles();
        renderPreview();
    });
});



window.stripeCheckout = stripeCheckout;
window.ApexCharts = ApexCharts;
window.Alpine = Alpine;
Alpine.start();
