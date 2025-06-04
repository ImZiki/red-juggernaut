<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-gray-800">Sobre el desarrollador</h1>
    </x-slot>

    <div class="py-8 px-4 max-w-4xl mx-auto space-y-8">
        <section class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Hola, soy Ziki 👋</h2>
            <p class="text-gray-600 leading-relaxed">
                Soy un desarrollador web recién graduado en Desarrollo de Aplicaciones Web en Andalucía, con una pasión especial por Laravel y la migración de proyectos desde PHP plano hacia frameworks modernos.
                Me gusta aprender mientras desarrollo, siempre buscando crear aplicaciones limpias, eficientes y con interfaces intuitivas que aporten valor real.
                Destaco por mi atención al detalle, capacidad analítica y enfoque disciplinado, cualidades que aplico para entregar código mantenible y funcional.
            </p>
        </section>

        <section class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">¿Qué hago?</h2>
            <ul class="list-disc list-inside text-gray-600 space-y-2">
                <li>Trabajo con Laravel, Tailwind CSS, Blade y Alpine.js para construir aplicaciones web modernas y responsivas.</li>
                <li>Me enfoco en proyectos que incluyen integración con APIs externas y migración de datos a bases de datos relacionales.</li>
                <li>También me interesa el desarrollo backend robusto, control de errores, seguridad y buenas prácticas en el código.</li>
                <li>Me gusta incorporar pequeños detalles y easter-eggs que mejoran la experiencia del usuario.</li>
                <li>Además, procuro mantenerme actualizado con tecnologías emergentes y mejores prácticas en desarrollo web.</li>
            </ul>
        </section>

        <section class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Idiomas y comunicación</h2>
            <p class="text-gray-600 leading-relaxed">
                Tengo un nivel de inglés avanzado (C1), especialmente fuerte en comprensión lectora y vocabulario técnico, lo que me permite seguir documentación y tutoriales con facilidad.
                Continúo mejorando mi fluidez oral y escrita para comunicarme con confianza en entornos profesionales internacionales.
            </p>
        </section>

        <section class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Intereses y valores</h2>
            <p class="text-gray-600 leading-relaxed">
                Más allá de la programación, me interesa profundizar en temas complejos como la geopolítica, la justicia social y los efectos demográficos, siempre con un enfoque balanceado y respetuoso.
                Disfruto las conversaciones detalladas y matizadas que exploran distintos puntos de vista, lo que enriquece mi forma de entender el mundo y de trabajar en equipo.
                También soy un aficionado a los videojuegos, en especial los MMORPG como World Of Warcraft (¡Lok'tar ogar!).
            </p>
        </section>

        <section class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Contacto</h2>
            <p class="text-gray-600 mb-4">
                Si quieres conversar, compartir ideas o colaborar, no dudes en contactarme.
                Estoy abierto a nuevas oportunidades donde pueda aplicar mis habilidades y seguir creciendo como profesional.
            </p>

            <div class="flex space-x-6">
                <!-- GitHub -->
                <a href="https://github.com/ImZiki" target="_blank" rel="noopener noreferrer"
                   class="flex items-center space-x-2 text-gray-700 hover:text-black transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.385.6.11.82-.26.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61-.546-1.387-1.333-1.756-1.333-1.756-1.09-.745.083-.73.083-.73 1.205.085 1.84 1.237 1.84 1.237 1.07 1.834 2.807 1.304 3.492.996.108-.775.42-1.305.763-1.605-2.665-.3-5.467-1.333-5.467-5.933 0-1.31.468-2.38 1.235-3.22-.124-.302-.535-1.523.117-3.176 0 0 1.008-.322 3.3 1.23a11.49 11.49 0 013.003-.404c1.02.005 2.046.138 3.003.404 2.29-1.552 3.295-1.23 3.295-1.23.653 1.653.243 2.874.12 3.176.77.84 1.232 1.91 1.232 3.22 0 4.61-2.807 5.628-5.48 5.922.43.37.815 1.1.815 2.22 0 1.604-.015 2.896-.015 3.287 0 .32.217.694.825.576C20.565 21.796 24 17.296 24 12c0-6.63-5.37-12-12-12z"/>
                    </svg>
                    <span>GitHub</span>
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/in/daniel-rodríguez-gonzález-bb6829bb/" target="_blank" rel="noopener noreferrer"
                   class="flex items-center space-x-2 text-gray-700 hover:text-blue-700 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.98 3.5C4.98 5.16 3.63 6.5 2 6.5S-.98 5.16-.98 3.5 0 0 2 0s2.98 1.34 2.98 3.5zM.02 8.25h5.96v15.75H.02V8.25zm7.42 0h5.71v2.17h.08c.8-1.5 2.75-3.08 5.65-3.08 6.05 0 7.16 3.98 7.16 9.16v10.5h-5.97v-9.29c0-2.22-.04-5.08-3.1-5.08-3.1 0-3.57 2.42-3.57 4.91v9.46H7.44V8.25z"/>
                    </svg>
                    <span>LinkedIn</span>
                </a>
            </div>
        </section>
    </div>
</x-app-layout>
