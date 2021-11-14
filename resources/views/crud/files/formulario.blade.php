@csrf
<div class="container">
    {{-- Fila 1: Documento --}}
    <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1">    {{-- nombre --}}
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre a asignar al documento</label>
                <input value="{{ old('nombre', $file->nombre ) }}" type="text" name="nombre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('nombre')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>
    </div>

    {{-- Fila 2: Enlace --}}
    <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1">    {{-- enlace --}}
            <div>
                <label for="enlace" class="block text-sm font-medium text-gray-700">Enlace</label>
                <input value="{{ old('enlace', $file->ruta ) }}" type="text" name="enlace" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('enlace')
                    <small style="color:red">*{{ $message }}*</small>
                @enderror
            </div>
        </div>
    </div>

    {{-- Fila 6: Observaciones --}}
    {{-- <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1"> --}}    {{-- observaciones --}}
            {{-- <div>
                <label for="observaciones" class="block text-sm font-medium text-gray-700" title="Observaciones">Observaciones</label>
                <textarea name="observaciones" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Observaciones">
                    {{ old('observaciones', $tree->observaciones) }}
                </textarea>
            </div>
        </div>
    </div> --}}

    {{-- Documento --}}
    <div class="sm:flex">
        <div class="px-1 py-2 m-2 flex-1">    {{-- documento --}}
            <div> 
                <input id="file" type="file" name="file" style="display: none"
                    {{-- accept=".jpg" --}}
                />
                <label for="file" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white hover:text-blue-400 bg-gray-700 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-upload mr-2"></i> Documento
                </label>
            </div>
            @error('file')
                <small style="color:red">*{{ $message }}*</small>
            @enderror
        </div>
    </div>

    {{-- Explicación --}}
    <div class="sm:flex">
        <div class="px-1 mx-2 flex-1">
            <hr>
            <div>
                <p class="block text-sm font-medium text-gray-700 mt-4">
                    Suministre una URL que haga referencia a un documento de <strong>{{ GetNombreCompleto($tree_id) }}</strong>, 
                    en el campo <strong>Enlace</strong>, o cargue un documento presionando el botón <strong>Documento</strong>.
                </p>
                <p class="block text-sm font-medium text-gray-700 mt-4">
                    En caso de suministrar un enlace y cargar un documento al mismo tiempo, solo se tomará en cuenta
                    la carga del documento. El documento no debe pesar más de 2 MB.
                </p>
                <p class="block text-sm font-medium text-gray-700 mt-4">
                    Si desea cargar un video de larga duración, se recomienda cargarlo primero en una plataforma como 
                    YouTube y luego suministrar el enlace.
                </p>
            </div>
        </div>
    </div>
</div>