@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
		<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">

    <link href="{{asset('Backend/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">
@endsection
@section('content')
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <span class="breadcrumb-item active">All Invoice</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;">
  <div class="table-wrapper">
    <div class="card">

      <div class="card-body">
      <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="">Invoice No.</th>
          <th class="">Customer Name</th>
          <th class="">Phone Number</th>
          <th class="">Total Amount</th>
          <th class="">Paid Amount</th>
          <th class="">Due Amount</th>
          <th class="">Status</th>
          <th class="">Create Date</th>
          <th class="">Action</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
      </div>
    </div>

  </div><!-- table-wrapper -->
</div><!-- br-section-wrapper -->
<!--Start Delete MODAL ---->
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
        </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div>
  </div>
  <!--Start Pay Now MODAL ---->
<div id="payModal" class="modal fade effect-scale">
        <div class="modal-dialog modal-lg modal-dialog-top mt-4" role="document">
            <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Payment</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <!----- Start Add  Form ------->
        <form action="{{route('admin.customer.invoice.pay_due_amount')}}" method="post">
        @csrf

        <div class="modal-body ">
            <!----- Start Add  Form input ------->
            <div class="col-xl-12">
                <div class="form-layout form-layout-4">


                    <div class="row mb-4 d-none">
                        <label class="col-sm-3 form-control-label">id: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="number" name="id" class="form-control" required>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Amount: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="number" name="amount" class="form-control" placeholder="Enter Your Amount" required>
                        </div>
                    </div><!-- row -->

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success tx-size-xs">Save changes</button>
            <button type="button" class="btn btn-danger tx-size-xs" data-dismiss="modal">Close</button>
        </div>

        </form>
        <!----- End Add Form ------->
        </div>
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

      var table=$("#datatable1").DataTable({
         "processing":true,
        "responsive": true,
        "serverSide":true,
        beforeSend: function () {
        },
        ajax: "{{ route('admin.customer.invoice.show_invoice_data') }}",
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        },
        "columns":[
          {
            "data":"id"
          },
          {
            "data":"customer.name"
          },
          {
            "data":"customer.phone"
          },
          {
            "data":"total_amount"
          },
          {
            "data":"paid_amount"
          },
          {
            "data":"due_amount"
          },
          {
            "data":null,
            render:function(data,type,row){
              if (row.due_amount==0) {
                return '<span class="badge badge-success">Paid</span>';
              }else{
                 return '<span class="badge badge-danger">Not Paid</span>';
              }
            }
          },
          {
            "data":"created_at",
            render: function (data, type, row) {
                var formattedDate = moment(row.created_at).format('DD MMM YYYY');
                return formattedDate;
            }
          },
          {
            render:function(data,type,row){
                var editUrl = "{{ route('admin.customer.invoice.edit_invoice', ':id') }}";
                var viewUrl = "{{ route('admin.customer.invoice.view_invoice', ':id') }}";
                editUrl = editUrl.replace(':id', row.id);
                viewUrl = viewUrl.replace(':id', row.id);

                if (row.due_amount==0) {
                  return `
                  <a href="${viewUrl}" class="btn btn-success btn-sm mr-3" ><i class="fa fa-eye"></i></a>

                  <a href="${editUrl}" class="btn btn-primary btn-sm mr-3 "><i class="fa fa-edit"></i></a>

                  <button class="btn btn-danger btn-sm mr-3 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="${row.id}"><i class="fa fa-trash"></i></button>
                  `;
                }else{
                  return `
                  <button class="btn btn-primary btn-sm mr-3 pay-button"  data-id="${row.id}">Pay Now</button>

                  <a href="${viewUrl}" class="btn btn-success btn-sm mr-3" ><i class="fa fa-eye"></i></a>

                  <a href="${editUrl}" class="btn btn-primary btn-sm mr-3 "><i class="fa fa-edit"></i></a>

                  <button class="btn btn-danger btn-sm mr-3 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="${row.id}"><i class="fa fa-trash"></i></button>
                  `;
                }
            }
          },
        ],
        order:[
          [0, "desc"]
        ],

      });
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    });

  /** Handle Delete button click**/
  $('#datatable1 tbody').on('click', '.delete-btn', function () {
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
          toastr.success(response.message);
          $('#datatable1').DataTable().ajax.reload( null , false);
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
  /** Handle Pay button click**/
  $('#datatable1 tbody').on('click', '.pay-button', function () {
    var id = $(this).data('id');
    $('#payModal').modal('show');
    var value_input = $("input[name*='id']").val(id);
  });
  /** Handle form submission for Pay **/
  $('#payModal form').submit(function(e){
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
        if (response.success==true) {
          $('#payModal').modal('hide');
          toastr.success(response.message);
          $('#datatable1').DataTable().ajax.reload( null , false);
        }
      },

      error: function(xhr, status, error) {
        /** Handle errors **/
        var err = eval("(" + xhr.responseText + ")");
        toastr.error(err.message);
      }

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
