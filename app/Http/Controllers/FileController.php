<?php

namespace App\Http\Controllers;

use App\Models\File;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = -1;
        return view('crud.files.index', compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $file = new File();
        $tree_id = $request->id;
        $idPivote = $request->idPivote;
        return view('crud.files.create', compact('file', 'tree_id', 'idPivote'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'nombre' => 'required|max:250',
            'enlace' => 'nullable|url',
            'file' => 'nullable|max:2048',         // 1024 = 1 MB
        ]);

        $file = $request->file('file');
        $mensaje = null;

        if($request->hasFile('file')){
            $nombre_completo = $request->nombre . '.' . $file->getClientOriginalExtension();
            if(Storage::putFileAs('/documentos/' . $request->tree_id . '/' , $file, $nombre_completo)){
                $ruta = 'storage/documentos/' . $request->tree_id . '/' . $nombre_completo;
                File::create([
                    'nombre' => $request->nombre,
                    'ruta' => $ruta,
                    'es_enlace' => false,
                    'tree_id' => $request->tree_id
                ]);
                $mensaje = 'Documento ' . $nombre_completo . ' cargado correctamente';
            }else{
                $mensaje = 'No se pudo cargar el documento ' . $nombre_completo;
            }
        }else{
            if($request->enlace){
                File::create([
                    'nombre' => $request->nombre,
                    'ruta' => $request->enlace,
                    'es_enlace' => true,
                    'tree_id' => $request->tree_id
                ]);
                $mensaje = 'Enlace ' . $request->nombre . ' cargado correctamente';
            }else{
                $mensaje = 'No se pudo cargar el enlace ' . $request->nombre;
            }
        }
        
        // Regresar a la vista que invocó el método store
        if($request->idPivote){
            $id = $request->idPivote;
            return redirect()->route('dashboard', $id)->with('status', $mensaje);
        }else{
            return redirect($request->url_anterior)->with('status', $mensaje);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $idPivote = $request->idPivote;
        return view('crud.files.index', compact('id', 'idPivote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, File $file)
    {
        $tree_id = $file->tree_id;
        $idPivote = $request->idPivote;
        return view('crud.files.edit', compact('file', 'tree_id', 'idPivote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {   
        $request->validate([
            'nombre' => 'required|max:250',
            'file' => 'nullable|max:2048',         // 1024 = 1 MB
        ]);

        $archivo = $request->file('file');
        $mensaje = null;

        if($request->hasFile('file')){
            // Eliminar documento anterior
            $ruta = public_path($file->ruta);
            if(file_exists($ruta)){
                try{
                    unlink($ruta);
                }catch(Exception $e){
                    $mensaje = 'El documento ' . $file->nombre . ' no pudo ser eliminado fisicamente de nuestra plataforma. ';
                }
            }

            // Actualizar documento
            $nombre_completo = $request->nombre . '.' . $archivo->getClientOriginalExtension();
            if(Storage::putFileAs('/documentos/' . $request->tree_id . '/' , $archivo, $nombre_completo)){
                $ruta = 'storage/documentos/' . $request->tree_id . '/' . $nombre_completo;
                $file->update([
                    'nombre' => $request->nombre,
                    'ruta' => $ruta,
                    'es_enlace' => false,
                    'tree_id' => $request->tree_id
                ]);
                $mensaje = $mensaje . 'Documento ' . $nombre_completo . ' cargado correctamente';
            }else{
                $mensaje = $mensaje . 'No se pudo cargar el documento ' . $nombre_completo;
            }
        }else{
            if($file->es_enlace){
                if($request->enlace){
                    $file->update([
                        'nombre' => $request->nombre,
                        'ruta' => $request->enlace,
                        'es_enlace' => true,
                        'tree_id' => $request->tree_id
                    ]);
                    $mensaje = 'Enlace ' . $request->nombre . ' actualizado correctamente';
                }else{
                    $mensaje = 'No se pudo actualizar el enlace ' . $request->nombre;
                }
            }else{
                $file->update([
                    'nombre' => $request->nombre,
                ]);
                $mensaje = 'Nombre del documento ' . $request->nombre . ' actualizado correctamente';
            }
        }
        
        // Regresar a la vista que invocó el método store
        if($request->idPivote){
            $id = $request->idPivote;
            return redirect()->route('dashboard', $id)->with('status', $mensaje);
        }else{
            return redirect($request->url_anterior)->with('status', $mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->delete();
        $ruta = public_path($file->ruta);
        $mensaje = null;
        if($file->es_enlace){
            $mensaje = 'Enlace ' . $file->nombre . ' eliminado correctamente de la base de datos.';
        }else{
            $mensaje = 'Documento ' . $file->nombre . ' eliminado correctamente de la base de datos.';
        }
        
        if(file_exists($ruta)){
            try{
                unlink($ruta);
            }catch(Exception $e){
                $mensaje = $mensaje . '. El documento no pudo ser eliminado fisicamente de nuestra plataforma.';
            }
        }

        return back()->with('status', $mensaje);
    }

    // Regresar a la vista que lo invocó
    public function regresar(Request $request){
        if($request->idPivote){
            $id = $request->idPivote;
            return redirect()->route('dashboard', $id);
        }else{
            return redirect($request->url_anterior);
        }
    }
}