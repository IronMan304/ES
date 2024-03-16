<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherList extends Component
{
    use withPagination;
    protected $paginationTheme = 'bootstrap';
    public $teacherId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash
    public $perPage = 10;

    protected $listeners = [
        'refreshParentTeacher' => '$refresh',
        'refreshParentTeacherAccount' => '$refresh',
        'deleteTeacher',
        'editTeacher',
        'deleteConfirmTeacher'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createTeacherAccount($teacherId)
    {
        $this->teacherId = $teacherId;
        $this->emit('resetInputFields');
        $this->emit('teacherId', $this->teacherId);
        $this->emit('openTeacherAccountModal');
    }

    public function createTeacher()
    {
        // $Teacher = Teacher::with([
        //     'sex',
        //     'college',
        //     'course',
        //     'status',
        // ])
        // ->first();
        
        // dd($Teacher);
        $this->emit('resetInputFields');
        $this->emit('openTeacherModal');
    }

    public function editTeacher($teacherId)
    {
        $this->teacherId = $teacherId;
        $this->emit('teacherId', $this->teacherId);
        $this->emit('openTeacherModal');
    }

    public function deleteTeacher($teacherId)
    {
        Teacher::destroy($teacherId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $teachers  = Teacher::paginate($this->perPage);
        } else {
            $teachers  = Teacher::where('first_name', 'LIKE', '%' . $this->search . '%')->paginate($this->perPage);
        }

        // $borrower = Borrower::with('sex')->get();

        return view('livewire.teacher.teacher-list', [
            'teachers' => $teachers,
            // "borrower" => $borrower
        ]);
    }
}
