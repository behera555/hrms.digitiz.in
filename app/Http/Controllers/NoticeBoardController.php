<?php

namespace App\Http\Controllers;

use App\Models\NoticeBoard;
use App\Models\User;
use Validator,Auth;
use Illuminate\Http\Request;
use App\Facades\ResponseHelper;

class NoticeBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->type == 'hr'){
            $notice_boards = NoticeBoard::query()->paginate(5);
        }else{
            $notice_boards = NoticeBoard::query()->where('department',auth()->user()->emp_id)->paginate(5);
        }
        
        return view('employee.noticeboard.index',compact('notice_boards'));
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
                'notice_heading'=>'required',
                'type'=>'required',
                'notice_details'=>'required',
                'date'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $notice_board = new NoticeBoard();
                $notice_board->notice_heading = $data['notice_heading'];
                if($data['type'] == 'employees'){
                    $notice_board->department = $data['department'];
                    $notice_board->type = $data['type'];
                }else{
                    $notice_board->type = $data['type'];
                }
                $notice_board->notice_details = $data['notice_details'];
                 $notice_board->date = $data['date'];
                $notice_board->created_at = date('Y-m-d H:i:s');
                $notice_board->created_by = auth()->user()->id;
                $notice_board->save();
                $success = true;
                $message = array('success'=>array('Notice Board added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        return view('employee.noticeboard.add',compact('employees'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'notice_heading'=>'required',
                'type'=>'required',
                'notice_details'=>'required',
                'date'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                if($data['type'] == 'employees'){
                    $department = $data['department'];
                    $type = $data['type'];
                }else{
                    $type = $data['type'];
                    $department = NUll;
                }
                $update_arr = array(
                    "notice_heading" => $data['notice_heading'],
                    "notice_details" => $data['notice_details'],
                    "date" => $data['date'],
                    "type" => $type,
                    "department" => $department,
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = NoticeBoard::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Notice Board updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
            $employees = User::whereIn('type', [2,3])->get();
            $notice_board = NoticeBoard::where('id','=',$id)->first();
            return view('employee.noticeboard.edit',compact('notice_board','employees'));
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    function destroy(Request $request, $id){
        if ($request->ajax()){
            $notice_board = NoticeBoard::findOrFail($id);
            if ($notice_board){
                $notice_board->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
