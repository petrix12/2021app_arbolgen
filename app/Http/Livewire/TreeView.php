<?php

namespace App\Http\Livewire;

use App\Models\Tree;
use Livewire\Component;

class TreeView extends Component
{
    public $idP;

    public function render()
    {
        $id = $this->idP;
        $trees = Tree::all();
        return view('livewire.tree-view', compact('trees', 'id'));
    }
}
