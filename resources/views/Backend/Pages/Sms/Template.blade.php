@extends('Backend.Layout.App')
@section('title', 'Dashboard | SMS Template | Admin Panel')
@section('style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <button data-toggle="modal" data-target="#addSmsTemplateModal" type="button"
                        class=" btn btn-success mb-2"><i class="mdi mdi-account-plus"></i>
                        Add New Template</button>

                    <div class="table-responsive" id="tableStyle">
                        <table id="datatable1" class="table table-striped table-bordered    " cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>message</th>
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
    <div class="modal fade bs-example-modal-lg" id="addSmsTemplateModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content col-md-12">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><span class="mdi mdi-account-check mdi-18px"></span> &nbsp;New
                        Sms Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.sms.template_Store') }}" id="SmsTemplateForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Template Name</label>
                            <input name="name" placeholder="Enter Template Name" class="form-control" type="text"
                                required>
                        </div>

                        <div class="form-group mb-2">
                            <label>SMS </label>
                            <textarea name="message" placeholder="Enter SMS" class="form-control" type="text"></textarea>
                        </div>
                        <div class="modal-footer ">
                            <button data-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="editSmsTemplateModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content col-md-12">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><span class="mdi mdi-account-check mdi-18px"></span> &nbsp;Update 
                        Sms Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.sms.template_update') }}" id="editSmsTemplateForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Template Name</label>
                            <input type="text" name="id" class="d-none">
                            <input name="name" placeholder="Enter Template Name" class="form-control" type="text"
                                required>
                        </div>

                        <div class="form-group mb-2">
                            <label>SMS </label>
                            <textarea name="message" placeholder="Enter SMS" class="form-control" type="text"></textarea>
                        </div>
                        <div class="modal-footer ">
                            <button data-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('Backend.Modal.delete_modal')


@endsection

@section('script')
    <script src="{{ asset('Backend/assets/js/__handle_submit.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/delete_data.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            handleSubmit('#SmsTemplateForm', '#addSmsTemplateModal');
            var table = $("#datatable1").DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                beforeSend: function() {},
                complete: function() {},
                ajax: "{{ route('admin.sms.template_get_all_data') }}",
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "name",
                    },
                    {
                        "data": "message",
                        "render": function(data, type, row) {
                            return row.message.length > 50 ? row.message.substring(0, 50) + "..." :
                                row.message;
                        }
                    },

                    {
                        data: null,
                        render: function(data, type, row) {

                            return `
              <button class="btn btn-danger btn-sm mr-3 delete-btn"  data-id="${row.id}"><i class="fa fa-trash"></i></button>
              <button class="btn btn-primary btn-sm mr-3 edit-btn"  data-id="${row.id}"><i class="fa fa-edit"></i></button>` ;
                        }

                    },
                ],
                order: [
                    [0, "desc"]
                ],

            });

        });








        /** Handle Delete button click**/
        $('#datatable1 tbody').on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            var deleteUrl = "{{ route('admin.sms.template_delete', ':id') }}".replace(':id', id);

            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteModal').find('input[name="id"]').val(id);
            $('#deleteModal').modal('show');
        });
        /** Handle Edit button click**/
        $('#datatable1 tbody').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var link = "{{ route('admin.sms.template_get', ':id') }}".replace(':id', id);
            $.ajax({
                url: link,
                type: 'GET',
                success: function(response) {
                    if (response.success == true) {
                        $('#editSmsTemplateModal').modal('show');
                        $('#editSmsTemplateModal').find('input[name="id"]').val(response.data.id);
                        $('#editSmsTemplateModal').find('input[name="name"]').val(response.data.name);
                        $('#editSmsTemplateModal').find('textarea[name="message"]').val(response.data.message);

                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    toastr.error('An error occurred while fetching the template data.');
                }
            });
        });
        /** Handle Update Sumit**/
        handleSubmit('#editSmsTemplateForm', '#editSmsTemplateModal');
    </script>
@endsection
