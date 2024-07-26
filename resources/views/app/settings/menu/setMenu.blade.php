@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">หน้าแรก</a>
            </li>
            <li class="breadcrumb-item active">{{ $urlName }}</li>
        </ol>
    </nav>
    <hr>
    {{-- @include('Customer.lead-telesale.dialog-asset-edit') --}}
    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#set-status" aria-controls="set-status" aria-selected="true">
                            รายการสถานะงาน
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#flag-type" aria-controls="flag-type" aria-selected="false">
                            รายการรูปแบบสถานะงาน
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="set-status" role="tabpanel">
                        <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#addStatusModal">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มสถานะการทำงาน
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingStatus table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสถานะ</th>
                                        <th>รูปแบบการใช้งาน</th>
                                        <th>การใช้งานระบบ</th>
                                        <th>รูปแบบสถานะงาน</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="flag-type" role="tabpanel">
                        <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#addFlagType">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการรูปแบบสถานะงาน
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingFlagType table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสถานะ</th>
                                        <th>รูปแบบของสถานะ</th>
                                        {{-- <th>รูปแบบการใช้งาน</th>
                                        <th>การใช้งานระบบ</th>
                                        <th>รูปแบบสถานะงาน</th> --}}
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- <script type="text/javascript" src="{{ asset('/assets/custom/settings/status/status.js?v=') }}@php echo date("H:i:s") @endphp"></script> --}}
@endsection
