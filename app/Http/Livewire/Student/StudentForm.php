<?php

namespace App\Http\Livewire\Student;

use App\Models\Gender;
use Livewire\Component;
use App\Models\Student;

class StudentForm extends Component
{
    public $studentId, $id_number, $first_name, $middle_name, $last_name, $contact_number, $gender_id, $status_id;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'studentId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function studentId($studentId)
    {
        $this->studentId = $studentId;
        $student = Student::whereId($studentId)->first();
        $this->id_number = $student->id_number;
        $this->first_name = $student->first_name;
        $this->middle_name = $student->middle_name;
        $this->last_name = $student->last_name;
        $this->contact_number = $student->contact_number;
        $this->gender_id = $student->gender_id;
        $this->status_id = $student->status_id;
    }

    //store
    public function store()
    {
        $rules = [
            'id_number' => 'required|unique:students,id_number,' . $this->studentId,
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'contact_number' => 'required',
            'gender_id' => 'nullable',
            'status_id' => 'nullable',
        ];

        $data = $this->validate($rules);

        if ($this->studentId) {
            Student::whereId($this->studentId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Student::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeStudentModal');
        $this->emit('refreshParentStudent');
        $this->emit('refreshTable');
    }

    public function render()
    {
        $genders = Gender::all();
        // $courses = Course::where('college_id', $this->college_id)->get();
        return view('livewire.student.student-form', [
            'genders' => $genders,
        ]);
    }
}
