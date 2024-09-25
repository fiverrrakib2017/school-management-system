@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
        <div class="card-header">
          <a href="{{ route('admin.student.create') }}" class="btn btn-success "><i class="mdi mdi-account-plus"></i>
          Add Bill Collection</a>
          </div>
            <div class="card-body">
                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-striped table-bordered    " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="">No.</th>
                                <th class="">Student Name </th>
                                <th class="">Amount </th>
                                <th class="">Paid Amount</th>
                                <th class="">Due Amount</th>
                                <th class="">Payment Status</th>
                                <th class="">Note</th>
                                <th class=""></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>



@endsection

@section('script')

<script type="text/javascript">
  $(document).ready(function(){

    var table=$("#datatable1").DataTable({
      "processing":true,
      "responsive": true,
      "serverSide":true,
      ajax: {
            url: "{{ route('admin.student.bill_collection.all_data') }}",
            type: 'GET',
            data: function(d) {
              d.class_id = $('#search_class_id').val();
            },
            beforeSend: function(request) {
                request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
            }
        },
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
          "data": "student.name",
          render: function(data, type, row){
              return '<a href="{{ route('admin.student.view', '') }}/' + row.id + '">' + data + '</a>';
          }
        },
        {
          "data":"amount"
        },
        {
          "data":"paid_amount"
        },
        {
          "data":"due_amount"
        },
        {
          "data":"payment_status"
        },
        {
          "data":"note"
        },
        {
          "data":null,
          render:function(data,type,row){
              var viewUrl = "{{ route('admin.student.view', ':id') }}".replace(':id', row.id);
              return `

              <a href="${viewUrl}" class="btn btn-success btn-sm mr-3 edit-btn"><i class="fa fa-eye"></i></a>
            `;
          }
        },
      ],
      order:[
        [0, "desc"]
      ],
    });
      $('#search_class_id').change(function() {
        $('#datatable1').DataTable().ajax.reload( null , false);
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
