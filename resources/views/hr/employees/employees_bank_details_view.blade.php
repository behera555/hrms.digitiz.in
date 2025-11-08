@extends('layouts.app')
@section('title', 'Bank Details')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Bank Details') }}</div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    @if($employees_bank_details->active == '1')
                    <form method="post" id="employees_bank_details_post" action="" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('BANK IFSC') }}</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('Bank') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="bank_name"
                                                placeholder="{{ __('Bank') }}"
                                                value="{{$employees_bank_details->bank_name}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('BANK IFSC') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">

                                            <input type="text" name="bank_ifsc" class="form-control"
                                                placeholder="{{ __('BANK IFSC') }}"
                                                value="{{$employees_bank_details->bank_ifsc}}">
                                            
                                        </div>
                                    </div>


                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                     <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('BANK ACCOUNT') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="bank_account" class="form-control"
                                                placeholder="{{ __('BANK ACCOUNT') }}"
                                                value="{{$employees_bank_details->bank_account}}">
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('PAN') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="pan" class="form-control"
                                                value="{{$employees_bank_details->pan}}" placeholder="{{ __('PAN') }}">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('UAN') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="uan" class="form-control"
                                                value="{{$employees_bank_details->uan}}"
                                                placeholder="{{ __('UAN') }}">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('PF NUMBER') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="pf_number" class="form-control"
                                                placeholder="{{ __('PF NUMBER') }}" value="{{$employees_bank_details->pf_number}}">
                                            
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                   
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-2">
                                </div>

                                <div class="col-md-12 col-lg-8">
                                    <button id="submit" class="btn btn-primary btn-lg" type="submit" name="submit">
                                        Save</button>
                                </div>
                               
                                
                            </div>
                        </div>
                    </form>
                     @elseif($employees_bank_details->active == '3')
                         <form method="post" id="employees_bank_details_post" action="" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('BANK IFSC') }}</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('Bank') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="bank_name"
                                                placeholder="{{ __('Bank') }}"
                                                value="{{$employees_bank_details->bank_name}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('BANK IFSC') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">

                                            <input type="text" name="bank_ifsc" class="form-control"
                                                placeholder="{{ __('BANK IFSC') }}"
                                                value="{{$employees_bank_details->bank_ifsc}}">
                                            
                                        </div>
                                    </div>


                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                     <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('BANK ACCOUNT') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="bank_account" class="form-control"
                                                placeholder="{{ __('BANK ACCOUNT') }}"
                                                value="{{$employees_bank_details->bank_account}}">
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('PAN') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="pan" class="form-control"
                                                value="{{$employees_bank_details->pan}}" placeholder="{{ __('PAN') }}">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('UAN') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="uan" class="form-control"
                                                value="{{$employees_bank_details->uan}}"
                                                placeholder="{{ __('UAN') }}">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('PF NUMBER') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="pf_number" class="form-control"
                                                placeholder="{{ __('PF NUMBER') }}" value="{{$employees_bank_details->pf_number}}">
                                            
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                   
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-2">
                                </div>

                                <div class="col-md-12 col-lg-8">
                                    <button id="submit" class="btn btn-primary btn-lg" type="submit" name="submit">
                                        Save</button>
                                </div>
                               
                                
                            </div>
                        </div>
                    </form>
                     
                    @elseif($employees_bank_details->active == '2')
                   <form method="post" id="employees_bank_details_post" action="" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('BANK IFSC') }}</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('Bank') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="bank_name"
                                                placeholder="{{ __('Bank') }}"
                                                value="{{$employees_bank_details->bank_name}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('BANK IFSC') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">

                                            <input type="text" name="bank_ifsc" class="form-control"
                                                placeholder="{{ __('BANK IFSC') }}"
                                                value="{{$employees_bank_details->bank_ifsc}}">
                                            
                                        </div>
                                    </div>


                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                     <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('BANK ACCOUNT') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="bank_account" class="form-control"
                                                placeholder="{{ __('BANK ACCOUNT') }}"
                                                value="{{$employees_bank_details->bank_account}}">
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('PAN') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="pan" class="form-control"
                                                value="{{$employees_bank_details->pan}}" placeholder="{{ __('PAN') }}">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('UAN') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="uan" class="form-control"
                                                value="{{$employees_bank_details->uan}}"
                                                placeholder="{{ __('UAN') }}">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('PF NUMBER') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="pf_number" class="form-control"
                                                placeholder="{{ __('PF NUMBER') }}" value="{{$employees_bank_details->pf_number}}">
                                            
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                   
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-2">
                                </div>

                                <div class="col-md-12 col-lg-8">
                                    <button id="submit" class="btn btn-primary btn-lg" type="submit" name="submit" disabled>
                                        Request Sent Successfully</button>
                                </div>
                               
                                
                            </div>
                        </div>
                    </form>
                     @elseif($employees_bank_details->active == '0') 
                     <form method="post" id="send_request_post" action="" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('BANK IFSC') }}</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('Bank') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="bank_name"
                                                placeholder="{{ __('Bank') }}"
                                                value="{{$employees_bank_details->bank_name}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('BANK IFSC') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">

                                            <input type="text" name="bank_ifsc" class="form-control"
                                                placeholder="{{ __('BANK IFSC') }}"
                                                value="{{$employees_bank_details->bank_ifsc}}" readonly>
                                            
                                        </div>
                                    </div>


                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                     <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('BANK ACCOUNT') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="bank_account" class="form-control"
                                                placeholder="{{ __('BANK ACCOUNT') }}"
                                                value="{{$employees_bank_details->bank_account}}" readonly>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('PAN') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="pan" class="form-control"
                                                value="{{$employees_bank_details->pan}}" placeholder="{{ __('PAN') }}" readonly>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('UAN') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="uan" class="form-control"
                                                value="{{$employees_bank_details->uan}}"
                                                placeholder="{{ __('UAN') }}" readonly>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('PF NUMBER') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="pf_number" class="form-control"
                                                placeholder="{{ __('PF NUMBER') }}" value="{{$employees_bank_details->pf_number}}" readonly>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-2">
                                </div>

                                <div class="col-md-12 col-lg-8">
                                    <button id="submit" class="btn btn-primary btn-lg" type="submit" name="submit">
                                       Sent Request  </button>
                                </div>
                               
                                
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div>
@endsection
@section('script')
<script>
$("#employees_bank_details_post").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
    axios.post("{{ route('employee-bank-details-update', $employees_bank_details->id) }}", new FormData($("#employees_bank_details_post")[0])).then(
        response => {
            var data = response.data;
            if (data.success) notif({
                msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Bank Details Updated Successfully",
                type: "success"
            }, setTimeout(function() {
                location.replace("{{ route('employee-bank-details-list') }}");
            }, 3000));
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


<script>
$("#send_request_post").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
    axios.post("{{ route('employee-bank-details-send-request', $employees_bank_details->id) }}", new FormData($("#send_request_post")[0])).then(
        response => {
            var data = response.data;
            if (data.success) notif({
                msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Request Send Successfully",
                type: "success"
            }, setTimeout(function() {
                location.replace("{{ route('employee-bank-details-list') }}");
            }, 3000));
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