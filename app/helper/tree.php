<?php

use App\Models\Tree;

// Verifica si una persona existe
function existePersona($id){
    return Tree::find($id);
}