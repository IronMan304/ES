<?php

namespace App\Http\Livewire\Student;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\User;
use Livewire\Component;

class StudentAccountForm extends Component
{
    public $user_id, $studentId, $last_name, $first_name, $middle_name, $email, $password;
    public $action = '';  //flash
    public $message = '';  //flash
    public $showButton = true;
    protected $listeners = [
        'studentId',
        'resetInputFields',

    ];
    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    public function studentId($studentId)
    {
        $this->studentId = $studentId;
        $student = Student::whereId($studentId)->first();
        $this->first_name = $student->first_name;
        $this->middle_name = $student->middle_name;
        $this->last_name = $student->last_name;
        $this->email = strtolower($this->first_name . $this->last_name . "@gmail.com");
        $this->email = str_replace(' ', '', $this->email);
        $this->password = Str::random(8); // Generate a random passcode of length 8
    }
        //store
        public function store()
        {
            $data = $this->validate([
                'last_name' => 'required',
                'first_name' =>  'required',
                'middle_name' =>  'nullable',
                // 'username' =>  'required',
                //'position' => 'required',
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'min:6']
            ]);

            $student = Student::find($this->studentId);
    
           // Concatenate and convert to lowercase
            $user = User::create([
                'id' => $this->user_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
    
            // Assign the "requester" role to the user
            $user->assignRole('student');
    
            // Update the user_id field in the Student model
            $student->user_id = $user->id; // Set the user_id to the ID of the newly created user
            $student->save(); // Save the changes to the Student record

            $action = 'store';
            $message = 'Account Successfully Created';
            $this->emit('flashAction', $action, $message);
            $this->resetInputFields();
            $this->emit('closeStudentAccountModal');
            $this->emit('refreshParentStudentAccount');
            $this->emit('refreshTable');
            //$this->reset();
        }
    public function render()
    {
        $studentId = $this->studentId;
        return view('livewire.student.student-account-form', [
            'studentId' => $studentId,
        ]);
    }
}
