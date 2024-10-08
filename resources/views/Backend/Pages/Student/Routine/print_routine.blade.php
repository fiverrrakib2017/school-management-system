<!DOCTYPE html>
<html>
<head>
    <title>Print Class Routine</title>
    <style>
        /* Add some styles to format the print page */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Class Routine </h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1
            @endphp
            @foreach($routines as $routine)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $routine->subject->name }}</td>
                    <td>{{ $routine->teacher->name }}</td>
                    <td>11.30 Am</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
