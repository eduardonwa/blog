<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMe;
use Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function incoming(Request $request)
    {
        $incomingMail = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Mail::to('eduardongua@gmail.com')->send(new ContactMe($incomingMail));

        return redirect('/contact')
            ->with('message', 'Email sent');
    }

}
