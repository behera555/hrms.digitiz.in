<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leaves;
use App\Models\Applyleaves;
use Validator,Auth,DB;
use Carbon;
use App\Facades\ResponseHelper;

class LeavesController extends Controller
{
   function index(Request $request){
      $leaves = Leaves::query()->paginate(5);
      if($request->ajax()){
          $leaves = Leaves::query()
          ->when($request->seach_term, function($q)use($request){
              $q->where('holiday_name', 'like', '%'.$request->serach.'%');
          })->paginate(5);   
          return view('pagination_child', compact('holidays'))->render(); 
      }
    return View('common.leaves.index',compact('leaves'));
   }
   function add(Request $request){
      if($request->isMethod('post')){
         $response_code = 200;
         $message = array('error'=>array('something went wrong'));
         $success = false ;
         $data = $request->all();
         $rules=[
             'type_of_leaves'=>'required',
             'number_of_days'=>'required',
         ];
         $validator = Validator::make($data,$rules);
         if($validator->fails()){
             $success = false;
             $message = $validator->errors();
         }else{
             $leaves = new Leaves();
             $leaves->type_of_leaves = $data['type_of_leaves'];
             $leaves->number_of_days = $data['number_of_days'];
             $leaves->created_at = date('Y-m-d H:i:s');
             $leaves->created_by = auth()->user()->id;
             $leaves->save();
             $success = true;
             $message = array('success'=>array('Holidays added successfully'));
         }
      return ResponseHelper::returnResponse(200,$success,$message);
     }
      
      return View('common.leaves.add');
   }
   function edit(Request $request, $id){
      if($request->isMethod('post')){
         $response_code = 200;
         $message = array('error'=>array('something went wrong'));
         $success = false ;
         $data = $request->all();
         $rules=[
            'type_of_leaves'=>'required',
            'number_of_days'=>'required',
         ];
         $validator = Validator::make($data,$rules);
         if($validator->fails()){
             $success = false;
             $message = $validator->errors();
         }else{
             $update_arr = array(
                 'type_of_leaves' => $request->input('type_of_leaves'),
                 'number_of_days' => $request->input('number_of_days'),
                 'updated_at' =>    date('Y-m-d H:i:s'),
                 'updated_by' => auth()->user()->id,
             );
             $affectedRows = Leaves::where("id", $id)->update($update_arr);
             $success = true;
             $message = array('success'=>array('Designtion added successfully'));
         }
     return ResponseHelper::returnResponse(200,$success,$message);
     }
      $leaves = Leaves::where('id','=',$id)->select('id','type_of_leaves','number_of_days')->first();
      return View('common.leaves.edit',compact('leaves'));
   }


   function destroy(Request $request, $id){
      if ($request->ajax()){
          $leaves = Leaves::findOrFail($id);
          if ($leaves){
              $leaves->delete();
              return response()->json(array('success' => true));
          }
      }
  }


  function apply_leaves(Request $request){
    $leave_balance = DB::table('leave_balance')->select('leave_balance')->where('emp_id','=',auth()->user()->emp_id)->first();
    return View('common.leaves.apply_leaves',compact('leave_balance'));
  }

  function apply_leaves_list(Request $request){
    $apply_leave = Applyleaves::query()->where('emp_id','=',auth()->user()->emp_id)->paginate(5);
      if($request->ajax()){
          $apply_leave = Applyleaves::query()
          ->when($request->seach_term, function($q)use($request){
              $q->where('holiday_name', 'like', '%'.$request->serach.'%');
          })->paginate(5);   
          return view('pagination_child', compact('holidays'))->render(); 
      }
    return View('common.leaves.apply_leaves_list',compact('apply_leave'));
  }


  function apply_leaves_post(Request $request){
    if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            if($data['leaves_dates'] == 'single'){
                $rules=[
                    'leaves_dates'=>'required',
                    'single_start_date'=>'required',
                    'reason'=>'required',
                    'day_type'=> 'required|in:Full_Day,First_Half,Second_Half',
                ];
             }else{
                $rules=[
                    'reason'=>'required',
                    'end_date'=>'required',
                    'start_date'=>'required',
                    'leaves_dates'=>'required',
                ];
             }
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $apply_leaves = new Applyleaves();
                if($data['leaves_dates'] == 'single'){
                    $apply_leaves->emp_id = auth()->user()->emp_id;
                    $apply_leaves->start_date = $data['single_start_date'];
                    $apply_leaves->end_date = $data['single_start_date'];
                    $apply_leaves->day_type = $data['day_type'];
                    $apply_leaves->leave_balance = $data['leave_balance'];
                    $apply_leaves->reason = $data['reason'];
                    $apply_leaves->leave_status_reason = "Pending";
                }else{
                    $apply_leaves->emp_id = auth()->user()->emp_id;
                    $apply_leaves->start_date = $data['start_date'];
                    $apply_leaves->end_date = $data['end_date'];
                    $apply_leaves->leave_balance = $data['leave_balance'];
                    $apply_leaves->reason = $data['reason'];
                    $apply_leaves->leave_status_reason = "Pending";
                }
                $apply_leaves->created_at = date('Y-m-d H:i:s');
                $apply_leaves->created_by = auth()->user()->id;
                $apply_leaves->save();
                $success = true;
                $message = array('success'=>array('Leaves added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
  }
  
  function employees_apply_leaves_list(Request $request){
    $apply_leave = Applyleaves::query()->where('emp_id','!=','FASE002')->paginate(5);
      if($request->ajax()){
          $apply_leave = Applyleaves::query()
          ->when($request->seach_term, function($q)use($request){
              $q->where('holiday_name', 'like', '%'.$request->serach.'%');
          })->paginate(5);   
          return view('pagination_child', compact('holidays'))->render(); 
      }
    return View('common.leaves.employees_apply_leaves_list',compact('apply_leave'));
  }

  function employees_apply_leaves_edit(Request $request, $id){
    if($request->isMethod('post')){
       $response_code = 200;
       $message = array('error'=>array('something went wrong'));
       $success = false ;
       $data = $request->all();
       $rules=[
          'leave_status'=>'required',
          'leave_status_reason'=>'required',
       ];
       $validator = Validator::make($data,$rules);
       if($validator->fails()){
           $success = false;
           $message = $validator->errors();
       }else{
           $update_apply_leaves = array(
               'leave_status' => $request->input('leave_status'),
               'leave_status_reason' => $request->input('leave_status_reason'),
               'updated_at' =>    date('Y-m-d H:i:s'),
               'updated_by' => auth()->user()->id,
           );
           $affectedRows = Applyleaves::where("id", $id)->update($update_apply_leaves);
           $success = true;
           $message = array('success'=>array('Designtion added successfully'));
       }
   return ResponseHelper::returnResponse(200,$success,$message);
   }
    $leaves = Applyleaves::where('id','=',$id)->first();
    return View('common.leaves.employees_leaves_edit',compact('leaves'));
 }
}
