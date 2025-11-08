<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\User;
use Illuminate\Http\Request;
use Validator,Auth;
use App\Facades\ResponseHelper;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $award = Award::query()->paginate(5);
       return view('award.index',compact('award'));
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
                'award_name'=>'required',
                'employee_name'=>'required',
                'gift_item'=>'required',
                'gift_item_issued_date'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $award = new Award();
                $award->award_name = $data['award_name'];
                $award->employee_name = $data['employee_name'];
                $award->gift_item = $data['gift_item'];
                $award->gift_item_issued_date = $data['gift_item_issued_date'];
                $award->created_at = date('Y-m-d H:i:s');
                $award->created_by = auth()->user()->id;
                $award->save();
                $success = true;
                $message = array('success'=>array('Award added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        return view('award.add',compact('employees'));
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
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'award_name'=>'required',
                'employee_name'=>'required',
                'gift_item'=>'required',
                'gift_item_issued_date'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    'award_name' => $request->input('award_name'),
                    'employee_name' => $request->input('employee_name'),
                    'gift_item' => $request->input('gift_item'),
                    'gift_item_issued_date' => $request->input('gift_item_issued_date'),
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = Award::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Award updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
            $award = Award::where('id','=',$id)->first();
            $employees = User::whereIn('type', [2,3])->get();
            return view('award.edit',compact('award','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Award $award)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()){
            $award = Award::findOrFail($id);
            if ($award){
                $award->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
