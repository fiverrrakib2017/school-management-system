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
                    <!-- <div>
                      <label for="class-select">Select Class:</label>
                      <select id="class-select" class="form-control form-control-sm">
                          <option value="">All Classes</option>
                          @foreach($classes as $class)
                              <option value="{{ $class->id }}">{{ $class->name }}</option>
                          @endforeach
                      </select>
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="section-select">Select Section:</label>
                        <select id="section-select" class="form-control form-control-sm">
                            <option value="">All Sections</option>
                        </select>
                    </div> -->
                    <table id="datatable1" class="table table-striped table-bordered    " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="">No.</th>
                                <th class="">Student Name </th>
                                <th class="">Class </th>
                                <th class="">Section</th>
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

    var table=$("#datatable1").DataTable({
      "processing":true,
      "responsive": true,
      "serverSide":true,
      beforeSend: function () {
        //$('#preloader').addClass('active');
      },
      complete: function(){
        //$('.product_loading').css({"display":"none"});
      },
      ajax: "{{ route('admin.student.all_data') }}",
      
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
          "data":"current_class.section.name"
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
      $('#class-select').change(function(){
          var classId = $(this).val();
          table.ajax.url("{{ route('admin.student.all_data') }}?class_id=" + classId).load();
      });
      $('#section-select').change(function(){
          var section_id = $(this).val();
          table.ajax.url("{{ route('admin.student.all_data') }}?section_id=" + section_id).load();
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
