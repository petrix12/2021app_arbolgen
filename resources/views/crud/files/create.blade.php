<x-app-layout>
    @if (ExistePersona($tree_id))
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Añadir documento o enlace de <strong class="text-blue-500">{{ GetNombreCompleto($tree_id) }}</strong>
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> 
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div>
                            <x-jet-application-logo class="block h-12 w-auto" />
                        </div>
                    </div>

                    {!! Form::open(['route' => 'crud.files.store', 'files' => true,]) !!}
                    <div class="bg-gray-200 bg-opacity-25">
                        <div class="p-6 border-t border-gray-200 md:border-l">
                            <div class="container relative">
                                <div class="tree-chart" width="100%">
                                    @include('crud.files.formulario')
                                    <input name="url_anterior" type="hidden" value="{{ redirect()->getUrlGenerator()->previous() }}">
                                    <input name="tree_id" type="hidden" value="{{ $tree_id }}">
                                    @if ($idPivote)
                                        <input name="idPivote" type="hidden" value="{{ $idPivote }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="text-2xl sm:flex"> 
                            <div class="px-4 mx-2 flex-1">
                                <div class="justify-center">
                                    <div class="pt-2">
                                        <div class="px-4 bg-gray-50 text-left sm:px-6">
                                            {!! Form::submit('Añadir', ['class' => 'inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white hover:text-blue-400 bg-gray-700 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @else
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Añadir documento o enlace
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> 
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div>
                            <x-jet-application-logo class="block h-12 w-auto" />
                        </div>
                    </div>

                    <div class="container">
                        <div class="sm:flex">
                            <div class="px-1 py-8 m-2 mx-2 flex-1">
                                <h1>La persona con id = <strong>{{ $tree_id }}</strong> no existe en nuestra base de datos</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>