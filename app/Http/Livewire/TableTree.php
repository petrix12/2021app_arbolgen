<?php

namespace App\Http\Livewire;

use App\Models\Tree;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TableTree extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => '15']
    ];

    public $search = '';
    public $perPage = '15';

    public function render()
    {
        $trees = Tree::where('nombres','LIKE',"%$this->search%")
            ->orWhere('apellido_padre','LIKE',"%$this->search%")
            ->orWhere('apellido_madre','LIKE',"%$this->search%")
            ->orWhere('lugar_nac','LIKE',"%$this->search%")
            ->orWhere('lugar_matr','LIKE',"%$this->search%")
            ->orWhere('lugar_def','LIKE',"%$this->search%")
            ->orWhere('observaciones','LIKE',"%$this->search%")
            ->orWhere('id','LIKE',"%$this->search%")
            ->orWhere(DB::raw("CONCAT(nombres,' ',apellido_padre,' ',apellido_madre)"), 'LIKE',"%$this->search%")
            ->orderBy('id','ASC')
            ->paginate($this->perPage);
        return view('livewire.table-tree', compact('trees'));
    }

    public function clear(){
        $this->search = '';
        $this->page = 1;
        $this->perPage = '15';
    }

    public function limpiar_page(){
        $this->reset('page');
    }
}