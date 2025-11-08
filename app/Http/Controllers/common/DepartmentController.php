<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Validator,Auth;
use App\Facades\ResponseHelper;

class DepartmentController extends Controller{
    function index(Request $request){
    $department = Department::query()->paginate(5);
     return view('common.department.index',compact('department'));
   }

    function add(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'department_name'=>'required|unique:department',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $department = new Department();
                $department->department_name = $data['department_name'];
                $department->created_at = date('Y-m-d H:i:s');
                $department->created_by = auth()->user()->id;
                $department->save();
                $success = true;
                $message = array('success'=>array('Department added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        return view('common.department.add');
    }


    function edit(Request $request, $id){
        if($request->isMethod('post')){
        $response_code = 200;
        $message = array('error'=>array('something went wrong'));
        $success = false ;
        $data = $request->all();
        $rules=[
            'department_name'=>'required'
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            $success = false;
            $message = $validator->errors();
        }else{
            $update_arr = array(
                'department_name' => $request->input('department_name'),
                'updated_at' =>    date('Y-m-d H:i:s'),
                'updated_by' => auth()->user()->id,
            );
            $affectedRows = Department::where("id", $id)->update($update_arr);
            $success = true;
            $message = array('success'=>array('Department added successfully'));
        }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $department = Department::where('id','=',$id)->first();
        return view('common.department.edit',compact('department'));
        }


   function destroy(Request $request, $id){
        if ($request->ajax()){
            $department = Department::findOrFail($id);
            if ($department){
                $department->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
