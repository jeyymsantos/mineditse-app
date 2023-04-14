<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\FeedbackMail;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    public function SendFeedback(Request $req)
    {
        $name = $req->name;
        $email = $req->email;
        $subject = $req->subject;
        $message = $req->message;

        Mail::to($email)
            ->send(new FeedbackMail($name, $subject));

        return redirect()->back();
    }
}
