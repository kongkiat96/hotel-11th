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
    <div class="row g-2">
        <div class="col-md-3 col-sm-12">
            <div class="card mt-2">
                <div class="card-body">
                    <form action="/upload" class="dropzone needsclick" id="pic-employee">
                        <div class="dz-message needsclick">
                            อัพโหลดรูปพนักงาน
                            <span class="note needsclick">(กรณีต้องการเพิ่มรูปภาพพนักงาน)</span>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="bs-stepper wizard-vertical vertical wizard-vertical-icons-example mt-2">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#account-details-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                                <i class="bx bx-detail"></i>
                            </span>
                            <span class="bs-stepper-label mt-1">
                                <span class="bs-stepper-title">ข้อมูลพนักงาน</span>
                                <span class="bs-stepper-subtitle">เพิ่มข้อมูลพนักงานภายในระบบ</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#personal-info-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                                <i class="bx bx-user"></i>
                            </span>
                            <span class="bs-stepper-label mt-1">
                                <span class="bs-stepper-title">ข้อมูลส่วนบุคคล (เบื้องต้น)</span>
                                <span class="bs-stepper-subtitle">เพิ่มข้อมูลส่วนบุคคล <strong>(เบื้องต้น)</strong></span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                </div>
                <div class="bs-stepper-content">
                    <form id="formAddEmployee" class="page-block" onSubmit="return false">
                        <!-- Account Details -->
                        <div id="account-details-vertical" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">ข้อมูลพนักงาน</h6>
                                <small>กรอกข้อมูลพนักงานภายในระบบ</small>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="employee_code">รหัสพนักงาน</label>
                                    <input type="text" name="employee_code" id="employee_code" class="form-control" autocomplete="off">
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label" for="company">บริษัท</label>
                                    <select id="company" name="company" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($dataCompany as $key => $value)
                                            <option value="{{ $value->ID }}">
                                                {{ $value->company_name_th }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="department">สังกัด / ฝ่าย</label>
                                    <select id="department" name="department" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="groupOfDepartment">แผนก</label>
                                    <select id="groupOfDepartment" name="groupOfDepartment" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <input type="text" name="mapIDGroup" id="mapIDGroup" readonly hidden autocomplete="off" >
                                <div class="col-md-6">
                                    <label class="form-label" for="positionClass">ระดับตําแหน่ง</label>
                                    <select id="positionClass" name="positionClass" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($dataClassList as $key => $value)
                                            <option value="{{ $value->ID }}">
                                                {{ $value->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="positionName">ตำแหน่ง</label>
                                    <input type="text" name="positionName" id="positionName" class="form-control"
                                        autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="dateStart">วันที่เริ่มทำงาน</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        placeholder="YYYY-MM-DD" id="dateStart" name="dateStart" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="dateEnd">วันที่สิ้นสุดการทำงาน</label>

                                    <input type="text" class="form-control" autocomplete="off"
                                        placeholder="YYYY-MM-DD" id="dateEnd" name="dateEnd" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="userClass">ระดับสิทธิ์ผู้ใช้งาน</label>

                                    <select id="userClass" name="userClass" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="it">ฝ่าย IT</option>
                                        <option value="mt">ฝ่ายอาคาร</option>
                                        <option value="hr">ฝ่าย Hr</option>
                                        <option value="userOther">ผู้ใช้งานทั่วไป</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="statusLogin">การเข้าสู่ระบบ</label>

                                    <select id="statusLogin" name="statusLogin" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="1" selected>เปิดใช้งาน</option>
                                        <option value="0">ปิดใช้งาน</option>
                                    </select>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-label-secondary btn-prev" disabled>
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">ก่อนหน้า</span>
                                    </button>
                                    <button class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none me-sm-1">ถัดไป</span>
                                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Personal Info -->
                        <div id="personal-info-vertical" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">ข้อมูลส่วนบุคคล (เบื้องต้น)</h6>
                                <small>กรอกข้อมูลส่วนบุคคล (เบื้องต้น)</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="prefixName">คำนำหน้าชื่อ</label>

                                    <select id="prefixName" name="prefixName" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($dataPrefixName as $key => $value)
                                            <option value="{{ $value->ID }}">
                                                {{ $value->prefix_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">ชื่อ</label>
                                    <input type="text" id="firstName" name="firstName" class="form-control"
                                        autocomplete="off" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="lastName">นามสกุล</label>
                                    <input type="text" id="lastName" name="lastName" class="form-control"
                                        autocomplete="off" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="birthday">วัน/เดือน/ปีเกิด</label>
                                    <input type="text" name="birthday" id="birthday" class="form-control"
                                        autocomplete="off" placeholder="YYYY-MM-DD" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="age">อายุ (ปี)</label>
                                    <input type="text" id="age" name="age" class="form-control"
                                        autocomplete="off" readonly />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="email">อีเมล</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        autocomplete="off" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="phoneNumber">เบอร์โทรศัพท์</label>
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                        autocomplete="off" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="currentAddress">ที่อยู่ปัจจุบัน</label>
                                    <input type="text" id="currentAddress" name="currentAddress" class="form-control"
                                        autocomplete="off" />
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="province">จังหวัด</label>
                                    <select id="province" name="province" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($provinceName as $key => $value)
                                            <option value="{{ $value->province_code }}">
                                                {{ $value->province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="amphoe">อำเภอ</label>
                                    <select id="amphoe" name="amphoe" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="tambon">ตำบล</label>
                                    <select id="tambon" name="tambon" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="zipcode">หมายเลขไปรษณีย์</label>
                                    <input type="text" id="zipcode" name="zipcode" class="form-control"
                                        autocomplete="off" readonly />
                                    <input type="text" id="mapIDProvince" name="mapIDProvince" hidden autocomplete="off"
                                         readonly />
                                </div>

                                <input type="text" name="baseimg" id="baseimg" hidden autocomplete="off" readonly>

                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-primary btn-prev">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">ก่อนหน้า</span>
                                    </button>

                                    <button type="submit" name="saveEmployee" id="saveEmployee"
                                        class="btn btn-success btn-page-block-overlay"><i
                                            class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript"
        src="{{ asset('/assets/custom/employee/employee_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script>
        mapSelectedProvince('#amphoe', '#province', true)
        mapSelectedAumphoe('#tambon', '#amphoe', true)
        mapSelectedCompanyDepartment('#department', '#company', true)
        mapSelectedDepartmentGroup('#groupOfDepartment', '#department', true)

        const datePickers = ['dateStart', 'dateEnd', 'birthday'];
        initializeDatePickers(datePickers);
    </script>
@endsection
