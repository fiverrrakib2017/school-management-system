@extends('Backend.Layout.App')
@section('title', 'Dashboard | Admin Panel')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    {{-- <button data-toggle="modal" data-target="#addModal" type="button" class=" btn btn-success mb-2"><i class="mdi mdi-account-plus"></i>
                    Add New Subject</button> --}}
                    <div class="row" id="search_box">

                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="class_id" class="form-label">Class <span class="text-danger">*</span></label>
                                <select name="class_id" class="form-control" style="width: 100%;" required>
                                    <option value="">---Select---</option>
                                    @php
                                        $classes = \App\Models\Student_class::latest()->get();
                                    @endphp
                                    @if ($classes->isNotEmpty())
                                        @foreach ($classes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="section_id" class="form-label">Section <span
                                        class="text-danger">*</span></label>
                                <select name="section_id" id="section_id" class="form-control" style="width: 100%;"
                                    required>
                                    <option value="">---Select---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mt-3">
                                <button type="button" name="submit_btn" class="btn btn-success" style="margin-top: 16px">
                                    <i class="fas fa-search"></i> Search Now</button>
                                    <button data-toggle="modal" data-target="#addModal" type="button" class=" btn btn-primary" style="margin-top: 16px"><i class="mdi mdi-account-plus"></i>
                                        Add New Subject</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    <div class="table-responsive" id="tableStyle">
                        <table id="datatable1" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Class Name</th>
                                    <th>Section Name</th>
                                    <th>Subject Name</th>
                                </tr>
                            </thead>

                            <tbody id="_data"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Section Modal -->
    <div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span class="mdi mdi-account-check mdi-18px"></span> &nbsp;Add Subject
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!----- Start Add Form ------->
                <form id="addSectionForm" action="{{ route('admin.student.subject.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <!----- Start Add Form input ------->
                        <div class="form-group mb-2">
                            <label for="">Class</label>
                            <select type="text" name="class_id" class="form-control">
                                <option value="">---Select---</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Section</label>
                            <select type="text" name="section_id" class="form-control">
                                <option value="">---Select---</option>

                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="sectionName"> Subject Name</label>
                            <input type="text" name="name" id="subject_name" placeholder="Enter Subject Name"
                                class="form-control">
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
    <!-- Edit Section Modal -->
    <div class="modal fade bs-example-modal-lg" id="editModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span class="mdi mdi-account-check mdi-18px"></span> &nbsp;Update Subject
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!----- Start Update Form ------->
                <form id="addSectionForm" action="{{ route('admin.student.subject.update') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <!----- Start Update Form input ------->
                        <input type="text" name="id" class="d-none">
                        <div class="form-group mb-2">
                            <label for="sectionName"> Subject Name</label>
                            <input type="text" name="name" id="subject_name" placeholder="Enter Subject Name"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success tx-size-xs">Save changes</button>
                        <button type="button" class="btn btn-danger tx-size-xs" data-dismiss="modal">Close</button>
                    </div>
                </form>
                <!----- End Update Form ------->
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <form action="{{ route('admin.student.subject.delete') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <div class="icon-box">
                            <i class="fas fa-trash"></i>
                        </div>
                        <h4 class="modal-title w-100">Are you sure?</h4>
                        <input type="hidden" name="id" value="">
                        <a class="close" data-dismiss="modal" aria-hidden="true"><i class="mdi mdi-close"></i></a>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function() {
            $("select[name='class_id']").select2();
            $("select[name='section_id']").select2();


            $(document).on('change', 'select[name="class_id"]', function() {
                var sections = @json($sections);
                /*Get Class ID*/
                var selectedClassId = $(this).val();
                var filteredSections = sections.filter(function(section) {
                    /*Filter sections by class_id*/
                    return section.class_id == selectedClassId;
                });



                /* Update Section dropdown*/
                var sectionOptions = '<option value="">--Select--</option>';
                filteredSections.forEach(function(section) {
                    sectionOptions += '<option value="' + section.id + '">' + section.name +
                        '</option>';
                });




                $('select[name="section_id"]').html(sectionOptions);
                $('select[name="section_id"]').select2();
            });

        });


        $("button[name='submit_btn']").on('click', function(e) {
            e.preventDefault();
            var class_id = $("select[name='class_id']").val();
            var section_id = $("select[name='section_id']").val();

            if (!class_id) {
                toastr.error("Student Class Name is require!!");
                return;
            }
            if (!section_id) {
                toastr.error("Student Section Name is require!!");
                return;
            }

            var submitBtn = $('#search_box').find('button[name="submit_btn"]');
            submitBtn.html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`
            );
            submitBtn.prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.student.subject_filter') }}",
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    class_id: class_id,
                    section_id: section_id,
                },
                success: function(response) {
                    if (response.success == true) {
                        var _number = 1;
                        var html = '';
                        $("#print_area").removeClass('d-none');
                        /*Check if the response data is an array*/
                        if (Array.isArray(response.data) && response.data.length > 0) {
                            response.data.forEach(function(data) {
                                html += '<tr data-id="' + data.id + '">';
                                html += '<td>' + (_number++) + '</td>';
                                html += '<td>' + (data.class ? data.class.name : 'N/A') +
                                    '</td>';
                                html += '<td>' + (data.section ? data.section.name : 'N/A') +
                                    '</td>';
                                html += '<td>' + data.name + '</td>';
                                html += '<td>' +
                                    '<button class="btn btn-primary btn-sm mr-3 edit-btn" data-id="' +
                                    data.id + '"><i class="fa fa-edit"></i></button>' +
                                    '<button class="btn btn-danger btn-sm mr-3 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="' +
                                    data.id + '"><i class="fa fa-trash"></i></button>' +
                                    '</td>';

                                html += '</tr>';
                            });
                        } else {
                            html += '<tr>';
                            html +=
                            '<td colspan="8" style="text-align: center;">No Data Available</td>';
                            html += '</tr>';
                        }
                        $("#_data").html(html);
                    }



                },
                error: function() {
                    toastr.error('An error occurred. Please try again.');
                },
                complete: function() {
                    submitBtn.html('<i class="fas fa-search"></i> Search Now');
                    submitBtn.prop('disabled', false);
                }

            });

        });


        /** Handle edit button click**/
        $('#datatable1 tbody').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var editUrl = '{{ route('admin.student.subject.edit', ':id') }}';
            var url = editUrl.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    if (response.success) {
                        $('#editModal').modal('show');
                        $('#editModal input[name="id"]').val(response.data.id);
                        $('#editModal input[name="name"]').val(response.data.name);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    toastr.error("Error fetching data for edit!");
                }
            });
        });




        /** Handle Delete button click**/
        $('#datatable1 tbody').on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            $('#deleteModal').modal('show');
            var value_input = $("input[name*='id']").val(id);
        });



        /** Handle form submission for delete **/
        $('#deleteModal form').submit(function(e) {
            e.preventDefault();
            /*Get the submit button*/
            var submitBtn = $('#deleteModal form').find('button[type="submit"]');

            /* Save the original button text*/
            var originalBtnText = submitBtn.html();

            /*Change button text to loading state*/
            submitBtn.html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`
                );

            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();
            /** Use Ajax to send the delete request **/
            $.ajax({
                type: 'POST',
                'url': url,
                data: formData,
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    if (response.success) {
                        toastr.success(response.message);
                        $('#datatable1').DataTable().ajax.reload(null, false);
                    }
                },

                error: function(xhr, status, error) {
                    /** Handle  errors **/
                    toastr.error(xhr.responseText);
                },
                complete: function() {
                    submitBtn.html(originalBtnText);
                }
            });
        });




        /** Store The data from the database table **/
        $('#addModal form').submit(function(e) {
            e.preventDefault();
            /*Get the submit button*/
            var submitBtn = $('#deleteModal form').find('button[type="submit"]');

            /* Save the original button text*/
            var originalBtnText = submitBtn.html();

            /*Change button text to loading state*/
            submitBtn.html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`
                );
            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();
            /** Use Ajax to send the delete request **/
            $.ajax({
                type: 'POST',
                'url': url,
                data: formData,
                beforeSend: function() {
                    form.find(':input').prop('disabled', true);
                },
                success: function(response) {

                    if (response.success) {
                        $('#addModal ').modal('hide');
                        $('#addModal form')[0].reset();
                        toastr.success(response.message);
                        //$('#datatable1').DataTable().ajax.reload( null , false);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                },

                error: function(xhr, status, error) {
                    /** Handle  errors **/
                    console.error(xhr.responseText);
                },
                complete: function() {
                    submitBtn.html(originalBtnText);
                    form.find(':input').prop('disabled', false);
                }
            });
        });




        /** Update The data from the database table **/
        $('#editModal form').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();

            /*Get the submit button*/
            var submitBtn = form.find('button[type="submit"]');

            /*Save the original button text*/
            var originalBtnText = submitBtn.html();

            /*Change button text to loading state*/
            submitBtn.html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`
                );

            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();
            /** Use Ajax to send the delete request **/
            $.ajax({
                type: 'POST',
                'url': url,
                data: formData,
                beforeSend: function() {
                    form.find(':input').prop('disabled', true);
                },
                success: function(response) {

                    $('#editModal').modal('hide');
                    $('#editModal form')[0].reset();
                    if (response.success) {
                        submitBtn.html(originalBtnText);
                        toastr.success(response.message);
                        $('#datatable1').DataTable().ajax.reload(null, false);
                    }
                },

                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error("An error occurred. Please try again.");
                    }
                },
                complete: function() {
                    submitBtn.html(originalBtnText);
                    form.find(':input').prop('disabled', false);
                }
            });
        });
    </script>
@endsection
