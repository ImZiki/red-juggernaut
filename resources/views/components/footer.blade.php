<footer class="bg-black text-gray-400 text-sm py-8">
    <div class="max-w-6xl mx-auto px-6 md:flex md:justify-between">
        <!-- LOGO Y COPYRIGHT -->
        <div class="mb-6 md:mb-0">
            <a href="{{ url('/') }}" class="text-white text-lg font-semibold">Red Juggernaut</a>
            <p class="mt-2"><a href="{{url('/about-me')}}">&copy;</a> <span x-data="{ year: new Date().getFullYear() }" x-text="year"></span> Todos los derechos reservados.</p>
        </div>


        <!-- REDES SOCIALES -->
        <div class="mb-6 md:mb-0">
            <h3 class="text-white font-semibold mb-2">Encuentranos en</h3>
            <ul>
                <li>
                    <a href="https://facebook.com" target="_blank" class="hover:text-white">
                        <i class="fab fa-facebook"></i> Facebook
                    </a>
                </li>
                <li><a href="https://twitter.com" target="_blank" class="hover:text-white">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>

                </li>
                <li>
                    <a href="https://instagram.com" target="_blank" class="hover:text-white">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                </li>
                <li>
                    <a href="https://youtube.com" target="_blank" class="hover:text-white">
                        <i class="fab fa-youtube"></i> YouTube
                    </a>
                </li>
            </ul>
        </div>

        <!-- KIT DE PRENSA -->
        <div>
            <h3 class="text-white font-semibold mb-2">Kit de Prensa</h3>
            <a href="{{  url('/easter-egg-teapot') }}" class="hover:text-white flex items-center">
                <i class="fas fa-file-pdf mr-2"></i> Descargar PDF
            </a>
        </div>
    </div>
</footer>

<!-- FontAwesome para íconos (asegúrate de incluirlo en tu proyecto) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
