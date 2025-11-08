<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator,Auth;
use App\Facades\ResponseHelper;
class ProfileController extends Controller
{
    function index(){

        return view('profile.index');
    }

    function change_password(Request $request){
        if($request->isMethod('post')){
            $success = false ;
            $data = $request->all();
            $message = array('error'=>array('something went wrong')) ;
            $rules = [
                'old_password'=>'required',
                'new_password'=>'required|min:6',
                'confirm_password'=>'required|min:6',
             ];
             $validator = Validator::make($data,$rules);
             if($validator->fails()){
                 $success = false;
                 $result = '';
                 $message = $validator->errors();
             }else{
                 if(Hash::check($data['old_password'], auth()->user()->password)){
                    if($data['new_password'] == $data['confirm_password']){
                        $user = User::find(auth()->user()->id);
                        $user->password = Hash::make($data['new_password']);
                        $user->hit_password = $data['new_password'];
                        if($user->save()){
                            $success = true;
                            $message = array('success'=>array('Password changed successfully.'));
                        }else{
                            $success = false;
                            $message = array('error'=>array('Unable to change password.'));
                        }
                    }else{
                        $success = false;
                        $message = array('error'=>array('New password and confirm password does not match.'));
                    }
                 }else{
                    $success = false;
                    $message = array('error'=>array('Old password does not match.'));
                 }
             }
            return ResponseHelper::returnResponse(200,$success,$message);
        }
    }
}
