<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('resources/assets/img/logo.png') }}" rel="icon">
    <title>HostMgr :: Invoice</title>
    <style type="text/css">
        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            line-height: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        /* heading */

        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        th,
        td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        th,
        td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #EEE;
            border-color: #BBB;
        }

        td {
            border-color: #DDD;
        }

        /* page */

        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
        }

        html {
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            height: 11in;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
            width: 7.5in;
        }

        body {
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }

        /* header */

        header {
            width: 7.5in;
            margin: 0 0 3em;
        }

        header:after {
            clear: both;
            content: "";
            display: table;
        }

        header h1 {
            background: #000;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        header address {
            float: left;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }

        header address p {
            margin: 0 0 0.25em;
        }

        header img {
            display: block;
            float: right;
        }

        /* header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        } */



        /* article */

        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 3em;
            color: #000;
        }

        .article-first {
            margin-bottom: 0px !important;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        .customer-info {
            margin-top: 10px;
        }

        .address,
        .email {
            font-size: 65% !important;
            font-weight: normal !important;
        }

        /* table meta & balance */

        table.meta,
        table.balance {
            float: right;
            width: 36%;
        }

        table.meta:after,
        table.balance:after {
            clear: both;
            content: "";
            display: table;
        }

        /* table meta */

        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }

        /* table items */

        table.inventory {
            clear: both;
            width: 100%;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        table.inventory td:nth-child(1) {
            width: 10%;
        }

        table.inventory td:nth-child(2) {
            width: 30%;
        }

        table.inventory td:nth-child(3) {
            text-align: right;
            width: 20%;
        }

        table.inventory td:nth-child(4) {
            text-align: right;
            width: 20%;
        }

        table.inventory td:nth-child(5) {
            text-align: right;
            width: 20%;
        }

        /* table balance */

        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        /* aside */
        aside {
            margin-bottom: 30px;
            color: #000;
        }

        aside h1 {
            border: none;
            border-width: 0 0 1px;
            margin: 0 0 1em;
        }

        aside h1 {
            border-color: #999;
            border-bottom-style: solid;
        }

        @page {
            margin: 0;
        }

        .payment {
            color: #000;
        }

        .payment>p {
            margin-bottom: 5px;
        }

        .payment>.payment-option {
            margin-bottom: 3px;
        }

        .payment>.payment-option>p {
            font-size: 14px;
            margin-bottom: 2px;
        }


        footer {
            position: fixed;
            bottom: 50px;
            width: 100%;
            color: #000;
        }

        footer hr {
            border: 0.55px solid #000;
            margin-bottom: 5px;
        }

        footer>p {
            font-size: 75%;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <h1>Invoice</h1>
        <address style="color: #000">
            <p>CodeRiver Applications</p>
            <p>2<sup>nd</sup> Floor, Shaj Bhaban</p>
            <p>73, Bijoynagar, Dhaka.</p>
            <a href="www.coderiverbd.com" target="_blank" style="color: blue">www.coderiverbd.com</a>
        </address>

        <img style="width: 200px; height: 60px" alt="Host Manager Invoice Logo" src="{{ asset('resources/assets/img/log-extended.png') }}">
    </header>

    <article class="article-first">
        <address style="color: #000">
            <p style="margin-bottom: 5px;">To,</p>
            @if($customer->customer_type === 'individual')
            <p>{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}</p>
            @endif
            @if($customer->customer_type === 'company')
            <p>{{ $customer->company_name }}</p>
            @endif
            <div class="customer-info">
                <p class="address">{{ $customer->customer_address }}</p>
                <p class="email">{{ $user->email }}</p>
            </div>
        </address>

        <table class="meta">
            <tr>
                <th><span>Sl. No.</span></th>
                <td><span>{{ $invoice->invoice_serial }}</span></td>
            </tr>
            <tr>
                <th><span>Invoice No.</span></th>
                <td><span>{{ $invoice->invoice_number }}</span></td>
            </tr>
            <tr>
                <th><span>Date</span></th>
                <td><span>{{ date_format( date_create($invoice->payment_date), 'd-m-Y') }}</span></td>
            </tr>
        </table>
    </article>

    <aside>
        <div>
            <p>Dear Client,</p>
        </div>
        <div>
            <p>Thanks for your purchase. Kindly make the payment for the following services {{ $service->domain_name }} </p>
        </div>
    </aside>

    <article>
        <table class="inventory">
            <thead>
                <tr>
                    <th><span>Sl. No.</span></th>
                    <th><span>Service</span></th>
                    <th><span>Fee (BDT)</span></th>
                    <th><span>Discount (BDT)</span></th>
                    <th><span>Price (BDT)</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoiceItems as $invoiceItem)
                <tr>
                    <td class="text-center"><span>{{ $loop->iteration }}</span></td>
                    <td>
                        @if($invoiceItem->service_type_id === 1)
                        <span>{{ 'Domain' }}</span>
                        @endif
                        @if($invoiceItem->service_type_id === 2)
                        <span>{{ 'Hosting' }}</span>
                        @endif
                        @if($invoiceItem->service_type_id === 3)
                        <span>{{ 'Others' }}</span>
                        @endif
                    </td>
                    <td><span> {{ $invoiceItem->invoice_item_subtotal }}</span></td>
                    <td><span> {{ $invoiceItem->invoice_item_discount }}</span></td>
                    <td><span> {{ $invoiceItem->invoice_item_total }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="balance">
            <tr>
                <th><span>Total</span></th>
                <td><span> {{ $invoice->invoice_gross_total }}</span></td>
            </tr>
            <tr>
                <th><span>Discount</span></th>
                <td><span> {{ $invoice->invoice_discount }}</span></td>
            </tr>
            <tr>
                <th><span>Gross Total</span></th>
                <td><span>{{ $invoice->invoice_total }}</span></td>
            </tr>
        </table>
    </article>
    <section class="payment">
        <p>Payment Options:</p>
        <div class="payment-option">
            <p>1. Bank Account</p>
            <p style="margin-left: 15px;"><i>Account Name:</i> Jamiul Hasan</p>
            <p style="margin-left: 15px;"><i>Account Number:</i> 108.101.154130</p>
            <p style="margin-left: 15px;">Dutch-Bangla Bank Limited</p>
            <p style="margin-left: 15px;">Shantinagar, Dhaka.</p>
        </div>

        <div class="payment-option" style="margin-top: 5px;">
            <p>2. Bkash/Rocket/Nagad</p>
            <p style="margin-left: 15px;">01710826403</p>
        </div>
    </section>
    <footer>
        <hr />
        <p>Thanks for stay with us.</p>
    </footer>
</body>

</html>