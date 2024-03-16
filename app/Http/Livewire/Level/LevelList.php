<?php

namespace App\Http\Livewire\Level;

use App\Models\Level;
use Livewire\Component;

class LevelList extends Component
{
    public $levelId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentLevel' => '$refresh',
        'deleteLevel',
        'editLevel',
        'deleteConfirmLevel'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createLevel()
    {
        $this->emit('resetInputFields');
        $this->emit('openLevelModal');
    }

    public function editLevel($levelId)
    {
        $this->levelId = $levelId;
        $this->emit('levelId', $this->levelId);
        $this->emit('openLevelModal');
    }

    public function deleteLevel($levelId)
    {
        Level::destroy($levelId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $levels  = Level::all();
        } else {
            $levels  = Level::where('name', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.level.level-list', [
            'levels' => $levels
        ]);
    }
}
