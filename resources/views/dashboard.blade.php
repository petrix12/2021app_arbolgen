<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Árbol Genealógico
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(existePersona($id))
                    @livewire('tree-view',['idP' => $id])
                @else
                    <section class="mt-24 bg-gray-600 py-12">
                        <h1 class="text-center text-white text-3xl">
                            La persona con el <strong>id = {{ $id }}</strong> no existe en nuestra base de datos
                        </h1>
                        <div class="flex justify-center mt-4">
                            <a href="{{ route('crud.trees.index') }}" class="bg-gray-900 hover:bg-gray-200 text-white hover:text-black font-bold py-2 px-4 rounded">
                                Ir a lista de personas
                            </a>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>