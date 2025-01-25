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
    <form class="form-block">
        <div class="card">
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-md-4">
                        <label class="form-label-md mb-2" for="company">บริษัท</label>
                        <select id="company" name="company" class="form-select select2" autocomplete="off"
                            data-allow-clear="true">
                            <option value="">Select</option>
                            @foreach ($dataCompany as $key => $value)
                                <option value="{{ $value->ID }}">
                                    {{ $value->company_name_th }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-md mb-2" for="department">สังกัด / ฝ่าย</label>
                        <select id="department" name="department" class="form-select select2" autocomplete="off"
                            data-allow-clear="true">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-md mb-2" for="groupOfDepartment">แผนก</label>
                        <select id="groupOfDepartment" name="groupOfDepartment" class="form-select select2"
                            autocomplete="off" data-allow-clear="true">
                            <option value="">Select</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label-md mb-2" for="user_class">ระดับสิทธิ์ผู้ใช้งาน</label>

                        <select id="user_class" name="user_class" class="form-select select2" autocomplete="off"
                            data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="SuperAdmin">ผู้ดูแลระบบ</option>
                            <option value="Admin">เจ้าหน้าที่</option>
                            <option value="User">ผู้บันทึกข้อมูล</option>
                            <option value="Viewer">ผู้ใช้งานทั่วไป</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="status_login" class="form-label-md mb-2">สถานะการใช้งาน</label>
                        <select id="status_login" name="status_login" class="form-select select2" autocomplete="off"
                            data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="1">เปิดใช้งาน</option>
                            <option value="0">ปิดใช้งาน</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="employee_code" class="form-label-md mb-2">รหัสพนักงาน</label>
                        <input type="text" name="employee_code" id="employee_code" class="form-control">
                    </div>

                </div>
                <div class="demo-inline-spacing text-center">
                    <button type="button" class="btn btn-label-info btn-form-block-overlay" id="searchDataEmployee">
                        <span class="tf-icons bx bx-search me-1"></span>ค้นหาข้อมูล
                    </button>
                    <button type="button" class="btn btn-label-danger" id="resetSearchEmployee">
                        <span class="tf-icons bx bx-reset me-1"></span>ล้างค่า
                    </button>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h5>ผลลัพธ์การค้นหาพนักงานทั้งหมด</h5>
            </div>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="dt-search-employee table table-hover">
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
                                {{-- <th>สาขา</th> --}}
                                <th>สังกัดใช้งาน</th>
                                <th>สถานะการใช้งาน</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript"
        src="{{ asset('/assets/custom/employee/searchEmployee.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script>
        mapSelectedCompanyDepartment('#department', '#company', true)
        mapSelectedDepartmentGroup('#groupOfDepartment', '#department', true)
    </script>
@endsection
