@csrf
<div class="container">
    {{-- Fila 1: Nombres y apellidos --}}
    <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1">    {{-- nombres --}}
            <div>
                <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres</label>
                <input value="{{ old('nombres', $tree->nombres ) }}" type="text" name="nombres" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('nombres')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- apellido_padre --}}
            <div>
                <label for="apellido_padre" class="block text-sm font-medium text-gray-700">Apellido paterno</label>
                <input value="{{ old('apellido_padre', $tree->apellido_padre ) }}" type="text" name="apellido_padre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('apellido_padre')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- apellido_madre --}}
            <div>
                <label for="apellido_madre" class="block text-sm font-medium text-gray-700">Apellido materno</label>
                <input value="{{ old('apellido_madre', $tree->apellido_madre ) }}" type="text" name="apellido_madre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('apellido_madre')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>
    </div>

    {{-- Fila 2: Datos vinculantes --}}
    <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1">    {{-- id_padre --}}
            <div>
                <label for="id_padre" class="block text-sm font-medium text-gray-700">ID Padre</label>
                <input value="{{ old('id_padre', $tree->id_padre ) }}" type="number" min="1" name="id_padre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('id_padre')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- id_madre --}}
            <div>
                <label for="id_madre" class="block text-sm font-medium text-gray-700">ID Madre</label>
                <input value="{{ old('id_madre', $tree->id_madre ) }}" type="number" min="1" name="id_madre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('id_madre')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- sexo --}}
            <div>
                <label for="sexo" class="block text-sm font-medium text-gray-700" title="Sexo">Sexo</label>
                <select name="sexo" autocomplete="on" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="{{ null }}">-</option>
                    @if (old('sexo', $tree->sexo) == "M")
                        <option title="Masculino" selected>M</option>
                    @else
                        <option title="Masculino">M</option>
                    @endif
                    
                    @if (old('sexo', $tree->sexo) == "F")
                        <option title="Masculino" selected>F</option>
                    @else
                        <option title="Masculino">F</option>
                    @endif
                </select>
                @error('sexo')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>
    </div>

    {{-- Fila 3: Datos de nacimiento --}}
    <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1">    {{-- dia_nac --}}
            <div>
                <label for="dia_nac" class="block text-sm font-medium text-gray-700">Día de nacimiento</label>
                <input value="{{ old('dia_nac', $tree->dia_nac ) }}" type="number" min="1" max="31" name="dia_nac" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('dia_nac')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- mes_nac --}}
            <div>
                <label for="mes_nac" class="block text-sm font-medium text-gray-700">Mes de nacimiento</label>
                <input value="{{ old('mes_nac', $tree->mes_nac ) }}" type="number" min="1" max="12" name="mes_nac" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('mes_nac')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- anho_nac --}}
            <div>
                <label for="anho_nac" class="block text-sm font-medium text-gray-700">Año de nacimiento</label>
                <input value="{{ old('anho_nac', $tree->anho_nac ) }}" type="number" max="3000" name="anho_nac" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('anho_nac')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- lugar_nac --}}
            <div>
                <label for="lugar_nac" class="block text-sm font-medium text-gray-700">Lugar de nacimiento</label>
                <input value="{{ old('lugar_nac', $tree->lugar_nac ) }}" type="text" name="lugar_nac" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('lugar_nac')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>
    </div>

    {{-- Fila 4: Datos de matrimonio --}}
    <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1">    {{-- dia_matr --}}
            <div>
                <label for="dia_matr" class="block text-sm font-medium text-gray-700">Día de matrimonio</label>
                <input value="{{ old('dia_matr', $tree->dia_matr ) }}" type="number" min="1" max="31" name="dia_matr" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('dia_matr')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- mes_matr --}}
            <div>
                <label for="mes_matr" class="block text-sm font-medium text-gray-700">Mes de matrimonio</label>
                <input value="{{ old('mes_matr', $tree->mes_matr ) }}" type="number" min="1" max="12" name="mes_matr" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('mes_matr')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- anho_matr --}}
            <div>
                <label for="anho_matr" class="block text-sm font-medium text-gray-700">Año de matrimonio</label>
                <input value="{{ old('anho_matr', $tree->anho_matr ) }}" type="number" max="3000" name="anho_matr" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('anho_matr')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- lugar_matr --}}
            <div>
                <label for="lugar_matr" class="block text-sm font-medium text-gray-700">Lugar de matrimonio</label>
                <input value="{{ old('lugar_matr', $tree->lugar_matr ) }}" type="text" name="lugar_matr" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('lugar_matr')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>
    </div>

    {{-- Fila 5: Datos de defunción --}}
    <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1">    {{-- dia_def --}}
            <div>
                <label for="dia_def" class="block text-sm font-medium text-gray-700">Día de defunción</label>
                <input value="{{ old('dia_def', $tree->dia_def ) }}" type="number" min="1" max="31" name="dia_def" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('dia_def')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- mes_def --}}
            <div>
                <label for="mes_def" class="block text-sm font-medium text-gray-700">Mes de defunción</label>
                <input value="{{ old('mes_def', $tree->mes_def ) }}" type="number" min="1" max="12" name="mes_def" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('mes_def')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- anho_def --}}
            <div>
                <label for="anho_def" class="block text-sm font-medium text-gray-700">Año de defunción</label>
                <input value="{{ old('anho_def', $tree->anho_def ) }}" type="number" max="3000" name="anho_def" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('anho_def')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>

        <div class="px-1 py-2 m-2 flex-1">    {{-- lugar_def --}}
            <div>
                <label for="lugar_def" class="block text-sm font-medium text-gray-700">Lugar de defunción</label>
                <input value="{{ old('lugar_def', $tree->lugar_def ) }}" type="text" name="lugar_def" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('lugar_def')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>
    </div>

    {{-- Fila 6: Observaciones --}}
    <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1">    {{-- observaciones --}}
            <div>
                <label for="observaciones" class="block text-sm font-medium text-gray-700" title="Observaciones">Observaciones</label>
                <textarea name="observaciones" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Observaciones">
                    {{ old('observaciones', $tree->observaciones) }}
                </textarea>
            </div>
        </div>
    </div>

    {{-- Foto --}}
    <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1">    {{-- foto --}}
            <div> 
                <input id="file" type="file" name="file" style="display: none"
                    accept=".jpg"
                />
                <label for="file" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white hover:text-blue-400 bg-gray-700 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-upload mr-2"></i> Foto
                </label>
                <p class="block text-sm font-medium text-gray-700 mt-4">
                    La imagen debe estar en formato jpg y no debe pesar más de 2 MB.
                </p>
            </div>
        </div>
    </div>
</div>