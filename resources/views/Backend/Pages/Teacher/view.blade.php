@extends('Backend.Layout.App')
@section('title', 'Dashboard | Admin Panel')
@section('style')
    <style>
        #teacher_info  > li {
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
                            <a href="{{ route('admin.teacher.edit', $teacher->id) }}">
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
                                <img src="{{ asset('uploads/photos/' . $teacher->photo) }}" alt='Profile Picture' class="img-fluid" style="max-width: 300px; max-height:200px;"/>
                            </div>
                            <div class="card-body" style="padding: 0 !important">
                                <ul class="list-group" id="teacher_info">
                                    <li class="section-header">
                                        <strong>Personal Information</strong>
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Name:</strong> {{ $teacher->name }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Email:</strong> {{ $teacher->email }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Phone:</strong> {{ $teacher->phone }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Subject:</strong> {{ $teacher->subject }}
                                    </li>
                                    <li class="section-header">
                                        <strong>Personal Details</strong>
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Hire Date:</strong> {{ $teacher->hire_date }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Address:</strong> {{ $teacher->address }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Gender:</strong> {{ $teacher->gender }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Birth Date:</strong> {{ $teacher->birth_date }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>National ID:</strong> {{ $teacher->national_id }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Religion:</strong> {{ $teacher->religion }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Blood Group:</strong> {{ $teacher->blood_group ?: 'N/A' }}
                                    </li>
                                    <li class="section-header">
                                        <strong>Professional Details</strong>
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Highest Education:</strong> {{ $teacher->highest_education }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Previous School:</strong> {{ $teacher->previous_school ?: 'N/A' }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Designation:</strong> {{ $teacher->designation }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Salary:</strong> {{ $teacher->salary }}
                                    </li>
                                    <li class="section-header">
                                        <strong>Emergency Contact Information</strong>
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Emergency Contact Name:</strong> {{ $teacher->emergency_contact_name }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Emergency Contact Phone:</strong> {{ $teacher->emergency_contact_phone }}
                                    </li>
                                    <li class="section-header">
                                        <strong>Additional Information</strong>
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Remarks:</strong> {{ $teacher->remarks ?: 'N/A' }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Status:</strong> {{ $teacher->status == 1 ? 'Active' : 'Inactive' }}
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
