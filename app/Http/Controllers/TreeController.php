<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crud.trees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tree = new Tree();
        $idPivote = $request->idPivote;
        $idHijo = $request->idHijo;
        $sexo = $request->sexo;
        $idPadre = $request->idPadre;

        return view('crud.trees.create', compact('tree', 'idPivote', 'idHijo', 'sexo', 'idPadre'));
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
            'nombres' => 'required|max:100',
            'apellido_padre' => 'nullable|max:100',
            'apellido_madre' => 'nullable|max:100',
            'id_padre' => 'nullable|numeric|min:1',
            'id_madre' => 'nullable|numeric|min:1',
            'sexo' => 'required',
            'file' => 'max:2048',         // 1024 = 1 MB
        ]);

        $tree = Tree::create($request->all());
        
        // Establecer id_padre o id_madre en el hijo
        if($request->idHijo){
            if($request->sexo == 'M'){
                Tree::find($request->idHijo)->update(['id_padre' => $tree->id ]);
            }else{
                Tree::find($request->idHijo)->update(['id_madre' => $tree->id ]);
            }
        }

        // Guardar foto
        $img_error = null;
        if($request->hasFile('file')){
            $file = $request->file("file");
            if($file->guessExtension() == 'jpg'){
                $nombre = $tree->id . "." . $file->guessExtension();
                $ruta = public_path("storage/assets/images/personas/".$nombre);
                copy($file, $ruta);
            }else{
                $img_error = '. La imagen debe estar en formato jpg.';
            }
        }
        
        // Regresar a la vista que invocó el método store
        if($request->idPivote){
            $id = $request->idPivote;
            return redirect()->route('dashboard', $id)->with('status', 'Persona ' . $tree->nombres . ' creada correctamente');
        }else{
            return redirect($request->url_anterior)->with('status', 'Persona ' . $tree->nombres . ' creada correctamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function show(Tree $tree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Tree $tree)
    {
        $idPivote = $request->idPivote;
        return view('crud.trees.edit', compact('tree', 'idPivote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tree $tree)
    {  
        $request->validate([
            'nombres' => 'required|max:100',
            'apellido_padre' => 'nullable|max:100',
            'apellido_madre' => 'nullable|max:100',
            'id_padre' => 'nullable|numeric|min:1',
            'id_madre' => 'nullable|numeric|min:1',
            'sexo' => 'required',
        ]);

        $tree->update($request->all());

        // Guardar foto
        $img_error = null;
        if($request->hasFile('file')){
            $file = $request->file("file");
            if($file->guessExtension() == 'jpg'){
                $nombre = $tree->id . "." . $file->guessExtension();
                $ruta = public_path("storage/assets/images/personas/".$nombre);
                /* dd($ruta); */
                copy($file, $ruta);
            }else{
                $img_error = '. La imagen debe estar en formato jpg.';
            }
        }
        
        // Regresar a la vista que invocó el método update
        $mensaje = 'Persona ' . $tree->nombres . ' actualizada correctamente' . $img_error;
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
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tree $tree)
    {
        // Borrar foto en caso de que exista
        $nombre = $tree->id . ".jpg";
        $ruta = public_path("storage/assets/images/personas/".$nombre);
        $mensaje = 'Persona ' . $tree->nombres . ' eliminada correctamente de la base de datos.';

        if(file_exists('storage/assets/images/personas/' . $tree->id . '.jpg')){
            try{
                unlink($ruta);
            }catch(Exception $e){
                $mensaje = $mensaje . '. La foto no pudo ser eliminada.';
            }
        }

        // Borrar persona de la base de datos
        $tree->delete();
        return back()->with('status', $mensaje);
    }
}