<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Supplier Billing Invoice </title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
    <style>
       * {font-family: 'Roboto', sans-serif;line-height: 26px;font-size: 15px}
    .custom--table {width: 100%;color: inherit;vertical-align: top;font-weight: 400;border-collapse: collapse;border-bottom: 2px dashed  #ddd;margin-top: 0;}
    .table-title{font-size: 18px;font-weight: 600;line-height: 32px;margin-bottom: 10px}
    .custom--table thead {font-weight: 700;background: inherit;color: inherit;font-size: 16px;font-weight: 500}
    .custom--table tbody {border-top: 0;overflow: hidden;border-radius: 10px;}
    .custom--table thead tr {border-top: 2px dashed  #ddd;border-bottom: 2px dashed  #ddd;text-align: left}
    .custom--table thead tr th {border-top: 2px dashed  #ddd;border-bottom: 2px dashed  #ddd;text-align: left;font-size: 16px;padding: 10px 0}
    .custom--table tbody tr {vertical-align: top;}
    .custom--table tbody tr td {font-size: 14px;line-height: 18px vertical-align:top 10}
    .custom--table tbody tr td:last-child{padding-bottom: 10px;}
    .custom--table tbody tr td .data-span {font-size: 14px;font-weight: 500;line-height: 18px;}
    .custom--table tbody .table_footer_row {border-top: 2px dashed  #ddd;margin-bottom: 10px !important;padding-bottom: 10px !important}
    /* invoice area */
    .invoice-area {padding: 10px 0}
    .invoice-wrapper {max-width: 650px;margin: 0 auto;box-shadow: 0 0 10px #f3f3f3;padding: 0px;}
    .invoice-header {margin-bottom: 40px;}
    .invoice-flex-contents {display: flex;align-items: center;justify-content: space-between;gap: 24px;flex-wrap: wrap;}
    .invoice-title {font-size: 25px;font-weight: 700}
    .invoice-details {margin-top: 20px}
    .invoice-details-flex {display: flex;align-items: flex-start;justify-content: space-between;gap: 24px;flex-wrap: wrap;}
    .invoice-details-title {font-size: 18px;font-weight: 700;line-height: 32px;color: #333;margin: 0;padding: 0}
    .invoice-single-details {padding:10px}
    .details-list {margin: 0;padding: 0;list-style: none;margin-top: 10px;}
    .details-list .list {font-size: 14px;font-weight: 400;line-height: 18px;color: #666;margin: 0;padding: 0;transition: all .3s;}
    .details-list .list strong {font-size: 14px;font-weight: 500;line-height: 18px;color: #666;margin: 0;padding: 0;transition: all .3s}
    .details-list .list a {display: inline-block;color: #666;transition: all .3s;text-decoration: none;margin: 0;line-height: 18px}
    .item-description {margin-top: 10px;padding:10px;}
    .products-item {text-align: left}
    .invoice-total-count .list-single {display: flex;align-items: center;gap: 30px;font-size: 16px;line-height: 28px}
    .invoice-subtotal {border-bottom: 2px dashed  #ddd;padding-bottom: 15px}
    .invoice-total {padding-top: 10px}
    .invoice-flex-footer {display: flex;align-items: flex-start;justify-content: space-between;flex-wrap: wrap;gap: 30px;}
    .single-footer-item {flex: 1}
    .single-footer {display: flex;align-items: center;gap: 10px}
    .single-footer .icon {display: flex;align-items: center;justify-content: center;height: 30px;width: 30px;font-size: 16px;background-color: #000e8f;color: #fff}
    </style>
</head>
<body>
<!-- Invoice area Starts -->
<div class="invoice-area">
    <div class="invoice-wrapper">
        <div class="invoice-header">
            <h1 class="invoice-title" style="text-align:center;">Invoice - {{$site_details->app_name ?? ''}}</h1>
        </div>
        <div class="invoice-details">
            <div class="invoice-details-flex">
                <div class="invoice-single-details">
                    <h2 class="invoice-details-title">Bill To:</h2>
                    <ul class="details-list">
                        <li class="list">{{$data->supplier->fullname}}</li>
                        <li class="list"> <a href="#">{{$data->supplier->email_address}} </a> </li>
                        <li class="list"> <a href="#">{{$data->supplier->phone_number}}</a> </li>
                    </ul>
                </div>
                <div class="invoice-single-details">
                    <h4 class="invoice-details-title">Ship To:</h4>
                    <ul class="details-list">
                        <li class="list"> <strong>City: </strong>{{$data->supplier->city}}</li>
                        <li class="list"> <strong>Area: </strong>{{$data->supplier->state}}</li>
                        <li class="list"> <strong>Address: </strong>{{$data->supplier->address}}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="item-description">

            <table class="custom--table">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($data->items as $item)
                    <tr>
                        <td>
                          @php
                            $title = strlen($item->product->title) > 50 ? substr($item->product->title, 0, 50) . '...' : $item->product->title;
                          @endphp
                          {{ $title }}
                        </td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->product->p_price }}</td>
                        <td>{{ $item->product->p_price * $item->qty }}</td>
                    </tr>
                    @endforeach
                    <tr class="table_footer_row">
                        <td colspan="3"><strong>Total Amount</strong></td>
                        <td><strong>{{ isset($data->total_amount) ? intval($data->total_amount) : 00 }}</strong></td>
                    </tr>
                    <tr class="table_footer_row">
                        <td colspan="3"><strong>Paid Amount</strong></td>
                        <td><strong>{{ isset($data->paid_amount) ? intval($data->paid_amount) : 00 }}</strong></td>
                    </tr>
                    <tr class="table_footer_row">
                        <td colspan="3"><strong>Due Amount</strong></td>
                        <td><strong>{{ isset($data->due_amount) ? intval($data->due_amount)  : 00 }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>

</html>
