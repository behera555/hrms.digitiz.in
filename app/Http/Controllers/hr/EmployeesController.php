<?php
namespace App\Http\Controllers\hr;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\Designation;
use App\Models\Experience;
use App\Models\Employee_pf_details;
use App\Models\Education;
use App\Models\WorkReport;
use App\Models\Relation;
use App\Models\Department;
use App\Models\BankDetails;
use App\Models\User;
use Validator,Auth,DB,Hash;
use App\Facades\ResponseHelper;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $employees = Employees::query()->where('department','!=','Management')->paginate(5);
        return view('hr.employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = Employees::orderBy('id', 'desc')->first();
       if($code == null){
        $id = "FASE00".+1;
       }else{
        $id = "FASE00".$code->id+1;
       }
       $designtion = Designation::get();
       $department = Department::get();
       $employees = Employees::get();
        return view('hr.employees.add',compact('id','designtion','department','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
               'prefix'=>'required',
               'first_name'=>'required',
               'last_name'=>'required',
               'role_id'=>'required',
               'gender'=>'required',
               'date_of_birth'=>'required',
               'marital_status'=>'required',
               'blood_group'=>'required',
               'physically_handicapped'=>'required',
               'date_of_joining'=>'required',
               'designation'=>'required',
               'department'=>'required',
               'employment_type'=>'required',
               'profile_pic'=>'required',
              
               'login_email'=>'required|unique:users,email',
               'login_password'=>'required|unique:users,password',

               //'working_email'=>'required',
               'contact_email'=>'required',
               'contact_phone'=>'required',
            

               'current_address_line_one'=>'required',
               //'current_address_line_two'=>'required',
               'current_address_city'=>'required',
               'current_address_state'=>'required',
               'current_address_country'=>'required',
               'current_address_pincode'=>'required',
               'permanent_address_line_one'=>'required',
               //'permanent_address_line_two'=>'required',
               'permanent_address_city'=>'required',
               'permanent_address_state'=>'required',
               'permanent_address_country'=>'required',
               'permanent_address_pincode'=>'required',  

               'pan_card_attachment'=>'required',
               'aadhaar_attachment'=>'required',
            ];
     
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $code = Employees::orderBy('id', 'desc')->first();
                if($code == null){
                 $id = "FASE00".+1;
                }else{
                 $id = "FASE00".$code->id+1;
                }
                if($request->file('profile_pic') != ''){
                $imageName = time() .'_'.$request->file('profile_pic')->getClientOriginalName();
                $request->file('profile_pic')->move('uploads/passport/', $imageName); 
                }else{
                    $imageName = "-";
                }    
                $employees = new Employees();
                $employees->emp_id = $id;
                $employees->first_name = $data['first_name'];
                $employees->last_name = $data['last_name'];
                $employees->display_name = $data['first_name'];
                $employees->gender = $data['gender'];
                $employees->employment_type = $data['employment_type'];
                $employees->blood_group = $data['blood_group'];
                $employees->date_of_birth = date('Y-m-d', strtotime($data['date_of_birth']));
                $employees->designation = $data['designation'];
                $employees->marital_status = $data['marital_status'];
                $employees->blood_group = $data['blood_group'];
                $employees->physically_handicapped = $data['physically_handicapped'];
                $employees->date_of_joining = date('Y-m-d', strtotime($data['date_of_joining']));
                $employees->profile_pic = $imageName;
                $employees->prefix = $data['prefix'];
                $employees->department = $data['department'];
                $employees->reporting_to = $data['reporting_to'];
                $employees->created_at = date('Y-m-d H:i:s');
                $employees->created_by = auth()->user()->id;
                $employees->save();
                $login_data=array('emp_id'=>$id,'email'=>$data['login_email'],"name"=>$data['first_name'].$data['last_name'],"password"=> Hash::make($data['login_password']),"hit_password"=> $data['login_password'],'type'=>$data['role_id']);
                DB::table('users')->insert($login_data);
                $addresses_details=array('emp_id'=>$id,'same_as_current_address'=>$data['sameadd'],'current_address_line_one'=>$data['current_address_line_one'],"current_address_line_two"=>$data['current_address_line_two'],"permanent_address_line_one"=>$data['permanent_address_line_one'],
                'permanent_address_line_two'=>$data['permanent_address_line_two'],"current_address_city"=>$data['current_address_city'],"permanent_address_city"=>$data['permanent_address_city'],
                'current_address_state'=>$data['current_address_state'],"permanent_address_state"=>$data['permanent_address_state'],"current_address_country"=>$data['current_address_country'],
                'permanent_address_country'=>$data['permanent_address_country'],"current_address_pincode"=>$data['current_address_pincode'],"permanent_address_pincode"=>$data['permanent_address_pincode']);
                DB::table('employees_addresses_details')->insert($addresses_details);
                $leave_balance=array('emp_id'=>$id,'month'=>date('m'),"year"=>date('y'),"leave_balance"=> "1.5","created_at" => date('Y-m-d H:i:s'));
                DB::table('leave_balance')->insert($leave_balance);
                
                $employees_conact_us_details = array('emp_id'=>$id,'working_email'=>$data['working_email'],'working_phone'=>$data['working_phone'],"contact_email"=>$data['contact_email'],"contact_phone"=>$data['contact_phone']);
                DB::table('employees_contact_details')->insert($employees_conact_us_details);
                $employees_leave_balance = array('emp_id'=>$id,'month'=>date('m'),'year'=>date('Y'),"leave_balance"=>"1.5");
                DB::table('leave_balance')->insert($employees_leave_balance);
                 
               if($request->file('driving_license_attachment') != ''){
                $driving_license_attachment = $request->file('driving_license_attachment')->getClientOriginalName();
                $request->file('driving_license_attachment')->move('uploads/employee_document/', $driving_license_attachment); 
                }else{
                $driving_license_attachment = "-";
                } 
                
                if($request->file('pan_card_attachment') != ''){
                $pan_card_attachment = $request->file('pan_card_attachment')->getClientOriginalName();
                $request->file('pan_card_attachment')->move('uploads/employee_document/', $pan_card_attachment); 
                }else{
                $pan_card_attachment = "-";
                } 
                
                 if($request->file('passport_attachment') != ''){
                $passport_attachment = $request->file('passport_attachment')->getClientOriginalName();
                $request->file('passport_attachment')->move('uploads/employee_document/', $passport_attachment); 
                }else{
                $passport_attachment = "-";
                } 
                
                if($request->file('aadhaar_attachment') != ''){
                $aadhaar_attachment = $request->file('aadhaar_attachment')->getClientOriginalName();
                $request->file('aadhaar_attachment')->move('uploads/employee_document/', $aadhaar_attachment); 
                }else{
                $aadhaar_attachment = "-";
                } 
                
                if($request->file('voter_id_attachment') != ''){
                $voter_id_attachment = $request->file('voter_id_attachment')->getClientOriginalName();
                $request->file('voter_id_attachment')->move('uploads/employee_document/', $voter_id_attachment); 
                }else{
                $voter_id_attachment = "-";
                } 
                
                 $employee_document = array('emp_id'=>$id,'driving_license_attachment'=>$driving_license_attachment,'pan_card_attachment'=>$pan_card_attachment,"passport_attachment"=>$passport_attachment,"aadhaar_attachment"=>$aadhaar_attachment,"voter_id_attachment"=>$voter_id_attachment,"created_by" => auth()->user()->id);
                DB::table('employees_documents_details')->insert($employee_document);
                $success = true;
                $message = array('success'=>array('Employees added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employess  $employess
     * @return \Illuminate\Http\Response
     */
    public function show(Employess $employess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employess  $employess
     * @return \Illuminate\Http\Response
     */
    
   /* public function viewprofile(Request $request,$id)
    {
        $viewprofile = Employees::where('emp_id',$id)->first();
        return view('hr.employees.employees-viewprofile',array('viewprofile'=>$viewprofile));
    }*/
    function viewprofile(Request $request,$id)
    {
        //$data = $request->all();
        //$viewprofile = Employees::where('employees_primary_details.emp_id',$id)->first();
        //return view('hr.employees.employees-viewprofile',compact('viewprofile'));
        $employees_get = Employees::where('id','=',$id)->first();
        $user_get = User::where('emp_id','=',$employees_get->emp_id)->get()->first();
        //print_r($user_get);exit;
        $contact_details = DB::table('employees_contact_details')->where('emp_id','=',$employees_get->emp_id)->first();
        $addresses_details = DB::table('employees_addresses_details')->where('emp_id','=',$employees_get->emp_id)->first();
        $education_details = DB::table('employees_education_details')->where('emp_id','=',$employees_get->emp_id)->first();
        $employees_education = DB::table('employees_education_details')->where('emp_id','=',$employees_get->emp_id)->get();
        $employees_experience_details = DB::table('employees_previous_experience_details')->where('emp_id','=',$employees_get->emp_id)->get();
        $employees_salary_package = DB::table('employees_salary_package')->where('emp_id','=',$employees_get->emp_id)->get();
        $bank_details = DB::table('employees_bank_details')->where('emp_id','=',$employees_get->emp_id)->get();
        $documents_details = DB::table('employees_documents_details')->where('emp_id','=',$employees_get->emp_id)->first();
        $relations_details = DB::table('employees_relations_details')->where('emp_id','=',$employees_get->emp_id)->get();
        $pf_details = DB::table('employees_pf_details')->where('emp_id','=',$employees_get->emp_id)->get();
        $designtion = Designation::get();
        $department = Department::get();
        $employees = Employees::get();
        return view('hr.employees.employees-viewprofile',compact('employees','designtion','department','employees_get','user_get','contact_details','addresses_details','bank_details','relations_details','documents_details','employees_education','employees_experience_details','employees_salary_package','pf_details'));
    }
    public function edit(Request $request, $id){  
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
               'prefix'=>'required',
               'first_name'=>'required',
               'last_name'=>'required',
               'role_id'=>'required',
               'gender'=>'required',
               'date_of_birth'=>'required',
               'marital_status'=>'required',
               'blood_group'=>'required',
               'physically_handicapped'=>'required',
               'date_of_joining'=>'required',
               'designation'=>'required',
               'department'=>'required',
               'employment_type'=>'required',

                            
                //'working_email'=>'required',
                'contact_email'=>'required',
                'contact_phone'=>'required',
               

               'current_address_line_one'=>'required',
               //'current_address_line_two'=>'required',
               'current_address_city'=>'required',
               'current_address_state'=>'required',
               'current_address_country'=>'required',
               'current_address_pincode'=>'required',
               'permanent_address_line_one'=>'required',
               //'permanent_address_line_two'=>'required',
               'permanent_address_city'=>'required',
               'permanent_address_state'=>'required',
               'permanent_address_country'=>'required',
               'permanent_address_pincode'=>'required', 
               
               //'pan_card_attachment'=>'required',
               //'aadhaar_attachment'=>'required',
            ];
     
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $code = Employees::where('id', $id)->pluck('emp_id')->first();
                
                if($request->file('profile_pic') != ''){
                $imageName = time() .'_'.$request->file('profile_pic')->getClientOriginalName();
                $request->file('profile_pic')->move('uploads/passport/', $imageName); 
                }else{
                    $get_image_name = Employees::where(['id' => $id])->pluck('profile_pic')->first();
                    $imageName = $get_image_name;
                }  
                $update_arr = array(
                    "first_name" => $data['first_name'],
                    "last_name" => $data['last_name'],
                    "display_name" => $data['first_name'],
                    "gender" => $data['gender'],
                    "employment_type" => $data['employment_type'],
                    "blood_group" => $data['blood_group'],
                    "date_of_birth" => date('Y-m-d', strtotime($data['date_of_birth'])),
                    "designation" => $data['designation'],
                    "marital_status" => $data['marital_status'],
                    "physically_handicapped" => $data['physically_handicapped'],
                    "date_of_joining" => date('Y-m-d', strtotime($data['date_of_joining'])),
                    "profile_pic" => $imageName,
                    "prefix" => $data['prefix'],
                    "department" => $data['department'],
                    "reporting_to" => $data['reporting_to'],
                    'updated_at' =>    date('Y-m-d H:i:s'),
                );
                $affectedRows = Employees::where("id", $id)->update($update_arr);  
                $addresses_details=array('same_as_current_address'=>$data['sameadd'],'current_address_line_one'=>$data['current_address_line_one'],"current_address_line_two"=>$data['current_address_line_two'],"permanent_address_line_one"=>$data['permanent_address_line_one'],
                'permanent_address_line_two'=>$data['permanent_address_line_two'],"current_address_city"=>$data['current_address_city'],"permanent_address_city"=>$data['permanent_address_city'],
                'current_address_state'=>$data['current_address_state'],"permanent_address_state"=>$data['permanent_address_state'],"current_address_country"=>$data['current_address_country'],
                'permanent_address_country'=>$data['permanent_address_country'],"current_address_pincode"=>$data['current_address_pincode'],"permanent_address_pincode"=>$data['permanent_address_pincode']);
                DB::table('employees_addresses_details')->where("emp_id",$code)->update($addresses_details);
                $employees_contact_details = array('working_email'=>$data['working_email'],'working_phone'=>$data['working_phone'],"contact_email"=>$data['contact_email'],"contact_phone"=>$data['contact_phone']);
                DB::table('employees_contact_details')->where("emp_id",$code)->update($employees_contact_details);
               
                $employees_documents_details = DB::table('employees_documents_details')->where('emp_id', $code)->orderBy('id', 'desc')->first();
               if($request->file('driving_license_attachment') != ''){
                $driving_license_attachment = $request->file('driving_license_attachment')->getClientOriginalName();
                $request->file('driving_license_attachment')->move('uploads/employee_document/', $driving_license_attachment); 
                }elseif(!empty($employees_documents_details->driving_license_attachment)){
                $driving_license_attachment = $employees_documents_details->driving_license_attachment;
                }else{
                    $driving_license_attachment = "";
                } 
                
                if($request->file('pan_card_attachment') != ''){
                $pan_card_attachment = $request->file('pan_card_attachment')->getClientOriginalName();
                $request->file('pan_card_attachment')->move('uploads/employee_document/', $pan_card_attachment); 
                }elseif(!empty($employees_documents_details->pan_card_attachment)){
                $pan_card_attachment = $employees_documents_details->pan_card_attachment;
                }else{
                   $pan_card_attachment = ""; 
                } 
                
                 if($request->file('passport_attachment') != ''){
                $passport_attachment = $request->file('passport_attachment')->getClientOriginalName();
                $request->file('passport_attachment')->move('uploads/employee_document/', $passport_attachment); 
                }elseif(!empty($employees_documents_details->passport_attachment)){
                $passport_attachment = $employees_documents_details->passport_attachment;
                }else{
                  $passport_attachment = "";  
                } 
                
                if($request->file('aadhaar_attachment') != ''){
                $aadhaar_attachment = $request->file('aadhaar_attachment')->getClientOriginalName();
                $request->file('aadhaar_attachment')->move('uploads/employee_document/', $aadhaar_attachment); 
                }elseif(!empty($employees_documents_details->aadhaar_attachment)){
                $aadhaar_attachment = $employees_documents_details->aadhaar_attachment;
                }else{
                    $aadhaar_attachment = "";
                } 
                
                if($request->file('voter_id_attachment') != ''){
                $voter_id_attachment = $request->file('voter_id_attachment')->getClientOriginalName();
                $request->file('voter_id_attachment')->move('uploads/employee_document/', $voter_id_attachment); 
                }elseif(!empty($employees_documents_details->voter_id_attachment)){
                $voter_id_attachment = $employees_documents_details->voter_id_attachment;
                }else{
                    $voter_id_attachment = "";
                } 
                
                 $employee_document = array('emp_id'=>$id,'driving_license_attachment'=>$driving_license_attachment,'pan_card_attachment'=>$pan_card_attachment,"passport_attachment"=>$passport_attachment,"aadhaar_attachment"=>$aadhaar_attachment,"voter_id_attachment"=>$voter_id_attachment,"created_by" => auth()->user()->id);
                 DB::table('employees_documents_details')->where("emp_id",$code)->update($employee_document);
                $success = true;
                $message = array('success'=>array('Employees added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees_get = Employees::where('id','=',$id)->first();
        $user_get = User::where('emp_id','=',$employees_get->emp_id)->get()->first();
        //print_r($user_get);exit;
        $contact_details = DB::table('employees_contact_details')->where('emp_id','=',$employees_get->emp_id)->first();
        $addresses_details = DB::table('employees_addresses_details')->where('emp_id','=',$employees_get->emp_id)->first();
        $bank_details = DB::table('employees_bank_details')->where('emp_id','=',$employees_get->emp_id)->first();
        $documents_details = DB::table('employees_documents_details')->where('emp_id','=',$employees_get->emp_id)->first();
        $relations_details = DB::table('employees_relations_details')->where('emp_id','=',$employees_get->emp_id)->get();
        $designtion = Designation::get();
        $department = Department::get();
        $employees = Employees::get();
        return view('hr.employees.edit',compact('employees','designtion','department','employees_get','user_get','contact_details','addresses_details','bank_details','relations_details','documents_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employess  $employess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employess $employess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employess  $employess
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        if ($request->ajax()){
            $employees = User::where('emp_id','=',$id)->get()->first();
            if ($employees->active == '0'){
                $update_arr = array(
                    "active" => 1,
                    'updated_at' =>    date('Y-m-d H:i:s'),
                );
                $affectedRows = User::where("emp_id", $id)->update($update_arr);
                return response()->json(array('success' => true));
            }else{
                $update_arr = array(
                    "active" => 0,
                    'updated_at' =>    date('Y-m-d H:i:s'),
                );
                $affectedRows = User::where("emp_id", $id)->update($update_arr);
                return response()->json(array('success' => true));
            }
        }
    }
    
    
     function salary_package_add(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
               'emp_id'=>'required|unique:employees_salary_package,emp_id',
               'annual_package'=>'required|numeric',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $insert_array = array(
                    "emp_id" => $data['emp_id'],
                    "annual_package" => $data['annual_package'],
                    "monthly_package" => round($data['annual_package']/12,2),
                    "created_at" => date('Y-m-d H:i:s'),
                    "created_by" => auth()->user()->id,
                );
                DB::table('employees_salary_package')->insert($insert_array);

                $basic = DB::table('payroll_structure')->where(['id' => 1])->pluck('basic_salary')->first();
                $hra_allowance = DB::table('payroll_structure')->where(['id' => 1])->pluck('hra_allowance')->first();
                $travel_allowances = DB::table('payroll_structure')->where(['id' => 1])->pluck('travel_allowances')->first();
                $education = DB::table('payroll_structure')->where(['id' => 1])->pluck('education')->first();
                $communication = DB::table('payroll_structure')->where(['id' => 1])->pluck('communication')->first();
                $lta = DB::table('payroll_structure')->where(['id' => 1])->pluck('lta')->first();
                $special_allowance = DB::table('payroll_structure')->where(['id' => 1])->pluck('special_allowance')->first();
                $professional_tax = DB::table('payroll_structure')->where(['id' => 1])->pluck('professional_tax')->first();
                
                $annual_basic  =  round($data['annual_package']*$basic/100,2);
                $annual_salary_breakup_array = array(
                "emp_id" => $data['emp_id'],
                "basic"  =>  $annual_basic,
                "hra_allowance"  =>  round($annual_basic * $hra_allowance/100,2),
                "travel_allowances"  =>  round($annual_basic * $travel_allowances/100,2),
                "education" =>  round($annual_basic * $education/100,2),
                "communication"  =>  round($annual_basic * $communication/100,2),
                "lta" =>  round($annual_basic * $lta/100,2),
                "special_allowance"  =>  round($annual_basic * $special_allowance/100,2),
                "professional_tax"  =>  $professional_tax,
                "total_annual_salary_breakup"  => $annual_basic + round($annual_basic * $hra_allowance/100,2) + round($annual_basic * $travel_allowances/100,2) + round($annual_basic * $education/100,2) + 
                 round($annual_basic * $communication/100,2) + round($annual_basic * $lta/100,2) + round($annual_basic * $special_allowance/100,2)
                );
                DB::table('employees_annual_salary_breakup')->insert($annual_salary_breakup_array);

                $monthly_basic  =  round($insert_array['monthly_package']*$basic/100,2);
                $monthly_salary_breakup_array = array(
                    "emp_id" => $data['emp_id'],
                    "basic"  =>  $monthly_basic,
                    "hra_allowance"  =>  round($monthly_basic * $hra_allowance/100,2),
                    "travel_allowances"  =>  round($monthly_basic * $travel_allowances/100,2),
                    "education" =>  round($monthly_basic * $education/100,2),
                    "communication"  =>  round($monthly_basic * $communication/100,2),
                    "lta" =>  round($monthly_basic * $lta/100,2),
                    "special_allowance"  =>  round($monthly_basic * $special_allowance/100,2),
                    "professional_tax"  =>   $professional_tax,
                    "total_monthly_salary_breakup"  => $monthly_basic + round($monthly_basic * $hra_allowance/100,2) + round($monthly_basic * $travel_allowances/100,2) + round($monthly_basic * $education/100,2) +
                    round($monthly_basic * $communication/100,2) + round($monthly_basic * $lta/100,2) + round($monthly_basic * $special_allowance/100,2),
                    "net_pay" => $monthly_basic + round($monthly_basic * $hra_allowance/100,2) + round($monthly_basic * $travel_allowances/100,2) + round($monthly_basic * $education/100,2) +
                    round($monthly_basic * $communication/100,2) + round($monthly_basic * $lta/100,2) + round($monthly_basic * $special_allowance/100,2) - $professional_tax
                    );
                    DB::table('employees_monthly_salary_breakup')->insert($monthly_salary_breakup_array);
                $success = true;
                $message = array('success'=>array('Holidays added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
    }
     
    function employees_salary_package(Request $request){
      $userid = $request->userid;
      $employees = DB::table('employees_salary_package')->select('*')->where('emp_id', $userid)->get();
      $response['data'] = $employees;
      return response()->json($response);
    }

    function salary_package_list(Request $request){
        $employees = User::whereIn('type', [2,3])->get();
        $employees_salary_package = DB::table('employees_salary_package')->paginate(5);
        return view('hr.salary_package.index',compact('employees','employees_salary_package'));
    }
    function salary_package_destroy(Request $request, $id){
        if ($request->ajax()){
            $employees_salary_package = DB::table('employees_salary_package')->where('id','=',$id)->get();
            if ($employees_salary_package){
                $employees_salary_package = DB::table('employees_salary_package')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }

    function salary_package_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id'=>'required',
                'annual_package'=>'required|numeric',
             ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    "annual_package" => $data['annual_package'],
                    "monthly_package" => $data['annual_package']/12,
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = DB::table('employees_salary_package')->where("id", $id)->update($update_arr);
                $employees_id = DB::table('employees_salary_package')->where('id','=',$id)->pluck('emp_id')->first();
                
                $basic = DB::table('payroll_structure')->where(['id' => 1])->pluck('basic_salary')->first();
                $hra_allowance = DB::table('payroll_structure')->where(['id' => 1])->pluck('hra_allowance')->first();
                $travel_allowances = DB::table('payroll_structure')->where(['id' => 1])->pluck('travel_allowances')->first();
                $education = DB::table('payroll_structure')->where(['id' => 1])->pluck('education')->first();
                $communication = DB::table('payroll_structure')->where(['id' => 1])->pluck('communication')->first();
                $lta = DB::table('payroll_structure')->where(['id' => 1])->pluck('lta')->first();
                $special_allowance = DB::table('payroll_structure')->where(['id' => 1])->pluck('special_allowance')->first();
                $professional_tax = DB::table('payroll_structure')->where(['id' => 1])->pluck('professional_tax')->first();
                
                $annual_basic  =  round($data['annual_package']*$basic/100,2);
                $annual_salary_breakup_array = array(
                "emp_id" => $data['emp_id'],
                "basic"  =>  $annual_basic,
                "hra_allowance"  =>  round($annual_basic * $hra_allowance/100,2),
                "travel_allowances"  =>  round($annual_basic * $travel_allowances/100,2),
                "education" =>  round($annual_basic * $education/100,2),
                "communication"  =>  round($annual_basic * $communication/100,2),
                "lta" =>  round($annual_basic * $lta/100,2),
                "special_allowance"  =>  round($annual_basic * $special_allowance/100,2),
                "professional_tax"  =>  $professional_tax,
                "total_annual_salary_breakup"  => $annual_basic + round($annual_basic * $hra_allowance/100,2) + round($annual_basic * $travel_allowances/100,2) + round($annual_basic * $education/100,2) + 
                 round($annual_basic * $communication/100,2) + round($annual_basic * $lta/100,2) + round($annual_basic * $special_allowance/100,2)
                );
                DB::table('employees_annual_salary_breakup')->where("emp_id", $employees_id)->update($annual_salary_breakup_array);

                $monthly_basic  =  round($update_arr['monthly_package']*$basic/100,2);
                $monthly_salary_breakup_array = array(
                    "emp_id" => $data['emp_id'],
                    "basic"  =>  $monthly_basic,
                    "hra_allowance"  =>  round($monthly_basic * $hra_allowance/100,2),
                    "travel_allowances"  =>  round($monthly_basic * $travel_allowances/100,2),
                    "education" =>  round($monthly_basic * $education/100,2),
                    "communication"  =>  round($monthly_basic * $communication/100,2),
                    "lta" =>  round($monthly_basic * $lta/100,2),
                    "special_allowance"  =>  round($monthly_basic * $special_allowance/100,2),
                    "professional_tax"  =>   $professional_tax,
                    "total_monthly_salary_breakup"  => $monthly_basic + round($monthly_basic * $hra_allowance/100,2) + round($monthly_basic * $travel_allowances/100,2) + round($monthly_basic * $education/100,2) +
                    round($monthly_basic * $communication/100,2) + round($monthly_basic * $lta/100,2) + round($monthly_basic * $special_allowance/100,2),
                    "net_pay" => $monthly_basic + round($monthly_basic * $hra_allowance/100,2) + round($monthly_basic * $travel_allowances/100,2) + round($monthly_basic * $education/100,2) +
                    round($monthly_basic * $communication/100,2) + round($monthly_basic * $lta/100,2) + round($monthly_basic * $special_allowance/100,2) - $professional_tax
                    );
                    DB::table('employees_monthly_salary_breakup')->where("emp_id", $employees_id)->update($monthly_salary_breakup_array);
                
                
                $success = true;
                $message = array('success'=>array('Employees Salary Package added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
         $employees_salary_package = DB::table('employees_salary_package')->where('id','=',$id)->get()->first();
         return view('hr.salary_package.edit',compact('employees','employees_salary_package'));
    }


    function hike_calculator_add(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
               'emp_id'=>'required|unique:employees_salary_package,emp_id',
               'annual_package'=>'required|numeric',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $insert_array = array(
                    "emp_id" => $data['emp_id'],
                    "annual_package" => $data['annual_package'],
                    "monthly_package" => $data['annual_package']/12,
                    "created_at" => date('Y-m-d H:i:s'),
                    "created_by" => auth()->user()->id,
                );
                DB::table('employees_salary_package')->insert($insert_array);
                $success = true;
                $message = array('success'=>array('Holidays added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
    }

    function hike_calculator_list(Request $request){
        $employees = User::whereIn('type', [2,3])->get();
        $employees_salary_package = DB::table('employees_salary_package')->paginate(5);
        return view('hr.hike_calculator.index',compact('employees','employees_salary_package'));
    }

    function hike_calculator_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id'=>'required',
                'annual_package'=>'required|numeric',
             ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    "emp_id" => $data['emp_id'],
                    "annual_package" => $data['annual_package'],
                    "monthly_package" => $data['annual_package']/12,
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = DB::table('employees_salary_package')->where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Employees Salary Package added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
         $employees_salary_package = DB::table('employees_salary_package')->where('id','=',$id)->get()->first();
         return view('hr.hike_calculator.edit',compact('employees','employees_salary_package'));
    }

    function hike_calculator_destroy(Request $request, $id){
        if ($request->ajax()){
            $employees_salary_package = DB::table('employees_salary_package')->where('id','=',$id)->get();
            if ($employees_salary_package){
                $employees_salary_package = DB::table('employees_salary_package')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }


    function employees_experience_list(Request $request){
        $employees_previous_experience_details = DB::table('employees_previous_experience_details')->paginate(5);
        return view('hr.employees.employees_experience_list',compact('employees_previous_experience_details'));
    }

    // function employees_experience_create(Request $request){
    //     if($request->isMethod('post')){
    //         $response_code = 200;
    //         $message = array('error'=>array('something went wrong'));
    //         $success = false ;
    //         $data = $request->all();
    //         $rules=[
    //             'emp_id' => 'required',
    //             'experience.*.company_name' => 'required',
    //             'experience.*.job_title' => 'required',
    //             'experience.*.date_of_joining' => 'required',
    //             'experience.*.date_of_relieving' => 'required',
    //             'experience.*.location' => 'required',
    //             'experience.*.description' => 'required',
    //             'experience.*.attachment' => 'required|mimes:pdf|max:5048',
    //         ];
    //         $validator = Validator::make($data,$rules);
    //         if($validator->fails()){
    //             $success = false;
    //             $message = $validator->errors();
    //         }else{
    //                 foreach ($request->experience as $key => $value) {
    //                     $attachment = $data['emp_id'].'_'.time().rand(1,100).'.'.$value['attachment']->extension();
    //                     $value['attachment']->move('uploads/experience/', $attachment); 
    //                     $value['attachment'] = $attachment;
    //                     $value['emp_id'] = $data['emp_id'];
    //                 DB::table('employees_previous_experience_details')->insert($value);
    //                 }
    //         }
    //      return ResponseHelper::returnResponse(200,$success,$message);
    //     }
    //     $employees = User::whereIn('type', [2,3])->get();
    //     return view('hr.employees.employees_experience_add',compact('employees'));
       
    // }
    
    function employees_experience_create(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'experience.*.company_name' => 'required',
                'experience.*.job_title' => 'required',
                'experience.*.date_of_joining' => 'required',
                'experience.*.date_of_relieving' => 'required',
                'experience.*.location' => 'required',
                'experience.*.description' => 'required',
                'experience.*.attachment' => 'required|mimes:pdf|max:5048',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                     
                    foreach ($request->experience as $key => $value) {
                        $attachment = $data['emp_id'].'_'.time().rand(1,100).'.'.$value['attachment']->extension();
                        $value['attachment']->move('uploads/experience/', $attachment);
                        $experience = new Experience();
                        $experience->emp_id =  $data['emp_id']; 
                        $experience->attachment = $attachment;
                        $experience->company_name =  $value['company_name'];
                        $experience->job_title =  $value['job_title'];
                        $experience->date_of_joining =  $value['date_of_joining'];
                        $experience->date_of_relieving =  $value['date_of_relieving'];
                        $experience->location =  $value['location'];
                        $experience->description =  $value['description'];
                        $experience->created_at = date('Y-m-d H:i:s');
                        $experience->save();
                        $success = true;
                        $message = array('success'=>array('Added successfully'));
                    }
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        return view('hr.employees.employees_experience_add',compact('employees'));
       
    }
    function employees_experience_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'company_name' => 'required',
                'job_title' => 'required',
                'date_of_joining' => 'required',
                'date_of_relieving' => 'required',
                'location' => 'required',
                'description' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                if($request->file('attachment') != ''){
                    $imageName = $request->file('attachment')->getClientOriginalName();
                    $request->file('attachment')->move('uploads/experience/', $imageName); 
                    $employees_previous_experience_details = DB::table('employees_previous_experience_details')->where('id','=',$id)->first();
                    $path = public_path('uploads/experience/'.$employees_previous_experience_details->attachment);
                    @unlink($path);
                }else{
                    $employees_previous_experience_details = DB::table('employees_education_details')->where('id','=',$id)->first();    
                    $imageName = $employees_previous_experience_details->attachment;
                    }    
                $update_arr = array(
                    'emp_id' => $request->input('emp_id'),
                    'company_name' => $request->input('company_name'),
                    'job_title' => $request->input('job_title'),
                    'date_of_joining' => $request->input('date_of_joining'),
                    'date_of_relieving' => $request->input('date_of_relieving'),
                    'location' => $request->input('location'),
                    'description' => $request->input('description'),
                    //'attachment' => $imageName,
                );
                $affectedRows = DB::table('employees_previous_experience_details')->where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Assets Allocate updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
            $employees_previous_experience_details = DB::table('employees_previous_experience_details')->where('id','=',$id)->first();
            $employees = User::whereIn('type', [2,3])->get();
        return view('hr.employees.employees_experience_edit',compact('employees', 'employees_previous_experience_details'));
    }

    public function employees_experience_destroy(Request $request, $id){
        if ($request->ajax()){
            $employees_previous_experience_details = DB::table('employees_previous_experience_details')->where('id','=',$id)->first();
            $path = public_path('uploads/experience/'.$employees_previous_experience_details->attachment);
            @unlink($path);
            if ($employees_previous_experience_details){
                $employees_previous_experience_details = DB::table('employees_previous_experience_details')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }
   

    function employees_education_list(Request $request){
        $employees_education_details = DB::table('employees_education_details')->paginate(5);
          return view('hr.employees.employees_education_list',compact('employees_education_details'));
      }

    //   function employees_education_create(Request $request){
    //     if($request->isMethod('post')){
    //         $response_code = 200;
    //         $message = array('error'=>array('something went wrong'));
    //         $success = false ;
    //         $data = $request->all();
    //         $rules=[
    //             'emp_id' => 'required',
    //             'education.*.degree' => 'required',
    //             'education.*.specialization' => 'required',
    //             'education.*.year_of_joining' => 'required',
    //             'education.*.year_of_completion' => 'required',
    //             'education.*.cgpa' => 'required',
    //             'education.*.college' => 'required',
    //             'education.*.attachment' => 'required|mimes:pdf|max:5048',
    //         ];
    //         $validator = Validator::make($data,$rules);
    //         if($validator->fails()){
    //             $success = false;
    //             $message = $validator->errors();
    //         }else{
    //                 foreach ($request->education as $key => $value) {
    //                     $name = $data['emp_id'].'_'.time().rand(1,100).'.'.$value['attachment']->extension();
    //                     $value['attachment']->move('uploads/education/', $name); 
    //                     $value['attachment'] = $name;
    //                     $value['emp_id'] = $data['emp_id'];
    //                 DB::table('employees_education_details')->insert($value);
    //                 }
    //         }
    //      return ResponseHelper::returnResponse(200,$success,$message);
    //     }
    //       $employees = User::whereIn('type', [2,3])->get();
    //       return view('hr.employees.employees_education_add',compact('employees'));
    //   }


      function employees_education_create(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'education.*.degree' => 'required',
                'education.*.specialization' => 'required',
                'education.*.year_of_joining' => 'required',
                'education.*.year_of_completion' => 'required',
                'education.*.cgpa' => 'required',
                'education.*.college' => 'required',
                'education.*.attachment' => 'required|mimes:pdf|max:5048',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                    foreach ($request->education as $key => $value) {
                        $name = $data['emp_id'].'_'.time().rand(1,100).'.'.$value['attachment']->extension();
                        $value['attachment']->move('uploads/education/', $name); 
                        $education = new Education();
                        $education->emp_id  = $data['emp_id'];
                        $education->degree =  $value['degree'];
                        $education->specialization =  $value['specialization'];
                        $education->year_of_joining =  $value['year_of_joining'];
                        $education->year_of_completion =  $value['year_of_completion'];
                        $education->cgpa =  $value['cgpa'];
                        $education->college =  $value['college'];
                        $education->attachment =  $name;
                        $education->save();
                        $success = true;
                        $message = array('success'=>array('Added successfully'));                   
                    }
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
           $employees = User::whereIn('type', [2,3])->get();
          return view('hr.employees.employees_education_add',compact('employees'));
      }


      function employees_education_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'degree' => 'required',
                'specialization' => 'required',
                'year_of_joining' => 'required',
                'year_of_completion' => 'required',
                'cgpa' => 'required',
                'college' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                if($request->file('attachment') != ''){
                    $imageName = $request->file('attachment')->getClientOriginalName();
                    $request->file('attachment')->move('uploads/education/', $imageName); 
                    $employees_education_details = DB::table('employees_education_details')->where('id','=',$id)->first();
                    $path = public_path('uploads/education/'.$employees_education_details->attachment);
                    @unlink($path);
                }else{
                    $employees_education_details = DB::table('employees_education_details')->where('id','=',$id)->first();    
                        $imageName = $employees_education_details->attachment;
                    }    
                $update_arr = array(
                    'emp_id' => $request->input('emp_id'),
                    'specialization' => $request->input('specialization'),
                    'year_of_joining' => $request->input('year_of_joining'),
                    'year_of_completion' => $request->input('year_of_completion'),
                    'cgpa' => $request->input('cgpa'),
                    'college' => $request->input('college'),
                    'attachment' => $imageName,
                );
                $affectedRows = DB::table('employees_education_details')->where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Assets Allocate updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
            $employees_education_details = DB::table('employees_education_details')->where('id','=',$id)->first();
            $employees = User::whereIn('type', [2,3])->get();
        return view('hr.employees.employees_education_edit',compact('employees', 'employees_education_details'));
    }

    
      public function employees_education_destroy(Request $request, $id){
        if ($request->ajax()){
            $employees_education_details = DB::table('employees_education_details')->where('id','=',$id)->first();
            $path = public_path('uploads/education/'.optional($employees_education_details)->attachment);
            @unlink($path);
            if ($employees_education_details){
                $employees_education_details = DB::table('employees_education_details')->where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }


    public function employees_offer_letter(){
      
        DB::table('employees_offer_letter')->get();
        $employees = User::whereIn('type', [2,3])->get();
        return view('hr.employees.offer_letter',compact('employees_offer_letter','employees'));
    }
    
    
    
    
    public function employees_bank_details(Request $request){
        $employees = User::whereIn('type', [2,3])->get();
        $employees_bank_details = DB::table('employees_bank_details')->latest()->paginate(5);
        return view('hr.employees.employees_bank_details_list',compact('employees','employees_bank_details'));
    }

    public function employees_bank_details_create(Request $request){
        
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
               'emp_id' => 'required|unique:employees_bank_details,emp_id',
               'bank_name'=>'required',
               'bank_ifsc'=>'required',
               'bank_account'=>'required',
               'pan'=>'required',
            ];
     
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $bank_details = new BankDetails();
                $bank_details->emp_id = $data['emp_id'];
                $bank_details->bank_name = $data['bank_name'];
                $bank_details->bank_ifsc = $data['bank_ifsc'];
                $bank_details->bank_account = $data['bank_account'];
                $bank_details->pan = $data['pan'];
                $bank_details->uan = $data['uan'];
                $bank_details->pf_number = $data['pf_number'];
                $bank_details->created_at = date('Y-m-d H:i:s');
                $bank_details->created_by = auth()->user()->id;
                $bank_details->save();
                $success = true;
                $message = array('success'=>array('Employees added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        $employees_bank_details = DB::table('employees_bank_details')->latest()->paginate(5);
        return view('hr.employees.employees_bank_details_add',compact('employees','employees_bank_details'));
    }

    public function employees_bank_details_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
               'bank_name'=>'required',
               'bank_ifsc'=>'required',
               'bank_account'=>'required',
               'pan'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    'emp_id' => $request->input('emp_id'),
                    'bank_name' => $request->input('bank_name'),
                    'bank_ifsc' => $request->input('bank_ifsc'),
                    'bank_account' => $request->input('bank_account'),
                    'pan' => $request->input('pan'),
                    'uan' => $request->input('uan'),
                    'pf_number' => $request->input('pf_number'),
                    'updated_at' =>    date('Y-m-d H:i:s'),
                   
                );
                $affectedRows = BankDetails::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Bank added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $bank_details = BankDetails::where('id','=',$id)->first();
        $employees = User::whereIn('type', [2,3])->get();
        return view('hr.employees.employees_bank_details_edit',compact('employees','bank_details'));
    }

    public function employees_bank_details_destroy(Request $request, $id){
        if ($request->ajax()){
            $bank_details = BankDetails::where('id','=',$id)->get();
            if ($bank_details){
                $bank_details = BankDetails::where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }
    
    
    public function employees_relations_details(Request $request){
        $employees = User::whereIn('type', [2,3])->get();
        $employees_relations_details = DB::table('employees_relations_details')->latest()->paginate(5);
        return view('hr.employees.employees_relations_details_list',compact('employees','employees_relations_details'));
    }

    public function employees_relations_details_create(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'moreFields.*.relation_type' => 'required',
                'moreFields.*.gender' => 'required',
                'moreFields.*.first_name' => 'required',
                'moreFields.*.last_name' => 'required',
                'moreFields.*.mobile' => 'required',
                'moreFields.*.profession' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                    foreach ($request->moreFields as $key => $value) {
                        $relation = new Relation();
                        $relation->emp_id =  $data['emp_id']; 
                        $relation->relation_type =  $value['relation_type'];
                        $relation->gender =  $value['gender'];
                        $relation->first_name =  $value['first_name'];
                        $relation->last_name =  $value['last_name'];
                        $relation->mobile =  $value['mobile'];
                        $relation->profession =  $value['profession'];
                        $relation->created_at = date('Y-m-d H:i:s');
                        $relation->save();
                        $success = true;
                        $message = array('success'=>array('Added successfully'));
                    }
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        return view('hr.employees.employees_relations_add',compact('employees'));
    }

    public function employees_relations_details_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'relation_type' => 'required',
                'gender' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'mobile' => 'required',
                'profession' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    'emp_id' => $request->input('emp_id'),
                    'relation_type' => $request->input('relation_type'),
                    'gender' => $request->input('gender'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'mobile' => $request->input('mobile'),
                    'profession' => $request->input('profession'),
                    'updated_at' =>    date('Y-m-d H:i:s'),
                );
                $affectedRows = Relation::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        $employees_relations_details = Relation::where('id','=',$id)->get()->first();
        return view('hr.employees.employees_relations_details_edit',compact('employees','employees_relations_details'));
    }

    public function employees_relations_details_destroy(Request $request, $id){
        if ($request->ajax()){
            $relation = Relation::where('id','=',$id)->get();
            if ($relation){
                $relation = Relation::where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }
    
    
    
    
    
    
    public function employees_pf_details(Request $request){
        $employees = User::whereIn('type', [2,3])->get();
        $employees_pf_details = DB::table('employees_pf_details')->latest()->paginate(5);
        return view('hr.employees.employees_pf_details_list',compact('employees','employees_pf_details'));
    }

    public function employees_pf_details_create(Request $request){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'pf_employee' => 'required',
                'pf_employer' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                    
                        $employee_pf_details = new Employee_pf_details();
                        $employee_pf_details->emp_id =  $data['emp_id']; 
                        $employee_pf_details->pf_employee =  $data['pf_employee'];
                        $employee_pf_details->pf_employer =  $data['pf_employer'];
                        $employee_pf_details->created_at = date('Y-m-d H:i:s');
                        $employee_pf_details->save();
                        $success = true;
                        $message = array('success'=>array('Added successfully'));
                  
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        return view('hr.employees.employees_pf_add',compact('employees'));
    }

    public function employees_pf_details_edit(Request $request, $id){
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'emp_id' => 'required',
                'pf_employee' => 'required',
                'pf_employer' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    'emp_id' => $request->input('emp_id'),
                    'pf_employee' => $request->input('pf_employee'),
                    'pf_employer' => $request->input('pf_employer'),
                    'updated_at' =>    date('Y-m-d H:i:s'),
                );
                $affectedRows = Employee_pf_details::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
        $employees = User::whereIn('type', [2,3])->get();
        $employee_pf_details = Employee_pf_details::where('id','=',$id)->get()->first();
        return view('hr.employees.employees_pf_details_edit',compact('employees','employee_pf_details'));
    }

    public function employees_pf_details_destroy(Request $request, $id){
        if ($request->ajax()){
            $employee_pf_details = Employee_pf_details::where('id','=',$id)->get();
            if ($employee_pf_details){
                $employee_pf_details = Employee_pf_details::where('id','=',$id)->delete();
                return response()->json(array('success' => true));
            }
        }
    }
    
    public function employee_work_report_list(Request $request){
        $work_report_details = DB::table('work_report')->where('emp_id','=',auth()->user()->id)->latest()->paginate(5);
        return view('hr.employees.work_report_list',compact('work_report_details'));
    }
     public function employee_work_report_create(Request $request){
         if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'report' => 'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                    
                        $work_report = new WorkReport();
                        $work_report->emp_id =  auth()->user()->id; 
                        $work_report->report_date =  date('Y-m-d H:i:s');
                        $work_report->report =  $data['report'];
                        $work_report->save();
                        $success = true;
                        $message = array('success'=>array('Added successfully'));
                  
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        return view('hr.employees.work_report_create');
    }
     public function employee_work_report_edit(Request $request, $id){
         if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=['report' => 'required'];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    'report' => $request->input('report'),
                );
                $affectedRows = WorkReport::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Added successfully'));
            }
        return ResponseHelper::returnResponse(200,$success,$message);
        }
         $work_report_details = WorkReport::where('id','=',$id)->get()->first();
        return view('hr.employees.work_report_edit',compact('work_report_details'));
    }
}
