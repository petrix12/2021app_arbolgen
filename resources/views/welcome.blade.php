<x-app-layout>
    <section class="bg-cover" style="background-image: url({{ asset('assets/images/home/img_portada.jpg') }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
            <div class="w-full md:w-3/4 lg:w-1/2">
                <h1 class="text-white font-bold text-4xl">{{ GetApellidoPrincipal() }}</h1>
                <p class="text-gray-300 mt-4"><strong>Desarrollado por Soluciones++</strong></p>
                <p class="text-gray-300" >en donde un clic menos (-) importa!!!</p>
            </div>
        </div>
    </section>
    <section class="mt-24">
        <h1 class="text-gray-600 text-center text-3xl mb-6">Inmortalicemos nuestra estirpe</h1>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('assets/images/home/imagen_1.jpg') }}" alt="">
                </figure>
                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Recaudemos imágenes</h1>
                </header>
                <p class="text-sm text-gray-500">
                    Eternicemos nuestros más bellos recuerdos, guardando nuestras fotos y videos más 
                    significativos en nuestra aplicación web.
                </p>
            </article>
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('assets/images/home/imagen_2.jpg') }}" alt="">
                </figure>
                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Aportemos información</h1>
                </header>
                <p class="text-sm text-gray-500">
                    Toda la información genealógica que podamos aportar es muy importante para mantener viva nuestra línea genaalógica
                </p>
            </article>
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('assets/images/home/imagen_3.jpg') }}" alt="">
                </figure>
                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Herencia familiar</h1>
                </header>
                <p class="text-sm text-gray-500">
                    Mantengamos nuestra herencia genealógica viva, mantengamos actualizado nuestro ancestral árbol familiar.
                </p>
            </article>
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('assets/images/home/imagen_4.jpg') }}" alt="">
                </figure>
                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Nuestro árbol</h1>
                </header>
                <p class="text-sm text-gray-500">
                    Esforcemonos hoy por hacer crecer nuestro ancestral árbol genealógico, y el día de mañana
                    nuestra descendencia lo agradecerá.
                </p>
            </article>
        </div>
    </section>
    <section class="mt-24 bg-gray-600 py-12">
        <h1 class="text-center text-white text-3xl">Comencemos a aportar ya información a nuestro árbol genealógico</h1>
        <p class="text-center text-white">Ingresemos ya a nuestra aplicación</p>
        <div class="flex justify-center mt-4">
            <!-- https://v1.tailwindcss.com/components/buttons -->
            <a href="{{ route('login') }}" class="bg-gray-900 hover:bg-gray-200 text-white hover:text-black font-bold py-2 px-4 rounded">
                Ingresar
            </a>
        </div>
    </section>
    <section class="my-24">
    </section>
</x-app-layout>