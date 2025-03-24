
@php
$website_info=App\Models\Website_information::first();
@endphp
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<title>Student Admit Card</title>
<style>
    body {
        background-color: #f9f9f9;
        font-family: Arial, serif;
    }
    .admit-card {
        background: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 20px;
        margin: 40px auto;
        max-width: 900px;
        border: 2px dotted #999797;
    }
    .header-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px dotted #999797;
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
        /* width: 120px;
        height: 120px; */
        width: 145px;
        height: 162px;
        /* border-radius: 50%; */
        object-fit: cover;
        border: 1px dotted #999797;
    }


    .info-table td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    .exam-table {
        margin-top: 20px;
    }
    .exam-table th {
        /* background-color: #007bff; */
        color: black;
        text-align: center;
    }
    .exam-table td {
        border: 1px dotted #999797;
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
    <div class="container">
        <div class="admit-card">
            <div class="header-section">
                <div class="text-left">
                    <h4 class="text-primary font-weight-bold">{{ $website_info->name }}</h4>
                    <p class="mb-1"><strong>Address:</strong> {{ $website_info->address }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $website_info->email }}</p>
                    <p class="mb-0"><strong>Phone:</strong> {{ $website_info->phone_number }}</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}" alt="School Logo" style="width: 120px; height: auto;">
                </div>
                <div class="text-right">
                    <h4 class="text-danger font-weight-bold">Student Marksheet</h4>
                    <h5 class="mb-0">{{ $exam->name ?? 'N/A' }} - {{ $exam->year  ?? 'N/A' }}</h5>
                </div>
            </div>

            <div class="student-info">
                <div class="student-photo">
                    <img src="{{ asset(!empty($student->photo) ? 'uploads/photos/'.$student->photo : 'uploads/photos/avatar.png') }}" alt="image">
                </div>
                <table class="table info-table">
                    <tr>
                        <td><b>Student Name:</b> {{ $student->name ?? 'N/A' }}</td>
                        <td><b>Gender:</b> {{ $student->gender  ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><b>Class:</b> {{ $student->currentClass->name ?? 'N/A'  }}</td>
                        <td><b>Section:</b> {{ $student->section->name ?? 'N/A'  }}</td>
                    </tr>
                    <tr>
                        <td><b>Father's Name:</b> {{ $student->father_name  ?? 'N/A' }}</td>
                        <td><b>DOB:</b> {{ \Carbon\Carbon::parse('2023-08-25')->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Address:</b> {{ $student->current_address  ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            <h5 class="text-center">Exam Results</h5>
            <table class="table exam-table">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Subject</th>
                        <th>Full Marks</th>
                        <th>Obtained Marks</th>
                        <th>Grade</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="footer">
                <p class="text-success">Congratulations on Your Performance!</p>
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
