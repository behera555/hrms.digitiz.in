<?php

namespace App\Http\Controllers;

use App\Models\Pormotion;
use App\Models\User;
use App\Models\Designation;
use App\Models\Department;
use Validator,Auth;
use App\Facades\ResponseHelper;
use Illuminate\Http\Request;

class PormotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $pormotion = Pormotion::query()->paginate(5);
        return view('pormotion.index',compact('pormotion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'employee_name'=>'required',
                'current_department'=>'required',
                'current_designation'=>'required',
                'current_salary'=>'required|numeric',
                'promotion_new_salary'=>'required|numeric',
                'promoted_department'=>'required',
                'promoted_designation'=>'required',
                'promotion_date'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $pormotion = new Pormotion();
                $pormotion->employee_name = $data['employee_name'];
                $pormotion->current_department = $data['current_department'];
                $pormotion->current_designation = $data['current_designation'];
                $pormotion->current_salary = $data['current_salary'];
                $pormotion->promotion_new_salary = $data['promotion_new_salary'];
                $pormotion->promoted_department = $data['promoted_department'];
                $pormotion->promoted_designation = $data['promoted_designation'];
                $pormotion->promotion_date = date("Y-m-d", strtotime($data['promotion_date']));
                $pormotion->description = $data['description'];
                $pormotion->created_at = date('Y-m-d H:i:s');
                $pormotion->created_by = auth()->user()->id;
                $pormotion->save();
                $success = true;
                $message = array('success'=>array('Pormotion added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        $designtion = Designation::get();
        $department = Department::get();
       return view('pormotion.add',compact('employees','designtion', 'department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pormotion  $pormotion
     * @return \Illuminate\Http\Response
     */
    public function show(Pormotion $pormotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pormotion  $pormotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'employee_name'=>'required',
                'current_department'=>'required',
                'current_designation'=>'required',
                'current_salary'=>'required|numeric',
                'promotion_new_salary'=>'required|numeric',
                'promoted_department'=>'required',
                'promoted_designation'=>'required',
                'promotion_date'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    'employee_name' => $request->input('employee_name'),
                    'current_department' => $request->input('current_department'),
                    'current_designation' => $request->input('current_designation'),
                    'current_salary' => $request->input('current_salary'),
                    'promotion_new_salary' => $request->input('promotion_new_salary'),
                    'promoted_department' => $request->input('promoted_department'),
                    'promoted_designation' => $request->input('promoted_designation'),
                    'promotion_date' => $request->input('promotion_date'),
                    'description' => $request->input('description'),
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = Pormotion::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Pormotion updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
        $employees = User::whereIn('type', [2,3])->get();
        $designtion = Designation::get();
        $department = Department::get();
        $pormotion = Pormotion::where('id','=',$id)->first();
        return view('pormotion.edit',compact('employees','designtion', 'department', 'pormotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pormotion  $pormotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pormotion $pormotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pormotion  $pormotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        if ($request->ajax()){
            $pormotion = Pormotion::findOrFail($id);
            if ($pormotion){
                $pormotion->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
