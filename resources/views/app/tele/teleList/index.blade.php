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
    
    <div class="modal fade" id="addTeleDepartmentModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editTeleDepartmentModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="viewTeleDepartmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#tele-list" aria-controls="#tele-list" aria-selected="true">
                            รายการข้อมูลแผนกที่รับโทรศัพท์
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tele-list" role="tabpanel">
                        <div class="inline-spacing text-end">
                            @if(Auth::user()->user_system != 'Viewer')
                            <button type="button" class="btn btn-info" id="addteleDepartment">
                                <i class='menu-icon tf-icons bx bxs-buildings'></i> เพิ่มข้อมูลรายการข้อมูลแผนกที่รับโทรศัพท์
                            </button>
                            @endif
                        </div>
                        <div class="text-nowrap table-responsive">
                            <table class="dt-teleListDepartment table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อแผนก</th>
                                        <th>ชื่อเครื่อง</th>
                                        <th>วันที่รับโทรศัพท์</th>
                                        <th>วันที่ส่งโทรศัพท์</th>
                                        <th>หมายเหตุ</th>
                                        <th>บัญชีที่ยกเลิกการใช้งาน</th>
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
    <script type="text/javascript" src="{{ asset('/assets/custom/teleList/tele.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
