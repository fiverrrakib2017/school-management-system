@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
 <link href="{{asset('Backend/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
		<link href="{{asset('Backend/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
		<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">

@endsection
@section('content')
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item" href="{{route('admin.customer.index')}}">Customer</a>
          <span class="breadcrumb-item active">Create</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="" style="padding: 0px !important;">
   <div class="row">
    <div class="col-md-12 m-auto">
    <div class="card mb-3">
      <div class="card-header bg-info text-white">
        <h6>Update Customer</h6>
      </div>
      <form  method="post" action="{{route('admin.customer.update',$data->id)}}" id="productForm" enctype="multipart/form-data">
      @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Full Name</label>
                <input type="text"  class="form-control" name="fullname"  placeholder="Enter Full Name" value="{{$data->fullname}}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Email Address</label>
                <input type="email"  class="form-control" name="email_address" value="{{$data->email_address}}">
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Profile Image</label>
                <input type="file"  class="form-control" name="profile_image" ><br>

                @if (!empty($data->profile_image))
                    <img src="{{ asset('Backend/images/customers/' . $data->profile_image) }}" height="90px" width="150px" alt="">
                @else
                    <img src="{{ asset('Backend/images/default.jpg') }}" height="90px" width="150px" alt="">
                @endif


              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Phone Number</label>
                <input type="text"  class="form-control" name="phone_number" value="{{$data->phone_number}}">
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Emergency Contract</label>
                <input type="text"  class="form-control" name="e_contract" placeholder="Enter Emergency Contract" value="{{ $data->emergency_contract }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">City</label>
                <input type="text"  class="form-control" name="city" value="{{$data->city}}">
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">State</label>
                <input type="text"  class="form-control" name="state" placeholder="Enter State" value="{{$data->state}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Address</label>
                <input type="text"  class="form-control" name="address" placeholder="Enter Address" value="{{$data->address}}">
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Date Of Birth</label>
                <input type="date"  class="form-control" name="date_of_birth" value="{{$data->dob}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Gender</label>
                <select type="text"  class="form-control" name="gender">
                    <option value="1" {{ $data->gender == 1 ? 'selected' : '' }}>Male</option>
                    <option value="0" {{ $data->gender == 0 ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Marital Status</label>
                <select type="text"  class="form-control" name="marital_status">
                    <option value="1" {{ $data->marital_status == 1 ? 'selected' : '' }}>Single</option>
                    <option value="2" {{ $data->marital_status == 2 ? 'selected' : '' }}>Married</option>
                    <option value="3" {{ $data->marital_status == 3 ? 'selected' : '' }}>Devorce</option>
                </select>
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Varification Status</label>
                <select type="text"  class="form-control" name="verification_status">
                    <option value="1" {{ $data->verification_status == 1 ? 'selected' : '' }}>Completed</option>
                    <option value="2" {{ $data->verification_status == 2 ? 'selected' : '' }}>Panding</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Verification Info</label>
                <textarea type="text"  class="form-control" name="verification_info" placeholder="Enter Verification Info">{{ $data->verification_info}}</textarea>
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Opening Balance</label>
                <input type="number"  class="form-control" name="opening_balance" placeholder="Enter Amount" value="{{$data->opening_balance}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Bank Name</label>
                <input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="{{$data->bank_name}}">
            </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Bank Account Name</label>
                <input type="text" class="form-control" name="bank_account_name" placeholder="Enter Bank Account Name" value="{{$data->bank_acc_name}}">
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Bank Account Number</label>
                <input type="number"  class="form-control" name="bank_acc_no" placeholder="Enter Bank Account Number" value="{{$data->bank_acc_no}}">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="">Bank Routing Number</label>
                <input type="number"  class="form-control" name="bank_routing_no" placeholder="Enter Bank Routing Number" value="{{$data->bank_routing_no}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Bank Payment Status</label>
                <select type="text"  class="form-control" name="bank_payment_status">
                    <option value="1"{{ $data->bank_payment_status == 1 ? 'selected' : '' }}>Completed</option>
                    <option value="2" {{ $data->bank_payment_status == 2 ? 'selected' : '' }}>Panding</option>
                </select>
            </div>
            </div>
          </div>


        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success">Update Now</button>

          <button onclick="history.back();" type="button" class="btn btn-danger">Back</button>
        </div>
      </form>

   </div>
    </div>
   </div>
</div><!-- br-section-wrapper -->


@endsection

@section('script')
  <script type="text/javascript">
      $(document).ready(function(){
        imageInput.onchange = evt => {
          const [file] = imageInput.files
          if (file) {
            showImage.src = URL.createObjectURL(file)
          }
        }
      });
  </script>
