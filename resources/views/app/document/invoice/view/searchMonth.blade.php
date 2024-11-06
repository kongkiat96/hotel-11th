@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">หน้าแรก</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/document/invoice') }}">รายการใบแจ้งหนี้</a></li>

            <li class="breadcrumb-item active">{{ $urlName }}</li>
        </ol>
    </nav>
    <hr>
    {{-- <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-label-info">
                <div class="card-body pb-2">
                    <span class="d-block fw-semibold mb-1">จำนวนเอกสารทั้งหมด</span>
                    <h3 class="card-title mb-1">425k</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body pb-2">
                    <span class="d-block fw-semibold mb-1">Revenue</span>
                    <h3 class="card-title mb-1">425k</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body pb-2">
                    <span class="d-block fw-semibold mb-1">Revenue</span>
                    <h3 class="card-title mb-1">425k</h3>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#invoice-list" aria-controls="#invoice-list" aria-selected="true">
                            รายการข้อมูลใบแจ้งหนี้ประจำเดือน
                        </button>
                    </li>
                </ul>
                <input type="hidden" id="searchMonth" name="searchMonth" value="{{ $searchMonth }}">
                <input type="hidden" id="searchTag" name="searchTag" value="{{ $searchTag }}">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="invoice-list" role="tabpanel">
                        <div class="row">
                            {{-- <div class="col-6">
                                <div class="inline-spacing text-start">
                                        <a href="{{ url('/document/invoice') }}" class="btn btn-danger">
                                            <i class='menu-icon tf-icons bx bx-arrow-back'></i> ย้อนกลับ
                                        </a>
                                </div>
                            </div>
                            
                            <div class="col-6"> --}}
                                <div class="inline-spacing text-end">
                                    @if (Auth::user()->user_system != 'Viewer')
                                        <a href="{{ route('create-invoice') }}" class="btn btn-info">
                                            <i class='menu-icon tf-icons bx bx-file'></i> เพิ่มข้อมูลรายการใบแจ้งหนี้
                                        </a>
                                    @endif
                                </div>
                            {{-- </div> --}}
                        </div>
                        <div class="text-nowrap table-responsive">
                            <table class="dt-InvoiceListSearch table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการเอกสาร</th>
                                        <th>ประเภทเอกสาร</th>
                                        <th>วันที่สร้างเอกสาร</th>
                                        <th>เอกสารของ</th>
                                        <th>สถานะเอกสาร</th>
                                        <th>วันที่บันทึกข้อมูล</th>
                                        <th>ผู้บันทึกข้อมูล</th>
                                        <th>วันที่แก้ไขข้อมูล</th>
                                        <th>ผู้แก้ไขข้อมูล</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                {{-- <tfoot>
                                    <tr>
                                        <th colspan="12" class="text-right">จำนวนรวมทั้งหมด <span id="totalCount">0</span> รายการ</th>
                                    </tr>
                                </tfoot> --}}
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="inline-spacing text-start">
        <a href="{{ url('/document/invoice') }}" class="btn btn-danger">
            <i class='menu-icon tf-icons bx bx-arrow-back'></i> ย้อนกลับ
        </a>
</div>
@endsection
@section('script')
    <script type="text/javascript"
        src="{{ asset('/assets/custom/document/invoice/invoice.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
