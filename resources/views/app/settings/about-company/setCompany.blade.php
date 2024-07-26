@extends('layouts.app')

@section('content')
    <div class="modal fade" id="companyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="departmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="groupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="prefixNameModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="classListModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editCompanyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editGroupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editPrefixNameModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editClassListModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

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
                            data-bs-target="#list-company" aria-controls="list-company" aria-selected="true">
                            รายการชื่อบริษัท
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#list-department" aria-controls="list-department" aria-selected="false">
                            รายการชื่อสังกัด / ฝ่าย
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#list-group" aria-controls="list-group" aria-selected="false">
                            รายการชื่อแผนก
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#class-list" aria-controls="class-list" aria-selected="false">
                            รายการระดับตำแหน่ง
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#prefix-name" aria-controls="prefix-name" aria-selected="false">
                            รายการคำนำหน้าชื่อ
                        </button>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="list-company" role="tabpanel">
                        <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" id="AddCompanyModal">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการชื่อบริษัท
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingCompany table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อบริษัท (ไทย)</th>
                                        <th class="text-center">ชื่อบริษัท (อังกฤษ)</th>
                                        <th class="text-center">สถานะการใช้งาน</th>
                                        <th class="text-center">จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-department" role="tabpanel">
                        <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" id="AddDepartmentModal">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการชื่อแผนกสังกัด / ฝ่าย
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingDepartment table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อสังกัด / ฝ่าย</th>
                                        <th class="text-center">ชื่อบริษัท</th>
                                        <th class="text-center">สถานะการใช้งาน</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-group" role="tabpanel">
                        <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" id="AddGroupModal">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการชื่อแผนก
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingGroup table table-bordered">
                                <thead>
                                    <tr>

                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อแผนก</th>
                                        <th class="text-center">ชื่อสังกัด / ฝ่าย</th>
                                        <th class="text-center">ชื่อบริษัท</th>
                                        <th class="text-center">สถานะการใช้งาน</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="class-list" role="tabpanel">
                        <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" id="AddClassListModal">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการระดับตำแหน่งงาน
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingClassList table table-bordered">
                                <thead>
                                    <tr>

                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ระดับตำแหน่งงาน</th>
                                        <th class="text-center">สถานะการใช้งาน</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="prefix-name" role="tabpanel">
                        <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" id="AddPrefixNameModal">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการคำนำหน้าชื่อ
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingPrefixName table table-bordered">
                                <thead>
                                    <tr>

                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">คำนำหน้าชื่อ</th>
                                        <th class="text-center">สถานะการใช้งาน</th>
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
    <script type="text/javascript" src="{{ asset('/assets/custom/settings/aboutCompany/company.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
