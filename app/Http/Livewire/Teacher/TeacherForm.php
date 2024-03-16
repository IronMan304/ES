<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Gender;
use Livewire\Component;
use App\Models\Teacher;

class TeacherForm extends Component
{
    public $teacherId, $id_number, $first_name, $middle_name, $last_name, $contact_number, $gender_id, $status_id;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        '$teacherId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function teacherId($teacherId)
    {
        $this->$teacherId = $teacherId;
        $teacher = Teacher::whereId($teacherId)->first();
        $this->id_number = $teacher->id_number;
        $this->first_name = $teacher->first_name;
        $this->middle_name = $teacher->middle_name;
        $this->last_name = $teacher->last_name;
        $this->contact_number = $teacher->contact_number;
        $this->gender_id = $teacher->gender_id;
        $this->status_id = $teacher->status_id;
    }

    //store
    public function store()
    {
        $rules = [
            'id_number' => 'required|unique:teachers,id_number,' . $this->teacherId,
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'contact_number' => 'required',
            'gender_id' => 'nullable',
            'status_id' => 'nullable',
        ];

        $data = $this->validate($rules);

        if ($this->teacherId) {
            Teacher::whereId($this->teacherId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Teacher::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeTeacherModal');
        $this->emit('refreshParentTeacher');
        $this->emit('refreshTable');
    }

    public function render()
    {
        $genders = Gender::all();
        // $courses = Course::where('college_id', $this->college_id)->get();
        return view('livewire.teacher.teacher-form', [
            'genders' => $genders,
        ]);
    }
}
