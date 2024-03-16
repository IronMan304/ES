<?php

namespace App\Http\Livewire\Level;

use App\Models\Level;
use Livewire\Component;

class LevelForm extends Component
{
    public $levelId, $name;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'levelId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function levelId($levelId)
    {
        $this->levelId = $levelId;
        $level = Level::whereId($levelId)->first();
        $this->name = $level->name;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'name' => 'required',
        ]);

        if ($this->levelId) {
            Level::whereId($this->levelId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Level::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeLevelModal');
        $this->emit('refreshParentLevel');
        $this->emit('refreshTable');
    }

    public function render()
    {
        return view('livewire.level.level-form');
    }
}
