
@php
$website_info = App\Models\Website_information::first();
@endphp
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
 <title>Student Admit Card Print</title>
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

        .header {
            page-break-inside: avoid;
        }
    }


    .admit-card {
        background-color: #fff;
        margin-bottom: 20px;
        padding: 15px;
        border: 6px dotted #c9c9c9;
        box-sizing: border-box;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* border-bottom: 2px dotted #333; */
        /*padding-bottom: 15px;*/
        /* margin-bottom: 25px; */
    }

    .logo img {
        height: 130px;
        width: auto;
    }




    .school-info {
        text-align: center;
        flex: 1;
    }


    .school-info h2 {
        margin: 0;
        font-size: 28px;
        font-weight: bold;
        color: #0070e1;
    }


    .school-info p {
        margin: 4px 0;
        font-size: 21px;
        color: #000000;
    }

    .photo img {
        height: 130px;
        /* width: 90px; */
        object-fit: cover;
    }

    .admit-title {
        text-align: center;
        background-color: #e39912;
        color: #fffafa;
        padding: 4px;
        font-size: 23px;
        font-family: serif;
        font-weight: bold;
        width: 203px;
        margin: auto;
    }

    .info-table {
        width: 100%;
        margin-top: 10px;
        font-size: 20px;
        margin-top: 18px;
        font-family: serif;
        font-weight: bold;
    }

    .info-table td {
        padding: 5px 0;
    }

    .signatures {
        display: flex;
        justify-content: space-between;
        margin-top: 25px;
        font-size: 20px;
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
        font-size: 15px;
        color: red;
        margin-top: 17px;
    }
</style>
</head>

<body>
<div class="container">
    <div class="row">
        @foreach ($students as $student)
            <div class="col-xl-9 ">
                <div class="admit-card">
                    <div class="header">
                        <!-- School Logo -->
                        <div class="logo">
                            <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}"
                                alt="School Logo">
                        </div>

                        <!-- School Info -->
                        <div class="school-info">
                            <h2>{{ $website_info->name ?? 'School Name' }}</h2>
                            <p>{{ $website_info->address ?? 'School Address' }}</p>
                            <p><span>{{ $exam->name ?? 'Exam Name' }}</span> - {{ $exam->year ?? '2025' }}</p>
                        </div>

                        <!-- Student Photo -->
                        <div class="photo">
                            <img src="{{ asset(!empty($student->photo) ? 'uploads/photos/' . $student->photo : 'uploads/photos/avatar.png') }}"
                                alt="Student Photo">
                        </div>
                    </div>

                    <div class="admit-title">Admit Card</div>

                    <table class="info-table">
                        <tr>
                            <td><strong>Name:</strong> {{ $student->name ?? 'N/A' }}</td>
                            <td><strong>ID:</strong>{{ $student->id ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                             <td><strong>Class:</strong> {{ $student->currentClass->name ?? 'N/A' }}</td>
                            <td><strong>Roll:</strong>{{ $student->roll_no ?? 'N/A' }}</td>

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
    window.addEventListener("load", function() {
        window.print();
    });
    // Disable right-click
// document.addEventListener('contextmenu', function(e) {
//     e.preventDefault();
// });

// // Disable specific keyboard shortcuts
// document.addEventListener('keydown', function(e) {
//     // F12
//     if (e.key === "F12") {
//         e.preventDefault();
//     }
//     // Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+Shift+C
//     if (e.ctrlKey && e.shiftKey && (e.key === "I" || e.key === "J" || e.key === "C")) {
//         e.preventDefault();
//     }
//     // Ctrl+U
//     if (e.ctrlKey && e.key === "u") {
//         e.preventDefault();
//     }
//     // Ctrl+S (to prevent saving)
//     if (e.ctrlKey && e.key === "s") {
//         e.preventDefault();
//     }
//     // Ctrl+Shift+K (Firefox devtools)
//     if (e.ctrlKey && e.shiftKey && e.key === "K") {
//         e.preventDefault();
//     }
// });
</script>
</body>

</html>
