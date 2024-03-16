<?php

namespace App\Http\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class StudentList extends Component
{
    use withPagination;
    protected $paginationTheme = 'bootstrap';
    public $studentId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash
    public $perPage = 10;

    protected $listeners = [
        'refreshParentStudent' => '$refresh',
        'refreshParentStudentAccount' => '$refresh',
        'refreshParentGrade' => '$refresh',
        'deleteStudent',
        'editStudent',
        'deleteConfirmStudent'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createStudentAccount($studentId)
    {
        $this->studentId = $studentId;
        $this->emit('resetInputFields');
        $this->emit('studentId', $this->studentId);
        $this->emit('openStudentAccountModal');
    }

    public function createStudent()
    {
        // $Student = Student::with([
        //     'sex',
        //     'college',
        //     'course',
        //     'status',
        // ])
        // ->first();
        
        // dd($Student);
        $this->emit('resetInputFields');
        $this->emit('openStudentModal');
    }

    public function editStudent($studentId)
    {
        $this->studentId = $studentId;
        $this->emit('studentId', $this->studentId);
        $this->emit('openStudentModal');
    }

    public function grade($studentId)
    {
        $this->studentId = $studentId;
        $this->emit('studentId', $this->studentId);
        $this->emit('openGradeModal');
    }

    public function deleteStudent($studentId)
    {
        Student::destroy($studentId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $students  = Student::with('subjects')->paginate($this->perPage);
        } else {
            $students  = Student::with('subjects')->where('first_name', 'LIKE', '%' . $this->search . '%')->paginate($this->perPage);
        }

        // $borrower = Borrower::with('sex')->get();

        return view('livewire.student.student-list', [
            'students' => $students,
            // "borrower" => $borrower
        ]);
    }
}
