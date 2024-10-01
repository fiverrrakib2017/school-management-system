@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
        <div class="card-header">
          <a href="{{ route('admin.student.create') }}" class="btn btn-success "><i class="mdi mdi-account-plus"></i>
          Add New Student</a>
            
          </div>
            <div class="card-body">
                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-striped table-bordered    " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="">No.</th>
                                <th class="">Student Name </th>
                                <th class="">Class </th>
                                <th class="">Father Name</th>
                                <th class="">Mother Name</th>
                                <th class="">Religion</th>
                                <th class="">Phone Number</th>
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
    var classes = @json($classes);
    var class_filter = '<label style="margin-left: 10px;">';
    class_filter += '<select id="search_class_id" class="form-select select2">';
    class_filter += '<option value="">--Select Class--</option>';
    classes.forEach(function(item) {
        class_filter += '<option value="' + item.id + '">' + item.name + '</option>';
    });
    class_filter += '</select></label>';
    setTimeout(() => {
        $('.dataTables_length').append(class_filter);
        $('.select2').select2(); 
    }, 100);


    var table=$("#datatable1").DataTable({
      "processing":true,
      "responsive": true,
      "serverSide":true,
      ajax: {
            url: "{{ route('admin.student.all_data') }}",
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
          "data": "name",
          render: function(data, type, row){
              return '<a href="{{ route('admin.student.view', '') }}/' + row.id + '">' + data + '</a>';
          }
        },
        {
          "data":"current_class.name"
        },
        {
          "data":"father_name"
        },
        {
          "data":"mother_name"
        },
        {
          "data":"religion"
        },
        {
          "data":"phone"
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
      $(document).on('change','#search_class_id',function(){
          table.ajax.reload(null, false);
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
