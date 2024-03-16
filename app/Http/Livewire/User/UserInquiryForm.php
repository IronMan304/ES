<?php

namespace App\Http\Livewire\User;

use App\Models\Company;
use App\Models\User;
use App\Models\UserInquiry;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserInquiryForm extends Component
{
    public $userId, $company_id;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'userId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function userId($userId)
    {
        $this->userId = $userId;
        $user = UserInquiry::where('user_id', $this->userId)->first();
        if ($user) {
            $this->company_id = $user->company_id;
        }
    }

    //store
    public function store()
    {
        try {
            DB::beginTransaction();

            $data = $this->validate([
                'company_id' => 'required'
            ]);
            $data['user_id'] = $this->userId;

            $user = UserInquiry::where('user_id', $this->userId)->first();


            if ($user) {
                $user->update($data);

                $action = 'edit';
                $message = 'Successfully Updated';
            } else {

                $user = UserInquiry::create($data);

                $action = 'store';
                $message = 'Successfully Created';
            }

            DB::commit();

            $this->emit('flashAction', $action, $message);
            $this->resetInputFields();
            $this->emit('closeUserInquiryModal');
            $this->emit('refreshParentUser');
            $this->emit('refreshTable');
        } catch (Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();
            $this->emit('flashAction', 'error', $errorMessage);
        }
    }
    public function render()
    {
        $companies = Company::all();
        return view('livewire.user.user-inquiry-form', [
            'companies' => $companies
        ]);
    }
}
