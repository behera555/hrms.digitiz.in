<?php

namespace App\Http\Controllers;

use App\Models\Allowip;
use Validator,Auth,DB;
use Mail;
use Illuminate\Http\Request;
use App\Facades\ResponseHelper;

class CronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Mail::send('emails.send-code-reset-password', function($message) use($request){
            $message->to('seshu.forgealumnus@gmail.com');
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $message->subject('Reset Password');
        });
    }

    
}
