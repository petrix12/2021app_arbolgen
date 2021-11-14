<div class="overflow-x-auto">
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div>
            <x-jet-application-logo class="block h-12 w-auto" />
        </div>
        {{-- @can('crud.agclientes.create') --}}
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0 pt-4">
            <div class="inline-flex rounded-md shadow">
                <a href="{{ route('crud.trees.create') }}" class="w-full cfrSefar inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white hover:text-blue-400 bg-gray-700 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Add person') }}
                </a>
            </div>
        </div>
        {{-- @endcan --}}
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
                @if ($trees->count())
                    <table class="{{-- min-w-max--}} w-full table-auto ">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Persona</th>
                                <th class="py-3 px-4 text-left">ID Persona</th>
                                <th class="py-3 text-left">ID Padre</th>
                                <th class="py-3 text-left">ID Madre</th>
                                <th class="py-3 px-6 text-center">Nacimiento</th>
                                <th class="py-3 px-6 text-center">Defunción</th>
                                <th class="py-3 px-6 text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($trees as $tree)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if (file_exists('storage/assets/images/personas/' . $tree->id . '.jpg'))
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/assets/images/personas/' . $tree->id . '.jpg') }}" alt="Foto Persona">
                                            </div>
                                        @else
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/assets/images/personas/0.jpg') }}" alt="Foto Persona">
                                            </div>
                                        @endif
                                        <span class="font-medium px-2">
                                            <p title="{{ $tree->nombres }}">
                                                {{ Str::limit($tree->nombres, 20) }}
                                            </p>
                                            <p title="{{ $tree->apellido_padre . ' '. $tree->apellido_madre }}">
                                                {{ Str::limit($tree->apellido_padre . ' '. $tree->apellido_madre, 20) }}
                                            </p>
                                        </span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $tree->id }}
                                </td>
                                <td class="py-3 px-2 text-center">
                                    {{ $tree->id_padre }}
                                </td>
                                <td class="py-3 px-2 text-center">
                                    {{ $tree->id_madre }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="items-center justify-center">
                                        <p>
                                            {{ (is_null($tree->dia_nac) ? '--' : $tree->dia_nac) .' / ' }}
                                            {{ (is_null($tree->mes_nac) ? '--' : $tree->mes_nac) .' / ' }}
                                            {{ (is_null($tree->anho_nac) ? '--' : $tree->anho_nac) }}
                                        </p>
                                        <p title="{{ $tree->lugar_nac }}">
                                            {{ Str::limit($tree->lugar_nac, 30) }}
                                        </p>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="items-center justify-center">
                                        <p>
                                            {{ (is_null($tree->dia_def) ? '--' : $tree->dia_def) .' / ' }}
                                            {{ (is_null($tree->mes_def) ? '--' : $tree->mes_def) .' / ' }}
                                            {{ (is_null($tree->anho_def) ? '--' : $tree->anho_def) }}
                                        </p>
                                        <p title="{{ $tree->lugar_def }}">
                                            {{ Str::limit($tree->lugar_def, 30) }}
                                        </p>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="item-center justify-center flex">
                                        {{-- Mostrar árbol genealógico --}}
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{ route('dashboard', $tree->id) }}" title="Mostar árbol genealógico">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </div>
                                        {{-- Editar persona --}}
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{ route('crud.trees.edit', $tree->id) }}" title="Editar persona">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>
                                        {{-- Mostrar documentos --}}
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{ route('crud.files.show', $tree->id) }}" title="Mostrar documentos">
                                                <i class="fas fa-folder-open"></i>
                                            </a>
                                        </div>
                                        {{-- Cargar documentos --}}
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{ route('crud.files.create', ['id' => $tree->id]) }}" title="Cargar documentos">
                                                <i class="fas fa-folder-plus"></i>
                                            </a>
                                        </div>
                                        {{-- Eliminar persona --}}
                                        <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <form action="{{ route('crud.trees.destroy', $tree) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button 
                                                    type="submit" 
                                                    onclick="return confirm('¿Está seguro que desea eliminar este registro?')"
                                                    title="Eliminar persona"
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
                            {{ $trees->links() }}
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