@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
<style>
   body{
   background-color: #f3f6f8;
   margin-top:20px;
   }
   .thumb-lg {
   height: 88px;
   width: 88px;
   }
   .profile-user-box {
   position: relative;
   border-radius: 5px
   }
   .bg-custom {
   background-color: #02c0ce!important;
   }
   .profile-user-box {
   position: relative;
   border-radius: 5px;
   }
   .card-box {
   padding: 20px;
   border-radius: 3px;
   margin-bottom: 30px;
   background-color: #fff;
   }
   .inbox-widget .inbox-item img {
   width: 40px;
   }
   .inbox-widget .inbox-item {
   border-bottom: 1px solid #f3f6f8;
   overflow: hidden;
   padding: 10px 0;
   position: relative
   }
   .inbox-widget .inbox-item .inbox-item-img {
   display: block;
   float: left;
   margin-right: 15px;
   width: 40px
   }
   .inbox-widget .inbox-item img {
   width: 40px
   }
   .inbox-widget .inbox-item .inbox-item-author {
   color: #313a46;
   display: block;
   margin: 0
   }
   .inbox-widget .inbox-item .inbox-item-text {
   color: #98a6ad;
   display: block;
   font-size: 14px;
   margin: 0
   }
   .inbox-widget .inbox-item .inbox-item-date {
   color: #98a6ad;
   font-size: 11px;
   position: absolute;
   right: 7px;
   top: 12px
   }
   .comment-list .comment-box-item {
   position: relative
   }
   .comment-list .comment-box-item .commnet-item-date {
   color: #98a6ad;
   font-size: 11px;
   position: absolute;
   right: 7px;
   top: 2px
   }
   .comment-list .comment-box-item .commnet-item-msg {
   color: #313a46;
   display: block;
   margin: 10px 0;
   font-weight: 400;
   font-size: 15px;
   line-height: 24px
   }
   .comment-list .comment-box-item .commnet-item-user {
   color: #98a6ad;
   display: block;
   font-size: 14px;
   margin: 0
   }
   .comment-list a+a {
   margin-top: 15px;
   display: block
   }
   .ribbon-box .ribbon-primary {
   background: #2d7bf4;
   }
   .ribbon-box .ribbon {
   position: relative;
   float: left;
   clear: both;
   padding: 5px 12px 5px 12px;
   margin-left: -30px;
   margin-bottom: 15px;
   font-family: Rubik,sans-serif;
   -webkit-box-shadow: 2px 5px 10px rgba(49,58,70,.15);
   -o-box-shadow: 2px 5px 10px rgba(49,58,70,.15);
   box-shadow: 2px 5px 10px rgba(49,58,70,.15);
   color: #fff;
   font-size: 13px;
   }
   .text-custom {
   color: #02c0ce!important;
   }
   .badge-custom {
   background: #02c0ce;
   color: #fff;
   }
   .badge {
   font-family: Rubik,sans-serif;
   -webkit-box-shadow: 0 0 24px 0 rgba(0,0,0,.06), 0 1px 0 0 rgba(0,0,0,.02);
   box-shadow: 0 0 24px 0 rgba(0,0,0,.06), 0 1px 0 0 rgba(0,0,0,.02);
   padding: .35em .5em;
   font-weight: 500;
   }
   .text-muted {
   color: #98a6ad!important;
   }
   .font-13 {
   font-size: 13px!important;
   }
</style>
<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
<link href="{{asset('Backend/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('Backend/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<!-- Bracket CSS -->
<link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">
@endsection
@section('content')
<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <!-- meta -->
         <div class="profile-user-box card-box bg-custom">
            <div class="row">
               <div class="col-sm-6">
                  <span class="float-left mr-3">
                     <img src="{{ asset(request()->host() . '/Backend/images/customers/' . $data->profile_photo) }}" alt="" class="thumb-lg rounded-circle">
                  </span>

                  <div class="media-body text-white">
                     <h4 class="mt-1 mb-1 font-18">
                        @if (!empty($data->name))
                        {{ $data->name }}
                        @endif
                     </h4>
                     <p class="text-light mb-0">
                        @if (!empty($data->address))
                        {{ $data->address }}
                        @endif
                     </p>
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="text-right">
                     <a href="{{route('admin.customer.edit',$data->id)}}" class="btn btn-light waves-effect"><i class="mdi mdi-account-settings-variant mr-1"></i> Edit Profile</a>
                  </div>
               </div>
            </div>
         </div>
         <!--/ meta -->
      </div>
   </div>
   <!-- end row -->
   <div class="row">
      <div class="col-xl-4">
         <!-- Personal-Information -->
         <div class="card-box">
            <h4 class="header-title mt-0">Personal Information</h4>
            <hr>
            <div class="panel-body">
               <input type="text" id="customer_id" class="d-none" value="{{$data->id}}">
               <div class="text-left">
                  <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">
                     @if (!empty($data->name))
                     {{ $data->name }}
                     @endif
                     </span>
                  </p>
                  <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">
                     @if (!empty($data->phone))
                     {{ $data->phone }}
                     @endif
                     </span>
                  </p>
                  <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">
                     @if (!empty($data->email))
                     {{ $data->email}}
                     @endif
                     </span>
                  </p>
                  <p class="text-muted font-13"><strong>Location :</strong> <span class="m-l-15">
                     @if (!empty($data->address))
                     {{ $data->address }}
                     @endif
                     </span>
                  </p>

                  <p class="text-muted font-13"><strong>Genger :</strong> <span class="m-l-15">
                     @if (!empty($data->gender==1))
                     Male
                     @else
                     Female
                     @endif
                     </span>
                  </p>
                  <p class="text-muted font-13"><strong>Languages :</strong> <span class="m-l-5"><span class="flag-icon flag-icon-us m-r-5 m-t-0" title="us"></span> <span>English</span> </span><span class="m-l-5"><span class="flag-icon flag-icon-de m-r-5" title="de"></span> <span>German</span> </span><span class="m-l-5"><span class="flag-icon flag-icon-es m-r-5" title="es"></span> <span>Spanish</span> </span><span class="m-l-5"><span class="flag-icon flag-icon-fr m-r-5" title="fr"></span> <span>French</span></span>
                  </p>
               </div>
               <ul class="social-links list-inline mt-4 mb-0">
                  <li class="list-inline-item"><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                  <li class="list-inline-item"><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                  <li class="list-inline-item"><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
               </ul>
            </div>
         </div>
         <!-- Personal-Information -->
      </div>
      <div class="col-xl-8">
         <div class="row">
            <div class="col-sm-4">
               <div class="card-box tilebox-one">
                  <i class="icon-layers float-right text-muted"></i>
                  <h6 class="text-muted text-uppercase mt-0">Total Invoice</h6>
                  @if (!empty($invoice_count))
                  <h2 class="counter" data-stop="{{$invoice_count}}">{{intval($invoice_count)}}</h2>
                  @else
                  0
                  @endif
               </div>
            </div>
            <!-- end col -->
            <div class="col-sm-4">
               <div class="card-box tilebox-one">
                  <i class="icon-paypal float-right text-muted"></i>
                  <h6 class="text-muted text-uppercase mt-0">Total Paid</h6>
                  @if (!empty($total_paid_amount))
                  <h2 class="counter" data-stop="{{$total_paid_amount}}">{{intval($total_paid_amount)}}</h2>
                  @else
                  0
                  @endif
               </div>
            </div>
            <!-- end col -->
            <div class="col-sm-4">
               <div class="card-box tilebox-one">
                  <i class="icon-rocket float-right text-muted"></i>
                  <h6 class="text-muted text-uppercase mt-0">Total Due</h6>
                  @if (!empty($total_due_amount))
                  <h2 class="counter" data-stop="{{$total_due_amount}}">{{intval($total_due_amount)}}</h2>
                  @else
                  0
                  @endif
               </div>
            </div>
            <!-- end col -->
         </div>
         <!-- end row -->
         <div class="card-box">
            <h4 class="header-title mb-3">Invoice</h4>
            <div class="">
               <table id="invoice" class="table display responsive nowrap">
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
                           <a href="{{ route('admin.customer.invoice.view_invoice',$item->id) }}" class="btn btn-success btn-sm mr-3" ><i class="fa fa-eye"></i></a>
                           <a href="{{ route('admin.customer.invoice.edit_invoice',$item->id) }}" class="btn btn-primary btn-sm mr-3 "><i class="fa fa-edit"></i></a>
                           <button class="btn btn-danger btn-sm mr-3 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="{{$item->id}}"><i class="fa fa-trash"></i></button>
                        </td>
                     </tr>
                     @endforeach
                     @endif
                  </tbody>
               </table>
            </div>
         </div>
         <div class="card-box">
            <h4 class="header-title mb-3">Transaction</h4>
            <div class="">
               <table id="datatable1" class="table display responsive nowrap">
                  <thead>
                     <tr>
                        <th>Invoice Id</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                  @if (!empty($transaction_history))
                        @foreach ($transaction_history as $item)
                           <tr>
                              <td>{{$item->invoice_id}}</td>
                              <td>{{intval($item->amount)}}</td>
                              <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                              <td> <span class="badge badge-success">Completed</span></td>
                           </tr>
                        @endforeach
                     @endif
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- end col -->
   </div>
   <!-- end row -->
</div>
<!-- container -->
<div id="deleteModal" class="modal fade">
   <div class="modal-dialog modal-dialog-top" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-body tx-center pd-y-20 pd-x-20">
            <form action="{{route('admin.customer.invoice.delete_invoice')}}" method="post" enctype="multipart/form-data">
               @csrf
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
               <i class="icon icon ion-ios-close-outline tx-60 tx-danger lh-1 mg-t-20 d-inline-block"></i>
               <h4 class="tx-danger  tx-semibold mg-b-20 mt-2">Are you sure! you want to delete this?</h4>
               <input type="hidden" name="id" value="">
               <button type="submit" class="btn btn-danger mr-2 text-white tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
               yes
               </button>
               <button type="button" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
               No
               </button>
            </form>
         </div>
         <!-- modal-body -->
      </div>
      <!-- modal-content -->
   </div>
</div>
@endsection
@section('script')
<script src="{{asset('Backend/lib/highlightjs/highlight.pack.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script type="text/javascript">
   $(document).ready(function(){
       $('.counter').each(function () {
       var $this = $(this);
       jQuery({ Counter: 0 }).animate({ Counter: $this.attr('data-stop') }, {
           duration: 3000,
           easing: 'swing',
           step: function (now) {
               $this.text(Math.ceil(now));
           }
       });
   });
    $("#invoice").DataTable();
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
   });
     /** Handle Delete button click**/
   $('#invoice tbody').on('click', '.delete-btn', function () {
   var id = $(this).data('id');
   $('#deleteModal').modal('show');
   var value_input = $("input[name*='id']").val(id);
   });

   /** Handle form submission for delete **/
   $('#deleteModal form').submit(function(e){
   e.preventDefault();

   var form = $(this);
   var url = form.attr('action');
   var formData = form.serialize();
   /** Use Ajax to send the delete request **/
   $.ajax({
     type:'POST',
     'url':url,
     data: formData,
     success: function (response) {
       $('#deleteModal').modal('hide');
       if (response.success==true) {
           setTimeout(() => {
               toastr.success(response.message);
           }, 300);
       } else {
          /** Handle  errors **/
         toastr.error("Error!!!");
       }
     },

     error: function (xhr, status, error) {
        /** Handle  errors **/
       console.error(xhr.responseText);
     }
   });
   });

</script>
@endsection
