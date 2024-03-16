<?php

namespace App\Http\Livewire\Student;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Component;
use App\Models\StudentSubjectKey;

class GradeForm extends Component
{
    public $studentId, $id_number, $first_name, $middle_name, $last_name, $contact_number, $gender_id, $status_id;
    public $action = '';  //flash
    public $message = '';  //flash
    public $firstGradingGrades = [];
    public $secondGradingGrades = [];
    public $thirdGradingGrades = [];
    public $fourthGradingGrades = [];
    public $subjectItems = [];
    public $subjectIds = [];

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
        $this->subjectItems = $student->subjects->pluck('subject_id')->toArray();
        $this->subjectIds = $student->subjects->pluck('id')->toArray();
        foreach ($student->subjects as $subject) {
            // Assuming firstGradingGrades is an associative array where keys are subject IDs
            // and values are the first grading grades
            $this->firstGradingGrades[$subject->id] = $subject->first_grading_grade;
        }
    }

    //store
    public function store()
    {


        if ($this->studentId) {
            //Student::whereId($this->studentId)->first()->update($data);

            //$student = Student::find($this->student_id);
            // Loop through grades and update/create StudentSubjectKey records
            foreach ($this->firstGradingGrades as $subjectId => $grade) {
                $studentSubjectKey = StudentSubjectKey::updateOrCreate(
                    ['student_id' => $this->studentId, 'subject_id' => $subjectId],
                    ['first_grading_grade' => $grade]
                );
            }
            $action = 'edit';
            $message = 'Successfully Updated';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeGradeModal');
        $this->emit('refreshParentGrade');
        $this->emit('refreshTable');
    }

    public function render()
    {

        // $courses = Course::where('college_id', $this->college_id)->get();
        $subjectIds = Subject::all();
        return view('livewire.student.grade-form', [
            'subjectIds' => $this->subjectIds,
        ]);
    }
}
