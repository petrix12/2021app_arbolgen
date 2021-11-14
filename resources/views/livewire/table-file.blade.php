<div class="overflow-x-auto">
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div>
            <x-jet-application-logo class="block h-12 w-auto" />
        </div>
    </div>

    <div class="min-w-screen {{-- min-h-screen --}} flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
        <div class=" w-full {{-- lg:w-5/6 --}}">
            {{-- Inicio Buscar --}}
            <div class="flex bg-white px-4 py-3 sm:px-6">
                <input 
                    wire:keydown="limpiar_page" 
                    wire:model="search"
                    type="text"
                    placeholder="Buscar..." 
                    class="w-full mr-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md"
                >
                <div class="col-span-6 sm:col-span-3 w-48">
                    <select wire:model="perPage" class="py-2 px-2 mt-1 mr-10 block w-full border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="5">5 por pág. </option>
                        <option value="10">10 por pág.</option>
                        <option value="15">15 por pág.</option>
                        <option value="25">25 por pág.</option>
                        <option value="50">50 por pág.</option>
                        <option value="100">100 por pág.</option>
                    </select>
                </div>
                @if ($search !== '')
                    <button wire:click="clear" class="py-1 px-2 mt-1 ml-2 border border-transparent rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"><i class="far fa-window-close"></i></button>
                @endif
            </div>
            {{-- Fin Buscar --}}
            <div class="bg-white shadow-md rounded {{-- my-6 --}}">
                @if ($files->count())
                    <table class="{{-- min-w-max--}} w-full table-auto ">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-4 text-left">Persona</th>
                                <th class="py-3 px-1 text-left">Ir a documento</th>
                                <th class="py-3 px-6 text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($files as $file)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-4 text-left">
                                    {{ Str::limit(GetNombreCompleto($file->tree_id), 30) }}
                                </td>
                                <td class="py-3 px-1 text-left">
                                    <a 
                                        href="{{ ($file->es_enlace ? $file->ruta : asset($file->ruta)) }}" 
                                        target="_blank"
                                        class="text-blue-900 hover:text-blue-700"
                                    >
                                        {{ Str::limit($file->nombre, 50) }}
                                    </a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="item-center justify-center flex">
                                        {{-- Editar documento --}}
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{ route('crud.files.edit', $file) }}" title="Editar documento">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>
                                        {{-- Eliminar documento --}}
                                        <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <form action="{{ route('crud.files.destroy', $file) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button 
                                                    type="submit" 
                                                    onclick="return confirm('¿Está seguro que desea eliminar este registro?')"
                                                    title="Eliminar documento"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        <div class="container">
                            {{ $files->links() }}
                        </div>
                    </div>
                @else
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 text-gray-500">
                        No hay resultado para la búsqueda {{ $search }} en la página {{ $page }} al mostrar {{ $perPage }} por página
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>