<?php

namespace App\Http\Controllers;

use App\Models\Allowip;
use Validator,Auth,DB;
use Illuminate\Http\Request;
use App\Facades\ResponseHelper;

class AllowipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allowip = Allowip::query()->paginate(5);
        return view('allowip.index',compact('allowip'));
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
                'allowips'=>'required|unique:allowips',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $allowip = new Allowip();
                $allowip->allowips = $data['allowips'];
                $allowip->created_at = date('Y-m-d H:i:s');
                $allowip->created_by = auth()->user()->id;
                $allowip->save();
                $success = true;
                $message = array('success'=>array('Allow Ip added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        return view('allowip.add');
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
     * @param  \App\Models\Allowip  $allowip
     * @return \Illuminate\Http\Response
     */
    public function show(Allowip $allowip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allowip  $allowip
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'allowips'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    "allowips" => $data['allowips'],
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = Allowip::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Allow Ip updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
            $allowip = Allowip::where('id','=',$id)->first();
            return view('allowip.edit',compact('allowip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allowip  $allowip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allowip $allowip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allowip  $allowip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        if ($request->ajax()){
            $allowip = Allowip::findOrFail($id);
            if ($allowip){
                $allowip->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
