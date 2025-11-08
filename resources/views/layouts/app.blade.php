<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{asset('backend/images/favicon-16x16.png')}}" type="image/x-icon"/>
	<link href="{{asset('backend/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/css/style.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/css/plugins.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/css/animated.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/plugins/icons/icons.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/switcher/css/switcher.css')}}" rel="stylesheet"/>
	<link href="{{asset('backend/switcher/demo.css')}}" rel="stylesheet"/>
	<link rel="stylesheet" href="{{asset('backend/sweetalerts/sweetalert.css')}}" />
</head>
<body>
<body class="app sidebar-mini ltr">
		<!--- GLOBAL-LOADER -->
		@include('includes.loader')
		<!--- END GLOBAL-LOADER -->
		<div class="page">
			<div class="page-main">
				<!-- APP-HEADER -->
                @include('includes.header')
				<!-- APP-HEADER CLOSED -->
				<div class="sticky">
                @include('includes.sidebar')
				</div>
                @yield('content')
			</div> 
            @include('includes.footer')
		</div>
     <a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>
		<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
		<script src="{{asset('backend/plugins/bootstrap/js/popper.min.js')}}"></script>
		<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('backend/plugins/moment/moment.js')}}"></script>
		<script src="{{asset('backend/plugins/circle-progress/circle-progress.min.js')}}"></script>
		<script src="{{asset('backend/plugins/sidemenu/sidemenu.js')}}"></script>
		<script src="{{asset('backend/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
		<script src="{{asset('backend/plugins/p-scrollbar/p-scroll1.js')}}"></script>
		<script src="{{asset('backend/plugins/sidebar/sidebar.js')}}"></script>
		<script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
		<script src="{{asset('backend/plugins/peitychart/jquery.peity.min.js')}}"></script>
		<script src="{{asset('backend/plugins/peitychart/peitychart.init.js')}}"></script>
		<script src="{{asset('backend/plugins/apexchart/apexcharts.js')}}"></script>
		<script src="{{asset('backend/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}"></script>
		<script src="{{asset('backend/plugins/vertical-scroll/vertical-scroll.js')}}"></script>
		<script src="{{asset('backend/plugins/date-picker/jquery-ui.js')}}"></script>
		<script src="{{asset('backend/plugins/chart/chart.bundle.js')}}"></script>
		<script src="{{asset('backend/plugins/chart/utils.js')}}"></script>
		<script src="{{asset('backend/plugins/time-picker/jquery.timepicker.js')}}"></script>
		<script src="{{asset('backend/plugins/time-picker/toggles.min.js')}}"></script>
		<script src="{{asset('backend/plugins/chart.min/chart.min.js')}}"></script>
		<script src="{{asset('backend/plugins/chart.min/rounded-barchart.js')}}"></script>
		<script src="{{asset('backend/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js')}}"></script>
		<script src="{{asset('backend/js/index1.js')}}"></script>
		<script src="{{asset('backend/js/custom.js')}}"></script>
		<script src="{{asset('backend/plugins/modal-datepicker/datepicker.js')}}"></script>
		<script src="{{asset('backend/plugins/bootstrap-timepicker/bootstrap-timepicker.js')}}"></script>
		<script src="{{asset('backend/js/sticky.js')}}"></script>
		<script src="{{asset('backend/js/themeColors.js')}}"></script>
		<script src="{{asset('backend/switcher/js/switcher.js')}}"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script src="{{asset('backend/js/notify.min.js')}}"></script>
		<script src="{{asset('backend/sweetalerts/sweetalert.min.js')}}"></script>
		<script src="{{asset('backend/plugins/notify/js/notifIt.js')}}"></script>
		<script>
			function notify(id=null,message='Something went wrong',position='top right',type='error',willReload=false,url=null,timeout=3000){
            if(id!=null && id != 'input[name=error]' && id!='input[name=error]') $(id).notify(
                             message,
                             {
                                 position:position,
                                 className:type
                             }
                         );
        else  $.notify(
                message,
                {
                    position:'top right',
                    className:type
                }
            );
            if (willReload) setTimeout(function () {
                  if(url==null)window.location.reload();
                  else window.location.href = url;
                }, timeout)
        }
		</script>
<script>
$("#change_password").submit(function() {
    event.preventDefault();
    $("#submit_confirm").prop('disabled', true);
    $("#submit_confirm").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
    @if(auth()->user()->type == 'hr')
    axios.post("{{ route('user-change_password') }}", new FormData($("#change_password")[0])).then(response => {
    @else
    axios.post("{{ route('change_password') }}", new FormData($("#change_password")[0])).then(response => {
    @endif
        var data = response.data;
        $('#change_password')[0].reset();
        if (data.success) notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>You Are Password Change Successfully...", type: "success" });
        else {
            $("#submit_confirm").prop('disabled', false);
            $("#submit_confirm").html('Submit');
            for (var a in data['error']['message']) {
                notify(null, data['error']['message'][a][0], 'botton left');
                if (a == 'success' | a == 'error') notify(null, data['error']['message'][a][0],
                    'botton left');
            }
        }
    }).catch(error => {
            $("#submit_confirm").prop('disabled', false);
            $("#submit_confirm").html('Submit');
            notify(null, 'Something went wrong', 'top right');
            console.log(error);
        });
});

$(document).on('change', '#sel_test',function(){
    var tier_id = $(this).val();
    var row_id = $(this).attr('row-id');
    $.ajax({
        type:'POST',
        url:"{{route('update_shortlisted_list')}}",
        data:{'row_id':row_id,'tier_id':tier_id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(data){
          var dataResult = JSON.parse(data);
          if (dataResult.statusCode==200) notify(null, 'Tier update successfully!!', 'top right', 'success', true,"{{ route('candidates-list') }}", 1000);
        }
    });
});
</script>

@yield('script')
</body>
</html>
