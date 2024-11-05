@extends('layouts.app')
@section('stylesheets')
    <style>
        .delete-icon-container {
            /* background-color: red; สีพื้นหลัง */
            display: flex;
            align-items: center;
            /* จัดกลางแนวตั้ง */
            justify-content: center;
            /* จัดกลางแนวนอน */
            padding: 8px;
            /* ปรับค่าตามที่ต้องการ */
        }
    </style>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">หน้าแรก</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/document/invoice') }}">รายการใบแจ้งหนี้</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ url('/document/invoice/created-invoice') . '/' . $dataInvoice->id }}">เพิ่มรายการใบแจ้งหนี้</a></li>
            <li class="breadcrumb-item active">{{ $urlName }}</li>
        </ol>
    </nav>
    <hr>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-md-6 mb-md-0 mb-4">
                                <dl class="row mb-2">
                                    <dt class="col-sm-5 mb-2 mb-sm-0 text-md-start">
                                        <span class="h4 text-capitalize mb-0 text-nowrap">ใบแจ้งหนี้ #</span>
                                    </dt>
                                    <dd class="col-sm-7  justify-content-md-start">
                                        <div class="w-auto">
                                            <span
                                                class="h4 text-capitalize mb-0 text-nowrap">{{ $dataInvoice->running_number }}</span>
                                            {{-- <input type="text" class="form-control" value="" id="invoiceId" name="invoiceId" readonly /> --}}
                                            <input type="hidden" name="invoice_id" id="invoice_id"
                                                value="{{ $dataInvoice->id }}">

                                        </div>
                                    </dd>
                                </dl>
                                <p class="mb-1">Office 149, 450 South Brand Brooklyn</p>
                                <p class="mb-1">San Diego County, CA 91905, USA</p>
                                <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex svg-illustration mb-4 gap-2 justify-content-md-end">
                                    <span class="app-brand-logo demo">
                                        <svg width="25" viewBox="0 0 25 42" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                                            <g id="g-app-brand" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
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
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-md-8 mb-2">
                                <h6 class="fw-semibold">ลูกค้า / Customer :</h6>
                                <br>
                                <h6 class="text-center">{{ $dataInvoice->customer_name }}</h6>
                                <hr>
                            </div>

                            <div class="col-md-4 col-sm-7">
                                <h6 class="fw-semibold">วันที่ / Date :</h6>
                                <br>
                                <h6 class="text-center">{{ $dateTH['formatted_date'] }}</h6>
                                <hr>
                            </div>

                            <div class="col-md-8 col-sm-5 col-12 mb-sm-0 mt-2">
                                <h6 class="fw-semibold">ที่อยู่ / Address :</h6>
                                <br>
                                <h6>{{ $dataInvoice->address }}</h6>
                                <hr>
                            </div>
                        </div>
                        <div class="row p-sm-3 p-0">
                            <div class="col-md-6 mb-2">
                                <h6 class="fw-semibold">ผู้ออก / Issuse :</h6>
                                <br>
                                <h6>{{ $dataInvoice->issuse }}</h6>
                                <hr>
                            </div>
                            <div class="col-md-6 mb-2">
                                <h6 class="fw-semibold">ช่องทางติดต่อ LINE :</h6>
                                <br>
                                <h6>{{ $dataInvoice->contact }}</h6>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table border-top m-0">
                            <thead>
                                <tr class="text-center">
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
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-md-4 mb-2">
                                <h6 class="fw-semibold">การชำระเงิน / Payment :</h6>
                                @if($dataInvoice->payment_tag == null)
                                    <h6></h6>
                                @elseif ($dataInvoice->payment_tag == 'other')
                                    <h6>อื่น ๆ</h6>
                                @else
                                    <h6><img src="/storage/public/uploads/banks/{{ $dataInvoice->bank_logo }}"
                                            alt="Bank Logo" width="30" height="30" />
                                        {{ $dataInvoice->bank_name }} ({{ $dataInvoice->bank_short_name }})</h6>
                                @endif
                                {{-- onerror="this.onerror=null; this.src='/storage/public/uploads/not-found.jpg';"  --}}

                                <h6>{{ $dataInvoice->payment }}</h6>
                                <hr >
                            </div>
                            <div class="col-md-4 mb-2 text-center">
                                <h6 class="fw-semibold">ผู้ชำระ</h6>
                                <div class="mt-3">&nbsp</div>
                                <hr class="mt-5">
                            </div>

                            <div class="col-md-4 mb-2 text-center">
                                <h6 class="fw-semibold">ผู้รับเงิน</h6>
                                <div class="mt-3">&nbsp</div>
                                <hr class="mt-5">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-semibold">Note :</span>
                                <span>{{ $dataInvoice->note }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                <div class="card">
                    <div class="card-body">
                        {{-- <button class="btn btn-primary d-grid w-100 mb-3" data-bs-toggle="offcanvas"
                            data-bs-target="#sendInvoiceOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bx-paper-plane bx-xs me-1"></i>Send Invoice</span>
                        </button> --}}
                        <a href="{{ url('/document/invoice/print-invoice') . '/' . Crypt::encrypt($dataInvoice->id) }}" target="_blank" class="btn btn-label-danger d-grid w-100 mb-3">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                class="bx bxs-file-pdf bx-xs me-1"></i>พิมพ์เอกสาร</span>
                        </a>

                        <a href="{{ url('/document/invoice/created-invoice') . '/' . $dataInvoice->id }}" class="btn btn-primary d-grid w-100">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                class="bx bxs-chevron-left bx-xs me-1"></i>ย้อนกลับ</span>
                        </a>
                        {{-- <button class="btn btn-primary d-grid w-100">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bxs-chevron-left bx-xs me-1"></i>ย้อนกลับ</span>
                        </button> --}}
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>

        <!-- Offcanvas -->
        <!-- Send Invoice Sidebar -->
        <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
            <div class="offcanvas-header mb-3">
                <h5 class="offcanvas-title">Send Invoice</h6>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                <form>
                    <div class="mb-3">
                        <label for="invoice-from" class="form-label">From</label>
                        <input type="text" class="form-control" id="invoice-from" value="shelbyComapny@email.com"
                            placeholder="company@email.com" />
                    </div>
                    <div class="mb-3">
                        <label for="invoice-to" class="form-label">To</label>
                        <input type="text" class="form-control" id="invoice-to" value="qConsolidated@email.com"
                            placeholder="company@email.com" />
                    </div>
                    <div class="mb-3">
                        <label for="invoice-subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="invoice-subject"
                            value="Invoice of purchased Admin Templates" placeholder="Invoice regarding goods" />
                    </div>
                    <div class="mb-3">
                        <label for="invoice-message" class="form-label">Message</label>
                        <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="8">
Dear Queen Consolidated,
    Thank you for your business, always a pleasure to work with you!
    We have generated a new invoice in the amount of $95.59
    We would appreciate payment of this invoice by 05/11/2021</textarea
                >
              </div>
              <div class="mb-4">
                <span class="badge bg-label-primary">
                  <i class="bx bx-link bx-xs"></i>
                  <span class="align-middle">Invoice Attached</span>
                </span>
              </div>
              <div class="mb-3 d-flex flex-wrap">
                <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /Send Invoice Sidebar -->

        <!-- Add Payment Sidebar -->
        <div class="offcanvas offcanvas-end" id="addPaymentOffcanvas" aria-hidden="true">
          <div class="offcanvas-header mb-3">
            <h5 class="offcanvas-title">Add Payment</h6>
            <button
              type="button"
              class="btn-close text-reset"
              data-bs-dismiss="offcanvas"
              aria-label="Close"></button>
          </div>
          <div class="offcanvas-body flex-grow-1">
            <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
              <p class="mb-0">Invoice Balance:</p>
              <p class="fw-bold mb-0">$5000.00</p>
            </div>
            <form>
              <div class="mb-3">
                <label class="form-label" for="invoiceAmount">Payment Amount</label>
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input
                    type="text"
                    id="invoiceAmount"
                    name="invoiceAmount"
                    class="form-control invoice-amount"
                    placeholder="100" />
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="payment-date">Payment Date</label>
                <input id="payment-date" class="form-control invoice-date" type="text" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="payment-method">Payment Method</label>
                <select class="form-select" id="payment-method">
                  <option value="" selected disabled>Select payment method</option>
                  <option value="Cash">Cash</option>
                  <option value="Bank Transfer">Bank Transfer</option>
                  <option value="Debit Card">Debit Card</option>
                  <option value="Credit Card">Credit Card</option>
                  <option value="Paypal">Paypal</option>
                </select>
              </div>
              <div class="mb-4">
                <label class="form-label" for="payment-note">Internal Payment Note</label>
                <textarea class="form-control" id="payment-note" rows="2"></textarea>
                    </div>
                    <div class="mb-3 d-flex flex-wrap">
                        <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
                        <button type="button" class="btn btn-label-secondary"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Add Payment Sidebar -->

        <!-- /Offcanvas -->
    </div>
    <!--/ Content -->
@endsection
@section('script')
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('/assets/custom/document/invoice/invoice.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script type="text/javascript"
        src="{{ asset('/assets/custom/document/invoice/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
