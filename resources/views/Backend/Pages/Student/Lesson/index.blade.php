@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
        <div class="card-header">
            <a class="btn btn-success" href="{{ route('admin.student.lesson.plan.create') }}">Create New Plan</a>

          </div>
            <div class="card-body">
                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1"  class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="">No.</th>
                                <th class="">Class </th>
                                <th class="">Section</th>
                                <th class="">Subject</th>
                                <th class="">Teacher</th>
                                <th class="">Lesson Name</th>
                                <th class="">Lesson Range</th>
                                <th class="">Approx Duration</th>
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
    var class_filter = '<label style="margin-left: 20px;">';
    class_filter += '<select id="search_class_id" class="form-control">';
    class_filter += '<option value="">--Select Class--</option>';
    classes.forEach(function(item) {
        class_filter += '<option value="' + item.id + '">' + item.name + '</option>';
    });
    class_filter += '</select></label>';
    setTimeout(() => {
        $('.dataTables_length').append(class_filter);
       // $('#search_class_id').select2();
    }, 1000);


    var table=$("#datatable1").DataTable({
      "processing":true,
      "responsive": true,
      "serverSide":true,
      ajax: {
            url: "{{ route('admin.student.lesson.plan.all_data') }}",
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
          "data":"current_class.name"
        },
        {
          "data":"section.name"
        },
        {
          "data":"subject.name"
        },
        {
          "data":"teacher.name"
        },
        {
          "data":"lesson_name"
        },
        {
          "data":"lesson_range"
        },
        {
          "data":"approx_duration"
        },
        {
        "data": null,
        "orderable": false,
        "searchable": false,
        "render": function(data, type, row) {
            return `
                <div class="dropdown">
                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/admin/student/lesson/plan/view/${row.id}">View</a></li>
                        <li><a class="dropdown-item" href="/admin/student/lesson/plan/edit/${row.id}">Edit</a></li>
                        <li><a class="dropdown-item text-danger delete-btn" href="#" data-id="${row.id}">Delete</a></li>
                    </ul>
                </div>
            `;
        }
    }
       
       
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
@endsection
