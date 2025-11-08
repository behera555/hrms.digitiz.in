@extends('layouts.app')
@section('title', 'Event Calendar')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Events</div>
            </div>
            <div class="page-rightheader ms-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
									<div class="btn-list">
										<a  href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#eventmodal" class="btn btn-primary me-3">Add New Events</a>
									</div>
								</div>
							</div>
        </div>
        <!-- END PAGE HEADER -->
        <!-- ROW -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="hrevent-calender">
                            <div id="calendar1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->
<div class="modal fade" id="eventmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Event</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="events" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Event Title</label>
                        <input type="text" name="event_title" id="event_title" placeholder="{{ __('Event Title') }}" class="form-control" placeholder="text" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Event Date:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="feather feather-calendar"></i>
                                </div>
                            </div><input class="form-control" name="event_date" id="event_date" data-bs-toggle="modaldatepicker" placeholder="{{ __('YYYY-MM-DD') }}" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Event Description</label>
                        <textarea class="form-control" name="event_description" id="event_description" placeholder="{{ __('Event Description') }}" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a>
                    <button id="submit" class="btn btn-primary" type="submit"  name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('backend/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('backend/js/hr/hr-events.js')}}"></script>
<script>
  $('[data-bs-toggle="modaldatepicker"]').datepicker({
            autoHide: true,
            zIndex: 999998
        });
$("#events").submit(function() {
    event.preventDefault();
    // notify(null,'Submitting...', 'top right', 'info');
     $("#submit").prop('disabled', true);
         //show registering on button
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
    axios.post("{{ route('events-post') }}", new FormData($("#events")[0])).then(response => {
        var data = response.data;
        $('#events')[0].reset();
        if (data.success) notif({
            msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Event Submitted Successfully",
            type: "success"
        }, setTimeout(function() {
            location.replace("{{ route('events') }}");
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
/******/
(() => { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!*********************************************!*\
      !*** ./resources/assets/js/hr/hr-events.js ***!
      \*********************************************/
    function _defineProperty(obj, key, value) {
        if (key in obj) {
            Object.defineProperty(obj, key, {
                value: value,
                enumerable: true,
                configurable: true,
                writable: true
            });
        } else {
            obj[key] = value;
        }
        return obj;
    }

    $(function(e) {
        'use strict'; // Select2 

        $('.select2').select2({
            minimumResultsForSearch: Infinity
        }); //Datepicker

        $('.fc-datepicker').datepicker({
            dateFormat: "dd MM yy",
            zIndex: 999998
        });
    });
    /*---- Full Calendar -----*/

    document.addEventListener('DOMContentLoaded', function() {
        var _FullCalendar$Calenda;

        var calendarEl = document.getElementById('calendar1');
        var calendar = new FullCalendar.Calendar(calendarEl, (_FullCalendar$Calenda = {
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            navLinks: true,
            // can click day/week names to navigate views
            businessHours: true,
            // display business hours
            editable: true,
            selectable: true,
            selectMirror: true,
            droppable: true,
            // this allows things to be dropped onto the calendar
            drop: function drop(arg) {
                // is the "remove after drop" checkbox checked?
                if (document.getElementById('drop-remove').checked) {
                    // if so, remove the element from the "Draggable Events" list
                    arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                }
            },
            select: function select(arg) {

                var title = prompt('Event Title:');
                if (title) {
                    calendar.addEvent({
                        title: title,
                        start: arg.start,
                        end: arg.end,
                        allDay: arg.allDay
                    });
                }

                calendar.unselect();
            },
            eventClick: function eventClick(info) {
                let title = info.el.getElementsByClassName("fc-event-title")[0];
                var eventNumber = info.event._def['publicId'];
                var eventTitle = info.event._def['title'];
                var r = confirm('Are you sure you want to delete this event?');
                if (r == true) {
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') }});
                    $.ajax({
                        type: "POST",
                        crossDomain: true,
                        url: "{{ route('delete-events') }}",
                        data: { id : eventNumber},
                        success: function(data) {
                            notify(null, 'Event Delete Successfully', 'top right', 'success', true,"{{ route('events') }}", 1000);
                        },
                    });
                    } else {
                        return false;
                    }
                
            }
        }, _defineProperty(_FullCalendar$Calenda, "editable", true), _defineProperty(
            _FullCalendar$Calenda, "dayMaxEvents", true), _defineProperty(_FullCalendar$Calenda,
            "eventRender",
            function eventRender(event, element) {
                debugger;

                if (event.description.toString() == "Halfday") {
                    element.find(".fc-event-time").after($(
                        "<span class=\"fc-event-icons\"></span>").html(
                        "<i class='fe fe-view'></i> "));
                }
            }), _defineProperty(_FullCalendar$Calenda, "events", [
                <?php foreach($event_data as $key => $val){ ?>{
            id: "<?php echo $val['id'];?>",
            title: "<?php echo $val['event_title'];?>",
            start: "<?php echo $val['event_date'];?>T12:00",
            end: "<?php echo $val['event_date'];?>T12:00"
            }, <?php } ?>
            ]), _FullCalendar$Calenda));
        calendar.render();
    });
    /******/
})();
</script>
@stop