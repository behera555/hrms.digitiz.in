<?php
namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use Validator,Auth;
use App\Facades\ResponseHelper;

class EventsController extends Controller{

    function index(Request $request){
        $data = Events::get();
        $event_data = json_decode(json_encode($data), true);
        return View('common.events.index',['event_data' => $event_data]);
    }

    function add(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'event_title'=>'required',
                'event_date'=>'required',
                'event_description'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $events = new Events();
                $events->event_title = $data['event_title'];
                $events->event_date = $data['event_date'];
                $events->event_description = $data['event_description'];
                $events->created_at = date('Y-m-d H:i:s');
                $events->created_by = auth()->user()->id;
                $events->save();
                $success = true;
                $message = array('success'=>array('Events added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
       }


       function delete_events(Request $request){
        $data = Events::where('id', $request->id)->delete();
        echo json_encode($data);
        //return $request->id;
    }

}
