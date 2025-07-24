@extends('Backend.Layout.App')
@section('title', 'Dashboard | SMS Logs | Admin Panel')
@section('style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">SMS Logs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="tableStyle">
                        <table id="datatable1" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                     <th>Student Name</th>
                                    <th>Class Name</th>
                                    <th>Section</th>

                                    <th>Roll No.</th>
                                    <th>Phone Number</th>
                                    <th>Sent Time</th>
                                    <th>Status</th>
                                    <th>message</th>
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
        $(document).ready(function() {

            var table = $("#datatable1").DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                beforeSend: function() {},
                complete: function() {},
                "ajax": {
                    url: "{{ route('admin.sms.get_all_sms_logs_data') }}",
                    type: "GET",
                    data: function(d) {
                        d.student_id = $('#search_student_id').val();
                        d.section_id = $('#search_section_id').val();
                    }
                },
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                    processing: `<div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-success" role="status">
                            <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                            </div>`,
                },
                "columns": [
                    {
                        "data": "id"
                    },
                    {
                        "data": "student.name",
                        "render": function(data, type, row) {
                            var viewUrl = '{{ route('admin.student.view', ':id') }}'.replace(':id',
                                row.student.id);
                            /*Set the icon based on the status*/
                            var icon = '';
                            var color = '';


                            return '<a href="' + viewUrl +
                                '" style="display: flex; align-items: center; text-decoration: none; color: #333;">' +
                                icon +
                                '<span style="font-size: 16px; font-weight: bold;">' + row.student
                                .name + '</span>' +
                                '</a>';
                        }
                    },
                    {
                        "data": "student.current_class.name",
                    },
                    {
                        "data": "student.section.name",
                    },

                    {
                        "data": "student.roll_no",
                    },
                    {
                        "data": "student.phone",
                        "render": function(data, type, row) {
                            return row.student.phone ? row.student.phone : 'N/A';
                        }
                    },
                    {
                        "data": "sent_at",
                        "render": function(data, type, row) {
                            return moment(data).format('lll');
                        }
                    },
                    {
                        "data": "status",
                        "render": function(data, type, row) {
                            var status = '';
                            if (data === '1') {
                                status = '<span class="badge badge-success">Success</span>';
                            } else if (data === '0') {
                                status = '<span class="badge badge-danger">Failed</span>';
                            } else {
                                status = '<span class="badge badge-warning">Pending</span>';
                            }
                            return status;
                        }
                    },
                    {
                        "data": "message",
                        "render": function(data, type, row) {
                            return row.message.length > 50 ? row.message.substring(0, 50) + "..." :
                                row.message;
                        }
                    },


                ],
                order: [
                    [0, "desc"]
                ],

            });

        });
    </script>
@endsection
