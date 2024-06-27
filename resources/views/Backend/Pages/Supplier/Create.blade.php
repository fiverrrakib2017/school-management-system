@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>Add New Supplier</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.supplier.store') }}" method="post" id="addForm" enctype="multipart/form-data">
                    @csrf
                    <!-- Customer Personal Information -->
                    <div class="section">
                        <h6 style="color:#777878">Supplier Personal Information</h6>
                        <hr style="border-top: 1px dashed #d3c6c6;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" name="fullname" placeholder="Enter full name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email_address">Email Address</label>
                                <input type="email" class="form-control" name="email_address" placeholder="Enter email address">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/*">
                                <img id="preview" class="img-fluid" src="#" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px;" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" placeholder="Enter phone number">
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 1px dashed #d3c6c6;">

                    <!-- Emergency Contact Information -->
                    <div class="section">
                        <h6 style="color:#777878">Emergency Contact Information</h6>
                        <hr style="border-top: 1px dashed #d3c6c6;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="e_contract">Emergency Contact</label>
                                <input type="number" class="form-control" name="e_contract" placeholder="Enter emergency contact">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" placeholder="Enter city">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state">State</label>
                                <input type="text" class="form-control" name="state" placeholder="Enter state">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter address">
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 1px dashed #d3c6c6;">

                    <!-- Additional Information -->
                    <div class="section">
                        <h6 style="color:#777878">Additional Information</h6>
                        <hr style="border-top: 1px dashed #d3c6c6;">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" class="form-control" name="date_of_birth">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="gender">Gender</label>
                                <select class="form-select" name="gender">
                                    <option value="">Select gender</option>
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="marital_status">Marital Status</label>
                                <select class="form-select" name="marital_status">
                                    <option value="1">Single</option>
                                    <option value="2">Married</option>
                                    <option value="3">Divorced</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 1px dashed #d3c6c6;">

                    <!-- Verification Information -->
                    <div class="section">
                        <h6 style="color:#777878">Verification Information</h6>
                        <hr style="border-top: 1px dashed #d3c6c6;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="verification_status">Verification Status</label>
                                <select class="form-select" name="verification_status">
                                    <option value="1">Completed</option>
                                    <option value="2">Pending</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="verification_info">Verification Info</label>
                                <textarea class="form-control" name="verification_info" placeholder="Enter verification info"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 1px dashed #d3c6c6;">

                    <!-- Banking Information -->
                    <div class="section">
                        <h6 style="color:#777878">Banking Information</h6>
                        <hr style="border-top: 1px dashed #d3c6c6;">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="opening_balance">Opening Balance</label>
                                <input type="number" class="form-control" name="opening_balance" placeholder="Enter amount">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" name="bank_name" placeholder="Enter bank name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="bank_account_name">Bank Account Name</label>
                                <input type="text" class="form-control" name="bank_account_name" placeholder="Enter bank account name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="bank_acc_no">Bank Account Number</label>
                                <input type="number" class="form-control" name="bank_acc_no" placeholder="Enter bank account number">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="bank_routing_no">Bank Routing Number</label>
                                <input type="number" class="form-control" name="bank_routing_no" placeholder="Enter bank routing number">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="bank_payment_status">Bank Payment Status</label>
                                <select class="form-select" name="bank_payment_status">
                                    <option value="1">Completed</option>
                                    <option value="2">Pending</option>
                                </select>
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
        $("select[name='marital_status']").select2();
        $("select[name='verification_status']").select2();
        $("select[name='bank_payment_status']").select2();

        $('#profile_image').change(function() {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#addForm').submit(function(e) {
            e.preventDefault();

            /* Get the submit button */
            var submitBtn = $(this).find('button[type="submit"]');
            var originalBtnText = submitBtn.html();

            submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>');
            submitBtn.prop('disabled', true);

            var form = $(this);
            var formData = new FormData(this);

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    }
                },
                error: function(xhr) {
                    toastr.error('An error occurred while adding the customer.');
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
