
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
            width: 60.452mm;
            height:  93.856mm;

            background: url('https://rzasc.com/uploads/certificate/Untitled-1_(1).png') no-repeat center center/cover;
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
            width: 125px;
            height: 123px;
            border-radius: 50%;
            overflow: hidden;
            margin: 15px auto;
            /* border: 3px solid #fff; */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 81px;
            margin-left: 4px;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info {
            font-size: 12px;
            color: #000;
            border-radius: 6px;
            line-height: 1.3;
            text-align: left;
            margin-left: 47px;
            padding: 5px;
        }

        .info p {
            margin: 5px 0;
        }

    </style>
  </head>
  <body>
    <div id="wrapp">
        @foreach ($students as $item)
            <div class="id-card" >
                <div class="photo">
                    <img src="{{ asset(!empty($item->photo) ? 'uploads/photos/'.$item->photo : 'uploads/photos/avatar.png') }}" alt="image">

                </div>
                <div class="info" style="margin-top: 5px; ">
                    <p><strong>Name:</strong> {{ $item->name }}</p>
                    <p><strong>F. Name:</strong> {{ $item->father_name }}</p>
                    <p><strong>M. Name:</strong> {{ $item->mother_name }}</p>
                    <p style="color: red;"><strong>Blood Group:</strong> {{ $item->blood_group }}</p>
                    <p><strong>Mobile:</strong> <span style="color: red;">{{ $item->phone }}</span></p>
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
