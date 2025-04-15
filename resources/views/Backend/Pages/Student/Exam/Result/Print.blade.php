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
                                    <td> <strong>Name:</strong>{{ $result->first()->student->name }}</td>
                                    <td><strong>Father's Name:</strong> {{ $result->first()->student->father_name }}
                                    </td>
                                    <td rowspan="4" class="student-photo">
                                        <img src="{{ asset(!empty($result->first()->student->photo) ? 'uploads/photos/'.$result->first()->student->photo : 'uploads/photos/avatar.png') }}" alt="image">
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Register No: </strong> 123456</td>
                                    <td><strong>Roll No :</strong>{{ $result->first()->student->roll_no }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date of Birth :</strong>{{ $result->first()->student->birth_date }}</td>
                                    <td><strong>Session :</strong> 2024</td>
                                </tr>
                                <tr>
                                    <td> <strong>Class: </strong>{{ $result->first()->student->currentClass->name }}
                                    </td>
                                    <td><strong>Gender:</strong> {{ $result->first()->student->gender }}</td>
                                </tr>
                            </table>
                        </div>

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
                                        <td>{{ intval($item->written_marks) }}</td>
                                        <td>{{ intval($item->objective_marks) }}</td>
                                        <td>{{ intval($item->practical_marks) }}</td>
                                        <td>{{ intval($item->written_marks) + intval($item->objective_marks) + intval($item->practical_marks) }}
                                        </td>

                                        <td>{{ intval($highest_marks[$item->subject_id] ?? '') }}</td>
                                        @php
                                            $total =
                                                intval($item->written_marks) +
                                                intval($item->objective_marks) +
                                                intval($item->practical_marks);

                                            if ($total >= 80) {
                                                $grade = 'A+';
                                                $point = 5.0;
                                            } elseif ($total >= 70) {
                                                $grade = 'A';
                                                $point = 4.0;
                                            } elseif ($total >= 60) {
                                                $grade = 'A-';
                                                $point = 3.5;
                                            } elseif ($total >= 50) {
                                                $grade = 'B';
                                                $point = 3.0;
                                            } elseif ($total >= 40) {
                                                $grade = 'C';
                                                $point = 2.0;
                                            } elseif ($total >= 33) {
                                                $grade = 'D';
                                                $point = 1.0;
                                            } else {
                                                $grade = 'F';
                                                $point = 0.0;
                                            }
                                        @endphp

                                        <td>{{ $grade }}</td>
                                        <td>{{ number_format($point, 2) }}</td>
                                        <td>
                                            @if ($point == 5.0)
                                                Excellent
                                            @elseif($point >= 4.0)
                                                Very Good
                                            @elseif($point >= 3.0)
                                                Good
                                            @elseif($point >= 2.0)
                                                Satisfactory
                                            @elseif($point >= 1.0)
                                                Pass
                                            @else
                                                Fail
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Summary Section -->
                        @php
                            $grandTotal = 0;
                            $fullMarks = 0;
                            $totalPoints = 0;
                            $subjectCount = count($result);
                            $hasFail = false;
                        @endphp

                        @foreach ($result as $item)
                            @php
                                $written = intval($item->written_marks);
                                $objective = intval($item->objective_marks);
                                $practical = intval($item->practical_marks);
                                $total = $written + $objective + $practical;

                                $grandTotal += $total;
                                $fullMarks += 100; // প্রতি বিষয়ের পূর্ণমান ধরেছি 100

                                if ($total >= 80) {
                                    $point = 5.0;
                                } elseif ($total >= 70) {
                                    $point = 4.0;
                                } elseif ($total >= 60) {
                                    $point = 3.5;
                                } elseif ($total >= 50) {
                                    $point = 3.0;
                                } elseif ($total >= 40) {
                                    $point = 2.0;
                                } elseif ($total >= 33) {
                                    $point = 1.0;
                                } else {
                                    $point = 0.0;
                                    $hasFail = true;
                                }

                                $totalPoints += $point;
                            @endphp
                        @endforeach

                        @php
                            $average = $fullMarks > 0 ? ($grandTotal / $fullMarks) * 100 : 0;
                            $gpa = $subjectCount > 0 ? $totalPoints / $subjectCount : 0;
                        @endphp

                        <div class="summary mt-4 p-3 bg-light border rounded">
                            <div>
                                <strong>Grand Total:</strong> <span>{{ $grandTotal }}/{{ $fullMarks }}</span>
                            </div>
                            <div>
                                <strong>Average:</strong> <span>{{ number_format($average, 2) }}%</span>
                            </div>
                            <div>
                                <strong>GPA:</strong> <span>{{ number_format($hasFail ? 0.0 : $gpa, 2) }}</span>
                            </div>
                            <div>
                                <strong>Result:</strong> <span>{{ $hasFail ? 'Failed' : 'Passed' }}</span>
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
