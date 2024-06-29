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
                        <abbr title="Disable">
                            <button type="button" class="btn-sm btn btn-danger">
                                <i class="mdi mdi mdi-wifi-off "></i>
                            </button>
                        </abbr>
                        &nbsp;
                        <abbr title="Reconnect">
                            <button type="button" class="btn-sm btn btn-success">
                                <i class="mdi mdi-sync"></i>
                            </button>
                        </abbr>
                        &nbsp;
                        <abbr title="Edit Customer">
                            <a href="{{ route('admin.student.edit', $student->id) }}">
                                <button type="button" class="btn-sm btn btn-info">
                                    <i class="mdi mdi-account-edit"></i>
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
                            <img src="{{ asset('uploads/photos/' . $student->photo) }}" alt='Profile Picture' class="img-fluid" />
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
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#transaction_datatable").DataTable();
        $("#activities_datatable").DataTable();
    });
</script>
    
@endsection
