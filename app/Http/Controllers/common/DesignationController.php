<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use Validator,Auth;
use App\Facades\ResponseHelper;

class DesignationController extends Controller{
    function index(Request $request){
     $designtion = Designation::query()->paginate(5);
     return view('common.designation.index',compact('designtion'));
   }
      
   function add(Request $request){
    if($request->isMethod('post')){
        $response_code = 200;
        $message = array('error'=>array('something went wrong'));
        $success = false ;
        $data = $request->all();
        $rules=[
            'designtion_name'=>'required|unique:designtion',
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            $success = false;
            $message = $validator->errors();
        }else{
            $designtion = new Designation();
            $designtion->designtion_name = $data['designtion_name'];
            $designtion->created_at = date('Y-m-d H:i:s');
            $designtion->created_by = auth()->user()->id;
            $designtion->save();
            $success = true;
            $message = array('success'=>array('Designtion added successfully'));
        }
     return ResponseHelper::returnResponse(200,$success,$message);
    }
    return view('common.designation.add');
   }
        function edit(Request $request, $id){
            if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'designtion_name'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    'designtion_name' => $request->input('designtion_name'),
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = Designation::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Designtion added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $designtion = Designation::where('id','=',$id)->first();
        return view('common.designation.edit',compact('designtion'));
        }
    
   function destroy(Request $request, $id){
        if ($request->ajax()){
            $designtion = Designation::findOrFail($id);
            if ($designtion){
                $designtion->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
