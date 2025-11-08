<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Asset_type;
use App\Models\Employees;
use App\Models\AssetsAllocate;
use Validator,Auth,DB;
use Illuminate\Http\Request;
use App\Facades\ResponseHelper;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Assets::query()->paginate(5);
        return view('asset.index',compact('assets'));
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
                'asset_name'=>'required',
                'asset_type'=>'required',
                'serial_number'=>'required',
                'value'=>'required',
                'description'=>'required',
                'asset_picture'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                if($request->file('asset_picture') != ''){
                $imageName = $request->file('asset_picture')->getClientOriginalName();
                $request->file('asset_picture')->move('uploads/assets/', $imageName); 
                }else{
                $imageName = "-";
                }      
                $asset = new Assets();
                $asset->asset_name = $data['asset_name'];
                $asset->asset_type = $data['asset_type'];
                $asset->serial_number = $data['serial_number'];
                $asset->value = $data['value'];
                $asset->asset_picture = $imageName;
                $asset->description = $data['description'];
                $asset->created_at = date('Y-m-d H:i:s');
                $asset->created_by = auth()->user()->id;
                $asset->save();
                $success = true;
                $message = array('success'=>array('Asset added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
       
        $asset_type = Asset_type::get();
        return view('asset.add',compact('asset_type'));
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
     * @param  \App\Models\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function show(Assets $assets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'asset_name'=>'required',
                'asset_type'=>'required',
                'serial_number'=>'required',
                'value'=>'required',
                'description'=>'required',
            ];
            if($request->file('asset_picture') != ''){
                $request->validate([
                    'asset_picture' => 'required',
                ]);
                $imageName = $request->file('asset_picture')->getClientOriginalName();
                $request->file('asset_picture')->move('uploads/assets/', $imageName);          
            } else {
                $edit_assets = DB::table('assets')->find($request->id);
                $imageName = $edit_assets->asset_picture;
            }
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    "asset_name" => $data['asset_name'],
                    "asset_type" => $data['asset_type'],
                    "serial_number" => $data['serial_number'],
                    "value" => $data['value'],
                    "description" => $data['description'],
                    "asset_picture" => $imageName,
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = Assets::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Asset Types Name updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
            $assets = Assets::where('id','=',$id)->first();
            $asset_type = Asset_type::get();
            return view('asset.edit',compact('assets','asset_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assets $assets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        if ($request->ajax()){
            $assets = Assets::where('id','=',$id)->first();
            $path = public_path('uploads/assets/'.$assets->asset_picture);
            @unlink($path);
            $assets = Assets::findOrFail($id);
            if ($assets){
                $assets->delete();
                return response()->json(array('success' => true));
            }
        }
    }


    function assets_allocate_list(Request $request){
        $assets_allocate_list = AssetsAllocate::query()->paginate(5);
        return view('asset.assets_allocate_list',compact('assets_allocate_list'));
    }

    function assets_allocate_add(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'allocate_date'=>'required',
                'employee_name'=>'required',
                'asset_name'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $assetsallocate = new AssetsAllocate();
                $assetsallocate->asset_name = $data['asset_name'];
                $assetsallocate->employee_name = $data['employee_name'];
                $assetsallocate->allocate_date = $data['allocate_date'];
                $assetsallocate->created_at = date('Y-m-d H:i:s');
                $assetsallocate->created_by = auth()->user()->id;
                $assetsallocate->save();
                $success = true;
                $message = array('success'=>array('Assets Allocate added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $assets_allocate_list = Assets::get();
        $employees_list = Employees::get();
        return view('asset.add_assets_allocate_list',compact('assets_allocate_list','employees_list'));
    }

    function assets_allocate_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'allocate_date'=>'required',
                'employee_name'=>'required',
                'asset_name'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    "asset_name" => $data['asset_name'],
                    "employee_name" => $data['employee_name'],
                    "allocate_date" => $data['allocate_date'],
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = AssetsAllocate::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Assets Allocate updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
            $assets_allocate_to = AssetsAllocate::where('id','=',$id)->first();
            $assets_allocate_list = Assets::get();
            $employees_list = Employees::get();
        return view('asset.edit_assets_allocate_list',compact('assets_allocate_list', 'employees_list', 'assets_allocate_to'));
    }


    public function assets_allocate_destroy(Request $request, $id){
        if ($request->ajax()){
            $assetsallocate = AssetsAllocate::findOrFail($id);
            if ($assetsallocate){
                $assetsallocate->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
