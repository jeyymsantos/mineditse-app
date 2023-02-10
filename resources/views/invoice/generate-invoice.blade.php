<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice for {{ $order->name }} | {{ $order->order_id }}</title>
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
                    <h2 class="text-center">Customer's Invoice</h2>
                </td>
            </tr>
            <tr>
                <th width="50%" colspan="2">
                    <h1 class="text-start">MINE DITSE</h1>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>INVOICE ID: <b>ORD-0{{ $order->order_id }}-0{{ $order->cust_id }}</b></span> <br>
                    <span>{{ $datetime->toDateTimeString() }} </span> <br>
                    <span>Mine Ditse Shop, Brgy. Sto. Cristo, <br>Baliuag, Bulacan, Philippines</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">INVOICE DETAILS</th>
                <th width="50%" colspan="2">CUSTOMER DETAILS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Invoice ID:</td>
                <td>ORD-0{{ $order->order_id }}-0{{ $order->cust_id }}</td>

                <td>Full Name:</td>
                <td>{{ $order->name }}</td>
            </tr>
            <tr>
                <td>Invoice Date:</td>
                <td>{{ $order->order_date }}</td>

                <td>Email Address:</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td>Payment Method:</td>
                <td>{{ $order->order_method }}</td>

                <td>Phone:</td>
                <td>{{ $order->phone_number }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>{{ $order->order_status }}</td>

                <td>Address:</td>
                <td>{{ $order->cust_street . ', ' . $order->cust_barangay . ', ' . $order->cust_city . ', ' . $order->cust_province }}
                </td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    ORDER ITEMS
                </th>
            </tr>
            <tr class="bg-blue">
                <th>#</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
                <tr>
                    <td width="10%">{{ $i++ }}</td>
                    <td>
                        {{ $cart->prod_name }}
                    </td>
                    <td width="10%"><span style="font-family: DejaVu Sans; sans-serif;">₱</span>{{ $cart->prod_price }}</td>
                    <td width="10%">1</td>
                    <td width="15%" class="fw-bold">
                        <span style="font-family: DejaVu Sans; sans-serif;">₱</span>{{ $cart->prod_price }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4">Subtotal:</td>
                <td colspan="1">
                    <span style="font-family: DejaVu Sans; sans-serif;">₱</span>
                    {{ $order->order_total }}</td>
            </tr>

            <tr>
                <td colspan="4">Shipping Fee:</td>
                <td colspan="1">
                    <span style="font-family: DejaVu Sans; sans-serif;">₱</span>{{ $order->order_shipping_fee }}</td>
            </tr>

            <tr>
                <td colspan="4" class="total-heading">Total Amount:</td>
                <td colspan="1" class="total-heading"><span style="font-family: DejaVu Sans; sans-serif;">₱</span>{{ number_format($order->order_shipping_fee+$order->order_total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        © Copyright Mine Ditse. All Rights Reserved
    </p>

</body>

</html>
