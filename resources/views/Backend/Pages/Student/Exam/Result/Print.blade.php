@php
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
</html>
