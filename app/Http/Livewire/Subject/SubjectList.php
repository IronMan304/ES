<?php

namespace App\Http\Livewire\Subject;

use App\Models\Subject;
use Livewire\Component;

class SubjectList extends Component
{
    public $subjectId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentSubject' => '$refresh',
        'deleteSubject',
        'editSubject',
        'deleteConfirmSubject'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createSubject()
    {
        $this->emit('resetInputFields');
        $this->emit('openSubjectModal');
    }

    public function editSubject($subjectId)
    {
        $this->subjectId = $subjectId;
        $this->emit('subjectId', $this->subjectId);
        $this->emit('openSubjectModal');
    }

    public function deleteSubject($subjectId)
    {
        Subject::destroy($subjectId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $subjects  = Subject::all();
        } else {
            $subjects  = Subject::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.subject.subject-list', [
            'subjects' => $subjects
        ]);
    }
}
