{{-- <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <title>Student ID Card Generate</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Wrapper to center the id-cards */
        #wrapp {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            background-color: #f4f4f4;
        }
        .id-card {
             width:  84mm;
            height:  52mm;
            background: url({{ asset('/Backend/images/id_card.png') }}) no-repeat center center/cover;

            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 20px;
            position: relative;
            background-color: white;

        }
        .photo {
            width: 190px;
            height: 192px;
            border-radius: 50%;
            overflow: hidden;
            margin: 20px auto;
            border: 3px solid #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 7px;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .info {
            color: #333;
            /* font-size: 20px; */
            margin-top: -16px;
            font-family: arial-black;
            color: slategrey;
            font-size: inherit;
        }
        /* .info h2 {
            font-size: 22px;
            margin: 10px 0;
            color: #0056b3;
        } */
        .info h2 {
            font-size: 33px;
            font-weight: 600;
            margin: 10px 0;
            color: #06b9b9;
            font-family: serif;
        }
        .info p {
            margin: 5px 0;
            font-weight: bold;
        }


        .school-header {
           font-size: 12px;
        }

        #wrapp {
            display: flex;
            justify-content: center;
            align-items: center;
           width: 1200px;
            background-color: #f4f4f4;
        }
    </style>
  </head>
  <body>
    <div id="wrapp">
        <div class="id-card" id="idCard">
            <div class="school-header">
                <h1 style="color: #f4f8f8;">Future ict school</h1>
                <p style="color: #f4f8f8;">
                    <i class="fa fa-map-marker"></i> 123, School Road, Dhaka, Bangladesh
                </p>
                <hr style="border: 1px dotted #b9b9b9;">
            </div>
            <div class="photo">
                <img src="https://images.mid-day.com/images/images/2023/jan/sunielshettyresized_d.jpg" alt="Rakib Mahmud">
            </div>
            <div class="info">
                <h2>Rakib Mahmud</h2>
                <p>Class: 10</p>
                <p>Section: Default</p>
                <p>Roll: 23</p>
                <p><i class="fa fa-phone"></i> +8801757967432</p>
            </div>

        </div>
        <div class="id-card" id="idCard">
            <div class="school-header">
                <h1 style="color: #f4f8f8;">Future ict school</h1>
                <p style="color: #f4f8f8;">
                    <i class="fa fa-map-marker"></i> 123, School Road, Dhaka, Bangladesh
                </p>
                <hr style="border: 1px dotted #b9b9b9;">
            </div>
            <div class="photo">
                <img src="https://images.mid-day.com/images/images/2023/jan/sunielshettyresized_d.jpg" alt="Rakib Mahmud">
            </div>
            <div class="info">
                <h2>Rakib Mahmud</h2>
                <p>Class: 10</p>
                <p>Section: Default</p>
                <p>Roll: 23</p>
                <p><i class="fa fa-phone"></i> +8801757967432</p>
            </div>

        </div>
        <div class="id-card" id="idCard">
            <div class="school-header">
                <h1 style="color: #f4f8f8;">Future ict school</h1>
                <p style="color: #f4f8f8;">
                    <i class="fa fa-map-marker"></i> 123, School Road, Dhaka, Bangladesh
                </p>
                <hr style="border: 1px dotted #b9b9b9;">
            </div>
            <div class="photo">
                <img src="https://images.mid-day.com/images/images/2023/jan/sunielshettyresized_d.jpg" alt="Rakib Mahmud">
            </div>
            <div class="info">
                <h2>Rakib Mahmud</h2>
                <p>Class: 10</p>
                <p>Section: Default</p>
                <p>Roll: 23</p>
                <p><i class="fa fa-phone"></i> +8801757967432</p>
            </div>

        </div>
    </div>

  </body>
</html>
<script type="text/javascript">
        window.addEventListener("load", function() {
            window.print();
        });
</script> --}}


{{--
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Student ID Card Generate</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Wrapper to center the id-cards */
        #wrapp {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            background-color: #f4f4f4;
            margin-top: 12px;
        }

        /* ID card style */
        .id-card {
            width: 55mm;
            height: 85mm;
            background: url('{{ asset("/Backend/images/id_card.png") }}') no-repeat center center/cover;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 15px;
            position: relative;
            background-color: white;
            margin-bottom: 20px;
            page-break-inside: avoid; /* Avoid page break inside each card */
            page-break-before: always; /* Force page break before each card */
            page-break-after: always; /* Force page break after each card */
        }


        /* School header styling */
        .school-header {
            font-size: 12px;
            color: #fff;
            text-align: center;
        }

        .school-header h1 {
            font-size: 18px;
            color: #ffffff;
            margin: 0;
        }

        .school-header p {
            font-size: 12px;
            margin: 5px 0;
            color: #ffffff;
        }

        .school-header hr {
            border: 1px dotted #b9b9b9;
            margin: 5px 0;
        }

        /* Photo style */
        .photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 10px auto;
            border: 3px solid #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 24px;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Info section style */
        .info {
            color: #333;
            font-family: arial, sans-serif;
            margin-top: 5px;
        }

        .info h2 {
            font-size: 22px;
            font-weight: bold;
            color: #06b9b9;
            margin: 5px 0;
        }

        .info p {
            margin: 5px 0;
            font-weight: bold;
            font-size: 14px;
        }

        .info p i {
            color: #06b9b9;
        }

    </style>
  </head>
  <body>
    <div id="wrapp">

        @for ($i = 1; $i <= 12; $i++)
            <!-- ID Card  -->
            <div class="id-card" >
                <div class="school-header">
                    <h1>Future ICT School</h1>
                    <p><i class="fa fa-map-marker"></i> Gouripur,Daudkandi,cumilla,Bangladesh</p>
                    <hr>
                </div>
                <div class="photo">
                    <img src="https://images.mid-day.com/images/images/2023/jan/sunielshettyresized_d.jpg" alt="Rakib Mahmud">
                </div>
                <div class="info">
                    <h2>Rakib Mahmud Sujon </h2>
                    <p>Class: 10</p>
                    <p>Section: Default</p>
                    <p>Roll: 23</p>
                    <p><i class="fa fa-phone"></i> +8801757967432</p>
                </div>
            </div>
        @endfor


    </div>

    <script type="text/javascript">
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
  </body>
</html> --}}
@php
    $website_info=App\Models\Website_information::first();
@endphp

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student ID Card Generate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        #wrapp {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }
        .id-card {
            /* width: 55mm;
            min-height: 90mm; */

            background: url('{{ asset("/Backend/images/id_card.png") }}') no-repeat center center/cover;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 15px;
            position: relative;
            background-color: white;
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .school-header {
            font-size: 12px;
            color: #fff;
            text-align: center;
        }
        .school-header h1 {
            font-size: 12px;
            color: #ffffff;
            margin: 0;
        }
        .school-header p {
            font-size: 10px;
            margin: 5px 0;
            color: #ffffff;
        }
        .photo {
            width: 131px;
            height: 130px;
            border-radius: 50%;
            overflow: hidden;
            margin: 15px auto;
            border: 3px solid #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 32px;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .info {
            color: #333;
            font-family: serif;
            margin-top: 10px;
        }
        .info h2 {
            font-size: 13px;
            font-weight: bold;
            color: #06b9b9;
            margin: 10px 0 5px;
        }
        .info p {
            margin: 5px 0;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
  </head>
  <body>
    <div id="wrapp">
        @foreach ($classes as $item)
            <div class="id-card" style="width: 60mm; height: 90mm;">
                <div class="school-header">
                    <h1>{{ $website_info->name ?? 'Future ICT School' }}</h1>
                    <p>{{ $website_info->address ?? 'Purnota Plaza,Gouripur,Daudkandi,cumilla,Bangladesh' }}</p>
                </div>
                <div class="photo">
                    <img src="{{ asset(!empty($item->photo) ? 'uploads/photos/'.$item->photo : 'uploads/photos/avatar.png') }}" alt="image">

                </div>
                <div class="info">
                    <h2>{{ $item->name }}</h2>
                    <p>Class: {{ $item->currentClass->name }}</p>
                    <p>Section:  {{ $item->section->name }}</p>
                    <p>Roll: {{ $item->roll_no }}</p>
                    <p>{{ $item->phone }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
  </body>
</html>
