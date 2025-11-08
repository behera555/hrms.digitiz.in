<?php

namespace App\Http\Controllers;

use App\Models\Asset_type;
use Validator,Auth;
use Illuminate\Http\Request;
use App\Facades\ResponseHelper;
class AssetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $asset_type = Asset_type::query()->paginate(5);
        return view('asset.asset_type.index',compact('asset_type'));
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
                'asset_types_name'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $asset_type = new Asset_type();
                $asset_type->asset_types_name = $data['asset_types_name'];
                $asset_type->created_at = date('Y-m-d H:i:s');
                $asset_type->created_by = auth()->user()->id;
                $asset_type->save();
                $success = true;
                $message = array('success'=>array('Asset Type added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        return view('asset.asset_type.add');
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
     * @param  \App\Models\Asset_type  $asset_type
     * @return \Illuminate\Http\Response
     */
    public function show(Asset_type $asset_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset_type  $asset_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'asset_types_name'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    "asset_types_name" => $data['asset_types_name'],
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = Asset_type::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Asset Types Name updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
            $asset_type = Asset_type::where('id','=',$id)->first();
            return view('asset.asset_type.edit',compact('asset_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset_type  $asset_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset_type $asset_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset_type  $asset_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()){
            $asset_type = Asset_type::findOrFail($id);
            if ($asset_type){
                $asset_type->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
