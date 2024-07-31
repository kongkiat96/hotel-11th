@extends('layouts.app')

@section('content')
    <div class="modal fade" id="accessMenuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">

        </div>
    </div>

    <div class="modal fade" id="menuMainModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="menuSubModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editMenuMainModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editMenuSubModal" tabindex="-1" aria-hidden="true">
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
    {{-- @include('Customer.lead-telesale.dialog-asset-edit') --}}
    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#set-menu-main" aria-controls="set-menu-main" aria-selected="true">
                            รายการชื่อเมนู (หลัก)
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#set-menu-sub" aria-controls="set-menu-sub" aria-selected="true">
                            รายการชื่อเมนู (ย่อย)
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#flag-type" aria-controls="flag-type" aria-selected="false">
                            สิทธิ์การเข้าถึงเมนู
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="set-menu-main" role="tabpanel">
                        <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" id="addMenuModal">
                                <i class='menu-icon tf-icons bx bx-menu-alt-right'></i> เพิ่มรายชื่อเมนู (หลัก)
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingMenu table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายชื่อเมนู (หลัก)</th>
                                        <th>Icon</th>
                                        <th>Menu Link (Main)</th>
                                        <th>ลำดับเมนู</th>
                                        <th>การใช้งานระบบ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="set-menu-sub" role="tabpanel">
                        <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" id="addMenuSubModal">
                                <i class='menu-icon tf-icons bx bx-menu-alt-right'></i> เพิ่มรายชื่อเมนู (ย่อย)
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingMenuSub table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายชื่อเมนู (หลัก)</th>
                                        <th>Icon (Main)</th>
                                        <th>Menu Link (Main)</th>
                                        <th>รายชื่อเมนู (ย่อย)</th>
                                        <th>Icon</th>
                                        <th>Menu Link (Sub)</th>
                                        <th>การใช้งานระบบ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="flag-type" role="tabpanel">
                        {{-- <div class="inline-spacing text-end">
                            <button type="button" class="btn btn-info" id="addAccessMenuModal"><i class='menu-icon tf-icons bx bxs-layer'></i> เพิ่มรายชื่อผู้ใช้เข้าถึงเมนู</button>
                        </div> --}}
                        <div class="text-nowrap">
                            <table class="dt-user-access-menu table table-bordered table-hover">
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
    <script type="text/javascript"
        src="{{ asset('/assets/custom/settings/menu/menu.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
