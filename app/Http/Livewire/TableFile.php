<?php

namespace App\Http\Livewire;

use App\Models\File;
use Livewire\Component;
use Livewire\WithPagination;

class TableFile extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => '15']
    ];

    public $search = '';
    public $perPage = '15';
    public $tree_id;

    public function render()
    {
        if($this->tree_id == -1){
            $files = File::where('nombre','LIKE',"%$this->search%")
                ->orWhere('ruta','LIKE',"%$this->search%")
                ->orWhere('tree_id','LIKE',"%$this->search%")
                ->orderBy('id','ASC')
                ->paginate($this->perPage);
        }else{
            $files = File::where('tree_id','LIKE',$this->tree_id)
                ->where('nombre','LIKE',"%$this->search%")
                ->orderBy('id','ASC')
                ->paginate($this->perPage);
        }

        return view('livewire.table-file', compact('files'));
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