@php
    $website_info = App\Models\Website_information::first();
@endphp

@extends('Backend.Layout.App')
@section('title', 'Student Tabulation Sheet')

@section('style')
    <style>
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

        .tabulation-container {
            background: #fff;
            padding: 20px;
            /* border-radius: 10px; */
            border: 1px dotted #ccc;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            /* margin-top: 20px; */
        }

        /* .tabulation-container .card-header {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 15px;
            background-color: #f7f7f7;
            border-radius: 6px;
            padding: 15px;
        } */

        .tabulation-container .table th,
        .tabulation-container .table td {
            vertical-align: middle !important;
            text-align: center;
            border: 1px solid #000 !important;
            font-size: 14px;
            padding: 6px 8px;
        }

        .tabulation-container .table th {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        .print-btn {
            margin-bottom: 15px;
            float: right;
        }

        @media print {
            .print-btn {
                display: none;
            }

            body {
                background: #fff;
            }

            .tabulation-container {
                box-shadow: none;
                border: none;
            }

        }

        @media print {
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid black !important;
                padding: 5px;
                text-align: center;
            }

            @page {
                size: A4 landscape;
                margin: 20mm;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="row" id="search_box">
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="exam_id" class="form-label">Examination Name <span
                                        class="text-danger">*</span></label>
                                <select name="exam_id" id="exam_id" class="form-control" style="width: 100%;" required>
                                    <option value="">---Select---</option>
                                    @foreach (\App\Models\Student_exam::latest()->get() as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->name }}--{{ $exam->year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="section_id" class="form-label">Section <span
                                        class="text-danger">*</span></label>
                                <select name="section_id" id="section_id" class="form-control" style="width: 100%;"
                                    required>
                                    <option value="">---Select---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mt-3">
                                <button type="button" name="submit_btn" class="btn btn-success" style="margin-top: 16px">
                                    <i class="fas fa-search"></i> Search Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body tabulation-container d-none" id="tabulation-container">

                    <div id="printHeader" class="school-header">
                        <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}"
                            alt="School Logo">
                        <h2>{{ $website_info->name ?? 'Future ICT School' }}</h2>
                        <p>{{ $website_info->address ?? 'Daudkandi , Chittagong , Bangladesh' }}</p>

                       <span id="examName"></span><br>
                        <span>Class:</span> <span id="className"></span>
                    </div>
                    <div class="card-title mb-2">
                        <i class="fas fa-users"></i> Tabulation Sheet
                    </div>
                    <div class="table-responsive responsive-table display_table">

                        {{-- <table class="table table-bordered table-hover table-condensed mb-none">
                            <thead class="text-dark" style="background: #ededed; font-family: sans-serif;">
                                <tr style="border: 1px solid black !important;">
                                    <td rowspan="2" style="border: 1px solid black !important;">Sl</td>
                                    <td rowspan="2" style="border: 1px solid black !important;">Students</td>
                                    <!-- <td rowspan="2">Register/ID</td> -->
                                    <td rowspan="2" style="border: 1px solid black !important;">Roll</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">English(100)</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">Mathematics(100)</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">Bangla(100)</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">General knowledge(50)</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">Islam & Moral Education(100)</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">Drawing(50)</td>

                                    <td rowspan="2" style="border: 1px solid black !important;">Total Marks</td>
                                    <td rowspan="2" style="border: 1px solid black !important;">GPA</td>
                                    <td rowspan="2" style="border: 1px solid black !important;">P/F</td>
                                    <td rowspan="2" style="border: 1px solid black !important;">Result</td>
                                    <td rowspan="2" style="border: 1px solid black !important;">Position</td>
                                </tr>
                                <tr>


                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>
                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>
                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>
                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>
                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>
                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>

                                </tr>
                            </thead>
                            <tbody>









                                <tr>
                                    <td style="border: 1px solid black !important;">13</td>
                                    <td style="border: 1px solid black !important;">Nusrat Fariya </td>
                                    <!-- <td>413</td> -->
                                    <td style="border: 1px solid black !important;">14</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">92</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">92</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">87</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">87</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">90</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">90</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">50</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">50</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">71</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">71</td>
                                    <td style="border: 1px solid black !important;">4</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">50</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">50</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">440/500 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        4.83 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        6/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-primary">PASS</span>
                                    </td>
                                    <td>
                                        12 </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">14</td>
                                    <td style="border: 1px solid black !important;">Ariyan </td>
                                    <!-- <td>414</td> -->
                                    <td style="border: 1px solid black !important;">15</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">79</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">79</td>
                                    <td style="border: 1px solid black !important;">4</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">65</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">65</td>
                                    <td style="border: 1px solid black !important;">3.5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">70</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">70</td>
                                    <td style="border: 1px solid black !important;">4</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;" colspan="3">A</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">71</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">71</td>
                                    <td style="border: 1px solid black !important;">4</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">45</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">45</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">330/450 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        5/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>
                            </tbody>
                        </table> --}}
                    </div>
                </div>
                <div class="card-footer d-none" id="trabulation_footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" id="printBtn" class="btn btn-danger"><i class="fas fa-print"></i>
                                Generate Print</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $('select').select2({
            placeholder: "---Select---",
            allowClear: false
        });
        var students = @json($students);
        $(document).on('change', 'select[name="class_id"]', function() {
            var sections = @json($sections);
            var subjects = @json($subjects);
            var students = @json($students);
            /*Get Class ID*/
            var selectedClassId = $(this).val();

            var filteredStudents = students.filter(function(student) {
                /*Filter class by class_id*/
                return student.current_class == selectedClassId;
            });
            var filteredSections = sections.filter(function(section) {
                /*Filter sections by class_id*/
                return section.class_id == selectedClassId;
            });
            /* Update Subject dropdown*/
            var filteredSubjects = subjects.filter(function(subject) {
                /*Filter subject by class_id*/
                return subject.class_id == selectedClassId;
            });

            /* Update Student dropdown*/
            var studentOptions = '<option value="">--Select--</option>';
            filteredStudents.forEach(function(student) {
                studentOptions += '<option value="' + student.id + '">' + student.name + '</option>';
            });
            /* Update Section dropdown*/
            var sectionOptions = '<option value="">--Select--</option>';
            filteredSections.forEach(function(section) {
                sectionOptions += '<option value="' + section.id + '">' + section.name + '</option>';
            });
            /* Update Subject dropdown*/
            var subjectOptions = '<option value="">--Select--</option>';
            filteredSubjects.forEach(function(subject) {
                subjectOptions += '<option value="' + subject.id + '">' + subject.name + '</option>';
            });

            $('select[name="student_id"]').html(studentOptions);
            $('select[name="student_id"]').select2();

            $('select[name="section_id"]').html(sectionOptions);
            $('select[name="section_id"]').select2();

            $('select[name="subject_id"]').html(subjectOptions);
            $('select[name="subject_id"]').select2();

        });

        $("button[name='submit_btn']").on('click', function(e) {
            e.preventDefault();
            var exam_id = $("select[name='exam_id']").val();
            var class_id = $("select[name='class_id']").val();
            var section_id = $("select[name='section_id']").val();


            $("#examName").text($('select[name="exam_id"] option:selected').text());
            $("#className").text($('select[name="class_id"] option:selected').text());
            $("#sectionName").text($('select[name="section_id"] option:selected').text());
            if (!exam_id) {
                toastr.error("Exam Name is require!!");
                return;
            }
            if (!class_id) {
                toastr.error("Student Class Name is require!!");
                return;
            }
            let button= $(this);
            button.prop('disabled', true);
            button.html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`
            );
            $.ajax({
                url: "{{ route('admin.student.exam.result.tabulation') }}",
                type: 'POST',
                data: {
                    'exam_id': exam_id,
                    'class_id': class_id,
                    'section_id': section_id,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    button.prop('disabled', false);
                    button.html('<i class="fa fa-search"></i> Search');
                    $("#tabulation-container").removeClass("d-none");
                    $("#trabulation_footer").removeClass("d-none");
                    $(".display_table").html(response);
                }
            });

        });



        /* Print Trabulation  */
        document.getElementById("printBtn").addEventListener("click", function() {
            var printContents = document.getElementById("tabulation-container").innerHTML;
            var printWindow = window.open('', '_blank');

            printWindow.document.write('<html><head><title>Print Tabulation Sheet</title>');
            printWindow.document.write('<style>');

            /* Base font & layout*/
            printWindow.document.write(
                'body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; margin: 20px; color: #000; }'
                );

            /* School header*/
            printWindow.document.write(
            '.school-header { text-align: center; padding: 15px; margin-bottom: 10px; }');
            printWindow.document.write('.school-header img { height: 80px; width: 80px; margin-bottom: 10px; }');
            printWindow.document.write('.school-header h2 { font-size: 20px; margin: 0; }');
            printWindow.document.write('.school-header p { margin: 0; font-size: 14px; color: #333; }');

            /* Table styles*/
            printWindow.document.write(
                'table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }');
            printWindow.document.write(
                'th, td { border: 1px solid #000; padding: 5px; text-align: center; vertical-align: middle; }');
            printWindow.document.write('thead th { background-color: #f2f2f2; font-weight: bold; }');
            printWindow.document.write('tbody tr:nth-child(even) { background-color: #f9f9f9; }');

            /*Footer / signature space*/
            printWindow.document.write(
                '.signature-section { margin-top: 50px; display: flex; justify-content: space-between; }');
            printWindow.document.write(
                '.signature-box { width: 200px; text-align: center;  border-top: 2px dotted #cfc9c9; padding-top: 5px; }'
                );

            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents);

            /*Optional signature section*/
            printWindow.document.write(`
        <div class="signature-section">
            <div class="signature-box">Class Teacher</div>
            <div class="signature-box">Headmaster</div>
        </div>
    `);

            printWindow.document.write('</body></html>');

            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        });
    </script>
@endsection
