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
    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#set-bank-list" aria-controls="set-bank-list" aria-selected="true">
                            รายการบัญชีธนาคาร
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="set-bank-list" role="tabpanel">
                        <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#addStatusModal">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มข้อมูลรายการบัญชีธนาคาร
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingStatus table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รูปภาพ</th>
                                        <th>รายชื่อธนาคาร</th>
                                        <th>รายชื่อธนาคาร (ย่อ)</th>
                                        <th>สถานะการใช้งาน</th>
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
