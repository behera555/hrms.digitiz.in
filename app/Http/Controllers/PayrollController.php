<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\User;
use Validator,Auth;
use Illuminate\Http\Request;
use App\Facades\ResponseHelper;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payroll = Payroll::where('id','=',1)->first();
        return view('payroll.list_payroll',compact('payroll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'basic_salary'=>'required|integer|digits_between:1,5',
                'hra_allowance'=>'required|integer|digits_between:1,5',
                'education'=>'required|integer|digits_between:1,5',
                'lta'=>'required|integer|digits_between:1,5',
                'travel_allowances'=>'required|integer|digits_between:1,5',
                'communication'=>'required|integer|digits_between:1,5',
                'special_allowance'=>'required|integer|digits_between:1,5',
                'professional_tax'=>'required|integer|digits_between:1,5',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                $update_arr = array(
                    "basic_salary" => $data['basic_salary'],
                    "hra_allowance" => $data['hra_allowance'],
                    "education" => $data['education'],
                    "lta" => $data['lta'],
                    "travel_allowances" => $data['travel_allowances'],
                    "communication" => $data['communication'],
                    "special_allowance" => $data['special_allowance'],
                    "professional_tax" => $data['professional_tax'],
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = Payroll::where("id", 1)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Payroll Structure    updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
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
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        //
    }
    
     public function all_payroll_list(Request $request){
        $list_emp = User::join('employees_monthly_salary_breakup', 'employees_monthly_salary_breakup.emp_id', '=', 'users.emp_id')->where('users.active',1)->get(['users.name','users.id','users.emp_id', 'employees_monthly_salary_breakup.total_monthly_salary_breakup']);
       //print_r($list_emp);exit;
        return view('payroll.all_payroll_list',compact('list_emp'));
    }

    public function all_expenses_list(Request $request){
        $list_emp = User::join('expenses', 'expenses.created_by', '=', 'users.id')->where('users.active',1)->get(['users.name','users.emp_id', 'expenses.*']);
        return view('payroll.all_expenses_list',compact('list_emp'));
    }
}
