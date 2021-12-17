<?php

namespace App\Http\Livewire\Customer;

use App\Models\ApplyLoan;
use App\Mail\EmailVerify;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $old_password;
    public $password;
    public $confirm_password;
    public $errorMessage;
    public $message;
    public $status;
    public $user;
    public $user_enquiries;

    public function mount()
    {   
        $this->user = Auth::user();
        $this->user_enquiries = ApplyLoan::where('user_id',$this->user->id)->count();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->status = $this->user->status;
    }
    public function render()
    {
     
        // dd($this->user->last_name);
        return view('livewire.customer.profile')->layout('customer.layouts.master');
    }

    public function updateProfile()
    {

        if ($this->user->id) {
            $record = User::find($this->user->id);
            $updated = $record->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
            ]);

            $this->updateMode = false;
        }

        if($updated){
            $this->message = 'Profile Updated';
            return;
        }else{
            $this->errorMessage = 'Profile Not Update';
            return;
        }

    }

    public function updatePassword()
    {

        $this->validate([
            'old_password' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
           'confirm_password' => 'required|same:password',
        ]);

        // dd($this->user);

        if (Hash::check($this->old_password , $this->user->password)){
            $password = Hash::make($this->password);
            if (Auth::guard('web')){
                User::where('id','=',$this->user->id)->update(['password'=>$password]);

                $this->message = 'password update';
                return;
            }
            
        }else{
            $this->errorMessage = 'old password is not correct';
            return;
        }
      
    }


}
