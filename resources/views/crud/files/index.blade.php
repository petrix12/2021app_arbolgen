<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if ($id == -1)
                Lista de documentos
            @else
                @if (existePersona($id))
                    Documentos: <strong class="text-gray-500">{{ GetNombreCompleto($id) }}</strong>
                @else
                    La persona con id = <strong>{{ $id }}</strong> no existe en nuestra base de datos
                @endif
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('table-file', ['tree_id' => $id])
                
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="px-4 bg-gray-50 text-left sm:px-6">
                        <a href="{{ route('crud.regresar', array('idPivote' => $idPivote, 'url_anterior' => redirect()->getUrlGenerator()->previous())) }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white hover:text-blue-400 bg-gray-700 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>