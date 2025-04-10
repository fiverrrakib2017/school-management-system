{{-- @php
$website_info = App\Models\Website_information::first();
@endphp
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<title>Student Result Sheet</title>
<style>
    body {
        background-color: #f9f9f9;
        font-family: Arial, serif;
    }
    .result-sheet {
        background: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 20px;
        margin: 40px auto;
        max-width: 900px;
        border: 2px solid #999797;
    }
    .header-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid #999797;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    .header-section img {
        border-radius: 5px;
        width: 120px;
        height: auto;
    }
    .student-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .student-photo img {
        width: 145px;
        height: 162px;
        object-fit: cover;
        border: 1px solid #999797;
    }
    .info-table td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    .result-table {
        margin-top: 20px;
    }
    .result-table th, .result-table td {
        border: 1px solid #999797;
        padding: 10px;
        text-align: center;
    }
    .footer {
        text-align: center;
        margin-top: 20px;
        font-weight: bold;
    }
</style>
</head>
<body>
    <section>
        <div class="container py-4">
            <div class="result-sheet  p-4 bg-white rounded">
                <div class="header-section d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <div>
                        <h4 class="text-primary font-weight-bold">{{ $website_info->name }}</h4>
                        <p class="mb-1"><strong>Address:</strong> {{ $website_info->address }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $website_info->email }}</p>
                        <p class="mb-0"><strong>Phone:</strong> {{ $website_info->phone_number }}</p>
                    </div>
                    <div>
                        <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}" class="img-fluid" alt="School Logo" width="100">
                    </div>
                    <div class="text-end">
                        <h4 class="text-danger font-weight-bold">Result Sheet</h4>
                        <h5 class="mb-0">{{ $exam->name }} - {{ $exam->year }}</h5>
                    </div>
                </div>

                <div class="student-info d-flex align-items-center bg-light p-3 rounded">
                    <div class="me-3">
                        <img src="{{ asset(!empty($student->photo) ? 'uploads/photos/'.$student->photo : 'uploads/photos/avatar.png') }}" class="img-fluid" alt="image" width="80">
                    </div>
                    <table class="table table-borderless m-0">
                        <tr><td><b>Student Name:</b> {{ $student->name }}</td><td><b>Roll:</b> {{ $student->roll_no }}</td></tr>
                        <tr><td><b>Class:</b> {{ $student->currentClass->name }}</td><td><b>Section:</b> {{ $student->section->name }}</td></tr>
                        <tr><td><b>Father's Name:</b> {{ $student->father_name }}</td><td><b>DOB:</b> {{ \Carbon\Carbon::parse($student->birth_date)->format('d M Y') }}</td></tr>
                    </table>
                </div>

                <h5 class="text-center mt-4 text-uppercase fw-bold">Subject-wise Result</h5>
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Subject</th>
                            <th>Written Marks</th>
                            <th>Practical Marks</th>
                            <th>Objective Marks</th>
                            <th>Total Marks</th>
                            <th>Grade</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_marks = 0;
                            $max_marks = 0;
                            $get_result = App\Models\Student_exam_result::with('subject')
                                ->where('student_id', $student->id)
                                ->where('exam_id', $exam->id)
                                ->get();
                        @endphp
                        @foreach ($get_result as $item)
                            @php
                                $total_marks += $item->total_marks;
                                $max_marks += 100;
                            @endphp
                            <tr>
                                <td>{{ $item->subject->name }}</td>
                                <td>{{ $item->written_marks }}</td>
                                <td>{{ $item->practical_marks }}</td>
                                <td>{{ $item->objective_marks }}</td>
                                <td><b>{{ $item->total_marks }}</b></td>
                                <td class="fw-bold text-primary">{{ $item->grade }}</td>
                                <td class="text-success">{{ $item->remarks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="footer mt-4 p-3 bg-light rounded text-center">
                    <p><strong>Total Marks:</strong> {{ $total_marks }}</p>
                    <p><strong>Percentage:</strong> {{ $max_marks > 0 ? number_format(($total_marks / $max_marks) * 100, 2) : 'N/A' }}%</p>
                    <p><strong>Final Grade:</strong>
                        @php
                            if ($max_marks > 0) {
                                $percentage = ($total_marks / $max_marks) * 100;
                                if ($percentage >= 90) $final_grade = 'A+';
                                elseif ($percentage >= 80) $final_grade = 'A';
                                elseif ($percentage >= 70) $final_grade = 'B';
                                elseif ($percentage >= 60) $final_grade = 'C';
                                elseif ($percentage >= 50) $final_grade = 'D';
                                else $final_grade = 'F';
                            } else {
                                $final_grade = 'N/A';
                            }
                        @endphp
                        <span class="badge bg-success text-white">{{ $final_grade }}</span>
                    </p>
                    <p class="text-success fw-bold">Best of Luck for Your Future!</p>
                </div>
            </div>
        </div>
    </section>
<script>
    window.addEventListener("load", function() {
        window.print();
    });
</script>
</body>
</html> --}}


@php
    $website_info = App\Models\Website_information::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Result Card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
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
            margin: 15px 0;
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

    .grade-scale th, .grade-scale td {
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
            <div class="col-md-12 mb-5">
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
                        <p>Result Card || 1st Semester - 2025 </p><hr>

                    </div>

                    <!-- Student Info -->
                    <div class="student-info">
                        <table class="student-info-table">
                            <tr>
                                <td> <strong>Name</strong>:Sumon Mia</td>
                                <td><strong>Father's Name</strong>: Mr. Saidur Rahman</td>
                                <td rowspan="4" class="student-photo">
                                    <img src="https://scontent.fdac24-2.fna.fbcdn.net/v/t39.30808-6/482008355_10163244560728103_4494804137816326065_n.jpg?stp=cp6_dst-jpg_tt6&_nc_cat=111&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=aaxuddm0g04Q7kNvwGuWyY_&_nc_oc=Adkj2aghK9gopdtPtxWU-NVOs_Hnq5ge1UnF2eLNMHQhgbpYDls95g3HuZDc6QwjGIM&_nc_zt=23&_nc_ht=scontent.fdac24-2.fna&_nc_gid=6dphBAP6gCPXJn7jRb0_Pg&oh=00_AfF7Tzr0LThvAD7A13wvhofNrVBRTw3rz58571ZjLrYX9A&oe=67FD1E5B"
                                        alt="Student Photo">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Register No </strong>: 123456</td>
                                <td><strong> No </strong>:10</td>
                            </tr>
                            <tr>
                                <td><strong>Date of Birth</strong>: 2008-05-10</td>
                                <td><strong>Session</strong>: 2024</td>
                            </tr>
                            <tr>
                                <td> <strong>Class </strong>:Eight</td>
                                <td><strong>Gender</strong>: Male</td>
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
                            @php
                                $total_marks = 0;
                                $max_marks = 0;
                                $get_result = App\Models\Student_exam_result::with('subject')
                                    ->where('student_id', $student->id)
                                    ->where('exam_id', $exam->id)
                                    ->get();
                            @endphp
                            @foreach ($get_result as $result)
                                @php
                                    $total_marks += $result->total_marks;
                                    $max_marks += 100;
                                @endphp
                                <tr>
                                    <td>{{ $result->subject->name }}</td>
                                    <td>{{ $result->written_marks }}</td>
                                    <td>{{ $result->objective_marks }}</td>
                                    <td>{{ $result->practical_marks }}</td>
                                    <td><b>{{ $result->total_marks }}</b></td>
                                    <td>100</td>
                                    <td>{{ $result->grade }}</td>
                                    <td >{{ $result->point }}</td>
                                    <td >{{ $result->remarks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Summary Section -->
                    <div class="summary">
                        <div >
                            Grand Total: <span>630/700</span>

                        </div>
                        <div >
                            Average: <span>66.92%</span>
                        </div>
                        <div>GPA: <span>5.00</span></div>
                        <div>Result: <span>Passed</span></div>
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
        </div>
    </div>

    <script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
</body>

</html>
