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
    
    <div class="modal fade" id="addRentAccountModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editRentAccountModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="viewRentAccountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#rent-account" aria-controls="#rent-account" aria-selected="true">
                            รายการข้อมูลแผนกที่ขอเช่าบัญชี
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="rent-account" role="tabpanel">
                        <div class="inline-spacing text-end">
                            @if(Auth::user()->user_system != 'Viewer')
                            <button type="button" class="btn btn-info" id="addRentAccount">
                                <i class='menu-icon tf-icons bx bx-list-ol'></i> เพิ่มข้อมูลรายการข้อมูลแจ้งขอเช่าบัญชี
                            </button>
                            @endif
                        </div>
                        <div class="text-nowrap table-responsive">
                            <table class="dt-rentAccount table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อแผนก</th>
                                        <th>วันที่แจ้งขอบัญชี</th>
                                        <th>วันที่ส่งบัญชี</th>
                                        <th>จำนวนบัญชี</th>
                                        <th>หมายเหตุ</th>
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

    
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('/assets/custom/rentAccount/rentAccount.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
