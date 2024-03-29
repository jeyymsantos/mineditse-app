<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice for {{ $order->first_name." ".$order->last_name }} | {{ $order->order_id }}</title>
    <link rel="shortcut icon" href="{{ asset('img/Logo.png') }}" type="image/x-icon">

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>

<body>

    

    <table class="order-details">
        <thead>
            <tr>
                <td colspan="4">
                    <h2 class="text-center">Account Receivables | Pending Payments </h2>
                </td>
            </tr>
            <tr>
                <th width="50%" colspan="2">
                    <h1 class="text-start">MINE DITSE</h1>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>
                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('F d, Y, h:ia') }}
                    </span> <br>
                    <span>Mine Ditse Shop, Brgy. Sto. Cristo, <br>Baliuag, Bulacan, Philippines</span> <br>
                </th>
            </tr>
        </thead>
    </table>

    <table>
        <thead>
            <tr class="bg-blue">
                <th>#</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Order Total</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $cart)
                <tr>
                    <td width="10%">{{ $i++ }}</td>
                    <td>
                        {{-- {{ $cart->prod_name }} --}}
                    </td>
                    <td width="15%"><span style="font-family: DejaVu Sans; sans-serif;">₱ </span>{{ $cart->prod_price }}</td>
                    <td width="10%">1</td>
                    <td width="15%" class="fw-bold">
                        <span style="font-family: DejaVu Sans; sans-serif;">₱ </span>{{ $cart->prod_price }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4">Subtotal:</td>
                <td colspan="1">
                    <span style="font-family: DejaVu Sans; sans-serif;">₱ </span>{{ $order->order_total }}</td>
            </tr>

            <tr>
                <td colspan="4">Shipping Fee:</td>
                <td colspan="1">
                    <span style="font-family: DejaVu Sans; sans-serif;">₱ </span>{{ $order->order_shipping_fee }}</td>
            </tr>

            <tr>
                <td colspan="4" class="total-heading">Total Amount:</td>
                <td colspan="1" class="total-heading"><span style="font-family: DejaVu Sans; sans-serif;">₱ </span>{{ number_format($order->order_shipping_fee+$order->order_total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        © Copyright Mine Ditse. All Rights Reserved
    </p>

</body>

</html>
