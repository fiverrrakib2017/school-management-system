
@php
$website_info=App\Models\Website_information::first();
@endphp
@extends('Backend.Layout.App')
@section('title','Dashboard | Class Routine | Admin Panel')
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
                                <i class="fas fa-search"></i> Find Class Routine
                            </button>
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
                    <span><span>Class: <span id="className"></span></span><br>
                    <span><span>Section: <span id="sectionName"></span></span><br>
                    <span>Class Routine</span></span>
                </div>
                <div class="table-responsive responsive-table" >
                   <table class="table table-bordered" style="width:100%">
                        <thead id="routine_header"></thead>
                        <tbody id="routine_data"></tbody>
                    </table>
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
        $("#sectionName").text($('select[name="find_section_id"] option:selected').text());
        fetch_exam_routine_data(class_id, section_id);
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

  function fetch_exam_routine_data(class_id, section_id){
    var submitBtn =  $('#search_box').find('button[name="submit_btn"]');
        submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);
        submitBtn.prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.student.class.routine.show_class_routine') }}",
            cache: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                class_id: class_id,
                section_id: section_id,
            },
            success: function(response) {
                if(response.success==false){
                    toastr.error(response.message);
                    return false;
                }
                if (response.success==true) {
                    $('#table_area').removeClass('d-none');
                    $('#no-data').remove();

                    let htmlHeader = '<tr><th>Day / Time</th>';
                    response.timeSlots.forEach(slot => {
                        htmlHeader += `<th>${slot.start} - ${slot.end}</th>`;
                    });
                    htmlHeader += '</tr>';
                    $('#routine_header').html(htmlHeader);

                    let htmlBody = '';
                    response.days.forEach(day => {
                        htmlBody += `<tr><td><b>${day}</b></td>`;

                        response.timeSlots.forEach(slot => {
                            const routine = response.data.find(item =>
                                item.day === day &&
                                item.start_time === slot.start &&
                                item.end_time === slot.end
                            );

                            if (routine) {
                                htmlBody += `<td>${routine.subject_name}<br><small>${routine.teacher_name}</small></td>`;
                            } else {
                                htmlBody += `<td>--</td>`;
                            }
                        });

                        htmlBody += '</tr>';
                    });

                    $('#routine_data').html(htmlBody);

                }else{
                    $('#table_area').addClass('d-none');
                    $('#routine_data').html('');
                    $('#routine_header').html('');
                    toastr.error(response.error);
                }

            },
             error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';

                    $.each(errors, function(key, value) {
                        errorMessages += value[0];
                        toastr.error(errorMessages);
                    });


                }
            },
            complete:function(){
                submitBtn.html(`<i class="fas fa-search"></i> Find Class Routine`);
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

  </script>
@endsection
