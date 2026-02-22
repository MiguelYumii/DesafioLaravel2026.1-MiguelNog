<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Symfony\Component\Mime\Header\MailboxListHeader;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');



    }



   public function store(Request $request) 
    {
        $sent = Mail::to($request->input('user_email'))->send(new Contact([
            'fromName' => $request->input('user_name'),
            'fromEmail' => $request->input('user_email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]));

        return redirect()->back()->with('success', 'E-mail enviado com sucesso');
    }
    
}
