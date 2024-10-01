<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Purchase Invoice</title>
    <!-- <link rel="stylesheet" href="{{asset('Backend/Pdf/assets/css/style.css')}}"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .invoice-container {
            max-width: 700px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .invoice-header,
        .invoice-footer {
            text-align: center;
            margin-bottom: 50px;
        }
        .invoice-header img {
            max-width: 150px;
        }
        .invoice-details,
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-details th,
        .invoice-table th {
            background: #f7f7f7;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .invoice-details td,
        .invoice-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .invoice-table th {
            text-align: left;
        }
        .invoice-summary {
            width: 100%;
            float: right;
            margin-bottom: 50px;
        }
        .invoice-summary th,
        .invoice-summary td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .btn-print,
        .btn-download {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            text-align: center;
        }
        .btn-print {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <img src="http://103.146.16.154/assets/images/it-fast.png" alt="Logo">
            <h2>Billing Invoice</h2>
        </div>
        <table class="invoice-details">
            <tr>
                <th>Bill No:</th>
                <td>{{$data->id}}</td>
                <th>Date:</th>
                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>Student ID:</th>
                <td>{{$data->student->id}}</td>
                <th>Student Name:</th>
                <td>{{$data->student->name}}</td>
            </tr>
            <tr>
                <th>Phone Number:</th>
                <td>{{$data->student->phone}}</td>
                <th>Address:</th>
                <td>{{$data->student->current_address}}</td>
            </tr>
        </table>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Amount</th>
                    <!-- <th class="text-right">Total Amount</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($data->items as $item)
                <tr>
                    <td>{{ $item->fees_type->type_name }}</td>
                    <td>{{ floatval($item->amount) }} ৳</td>
                    <!-- <td class="text-right">{{ floatval($item->amount) }} ৳</td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="invoice-summary">
            <tr>
                <th>Total Amount:</th>
                <td>{{ number_format(floatval($data->total_amount), 0, '.', '') }} ৳</td>
            </tr>
            <tr>
                <th>Paid Amount:</th>
                <td>{{ number_format(floatval($data->paid_amount), 0, '.', '') }} ৳</td>
            </tr>
            <tr>
                <th>Due Amount:</th>
                <td>{{ number_format(floatval($data->due_amount), 0, '.', '') }} ৳</td>
            </tr>
        </table>
        <div class="invoice-footer">
            <p>Prepared By: Rakib Mahmud</p>
            <button onclick="window.print()" class="btn-print">Print</button>
            <button class="btn-download">Download</button>
        </div>
    </div>
</body>
</html> 

