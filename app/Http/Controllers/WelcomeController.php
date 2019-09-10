<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WelcomeController extends Controller
{
    public function contactUs(Request $request) {

        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new ContactUs($request));

        return redirect()->route('welcome');
    }
}
