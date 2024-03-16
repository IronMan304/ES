<?php

namespace App\Http\Livewire\Enrollment;

use App\Models\Level;
use App\Models\Course;
use App\Models\Status;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Enrollment;
use App\Models\StudentSubjectKey;

class EnrollmentForm extends Component
{
    public $enrollmentId, $student_id, $course_id, $level_id, $status_id;
    public $action = '';  //flash
    public $message = '';  //flash
    public $subjectItems = [];

    protected $listeners = [
        'enrollmentId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function enrollmentId($enrollmentId)
    {
        $this->enrollmentId = $enrollmentId;
        $enrollment = Enrollment::whereId($enrollmentId)->first();
        $this->student_id = $enrollment->student_id;
        $this->course_id = $enrollment->course_id;
        $this->level_id = $enrollment->level_id;
        $this->status_id = $enrollment->status_id;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'student_id' => 'required',
            'course_id' => 'nullable',
            'level_id' => 'required',
            'status_id' => 'nullable',
            'subjectItems' => 'nullable|array',
        ]);

        if ($this->enrollmentId) {
            Enrollment::whereId($this->enrollmentId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {

            Enrollment::create($data);

            Student::whereId($this->student_id)->update(['status_id' => 1]);

            $student = Student::find($this->student_id);
            $allSubjects = Subject::pluck('id');
            // Create new subject associations
            foreach ($allSubjects as $subjectId) {
                StudentSubjectKey::create([
                    'student_id' => $this->student_id,
                    'subject_id' => $subjectId,
                ]);
            }

            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeEnrollmentModal');
        $this->emit('refreshParentEnrollment');
        $this->emit('refreshTable');
    }

    public function render()
    {
        $students = Student::all();
        $courses = Course::all();
        $levels = Level::all();
        $statuses = Status::all();
        return view('livewire.enrollment.enrollment-form', [
            'students' => $students,
            'courses' => $courses,
            'levels' => $levels,
            'statuses' => $statuses,
        ]);
    }
}
