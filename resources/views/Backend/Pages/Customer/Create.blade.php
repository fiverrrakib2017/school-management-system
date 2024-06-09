
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
    <style>
        #preview {
        margin-top: 10px;
        max-width: 200px;
        max-height: 200px;
    }
    </style>
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
    <div class="card">
      <div class="card-header bg-info text-white">
        <h6>Add New Customer</h6>
      </div>
      <form method="post" action="{{route('admin.customer.store')}}" id="productForm" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Full Name</label>
                    <input type="text"  class="form-control" name="fullname"  placeholder="Enter Full Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email Address</label>
                    <input type="email"  class="form-control" name="email_address" placeholder="Enter Email Address">
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Profile Image</label>
                    <input type="file"  class="form-control" name="profile_image" >
                    <img id="preview" src="#" alt="Image Preview" style="display: none;" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Phone Number</label>
                    <input type="text"  class="form-control" name="phone_number" placeholder="Enter Phone Number">
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Emergency Contract</label>
                    <input type="number"  class="form-control" name="e_contract" placeholder="Enter Emergency Contract">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">City</label>
                    <input type="text"  class="form-control" name="city" placeholder="Enter City">
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">State</label>
                    <input type="text"  class="form-control" name="state" placeholder="Enter State">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Address</label>
                    <input type="text"  class="form-control" name="address" placeholder="Enter Address">
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Date Of Birth</label>
                    <input type="date"  class="form-control" name="date_of_birth">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Gender</label>
                    <select type="text"  class="form-control" name="gender">
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                    </select>
                </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Marital Status</label>
                    <select type="text"  class="form-control" name="marital_status">
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Devorce</option>
                    </select>
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Varification Status</label>
                    <select type="text"  class="form-control" name="verification_status">
                        <option value="1">Completed</option>
                        <option value="2">Panding</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Verification Info</label>
                    <textarea type="text"  class="form-control" name="verification_info" placeholder="Enter Verification Info"></textarea>
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Opening Balance</label>
                    <input type="number"  class="form-control" name="opening_balance" placeholder="Enter Amount">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Bank Name</label>
                    <input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name">
                </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Bank Account Name</label>
                    <input type="text" class="form-control" name="bank_account_name" placeholder="Enter Bank Account Name">
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Bank Account Number</label>
                    <input type="number"  class="form-control" name="bank_acc_no" placeholder="Enter Bank Account Number">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Bank Routing Number</label>
                    <input type="number"  class="form-control" name="bank_routing_no" placeholder="Enter Bank Routing Number">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Bank Payment Status</label>
                    <select type="text"  class="form-control" name="bank_payment_status">
                        <option value="1">Completed</option>
                        <option value="2">Panding</option>
                    </select>
                </div>
                </div>
              </div>



        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success">Add Now</button>
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
        $('input[name="profile_image"]').change(function() {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
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

     @if(session("errors"))
        <script>
            var errors = @json(session('errors'));
            errors.forEach(function(error) {
              toastr.error(error);
            });
        </script>
    @endif
@endsection
