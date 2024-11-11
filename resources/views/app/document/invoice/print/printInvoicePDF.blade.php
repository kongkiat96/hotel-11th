<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบแจ้งหนี้</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            /* font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; */
            font-size: 14px;
            /* color: #697a8d; */
            /* background: #f5f5f9; */
        }

        /* Layout Container */
        .container-xxl {
            width: 100%;
            padding-right: 1rem;
            padding-left: 1rem;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 1400px) {
            .container-xxl {
                max-width: 1320px;
            }
        }

        /* Grid System */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.75rem;
            margin-left: -0.75rem;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-sm-5 {
            flex: 0 0 41.66667%;
            max-width: 41.66667%;
        }

        .col-sm-7 {
            flex: 0 0 58.33333%;
            max-width: 58.33333%;
        }

        .col-md-4 {
            flex: 0 0 33.33333%;
            max-width: 33.33333%;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-md-8 {
            flex: 0 0 66.66667%;
            max-width: 66.66667%;
        }

        .col-xl-9 {
            flex: 0 0 75%;
            max-width: 75%;
        }

        /* Padding & Margin Utilities */
        .p-0 {
            padding: 0 !important;
        }

        .p-2 {
            padding: 0.5rem !important;
        }

        .p-4 {
            padding: 1rem !important;
        }

        .px-4 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .py-5 {
            padding-top: 1.25rem !important;
            padding-bottom: 1.25rem !important;
        }

        .p-sm-3 {
            padding: 1rem !important;
        }

        .m-0 {
            margin: 0 !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .mb-1 {
            margin-bottom: 0.25rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }

        .mb-4 {
            margin-bottom: 1rem !important;
        }

        .mt-2 {
            margin-top: 0.5rem !important;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .mt-5 {
            margin-top: 1.25rem !important;
        }

        .me-1 {
            margin-right: 0.25rem !important;
        }

        /* Card Styles */
        .card {
            background-color: #fff;
            border: 0 solid #d9dee3;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
        }

        .card-body {
            padding: 1.5rem;
        }

        .invoice-preview-card {
            position: relative;
        }

        /* Typography */
        .h4 {
            font-size: 1.25rem;
            font-weight: 500;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        .h6,
        h6 {
            font-size: 0.9375rem;
            font-weight: 500;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }

        .fw-bolder {
            font-weight: 700 !important;
        }

        .text-capitalize {
            text-transform: capitalize !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-end {
            text-align: right !important;
        }

        /* Brand & Logo */
        .app-brand-logo.demo {
            display: flex;
            width: 25px;
            height: 25px;
        }

        .app-brand-text.demo {
            font-size: 1.75rem;
            letter-spacing: -0.5px;
            text-transform: lowercase;
        }

        .svg-illustration {
            align-items: center;
        }

        /* Table Styles */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            /* color: #697a8d; */
            vertical-align: middle;
            border-color: #d9dee3;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.75rem;
            background: #f5f5f9;
            padding: 0.75rem;
        }

        .table td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid #d9dee3;
        }

        .table tbody tr:last-child td {
            border-bottom: 0;
        }

        .border-top {
            border-top: 1px solid #d9dee3 !important;
        }

        /* Divider */
        hr {
            margin: 1rem 0;
            color: inherit;
            border: 0;
            border-top: 1px solid #d9dee3;
            opacity: 0.25;
        }

        hr.my-0 {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        /* Description List */
        dl {
            margin-bottom: 0;
        }

        .dl-horizontal {
            display: flex;
            flex-wrap: wrap;
        }

        dt {
            font-weight: 600;
        }

        dd {
            margin-bottom: 0.5rem;
            margin-left: 0;
        }

        /* Form Elements */
        .form-control {
            display: block;
            width: 100%;
            padding: 0.4375rem 0.875rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1.53;
            color: #697a8d;
            background-color: #fff;
            border: 1px solid #d9dee3;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        /* Bank Logo */
        .bank-logo {
            width: 30px;
            height: 30px;
            object-fit: contain;
            vertical-align: middle;
            margin-right: 0.5rem;
        }

        /* Signature Lines */
        .signature-line {
            position: relative;
            margin-top: 3rem;
        }

        .signature-line::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            border-bottom: 1px solid #d9dee3;
        }

        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .mb-md-0 {
                margin-bottom: 0 !important;
            }

            .justify-content-md-start {
                justify-content: flex-start !important;
            }

            .justify-content-md-end {
                justify-content: flex-end !important;
            }

            .text-md-start {
                text-align: left !important;
            }
        }

        /* Print Styles */
        @media print {
            .card {
                box-shadow: none;
                border: none;
            }

            .table th {
                background-color: #f8f9fa !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        /* Utility Classes for Flex */
        .d-flex {
            display: flex !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .flex-wrap {
            flex-wrap: wrap !important;
        }

        .gap-2 {
            gap: 0.5rem !important;
        }

        /* Additional Text Utilities */
        .text-nowrap {
            white-space: nowrap !important;
        }

        .text-body {
            color: #697a8d !important;
        }

        /* Note Section */
        .note-section {
            font-size: 0.875rem;
            color: #697a8d;
            margin-top: 1.5rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 0.375rem;
        }
    </style>
</head>

<body>
    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
        <div class="card invoice-preview-card">
            <div class="card-body">
                <table class="table mb-0 w-auto">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width: 60%">
                                <h2>ใบแจ้งหนี้ # {{ $dataInvoice->running_number }}</h2>
                                <h5>
                                    <br>
                                    <p class="mb-1">Office 149, 450 South Brand Brooklyn</p>
                                    <p class="mb-1">San Diego County, CA 91905, USA</p>
                                    <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                                </h5>
                            </td>
                            <td style="width: 40%;" class="text-center"><img width="100" height="100"
                                    src="data:image/png;base64,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"
                                    alt="Red dot" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body" style="margin-top: -40px">
                <table class="table w-auto">
                    <tbody>
                        <tr>
                            <td style="font-size: 15px; font-weight: bold; border-bottom: none">ลูกค้า / Customer :</td>
                            <td style="font-size: 15px; font-weight: bold; border-bottom: none">วันที่ / Date :</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">{{ $dataInvoice->customer_name }}</td>
                            <td style="text-align: center">{{ $dateTH['formatted_date'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-size: 15px; font-weight: bold; border-bottom: none">ที่อยู่ /
                                Address :</td>
                        </tr>
                        <tr>
                            <td colspan="2">{{ $dataInvoice->address }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 15px; font-weight: bold; border-bottom: none">ผู้ออก / Issue :</td>
                            <td style="font-size: 15px; font-weight: bold; border-bottom: none">ช่องทางติดต่อ LINE :
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center">{{ $dataInvoice->issuse }}</td>
                            <td style="text-align: center">{{ $dataInvoice->contact }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table border-top m-0">
                    <thead>
                        <tr class="text-center" >
                            <th style="font-weight: bold">ลำดับ</th>
                            <th style="font-weight: bold">ประเภทค่าใช้จ่าย</th>
                            <th style="font-weight: bold">รายการ</th>
                            <th style="font-weight: bold">จำนวน / รายการ</th>
                            <th style="font-weight: bold">จำนวนเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataInvoiceList['data'] as $key => $value)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $value->invoice_list }}</td>
                                <td>{{ $value->detail_list }}</td>
                                <td class="text-center">{{ $value->quantity }}</td>
                                <td class="text-center">{{ $value->amount_total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <table class="table w-auto">
                {{-- <tr>
                    <td width="50%"></td>
                </tr> --}}
                <tr>
                    <td width="50%"></td>
                    <td style="font-size: 15px; font-weight: bold">จำนวนรายการ :</td>
                    <td style="font-size: 15px; font-weight: bold">{{  $dataInvoiceList['total_quantity']}}</td>
                </tr>
                <tr>
                    <td width="50%"></td>
                    <td style="font-size: 15px; font-weight: bold">จำนวนเงินรวมทั้งสิ้น :</td>
                    <td style="font-size: 15px; font-weight: bold">{{  $dataInvoiceList['total_amount']}}</td>
                </tr>
            </table>
            <div class="card-body">
                <div class="row p-sm-3 p-0">
                    <div class="col-md-4 mb-2">
                        <h6 class="fw-semibold">การชำระเงิน / Payment :</h6>
                        @if ($dataInvoice->payment_tag == null)
                            <h6>ยังไม่ได้ชำระ</h6>
                        @else
                            <h6>{{ $dataInvoice->payment_tag }}</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
