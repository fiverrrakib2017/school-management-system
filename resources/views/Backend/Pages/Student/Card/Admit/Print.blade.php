{{--

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
                        <h4 class="text-danger font-weight-bold">Admit Card</h4>
                        <h5 class="mb-0">{{ $exam->name }} - {{ $exam->year }}</h5>
                    </div>
                </div>

                <div class="student-info">
                    <div class="student-photo">
                        <img src="{{ asset(!empty($student->photo) ? 'uploads/photos/'.$student->photo : 'uploads/photos/avatar.png') }}" alt="image">
                    </div>
                    <table class="table info-table">
                        <tr>
                            <td><b>Student Name:</b> {{ $student->name }}</td>
                            <td><b>Gender:</b> {{ $student->gender }}</td>
                        </tr>
                        <tr>
                            <td><b>Class:</b> {{ $student->currentClass->name }}</td>
                            <td><b>Section:</b> {{ $student->section->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Father's Name:</b> {{ $student->father_name }}</td>
                            <td><b>DOB:</b> {{ \Carbon\Carbon::parse($student->birth_date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Address:</b> {{ $student->current_address }}</td>
                        </tr>
                    </table>
                </div>
                <h5 class="text-center ">Exam Schedule</h5>
                <table class="table exam-table">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Subject</th>
                            <th>Exam Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Invigilator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $routine=App\Models\Student_exam_routine::where('exam_id',$exam_id)->where('class_id',$student->current_class)->get();
                            $numer=1;
                        @endphp
                        @foreach ($routine as $item)
                        <tr>
                            <td>{{ $numer++ }}</td>
                            <td>{{ $item->subject->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->exam_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</td>
                            <td>{{ $item->invigilator }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="footer">
                    <p class="text-success">Best of Luck for Your Exam!</p>
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
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admit Card</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            padding: 30px;
        }

        .admit-card {
            background-color: #fff;
            width: 850px;
            margin: auto;
            padding: 30px;
            border: 1px solid #000;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px dotted #cfcfcf;
            padding-bottom: 10px;
        }

        .logo img, .photo img {
            height: 100px;
            width: auto;
            object-fit: contain;
        }

        .school-info {
            text-align: center;
            flex: 1;
        }

        .school-info h2 {
            margin: 0;
            font-size: 26px;
        }

        .school-info p {
            margin: 2px 0;
            font-size: 14px;
        }

        .admit-title {
            text-align: center;
            background-color: #2c3e50;
            color: white;
            padding: 6px;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            letter-spacing: 1px;
        }

        .student-section {
            margin-top: 20px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .info-table td {
            padding: 8px;
            font-size: 16px;
            vertical-align: top;
        }

        .info-table td strong {
            width: 120px;
            display: inline-block;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .signature-box {
            width: 40%;
            text-align: center;
            font-size: 14px;
        }

        .signature-box hr {
            width: 80%;
            margin-bottom: 5px;
        }

        .footer-note {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="admit-card">
    <div class="header">
        <div class="logo">
            <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}" alt="School Logo">
        </div>

        <div class="school-info">
            <h2>{{ $website_info->name }}</h2>
            <p>{{ $website_info->address ?? 'School Address ' }}</p>
            <p>{{ $exam->name ?? 'N/A' }}-{{ $exam->year ?? '2025' }}</p>
        </div>

        <div class="photo">
            <img src="{{ asset(!empty($student->photo) ? 'uploads/photos/'.$student->photo : 'uploads/photos/avatar.png') }}" alt="Student Photo">
        </div>
    </div>

    <div class="admit-title">Admit Card</div>

    <div class="student-section">
        <table class="info-table">
            <tr>
                <td><strong>Name:</strong> {{ $student->name ?? 'N/A'}}</td>
                <td><strong>ID:</strong> {{ $student->id ?? 'N/A'}}</td>
            </tr>
            <tr>
                <td><strong>Roll:</strong> {{ $student->roll_no ?? 'N/A' }}</td>
                <td><strong>Class:</strong> {{ $student->currentClass->name ?? 'N/A'}}</td>
            </tr>
            <tr>
                <td><strong>Group:</strong> {{ $student->section->name }}</td>
                <td><strong>Exam:</strong> {{ $exam->name ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div class="signatures">
        <div class="signature-box">
            <hr>
            Controller of Exam
        </div>
        <div class="signature-box">
            <hr>
            Head Teacher
        </div>
    </div>

    <div class="footer-note">
        No Entrance to The Exam Hall Without Admit Card
    </div>
</div>
<script>
    window.addEventListener("load", function() {
        window.print();
    });
</script>
</body>
</html>

