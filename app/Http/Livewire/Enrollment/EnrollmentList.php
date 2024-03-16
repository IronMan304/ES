<?php

namespace App\Http\Livewire\Enrollment;

use App\Models\Enrollment;
use Livewire\Component;

class EnrollmentList extends Component
{
    public $enrollmentId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentEnrollment' => '$refresh',
        'deleteEnrollment',
        'editEnrollment',
        'deleteConfirmEnrollment'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createEnrollment()
    {
        $this->emit('resetInputFields');
        $this->emit('openEnrollmentModal');
    }

    public function editEnrollment($enrollmentId)
    {
        $this->enrollmentId = $enrollmentId;
        $this->emit('enrollmentId', $this->enrollmentId);
        $this->emit('openEnrollmentModal');
    }

    public function deleteEnrollment($enrollmentId)
    {
        Enrollment::destroy($enrollmentId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $enrollments  = Enrollment::all();
        } else {
            $enrollments  = Enrollment::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.enrollment.enrollment-list', [
            'enrollments' => $enrollments
        ]);
    }
}
