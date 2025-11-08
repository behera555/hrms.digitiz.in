<?php

namespace App\Http\Controllers\super_admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\ResponseHelper;
use App\Models\Businessunits;
use Validator,DB;
class SettingController extends Controller
{
    public function index(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'organization_name'=>'required',
                'organization_started_on'=>'required',
                'primary_phone_number'=>'required',
                'secondary_phone_number'=>'required',
                'fax_number'=>'required',
                'country'=>'required',
                'state'=>'required',
                'time'=>'required',
                'city'=>'required',
                'currency'=>'required',
                'address'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $result = '';
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    'organization_name' => $request->input('organization_name'),
                    'organization_started_on' => $request->input('organization_started_on'),
                    'primary_phone_number' => $request->input('primary_phone_number'),
                    'secondary_phone_number' => $request->input('secondary_phone_number'),
                    'fax_number' => $request->input('fax_number'),
                    'country' => $request->input('country'),
                    'state' => $request->input('state'),
                    'time' => $request->input('time'),
                    'city' => $request->input('city'),
                    'currency' => $request->input('currency'),
                    'address' => $request->input('address')
                );
                $affectedRows = Businessunits::where("id", 1)->update($update_arr);
                if($file = $request->hasFile('image')){
                    $get_image = Businessunits::first();
                    $path = public_path($get_image->org_logo);
                    @unlink($path);
                    $file = array();
                    $imageName = $request->file('image')->getClientOriginalName();
                    $destination =  'uploads/logo';
                    $update_arr['org_logo']= $request->file('image')->move($destination, $imageName);
                    $affectedRows = Businessunits::where("id", 1)->update($update_arr);
                }
                $message = array('success'=>array('Profile updated successfully!!'));
                $success = true;
            }
            return ResponseHelper::returnResponse(200,$success,$message);
        }else{
            $org_info = Businessunits::first();
            return view('super_admin.settings.index',compact('org_info'));
        }
    }
}
