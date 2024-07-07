@extends('Backend.Layout.App')
@section('title', 'Dashboard | Admin Panel')
@section('style')
    <style>
        #student_info  > li {
            border-bottom: 1px dashed;
        }
        .section-header {
        background-color: #007bff; /* Blue background color */
        color: white; /* Text color */
        padding: 5px 10px; /* Padding around text */
        margin-bottom: 5px; /* Bottom margin */
        border-radius: 5px; /* Rounded corners */
    }
    .profile-card {
            max-width: 400px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .profile-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .profile-card .card-body {
            padding: 20px;
        }
        .profile-card h5 {
            margin: 0;
        }
        .profile-card .text-secondary {
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
<div class="row">
    <div class="row">
        <div class="">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="d-flex py-2" style="float:right;">
                        <abbr title="Complain">
                            <button type="button" data-bs-target="#ComplainModalCenter" data-bs-toggle="modal"
                                class="btn-sm btn btn-warning">
                                <i class="mdi mdi-alert-outline"></i>
                            </button>
                        </abbr>
                        &nbsp;
                        <abbr title="Payment received">
                            <button type="button" data-bs-target="#paymentModal" data-bs-toggle="modal"
                                class="btn-sm btn btn-info">
                                <i class="mdi mdi mdi-cash-multiple"></i>
                            </button>
                        </abbr>
                        &nbsp;
                        
                        <abbr title="Delete Student">
                            <button type="button" data-id="{{$student->id ?? ''}}" class="btn-sm btn btn-danger delete-btn">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </abbr>
                        &nbsp;
                        <abbr title="Edit Student">
                            <a href="{{ route('admin.student.edit', $student->id) }}">
                                <button type="button" class="btn-sm btn btn-info">
                                    <i class="mdi mdi-pencil"></i>
                                </button>
                            </a>
                        </abbr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                    <div class="card profile-card">
                        <div class="card-header p-0">
                            
                            @if($student->photo && file_exists(public_path('Backend/uploads/photos/' . $student->photo)))
                                <img src="{{ asset('Backend/uploads/photos/'.$student->photo) }}" alt='Profile Picture' class="img-fluid" />
                            @else
                                <img src="{{ asset('Backend/images/default.jpg') }}" alt='Default Profile Picture' class="img-fluid" />
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h5>{{$student->name}}</h5>
                            <p class="text-secondary mb-1">ID: {{ $student->id }}</p>
                            <p class="text-secondary">{{ $student->phone }}</p>
                        </div>
                    </div>

                    </div>
                    <div class="col-md-8">
                        <div class="container">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#basic_information"
                                                    role="tab">
                                                    <span class="d-none d-md-block">Basic Information
                                                    </span><span class="d-block d-md-none"><i
                                                            class="mdi mdi-home-variant h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-bs-toggle="tab" href="#educations"
                                                    role="tab">
                                                    <span class="d-none d-md-block">Educations
                                                    </span><span class="d-block d-md-none"><i
                                                            class="mdi mdi-home-variant h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-bs-toggle="tab" href="#activities"
                                                    role="tab">
                                                    <span class="d-none d-md-block">Activities
                                                    </span><span class="d-block d-md-none"><i
                                                            class="mdi mdi-home-variant h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-bs-toggle="tab" href="#transaction"
                                                    role="tab">
                                                    <span class="d-none d-md-block">Transaction
                                                    </span><span class="d-block d-md-none"><i
                                                            class="mdi mdi-home-variant h5"></i></span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="basic_information" role="tabpanel">
                                                <div class="card">
                                                    <div class="card-body" style="padding: 0 !important;">
                                                    <ul class="list-group" id="student_info">

<li class="section-header">
    <strong>Personal Information</strong>
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Name:</strong> {{ $student->name }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Birth Date:</strong> {{ $student->birth_date }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Gender:</strong> {{ $student->gender }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Father's Name:</strong> {{ $student->father_name }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Mother's Name:</strong> {{ $student->mother_name }}
</li>
<li class="section-header">
    <strong>Contact Information</strong>
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Current Address:</strong> {{ $student->current_address }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Permanent Address:</strong> {{ $student->permanent_address }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Phone:</strong> {{ $student->phone }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Email:</strong> {{ $student->email ?: 'N/A' }}
</li>
<li class="section-header">
    <strong>Academic Information</strong>
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Current Class:</strong> {{ $student->current_class }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Previous School:</strong> {{ $student->previous_school ?: 'N/A' }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Previous Class:</strong> {{ $student->previous_class ?: 'N/A' }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Academic Results:</strong> {{ $student->academic_results ?: 'N/A' }}
</li>
<li class="section-header">
    <strong>Health Information</strong>
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Blood Group:</strong> {{ $student->blood_group ?: 'N/A' }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Health Conditions:</strong> {{ $student->health_conditions ?: 'N/A' }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Emergency Contact Information</strong>
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Emergency Contact Name:</strong> {{ $student->emergency_contact_name }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Emergency Contact Phone:</strong> {{ $student->emergency_contact_phone }}
</li>
<li class="section-header">
    <strong>Additional Information</strong>
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Religion:</strong> {{ $student->religion ?: 'N/A' }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Nationality:</strong> {{ $student->nationality ?: 'N/A' }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Remarks:</strong> {{ $student->remarks ?: 'N/A' }}
</li>
<li class="list-group-item list-group-item-action list-group-item-primary">
    <strong>Status:</strong> {{ $student->status == 1 ? 'Active' : 'Inactive' }}
</li>
</ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="transaction" role="tabpanel">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="table-responsive">
                                                                <table id="transaction_datatable"
                                                                    class="table table-bordered dt-responsive nowrap"
                                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ID</th>
                                                                            <th>Amount</th>
                                                                            <th>Date</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <!--  -->
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane " id="invoice" role="tabpanel">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="table-responsive">
                                                                <table id="invoice_datatable"
                                                                    class="table table-bordered dt-responsive nowrap"
                                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Invoice id</th>
                                                                            <th>Sub Total</th>
                                                                            <th>Discount</th>
                                                                            <th>Grand Total</th>
                                                                            <th>Create Date</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="ticket-list">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="tab-pane " id="activities" role="tabpanel">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="table-responsive">
                                                                <table id="activities_datatable"
                                                                    class="table table-bordered dt-responsive nowrap"
                                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Id</th>
                                                                            <th>Date</th>
                                                                            <th>In Time</th>
                                                                            <th>Out Time</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<div id="deleteModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <form action="{{route('admin.student.delete')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-trash"></i>
                </div>
                <h4 class="modal-title w-100">Are you sure?</h4>
                <input type="hidden" name="id" value="">
                <a class="close" data-bs-dismiss="modal" aria-hidden="true"><i class="mdi mdi-close"></i></a>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#transaction_datatable").DataTable();
        $("#activities_datatable").DataTable();

        
        /** Handle Delete button click**/
        $(document).on('click', '.delete-btn', function () {
            var id = $(this).data('id');
            $('#deleteModal').modal('show');
            console.log("Delete ID: " + id);
            var value_input = $("input[name*='id']").val(id);
        });


        /** Handle form submission for delete **/
        $('#deleteModal form').submit(function(e){
            e.preventDefault();
            /*Get the submit button*/
            var submitBtn =  $('#deleteModal form').find('button[type="submit"]');

            /* Save the original button text*/
            var originalBtnText = submitBtn.html();

            /*Change button text to loading state*/
            submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>');

            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();
            /** Use Ajax to send the delete request **/
            $.ajax({
            type:'POST',
            'url':url,
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#deleteModal').modal('hide');
                    toastr.success(response.message);
                    window.location.href = "{{ route('admin.student.index') }}";
                }
            },

            error: function (xhr, status, error) {
                /** Handle  errors **/
                toastr.error(xhr.responseText);
            },
            complete: function () {
                submitBtn.html(originalBtnText);
                }
            });
        });

    });

    
</script>
    
@endsection
