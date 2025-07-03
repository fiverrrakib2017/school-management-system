@extends('Backend.Layout.App')
@section('title', 'Dashboard | SMS Settings | Admin Panel')
@section('style')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 m-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> Biometric SMS Settings</h3>
                    </div>
                    <form action="{{ route('admin.biometric.sms.settings.store') }}" id="addSmsForm" method="POST">
                        @csrf
                        <div class="card-body">

                            <!-- SMS Enable -->
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="sms_enable" name="sms_enable" value="1"
                                           {{ old('sms_enable', $data->sms_enable ?? false) ? 'checked' : '' }}>
                                    <label for="sms_enable">Enable SMS Notification</label>
                                </div>
                            </div>

                            <!-- Attendance Status -->
                            <div class="form-group">
                                <label>Send SMS for Attendance Status:</label><br>
                                <div class="icheck-primary d-inline mr-3">
                                    <input type="checkbox" id="status_present" name="status_present" value="Present"   @if($data->on_present ?? false) checked @endif>
                                    <label for="status_present">Present</label>
                                </div>
                                <div class="icheck-primary d-inline mr-3">
                                    <input type="checkbox" id="status_absent" name="status_absent" value="Absent"   @if($data->on_absent ?? false) checked @endif>
                                    <label for="status_absent">Absent</label>
                                </div>
                            </div>
                            <!-- Additional Settings -->
                            <div class="form-group">
                                <label>Present Message Template</label>
                                <textarea name="present_template" class="form-control">{{ $data->present_template ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Absent Message Template</label>
                                <textarea name="absent_template" class="form-control">{{ $data->absent_template ?? '' }}</textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="history.back();" class="btn btn-danger">Back</button>
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // $('#sms_enable').change(function() {
            //     if ($(this).is(':checked')) {
            //         $('#status_present, #status_absent').prop('disabled', false);
            //     } else {
            //         $('#status_present, #status_absent').prop('disabled', true);
            //     }
            // });

            // if ($('#sms_enable').is(':checked')) {
            //     $('#status_present, #status_absent').prop('disabled', false);
            // } else {
            //     $('#status_present, #status_absent').prop('disabled', true);
            // }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#addSmsForm").submit(function(e) {
                e.preventDefault();

                /* Get the submit button */
                var submitBtn = $(this).find('button[type="submit"]');
                var originalBtnText = submitBtn.html();

                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden"></span>'
                    );
                submitBtn.prop('disabled', true);

                var form = $(this);
                var formData = new FormData(this);

                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: formData,
                    beforeSend: function() {
                        form.find(':input').prop('disabled', true);
                    },
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            /* Validation error*/
                            var errors = xhr.responseJSON.errors;

                            /* Loop through the errors and show them using toastr*/
                            $.each(errors, function(field, messages) {
                                $.each(messages, function(index, message) {
                                    /* Display each error message*/
                                    toastr.error(message);
                                });
                            });
                        } else {
                            /*General error message*/
                            toastr.error('An error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        submitBtn.html(originalBtnText);
                        submitBtn.prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection
