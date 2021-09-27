<?php

namespace App\Http\Livewire\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactUs extends Component
{
    public $name;
    public $email;
    public $phone;
    public $contact_message;
    public function render()
    {
        return view('livewire.cms.contact-us')->layout('cms.layouts.master');
    }

    public function contactUsSubmit(){
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'contact_message' => 'required',
        ]);
        $info = [
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'contact_message'=>$this->contact_message,
            ];
        try {
            Mail::to('atifrazabhatti098@gmail.com')->send(new \App\Mail\ContactUs($info));
        }catch (\Exception $exception){
//            dd($exception->getMessage());
//            dd(Mail::failures());
        }
        return redirect(route('contact-us'))->with('success','Your query is submitted.');
    }
}
