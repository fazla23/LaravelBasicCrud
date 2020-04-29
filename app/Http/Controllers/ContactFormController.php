<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactFormController extends Controller
{
    public function create(){
        return view('contact.create');
    }

    public function store(){
        $data = request()->validate([
            'name'=>'required',
            'email'=>'required | email',
            'message'=>'required',
        ]);

        //Send an email
        Mail::to('xcellofer@gmail.com')->send(new ContactFormMail($data));
        
           // session()->flash('message','Thanks for your message . We\'ll be in touch.'); //This line is same as the with below

        return redirect('contact')->with('message','Thanks for your message . We\'ll be in touch.');
    }
}
