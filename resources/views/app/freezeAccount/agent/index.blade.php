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
    
    <div class="modal fade" id="addFreezeAccountAgentModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editFreezeAccountAgentModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="viewFreezeAccountAgentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#freeze-account" aria-controls="#freeze-account" aria-selected="true" id="reTabA">
                            รายการข้อมูลบัญชีที่อายัดในระบบ
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#unFreeze-Acoount" aria-controls="unFreeze-Acoount" aria-selected="true" id="reTabB">
                            รายการข้อมูลบัญชีที่ยกเลิกอายัดในระบบ
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="freeze-account" role="tabpanel">
                        <div class="inline-spacing text-end">
                            @if(Auth::user()->user_system != 'Viewer')
                            <button type="button" class="btn btn-info" id="addFreezeAccountAgent">
                                <i class='menu-icon tf-icons bx bxs-lock-alt'></i> เพิ่มข้อมูลรายการข้อมูลบัญชีที่อายัดในระบบ
                            </button>
                            @endif
                        </div>
                        <div class="text-nowrap table-responsive">
                            <table class="dt-freezeAccountAgent table table-hover table-striped">
                                <thead class="table-bordered">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อเอเย่นต์</th>
                                        <th>ชื่อเครื่อง</th>
                                        <th>ธนาคาร</th>
                                        <th>ชื่อบัญชี</th>
                                        <th>หมายเลขบัญชี</th>
                                        <th>ยอดเงินค้างในบัญชี</th>
                                        <th>เหตุผลที่อายัด</th>
                                        <th>วันที่บันทึกข้อมูล</th>
                                        <th>ผู้บันทึกข้อมูล</th>
                                        <th>สถานะ</th>
                                        <th>วันที่แก้ไขข้อมูล</th>
                                        <th>ผู้แก้ไขข้อมูล</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="unFreeze-Acoount" role="tabpanel">
                        <div class="text-nowrap table-responsive">
                            <table class="dt-UnfreezeAccountAgent table table-hover table-striped">
                                <thead class="table-bordered">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อเอเย่นต์</th>
                                        <th>ชื่อเครื่อง</th>
                                        <th>ธนาคาร</th>
                                        <th>ชื่อบัญชี</th>
                                        <th>หมายเลขบัญชี</th>
                                        <th>ยอดเงินค้างในบัญชี</th>
                                        <th>เหตุผลที่อายัด</th>
                                        <th>วันที่บันทึกข้อมูล</th>
                                        <th>ผู้บันทึกข้อมูล</th>
                                        <th>สถานะ</th>
                                        <th>วันที่แก้ไขข้อมูล</th>
                                        <th>ผู้แก้ไขข้อมูล</th>
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
    <script type="text/javascript" src="{{ asset('/assets/custom/freezeAccount/agent/agent.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
