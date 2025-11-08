<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitments;
use App\Models\Candidates;
use App\Models\Interviews;
use App\Models\User;
use App\Models\Employees;
use Validator,Auth,DB,SoftDeletes;
use App\Facades\ResponseHelper;

class RecruitmentsController extends Controller
{
   function index(Request $request){
    $recruitments = Recruitments::query()->paginate(5);
    if($request->ajax()){
        $recruitments = Recruitments::query()
        ->when($request->seach_term, function($q)use($request){
            $q->where('holiday_name', 'like', '%'.$request->serach.'%');
        })->paginate(5);   
        return view('pagination_child', compact('holidays'))->render(); 
    }
    return View('common.recruitment.index',compact('recruitments'));
   }

   function add(Request $request){
      if($request->isMethod('post')){
         $response_code = 200;
         $message = array('error'=>array('something went wrong'));
         $success = false ;
         $data = $request->all();
         $rules=[
             'requisition_code'=>'required',
             'job_title'=>'required',
             'position'=>'required',
             'no_of_positions'=>'required|numeric',
             'job_description'=>'required',
             'required_skills'=>'required',
             'required_qualification'=>'required',
             'required_experience_range'=>'required',
             'employment_status'=>'required',
             'priority'=>'required',
             'due_date'=>'required',
             'recruitment_status'=>'required',
         ];
         $validator = Validator::make($data,$rules);
         if($validator->fails()){
             $success = false;
             $message = $validator->errors();
         }else{
             $recruitments = new Recruitments();
             $recruitments->requisition_code = $data['requisition_code'];
             $recruitments->job_title = $data['job_title'];
             $recruitments->position = $data['position'];
             $recruitments->no_of_positions = $data['no_of_positions'];
             $recruitments->job_description = $data['job_description'];
             $recruitments->required_skills = $data['required_skills'];
             $recruitments->required_qualification = $data['required_qualification'];
             $recruitments->required_experience_range = $data['required_experience_range'];
             $recruitments->employment_status = $data['employment_status'];
             $recruitments->priority = $data['priority'];
             $recruitments->due_date = $data['due_date'];
             $recruitments->recruitment_status = $data['recruitment_status'];
             $recruitments->created_at = date('Y-m-d H:i:s');
             $recruitments->save();
             $success = true;
             $message = array('success'=>array('added successfully'));
         }
      return ResponseHelper::returnResponse(200,$success,$message);
      }
       $code = DB::table('recruitment')->orderBy('id', 'desc')->first();
       if($code == null){
        $id = "JOB000".+1;
       }else{
        $id = "JOB000".$code->id+1;
       }
      return View('common.recruitment.add',compact('id'));
   }


   function edit(Request $request, $id){
    if($request->isMethod('post')){
        $response_code = 200;
        $message = array('error'=>array('something went wrong'));
        $success = false ;
        $data = $request->all();
        $rules=[
            'requisition_code'=>'required',
            'job_title'=>'required',
            'position'=>'required',
            'no_of_positions'=>'required|numeric',
            'job_description'=>'required',
            'required_skills'=>'required',
            'required_qualification'=>'required',
            'required_experience_range'=>'required',
            'employment_status'=>'required',
            'priority'=>'required',
            'due_date'=>'required',
            'recruitment_status'=>'required',
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            $success = false;
            $message = $validator->errors();
        }else{
            $update_arr = array(
                'requisition_code' => $request->input('requisition_code'),
                'job_title' => $request->input('job_title'),
                'position' => $request->input('position'),
                'no_of_positions' => $request->input('no_of_positions'),
                'job_description' => $request->input('job_description'),
                'required_skills' => $request->input('required_skills'),
                'required_qualification' => $request->input('required_qualification'),
                'required_experience_range' => $request->input('required_experience_range'),
                'employment_status' => $request->input('employment_status'),
                'priority' => $request->input('priority'),
                'due_date' => $request->input('due_date'),
                'recruitment_status' => $request->input('recruitment_status'),
                'updated_at' =>    date('Y-m-d H:i:s'),
                'updated_by' => auth()->user()->id,
            );
            $affectedRows = Recruitments::where("id", $id)->update($update_arr);
            $success = true;
            $message = array('success'=>array('Recruitments added successfully'));
        }
    return ResponseHelper::returnResponse(200,$success,$message);
    }
    $recruitments = Recruitments::where('id','=',$id)->first();
    return View('common.recruitment.edit',compact('recruitments'));
   }


   function destroy(Request $request, $id){
    if ($request->ajax()){
        $recruitments = Recruitments::findOrFail($id);
        if ($recruitments){
            $recruitments->delete();
            return response()->json(array('success' => true));
        }
    }
}


  function candidates_list(Request $request){
    $candidates = Candidates::query()->paginate(5);
    return view('common.recruitment.candidates_list',compact('candidates'));
  }

  function candidates_add(Request $request){
    if($request->isMethod('post')){
        $response_code = 200;
        $message = array('error'=>array('something went wrong'));
        $success = false ;
        $data = $request->all();
        $rules=[
            
            //'skill_set'=>'required',
            'contact_number'=>'required|numeric|digits:10',
            'email'=>'required|email',
            //'referal_name'=>'required',
            'source'=>'required',
            //'last_name'=>'required',
            'first_name'=>'required',
            //'position'=>'required',
            'education_details'=>'required',
            'employnment_status'=>'required',
            'comments'=>'required',
            'resume'=>'required',
            'requisition_id'=>'required',
        ];

        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            $success = false;
            $message = $validator->errors();
        }else{
            if($request->file('resume') != ''){
                $resume = $request->file('resume')->getClientOriginalName();
                $request->file('resume')->move('uploads/resume/', $resume); 
                }else{
                $resume = "-";
                }    
            $candidates = new Candidates();
            $candidates->requisition_id = $data['requisition_id'];
            $candidates->first_name = $data['first_name'];
            $candidates->last_name = $data['last_name'];
            $candidates->source = $data['source'];
            $candidates->referal_name = $data['referal_name'];
            $candidates->email = $data['email'];
            $candidates->contact_number = $data['contact_number'];
            $candidates->skill_set = $data['skill_set'];
            $candidates->resume = $resume;
            $candidates->education_details = $data['education_details'];
            $candidates->interview_scheduled = $data['interview_scheduled'];
            $candidates->employment_status = $data['employment_status'];
            $candidates->current_company = $data['current_company'];
            $candidates->ctc = $data['ctc'];
            $candidates->expected_ctc = $data['expected_ctc'];
            $candidates->notice_period = $data['notice_period'];
            $candidates->comments = $data['comments'];
            $candidates->followup = $data['followup'];
            $candidates->shortlisted_candidates = $data['shortlisted_candidates'];
            $candidates->created_at = date('Y-m-d H:i:s');
            $candidates->save();
            $success = true;
            $message = array('success'=>array('Candidate Added Successfully'));
        }
     return ResponseHelper::returnResponse(200,$success,$message);
     }
    $recruitments = Recruitments::get();
    return view('common.recruitment.candidates_add',compact('recruitments'));
  }

  function candidates_edit(Request $request, $id){
    if($request->isMethod('post')){
        $response_code = 200;
        $message = array('error'=>array('something went wrong'));
        $success = false ;
        $data = $request->all();
        $rules=[
            //'skill_set'=>'required',
            'contact_number'=>'required|numeric|digits:10',
            'email'=>'required|email',
            //'referal_name'=>'required',
            'source'=>'required',
            //'last_name'=>'required',
            'first_name'=>'required',
            'requisition_id'=>'required',
            'education_details'=>'required',
            //'employnment_status'=>'required',
            'comments'=>'required',
            //'resume'=>'required',
        ];
        if($request->file('resume') != ''){
            $request->validate([
                'resume'=>'required',
            ]);
            $resume = $request->file('resume')->getClientOriginalName();
            $request->file('resume')->move('uploads/resume/', $resume);          
        } else {
            $edit_resume = DB::table('candidates')->find($request->id);
            $resume = $edit_resume->resume;
        }
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            $success = false;
            $message = $validator->errors();
        }else{
            $update_arr = array(
                'requisition_id' => $request->input('requisition_id'),
                'skill_set' => $request->input('skill_set'),
                'contact_number' => $request->input('contact_number'),
                'email' => $request->input('email'),
                'referal_name' => $request->input('referal_name'),
                'source' => $request->input('source'),
                'shortlisted_candidates' => $request->input('shortlisted_candidates'),
                'last_name' => $request->input('last_name'),
                'first_name' => $request->input('first_name'),
                'education_details' => $request->input('education_details'),
                'interview_scheduled' => $request->input('interview_scheduled'),
                'employment_status' => $request->input('employment_status'),
                'current_company' => $request->input('current_company'),
                'ctc' => $request->input('ctc'),
                'expected_ctc' => $request->input('expected_ctc'),
                'notice_period' => $request->input('notice_period'),
                'comments' => $request->input('comments'),
                'followup' => $request->input('followup'),
                'resume' => $request->input('resume'), 
                'updated_at' =>    date('Y-m-d H:i:s'),
                'updated_by' => auth()->user()->id,
            );
            $affectedRows = Candidates::where("id", $id)->update($update_arr);
            $success = true;
            $message = array('success'=>array('Recruitments added successfully'));
        }
    return ResponseHelper::returnResponse(200,$success,$message);
    }
    $candidates = Candidates::where('id','=',$id)->first();
    $recruitments = Recruitments::get();
    return view('common.recruitment.candidates_edit',compact('recruitments','candidates'));
  }

  function candidates_destroy(Request $request, $id){
    if ($request->ajax()){
        $candidates = Candidates::where('id','=',$id)->first();
        $path = public_path('uploads/resume/'.$candidates->resume);
        @unlink($path);
        $candidates = Candidates::findOrFail($id);
        if ($candidates){
            $candidates->delete();
            return response()->json(array('success' => true));
        }
    }
  }



  function interviews_list(Request $request){
    $interviews = Interviews::query()->paginate(5);
    return view('common.recruitment.interviews_list',compact('interviews'));
  }

  function interviews_add(Request $request){
    if($request->isMethod('post')){
        $response_code = 200;
        $message = array('error'=>array('something went wrong'));
        $success = false ;
        $data = $request->all();
        $rules=[
            'interview_name'=>'required',
            'interview_time'=>'required',
            'interview_date'=>'required',
            'interview_type'=>'required',
            'interviewer'=>'required',
            'interview_status'=>'required',
            'candidate_name'=>'required',
            'requisition_id'=>'required',
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            $success = false;
            $message = $validator->errors();
        }else{
            $interviews = new Interviews();
            $interviews->requisition_id = $data['requisition_id'];
            $interviews->candidate_name = $data['candidate_name'];
            $interviews->interview_status = $data['interview_status'];
            $interviews->interviewer = $data['interviewer'];
            $interviews->interview_type = $data['interview_type'];
            $interviews->interview_date = $data['interview_date'];
            $interviews->interview_time = $data['interview_time'];
            $interviews->interview_name = $data['interview_name'];
            $interviews->interview_link = $data['interview_link'];
            $interviews->created_at = date('Y-m-d H:i:s');
            $interviews->save();
            $success = true;
            $message = array('success'=>array('added successfully'));
        }
     return ResponseHelper::returnResponse(200,$success,$message);
     }
    $recruitments = Recruitments::get();
    $candidates = Candidates::get();
    $employees = User::where('active',1)->get();
    return view('common.recruitment.interviews_add',compact('recruitments','candidates','employees'));
  }

  function interviews_edit(Request $request, $id){
    if($request->isMethod('post')){
        $response_code = 200;
        $message = array('error'=>array('something went wrong'));
        $success = false ;
        $data = $request->all();
        $rules=[
            'interview_name'=>'required',
            'interview_time'=>'required',
            'interview_date'=>'required',
            'interview_type'=>'required',
            'interviewer'=>'required',
            'interview_status'=>'required',
            'candidate_name'=>'required',
            'requisition_id'=>'required',
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            $success = false;
            $message = $validator->errors();
        }else{
            $update_arr = array(
                'requisition_id' => $request->input('requisition_id'),
                'candidate_name' => $request->input('candidate_name'),
                'interview_status' => $request->input('interview_status'),
                'interviewer' => $request->input('interviewer'),
                'interview_type' => $request->input('interview_type'),
                'interview_date' => $request->input('interview_date'),
                'interview_time' => $request->input('interview_time'),
                'interview_name' => $request->input('interview_name'),
                'interview_link' => $request->input('interview_link'),
                'updated_at' =>    date('Y-m-d H:i:s'),
                'updated_by' => auth()->user()->id,
            );
            $affectedRows = Interviews::where("id", $id)->update($update_arr);
            $success = true;
            $message = array('success'=>array('Interviews added successfully'));
        }
    return ResponseHelper::returnResponse(200,$success,$message);
    }
    $interviews = Interviews::where('id','=',$id)->first();
    $recruitments = Recruitments::get();
    $candidates = Candidates::get();
    $employees = User::where('active',1)->get();
    return view('common.recruitment.interviews_edit',compact('recruitments','candidates','employees','interviews'));
  }

  function interviews_destroy(Request $request, $id){
    if ($request->ajax()){
        $candidates = Interviews::findOrFail($id);
        if ($candidates){
            $candidates->delete();
            return response()->json(array('success' => true));
        }
    }
  }
   

  function shortlisted_list(Request $request){
    $candidates = Candidates::query()->where('shortlisted_candidates','=','shortlisted_candidates')->paginate(5);
    return view('common.recruitment.shortlisted_list',compact('candidates'));
  }

  function rejected_candidates(Request $request){
    $candidates = Candidates::query()->where('shortlisted_candidates','=','rejected_candidates')->paginate(5);
    return view('common.recruitment.rejected_candidates',compact('candidates'));
  }

  function update_shortlisted_list(Request $request, $id){
  
    $affectedRows = Candidates::where("id", $id)->update(["shortlisted_candidates" => $request->update_shortlisted_list]);
    if(!empty($affectedRows == '1')){
        return json_encode(array("statusCode"=>200));
    }else{
        return json_encode(array("statusCode"=>500));
    }
    
}

}
