<?php

namespace App\Http\Livewire\Teacher;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Teacher;
use App\Models\User;
use Livewire\Component;

class TeacherAccountForm extends Component
{
    public $user_id, $teacherId, $last_name, $first_name, $middle_name, $email, $password;
    public $action = '';  //flash
    public $message = '';  //flash
    public $showButton = true;
    protected $listeners = [
        'teacherId',
        'resetInputFields',

    ];
    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    public function teacherId($teacherId)
    {
        $this->teacherId = $teacherId;
        $teacher = Teacher::whereId($teacherId)->first();
        $this->first_name = $teacher->first_name;
        $this->middle_name = $teacher->middle_name;
        $this->last_name = $teacher->last_name;
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

            $teacher = Teacher::find($this->teacherId);
    
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
            $user->assignRole('teacher');
    
    
    
            // Update the user_id field in the Teacher model
            $teacher->user_id = $user->id; // Set the user_id to the ID of the newly created user
            $teacher->save(); // Save the changes to the Teacher record

          
    
            $action = 'store';
            $message = 'Account Successfully Created';
            $this->emit('flashAction', $action, $message);
            $this->resetInputFields();
            $this->emit('closeTeacherAccountModal');
            $this->emit('refreshParentTeacherAccount');
            $this->emit('refreshTable');
            //$this->reset();
        }
    public function render()
    {
        $teacherId = $this->teacherId;
        return view('livewire.teacher.teacher-account-form', [
            'teacherId' => $teacherId,
        ]);
    }
}
