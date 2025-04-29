
@php
$website_info=App\Models\Website_information::first();
@endphp
@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
<style>
    /* Print CSS */
    @media print {
        #printButton {
            display: none;
        }
        .card {
            border: none;
            box-shadow: none;
        }
    }
    .school-header {
        text-align: center;
        padding: 15px;
    }
    .school-header img {
        height: 80px;
        width: 80px;
        margin-bottom: 10px;
    }
    .school-header h2 {
        font-weight: 100;
        margin-bottom: 5px;
    }
    .school-header p {
        margin-bottom: 5px;
        font-size: 14px;
        color: #555;
    }
    .info-box {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 16px;
        font-weight: bold;
    }
    @media print {
        th.hide-on-print, td.hide-on-print {
            display: none !important;
        }
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <form id="search_box">
                    <div class="row align-items-end">


                        <!-- Examination Dropdown -->
                        <div class="col-md-3 ">
                            <label for="find_exam_id">Examination Name</label>
                            <select name="find_exam_id" id="find_exam_id" class="form-control"required>
                                <option value="">---Select---</option>
                                @php
                                    $exams = \App\Models\Student_exam::latest()->get();
                                @endphp
                                @foreach($exams as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Class Dropdown -->
                        <div class="col-md-3 ">
                            <label for="find_class_id">Class</label>
                            <select name="find_class_id" id="find_class_id" class="form-control" required>
                                <option value="">---Select---</option>
                                @php
                                    $classes = \App\Models\Student_class::latest()->get();
                                @endphp
                                @foreach($classes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Section  Dropdown -->
                        <div class="col-md-3 ">
                            <label for="find_section_id">Section</label>
                            <select name="find_section_id" id="find_section_id" class="form-control" required>
                                <option value="">---Select---</option>

                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-md-3 ">

                            <button type="button" name="submit_btn" class="btn btn-success mr-2">
                                <i class="mdi mdi-magnify"></i> Find Examination Routine
                            </button>
                            {{-- <button type="button" name="exam_attendance_sheet_submit_btn" class="btn btn-primary">
                                <i class="mdi mdi-magnify"></i> Exam Attendance Sheet
                            </button> --}}
                        </div>
                    </div>
                </form>
            </div>



        </div>

    </div>
</div>

<div class="row d-none" id="table_area">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button id="printButton" class="btn btn-primary"><i class="fas fa-print"></i> </button>
            </div>
            <div class="card-body" id="tableArea">

                 <!-- School Header -->
                 <div id="printHeader" class="school-header">
                    <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}" alt="School Logo">
                    <h2>{{ $website_info->name ?? 'Future ICT School' }}</h2>
                    <p>{{ $website_info->address ?? 'Daudkandi , Chittagong , Bangladesh' }}</p>

                    <span><span><span id="examName"></span></span><br>
                    <span><span>Class: <span id="className"></span></span><br>
                    <span>Examination Routine</span></span>
                </div>
                <div class="table-responsive responsive-table" >
                    <table id="datatable1" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead >
                            <tr>
                                <th>No.</th>

                                <th>Subject Name</th>
                                <th>Exam Date</th>

                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Room Number</th>
                            </tr>
                        </thead>
                        <tbody id="routine_data">
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
<div class="row d-none" id="exam_attendance_sheet">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center text-right">
                <button id="exam_attendance_sheet_print" class="btn btn-primary">
                    <i class="fas fa-print"></i>
                </button>
                {{-- <h3 class="card-title mb-0">Student Exam Attendance</h3> --}}
            </div>

            <div class="card-body table-responsive p-0" id="attendance_print_area">
                <!-- School Header -->
                <div id="printHeader" class="school-header">
                    <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}" alt="School Logo">
                    <h2>{{ $website_info->name ?? 'Future ICT School' }}</h2>
                    <p>{{ $website_info->address ?? 'Daudkandi , Chittagong , Bangladesh' }}</p>

                    <span><span><span id="attendance_examName"></span></span><br>
                    <span><span>Class: <span id="attendance_className"></span></span><br>
                    <span>Examination Attendance Sheet</span></span>
                </div>
                <div style="overflow-x:auto;" id="exam_attendance_response">

                </div>

            </div>
          </div>

    </div>
</div>
@include('Backend.Modal.delete_modal')


@endsection

@section('script')
<script  src="{{ asset('Backend/assets/js/custom_select.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){

        $("select[name='find_class_id']").select2();
        $("select[name='find_exam_id']").select2();
        $("#datatable1").DataTable();

    });




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

    $("button[name='submit_btn']").on('click',function(e){
        e.preventDefault();
        /*Hide Attendance Button */
        $("button[name='exam_attendance_sheet_submit_btn']").hide();

        var class_id = $("select[name='find_class_id']").val();
        var exam_id = $("select[name='find_exam_id']").val();
        var section_id = $("select[name='find_section_id']").val();
        $("#examName").text($('select[name="find_exam_id"] option:selected').text());
        $("#className").text($('select[name="find_class_id"] option:selected').text());
        fetch_exam_routine_data(class_id,exam_id, section_id);
    });
    function _time_formate(time) {
        let [hour, minute, second] = time.split(':');
        hour = parseInt(hour);
        let ampm = hour >= 12 ? 'PM' : 'AM';
        hour = hour % 12 || 12; // 12-hour format
        return `${hour}:${minute} ${ampm}`;
    }

    function _handleSubmit(formSelector, modalSelector) {
        $(formSelector).submit(function(e) {
            e.preventDefault();

            /* Get the submit button */
            var submitBtn = $(this).find('button[type="submit"]');
            var originalBtnText = submitBtn.html();

            submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden"></span>');
            submitBtn.prop('disabled', true);

            var form = $(this);
            var formData = new FormData(this);

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success==true) {
                        toastr.success(response.message);
                        /* Hide the modal */
                        $(modalSelector).modal('hide');
                        /* Reload the Page */
                        let class_id = $("select[name='find_class_id']").val();
                        let exam_id = $("select[name='find_exam_id']").val();
                        let section_id = $("select[name='find_section_id']").val();

                        if (class_id && exam_id && class_id.trim() !== '' && exam_id.trim() !== '' && section_id.trim() !== '') {
                            fetch_exam_routine_data(class_id, exam_id, section_id);
                        } else {
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                        }

                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        /* Validation error*/
                        var errors = xhr.responseJSON.errors;

                        /* Loop through the errors and show them using toastr*/
                        $.each(errors, function(field, messages) {
                            $.each(messages, function(index, message) {
                                /* Display each error message*/
                                toastr.error(message);
                            });
                        });
                    } else {
                        /*General error message*/
                        toastr.error('An error occurred. Please try again.');
                    }
                },
                complete: function() {
                    submitBtn.html(originalBtnText);
                    submitBtn.prop('disabled', false);
                }
            });
        });
    }

  function fetch_exam_routine_data(class_id,exam_id, section_id){
    var submitBtn =  $('#search_box').find('button[name="submit_btn"]');
        submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);
        submitBtn.prop('disabled', true);
    $.ajax({
            type: 'POST',
            url: "{{ route('admin.student.exam.routine.get_exam_routine') }}",
            cache: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                class_id: class_id,
                exam_id: exam_id,
                section_id: section_id,
            },
            success: function(response) {
            /* Check if the response is successful */
            if (response.success) {
                $('#table_area').removeClass('d-none');
                $('#no-data').remove();
            } else {
                $('#table_area').addClass('d-none');
                $('#routine_data').html('<tr id="no-data"><td colspan="10" class="text-center">No data available</td></tr>');
            }
            var _number = 1;
            var html = '';

            /*Check if the response data is an array*/
            if (Array.isArray(response.data) && response.data.length > 0) {
                response.data.forEach(function(data) {

                    html += '<tr data-id="' + data.id + '">';
                    html += '<td>' + (_number++) + '</td>';
                    html += '<td>' + (data.subject ? data.subject.name : 'N/A') + '</td>';
                    html += '<td>' + data.exam_date + '</td>';
                    html += '<td>' + _time_formate(data.start_time) + '</td>';
                    html += '<td>' +_time_formate( data.end_time) + '</td>';
                    html += '<td>' + data.room_number + '</td>';

                    html += '</tr>';
                });
            } else {
                html += '<tr>';
                html += '<td colspan="10" style="text-align: center;">No Data Available</td>';
                html += '</tr>';
            }

            $("#routine_data").html(html);
        },
        error: function() {
            toastr.error('An error occurred. Please try again.');
        },
        complete:function(){
            submitBtn.html('<i class="mdi mdi-magnify"></i> Find Examination Routine');
            submitBtn.prop('disabled', false);
        }

        });
  }


    /*********************** Print Student Exam Routine Data *******************************/
    document.getElementById("printButton").addEventListener("click", function() {
        var printContents = document.getElementById("tableArea").outerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = "<html><head><title>Print</title></head><body>" + printContents + "</body></html>";
        window.print();
        document.body.innerHTML = originalContents;
    });
    /*********************** Student Exam Attendance Print Data *******************************/
    document.getElementById("exam_attendance_sheet_print").addEventListener("click", function() {
        var printContents = document.getElementById("attendance_print_area").outerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = "<html><head><title>Print</title></head><body>" + printContents + "</body></html>";
        window.print();
        document.body.innerHTML = originalContents;
    });
    /********* **************  Student Exam Attendance Data *******************************/
    $("button[name='exam_attendance_sheet_submit_btn']").on('click',function(e){
        e.preventDefault();
        /*Hide Exam Routine Button */
        $("button[name='submit_btn']").hide();

        var class_id = $("select[name='find_class_id']").val();
        var exam_id = $("select[name='find_exam_id']").val();
        $("#attendance_examName").text($('select[name="find_exam_id"] option:selected').text());
        $("#attendance_className").text($('select[name="find_class_id"] option:selected').text());

        var submitBtn =  $(this);
        submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);
        submitBtn.prop('disabled', true);

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.student.exam.routine.get_exam_attendance') }}",
            cache: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                class_id: class_id,
                exam_id: exam_id,
            },
            success: function(response) {
                $("#exam_attendance_sheet").removeClass('d-none');
                $("#exam_attendance_response").html(response);
            },
        error: function() {
            toastr.error('An error occurred. Please try again.');
        },
        complete:function(){
            submitBtn.html('<i class="mdi mdi-magnify"></i> Exam Attendance Sheet');
            submitBtn.prop('disabled', false);
        }

        });
    });

  </script>
@endsection
