@extends('Backend.Layout.App')
@section('title', 'Customer Profile | Admin Panel')
@section('style')
    <style>
        #supplier_info > li {
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
                            <a href="{{ route('admin.supplier.edit', $data->id) }}">
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
                                <img src="{{ asset('Backend/uploads/photos/' . $data->profile_image) }}" alt='Profile Picture' class="img-fluid" style="max-width: 300px; max-height:200px;"/>
                            </div>
                            <div class="card-body" style="padding: 0 !important">
                                <ul class="list-group" id="supplier_info">
                                    <li class="section-header">
                                        <strong>Personal Information</strong>
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Full Name:</strong> {{ $data->fullname }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Email Address:</strong> {{ $data->email_address }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Phone Number:</strong> {{ $data->phone_number }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Emergency Contact:</strong> {{ $data->emergency_contact }}
                                    </li>
                                    <li class="section-header">
                                        <strong>Address Information</strong>
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>City:</strong> {{ $data->city }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>State:</strong> {{ $data->state }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Address:</strong> {{ $data->address }}
                                    </li>
                                    <li class="section-header">
                                        <strong>Additional Information</strong>
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Date of Birth:</strong> {{ $data->dob }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Gender:</strong> {{ $data->gender == 1 ? 'Male' : 'Female' }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Marital Status:</strong> {{ $data->marital_status }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Verification Status:</strong> {{ $data->verification_status == 1 ? 'Verified' : 'Unverified' }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Verification Info:</strong> {{ $data->verification_info ?: 'N/A' }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Opening Balance:</strong> {{ $data->opening_balance }}
                                    </li>
                                    <li class="section-header">
                                        <strong>Bank Information</strong>
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Bank Name:</strong> {{ $data->bank_name ?: 'N/A' }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Bank Account Name:</strong> {{ $data->bank_acc_name ?: 'N/A' }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Bank Account Number:</strong> {{ $data->bank_acc_no ?: 'N/A' }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Bank Routing Number:</strong> {{ $data->bank_routing_no ?: 'N/A' }}
                                    </li>
                                    <li class="list-group-item list-group-item-action list-group-item-primary">
                                        <strong>Bank Payment Status:</strong> {{ $data->bank_payment_status == 1 ? 'Active' : 'Inactive' }}
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
                                                    Total Invoice
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                   {{ $total_invoice }}
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
                                                    {{ $total_paid_amount ?? 0 }}
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
                                                    {{ $total_due_amount ?? 0 }}
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
                                        <div class="table-responsive">
                                            <table id="datatable-buttons"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                    <th>Invoice Id</th>
                                                    <th>Total Amount</th>
                                                    <th>Paid Amount</th>
                                                    <th>Due Amount</th>
                                                    <th>Status</th>
                                                    <th>Create Date</th>
                                                    <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if (!empty($invoices))
                                                    @foreach ( $invoices as $item)
                                                    <tr>
                                                        <td>{{$item->id}}</td>
                                                        <td>{{intval($item->total_amount)}}</td>
                                                        <td>{{intval($item->paid_amount)}}</td>
                                                        <td>{{intval($item->due_amount)}}</td>
                                                        <td>
                                                        @if ($item->due_amount==0)
                                                        <span class="badge badge-success">Paid</span>
                                                        @else
                                                        <span class="badge badge-danger">Not Paid</span>
                                                        @endif
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                                        <td>
                                                        <a href="{{ route('admin.supplier.invoice.view_invoice',$item->id) }}" class="btn btn-success btn-sm mr-3" ><i class="fa fa-eye"></i></a>
                                                        <a href="{{ route('admin.supplier.invoice.edit_invoice',$item->id) }}" class="btn btn-primary btn-sm mr-3 "><i class="fa fa-edit"></i></a>
                                                        <button class="btn btn-danger btn-sm mr-3 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="{{$item->id}}"><i class="fa fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable-buttons datatable2"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Transaction Date</th>
                                                        <th>Invoice Id</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($supplier_transaction_history))
                                                        @foreach ($supplier_transaction_history as $transaction)
                                                            <tr>
                                                                <td>{{  $transaction->created_at }}
                                                                </td>
                                                                <td>{{ $transaction->invoice_id }}</td>
                                                                <td>{{ $transaction->amount }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

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

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#datatable2").DataTable();
    });
</script>

@endsection
