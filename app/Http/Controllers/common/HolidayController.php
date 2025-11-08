<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holidays;
use Validator,Auth;
use App\Facades\ResponseHelper;


class HolidayController extends Controller
{
    function index(Request $request){
        $holidays = Holidays::query()->paginate(5);
        if($request->ajax()){
            $holidays = Holidays::query()
            ->when($request->seach_term, function($q)use($request){
                $q->where('holiday_name', 'like', '%'.$request->serach.'%');
            })->paginate(5);   
            return view('pagination_child', compact('holidays'))->render(); 
        }
    return view('common.holiday.index',compact('holidays'));
    }

     function add(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'holiday_date'=>'required',
                'holiday_name'=>'required|unique:holiday',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $holidays = new Holidays();
                $holidays->holiday_name = $data['holiday_name'];
                $holidays->holiday_date =  date('Y-m-d', strtotime($data['holiday_date']));
                $holidays->created_at = date('Y-m-d H:i:s');
                $holidays->created_by = auth()->user()->id;
                $holidays->save();
                $success = true;
                $message = array('success'=>array('Holidays added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        return view('common.holiday.add');
     }
     
     function edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
               'holiday_date'=>'required',
               'holiday_name'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    'holiday_name' => $request->input('holiday_name'),
                    'holiday_date' => $request->input('holiday_date'),
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = Holidays::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Holidays added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
         $holidays = Holidays::where('id','=',$id)->select('id','holiday_name','holiday_date')->first();
         return view('common.holiday.edit',compact('holidays'));
     }
    function destroy(Request $request, $id){
        if ($request->ajax()){
            $holidays = Holidays::findOrFail($id);
            if ($holidays){
                $holidays->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
