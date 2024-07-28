@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">หน้าแรก</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('/employee/list-all-employee') }}">ข้อมูลพนักงาน</a>
            </li>
            <li class="breadcrumb-item active">{{ $urlName }}</li>
        </ol>
    </nav>
    <hr>
    {{-- {{ dd($dataEmployee->ID) }} --}}
    <div class="row g-2">
        <div class="col-md-3 col-sm-12">
            <div class="card mt-2">
                <div class="card-body">
                    <form action="/upload" class="dropzone needsclick" id="pic-employee">
                        <div class="dz-message needsclick">
                            อัพโหลดรูปพนักงาน
                            <span class="note needsclick">(กรณีต้องการแก้ไขรูปภาพพนักงาน)</span>
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
                    <div class="mx-auto">
                        @if ($dataEmployee->img_base == null)
                            <img src="{{ asset('assets/img/img-not-found.png') }}" alt="Employee Image" width="200px" height="200px" />
                        @else
                            <img src="{{ $dataEmployee->img_base }}" alt="Employee Image" width="200px" height="200px" />
                        @endif
                    </div>
                    <hr>
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
                    <form id="formEditEmployee" class="page-block" onSubmit="return false">
                        <!-- Account Details -->
                        <div id="account-details-vertical" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">ข้อมูลพนักงาน</h6>
                                <small>กรอกข้อมูลพนักงานภายในระบบ</small>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="employee_code">รหัสพนักงาน</label>
                                    <input type="text" name="employee_code" id="employee_code" class="form-control"
                                        autocomplete="off" value="{{ $dataEmployee->employee_code }}">
                                </div>

                                {{-- {{ dd($dataEmployee->company_id) }} --}}

                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="company">บริษัท</label>
                                    <select id="company" name="company" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($dataCompany as $key => $value)
                                            <option value="{{ $value->ID }}"
                                                @if ($dataEmployee->company_id == $value->ID) selected @endif>
                                                {{ $value->company_name_th }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="department">สังกัด / ฝ่าย</label>
                                    <select id="department" name="department" class="form-select select2"
                                        data-allow-clear="true" autocomplete="off">
                                        <option value="">Select</option>
                                        @foreach ($getDepartment as $key => $value)
                                            <option value="{{ $value->ID }}"
                                                @if ($dataEmployee->department_id == $value->ID) selected @endif>
                                                {{ $value->departmentName }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="groupOfDepartment">แผนก</label>
                                    <select id="groupOfDepartment" name="groupOfDepartment" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true" autocomplete="off">
                                        <option value="">Select</option>
                                        @foreach ($getGroup as $key => $value)
                                            <option value="{{ $value->ID }}"
                                                @if ($dataEmployee->group_id == $value->ID) selected @endif>
                                                {{ $value->group_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" name="mapIDGroup" id="mapIDGroup" hidden
                                    value="{{ $dataEmployee->map_company }}" readonly autocomplete="off">
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="positionClass">ระดับตําแหน่ง</label>
                                    <select id="positionClass" name="positionClass" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($dataClassList as $key => $value)
                                            <option value="{{ $value->ID }}"
                                                @if ($dataEmployee->class_id == $value->ID) selected @endif>
                                                {{ $value->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="positionName">ตำแหน่ง</label>
                                    <input type="text" name="positionName" id="positionName" class="form-control"
                                        autocomplete="off" value="{{ $dataEmployee->position_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="dateStart">วันที่เริ่มทำงาน</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        placeholder="YYYY-MM-DD" id="dateStart" name="dateStart"
                                        value="{{ $dataEmployee->date_start_work }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="dateEnd">วันที่สิ้นสุดการทำงาน</label>

                                    <input type="text" class="form-control" autocomplete="off"
                                        placeholder="YYYY-MM-DD" id="dateEnd" name="dateEnd"
                                        value="{{ $dataEmployee->date_end_work }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="userClass">ระดับสิทธิ์ผู้ใช้งาน</label>

                                    <select id="userClass" name="userClass" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="it" @if ($dataEmployee->user_class == 'it') selected @endif>ฝ่าย IT
                                        </option>
                                        <option value="mt" @if ($dataEmployee->user_class == 'mt') selected @endif>ฝ่ายอาคาร
                                        </option>
                                        <option value="hr" @if ($dataEmployee->user_class == 'hr') selected @endif>ฝ่าย Hr
                                        </option>
                                        <option value="userOther" @if ($dataEmployee->user_class == 'userOther') selected @endif>
                                            ผู้ใช้งานทั่วไป</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="statusLogin">การเข้าสู่ระบบ</label>

                                    <select id="statusLogin" name="statusLogin" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="1" @if ($dataEmployee->status_login == 1) selected @endif>เปิดใช้งาน
                                        </option>
                                        <option value="0" @if ($dataEmployee->status_login == 0) selected @endif>ปิดใช้งาน
                                        </option>
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
                                    <label class="form-label-md mb-2" for="prefixName">คำนำหน้าชื่อ</label>

                                    <select id="prefixName" name="prefixName" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($dataPrefixName as $key => $value)
                                            <option value="{{ $value->ID }}"
                                                @if ($dataEmployee->prefix_id == $value->ID) selected @endif>
                                                {{ $value->prefix_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="firstName">ชื่อ</label>
                                    <input type="text" id="firstName" name="firstName" class="form-control"
                                        autocomplete="off" value="{{ $dataEmployee->first_name }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="lastName">นามสกุล</label>
                                    <input type="text" id="lastName" name="lastName" class="form-control"
                                        autocomplete="off" value="{{ $dataEmployee->last_name }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="birthday">วัน/เดือน/ปีเกิด</label>
                                    <input type="text" name="birthday" id="birthday" class="form-control"
                                        autocomplete="off" placeholder="YYYY-MM-DD"
                                        value="{{ $dataEmployee->birthday }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="age">อายุ (ปี)</label>
                                    <input type="text" id="age" name="age" class="form-control"
                                        autocomplete="off" readonly value="{{ $dataEmployee->age }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="email">อีเมล</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        autocomplete="off" value="{{ $dataEmployee->email }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="phoneNumber">เบอร์โทรศัพท์</label>
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                        autocomplete="off" value="{{ $dataEmployee->phone_number }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="currentAddress">ที่อยู่ปัจจุบัน</label>
                                    <input type="text" id="currentAddress" name="currentAddress" class="form-control"
                                        autocomplete="off" value="{{ $dataEmployee->current_address }}" />
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="province">จังหวัด</label>
                                    <select id="province" name="province" class="form-select select2"
                                        autocomplete="off" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($provinceName as $key => $value)
                                            <option value="{{ $value->province_code }}"
                                                @if ($dataEmployee->province_code == $value->province_code) selected @endif>
                                                {{ $value->province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="amphoe">อำเภอ</label>
                                    <select id="amphoe" name="amphoe" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($getMapAmphoe as $key => $value)
                                            <option value="{{ $value->amphoe_code }}"
                                                @if ($dataEmployee->amphoe_code == $value->amphoe_code) selected @endif>{{ $value->amphoe }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="tambon">ตำบล</label>
                                    <select id="tambon" name="tambon" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($getMapTambon as $key => $value)
                                            <option value="{{ $value->tambon_code }}"
                                                @if ($dataEmployee->tambon_code == $value->tambon_code) selected @endif>{{ $value->tambon }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-md mb-2" for="zipcode">หมายเลขไปรษณีย์</label>
                                    <input type="text" id="zipcode" name="zipcode" class="form-control"
                                        autocomplete="off" readonly value="{{ $dataEmployee->zipcode }}" />
                                    <input type="text" id="mapIDProvince" name="mapIDProvince" hidden
                                        value="{{ $dataEmployee->map_province }}" autocomplete="off" readonly />
                                </div>

                                <input type="text" name="baseimg" id="baseimg" hidden
                                    value="{{ $dataEmployee->img_base }}" autocomplete="off" readonly>

                                <input type="text" name="log_img" id="log_img" hidden autocomplete="off"
                                    value="{{ $dataEmployee->img_base }}" style="border-color:red" readonly>
                                <input type="text" name="emp_id" id="emp_id" hidden autocomplete="off"
                                    value="{{ $dataEmployee->emp_id }}" style="border-color:red" readonly>

                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-primary btn-prev">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">ก่อนหน้า</span>
                                    </button>

                                    <button type="submit" name="saveEditEmployee" id="saveEditEmployee"
                                        class="btn btn-warning btn-page-block-overlay"><i
                                            class='menu-icon tf-icons bx bxs-save'></i> แก้ไขข้อมูล</button>
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
        src="{{ asset('/assets/custom/employee/employee_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script>
        mapSelectedProvince('#amphoe', '#province', false)
        mapSelectedAumphoe('#tambon', '#amphoe', false)
        mapSelectedCompanyDepartment('#department', '#company', false)
        mapSelectedDepartmentGroup('#groupOfDepartment', '#department', false)

        const datePickers = ['dateStart', 'dateEnd', 'birthday'];
        initializeDatePickers(datePickers);
    </script>
@endsection
