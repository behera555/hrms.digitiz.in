<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                Copyrights © {{ now()->year }} All Rights Reserved by <a style="color:#b70040;"
                    href="https://digitiz.in/" target="_blank;">Digitiz</a>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->
<!-- CHANGE PASSWORD MODAL -->
<div class="modal fade" id="changepasswordnmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Change Password') }}</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="change_password" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">{{ __('Old Password') }}</label>
                        <input type="password" name="old_password" class="form-control" placeholder="{{ __('Old Password') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ __('New Password') }}</label>
                        <input type="password" name="new_password" class="form-control"placeholder="{{ __('New Password') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ __('Confirm New Password') }}</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="{{ __('Confirm New Password') }}"
                            value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_confirm" class="btn btn-primary" type="submit" name="submit">Confirm</button>
                    <a onclick="javascript:window.location.reload()" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END CHANGE PASSWORD MODAL  -->


<!-- CLOCK-IN MODAL -->
<div class="modal fade" id="clockinmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="feather feather-clock  me-1"></span>Clock In</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="countdowntimer"><span id="clocktimer" class="border-0"></span></div>
                <div class="form-group">
                    <label class="form-label">Note:</label>
                    <textarea class="form-control" rows="3">Some text here...</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Clock In</button>
            </div>
        </div>
    </div>
</div>
<!-- END CLOCK-IN MODAL -->
