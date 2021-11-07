<?php

use App\Models\Tree;

// Verifica si una persona existe
function existePersona($id){
    return Tree::find($id);
}

// Obtener nombres
function GetNombres($id){
    try{
        return Tree::find($id)->nombres;
    }catch(Exception $e){
        return null;
    }
}

// Obtener apellidos
function GetApellidos($id){
    try{
        return Tree::find($id)->apellido_padre . ' ' . Tree::find($id)->apellido_madre;
    }catch(Exception $e){
        return null;
    }
}

// Obtener datos completos de matrimonio
function GetDatosMatrimonio($id){
    return Tree::find($id)->lugar_matr . ' ' . Tree::find($id)->apellido_madre;
}