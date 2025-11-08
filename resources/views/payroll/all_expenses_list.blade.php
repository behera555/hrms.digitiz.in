@extends('layouts.app')
@php
use Illuminate\Support\Facades\DB;
@endphp
@section('title', 'Expenses List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Expenses List</div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Expenses List Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Date</th>
                                        <th class="border-bottom-0">Title</th>
                                        <th class="border-bottom-0">Description</th>
                                        <th class="border-bottom-0">Mode of Payment</th>
                                        <th class="border-bottom-0">Bill/Invoice No</th>
                                        <th class="border-bottom-0">Name</th>
                                        <th class="border-bottom-0">Amount	</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list_emp as $key => $row)
                                    <tr>
                                        <td>{{$row->purchase_date}}</td>
                                        <td>{{$row->item_name}}</td>
                                        <td>{{$row->description}}</td>
                                        <td>{{$row->mode_of_payment}}</td>
                                        <td>{{$row->bill_invoice_no}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->price}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                    <td colspan="5"><td>Total</td>
                                    <td colspan="8">{{DB::table('expenses')->sum('price')}}</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->


    </div>

</div>
</div><!-- end app-content-->
@endsection
@section('script')
@stop