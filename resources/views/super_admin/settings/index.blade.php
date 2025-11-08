@extends('layouts.app')
@section('title', 'Organization Information Dashboard')
@section('content')
<div class="page">
    <div class="page-main">
        <div class="app-content main-content">
            <div class="side-app main-container">
                <div class="page-header d-xl-flex d-block">
                    <div class="page-leftheader">
                        <div class="page-title">Configure Organization Information</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tab-content adminsetting-content" id="setting-tabContent">
                            <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                                <div class="card">
                                <form method="post" id="update_org" enctype="multipart/form-data">
                                    @csrf()@method('POST')                
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Organization Name') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-globe"></i>
                                                            </div>
                                                        </div>
                                                    <input type="text" class="form-control" name="organization_name"
                                                        value="{{$org_info->organization_name}}"
                                                        placeholder="{{ __('Organization Name') }}" value="dayone">
                                                </div></div>
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Organization Started On') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="feather feather-calendar"></i>
                                                            </div>
                                                        </div><input name="organization_started_on"
                                                            value="{{$org_info->organization_started_on}}"
                                                            class="form-control fc-datepicker"
                                                            placeholder="{{ __('Organization Started On') }}"
                                                            type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Primary Phone Number') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-phone"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            name="primary_phone_number"
                                                            value="{{$org_info->primary_phone_number}}"
                                                            placeholder="{{ __('Primary Phone Number') }}" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Secondary Phone Number') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-phone"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            name="secondary_phone_number"
                                                            value="{{$org_info->secondary_phone_number}}"
                                                            placeholder="{{ __('Secondary Phone Number') }}"
                                                            value="www.spruko.com">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Fax Number') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-fax"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="fax_number"
                                                            value="{{$org_info->fax_number}}"
                                                            placeholder="{{ __('Fax Number') }}" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Country') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <select data-placeholder="Choose a country..."
                                                        class="form-control select2-show-search custom-select languages"
                                                        name="country">
                                                        <option label="Choose country"></option>
                                                        <option value="India" {{($org_info->country ==='India') ? 'selected' : ''}}>India</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('State') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select data-placeholder="Choose a State ..."
                                                            class="form-control select2-show-search custom-select languages"
                                                            name="state">
                                                            <option label="Choose State"></option>
                                                            <option value="Telangana" {{($org_info->state ==='Telangana') ? 'selected' : ''}}>Telangana</option>
                                                            <option value="Karnataka" {{($org_info->state ==='Karnataka') ? 'selected' : ''}}>Karnataka</option>
                                                            <option value="Tamil Nadu" {{($org_info->state ==='Tamil Nadu') ? 'selected' : ''}}>Tamil Nadu</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('City') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <select data-placeholder="Choose a City..."
                                                        class="form-control select2-show-search custom-select languages"
                                                        name="city">
                                                        <option label="Choose City"></option>
                                                        <option value="Hyderabad" {{($org_info->city ==='Hyderabad') ? 'selected' : ''}}>Hyderabad</option>
                                                        <option value="Bangalore" {{($org_info->state ==='Bangalore') ? 'selected' : ''}}>Bangalore</option>
                                                        <option value="Coimbatore" {{($org_info->state ==='Coimbatore') ? 'selected' : ''}}>Coimbatore</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Currency') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <select data-placeholder="Choose Currency"
                                                        class="form-control select2 custom-select" name="currency">
                                                        <option label="Choose Currency"></option>
                                                        <option value="$" {{($org_info->currency ==='$') ? 'selected' : ''}}>US DOllar(USD) $</option>
                                                        <option value="₹" {{($org_info->currency ==='₹') ? 'selected' : ''}}>Indian Rupee (INR) ₹</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Address') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <textarea rows="2" name="address" class="form-control"
                                                        placeholder="something text here...">{{$org_info->address}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Organization Logo') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label"></label>
                                                        <input class="form-control" id="imageUpload" name="image"
                                                            type="file">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Image Preview') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    @if(!empty($org_info->org_logo))
                                                    <img src="{{url($org_info->org_logo)}}" class="profile-user-img img-responsive img-circle"
                                                        id="imagePreview" style="border-radius: 50%;width: 50%;">
                                                    @else
                                                    <img src="{{asset('backend/images/no_image.png')}}" class="profile-user-img img-responsive img-circle"
                                                        id="imagePreview" style="border-radius: 50%;width: 50%;">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Office Time') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input class="form-control" id="time" name="time" type="time" value="{{$org_info->time}}">
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-success">Save Changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
    <script>
    $(document).ready(function() {
        $("#imageUpload").change(function(data) {
            var imageFile = data.target.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(imageFile);
            reader.onload = function(evt) {
                $('#imagePreview').attr('src', evt.target.result);
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
        });
    });
    </script>
 <script>
$("#image-target2").on('click',function(){
$("#info input[name=image]").trigger('click');});
$("#info input[name=image]").on('change',function(){
            var reader = new FileReader();
            reader.onloadend = function () {
               $('#image-target2').attr('src', reader.result);
            }
            reader.readAsDataURL(this.files[0]);
        });      
    $("#update_org").submit(function() {
    event.preventDefault();
    axios.post("{{ route('super-admin-settings') }}", new FormData($("#update_org")[0])).then(response => {
        var data = response.data;
        // if (data.success) notify(null, 'You Are Successfully Holidays', 'top right', 'success', false);
        if (data.success)  notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i>Profile updated successfully!!</b>", type: "success" });
        else {
            for (var a in data['error']['message']) {
                notify(null, data['error']['message'][a][0], 'botton left');
                if (a == 'success' | a == 'error') notify(null, data['error']['message'][a][0],
                    'botton left');
            }
        }
    }).catch(error => {
        console.log(error);
    });
});
    </script>
    @stop