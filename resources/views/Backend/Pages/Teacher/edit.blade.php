@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
	<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">

@endsection
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
@section('content')
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <span class="breadcrumb-item active">Teacher Update Page</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;">
  <div class="table-wrapper">
    <div class="card">
      <div class="card-header">
       <h4>Update Teacher </h4>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.teacher.update', $data->id) }}" method="post" enctype="multipart/form-data" id="TeacherForm">
            @csrf
            <!-- Teacher Information -->
            <h6  style="color:#777878 ">Personal Information</h6>
            <hr style="border-top: 1px dashed #d3c6c6;">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{ $data->name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $data->email }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" name="phone" placeholder="Enter phone number" value="{{ $data->phone }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" placeholder="Enter subject" value="{{ $data->subject }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="hire_date">Hire Date</label>
                    <input type="date" class="form-control" name="hire_date" value="{{ $data->hire_date }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Enter address" value="{{ $data->address }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" name="photo" id="photo" accept="image/*">
                    <img id="preview" src="{{ asset('uploads/photos/' . $data->photo) }}" alt="Image Preview" style="display: none;" />
                </div>
            </div>
            <hr style="border-top: 1px dashed #d3c6c6;">
            <!-- Personal Information -->
            <h6  style="color:#777878 ">Personal Information</h6>
            <hr style="border-top: 1px dashed #d3c6c6;">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="father_name">Father's Name</label>
                    <input type="text" class="form-control" name="father_name" placeholder="Enter father's name" value="{{ $data->father_name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mother_name">Mother's Name</label>
                    <input type="text" class="form-control" name="mother_name" value="{{ $data->mother_name }}" placeholder="Enter mother's name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" required>
                        <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ $data->gender == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" class="form-control" name="birth_date" value="{{ $data->birth_date }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="national_id">National ID</label>
                    <input type="text" class="form-control" name="national_id" value="{{ $data->national_id }}" placeholder="Enter national ID" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="religion">Religion</label>
                    <input type="text" class="form-control" name="religion" value="{{ $data->religion }}" placeholder="Enter religion" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="blood_group">Blood Group</label>
                    <input type="text" class="form-control" name="blood_group" value="{{ $data->blood_group }}" placeholder="Enter blood group">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="highest_education">Highest Education</label>
                    <input type="text" class="form-control" name="highest_education" placeholder="Enter highest education" value="{{ $data->highest_education }}" required>
                </div>
            </div>
            <hr style="border-top: 1px dashed #d3c6c6;">
            <!-- Professional Information -->
            <h6  style="color:#777878 ">Professional Information</h6>
            <hr style="border-top: 1px dashed #d3c6c6;">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="previous_school">Previous School</label>
                    <input type="text" class="form-control" name="previous_school" placeholder="Enter previous school" value="{{ $data->previous_school }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="designation">Designation</label>
                    <input type="text" class="form-control" name="designation" value="{{ $data->designation }}" placeholder="Enter designation" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="salary">Salary</label>
                    <input type="number" class="form-control" name="salary" value="{{ $data->salary }}" placeholder="Enter salary" required>
                </div>
            </div>
            <hr style="border-top: 1px dashed #d3c6c6;">
            <!-- Emergency Contact Information -->
            <h6  style="color:#777878 ">Emergency Contact Information</h6>
            <hr style="border-top: 1px dashed #d3c6c6;">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="emergency_contact_name">Emergency Contact Name</label>
                    <input type="text" class="form-control" name="emergency_contact_name" placeholder="Enter emergency contact name" value="{{ $data->emergency_contact_name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="emergency_contact_phone">Emergency Contact Phone</label>
                    <input type="tel" class="form-control" name="emergency_contact_phone" value="{{ $data->emergency_contact_phone }}" placeholder="Enter emergency contact phone" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="remarks">Remarks</label>
                    <textarea class="form-control" name="remarks" rows="2" placeholder="Enter any remarks">{{ $data->remarks }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="remarks">Status</label>
                    <select type="text" class="form-control" name="status">
                        <option value="">---Select---</option>
                        <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Now</button>
        </form>
      </div>
    </div>

  </div><!-- table-wrapper -->
</div><!-- br-section-wrapper -->

@endsection

@section('script')
    <script src="{{asset('Backend/lib/highlightjs/highlight.pack.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $("select[name='status']").select2();
        $("select[name='gender']").select2();

        $('#photo').change(function() {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#TeacherForm').submit(function(e) {
            e.preventDefault();

            /* Get the submit button */
            var submitBtn = $(this).find('button[type="submit"]');
            var originalBtnText = submitBtn.html();

            submitBtn.html('<div class="loading-spinner"></div>');
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
