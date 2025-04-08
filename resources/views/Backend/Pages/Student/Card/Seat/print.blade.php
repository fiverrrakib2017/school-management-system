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
    <title>Student Seat Plan</title>
    <style>
        @media print {
    .row-container {
        display: flex;
        flex-wrap: wrap;
    }
    .seat-card {
        flex: 1 1 28%;
        min-width: 48%;
        page-break-inside: avoid;
    }
}

        body {
            background-color: #f9f9f9;
            font-family: Arial, serif;

            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .seat-card {
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 10px;
            margin: 10px;
            text-align: left;
            border: 2px dotted #d7d7d7;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            min-width: 480px !important;
        }
        .student-info {
            display: flex;
        }
        .student-photo img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 2px solid #ddd;
        }
        .info-table td {
            padding: 6px;
            border: 1px solid #ddd;
            font-size: 12px;
        }
        .school-header {
            text-align: center;
            padding: 15px;
        }
        .school-header img {
            height: 80px;
            width: 80px;
            /* margin-bottom: 10px; */
        }
        .school-header h2 {
            font-weight: 600;
            margin-bottom: 5px;
        }
        .school-header p {
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }
        .row-container {
            display: flex;
            flex-wrap: wrap;
        }
        .table{
            width: 100%;
            margin-bottom: 0px !important;
        }
        .seat-card h3 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 10px;
            color: rgb(0, 0, 0);
            font-family: serif;
        }
    </style>
</head>
<body>
    <section>
        <div class="container">
            <div class="row-container">
                @foreach ($classes as $item)
                <div class="seat-card">
                    <img height="70px" width="80px" src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}" alt="School Logo" style="display: block; margin: 0 auto;">
                    <h3 class="text-center text-mute">{{ $website_info->name ?? 'Future ICT School' }}</h3>
                    <h3 class="text-center  text-mute">{{ $website_info->address ?? 'Gouripur,Daudknadi,cumilla' }}</h3>
                    <h3 class=" text-mute">{{ $exam->name }} - {{ $exam->year }}</h3>
                    <h3 style="border: 1px solid; width:100px;display: block; margin: 0 auto; border-bottom:5px;">Seat Plan</h3>
                    <div class="student-info">
                        <div class="student-photo">
                            <img src="{{ asset(!empty($item->photo) ? 'uploads/photos/'.$item->photo : 'uploads/photos/avatar.png') }}" alt="image">
                        </div>
                        <table class="table info-table" >
                            <tr>
                                <td><b>Name:</b> {{ $item->name ?? '' }}</td>
                                <td><b>Gender:</b> {{ $item->gender ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Class:</b> {{ $item->currentClass->name ?? '' }}</td>
                                <td><b>Section:</b> {{ $item->section->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Roll:</b> {{ $item->roll_no ?? '' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endforeach
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
    $website_info=App\Models\Website_information::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exam Seat Plan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 10px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .seat-card {
            border: 2px dotted #c7c7c7;
            padding: 10px;
            width: 480px;
            margin: 10px;
            page-break-inside: avoid;
        }

        .header {
            text-align: center;
            position: relative;
            margin-bottom: 10px;
        }

        .header img {
            height: 60px;
            position: absolute;
            left: 10px;
            top: 0;
        }

        .school-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .seat-plan-title {
            display: inline-block;
            border: 1px solid #000;
            padding: 2px 8px;
            font-size: 14px;
            margin-top: 5px;
        }

        .student-details {
            display: flex;
            justify-content: space-between;
        }

        .details-left {
            flex: 1;
            font-size: 14px;
        }

        .details-left b {
            color: black;
        }

        .photo {
            width: 100px;
            /* height: 100px; */
            /* border: 1px solid #000; */
            object-fit: cover;
            margin-left: 10px;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 12px;
        }

        .signature-line {
            border-top: 2px dotted #b9b9b9;
            width: 200px;
            text-align: center;
            padding-top: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        @foreach($classes as $item)
        <div class="seat-card">
            <div class="header">
                <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}" alt="Logo">
                <div class="school-name">{{ $website_info->name ?? 'Ramnagor Z.A. School & College' }}</div>
                <div class="seat-plan-title">Exam Seat Plan</div>
            </div>

            <div class="student-details">
                <div class="details-left">
                    <p><b>Name:</b> {{ $item->name ?? '' }}</p>
                    <p><b>Class:</b> {{ $item->currentClass->name ?? '' }}</p>
                    <p><b>Exam:</b> {{ $exam->name }}-{{ $exam->year }}</p>
                    <p><b>Group:</b> {{ $item->section->name ?? '' }}</p>
                    <p><b>Roll:</b> {{ $item->roll_no ?? '' }}</p>
                </div>
                <div>
                    <img src="{{ asset(!empty($item->photo) ? 'uploads/photos/'.$item->photo : 'uploads/photos/avatar.png') }}" class="photo" alt="Student">
                </div>
            </div>

            <div class="signatures">
                <div class="signature-line">Signature of class teacher</div>
                <div class="signature-line">Head Teacher signature</div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>

 <script>
        window.addEventListener("load", function() {
            window.print();
        });
         // Disable right-click
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // Disable specific keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // F12
        if (e.key === "F12") {
            e.preventDefault();
        }
        // Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+Shift+C
        if (e.ctrlKey && e.shiftKey && (e.key === "I" || e.key === "J" || e.key === "C")) {
            e.preventDefault();
        }
        // Ctrl+U
        if (e.ctrlKey && e.key === "u") {
            e.preventDefault();
        }
        // Ctrl+S (to prevent saving)
        if (e.ctrlKey && e.key === "s") {
            e.preventDefault();
        }
        // Ctrl+Shift+K (Firefox devtools)
        if (e.ctrlKey && e.shiftKey && e.key === "K") {
            e.preventDefault();
        }
    });
    </script>

