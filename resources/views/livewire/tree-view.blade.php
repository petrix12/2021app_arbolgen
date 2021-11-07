<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div>

    <div class="mt-8 text-2xl sm:flex">
        {{-- Hijos --}}
        <div class="px-4 py-2 m-2 flex-1">
            
            <div class="justify-center">
                <label for="hijos" class="px-3 block text-sm font-medium text-gray-700" title="Seleccionar hijo">Hijos</label>
                <select wire:model="Hijo" name="hijos" class="w-full mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="{{ null }}">-</option>
                    <option value="1">Hijo 1</option>
                    <option value="2">Hijo 2</option>
                    <option value="1">Hijo 1</option>
                    <option value="1">Hijo 1</option>
                    <option value="1">Hijo 1</option>
                    <option value="1">Hijo 1</option>
                </select>
                <div class="pt-2">
                    <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                        <a href="#" target="_blank" class="w-full cfrSefar inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white hover:text-blue-400 bg-gray-700 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ir a familiar seleccionado
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Uniones --}}
        <div class="px-4 py-2 m-2 flex-1">
            
            <div class="justify-center">
                <label for="hijos" class="px-3 block text-sm font-medium text-gray-700" title="Seleccionar hijo">Uniones</label>
                <select wire:model="Union" name="hijos" class="w-full mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="{{ null }}">-</option>
                    <option value="1">Unión 1</option>
                    <option value="2">Unión 2</option>
                </select>
                <div class="pt-2">
                    <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                        <a href="#" target="_blank" class="w-full cfrSefar inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white hover:text-blue-400 bg-gray-700 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ir a unión seleccionada
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25">
    <div class="p-6 border-t border-gray-200 md:border-l">
        <div style="height:37rem" class="container relative overflow-x-scroll">
            <div class="tree-chart" width="100%">
                <!-- *** PIVOTE *** -->
                <div class="caja_per" style="top: 225px; left: 10px;">
                    <span class="encabezado" title="Datos matrimonio...">Pivote</span>
                    <span class="nombres" title="{{ $trees->find($id)->nombres }}">
                        {{-- <x-editar-persona-i-v2 :agclientes='$agclientes' :id='1'/> {{ Str::limit(GetNombres($agclientes,1), 30) }} --}}
                        {{ Str::limit($trees->find($id)->nombres, 30) }}
                    </span>
                    <span class="apellidos" title="{{ $trees->find($id)->apellido_padre . ' ' . $trees->find($id)->apellido_madre }}">
                        {{ Str::limit($trees->find($id)->apellido_padre . ' ' . $trees->find($id)->apellido_madre, 30) }}
                    </span>
                    @if (true)
                        <span class="texto">Lugar de nacimiento</span>
                        <span class="nacimiento" title="{{ $trees->find($id)->lugar_nac }}">{{ Str::limit($trees->find($id)->lugar_nac, 30) }}</span>  
                    @endif
                    <span class="vida">
                        {{ is_null($trees->find($id)->anho_nac) ? '--' : $trees->find($id)->anho_nac }} /
                        {{ is_null($trees->find($id)->anho_def) ? '--' : $trees->find($id)->anho_def }}
                    </span>
                    {{-- <x-ver-doc :agclientes='$agclientes' :id='1'/>
                    <x-cargar-doc :agclientes='$agclientes' :id='1'/> --}}
                </div>
                
                <!-- *** PADRES *** -->
                @for ($i = 2; $i <= 3; $i++)
                    <div class="caja_per" style="top: {{ 85 + ($i-2)*280 }}px; left: 100px; ">
                        <span class="encabezado" title="Datos matrimonio...">Padres</span>
                        <span class="nombres">
                            {{-- <x-editar-persona-i-v2 :agclientes='$agclientes' :id='$i'/> {{ Str::limit(GetNombres($agclientes,$i), 30) }} --}}
                            Nombres Padres
                        </span>
                        <span class="apellidos">Apellidos Padres</span>
                        @if (true)
                            <span class="texto">Lugar de nacimiento</span>
                            <span class="nacimiento">Caracas</span>
                        @endif
                        <span class="vida" title="Lugar y año de nacimiento y fallecimiento">1942 / --</span>
                        {{-- <x-ver-doc :agclientes='$agclientes' :id='$i'/>
                        <x-cargar-doc :agclientes='$agclientes' :id='$i'/> --}}
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
                    <div class="caja_abuelos" style="top: {{ 25 + ($i-4)*140 }}px; left: 390px; ">
                        <span class="encabezado_abl" title="Datos matrimonio...">Abuelos</span>
                        <span class="nom-abuelo">
                            {{-- <x-editar-persona-i-v2 :agclientes='$agclientes' :id='$i'/> {{ Str::limit(GetNombres($agclientes,$i), 30) }} --}}
                            Nombres Abuelos
                        </span>
                        <span class="ape-abuelo">Apellidos Abuelos</span>
                        @if (true)
                            <span class="text-abuelo">Lugar de nacimiento</span>
                            <span class="nac-abuelo">Caracas</span>  
                        @endif
                        <span class="vid-abuelo" title="Lugar y año de nacimiento y fallecimiento">1912 / 1998</span>
                        {{-- <x-ver-doc :agclientes='$agclientes' :id='$i'/>
                        <x-cargar-doc :agclientes='$agclientes' :id='$i'/>--}}
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
                    <div class="caja_bisabuelos" style="top: {{ 10 + ($i-8)*70 }}px; left: 660px; ">
                        <span class="encabezado_bis" title="Datos matrimonio...">Bisabuelos</span>
                        <span class="nom-bisabuelo">
                            {{-- <x-editar-persona-i-v2 :agclientes='$agclientes' :id='$i'/> {{ Str::limit(GetNombres($agclientes,$i), 30) }} --}}
                            Nombres Bisabuelos
                        </span>
                        <span class="ape-bisabuelo" title="Lugar de nacimiento: ...">Apellidos Bisabuelos</span>
                        <span class="vid-bisabuelo" title="Lugar y año de nacimiento y fallecimiento">1890 / 1940</span>
                        {{-- <x-ver-doc :agclientes='$agclientes' :id='$i'/>
                        <x-cargar-doc :agclientes='$agclientes' :id='$i'/> --}}
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
                <div class="caja_tatarabuelos" style="top: {{ 10 + ($i-16)*35 }}px; left: 930px;" title="Lugar y año de nacimiento y fallecimiento">
                    <span class="nom-tatarabuelos" title="Tatarabuelos - Datos matrimonio...">
                        {{-- <x-editar-persona-i-v2 :agclientes='$agclientes' :id='$i'/> {{ Str::limit(GetNombres($agclientes,$i), 30) }} --}}
                        Nombres Tatarabuelos
                    </span>
                    <span class="ape-tatarabuelos" title="1850-1910">Apellidos Tatarabuelos</span>
                    {{-- <x-ver-doc :agclientes='$agclientes' :id='$i'/>
                    <x-cargar-doc :agclientes='$agclientes' :id='$i'/> --}}
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