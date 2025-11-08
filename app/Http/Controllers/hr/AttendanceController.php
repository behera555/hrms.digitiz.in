<?php

namespace App\Http\Controllers\hr;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Validator,Auth,DB;
use Carbon\Carbon;
use App\Facades\ResponseHelper;

class AttendanceController extends Controller {
    function employeer_attendance(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'user_id'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $time = DB::table('businessunits')->where(['id' => 1])->pluck('time')->first();
                $attendance = new Attendance();
                $attendance->user_id = auth()->user()->id;
                $attendance->login_date = date('Y-m-d');
                if($time == date('H:i:s')){
                    $attendance->login_time = date('H:i:s');
                }else{
                    $attendance->login_time = date('H:i:s');
                    $attendance->last_login = 1;
                }
                $attendance->created_at = date('Y-m-d H:i:s');
                $attendance->save();
                $success = true;
                $message = array('success'=>array('Department added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $from = Carbon::parse('2023-04-01');
        $to = Carbon::parse('2023-04-30');
        $days_count = $to->diffInWeekdays($from);
        $attendance = Attendance::where('login_date', date('Y-m-d'))->where('user_id', auth()->user()->id)->first();
        $attendance_all = Attendance::where('user_id', auth()->user()->id)->get();
        $no_of_hours  = Attendance::where('login_date', date('Y-m-d'))->where('user_id', auth()->user()->id)->selectRaw("SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(logout_time,login_time) )) ) as 'total'")->first();
        return view('employee.attendance.index',compact('days_count','attendance','no_of_hours','attendance_all'));
    }
function attendance_edit_hr(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                //'name'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    //'user_id' => auth()->user()->id,
                    'login_date' => $data['login_date'],
                    'logout_time' => $data['logout_time'],
                    'login_time' => $data['login_time'],
                    'updated_at' =>    date('Y-m-d H:i:s'),
                );
                $affectedRows = Attendance::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Attendance added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $attendance = Attendance::where('id','=',$id)->first();
        //$user = User::where(['id' => $attendance->user_id])->pluck('name')->first();
        $no_of_hours  = Attendance::where('login_date', date('Y-m-d'))->where('user_id', auth()->user()->id)->selectRaw("SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(logout_time,login_time) )) ) as 'total'")->first();
        
        return view('employee.attendance.employee-attendance-edit',compact('attendance','no_of_hours'));
      }
    public function employeer_attendance_edit(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'user_id'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    'user_id' => auth()->user()->id,
                    'logout_date' => date('Y-m-d'),
                    'logout_time' => date('H:i:s'),
                    'updated_at' =>    date('Y-m-d H:i:s'),
                );
                $affectedRows = Attendance::where('login_date', date('Y-m-d'))->where("user_id", auth()->user()->id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Award updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
    }

    function employees_attendance_list(Request $request){
        $user = Attendance::query();
        if (!empty($request->user_id)) {
            $attendance = Attendance::where('user_id', $request->user_id)->whereBetween('login_date',[$request->start_from, $request->end_to])->paginate(30);
    }else{
        $attendance = Attendance::where('login_date', date('Y-m-d'))->paginate(10);
    }
    $employees = User::whereIn('type', [2,3])->get();
   
    return view('employee.attendance.employees_attendance_report',compact('attendance','employees'));
    }
    
    function add_attendance(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
               'user_id'=>'required',
               'login_date'=>'required',
               'login_time'=>'required',
               'logout_time'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $insert_array = array(
                    "user_id" => $data['user_id'],
                    "login_date" => $data['login_date'],
                    "login_time" => $data['login_time'],
                    //"logout_date" => $data['logout_date'],
                    "logout_time" => $data['logout_time'],
                    "created_at" => date('Y-m-d H:i:s'),
                );
                DB::table('attendances')->insert($insert_array);
                $success = true;
                $message = array('success'=>array('Attendance added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        return view('employee.attendance.add-attendance',compact('employees'));
    }
    function destroy_attendance(Request $request, $id){
        if ($request->ajax()){
            $attendance = DB::table('attendances')->where('id','=',$id)->get();
            if ($attendance){
                $attendance = DB::table('attendances')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }

}
