@extends('Backend.Layout.App')
@section('title', 'Dashboard | SMS Template | Admin Panel')
@section('style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body ">
                    <form class="row g-3 align-items-end" id="search_box">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pop_id" class="form-label">Class <span class="text-danger">*</span></label>
                                    <select name="find_class_id"  class="form-control" style="width: 100%">
                                        <option value="">---Select---</option>
                                        @php
                                            $classes = \App\Models\Student_class::latest()->get();
                                        @endphp
                                        @if($classes->isNotEmpty())
                                            @foreach($classes as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                            </div>
                        </div>

                        <div class="col-md-3">

                            <div class="form-group">
                                <label for="section_id" class="form-label">Section <span class="text-danger">*</span></label>
                                <select  name="find_section_id" class="form-control" style="width: 100%">
                                    <option value="">---Select---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 d-grid">
                            <div class="form-group">
                                <button type="button" name="search_btn" class="btn btn-success">
                                    <i class="fas fa-search me-1"></i> Search Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body d-none" id="print_area">

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" id="send_message_btn" class="btn btn-danger mb-2"><i
                                    class="far fa-envelope"></i>
                                Process </button>
                        </div>
                    </div>

                    <div class="table-responsive responsive-table">

                        <table id="datatable1" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>

                                    <th class="">
                                        <input type="checkbox" id="selectAll" class="student-checkbox">
                                    </th>
                                    <th class="">No.</th>
                                    <th class="">Images</th>
                                    <th class="">Student Name </th>
                                    <th class="">Class </th>
                                    <th class="">Section </th>
                                    <th class="">Roll </th>
                                    <th class="">Phone Number</th>
                                    <th class="">Address</th>
                                </tr>
                            </thead>
                            <tbody id="_data">
                                <tr id="no-data">
                                    <td colspan="10" class="text-center">No data available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>





    <!-- Modal for Send Message -->
    <div class="modal fade bs-example-modal-lg" id="sendMessageModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content col-md-12">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><span class="mdi mdi-account-check mdi-18px"></span> &nbsp;Send Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" id="selectedStudentCount"></div>
                    <form id="send_bulk_message_form" action="{{ route('admin.sms.send_message_store') }}" method="POST"> @csrf

                        <div class="form-group mb-2">
                            <label>Message Template </label>
                            <select name="template_id" class="form-control" type="text" required style="width: 100%">
                                <option value="">---Select---</option>
                                @php
                                    $data = \App\Models\Message_template::latest()->get();
                                @endphp
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>SMS </label>
                            <textarea name="message" placeholder="Enter SMS" class="form-control" type="text" style="height: 158px;"></textarea>
                        </div>
                        <div class="modal-footer ">
                            <button data-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-success send_message_button">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var selectedStudents = [];
         $('select[name="find_class_id"]').select2();
         $('select[name="find_section_id"]').select2();
        /*********************** Student Filter and Condition*******************************/
        $(document).on('change', 'select[name="find_class_id"]', function() {
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
                sectionOptions += '<option value="' + section.id + '">' + section.name + '</option>';
            });
            $('select[name="find_section_id"]').html(sectionOptions);
             $('select[name="find_section_id"]').select2();


        });
          /***Load Customer **/
          $("button[name='search_btn']").click(function() {
                var button = $(this);

                button.html(`<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...`);
                button.attr('disabled', true);
                var class_id =   $('select[name="find_class_id"]').val();
                var section_id = $('select[name="find_section_id"]').val();
                if ( $.fn.DataTable.isDataTable("#datatable1") ) {
                    $("#datatable1").DataTable().destroy();
                }
                $.ajax({
                    url: "{{ route('admin.student.student_filter') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {  _token: "{{ csrf_token() }}",class_id: class_id, section_id: section_id},
                    success: function(response) {
                        if(response.success==true){

                             var _number = 1;
                            var html = '';
                            $("#print_area").removeClass('d-none');
                            /*Check if the response data is an array*/
                            if (Array.isArray(response.data) && response.data.length > 0) {
                                response.data.forEach(function(data) {
                                    html += '<tr data-id="' + data.id + '">';

                                    html += '<td><input type="checkbox"  value="' + data.id + '" name="student_ids[]" class="checkSingle Custom Checkbox student-checkbox"></td>';

                                    html += '<td>' + (_number++) + '</td>';

                                    var photo = data.photo ?
                                    '<img src="' + "{{ asset('uploads/photos/') }}/" + data.photo + '"style="width: 50px; height: 50px; border-radius: 50%;">' :
                                    '<img src="' + "{{ asset('uploads/photos/avatar.png') }}" + '"  style="width: 50px; height: 50px; border-radius: 50%;">';


                                    html += '<td>' + photo + '</td>';


                                    html += '<td>' + data.name + '</td>';
                                    html += '<td>' + (data.current_class ? data.current_class.name : 'N/A') +
                                        '</td>';
                                    html += '<td>' + (data.section ? data.section.name : 'N/A') + '</td>';
                                    html += '<td>' + data.roll_no + '</td>';
                                    html += '<td>' + data.phone + '</td>';
                                    html += '<td>' + data.current_address + '</td>';
                                    html += '</tr>';
                                });
                            } else {
                                html += '<tr>';
                                html += '<td colspan="8" style="text-align: center;">No Data Available</td>';
                                html += '</tr>';
                            }

                            $("#_data").html(html);
                            $("#datatable1").DataTable({
                                "paging": true,
                                "searching": true,
                                "ordering": true,
                                "info": true
                            });

                            $('#selectAll').on('click', function() {
                                $('.student-checkbox').prop('checked', this.checked);
                            });
                            $('.student-checkbox').on('click', function() {
                                if ($('.student-checkbox:checked').length == $('.student-checkbox').length) {
                                    $('#selectAll').prop('checked', true);
                                } else {
                                    $('#selectAll').prop('checked', false);
                                }
                            });
                        }

                        if(response.success==false) {
                            toastr.error(response.message);
                            $("#_data").html('<tr id="no-data"><td colspan="10" class="text-center">No data available</td></tr>');
                        }
                    },
                    complete: function() {
                        button.html('<i class="fas fa-search me-1"></i> Search Now');
                        button.attr('disabled', false);
                    }
                });
            });
            $(document).on('click', '#send_message_btn', function(event) {
                event.preventDefault();

                $(".checkSingle:checked").each(function() {
                    selectedStudents.push($(this).val());
                });
                var countText = "You have selected " + selectedStudents.length + " customers.";
                $("#selectedStudentCount").text(countText);
                $('#sendMessageModal').modal('show');
            });
            /*Load Message Template*/
            $("select[name='template_id']").on('change', function() {
                var template_id = $(this).val();
                if (template_id) {
                    $.ajax({
                        url: "{{ route('admin.sms.template_get', ':id') }}".replace(':id',
                            template_id),
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $("textarea[name='message']").val(response.data.message);
                        },
                        error: function(xhr, status, error) {
                            console.log("Error:", error);
                        }
                    });
                } else {
                    $("textarea[name='message']").val('');
                }
            });
            /*Send Message Template*/
            $("#send_bulk_message_form").submit(function(event){
                event.preventDefault();
                var button = $('.send_message_button');
                button.html(`<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...`);
                button.attr('disabled', true);

                /*Get Message Data Value*/
                var message = $("#send_bulk_message_form textarea[name='message']").val();

                if(selectedStudents.length==0){
                    toastr.error('Please Selete Customer');
                    button.html('Send Message');
                    button.attr('disabled', false);
                    return false;
                }
                $.ajax({
                    url: "{{ route('admin.sms.send_message_store') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {  _token: "{{ csrf_token() }}", message: message, student_ids:selectedStudents },
                    success: function(response) {
                        if(response.success==true){
                            toastr.success(response.message);
                            $('#sendMessageModal').modal('hide');
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        }

                        if(response.success==false) {
                            toastr.error(response.message);
                        }
                    },
                    complete: function() {
                        button.html('Send Message');
                        button.attr('disabled', false);
                    }
                });
            });
    </script>

@endsection
