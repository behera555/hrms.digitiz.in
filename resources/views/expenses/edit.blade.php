@extends('layouts.app')
@section('title', 'Expenses Edit')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Expenses</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <form method="post" id="expenses" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Item Name') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-code"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="{{$expenses->item_name}}" name="item_name" 
                                            placeholder="{{ __('Item Name') }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Price') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-dollar"></i>
                                            </div>
                                        </div><input name="price" value="{{$expenses->price}}" class="form-control"
                                            placeholder="{{ __('Price') }}" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Mode of Payment') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-cc-amex custom"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="mode_of_payment" value="" placeholder="{{ __('Mode of Payment') }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Bill/Invoice No') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-cc-jcb custom"></i>
                                            </div>
                                        </div><input name="bill_invoice_no" value="" class="form-control" placeholder="{{ __('Bill/Invoice No') }}" type="text">
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Purchase Date') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div><input name="purchase_date" value="{{$expenses->purchase_date}}" class="form-control"
                                        data-bs-toggle="modaldatepicker"   placeholder="{{ __('Purchase Date') }}" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Bill') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-money"></i>
                                            </div>
                                        </div><input name="bill" class="form-control"
                                            placeholder="{{ __('Bill') }}" type="file">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                               <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Description') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-file-text"></i>
                                            </div>
                                        </div>
                                        <textarea id="w3review" class="form-control" name="description"
                                            name="w3review" rows="4" cols="50">{{$expenses->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Aprroval Status') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-money"></i>
                                            </div>
                                        </div>
                                        @if(auth()->user()->type == 'hr')
                                        <select class="form-control" name="aprroval_status">
                                        <option value="Pending" {{ $expenses->aprroval_status == "Pending" ? 'selected' : '' }}>Pending</option>
                                        <option value="Rejected" {{ $expenses->aprroval_status == "Rejected" ? 'selected' : '' }}>Rejected</option>
                                        <option value="Approved" {{ $expenses->aprroval_status == "Approved" ? 'selected' : '' }}>Approved</option>
                                        </select>
                                        @else
                                        <input name="aprroval_status" class="form-control" value="Pending"
                                            placeholder="{{ __('Bill') }}" type="text" readonly>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-2">
                                </div>
                                <div class="col-md-12 col-lg-8">
                                <button id="submit" class="btn btn-primary btn-lg" type="submit" name="submit"> Save</button>
                                    <a href="{{ route('expenses-list') }}" class="btn btn-danger btn-lg">Cancel</a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- END ROW -->
            </div>
        </div>
@endsection
@section('script')
        <script>
$('[data-bs-toggle="modaldatepicker"]').datepicker({
    autoHide: true,
    zIndex: 999998
});

$("#expenses").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
    @if(auth()->user()->type == 'hr')
    axios.post("{{ route('hr-expenses-edit', $expenses->id) }}", new FormData($("#expenses")[0])).then(response => {
    @else
    axios.post("{{ route('expenses-edit', $expenses->id) }}", new FormData($("#expenses")[0])).then(response => {
    @endif
        var data = response.data;
        $('#expenses')[0].reset();
        @if(auth()->user()->type == 'hr')
        if (data.success)  notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Expenses Submitted Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('hr-expenses-list') }}"); }, 3000));
        @else
        if (data.success)  notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Expenses Submitted Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('expenses-list') }}"); }, 3000));
        @endif
        else {
            $("#submit").prop('disabled', false);
            $("#submit").html('Submit');
            for (var a in data['error']['message']) {
                notify(null, data['error']['message'][a][0], 'botton left');
                if (a == 'success' | a == 'error') notify(null, data['error']['message'][a][0],
                    'botton left');
            }
        }
    }).catch(error => {
            $("#submit").prop('disabled', false);
            $("#submit").html('Submit');
            notify(null, 'Something went wrong', 'top right');
            console.log(error);
        });
});
</script>
        @stop