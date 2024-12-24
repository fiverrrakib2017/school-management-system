@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <button data-bs-toggle="modal" data-bs-target="#addModal" type="button" class="btn-sm btn btn-success mb-2"><i class="mdi mdi-account-plus"></i>
                    Add New </button>
            </div>
            <div class="card-body">


                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="">No.</th>
                                <th class="">Subject Name</th>
                                <th class="">Subject Teacher</th>
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

<!-- Add Section Modal -->
<div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <span class="mdi mdi-account-check mdi-18px"></span> &nbsp;Add Class Routine
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!----- Start Add Form ------->
            <form id="addSectionForm" action="{{ route('admin.student.class.routine.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <!----- Start Add Form input ------->
                    <div class="row">
                        <div class="form-group mb-2">
                            <label for="sectionName">Class Name</label>
                            <select type="text" name="class_id"  class="form-select" style="width: 100%;">
                                <option value="">---Select---</option>
                                @foreach ($classes as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="sectionName">Subject Name</label>
                            <select type="text" name="subject_id"  class="form-select" style="width: 100%;">
                                <option value="">---Select---</option>
                                @foreach ($subjects as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="sectionName">Day Of Week</label>
                            <select type="text" name="day"  class="form-select" style="width: 100%;">
                                <option value="">---Select---</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="sectionName">Teacher Name</label>
                            <select type="text" name="teacher_id"  class="form-select" style="width: 100%;">
                                <option value="">---Select---</option>
                                @foreach ($teachers as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Start Time</label>
                            <input type="time" name="start_time"  class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">End Time</label>
                            <input type="time" name="end_time"  class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success tx-size-xs">Save changes</button>
                    <button type="button" class="btn btn-danger tx-size-xs" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            <!----- End Add Form ------->
        </div>
    </div>
</div>
<!-- Edit Section Modal -->
<div class="modal fade bs-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <span class="mdi mdi-account-check mdi-18px"></span> &nbsp;Update Class Routine
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!----- Start Update Form ------->
            <form id="addSectionForm" action="{{ route('admin.student.class.routine.update') }}" method="post">
                @csrf
                <div class="modal-body">
                    <!----- Start Update Form input ------->
                    <div class="row">
                        <div class="form-group mb-2">
                            <label for="">Class Name</label>
                            <input type="text" name="id" class="d-none">
                            <select type="text" name="class_id"  class="form-select" style="width: 100%;">
                                <option value="">---Select---</option>
                                @foreach ($classes as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Subject Name</label>
                            <select type="text" name="subject_id"  class="form-select" style="width: 100%;">
                                <option value="">---Select---</option>
                                @foreach ($subjects as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Teacher Name</label>
                            <select type="text" name="teacher_id"  class="form-select" style="width: 100%;">
                                <option value="">---Select---</option>
                                @foreach ($teachers as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success tx-size-xs">Save changes</button>
                    <button type="button" class="btn btn-danger tx-size-xs" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            <!----- End Update Form ------->
        </div>
    </div>
</div>
<div id="deleteModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <form action="{{route('admin.student.class.routine.delete')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-trash"></i>
                </div>
                <h4 class="modal-title w-100">Are you sure?</h4>
                <input type="hidden" name="id" value="">
                <a class="close" data-bs-dismiss="modal" aria-hidden="true"><i class="mdi mdi-close"></i></a>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')

  <script type="text/javascript">
    $(document).ready(function(){
        /* Initialize select2 modals*/
        initializeSelect2("#addModal");
        initializeSelect2("#editModal");
        /* Initialize select2 for modal dropdowns*/
        function initializeSelect2(modalId) {
        $(modalId).on('show.bs.modal', function (event) {
            if (!$("select[name='class_id']").hasClass("select2-hidden-accessible")) {
                $("select[name='class_id']").select2({
                    dropdownParent: $(modalId),
                    placeholder: "Select Class"
                });
            }
            if (!$("select[name='subject_id']").hasClass("select2-hidden-accessible")) {
                $("select[name='subject_id']").select2({
                    dropdownParent: $(modalId),
                    placeholder: "Select Subject"
                });
            }
            if (!$("select[name='teacher_id']").hasClass("select2-hidden-accessible")) {
                $("select[name='teacher_id']").select2({
                    dropdownParent: $(modalId),
                    placeholder: "Select Teacher"
                });
            }
            if (!$("select[name='day']").hasClass("select2-hidden-accessible")) {
                $("select[name='day']").select2({
                    dropdownParent: $(modalId),
                    placeholder: "---Select---"
                });
            }
        });
        }

        $(document).on('change','select[name="class_id"]',function(){
            var items = @json($subjects);
            var selectedClassId = $(this).val();
            var filteredSubjects = items.filter(function(subject) {
                /*Filter sections by class_id*/
                return subject.class_id == selectedClassId;
            });

            /* Update Section dropdown*/
            var sectionOptions = '<option value="">--Select Section--</option>';
            filteredSubjects.forEach(function(item) {
                sectionOptions += '<option value="' + item.id + '">' + item.name + '</option>';
            });

            $('select[name="subject_id"]').html(sectionOptions);
            //$('select[name="subject_id"]').select2();
        });
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

        var print_ = '<label style="margin-left: 10px;">';
        print_+='<button type="button" name="print_btn" class="btn btn-success"><i class="fas fa-print"></i></button>';
        setTimeout(() => {
            $('.dataTables_length').append(print_);
            $('.select2').select2();
        }, 100);

        var table=$("#datatable1").DataTable();
        // var table=$('#datatable1').DataTable({
        //     "paging": false,
        //     "ordering": false,
        //     "info": false,     // Information বার্তা (Showing 1 to 10 of 50 entries) দেখাতে চাইলে true রাখুন
        //     "searching": false, // সার্চ ফিল্ড রাখার জন্য true রাখুন
        //     "lengthMenu": false, // Show entries অপশন সরাতে false করে দিন
        //     "dom": 'tip' // "Show entries" অপশন সরানোর জন্য l সরিয়ে দিন। শুধু 'tip' রাখুন
        // });
        $(document).on('change','#search_class_id',function(){
            var dataId=$(this).val();
            $.ajax({
                url: "{{ route('admin.student.class.routine.data') }}",
                type: "GET",
                data: { class_id: dataId },
                beforeSend: function(request) {
                    request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                },
                success: function(response) {
                    if(response.code == 200 && response.data.length > 0 && response.data != null && response.data != undefined && response.data != '' && response.data != 'null' && response.data != 'undefined'){
                        var html='';
                        var i = 1;
                        $.each(response.data, function(key, routine) {
                            html += '<tr>';
                            html += '<td>' + i++ + '</td>';
                            html += '<td>' + routine.subject.name + '</td>';
                            html += '<td>' + routine.teacher.name + '</td>';
                            html += '<td>';
                            html += '<button class="btn btn-primary btn-sm mr-2 edit-btn" data-id="' + routine.id + '" style="margin-right: 5px"><i class="fa fa-edit"></i></button>';
                            html += '<button class="btn btn-danger btn-sm mr-2 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="' + routine.id + '"><i class="fa fa-trash"></i></button>';
                            html += '</td>';
                            html += '</tr>';
                        });

                        $('#datatable1 tbody').html(html);
                        //table.draw(true);
                    }else{
                        $('#datatable1 tbody').html('<tr id="no-data"><td colspan="7" class="text-center">No data available</td></tr>');
                    }

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Failed to load data. Please try again.');
                }
            })
        });
    });


    $(document).on('click','button[name=print_btn]', function(){
        var classId = $('#search_class_id').val();
        if (!classId) {
            toastr.error("Please select class");
            return ;
        }
        $.ajax({
            url: "{{ route('admin.student.class.routine.print') }}",
            type: "GET",
            data: { class_id: classId },
            beforeSend: function(request) {
                request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
            },
            success: function(response) {
                print_content(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Failed to load print data. Please try again.');
            }
        });

    });

     function print_content(content) {
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Class Routine</title>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(content);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }


    /** Handle edit button click**/
    $('#datatable1 tbody').on('click', '.edit-btn', function () {
      var id = $(this).data('id');
      var editUrl = '{{ route("admin.student.class.routine.edit", ":id") }}';
      var url = editUrl.replace(':id', id);
      $.ajax({
          type: 'GET',
          url: url,
          success: function (response) {
              if (response.success) {
                $('#editModal').modal('show');
                $('#editModal input[name="id"]').val(response.data.id);
                $('#editModal select[name="class_id"]').val(response.data.class_id);
                $('#editModal select[name="subject_id"]').val(response.data.subject_id);
                $('#editModal select[name="teacher_id"]').val(response.data.teacher_id);
              } else {
                toastr.error("Error fetching data for edit!");
              }
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
            toastr.error("Error fetching data for edit!");
          }
      });
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
    /*Get the submit button*/
    var submitBtn =  $('#deleteModal form').find('button[type="submit"]');

    /* Save the original button text*/
    var originalBtnText = submitBtn.html();

    /*Change button text to loading state*/
    submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);

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
        if (response.success) {
          toastr.success(response.message);
          $('#datatable1').DataTable().ajax.reload( null , false);
        }
      },

      error: function (xhr, status, error) {
         /** Handle  errors **/
         toastr.error(xhr.responseText);
      },
      complete: function () {
        submitBtn.html(originalBtnText);
        }
    });
  });




  /** Store The data from the database table **/
  $('#addModal form').submit(function(e){
    e.preventDefault();
    /*Get the submit button*/
    var submitBtn =  $('#addModal form').find('button[type="submit"]');

    /* Save the original button text*/
    var originalBtnText = submitBtn.html();

    /*Change button text to loading state*/
    submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);
    var form = $(this);
    var url = form.attr('action');
    var formData = form.serialize();
    /** Use Ajax to send the delete request **/
    $.ajax({
      type:'POST',
      'url':url,
      data: formData,
      success: function (response) {

        if (response.success) {
            $('#addModal ').modal('hide');
            $('#addModal form')[0].reset();
            toastr.success(response.message);
            setTimeout(() => {
                location.reload();
            }, 1000);
            submitBtn.html(originalBtnText);
            //$('#datatable1').DataTable().ajax.reload( null , false);
        }
      },

      error: function (xhr, status, error) {
         /** Handle  errors **/
        console.error(xhr.responseText);
      }
    });
  });




  /** Update The data from the database table **/
  $('#editModal form').submit(function(e){
    e.preventDefault();

    var form = $(this);
    var url = form.attr('action');
    var formData = form.serialize();

    /*Get the submit button*/
    var submitBtn = form.find('button[type="submit"]');

    /*Save the original button text*/
    var originalBtnText = submitBtn.html();

    /*Change button text to loading state*/
    submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);

    var form = $(this);
    var url = form.attr('action');
    var formData = form.serialize();
    /** Use Ajax to send the delete request **/
    $.ajax({
      type:'POST',
      'url':url,
      data: formData,
      beforeSend: function () {
        form.find(':input').prop('disabled', true);
      },
      success: function (response) {

        $('#editModal').modal('hide');
        $('#editModal form')[0].reset();
        if (response.success) {
            submitBtn.html(originalBtnText);
            toastr.success(response.message);
            $('#datatable1').DataTable().ajax.reload( null , false);
        }
      },

      error: function (xhr, status, error) {
        if (xhr.status === 422) {
            var errors = xhr.responseJSON.errors;
            $.each(errors, function(key, value) {
                toastr.error(value[0]);
            });
        } else {
            toastr.error("An error occurred. Please try again.");
        }
      },
      complete: function () {
        submitBtn.html(originalBtnText);
          form.find(':input').prop('disabled', false);
        }
    });
  });
  </script>

@endsection
