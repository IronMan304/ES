<?php

namespace App\Http\Livewire\Subject;

use App\Models\Subject;
use Livewire\Component;

class SubjectForm extends Component
{
    public $subjectId, $name;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'subjectId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function subjectId($subjectId)
    {
        $this->subjectId = $subjectId;
        $subject = Subject::whereId($subjectId)->first();
        $this->name = $subject->name;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'name' => 'required',
        ]);

        if ($this->subjectId) {
            Subject::whereId($this->subjectId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Subject::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeSubjectModal');
        $this->emit('refreshParentSubject');
        $this->emit('refreshTable');
    }

    public function render()
    {
        return view('livewire.subject.subject-form');
    }
}
