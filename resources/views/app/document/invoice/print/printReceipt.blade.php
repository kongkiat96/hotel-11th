<!DOCTYPE html>

<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="../../../assets/"
    data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $mapText }}_{{ $dataInvoice->running_number }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../../assets/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../../assets/vendor/libs/typeahead-js/typeahead.css" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="../../../assets/vendor/css/pages/app-invoice-print.css" />
    <!-- Helpers -->
    <script src="../../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../../assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="invoice-print p-5">
        <div class="d-flex justify-content-between flex-row">
            <div class="mb-4">
                <dl class="row mb-2">
                    <dt class="col-sm-7 mb-2 mb-sm-0 text-md-start">
                        <span class="h4 text-capitalize mb-0 text-nowrap">{{ $mapText }} #</span>
                    </dt>
                    <dd class="col-sm-5  justify-content-md-start">
                        <div class="w-auto">
                            <span class="h4 text-capitalize mb-0 text-nowrap">{{ $dataInvoice->running_number }}</span>
                            {{-- <input type="text" class="form-control" value="" id="invoiceId" name="invoiceId" readonly /> --}}
                            <input type="hidden" name="invoice_id" id="invoice_id" value="{{ $dataInvoice->id }}">

                        </div>
                    </dd>
                </dl>
                <p class="mb-1">Office 149, 450 South Brand Brooklyn</p>
                <p class="mb-1">San Diego County, CA 91905, USA</p>
                <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
            </div>
            <div>
                <div class="d-flex svg-illustration mb-4 gap-2 justify-content-md-end">
                    <span class="app-brand-logo demo">
                        <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs>
                                <path
                                    d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                                    id="path-1"></path>
                                <path
                                    d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                                    id="path-3"></path>
                                <path
                                    d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                                    id="path-4"></path>
                                <path
                                    d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                                    id="path-5"></path>
                            </defs>
                            <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                    <g id="Icon" transform="translate(27.000000, 15.000000)">
                                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                                            <mask id="mask-2" fill="white">
                                                <use xlink:href="#path-1"></use>
                                            </mask>
                                            <use fill="#696cff" xlink:href="#path-1"></use>
                                            <g id="Path-3" mask="url(#mask-2)">
                                                <use fill="#696cff" xlink:href="#path-3"></use>
                                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3">
                                                </use>
                                            </g>
                                            <g id="Path-4" mask="url(#mask-2)">
                                                <use fill="#696cff" xlink:href="#path-4"></use>
                                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4">
                                                </use>
                                            </g>
                                        </g>
                                        <g id="Triangle"
                                            transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                            <use fill="#696cff" xlink:href="#path-5"></use>
                                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5">
                                            </use>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="app-brand-text demo text-body fw-bolder">Sneat</span>
                </div>
            </div>
        </div>

        <hr class="border-top" />

        <div class="row d-flex justify-content-between mb-4">
            <div class="col-6">
                <div class="mb-sm-0 p-0">
                    <div class="col-md-12 mt-2">
                        <h6 class="fw-semibold">
                            @switch($dataInvoice->tag_invoice)
                                @case(1)
                                    พนักงาน / Employee :
                                @break

                                @case(5)
                                    แผนก / Department :
                                @break

                                @default
                                    ลูกค้า / Customer :
                            @endswitch
                        </h6>
                        <br>
                        <h6 class="text-center">{{ $dataInvoice->customer_name }}</h6>
                        <hr class="border-top">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-sm-0 p-0">
                    <div class="col-md-12 mt-2">
                        <h6 class="fw-semibold">วันที่ / Date :</h6>
                        <br>
                        <h6 class="text-center">{{ $dateTH['formatted_date'] }}</h6>
                        <hr class="border-top">
                    </div>
                </div>


            </div>
            <div class="col-6">
                <div class="mb-sm-0 mt-2">
                    <h6 class="fw-semibold">ที่อยู่ / Address :</h6>
                    <br>
                    <h6>{{ $dataInvoice->address }}</h6>
                    <hr class="border-top">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-sm-0 mt-2 row">
                    <div class="col-md-6 mb-2">
                        <h6 class="fw-semibold">ผู้ออก / Issuse :</h6>
                        <br>
                        <h6 class="text-center">{{ $dataInvoice->issuse }}</h6>
                        <hr class="border-top">
                    </div>
                    <div class="col-md-6 mb-2">
                        <h6 class="fw-semibold">ช่องทางติดต่อ LINE :</h6>
                        <br>
                        <h6 class="text-center">{{ $dataInvoice->contact }}</h6>
                        <hr class="border-top">
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table border-top m-0">
                <thead>
                    <tr class="text-center fw-semibold">
                        <th>ลำดับ</th>
                        <th>ประเภทค่าใช้จ่าย</th>
                        <th>รายการ</th>
                        <th>จำนวน / รายการ</th>
                        <th>จำนวนเงิน</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- {{ dd($dataInvoiceList['data']) }} --}}
                    @foreach ($dataInvoiceList['data'] as $key => $value)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $value->invoice_list }}</td>
                            <td>{{ $value->detail_list }}</td>
                            <td class="text-center">{{ $value->quantity }}</td>
                            <td class="text-center">{{ number_format($value->amount_total, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="align-top px-4 py-5">
                            <p class="mb-2">

                                <br>
                            </p>
                            <span class="me-1 fw-semibold">จำนวนเงินรวมทั้งสิ้น (อักษร) :</span>
                            <span>{{ $dataInvoiceList['total_amount'] != 0 ? $bahtTotext : '-' }}</span>
                        </td>
                        <td class="text-end px-4 py-5">
                            <p class="mb-2">จำนวนรายการ :</p>
                            <p class="mb-2">จำนวนเงินรวมทั้งสิ้น :</p>
                        </td>
                        <td class="text-end px-4 py-5">
                            <p class="fw-semibold mb-2">{{ $dataInvoiceList['total_quantity'] }}</p>
                            <p class="fw-semibold mb-2">{{ $dataInvoiceList['total_amount'] }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="row mb-sm-0 p-0">
                    <div class="col-md-4 mb-2">
                        <h6 class="fw-semibold">การชำระเงิน / Payment :</h6>
                        @if ($dataInvoice->payment_tag == null)
                            <h6></h6>
                        @elseif ($dataInvoice->payment_tag == 'other')
                            <h6>อื่น ๆ</h6>
                        @else
                            <h6><img src="/storage/public/uploads/banks/{{ $dataInvoice->bank_logo }}"
                                    alt="Bank Logo" width="30" height="30" />
                                {{ $dataInvoice->bank_name }} ({{ $dataInvoice->bank_short_name }})</h6>
                        @endif
                        {{-- onerror="this.onerror=null; this.src='/storage/public/uploads/not-found.jpg';"  --}}
                        <hr class="border-top">
                        <h6>{{ $dataInvoice->payment }}</h6>
                        <hr class="border-top">
                    </div>
                    <div class="col-md-4 mb-2 text-center">
                        <h6 class="fw-semibold">ผู้ชำระ</h6>
                        <div class="mt-5">&nbsp</div>
                        <hr class="border-top">
                    </div>

                    <div class="col-md-4 mb-2 text-center">
                        <h6 class="fw-semibold">ผู้รับเงิน</h6>
                        <div class="mt-5">&nbsp</div>
                        <hr class="border-top">
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-top">
        <div class="row">
            <div class="col-12">
                <span class="fw-semibold">Note:</span>
                <span>{{ $dataInvoice->note }}</span>
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../../assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="../../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../../assets/js/app-invoice-print.js"></script>
</body>

</html>
