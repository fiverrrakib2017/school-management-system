@extends('Backend.Layout.App')
@section('title', 'Dashboard | Admin Panel')
@section('style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <button data-toggle="modal" data-target="#addModal" type="button" class="btn btn-success mb-2">
                        <i class="mdi mdi-account-plus"></i> Add New Teacher Corner
                    </button>



                    <div class="table-responsive" id="tableStyle">
                        <table id="datatable1" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Subject</th>
                                    <th>Teacher</th>
                                    <th>Lession</th>
                                    <th>File</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('Backend.Modal.Settings.Website.Teacher_corner.teacher_corner_modal')
    @include('Backend.Modal.delete_modal')

@endsection

@section('script')
    <script src="{{ asset('Backend/assets/js/__handle_submit.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/delete_data.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/custom_select.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //custom_select2('#ticketModal');
            handleSubmit('#teacher_cornerForm', '#addModal');

            var table = $("#datatable1").DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                beforeSend: function() {},
                complete: function() {},
                ajax: "{{ route('admin.settings.website.teacher_corner.get_all_data') }}",
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                "columns": [

                    {
                        "data": "created_at",
                        render: function(data, type, row) {
                            return moment(data).format('YYYY-MM-DD');
                        }
                    },
                    {
                        "data": "class.name",
                        render: function(data, type, row) {
                            return data;
                        }
                    },
                    {
                        "data": "section.name",
                        render: function(data, type, row) {
                            return data;
                        }
                    },
                    {
                        "data": "subject.name",
                        render: function(data, type, row) {
                            return data;
                        }
                    },
                    {
                        "data": "teacher.name",
                        render: function(data, type, row) {
                            return data;
                        }
                    },
                    {
                        "data": "lession",
                        render: function(data, type, row) {
                            return data;
                        }
                    },

                    {
                        "data": "image",
                        render: function(data, type, row) {
                            if (data) {
                                var ext = data.split('.').pop().toLowerCase();
                                if (ext === 'pdf') {
                                    return `<a href="{{ asset('Backend/uploads/photos') }}/${data}" target="_blank" class="btn btn-sm btn-warning">
                                                <i class="fa fa-download"></i> Download PDF
                                            </a>`;
                                } else {
                                    return `<img class="img-fluid" src="{{ asset('Backend/uploads/photos') }}/${data}" alt="file" style="max-width: 100px; max-height: 90px;">`;
                                }
                            } else {
                                // No file available
                                return 'No file';
                            }
                        }
                    },

                    {
                        data: null,
                        render: function(data, type, row) {
                            //
                            return `
                            <button  class="btn btn-primary btn-sm mr-3 edit-btn" data-id="${row.id}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm mr-3 delete-btn"  data-id="${row.id}"><i class="fa fa-trash"></i></button>
                            `;
                        }

                    },
                ],
                order: [
                    [0, "desc"]
                ],

            });

        });








        /** Handle Edit button click **/
        $('#datatable1 tbody').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.settings.website.teacher_corner.edit', ':id') }}".replace(':id', id),
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#teacher_cornerForm').attr('action', "{{ route('admin.settings.website.teacher_corner.update', ':id') }}".replace(':id', id));

                        $('#ModalLabel').html(
                            '<span class="mdi mdi-account-edit mdi-18px"></span> &nbsp;Update Teacher Corner');
                        $('#teacher_cornerForm select[name="class_id"]').val(response.data.class_id);
                        $('#teacher_cornerForm select[name="section_id"]').val(response.data.section_id);
                        $('#teacher_cornerForm select[name="subject_id"]').val(response.data.subject_id);
                        $('#teacher_cornerForm select[name="teacher_id"]').val(response.data.teacher_id);
                        $('#teacher_cornerForm textarea[name="lession"]').val(response.data.lession);
                        $('#preview').attr('src', "{{ asset('Backend/uploads/photos') }}/" + response.data.image)
                        .show();

                        // Show the modal
                        $('#addModal').modal('show');
                    } else {
                        toastr.error('Error fetching data for edit.');
                    }
                },
                error: function() {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        });

        /** Handle Delete button click**/
        $('#datatable1 tbody').on('click', '.delete-btn', function () {
            var id = $(this).data('id');
            var deleteUrl = "{{ route('admin.settings.website.teacher_corner.delete', ':id') }}".replace(':id', id);

            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteModal').find('input[name="id"]').val(id);
            $('#deleteModal').modal('show');
        });
    </script>
@endsection
