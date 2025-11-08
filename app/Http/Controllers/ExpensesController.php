<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Validator,Auth,DB;
use App\Facades\ResponseHelper;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $expenses = Expenses::query()->paginate(5);
        if(auth()->user()->type == 'hr'){
             $expenses = Expenses::query()->paginate(5);
        }else{
            $expenses = Expenses::query()->where('created_by',auth()->user()->id)->paginate(5);
        }
        return view('expenses.index',compact('expenses'));
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
                'item_name'=>'required',
                'price'=>'required|integer',
                'purchase_date'=>'required',
                'bill'=>'mimes:jpeg,jpg,pdf,png,gif|required|max:50000',
                'description'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                if($request->file('bill') != ''){
                    $bill = $request->file('bill')->getClientOriginalName();
                    $request->file('bill')->move('uploads/expenses/', $bill); 
                    }else{
                        $bill = "-";
                    }    
                $expenses = new Expenses();
                $expenses->item_name = $data['item_name'];
                $expenses->price = $data['price'];
                $expenses->mode_of_payment = $data['mode_of_payment'];
                $expenses->bill_invoice_no = $data['bill_invoice_no'];
                $expenses->purchase_date = $data['purchase_date'];
                $expenses->description = $data['description'];
                $expenses->bill = $bill;
                $expenses->aprroval_status = 'Pending';
                $expenses->created_at = date('Y-m-d H:i:s');
                $expenses->created_by = auth()->user()->id;
                $expenses->save();
                $success = true;
                $message = array('success'=>array('Expenses added successfully'));
            }
         return ResponseHelper::returnResponse(200,$success,$message);
        }
        return view('expenses.add');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->isMethod('post')){
            $response_code = 200;
            $message = array('error'=>array('something went wrong'));
            $success = false ;
            $data = $request->all();
            $rules=[
                'item_name'=>'required',
                'price'=>'required|integer',
                'purchase_date'=>'required',
                
                'description'=>'required',
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                $success = false;
                $message = $validator->errors();
            }else{
                if($request->file('bill') != ''){
                    $bill = $request->file('bill')->getClientOriginalName();
                    $request->file('bill')->move('uploads/expenses/', $bill); 
                    }else{
                        $get_bill = Expenses::where('id','=',$id)->first();
                        $bill = $get_bill->bill;
                    }    
                $update_arr = array(
                    'item_name' => $request->input('item_name'),
                    'price' => $request->input('price'),
                    'mode_of_payment' => $request->input('mode_of_payment'),
                    'bill_invoice_no' => $request->input('bill_invoice_no'),
                    'purchase_date' => $request->input('purchase_date'),
                    'description' => $request->input('description'),
                    'bill' => $bill,
                    'aprroval_status' => $request->input('aprroval_status'),
                    'updated_at' =>    date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->id,
                );
                $affectedRows = Expenses::where("id", $id)->update($update_arr);
                $success = true;
                $message = array('success'=>array('Award updated successfully'));
            }
            return ResponseHelper::returnResponse(200,$success,$message);
            }
        $expenses = Expenses::where('id','=',$id)->first();
        return view('expenses.edit',compact('expenses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()){
            $expenses = Expenses::findOrFail($id);
            if ($expenses){
                $expenses->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}
