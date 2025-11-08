<?php

namespace App\Http\Controllers;

use Validator,Auth,DB;
use Illuminate\Http\Request;
use App\Facades\ResponseHelper;

class AddleaveController extends Controller
{
    
    public function index(){
        $leave_balance = DB::table('leave_balance')->get();  
             if(empty($leave_balance)){
                    $success = false;
                    $message = array('error'=>array('You have already applied for this event'));
                }else{
                    foreach($leave_balance as $key => $val){
                        $month = date('m');
                        $year = date('y');
                        $leave_balance = $val['leave_balance'] + 1.5;
                        $affectedRows = DB::table('leave_balance')->where("id", $val['id'])->update($leave_balance);
                    }
                    $success = true;
                    $message = array('success'=>array('You have successfully applied for this event'));
                }
           return  $response = ResponseHelper::returnResponse($response_code,$success,$message);
        }
    }



    

