@php
    $website_info = App\Models\Website_information::first();

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Result Card</title>
    <style>
    @media print {
        .page-break {
            page-break-after: always;
        }
    }

        * {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        body {
            /* background: url('https://png.pngtree.com/png-vector/20230515/ourmid/pngtree-luxury-golden-rectangle-corner-certificate-border-pattern-line-photo-frame-islamic-vector-png-image_7098529.png') no-repeat center center;
            background-size: cover; */
            /* padding: 40px; */
            font-family: 'Arial', sans-serif;
        }

        .card-container {
            background-color: white;
            padding: 20px;
            border: 3px dotted #a19898;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* border-bottom: 1px dotted #a19898; */
            padding-bottom: 10px;
            font-family: serif;
        }

        .school-logo {
            width: 100px;
            height: 100px;
        }

        .school-info {
            text-align: center;
            flex: 1;
        }

        .school-info h2 {
            font-size: 30px;
            margin-bottom: 5px;
        }

        .school-info p {
            margin-bottom: 2px;
            font-size: 13px;
        }

        .result-title {
            text-align: center;
            /* margin: 15px 0; */
            font-size: 18px;
            font-weight: bold;
            /* text-transform: uppercase; */
            /* text-decoration: underline; */
        }

        /***Student Info sTART******/
        .student-info {
            margin-top: 20px;
        }

        .student-info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        .student-info-table td {
            padding: 8px;
            vertical-align: top;
        }

        .student-photo {
            text-align: right;
            padding-left: 20px;
        }

        .student-photo img {
            width: 131px;
            height: auto;

        }

        /***Student Info End******/





        .result-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .result-table th,
        .result-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        .summary {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
        }

        .summary div {
            width: 32%;
            border: 1px solid #000;
            padding: 8px;
            font-weight: unset;
        }

        .grade-scale {
            width: 600px;
            /* float: right; */
            margin-top: 20px;

            padding: 15px;

            background-color: #fefefe;

        }

        .grade-scale h4 {
            margin-bottom: 10px;
            font-size: 18px;
            text-align: center;
            text-decoration: underline;
        }

        .grade-scale table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        .grade-scale th,
        .grade-scale td {
            border: 1px solid #999;
            padding: 8px;
        }

        .grade-scale th {
            background-color: #ffffff;
        }

        .signatures {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .signatures .sig-box {
            width: 20%;
        }

        .signatures .sig-line {
            border-top: 2px dotted #cfc9c9;
            margin-top: 40px;
        }

        .print-date {
            margin-top: 15px;
            font-size: 12px;
            text-align: right;
        }


    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            @foreach ($results as $result)
                <div class="col-md-12 mb-5 mt-2">
                    <div class="card-container">
                        <!-- Header -->
                        <div class="header">
                            {{-- <img src="{{ public_path('images/school-logo.png') }}" class="school-logo" alt="School Logo"> --}}
                            <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}"
                                class="img-fluid school-logo" alt="School Logo" width="100">
                            <div class="school-info">
                                <h2>{{ $website_info->name }}</h2>
                                <p>{{ $website_info->address }}</p>
                                <p>Phone: {{ $website_info->phone_number }} | Email: {{ $website_info->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="result-title">
                            <p>Result Card || {{ $result->first()->exam->name }} - {{ $result->first()->exam->year }}
                            </p>
                            <hr>

                        </div>

                        <!-- Student Info -->
                        <div class="student-info">
                            <table class="student-info-table">
                                <tr>
                                    <td> <strong>Name:</strong>{{ $result->first()->student->name ?? 'N/A' }}</td>
                                    <td><strong>Father's Name:</strong> {{ $result->first()->student->father_name ?? 'N/A' }}
                                    </td>
                                    <td rowspan="4" class="student-photo">
                                        <img src="{{ asset(!empty($result->first()->student->photo) ? 'uploads/photos/'.$result->first()->student->photo : 'uploads/photos/avatar.png') }}" alt="image">
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Register No: </strong> N/A</td>
                                    <td><strong>Roll No :</strong>{{ $result->first()->student->roll_no?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date of Birth :</strong>{{ $result->first()->student->birth_date ?? 'N/A' }}</td>
                                    <td><strong>Session :</strong> 2025</td>
                                </tr>
                                <tr>
                                    <td> <strong>Class: </strong>{{ $result->first()->student->currentClass->name }}
                                    </td>
                                    <td><strong>Gender:</strong> {{ $result->first()->student->gender }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Result Table -->
                       <!-- Result Table -->
                        <table class="result-table">
                            <thead>
                                <tr>
                                    <th>Subjects</th>
                                    <th>Written</th>
                                    <th>Objective</th>
                                    <th>Practical</th>
                                    <th>Total</th>
                                    <th>Highest</th>
                                    <th>Grade</th>
                                    <th>Point</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $item)
                                    <tr>
                                        <td>{{ $item->subject->name }}</td>
                                        <td>{{ intval($item->written_marks) }}/{{ intval($routines[$item->subject_id]->written_full ?? 0) }}</td>
                                        <td>{{ intval($item->objective_marks) }}/{{ intval($routines[$item->subject_id]->objective_full ?? 0) }}</td>
                                        <td>{{ intval($item->practical_marks) }}/{{ intval($routines[$item->subject_id]->practical_full ?? 0) }}</td>

                                        @php
                                            $written = intval($item->written_marks ?? 0);
                                            $objective = intval($item->objective_marks ?? 0);
                                            $practical = intval($item->practical_marks ?? 0);
                                            $total = $written + $objective + $practical;

                                            $routine = $routines[$item->subject_id] ?? null;

                                            $written_pass = $routine->written_pass ?? 0;
                                            $objective_pass = $routine->objective_pass ?? 0;
                                            $practical_pass = $routine->practical_pass ?? 0;

                                            $written_full = $routine->written_full ?? 0;
                                            $objective_full = $routine->objective_full ?? 0;
                                            $practical_full = $routine->practical_full ?? 0;

                                            $total_full = $written_full + $objective_full + $practical_full;

                                            $is_fail = false;

                                            if ($written < $written_pass || $objective < $objective_pass || $practical < $practical_pass) {
                                                $is_fail = true;
                                            }

                                            if ($total_full > 0) {
                                                $percentage = ($total / $total_full) * 100;
                                            } else {
                                                $percentage = 0;
                                            }

                                            if ($is_fail) {
                                                $grade = 'F';
                                                $point = 0.0;
                                                $remarks = 'Try Again';
                                            } else {
                                                if ($percentage >= 80) {
                                                    $grade = 'A+';
                                                    $point = 5.0;
                                                    $remarks = 'Excellent';
                                                } elseif ($percentage >= 70) {
                                                    $grade = 'A';
                                                    $point = 4.0;
                                                    $remarks = 'Very Good';
                                                } elseif ($percentage >= 60) {
                                                    $grade = 'A-';
                                                    $point = 3.5;
                                                    $remarks = 'Good';
                                                } elseif ($percentage >= 50) {
                                                    $grade = 'B';
                                                    $point = 3.0;
                                                    $remarks = 'Satisfactory';
                                                } elseif ($percentage >= 40) {
                                                    $grade = 'C';
                                                    $point = 2.0;
                                                    $remarks = 'Needs Improvement';
                                                } elseif ($percentage >= 33) {
                                                    $grade = 'D';
                                                    $point = 1.0;
                                                    $remarks = 'Poor';
                                                } else {
                                                    $grade = 'F';
                                                    $point = 0.0;
                                                    $remarks = 'Try Again';
                                                }

                                            }
                                        @endphp

                                        <td>{{ $total }}</td>
                                        <td>{{ intval($highest_marks[$item->subject_id] ?? 0) }}</td>
                                        <td>{{ $grade }}</td>
                                        <td>{{ number_format($point, 2) }}</td>
                                        <td>{{ $remarks }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <!-- Summary Section -->






                        @php
                        $grand_total_obtained = 0;
                        $grand_total_full = 0;
                        $total_gpa = 0;
                        $subject_count = 0;
                        $has_failed = false;
                    @endphp

                    @foreach ($result as $item)
                        @php
                            $routine = $routines[$item->subject_id] ?? null;

                            $written = intval($item->written_marks);
                            $objective = intval($item->objective_marks);
                            $practical = intval($item->practical_marks);

                            $written_full = $routine->written_full ?? 0;
                            $objective_full = $routine->objective_full ?? 0;
                            $practical_full = $routine->practical_full ?? 0;

                            $written_pass = $routine->written_pass ?? 0;
                            $objective_pass = $routine->objective_pass ?? 0;
                            $practical_pass = $routine->practical_pass ?? 0;

                            $total_obtained = $written + $objective + $practical;
                            $total_full = $written_full + $objective_full + $practical_full;

                            $grand_total_obtained += $total_obtained;
                            $grand_total_full += $total_full;

                            // Fail check
                            if (($written < $written_pass) || ($objective < $objective_pass) || ($practical < $practical_pass)) {
                                $has_failed = true;
                                $gpa = 0.00;
                            } else {
                                $percentage = $total_full > 0 ? ($total_obtained / $total_full) * 100 : 0;
                                if ($percentage >= 80) {
                                    $gpa = 5.0;
                                } elseif ($percentage >= 70) {
                                    $gpa = 4.0;
                                } elseif ($percentage >= 60) {
                                    $gpa = 3.5;
                                } elseif ($percentage >= 50) {
                                    $gpa = 3.0;
                                } elseif ($percentage >= 40) {
                                    $gpa = 2.0;
                                } elseif ($percentage >= 33) {
                                    $gpa = 1.0;
                                } else {
                                    $gpa = 0.0;
                                }
                            }

                            $total_gpa += $gpa;
                            $subject_count++;
                        @endphp
                    @endforeach

                    @php
                        $average_percentage = $grand_total_full > 0 ? number_format(($grand_total_obtained / $grand_total_full) * 100, 2) : 0;
                        $final_result = $has_failed ? 'Fail' : 'Pass';
                        $final_gpa = $has_failed ? 'N/A' : number_format($total_gpa / $subject_count, 2);
                    @endphp

                    <!-- Summary Box -->
                    <div class="summary mt-4 p-3 bg-light border rounded">
                        <div>
                            <strong>Grand Total:</strong> <span>{{ $grand_total_obtained }}/{{ $grand_total_full }}</span>
                        </div>
                        <div>
                            <strong>Average:</strong> <span>{{ $average_percentage }}%</span>
                        </div>
                        <div>
                            <strong>GPA:</strong> <span>{{ $final_gpa }}</span>
                        </div>
                        <div>
                            <strong>Result:</strong> <span>{{ $final_result }}</span>
                        </div>
                    </div>




                        <!-- Grade Scale -->
                        <div class="grade-scale">
                            <h4>Grading Scale</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Letter Grade</th>
                                        <th>Grade Point</th>
                                        <th>Marks Range</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>A+</td>
                                        <td>5.00</td>
                                        <td>80-100</td>
                                    </tr>
                                    <tr>
                                        <td>A</td>
                                        <td>4.00</td>
                                        <td>70-79</td>
                                    </tr>
                                    <tr>
                                        <td>A-</td>
                                        <td>3.50</td>
                                        <td>60-69</td>
                                    </tr>
                                    <tr>
                                        <td>B</td>
                                        <td>3.00</td>
                                        <td>50-59</td>
                                    </tr>
                                    <tr>
                                        <td>C</td>
                                        <td>2.00</td>
                                        <td>40-49</td>
                                    </tr>
                                    <tr>
                                        <td>D</td>
                                        <td>1.00</td>
                                        <td>33-39</td>
                                    </tr>
                                    <tr>
                                        <td>F</td>
                                        <td>0.00</td>
                                        <td>0-32</td>
                                    </tr>
                                    <!-- Add more rows -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Signatures -->
                        <div class="signatures">
                            <div class="sig-box">
                                <div class="sig-line"></div>
                                Class Teacher
                            </div>
                            <div class="sig-box">
                                <div class="sig-line"></div>
                                Guardian
                            </div>
                            <div class="sig-box">
                                <div class="sig-line"></div>
                                Headmaster
                            </div>
                        </div>

                        <!-- Print Date -->
                        <div class="print-date">
                            Print Date: {{ date('d-m-Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
</body>

</html>
