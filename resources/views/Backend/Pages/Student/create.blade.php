@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')

    <style>
       #preview {

        margin-top: 10px;
        max-width: 200px;
        max-height: 200px;
    }

    .loading-spinner {
        border:4px solid #f1f1f1;
        border-left-color: #000000;;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
        }

        @keyframes spin {
        to {
            transform: rotate(360deg);
        }
        }

    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>Add New Student</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.student.store') }}" method="post" id="addStudentForm" enctype="multipart/form-data">
                    @csrf
                    <!-- Student Personal Information -->
                    <div class="section">
                        <h6  style="color:#777878 ">Student Personal Information</h6>
                        <hr style="border-top: 1px dashed #d3c6c6;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter full name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="birth_date">Birth Date</label>
                                <input type="date" class="form-control" name="birth_date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender">Gender</label>
                                <select class="form-select " name="gender" required>
                                    <option value="">Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control" name="photo" id="photo" accept="image/*">
                                <img id="preview" class="img-fluid" src="#" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px;" />

                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 1px dashed #d3c6c6;">

                    <!-- Guardian Information -->
                    <div class="section">
                        <h6  style="color:#777878 ">Guardian Information</h6>
                        <hr style="border-top: 1px dashed #d3c6c6;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="father_name">Father's Name</label>
                                <input type="text" class="form-control" name="father_name" placeholder="Enter father's name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mother_name">Mother's Name</label>
                                <input type="text" class="form-control" name="mother_name" placeholder="Enter mother's name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="guardian_name">Guardian's Name (if different)</label>
                                <input type="text" class="form-control" name="guardian_name" placeholder="Enter guardian's name">
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 1px dashed #d3c6c6;">

                    <!-- Contact Information -->
                    <div class="section">
                        <h5></h5>
                        <h6  style="color:#777878 ">Contact Information</h6>
                        <hr style="border-top: 1px dashed #d3c6c6;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="current_address">Current Address</label>
                                <input type="text" class="form-control" name="current_address" placeholder="Enter current address" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="permanent_address">Permanent Address</label>
                                <input type="text" class="form-control" name="permanent_address" placeholder="Enter permanent address" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" name="phone" placeholder="Enter phone number" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email">
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 1px dashed #d3c6c6;">

                    <!-- Education Information -->
                    <div class="section">
                        <h6  style="color:#777878 ">Education Information</h6>
                        <hr style="border-top: 1px dashed #d3c6c6;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="current_class">Current Class</label>
                                <select type="text" class="form-select" name="current_class" required>
                                    <option value="">---Select---</option>
                                    @foreach($data as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="previous_school">Previous School</label>
                                <input type="text" class="form-control" name="previous_school" placeholder="Enter previous school">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="previous_class">Previous Class</label>
                                <select type="text" class="form-select" name="previous_class">
                                    <option value="">---Select---</option>
                                    @foreach($data as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="academic_results">Academic Results</label>
                                <input type="text" class="form-control" name="academic_results" placeholder="Enter academic results">
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 1px dashed #d3c6c6;">

                    <!-- Additional Information -->
                    <div class="section">
                        <h6  style="color:#777878 ">Additional Information</h6>
                        <hr style="border-top: 1px dashed #d3c6c6;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="blood_group">Blood Group</label>
                                <input type="text" class="form-control" name="blood_group" placeholder="Enter blood group">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="health_conditions">Health Conditions</label>
                                <input type="text" class="form-control" name="health_conditions" placeholder="Enter health conditions">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="emergency_contact_name">Emergency Contact Name</label>
                                <input type="text" class="form-control" name="emergency_contact_name" placeholder="Enter emergency contact name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="emergency_contact_phone">Emergency Contact Phone</label>
                                <input type="tel" class="form-control" name="emergency_contact_phone" placeholder="Enter emergency contact phone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="religion">Religion</label>
                                <input type="text" class="form-control" name="religion" placeholder="Enter religion">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nationality">Nationality</label>
                                <input type="text" class="form-control" name="nationality" placeholder="Enter nationality">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <select type="text" class="form-select" name="status">
                                    <option value="">---Select---</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="remarks">Remarks</label>
                                <textarea class="form-control" name="remarks" rows="3" placeholder="Enter any remarks"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function(){
        $("select[name='gender']").select2();
        $("select[name='current_class']").select2();
        $("select[name='previous_class']").select2();
        $("select[name='status']").select2();

        $('#photo').change(function() {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#addStudentForm').submit(function(e) {
            e.preventDefault();

            /* Get the submit button */
            var submitBtn = $(this).find('button[type="submit"]');
            var originalBtnText = submitBtn.html();

            submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>');
            submitBtn.prop('disabled', true);

            var form = $(this);
            var url = form.attr('action');
            /*Change to FormData to handle file uploads*/
            var formData = new FormData(this);

            /* Use Ajax to send the request */
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        form[0].reset();
                        $('#preview').hide();
                    }
                },
                error: function(xhr, status, error) {
                    /* Handle errors */
                    console.error(xhr.responseText);
                    if (xhr.status === 422) { // Laravel validation error
                        var errors = xhr.responseJSON.errors;
                        for (var error in errors) {
                            toastr.error(errors[error][0]);
                        }
                    } else {
                        toastr.error('An error occurred while processing the request.');
                    }
                },
                complete: function() {
                    /* Reset button text and enable the button */
                    submitBtn.html(originalBtnText);
                    submitBtn.prop('disabled', false);
                }
            });
        });


    });
  </script>

  @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @elseif(session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
    @endif

@endsection
