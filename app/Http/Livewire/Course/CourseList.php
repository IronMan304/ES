<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class CourseList extends Component
{
    public $courseId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentCourse' => '$refresh',
        'deleteCourse',
        'editCourse',
        'deleteConfirmCourse'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createCourse()
    {
        $this->emit('resetInputFields');
        $this->emit('openCourseModal');
    }

    public function editCourse($courseId)
    {
        $this->courseId = $courseId;
        $this->emit('courseId', $this->courseId);
        $this->emit('openCourseModal');
    }

    public function deleteCourse($courseId)
    {
        Course::destroy($courseId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $courses  = Course::all();
        } else {
            $courses  = Course::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.course.course-list', [
            'courses' => $courses
        ]);
    }
}
