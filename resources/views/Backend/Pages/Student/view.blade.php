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
                        <div class="card" style="height: 80vh; overflow-y: auto;">
                            <div class="card-header">
                                <img src="{{ asset('uploads/photos/' . $student->photo) }}" alt='Profile Picture' class="img-fluid" style="max-width: 300px; max-height:200px;"/>
                            </div>
                            <div class="card-body" style="padding: 0 !important">
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
                    <div class="col-md-8">
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card shadow  py-2" style="border-left:3px solid #27F10F;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total Payable
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card shadow  py-2" style="border-left:3px solid #27F10F;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total Paid
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card shadow  py-2" style="border-left:3px solid red;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Total Due
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#transaction"
                                                    role="tab">
                                                    <span class="d-none d-md-block">Transaction
                                                    </span><span class="d-block d-md-none"><i
                                                            class="mdi mdi-home-variant h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#invoice"
                                                    role="tab">
                                                    <span class="d-none d-md-block">Invoice</span><span
                                                        class="d-block d-md-none"><i
                                                            class="mdi mdi-account h5"></i></span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane active p-3" id="transaction" role="tabpanel">
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
                                            <div class="tab-pane  p-3" id="invoice" role="tabpanel">
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
