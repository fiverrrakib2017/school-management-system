

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
        @foreach($students as $item)
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

