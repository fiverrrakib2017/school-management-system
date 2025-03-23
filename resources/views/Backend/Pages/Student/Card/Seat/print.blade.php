
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
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        .seat-plan {
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 40px auto;
            max-width: 900px;
            border-radius: 10px;
            border: 1px solid #007bff;
        }

        .seat-plan h3 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 1.2rem;
        }

        .student-photo img {
            width: 120px;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #007bff;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .info-table td {
            padding: 8px;
            font-size: 14px;
        }

        .info-table b {
            color: #007bff;
        }

        .row {
            margin-top: 30px;
        }

        .seat {
            background-color: #f8f9fa;
            border: 1px solid #007bff;
            border-radius: 5px;
            padding: 10px;
            margin: 5px;
            text-align: center;
            width: 120px;
            height: 120px;
        }

        .seat-assigned {
            background-color: #28a745;
            color: white;
        }

        .seat .seat-number {
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>

<section>
    <div class="container">
        <div class="seat-plan">
            <h3>Exam Seat Plan</h3>
            <div class="row justify-content-center">
                <!-- Seat row 1 -->
                <div class="col-md-2">
                    <div class="seat seat-assigned">
                        <div class="seat-number">A1</div>
                        <p>John Doe</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="seat">
                        <div class="seat-number">A2</div>
                        <p>Jane Smith</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="seat seat-assigned">
                        <div class="seat-number">A3</div>
                        <p>Michael Brown</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="seat">
                        <div class="seat-number">A4</div>
                        <p>Emma Wilson</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Seat row 2 -->
                <div class="col-md-2">
                    <div class="seat seat-assigned">
                        <div class="seat-number">B1</div>
                        <p>Robert White</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="seat">
                        <div class="seat-number">B2</div>
                        <p>Olivia Harris</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="seat seat-assigned">
                        <div class="seat-number">B3</div>
                        <p>David Lee</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="seat">
                        <div class="seat-number">B4</div>
                        <p>Chloe Clark</p>
                    </div>
                </div>
            </div>

            <!-- More seat rows can be added similarly -->

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

