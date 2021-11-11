<?php

namespace App\Http\Livewire;

use App\Models\Tree;
use Livewire\Component;

class TreeView extends Component
{
    public $idP;
    public $hijo_seleccionado;
    public $union_seleccionada;

    public function render()
    {
        $id = $this->idP;
        return view('livewire.tree-view', compact('id'));
    }

    public function cambiar_id_hijo(){
        $this->idP = $this->hijo_seleccionado;
        $this->hijo_seleccionado = null;
    }

    public function cambiar_id_union(){
        $this->idP = $this->union_seleccionada;
        $this->union_seleccionada = null;
    }

    public function cambiar_id($id){
        $this->idP = $id;
    }
}