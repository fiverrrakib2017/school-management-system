@php
    $website_info = App\Models\Website_information::first();
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admit Card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        @media print {
    /* .container {
        display: flex;
        flex-wrap: wrap;
    } */
    .admit-card {


        page-break-inside: avoid;
    }
}


        .admit-card {
            background-color: #fff;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px dotted #c9c9c9;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px dotted #cfcfcf;
            padding-bottom: 10px;
        }

        .logo img,
        .photo img {
            height: 50px;
            width: auto;
            object-fit: contain;
        }

        .school-info {
            text-align: center;
            flex: 1;
        }

        .school-info h2 {
            margin: 0;
            font-size: 16px;
        }

        .school-info p {
            margin: 2px 0;
            font-size: 10px;
        }

        .admit-title {
            text-align: center;
            background-color: #2c3e50;
            color: white;
            padding: 4px;
            font-size: 14px;
            margin-top: 10px;
        }

        .info-table {
            width: 100%;
            margin-top: 10px;
            font-size: 12px;
        }

        .info-table td {
            padding: 2px 0;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 10px;
        }

        .signature-box {
            width: 45%;
            text-align: center;
        }

        .signature-box hr {
            margin-bottom: 3px;
        }

        .footer-note {
            text-align: center;
            font-size: 10px;
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
   <div class="container">
    <div class="row">
        @foreach ($students  as $student)


        <div class="col-xl-9 ">
            <div class="admit-card">
                <div class="header">
                    <div class="logo">
                        <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}" alt="School Logo">
                    </div>
                    <div class="school-info">
                        <h2>{{ $website_info->name }}</h2>
                        <p>{{ $website_info->address ?? 'School Address' }}</p>
                        <p>{{ $exam->name ?? 'N/A' }} - {{ $exam->year ?? '2025' }}</p>
                    </div>
                    <div class="photo">
                        <img src="{{ asset(!empty($student->photo) ? 'uploads/photos/' . $student->photo : 'uploads/photos/avatar.png') }}" alt="Student Photo">
                    </div>
                </div>

                <div class="admit-title">Admit Card</div>

                <table class="info-table">
                    <tr>
                        <td><strong>Name:</strong> {{ $student->name ?? 'N/A' }}</td>
                        <td><strong>ID:</strong>{{ $student->id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Roll:</strong>{{ $student->roll_no ?? 'N/A' }}</td>
                        <td><strong>Class:</strong> {{ $student->currentClass->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Group:</strong>{{ $student->section->name ?? 'N/A' }} </td>
                        <td><strong>Exam:</strong>{{ $exam->name ?? 'N/A' }} </td>
                    </tr>
                </table>

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
        </div>

       @endforeach

    </div>
   </div>
    <script>
        window.addEventListener("load", function () {
            window.print();
        });
    </script>
</body>
</html>



