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
                            data-bs-target="#employee-current" aria-controls="#employee-current" aria-selected="true">
                            พนักงานที่อยู่ในระบบ
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#employee-disable" aria-controls="employee-disable" aria-selected="true">
                            พนักงานที่ปิดการใช้งาน
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="employee-current" role="tabpanel">
                        <div class="text-nowrap">
                            <table class="dt-employee-current table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัสพนักงาน</th>
                                        <th>E-mail</th>
                                        <th>ชื่อ - นามสกุล</th>
                                        <th>ระดับตำแหน่ง</th>
                                        <th>ตำแหน่งงาน</th>
                                        <th>บริษัท</th>
                                        <th>สังกัด/ฝ่าย</th>
                                        <th>แผนก</th>
                                        <th>สังกัดใช้งาน</th>
                                        <th>สถานะการใช้งาน</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="employee-disable" role="tabpanel">
                        <div class="text-nowrap">
                            <table class="dt-employee-disable table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัสพนักงาน</th>
                                        <th>E-mail</th>
                                        <th>ชื่อ - นามสกุล</th>
                                        <th>ระดับตำแหน่ง</th>
                                        <th>ตำแหน่งงาน</th>
                                        <th>บริษัท</th>
                                        <th>สังกัด/ฝ่าย</th>
                                        <th>แผนก</th>
                                        <th>สังกัดใช้งาน</th>
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
    <script type="text/javascript" src="{{ asset('/assets/custom/employee/employee.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
