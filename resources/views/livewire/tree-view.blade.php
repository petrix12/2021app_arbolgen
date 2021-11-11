@php
    $idPivote = $id;
@endphp
<div>
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
    
    <div class="bg-gray-200 bg-opacity-25">
        <div class="p-6 border-t border-gray-200 md:border-l">
            <div style="height:37rem" class="container relative overflow-x-scroll">
                <div class="tree-chart" width="100%">
                    <!-- *** PIVOTE *** -->
                    <div class="caja_per" style="top: 225px; left: 10px;">
                        <span class="encabezado" title="{{ GetDatosMatrimonio($id) }}">
                            {{ 'Pivote' . ($id ? ' (' . $id  .')' : '') }}
                        </span>
                        <a href="{{ route('crud.trees.create', array(
                                'idPivote' => $id, 
                                'idPadre' => $id, 
                                'sexo' => GetSexo($id)
                            )) }}">
                                <span class="foto">
                                    @if (file_exists('assets/images/personas/' . $id . '.jpg'))
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{ asset('assets/images/personas/' . $id . '.jpg') }}" alt="Foto Pivote">
                                        </div>
                                    @else
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{ asset('assets/images/personas/0.jpg') }}" alt="Foto Pivote">
                                        </div>
                                    @endif
                                </span>
                        </a>
                        <span class="nombres" title="{{ GetNombres($id) }}">
                            {{ Str::limit(GetNombres($id), 30) }}
                        </span>
                        <span class="apellidos" title="{{ GetApellidos($id) }}">
                            {{ Str::limit(GetApellidos($id), 30) }}
                        </span>
                        @if (GetLugarNacimiento($id))
                            <span class="texto">Lugar de nacimiento</span>
                            <span class="nacimiento" title="{{ GetLugarNacimiento($id) }}">
                                {{ Str::limit(GetLugarNacimiento($id), 30) }}
                            </span>  
                        @endif
                        <span class="vida" title="{{ GetVidaLugarAnho($id) }}">
                            {{ GetVidaAnho($id) }}
                        </span>
                        <span class="editar" title="Editar">
                            <a href="{{ route('crud.trees.edit', array($id, 'idPivote' => $idPivote)) }}">
                                <i class="fas fa-user-edit text-red-700"></i>
                            </a>
                        </span>
                    </div>
                    
                    <!-- *** PADRES *** -->
                    @for ($i = 2; $i <= 3; $i++)
                        @php
                            $idP = GetIdPadres($id)[$i-2];
                            $persona = GetPersonaPadres()[$i-2];
                        @endphp
                        <div class="caja_per" style="top: {{ 85 + ($i-2)*280 }}px; left: 100px; ">
                            <span class="encabezado" title="{{ GetDatosMatrimonio($idP) }}">
                                {{ $persona . ($idP ? ' (' . $idP  .')' : '') }}
                            </span>
                            <span class="nombres" title="{{ GetNombres($idP) }}">
                                {{ Str::limit(GetNombres($idP), 30) }}
                            </span>
                            <span class="apellidos" title="{{ GetApellidos($idP) }}">
                                {{ Str::limit(GetApellidos($idP), 30) }}
                            </span>
                            @if (GetLugarNacimiento($idP))
                                <span class="texto">Lugar de nacimiento</span>
                                <span class="nacimiento" title="{{ GetLugarNacimiento($idP) }}">
                                    {{ Str::limit(GetLugarNacimiento($idP), 30) }}
                                </span>  
                            @endif
                            <span class="vida" title="{{ GetVidaLugarAnho($idP) }}">
                                {{ GetVidaAnho($idP) }}
                            </span>
                            @if (existePersona($idP))
                                <span class="foto">
                                    <button title="Establecer como pivote" wire:click="cambiar_id({{ $idP }})">
                                        @if (file_exists('assets/images/personas/' . $idP . '.jpg'))
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('assets/images/personas/' . $idP . '.jpg') }}" alt="Foto Padres">
                                            </div>
                                        @else
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('assets/images/personas/0.jpg') }}" alt="Foto Padres">
                                            </div>
                                        @endif
                                    </button>
                                </span>
                                <span class="editar" title="Editar">
                                    <a href="{{ route('crud.trees.edit', array($idP, 'idPivote' => $idPivote)) }}">
                                        <i class="fas fa-user-edit text-red-700"></i>
                                    </a>
                                </span>
                            @else
                                <span class="editar" title="Crear">
                                    @php
                                        $sexo = ($i % 2 == 0) ? 'M' : 'F';
                                    @endphp
                                    <a href="{{ route('crud.trees.create', array(
                                            'idPivote' => $idPivote, 
                                            'idHijo' => $id, 
                                            'sexo' => $sexo
                                        )) }}">
                                        <i class="fas fa-user-edit text-red-700"></i>
                                    </a>
                                </span>
                            @endif
                        </div>
                    @endfor
                    <div class="link father-branch" style="opacity: 1 !important; left: 80px; top: 145px; width: 20px; height: 120px;">
                        <span class="first"></span>
                        <span class="second"></span>
                    </div>
                    <div class="link mother-branch" style="opacity: 1 !important; left: 80px; top: 305px; width: 20px; height: 120px;">
                        <span class="first"></span>
                        <span class="second"></span>
                    </div>
        
                    <!-- *** ABUELOS *** -->
                    @for ($i = 4; $i <=7; $i++)
                        @php
                            $idA = GetIdAbuelos($id)[$i-4];
                            $persona = GetPersonaAbuelos()[$i-4];
                        @endphp
                        <div class="caja_abuelos" style="top: {{ 25 + ($i-4)*140 }}px; left: 390px; ">
                            <span class="encabezado_abl" title="{{ GetDatosMatrimonio($idA) }}">
                                {{ $persona . ($idA ? ' (' . $idA  .')' : '') }}
                            </span>
                            <span class="nom-abuelo" title="{{ GetNombres($idA) }}">
                                {{ Str::limit(GetNombres($idA), 30) }}
                            </span>
                            <span class="ape-abuelo" title="{{ GetApellidos($idA) }}">
                                {{ Str::limit(GetApellidos($idA), 30) }}
                            </span>
                            @if (GetLugarNacimiento($idA))
                                <span class="text-abuelo">Lugar de nacimiento</span>
                                <span class="nac-abuelo" title="{{ GetLugarNacimiento($idA) }}">
                                    {{ Str::limit(GetLugarNacimiento($idA), 30) }}
                                </span>
                            @endif
                            <span class="vid-abuelo" title="{{ GetVidaLugarAnho($idA) }}">
                                {{ GetVidaAnho($idA) }}
                            </span>
                            @php
                                $idHijo = GetIdHijo($id, $persona);
                            @endphp
                            @if (existePersona($idA))
                                <span class="foto">
                                    <button title="Establecer como pivote" wire:click="cambiar_id({{ $idA }})">
                                        @if (file_exists('assets/images/personas/' . $idA . '.jpg'))
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <img class="h-8 w-8 rounded-full" src="{{ asset('assets/images/personas/' . $idA . '.jpg') }}" alt="Foto Abuelos">
                                            </div>
                                        @else
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <img class="h-8 w-8 rounded-full" src="{{ asset('assets/images/personas/0.jpg') }}" alt="Foto Abuelos">
                                            </div>
                                        @endif
                                    </button>
                                </span>
                                <span class="editar-abuelo" title="Editar">
                                    <a href="{{ route('crud.trees.edit', array($idA, 'idPivote' => $idPivote)) }}">
                                        <i class="fas fa-user-edit text-red-700"></i>
                                    </a>
                                </span>
                            @else
                                @if ($idHijo)
                                    <span class="editar-abuelo" title="Crear">
                                        @php
                                            $sexo = ($i % 2 == 0) ? 'M' : 'F';
                                        @endphp
                                        <a href="{{ route('crud.trees.create', array(
                                            'idPivote' => $idPivote, 
                                            'idHijo' => $idHijo, 
                                            'sexo' => $sexo
                                        )) }}">
                                            <i class="fas fa-user-edit text-red-700"></i>
                                        </a>
                                    </span>
                                @endif
                            @endif
                        </div> 
                        @if ($i % 2 == 0)
                            <div class="link father-branch" style="opacity: 1 !important; left: 370px; top: {{ 75 + ($i-4)*140 }}px; width: 20px; height: 50px;">
                                <span class="first"></span>
                                <span class="second"></span>
                            </div>
                            <div class="link mother-branch" style="opacity: 1 !important; left: 370px; top: {{ 165 + ($i-4)*140 }}px; width: 20px; height: 50px;">
                                <span class="first"></span>
                                <span class="second"></span>
                            </div>
                        @endif
                    @endfor
        
                    <!-- *** BISABUELOS *** -->
                    @for ($i = 8; $i <=15; $i++)
                        @php
                            $idB = GetIdBisabuelos($id)[$i-8];
                            $persona = GetPersonaBisabuelos()[$i-8];
                        @endphp
                        <div class="caja_bisabuelos" style="top: {{ 10 + ($i-8)*70 }}px; left: 660px; ">
                            <span class="encabezado_bis" title="{{ GetDatosMatrimonio($idB) }}">
                                {{ $persona . ($idB ? ' (' . $idB  .')' : '') }}
                            </span>
                            <span class="nom-bisabuelo" title="{{ GetNombres($idB) }}">
                                {{ Str::limit(GetNombres($idB), 30) }}
                            </span>
                            <span class="ape-bisabuelo" title="{{ GetLugarNacimiento($idB) }}">
                                {{ Str::limit(GetApellidos($idB), 30) }}
                            </span>
                            <span class="vid-bisabuelo" title="{{ GetVidaLugarAnho($idB) }}">
                                {{ GetVidaAnho($idB) }}
                            </span>
                            @php
                                $idHijo = GetIdHijo($id, $persona);
                            @endphp
                            @if (existePersona($idB))
                                <span class="foto">
                                    <button title="Establecer como pivote" wire:click="cambiar_id({{ $idB }})">
                                        @if (file_exists('assets/images/personas/' . $idB . '.jpg'))
                                            <div class="flex-shrink-0 h-6 w-6">
                                                <img class="h-6 w-6 rounded-full" src="{{ asset('assets/images/personas/' . $idB . '.jpg') }}" alt="Foto Bisabuelos">
                                            </div>
                                        @else
                                            <div class="flex-shrink-0 h-6 w-6">
                                                <img class="h-6 w-6 rounded-full" src="{{ asset('assets/images/personas/0.jpg') }}" alt="Foto Bisabuelos">
                                            </div>
                                        @endif
                                    </button>
                                </span>
                                <span class="editar-bisabuelo" title="Editar">
                                    <a href="{{ route('crud.trees.edit', array($idB, 'idPivote' => $idPivote)) }}">
                                        <i class="fas fa-user-edit text-red-700"></i>
                                    </a>
                                </span>
                            @else
                                @if ($idHijo)
                                    <span class="editar-bisabuelo" title="Crear">
                                        @php
                                            $sexo = ($i % 2 == 0) ? 'M' : 'F';
                                        @endphp
                                        <a href="{{ route('crud.trees.create', array(
                                            'idPivote' => $idPivote, 
                                            'idHijo' => $idHijo, 
                                            'sexo' => $sexo
                                        )) }}">
                                            <i class="fas fa-user-edit text-red-700"></i>
                                        </a>
                                    </span>
                                @endif
                            @endif
                        </div>
                        @if ($i % 2 == 0)
                            <div class="link father-branch" style="opacity: 1 !important; left: 640px; top: {{40 + ($i-8)*70}}px; width: 20px; height: 30px;">
                                <span class="first"></span>
                                <span class="second"></span>
                            </div>
                            <div class="link mother-branch" style="opacity: 1 !important; left: 640px; top: {{80 + ($i-8)*70}}px; width: 20px; height: 30px;">
                                <span class="first"></span>
                                <span class="second"></span>
                            </div>
                        @endif
                    @endfor
        
                    <!-- *** TATARABUELOS *** -->
                    @for ($i = 16; $i <=31; $i++)
                        @php
                            $idT = GetIdTatarabuelos($id)[$i-16];
                            $persona = GetPersonaTatarabuelos()[$i-16];
                        @endphp
                    <div class="caja_tatarabuelos" style="top: {{ 10 + ($i-16)*35 }}px; left: 930px;" title="{{ $persona . ($idT ? ' (' . $idT  .')' : '') }}">
                        <span class="nom-tatarabuelos" title="{{ GetDatosMatrimonio($idT) }}">
                            {{ Str::limit(GetNombres($idT), 30) }}
                        </span>
                        <span class="ape-tatarabuelos" title="{{ GetVidaLugarAnho($idT) }}">{{ Str::limit(GetApellidos($idT), 30) }}</span>
                        @php
                            $idHijo = GetIdHijo($id, $persona);
                        @endphp
                        @if (existePersona($idT))
                            <span class="foto">
                                <button title="Establecer como pivote" wire:click="cambiar_id({{ $idT }})">
                                    @if (file_exists('assets/images/personas/' . $idT . '.jpg'))
                                        <div class="flex-shrink-0 h-6 w-6">
                                            <img class="h-4 w-4 rounded-full" src="{{ asset('assets/images/personas/' . $idT . '.jpg') }}" alt="Foto Tatarabuelos">
                                        </div>
                                    @else
                                        <div class="flex-shrink-0 h-6 w-6">
                                            <img class="h-4 w-4 rounded-full" src="{{ asset('assets/images/personas/0.jpg') }}" alt="Foto Tatarabuelos">
                                        </div>
                                    @endif
                                </button>
                            </span>
                            <span class="editar-tatarabuelo" title="Editar">
                                <a href="{{ route('crud.trees.edit', array($idT, 'idPivote' => $idPivote)) }}">
                                    <i class="fas fa-user-edit text-red-700"></i>
                                </a>
                            </span>
                        @else
                            @if ($idHijo)
                                <span class="editar-tatarabuelo" title="Crear">
                                    @php
                                        $sexo = ($i % 2 == 0) ? 'M' : 'F';
                                    @endphp
                                    <a href="{{ route('crud.trees.create', array(
                                        'idPivote' => $idPivote, 
                                        'idHijo' => $idHijo, 
                                        'sexo' => $sexo
                                    )) }}">
                                        <i class="fas fa-user-edit text-red-700"></i>
                                    </a>
                                </span>
                            @endif
                        @endif
                    </div>
                        @if ($i % 2 == 0)
                            <div class="link father-branch" style="opacity: 1 !important; left: 910px; top: {{22 + ($i-16)*35}}px; width: 20px; height: 12.5px;">
                                <span class="first"></span>
                                <span class="second"></span>
                            </div>
                            <div class="link mother-branch" style="opacity: 1 !important; left: 910px; top: {{45 + ($i-16)*35}}px; width: 20px; height: 12.5px;">
                                <span class="first"></span>
                                <span class="second"></span>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div class="mt-8 text-2xl sm:flex">
            {{-- Hijos --}}
            @php
                $hijos = GetHijos($id);
            @endphp
            <div class="px-4 py-2 m-2 flex-1">
                @if ($hijos->count())
                    <div class="justify-center">
                        <label for="hijos" class="px-3 block text-sm font-medium text-gray-700" title="Seleccionar hijo">Hijos</label>
                        <select wire:model="hijo_seleccionado" name="hijos" class="w-full mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="{{ null }}">-</option>
                            @foreach ($hijos as $hijo)
                                <option value="{{ $hijo->id }}">{{ GetNombreCompleto($hijo->id) }}</option>
                            @endforeach
                        </select>
                        @if ($hijo_seleccionado)
                            <div class="pt-2">
                                <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                                    <button wire:click="cambiar_id_hijo" class="w-full cfrSefar inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white hover:text-blue-400 bg-gray-700 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Ir a familiar seleccionado
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>  
        
            {{-- Uniones --}}
            @php
                $uniones = GetUniones($id);
                $cantidad_uniones = count($uniones) ? count($uniones) : 0;
            @endphp
            <div class="px-4 py-2 m-2 flex-1">
                @if ($cantidad_uniones)
                    <div class="justify-center">
                        <label for="uniones" class="px-3 block text-sm font-medium text-gray-700" title="Seleccionar unión">Uniones</label>
                        <select wire:model="union_seleccionada" name="uniones" class="w-full mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="{{ null }}">-</option>
                            @foreach ($uniones as $union)
                                <option value="{{ $union }}">{{ GetNombreCompleto($union) }}</option>
                            @endforeach
                        </select>
                        @if ($union_seleccionada)
                            <div class="pt-2">
                                <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                                    <button wire:click="cambiar_id_union" class="w-full cfrSefar inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white hover:text-blue-400 bg-gray-700 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Ir a unión seleccionada
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>      
                @endif
            </div>
        </div>
    </div>
</div>