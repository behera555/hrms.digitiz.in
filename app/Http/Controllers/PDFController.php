<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offer_letter;
use App\Models\Relieving_letter;
use App\Models\Letter_of_intent;
use App\Models\Offere_letter;
use App\Models\Department;
use App\Models\Designation;
use Carbon\Carbon;
use Validator,Auth,DB,PDF,Hash;
use App\Facades\ResponseHelper;

class PDFController extends Controller
{
    public function download_employees_list(){
       $users = DB::table('users')->join('employees_primary_details', function ($join) { $join->on('users.emp_id', '=', 'employees_primary_details.emp_id')->where('users.active', '=', 1)->whereIn('type', [2,3]);})->join('employees_contact_details', function ($join) { $join->on('users.emp_id', '=', 'employees_contact_details.emp_id');})->get();
        $pdf = PDF::loadView('pdf/employees_list',['users' => $users]);
        $file_name = time().'_'.'employees_list.pdf';
        return $pdf->download($file_name);

    }
    
    public function relieving_letter(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'resignation_email_dated' => 'required',
                'relieved_date' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $date_of_joining = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('date_of_joining')->first();
                 $designation = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('designation')->first();
                $name = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->first();
                
                $relieving_letter = new Relieving_letter(); 
                $relieving_letter->emp_id = $data['emp_id'];
                $relieving_letter->employee_name =  $name->first_name.''.$name->last_name;
                $relieving_letter->designation =  $designation;
                $relieving_letter->resignation_email_date =  $data['resignation_email_dated'];
                $relieving_letter->relieved_date =  $data['relieved_date'];
                $relieving_letter->date_of_joining =  $date_of_joining;
                $relieving_letter->created_at = date('Y-m-d H:i:s');
                $relieving_letter->created_by = auth()->user()->id;
                $get_array = array(
                  'emp_id' => $data['emp_id'],
                  'employee_name' => $name->first_name.''.$name->last_name,
                  'designation' => $designation,
                  'resignation_email_date' => $data['resignation_email_dated'],
                  'relieved_date' => $data['relieved_date'],
                  'date_of_joining' => $date_of_joining,
                 );
                $pdf_file_name = PDF::loadView('pdf/relieving_letter',['data' => $get_array]);
                $relieving_letter_pdf =  $data['emp_id'].'_'.time().'_'.'relieving_letter.pdf';
                $path = public_path('pdf/relieving_letter');
                $pdf_file_name->save($path . '/' . $relieving_letter_pdf);
                $relieving_letter->file = $relieving_letter_pdf;
                $relieving_letter->save();
                $success = true;
                $message = array('success'=>array('Holidays added successfully'));
                }
            return ResponseHelper::returnResponse(200,$success,$message);
        }
        //DB::table('employees_offer_letter')->get();
        $employees = User::whereIn('type', [2,3])->get();
        $employees_offer_letter= array();
         $employees_relieving_letter = DB::table('employees_relieving_letter')->latest()->paginate(5);
        return view('hr.employees.relieving_letter',compact('employees_relieving_letter','employees'));
    }
    
    
    public function relieving_letter_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'resignation_email_date' => 'required',
                'relieved_date' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $date_of_joining = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('date_of_joining')->first();
                 $designation = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('designation')->first();
                $name = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->first();
                $update_arr = array(
                'employee_name' => $name->first_name.''.$name->last_name,
                'designation' => $designation,
                'relieved_date' => $data['relieved_date'],
                'resignation_email_date' => $data['resignation_email_date'],
                'date_of_joining' => $date_of_joining,
                'updated_at' =>    date('Y-m-d H:i:s'),
                'updated_by' => auth()->user()->id,
                );
                
                $get_array = array(
                  'emp_id' => $data['emp_id'],
                  'employee_name' => $name->first_name.''.$name->last_name,
                  'designation' => $designation,
                  'resignation_email_date' => $data['resignation_email_date'],
                  'relieved_date' => $data['relieved_date'],
                  'date_of_joining' => $date_of_joining,
                 );
                 $employees_relieving_letter = Relieving_letter::where('id','=',$id)->first();
                  $path = public_path('pdf/relieving_letter/'.$employees_relieving_letter->file);
                  @unlink($path);
                $pdf_file_name = PDF::loadView('pdf/relieving_letter',['data' => $get_array]);
                $relieving_letter_pdf =  $data['emp_id'].'_'.time().'_'.'relieving_letter.pdf';
                $path = public_path('pdf/relieving_letter');
                $pdf_file_name->save($path . '/' . $relieving_letter_pdf);
                $update_arr['file'] = $relieving_letter_pdf;
                $affectedRows = Relieving_letter::where("id", $id)->update($update_arr);
                
                $success = true;
                $message = array('success'=>array('Holidays added successfully'));
                }
            return ResponseHelper::returnResponse(200,$success,$message);
        }
        //DB::table('employees_offer_letter')->get();
        $employees = User::whereIn('type', [2,3])->get();
         $employees_relieving_letter = Relieving_letter::where('id','=',$id)->first();
        return view('hr.employees.relieving_letter_edit',compact('employees_relieving_letter','employees'));
    }
    
    // Stream Relieving Letter PDF for preview
    public function relieving_letter_preview($id)
    {
        $record = DB::table('employees_relieving_letter')->where('id', '=', $id)->first();
        if (!$record) {
            abort(404);
        }

        $data = [
            'emp_id' => $record->emp_id,
            'employee_name' => $record->employee_name,
            'designation' => $record->designation,
            'resignation_email_date' => $record->resignation_email_date,
            'relieved_date' => $record->relieved_date,
            'date_of_joining' => $record->date_of_joining,
        ];

        $pdf = PDF::loadView('pdf/relieving_letter', [
            'data' => $data,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('relieving_letter_preview.pdf');
    }
    
    // public function relieving_letter(Request $request){
    //     if($request->isMethod('post')){
    //         $response_code = 200;
    //         $message = array('error'=>array('something went wrong'));
    //         $success = false ;
    //         $data = $request->all();
    //         $rules=[
    //             'emp_id' => 'required',
    //             'resignation_email_dated' => 'required',
    //             'relieved_date' => 'required',
    //         ];
    //         $validator = Validator::make($data,$rules);
    //         if($validator->fails()){
    //             $success = false;
    //             $message = $validator->errors();
    //         }else{
    //             $date_of_joining = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('date_of_joining')->first();
    //              $designation = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('designation')->first();
    //             $first_name = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->first();
    //       $array_insert = array(
    //             "emp_id" => $data['emp_id'],
    //             "employee_name" => $first_name->first_name.$first_name->last_name,
    //             "designation" => $designation,
    //             "resignation_email_date" => $data['resignation_email_dated'],
    //             "relieved_date" => $data['relieved_date'],
    //             "date_of_joining" => $date_of_joining,
    //             "created_at" => date('Y-m-d H:i:s'),
    //             "created_by" => auth()->user()->id,
    //          );  
      
    //         $pdf_file_name = PDF::loadView('pdf/relieving_letter',[
    //         'data' => $array_insert
    //       ]);
    //         $relieving_letter =  $data['emp_id'].'_'.time().'_'.'relieving_letter.pdf';
    //         $path = public_path('pdf/relieving_letter');
    //         $pdf_file_name->save($path . '/' . $relieving_letter);
    //         $array_insert['file'] = $relieving_letter;
        
    //         DB::table('employees_relieving_letter')->insert($array_insert);
    //         }
    //      return ResponseHelper::returnResponse(200,$success,$message);
    //     }
    //     //DB::table('employees_offer_letter')->get();
    //     $employees = User::whereIn('type', [2,3])->get();
    //     $employees_offer_letter= array();
    //      $employees_relieving_letter = DB::table('employees_relieving_letter')->paginate(5);
    //     return view('hr.employees.relieving_letter',compact('employees_relieving_letter','employees'));
    // }
    
    
    //  public function offer_letter(Request $request){
    //     if($request->isMethod('post')){
    //         $response_code = 200;
    //         $message = array('error'=>array('something went wrong'));
    //         $success = false ;
    //         $data = $request->all();
    //         $rules=[
    //             'emp_id' => 'required',
    //             'offer_letter_date' => 'required',
    //             'address' => 'required',
    //         ];
    //         $validator = Validator::make($data,$rules);
    //         if($validator->fails()){
    //             $success = false;
    //             $message = $validator->errors();
    //         }else{
    //              $designation = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('designation')->first();
    //              $reporting_to = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('reporting_to')->first();
    //              $now_name = DB::table('employees_primary_details')->where(['emp_id' => $reporting_to])->first();
    //             $first_name = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->first();
    //             $employees_monthly_salary_breakup = DB::table('employees_monthly_salary_breakup')->where(['emp_id' => $data['emp_id']])->first();
    //             $employees_salary_package = DB::table('employees_salary_package')->where(['emp_id' => $data['emp_id']])->pluck('annual_package')->first();
    //       $array_insert = array(
    //             "emp_id" => $data['emp_id'],
    //             "employee_name" => $first_name->first_name.' '.$first_name->last_name,
    //             "designation" => $designation,
    //             "reporting" => $now_name->first_name.' '.$now_name->last_name,
    //             "salary_package" => $employees_salary_package,
    //             "address" => $data['address'],
    //             "offer_letter_date" => $data['offer_letter_date'],
    //             "created_at" => date('Y-m-d H:i:s'),
    //             "created_by" => auth()->user()->id,
    //          );  
    //         $pdf_file_name = PDF::loadView('pdf/offer_letter',['data' => $array_insert,'employees_salary_package' => $employees_salary_package, 'employees_monthly_salary_breakup' => $employees_monthly_salary_breakup ]);
    //         $offer_letter =  $data['emp_id'].'_'.time().'_'.'offer_letter.pdf';
    //         $path = public_path('pdf/offer_letter');
    //         $pdf_file_name->save($path . '/' . $offer_letter);
    //         $array_insert['file'] = $offer_letter;
    //         DB::table('employees_offer_letter')->insert($array_insert);
    //         }
    //      return ResponseHelper::returnResponse(200,$success,$message);
    //     }
    //     //DB::table('employees_offer_letter')->get();
    //     $employees = User::whereIn('type', [2,3])->get();
    //     $employees_offer_letter= array();
    //      $employees_offer_letter = DB::table('employees_offer_letter')->paginate(5);
    //     return view('hr.employees.offer_letter',compact('employees_offer_letter','employees'));
    // }
    
       public function offere_letter(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'employee_name' => 'required',
                'joining_date' => 'required',
                'reporting_to' => 'required',
                'salary_amount' => 'required',
                'job_title' =>'required',
                'department' => 'required'
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }
            else
            {
                // //$reporting_to = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('reporting_to')->first();
                // // $now_name = DB::table('employees_primary_details')->where(['emp_id' => $reporting_to])->first();
                // //$reporting_to=DB::table('employees_primary_details')->where('emp_id','=',$data['reporting_to']);
                //  $designation = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('designation','department')->first();
                //  dd($designation);
                // No emp_id in this form; proceed with submitted fields only.
                $offere_letter = new Offere_letter(); 
                $offere_letter->employee_name = $data['employee_name'];
                $offere_letter->job_title =  $data['job_title'];
                $offere_letter->department =  $data['department'];
                $offere_letter->reporting_to =$data['reporting_to'];
                $offere_letter->salary_amount =  $data['salary_amount'];
                $offere_letter->hr_name=$data['hr_name'];
                $offere_letter->hr_phone_no =  $data['hr_phone_no'];
                $offere_letter->joining_date =  $data['joining_date'];
                $offere_letter->created_at = date('Y-m-d H:i:s');
                $offere_letter->created_by = auth()->user()->id;
                
                $array_insert = array(
                "employee_name" => $data['employee_name'],
                "job_title" => $data['job_title'],
                //"reporting_to" => $now_name->first_name.' '.$now_name->last_name,
                "reporting_to"=>$data['reporting_to'],
                "salary_amount" => $data['salary_amount'],
                "department" => $data['department'],
                "hr_name"=>$data['hr_name'],
                "hr_phone_no" => $data['hr_phone_no'],
                "joining_date" => $data['joining_date'],
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => auth()->user()->id,     
             );  
            $pdf_file_name = PDF::loadView('pdf/offere_letter',['data' => $array_insert]);
            $offere_letter_pdf =  $data['employee_name'].'_'.time().'_'.'offere_letter.pdf';
            $path = public_path('pdf/offere_letter');
            $pdf_file_name->save($path . '/' . $offere_letter_pdf);
            $offere_letter->file = $offere_letter_pdf;
            $offere_letter->save();
            $success = true;
            $message = array('success'=>array('Offere Letter Submitted Successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        //DB::table('employees_offer_letter')->get();
        $employees = User::whereIn('type', [2,3])->get();
        $employees_offere_letter= array();
        $employees_offere_letter = DB::table('employees_offere_letter')->paginate(5);
        $departments = Department::select('id','department_name')->orderBy('department_name')->get();
        return view('hr.employees.offere_letter',compact('employees_offere_letter','employees','departments'));
    }

    // new offer letter close
    //new offer letter edit
     public function offere_letter_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'employee_name' => 'required',
                'joining_date' => 'required',
                'reporting_to' => 'required',
                'salary_amount' => 'required',
                'job_title' =>'required',
                'department' => 'required'
               ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                 
            
                 $update_arr = array(
                 "employee_name" => $data['employee_name'],
                "job_title" => $data['job_title'],
                //"reporting_to" => $now_name->first_name.' '.$now_name->last_name,
                "reporting_to"=>$data['reporting_to'],
                "salary_amount" => $data['salary_amount'],
                "department" => $data['department'],
                "hr_name"=>$data['hr_name'],
                "hr_phone_no" => $data['hr_phone_no'],
                "joining_date" => $data['joining_date'],
                "updated_at" => date('Y-m-d H:i:s'),
                "updated_by" => auth()->user()->id,
             );  
                $employees_offere_letter =DB::table('employees_offere_letter')->where('id','=',$id)->first();
                $path = public_path('pdf/offere_letter/'.$employees_offere_letter->file);
                @unlink($path);
                 $array_insert = array(
                "employee_name" => $data['employee_name'],
                "job_title" => $data['job_title'],
                //"reporting_to" => $now_name->first_name.' '.$now_name->last_name,
                "reporting_to"=> $data['reporting_to'],
                "salary_amount" => $data['salary_amount'],
                "department" => $data['department'],
                "hr_name"=>$data['hr_name'],
                "hr_phone_no" => $data['hr_phone_no'],
                "joining_date" => $data['joining_date'],
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => auth()->user()->id,
             );  
            $pdf_file_name = PDF::loadView('pdf/offere_letter',['data' => $array_insert]);
            $offere_letter_pdf =  $data['employee_name'].'_'.time().'_'.'offere_letter.pdf';
            $path = public_path('pdf/offere_letter');
            $pdf_file_name->save($path . '/' . $offere_letter_pdf);
            $update_arr['file'] = $offere_letter_pdf;
             $affectedRows = Offere_letter::where("id", $id)->update($update_arr);
            $success = true;
            $message = array('success'=>array('Holidays added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        //DB::table('employees_offer_letter')->get();
        $employees = User::whereIn('type', [2,3])->get();
        $employees_offere_letter = Offere_letter::where('id','=',$id)->first();
        $departments = Department::select('id','department_name')->orderBy('department_name')->get();
        return view('hr.employees.offere_letter_edit',compact('employees_offere_letter','employees','departments'));
    }

    // Preview offere letter PDF in browser
    public function offere_letter_preview($id)
    {
        $record = Offere_letter::where('id', $id)->firstOrFail();
        $array_insert = [
            'employee_name' => $record->employee_name,
            'job_title' => $record->job_title,
            'reporting_to' => $record->reporting_to,
            'salary_amount' => $record->salary_amount,
            'hr_name' => $record->hr_name,
            'hr_phone_no' => $record->hr_phone_no,
            'joining_date' => $record->joining_date,
            'address' => '',
            'department' => $record->department ?? '',
        ];

        $pdf = PDF::loadView('pdf/offere_letter', ['data' => $array_insert])->setPaper('a4', 'portrait');
        return $pdf->stream('offere_letter_preview.pdf');
    }

     public function offer_letter(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'offer_letter_date' => 'required',
                'Probation_period' => 'required',
                'address' => 'required',
                'department' => 'required',
                'designation' => 'required',
                'salary_package' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                // $designation = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('designation','department')->first();
                //  dd($designation);
                //  $reporting_to = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('reporting_to')->first();
                //  $now_name = DB::table('employees_primary_details')->where(['emp_id' => $reporting_to])->first();
                // $first_name = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->first();

                 $primary = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->first();
                 if(!$primary){
                    $success = false;
                    $message = array('error'=>array('Employee primary details not found for the given Employee ID'));
                    return ResponseHelper::returnResponse(200,$success,$message);
                 }
                 // Use provided designation; fallback to primary if missing
                 $designation = $data['designation'] ?? ($primary->designation ?? '');
                 $department = $data['department'] ?? ($primary->department ?? '');
                 $reporting_to = $primary->reporting_to ?? null;
                 $now_name = $reporting_to ? DB::table('employees_primary_details')->where(['emp_id' => $reporting_to])->first() : null;
                $employee_name = trim(($primary->first_name ?? '').' '.($primary->last_name ?? ''));
                $reporting_name = $now_name ? trim(($now_name->first_name ?? '').' '.($now_name->last_name ?? '')) : '';
                $employees_monthly_salary_breakup = DB::table('employees_monthly_salary_breakup')->where(['emp_id' => $data['emp_id']])->first();
                $employees_annual_salary_breakup = DB::table('employees_annual_salary_breakup')->where(['emp_id' => $data['emp_id']])->first();
                $employees_salary_package = $data['salary_package'] ?? DB::table('employees_salary_package')->where(['emp_id' => $data['emp_id']])->pluck('annual_package')->first();
            
                $offer_letter = new Offer_letter(); 
                $offer_letter->emp_id = $data['emp_id'];
                // $offer_letter->employee_name =  $first_name->first_name.''.$first_name->last_name;
                // $offer_letter->designation =  $designation->designation;
                // $offer_letter->reporting = $now_name->first_name.' '.$now_name->last_name;
                $offer_letter->employee_name =  $employee_name;
                $offer_letter->designation =  $designation;
                $offer_letter->department = $department;
                $offer_letter->reporting = $reporting_name;
                $offer_letter->salary_package =  $employees_salary_package;
                $offer_letter->address =  $data['address'];
                $offer_letter->offer_letter_date =  $data['offer_letter_date'];
                 $offer_letter->Probation_period =  $data['Probation_period'];
                $offer_letter->created_at = date('Y-m-d H:i:s');
                $offer_letter->created_by = auth()->user()->id;
                $array_insert = array(
                "emp_id" => $data['emp_id'],
                // "employee_name" => $first_name->first_name.' '.$first_name->last_name,
                // "designation" => $designation->designation,
                // "department" =>  $designation->department,
                "employee_name" => $employee_name,
                "designation" => $designation,
                "department" =>  $department,
                "Probation_period" => $data['Probation_period'],
                // "reporting" => $now_name->first_name.' '.$now_name->last_name,
                "reporting" => $reporting_name,
                "salary_package" => $employees_salary_package,
                "address" => $data['address'],
                "offer_letter_date" => $data['offer_letter_date'],
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => auth()->user()->id,
             );  
            $pdf_file_name = PDF::loadView('pdf/offer_letter',['data' => $array_insert,'employees_salary_package' => $employees_salary_package, 'employees_monthly_salary_breakup' => $employees_monthly_salary_breakup, 'employees_annual_salary_breakup' => $employees_annual_salary_breakup]);
            $offer_letter_pdf =  $data['emp_id'].'_'.time().'_'.'offer_letter.pdf';
            $path = public_path('pdf/offer_letter');
            $pdf_file_name->save($path . '/' . $offer_letter_pdf);
            $offer_letter->file = $offer_letter_pdf;
            $offer_letter->save();
            $success = true;
            $message = array('success'=>array('Offer letter created successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        //DB::table('employees_offer_letter')->get();
        $employees = User::whereIn('type', [2,3])->get();
        $employees_offer_letter= array();
        $employees_offer_letter = DB::table('employees_offer_letter')->latest()->paginate(5);
        // Fetch dropdown data
        $departments = Department::select('id','department_name')->orderBy('department_name')->get();
        $designtion = Designation::get();
        return view('hr.employees.offer_letter',compact('employees_offer_letter','employees','departments','designtion'));
    }
    
    
    public function offer_letter_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'offer_letter_date' => 'required',
                'address' => 'required',
                'Probation_period' => 'required',
                'department' => 'required',
                'designation' => 'required',
                'salary_package' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                 // Use provided designation
                 $designation = $data['designation'];
                // Safely resolve reporting_to and names
                $reporting_to = DB::table('employees_primary_details')
                    ->where(['emp_id' => $data['emp_id']])
                    ->value('reporting_to');

                $reporting_primary = null;
                if ($reporting_to) {
                    $reporting_primary = DB::table('employees_primary_details')
                        ->where(['emp_id' => $reporting_to])
                        ->first();
                }

                $employee_primary = DB::table('employees_primary_details')
                    ->where(['emp_id' => $data['emp_id']])
                    ->first();

                $employee_name = '';
                if ($employee_primary) {
                    $employee_name = trim(($employee_primary->first_name ?? '') . ' ' . ($employee_primary->last_name ?? ''));
                } else {
                    $employee_user = User::where('emp_id', $data['emp_id'])->first();
                    $employee_name = $employee_user->name ?? '';
                }

                $reporting_name = '';
                if ($reporting_primary) {
                    $reporting_name = trim(($reporting_primary->first_name ?? '') . ' ' . ($reporting_primary->last_name ?? ''));
                }

                $department = $data['department'];
                $employees_monthly_salary_breakup = DB::table('employees_monthly_salary_breakup')->where(['emp_id' => $data['emp_id']])->first();
                $employees_annual_salary_breakup = DB::table('employees_annual_salary_breakup')->where(['emp_id' => $data['emp_id']])->first();
                $employees_salary_package = $data['salary_package'] ?? DB::table('employees_salary_package')->where(['emp_id' => $data['emp_id']])->value('annual_package');
            
                 $update_arr = array(
                'emp_id' => $data['emp_id'],
                'employee_name' => $employee_name,
                'designation' => $designation,
                'department' => $department,
                'reporting' => $reporting_name,
                'salary_package' => $employees_salary_package,
                'Probation_period' => $data['Probation_period'],
                'address' => $data['address'],
                'offer_letter_date' => $data['offer_letter_date'],
                'updated_at' =>    date('Y-m-d H:i:s'),
                'updated_by' => auth()->user()->id,
                );
                $employees_offer_letter =DB::table('employees_offer_letter')->where('id','=',$id)->first();
                $path = public_path('pdf/offer_letter/'.$employees_offer_letter->file);
                @unlink($path);
                $array_insert = array(
                "emp_id" => $data['emp_id'],
                "employee_name" => $employee_name,
                "designation" => $designation,
                "department" => $department,
                "reporting" => $reporting_name,
                "salary_package" => $employees_salary_package,
                "address" => $data['address'],
                 "Probation_period" => $data['Probation_period'],
                "offer_letter_date" => $data['offer_letter_date'],
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => auth()->user()->id,
             );  
            $pdf_file_name = PDF::loadView('pdf/offer_letter',['data' => $array_insert,'employees_salary_package' => $employees_salary_package, 'employees_monthly_salary_breakup' => $employees_monthly_salary_breakup, 'employees_annual_salary_breakup' => $employees_annual_salary_breakup]);
            $offer_letter_pdf =  $data['emp_id'].'_'.time().'_'.'offer_letter.pdf';
            $path = public_path('pdf/offer_letter');
            $pdf_file_name->save($path . '/' . $offer_letter_pdf);
            $update_arr['file'] = $offer_letter_pdf;
             $affectedRows = Offer_letter::where("id", $id)->update($update_arr);
            $success = true;
            $message = array('success'=>array('Holidays added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        //DB::table('employees_offer_letter')->get();
        $employees = User::whereIn('type', [2,3])->get();
        $employees_offer_letter = Offer_letter::where('id','=',$id)->first();
        // Fetch dropdown data
        $departments = Department::select('id','department_name')->orderBy('department_name')->get();
        $designtion = Designation::get();
        return view('hr.employees.offer_letter_edit',compact('employees_offer_letter','employees','departments','designtion'));
    }

    // Stream Offer Letter PDF for preview
    public function offer_letter_preview($id)
    {
        $record = DB::table('employees_offer_letter')->where('id', '=', $id)->first();
        if (!$record) {
            abort(404);
        }

        $primary = DB::table('employees_primary_details')->where('emp_id', '=', $record->emp_id)->first();
        $department = $record->department ?? ($primary->department ?? '');

        $employees_monthly_salary_breakup = DB::table('employees_monthly_salary_breakup')->where('emp_id', '=', $record->emp_id)->first();
        $employees_annual_salary_breakup = DB::table('employees_annual_salary_breakup')->where('emp_id', '=', $record->emp_id)->first();
        $employees_salary_package = $record->salary_package ?? DB::table('employees_salary_package')->where('emp_id', '=', $record->emp_id)->pluck('annual_package')->first();

        $data = [
            'emp_id' => $record->emp_id,
            'employee_name' => $record->employee_name,
            'designation' => $record->designation,
            'department' => $department,
            'Probation_period' => $record->Probation_period,
            'reporting' => $record->reporting,
            'salary_package' => $employees_salary_package,
            'address' => $record->address,
            'offer_letter_date' => $record->offer_letter_date,
        ];

        $pdf = PDF::loadView('pdf/offer_letter', [
            'data' => $data,
            'employees_salary_package' => $employees_salary_package,
            'employees_monthly_salary_breakup' => $employees_monthly_salary_breakup,
            'employees_annual_salary_breakup' => $employees_annual_salary_breakup,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('offer_letter_preview.pdf');
    }
    
    //  public function letter_of_intent(Request $request){
    //     if($request->isMethod('post')){
    //         $response_code = 200;
    //         $message = array('error'=>array('something went wrong'));
    //         $success = false ;
    //         $data = $request->all();
    //         $rules=[
    //             'emp_id' => 'required',
    //             'date_of_joining' => 'required',
    //             'probation_period' => 'required',
    //             'stipend' => 'required',
    //         ];
    //         $validator = Validator::make($data,$rules);
    //         if($validator->fails()){
    //             $success = false;
    //             $message = $validator->errors();
    //         }else{
    //              $department = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('department')->first();
    //             $first_name = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->first();
    //       $array_insert = array(
    //             "emp_id" => $data['emp_id'],
    //             "employee_name" => $first_name->first_name.''.$first_name->last_name,
    //             "department_name" => $department,
    //             "date_of_joining" => $data['date_of_joining'],
    //             "probation_period" => $data['probation_period'],
    //             "stipend" => $data['stipend'],
    //             "created_at" => date('Y-m-d H:i:s'),
    //             "created_by" => auth()->user()->id,
    //          );  
    //         $pdf_file_name = PDF::loadView('pdf/letter_of_intent',[
    //         'data' => $array_insert
    //         ]);
    //         $relieving_letter =  $data['emp_id'].'_'.time().'_'.'letter_of_intent.pdf';
    //         $path = public_path('pdf/letter_of_intent');
    //         $pdf_file_name->save($path . '/' . $relieving_letter);
    //         $array_insert['file'] = $relieving_letter;
    //         DB::table('employees_letter_of_intent')->insert($array_insert);
    //         }
    //      return ResponseHelper::returnResponse(200,$success,$message);
    //     }
    //     //DB::table('employees_offer_letter')->get();
    //     $employees = User::whereIn('type', [2,3])->get();
    //     $employees_offer_letter= array();
    //      $employees_letter_of_intent = DB::table('employees_letter_of_intent')->paginate(5);
    //     return view('hr.employees.letter_of_intent',compact('employees_letter_of_intent','employees'));
    // }
    
    
    
    public function letter_of_intent(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required|unique:employees_letter_of_intent',
                'date_of_joining' => 'required',
                'probation_period' => 'required',
                'stipend' => 'required|integer',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $department = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('designation')->first();
                $first_name = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->first();
                $address = DB::table('employees_addresses_details')->where(['emp_id' => $data['emp_id']])->first();
                $letter_of_intent = new Letter_of_intent(); 
                $letter_of_intent->emp_id = $data['emp_id'];
                $letter_of_intent->employee_name =  $first_name->first_name.''.$first_name->last_name;
                $letter_of_intent->department_name =  $department;
                $letter_of_intent->date_of_joining =  $data['date_of_joining'];
                $letter_of_intent->probation_period =  $data['probation_period'];
                $letter_of_intent->stipend =  $data['stipend'];
                $letter_of_intent->created_at = date('Y-m-d H:i:s');
                $letter_of_intent->created_by = auth()->user()->id;
          
                $array_insert = array(
                "emp_id" => $data['emp_id'],
                "employee_name" => $first_name->first_name.''.$first_name->last_name,
                "department_name" => $department,
                "date_of_joining" => $data['date_of_joining'],
                "probation_period" => $data['probation_period'],
                "address" => ($address->current_address_line_one ?? '') . ' ' . ($address->current_address_line_two ?? ''),
                "stipend" => $data['stipend'],
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => auth()->user()->id,
             );  
            $pdf_file_name = PDF::loadView('pdf/letter_of_intent',['data' => $array_insert])->setPaper('a4', 'portrait');
            $relieving_letter =  $data['emp_id'].'_'.time().'_'.'letter_of_intent.pdf';
            $path = public_path('pdf/letter_of_intent');
            $pdf_file_name->save($path . '/' . $relieving_letter);
            $letter_of_intent->file = $relieving_letter;
            $letter_of_intent->save();
            $success = true;
            $message = array('success'=>array('Holidays added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        $employees_offer_letter= array();
         $employees_letter_of_intent = DB::table('employees_letter_of_intent')->latest()->paginate(5);
        return view('hr.employees.letter_of_intent',compact('employees_letter_of_intent','employees'));
    }
    
    
    
    public function letter_of_intent_edit(Request $request,$id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'date_of_joining' => 'required',
                'probation_period' => 'required',
                'stipend' => 'required|integer',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();

            }else{
                $department = DB::table('employees_primary_details')
                    ->where(['emp_id' => $data['emp_id']])
                    ->value('department');
                $primary = DB::table('employees_primary_details')
                    ->where(['emp_id' => $data['emp_id']])
                    ->first();
                $user = DB::table('users')->where('emp_id', $data['emp_id'])->first();
                $employee_name = $primary ? ($primary->first_name.' '.$primary->last_name) : ($user->name ?? '');
                $addr = DB::table('employees_addresses_details')
                    ->where(['emp_id' => $data['emp_id']])
                    ->first();
                $address_line = trim(($addr->current_address_line_one ?? '').' '.($addr->current_address_line_two ?? ''));

                $update_arr = array(
                    'emp_id' => $data['emp_id'],
                    'employee_name' => $employee_name,
                    'department_name' => $department ?? '',
                    'date_of_joining' => $data['date_of_joining'],
                    'probation_period' => $data['probation_period'],
                    'stipend' => $data['stipend'],
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );

                $array_insert = array(
                    'emp_id' => $data['emp_id'],
                    'employee_name' => $employee_name,
                    'department_name' => $department ?? '',
                    'date_of_joining' => $data['date_of_joining'],
                    'probation_period' => $data['probation_period'],
                    'stipend' => $data['stipend'],
                    'address' => $address_line,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => auth()->user()->id,
                );
              $employees_letter_of_intent =DB::table('employees_letter_of_intent')->where('id','=',$id)->first();
              $path = public_path('pdf/letter_of_intent/'.$employees_letter_of_intent->file);
              @unlink($path);
              
            $pdf_file_name = PDF::loadView('pdf/letter_of_intent',['data' => $array_insert]);
            $relieving_letter =  $data['emp_id'].'_'.time().'_'.'letter_of_intent.pdf';
            $path = public_path('pdf/letter_of_intent');
            $pdf_file_name->save($path . '/' . $relieving_letter);
            $update_arr['file'] = $relieving_letter;
             $affectedRows = Letter_of_intent::where("id", $id)->update($update_arr);
            $success = true;
            $message = array('success'=>array('Holidays added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        $employees_letter_of_intent = Letter_of_intent::where('id','=',$id)->first();
        return view('hr.employees.letter_of_intent_edit',compact('employees_letter_of_intent','employees'));
    }

    /* -- new -- */
    public function letter_of_intent_preview($id)
    {
        $record = Letter_of_intent::where('id', $id)->firstOrFail();
        $address = DB::table('employees_addresses_details')->where(['emp_id' => $record->emp_id])->first();
        $array_insert = [
            'emp_id' => $record->emp_id,
            'employee_name' => $record->employee_name,
            'department_name' => $record->department_name,
            'date_of_joining' => $record->date_of_joining,
            'probation_period' => $record->probation_period,
            'address' => ($address->current_address_line_one ?? '') . ' ' . ($address->current_address_line_two ?? ''),
            'stipend' => $record->stipend,
        ];

        $pdf = PDF::loadView('pdf/letter_of_intent', ['data' => $array_insert])->setPaper('a4', 'portrait');
        return $pdf->stream('letter_of_intent_preview.pdf');
    }
    
    function employees_payslip_list(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'payslip_date' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                 $days = Carbon::now()->month(date('m'))->daysInMonth; // 28
                $monthly_package = DB::table('employees_salary_package')->where(['emp_id' => $data['emp_id']])->pluck('monthly_package')->first();
                $designation = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('designation')->first();
                $first_name = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->first();
          $array_insert = array(
                "emp_id" => $data['emp_id'],
                "employee_name" => $first_name->first_name.' '.$first_name->last_name,
                "designation" => $designation,
                "monthly_package" => $monthly_package,
                "day_amount" => round( $monthly_package / $days, 2),
                "days" => $days,
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => auth()->user()->id,
             );  
            DB::table('employees_payslip_list')->insert($array_insert);
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        $employees_payslip_list = DB::table('employees_payslip_list')->latest()->paginate(5);
    return view('hr.employees.payslip',compact('employees_payslip_list','employees'));
    }
    
    
    function employees_payslip_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'payslip_date' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                 $days = Carbon::now()->month(date('m'))->daysInMonth; // 28
                $monthly_package = DB::table('employees_salary_package')->where(['emp_id' => $data['emp_id']])->pluck('monthly_package')->first();
                $designation = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->pluck('designation')->first();
                $first_name = DB::table('employees_primary_details')->where(['emp_id' => $data['emp_id']])->first();
          $update_arr = array(
                "emp_id" => $data['emp_id'],
                "employee_name" => $first_name->first_name.' '.$first_name->last_name,
                "designation" => $designation,
                "monthly_package" => $monthly_package,
                "day_amount" => round( $monthly_package / $days, 2),
                "days" => $days,
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => auth()->user()->id,
             );  
            DB::table('employees_payslip_list')->where("id", $id)->update($update_arr);
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        $employees_payslip_list = DB::table('employees_payslip_list')->where('id','=',$id)->first();
    return view('hr.employees.payslip_edit',compact('employees_payslip_list','employees'));
    }

    public function view_payslip_list(Request $request, $id){
        $employees_payslip_list = DB::table('employees_payslip_list')->where('id','=',$id)->first();
        if (!$employees_payslip_list) {
            abort(404);
        }
        $employees_monthly_salary_breakup = DB::table('employees_monthly_salary_breakup')->where('emp_id','=',$employees_payslip_list->emp_id)->first();
        $employees_pf = DB::table('employees_pf_details')->where('emp_id','=',$employees_payslip_list->emp_id)->first();
        return view('hr.employees.view_payslip',compact('employees_payslip_list','employees_monthly_salary_breakup','employees_pf')); 
    }
    
    public function download_payslip($id)
    {
        $employees_payslip_list = DB::table('employees_payslip_list')->where('id','=',$id)->first();
        if (!$employees_payslip_list) {
            abort(404);
        }
        $employees_monthly_salary_breakup = DB::table('employees_monthly_salary_breakup')->where('emp_id','=',$employees_payslip_list->emp_id)->first();
        $employees_pf = DB::table('employees_pf_details')->where('emp_id','=',$employees_payslip_list->emp_id)->first();

        // Render using dedicated lightweight PDF template for reliability
        $pdf = PDF::loadView('pdf/payslip', [
            'employees_payslip_list' => $employees_payslip_list,
            'employees_monthly_salary_breakup' => $employees_monthly_salary_breakup,
            'employees_pf' => $employees_pf,
        ])->setPaper('a4', 'portrait');

        $fileName = $employees_payslip_list->emp_id.'_'.time().'_payslip.pdf';
        return $pdf->download($fileName);
    }
    
    
    public function letter_of_intent_destroy(Request $request, $id)
    {
        if ($request->ajax()){
            $employees_letter_of_intent =DB::table('employees_letter_of_intent')->where('id','=',$id)->first();
            $path = public_path('pdf/letter_of_intent/'.$employees_letter_of_intent->file);
            @unlink($path);
            if ($employees_letter_of_intent){
                $employees_letter_of_intent = DB::table('employees_letter_of_intent')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }
    
    
    
    
    
    public function relieving_letter_destroy(Request $request, $id)
    {
        if ($request->ajax()){
            $employees_relieving_letter =DB::table('employees_relieving_letter')->where('id','=',$id)->first();
            $path = public_path('pdf/relieving_letter/'.$employees_relieving_letter->file);
            @unlink($path);
            if ($employees_relieving_letter){
                $employees_relieving_letter = DB::table('employees_relieving_letter')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }
    
    
     public function offer_letter_destroy(Request $request, $id)
    {
        if ($request->ajax()){
            $employees_offer_letter =DB::table('employees_offer_letter')->where('id','=',$id)->first();
            $path = public_path('pdf/offer_letter/'.$employees_offer_letter->file);
            @unlink($path);
            if ($employees_offer_letter){
                $employees_offer_letter = DB::table('employees_offer_letter')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }
    public function offere_letter_destroy(Request $request, $id)
    {
        if ($request->ajax()){
            $employees_offere_letter =DB::table('employees_offere_letter')->where('id','=',$id)->first();
            $path = public_path('pdf/offere_letter/'.$employees_offere_letter->file);
            @unlink($path);
            if ($employees_offere_letter){
                $employees_offere_letter = DB::table('employees_offere_letter')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }
     public function payslip_destroy(Request $request, $id)
    {
        if ($request->ajax()){
            $employees_payslip_list =DB::table('employees_payslip_list')->where('id','=',$id)->first();
            if ($employees_payslip_list){
                $employees_payslip_list = DB::table('employees_payslip_list')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}