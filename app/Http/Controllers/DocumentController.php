<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator,Auth,DB;
use App\Models\User;
use App\Facades\ResponseHelper;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $document_list = DB::table('documents')->paginate(5);
       return view('document.index',compact('document_list'));
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
                'document_name'=>'required',
                'document_upload'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                if($request->file('document_upload') != ''){
                    $imageName = $request->file('document_upload')->getClientOriginalName();
                    $request->file('document_upload')->move('uploads/document/', $imageName); 
                    }else{
                        $imageName = "-";
                    }    
                $document=array('document_name'=>$data['document_name'],'document_upload'=>$imageName,'created_at'=>date('Y-m-d H:i:s'),'created_by'=>auth()->user()->id,);
                DB::table('documents')->insert($document);
                $success = true;
                $message = array('success'=>array('Award added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        return view('document.add',compact('employees'));
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
                'document_name'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                if($request->file('document_upload') != ''){
                    $imageName = $request->file('document_upload')->getClientOriginalName();
                    $request->file('document_upload')->move('uploads/document/', $imageName); 
                    $documents = DB::table('documents')->where('id','=',$id)->first();
                    $path = public_path('uploads/document/'.$documents->document_upload);
                    @unlink($path);
                }else{
                    $documents = DB::table('documents')->where('id','=',$id)->first();    
                        $imageName = $documents->document_upload;
                    }    
                $update_arr = array(
                    'document_name' => $request->input('document_name'),
                    'document_upload' => $imageName,
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = DB::table('documents')->where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Documents updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
            $documents = DB::table('documents')->where('id','=',$id)->first();
            return view('document.edit',compact('documents'));
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
            $documents =DB::table('documents')->where('id','=',$id)->first();
            $path = public_path('uploads/document/'.$documents->document_upload);
            @unlink($path);
            if ($documents){
                $documents = DB::table('documents')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
