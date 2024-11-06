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

        .select2-option {
            display: flex;
            align-items: center;
            /* Center vertically */
        }

        .select2-option img {
            margin-right: 10px;
            /* Space between image and text */
        }
    </style>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">หน้าแรก</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/document/invoice') }}">{{ $urlName }}</a></li>
            <li class="breadcrumb-item active">เพิ่มรายการใบแจ้งหนี้</li>
        </ol>
    </nav>
    <hr>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-add">
            <!-- Invoice Add-->

            <div class="col-lg-9 col-12 mb-lg-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-md-8 mb-md-0">
                                <dl class="row mb-2">
                                    <dt class="col-sm-4 mb-2 mb-sm-0 text-md-start pt-2">
                                        <span class="h4 text-capitalize mb-0 text-nowrap">ประเภทใบแจ้งหนี้</span>
                                    </dt>
                                    <dd class="col-sm-8  justify-content-md-start">
                                        <div class="w-auto">
                                            <select class="form-select select2" autocomplete="off" data-allow-clear="true"
                                                name="tag_invoice" id="tag_invoice">
                                                <option value="" selected>--- เลือกประเภทใช้จ่าย ---
                                                </option>
                                                @foreach ($getMasterList as $key => $list)
                                                    <option value="{{ $list->id }}"
                                                        {{ $list->id == $dataInvoice->tag_invoice ? 'selected' : '' }}>
                                                        {{ $list->invoice_list }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <hr class="my-4 mx-n4">
                        <div class="row p-sm-3 p-0">
                            <div class="col-md-6 mb-md-0 mb-4">
                                <dl class="row mb-2">
                                    <dt class="col-sm-5 mb-2 mb-sm-0 text-md-start pt-2">
                                        <span class="h4 text-capitalize mb-0 text-nowrap">ใบแจ้งหนี้ #</span>
                                    </dt>
                                    <dd class="col-sm-7  justify-content-md-start">
                                        <div class="w-auto">
                                            {{-- <input type="text" class="form-control" value="-" id="invoiceId"
                                                readonly data-bs-toggle="tooltip"
                                                data-bs-offset="0,5" data-bs-placement="top" data-bs-html="true"
                                                title="<i class='bx bx-calendar-exclamation bx-xs'></i> <span >เลขที่จะสร้างเมื่อกดบันทึก</span>"/> --}}
                                            <input type="text" class="form-control"
                                                value="{{ $dataInvoice->running_number }}" id="invoiceId" name="invoiceId"
                                                readonly />
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
                        <hr class="my-4 mx-n4" />
                        <div class="row p-sm-3 p-0">
                            <div class="col-md-8 mb-2">
                                <h6 id="customerLabel">
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
                                <input type="text" class="form-control" name="customer_name" id="customer_name"
                                    value="{{ $dataInvoice->customer_name }}" placeholder="Item Information">
                            </div>

                            <div class="col-md-4 col-sm-7">
                                <h6>วันที่ / Date</h6>
                                <input type="text" class="form-control" value="{{ $dateTH['formatted_date'] }}"
                                    name="date_invoice" id="date_invoice" readonly>
                            </div>

                            <div class="col-md-8 col-sm-5 col-12 mb-sm-0 mt-2">
                                <h6>ที่อยู่ / Address</h6>
                                <textarea class="form-control" rows="5" placeholder="Item Information" name="address" id="address">{{ $dataInvoice->address }}</textarea>
                            </div>
                        </div>
                        <hr class="my-4 mx-n4" />

                        <div class="row p-sm-3 p-0">
                            <div class="col-md-6 mb-2">
                                <h6>ผู้ออก / Issuse</h6>
                                <input type="text" class="form-control" name="issuse" id="issuse"
                                    value="{{ $dataInvoice->issuse }}" placeholder="Item Information">
                            </div>
                            <div class="col-md-6 mb-2">
                                <h6>ช่องทางติดต่อ LINE</h6>
                                <input type="text" class="form-control" name="contact" id="contact"
                                    value="{{ $dataInvoice->contact }}" placeholder="Item Information">
                            </div>
                        </div>

                        <hr class="mx-n4" />
                        {{-- {{ dd($countDetail) }} --}}
                        @if ($countDetail == 0)
                            <form class="source-item py-sm-3" id="formListInvoice">
                                <div class="mb-3" data-repeater-list="group-detail-invoice">
                                    <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                        <div class="d-flex border rounded position-relative pe-0">
                                            <div class="row w-100 m-0 p-3">
                                                <div class="col-md-6 mb-md-0 mb-3 ps-md-0">
                                                    <p class="mb-2 repeater-title">รายละเอียด</p>
                                                    <select class="form-select" name="group-detail-invoice[][tag_list]">
                                                        <option value="" selected>--- เลือกประเภทใช้จ่าย ---</option>
                                                        @foreach ($getMasterList as $key => $value)
                                                            <option value="{{ $value->id }}">
                                                                {{ $value->invoice_list }}</option>
                                                        @endforeach
                                                    </select>
                                                    <textarea class="form-control mt-2" rows="2" placeholder="Item Information"
                                                        name="group-detail-invoice[][detail_list]" required></textarea>
                                                </div>
                                                <div class="col-md-2 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">จำนวน / รายการ</p>
                                                    <input type="number" class="form-control invoice-item-price mb-2"
                                                        placeholder="1" min="1" max="50"
                                                        name="group-detail-invoice[][quantity]" required />
                                                </div>
                                                <div class="col-md-4 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">จำนวนเงิน</p>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control numeral-mask text-end"
                                                            placeholder="ระบุจำนวนเงิน"
                                                            name="group-detail-invoice[][amount_total]"
                                                            oninput="formatAmount(this)" required />
                                                        <span class="input-group-text">฿</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="delete-icon-container border-start p-2">
                                                <i class="bx bxs-trash-alt text-danger cursor-pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="hidden" value="{{ $dataInvoice->id }}" name="invoiceId"
                                            id="invoiceId">
                                        <button type="button" class="btn btn-success" name="saveListInvoice"
                                            id="saveListInvoice">
                                            <i class='bx bx-save bx-xs me-1'></i> บันทึกรายการ
                                        </button>
                                        <button type="button" class="btn btn-warning" data-repeater-create>
                                            <i class='bx bx-plus-medical bx-xs me-1'></i> เพิ่มรายการ
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form class="source-item py-sm-3" id="formListInvoice">
                                <div class="mb-3" data-repeater-list="group-detail-invoice">
                                    @foreach ($dataInvoiceList['data'] as $index => $value)
                                        <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                            <div class="d-flex border rounded position-relative pe-0">
                                                <div class="row w-100 m-0 p-3">
                                                    <div class="col-md-6 mb-md-0 mb-3 ps-md-0">

                                                        <p class="mb-2 repeater-title">รายละเอียด</p>
                                                        {{-- {{ dd($getMasterList) }} --}}
                                                        <select class="form-select" autocomplete="off"
                                                            data-allow-clear="true"
                                                            name="group-detail-invoice[{{ $index }}][tag_list]">
                                                            <option value="" selected>--- เลือกประเภทใช้จ่าย ---
                                                            </option>
                                                            @foreach ($getMasterList as $key => $list)
                                                                <option value="{{ $list->id }}"
                                                                    {{ $list->id == $value->tag_list ? 'selected' : '' }}>
                                                                    {{ $list->invoice_list }}</option>
                                                            @endforeach
                                                        </select>
                                                        <textarea class="form-control mt-2" rows="2" placeholder="Item Information"
                                                            name="group-detail-invoice[{{ $index }}][detail_list]" required>{{ $value->detail_list }}</textarea>
                                                    </div>
                                                    <div class="col-md-2 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">จำนวน / รายการ</p>
                                                        <input type="number" class="form-control invoice-item-price mb-2"
                                                            placeholder="1" min="1" max="50"
                                                            name="group-detail-invoice[{{ $index }}][quantity]"
                                                            value="{{ $value->quantity }}" required />
                                                    </div>
                                                    <div class="col-md-4 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">จำนวนเงิน</p>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control numeral-mask text-end"
                                                                placeholder="ระบุจำนวนเงิน"
                                                                name="group-detail-invoice[{{ $index }}][amount_total]"
                                                                oninput="formatAmount(this)" required
                                                                value="{{ number_format($value->amount_total, 2) }}" />
                                                            <span class="input-group-text">฿</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="delete-icon-container border-start p-2">
                                                    <i class="bx bxs-trash-alt text-danger cursor-pointer"></i>
                                                </div>
                                            </div>
                                            <input type="hidden" name="group-detail-invoice[{{ $index }}][id]"
                                                value="{{ $value->id }}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="hidden" value="{{ $dataInvoice->id }}" name="invoiceId"
                                            id="invoiceId">
                                        <button type="button" class="btn btn-success" name="saveListInvoice"
                                            id="saveListInvoice">
                                            <i class='bx bx-save bx-xs me-1'></i> บันทึกรายการ
                                        </button>
                                        <button type="button" class="btn btn-warning" data-repeater-create>
                                            <i class='bx bx-plus-medical bx-xs me-1'></i> เพิ่มรายการ
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        <hr class="my-4 mx-n4" />

                        <div class="row py-sm-3">

                            <div class="col-md-7 mb-md-0 ">
                                <div class="d-flex justify-content-between mt-3">
                                    <span class="">&nbsp </span>
                                    <span class="fw-semibold"> &nbsp </span>
                                </div>
                                <div class="d-flex justify-content-between mt-5">
                                    <span class="">จำนวนเงินรวมทั้งสิ้น (อักษร) : </span>
                                    <span class="fw-semibold"> &nbsp
                                        {{ $dataInvoiceList['total_amount'] != 0 ? $bahtTotext : '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex justify-content-end">
                                <div class="invoice-calculations">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="">จำนวนรายการ : </span>
                                        <span class="fw-semibold"> {{ $dataInvoiceList['total_quantity'] }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="">จำนวนเงินรวมทั้งสิ้น : </span>
                                        <span class="fw-semibold"> &nbsp {{ $dataInvoiceList['total_amount'] }}</span>
                                    </div>
                                    <hr />
                                    <div class="d-flex justify-content-between">
                                        <span class="">จำนวนเงินรวมทั้งสิ้น : </span>
                                        <span class="fw-semibold"> &nbsp {{ $dataInvoiceList['total_amount'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 mx-n4" />

                        <div class="row p-sm-3 p-0">
                            <div class="col-md-4 mb-2">
                                <h6>การชำระเงิน / Payment</h6>
                                <select id="payment_tag" name="payment_tag" class="form-select select2"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    @foreach ($getBankList as $key => $value)
                                        <option value="{{ $value->ID }}"
                                            data-image="{{ asset('storage/public/uploads/banks/' . $value->bank_logo) }}"
                                            {{ $dataInvoice->payment_tag == $value->ID ? 'selected' : '' }}>
                                            {{ $value->bank_name }} ({{ $value->bank_short_name }})</option>
                                    @endforeach
                                    <option value="other"
                                        data-image="{{ asset('storage/public/uploads/not-found.jpg') }}"
                                        {{ $dataInvoice->payment_tag == 'other' ? 'selected' : '' }}>อื่น ๆ</option>


                                </select>
                                <textarea class="form-control mt-2" rows="2" placeholder="Item Information" name="payment" id="payment">{{ $dataInvoice->payment }}</textarea>
                            </div>
                            <div class="col-md-4 mb-2 text-center">
                                <h6>ผู้ชำระ</h6>
                                <div class="mt-5">&nbsp</div>
                                <hr class="mt-5">
                            </div>

                            <div class="col-md-4 mb-2 text-center">
                                <h6>ผู้รับเงิน</h6>
                                <div class="mt-5">&nbsp</div>
                                <hr class="mt-5">
                            </div>
                        </div>

                        <hr class="my-4" />

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="note" class="form-label fw-semibold">Note:</label>
                                    <textarea class="form-control" rows="2" id="note" name="note" id="note"
                                        placeholder="Invoice note">{{ $dataInvoice->note }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice Add-->
            <!-- Invoice Actions -->
            <div class="col-lg-3 col-12 invoice-actions">
                <div class="card mb-4">
                    <div class="card-body">
                        {{-- <button class="btn btn-primary d-grid w-100 mb-3" data-bs-toggle="offcanvas"
                            data-bs-target="#sendInvoiceOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bx-paper-plane bx-xs me-1"></i>Send Invoice</span>
                        </button> --}}

                        <a href="{{ url('/document/invoice') }}" class="btn btn-label-secondary d-grid w-100 mb-3"><span
                                class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bxs-chevron-left bx-xs me-1"></i>ย้อนกลับ</span></a>

                        <a href="{{ route('view-invoice', ['id' => $dataInvoice->id]) }}"
                            class="btn btn-label-info d-grid w-100 mb-3 {{ $dataInvoice->customer_name != null ? '' : 'd-none' }}"
                            name="viewInvoice" id="viewInvoice">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bx-search bx-xs me-1"></i>ตรวจสอบข้อมูล</span></a>
                        <button type="button" class="btn btn-label-warning d-grid w-100 mb-3" name="saveDrawingInvoice"
                            id="saveDrawingInvoice">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bx-edit bx-xs me-1"></i>บันทึกแบบร่าง</span></button>
                        <button type="button" class="btn btn-success d-grid w-100 mb-3" name="saveInvoice"
                            id="saveInvoice"><span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bx-save bx-xs me-1"></i>บันทึกข้อมูล</span></button>
                                    @if (Auth::user()->user_system != 'User')
                        <button type="button" class="btn btn-danger d-grid w-100" name="deletedInvoice"
                            id="deletedInvoice"><span
                                class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bxs-trash-alt bx-xs me-1"></i>ลบ / ยกเลิกใบแจ้งหนี้</span></button>
                                    @endif
                    </div>
                </div>

            </div>
            <!-- /Invoice Actions -->
        </div>

        <!-- Offcanvas -->
        <!-- Send Invoice Sidebar -->
        <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
            <div class="offcanvas-header mb-3">
                <h5 class="offcanvas-title">Send Invoice</h5>
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
                        <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="8">aa</textarea>
                    </div>
                    <div class="mb-4">
                        <span class="badge bg-label-primary">
                            <i class="bx bx-link bx-xs"></i>
                            <span class="align-middle">Invoice Attached</span>
                        </span>
                    </div>
                    <div class="mb-3 d-flex flex-wrap">
                        <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
                        <button type="button" class="btn btn-label-secondary"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Send Invoice Sidebar -->

        <!-- /Offcanvas -->
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('/assets/custom/document/invoice/invoice.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script type="text/javascript"
        src="{{ asset('/assets/custom/document/invoice/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script>
        // Initialize Select2 when the modal is shown
        $(document).ready(function() {
            $('#payment_tag').select2({
                placeholder: 'เลือกข้อมูล',
                allowClear: true,
                templateResult: formatState,
                templateSelection: formatState,
                escapeMarkup: function(markup) {
                    return markup;
                }
            });

            function formatState(state) {
                if (!state.id) {
                    return state.text; // หากไม่มี ID ให้แสดงชื่อปกติ
                }

                var imageUrl = $(state.element).data('image'); // ดึงข้อมูลรูปภาพจาก data-image
                var markup = `
            <div class="select2-option">
                <img src="${imageUrl}" class="img-thumbnail" style="width: 30px; height: 30px; margin-right: 10px; vertical-align: middle;" />
                <span style="vertical-align: middle;">${state.text}</span>
            </div>`;
                return markup;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tag_invoice').change(function() {
                var selectedValue = $(this).val();

                if (selectedValue === '1') {
                    $('#customerLabel').text('พนักงาน / Employee');
                } else if(selectedValue === '5'){
                    $('#customerLabel').text('แผนก / Department');
                } else {
                    $('#customerLabel').text('ลูกค้า / Customer');
                }
            });
        });
    </script>
@endsection
