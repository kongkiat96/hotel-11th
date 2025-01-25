@extends('layouts.app')

@section('stylesheets')
    <style>
        #tree-container {
            width: 100%;
            height: 500px;
            border: 1px solid #ccc;
        }

        .boc-edit-form-instruments {
            margin-top: 0px !important;
        }

        input[data-binding="ImgUrl"] {
            display: none;
        }
    </style>
@endsection
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

    <div class="container-p-y">
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-md-4 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">

                                @if ($dataEmployee->img_base == null)
                                    <img class="img-fluid rounded my-4" src="{{ asset('assets/img/img-not-found.png') }}"
                                        alt="Employee Image" height="200" width="200" />
                                @else
                                    <img class="img-fluid rounded my-4" src="{{ $dataEmployee->img_base }}"
                                        alt="Employee Image" height="200" width="200" />
                                @endif
                                <div class="user-info text-center">
                                    <h4 class="mb-2">{{ $dataEmployee->first_name . ' ' . $dataEmployee->last_name }}</h4>
                                    @if ($dataEmployee->user_class == 'SuperAdmin')
                                        <span class="badge bg-label-danger">ผู้ดูแลระบบ</span>
                                    @elseif($dataEmployee->user_class == 'Admin')
                                        <span class="badge bg-label-warning">เจ้าหน้าที่</span>
                                    @elseif($dataEmployee->user_class == 'user')
                                        <span class="badge bg-label-primary">ผู้บันทึกข้อมูล</span>
                                    @else
                                        <span class="badge bg-label-info">ผู้ใช้งานทั่วไป</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-2 border-bottom mb-4 mt-3">รายละเอียดข้อมูลส่วนตัว</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Username :</span>
                                    <span>{{ $dataEmployee->employee_code }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Email :</span>
                                    <span>{{ $dataEmployee->email }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Status :</span>
                                    @if($dataEmployee->status_login == 1)
                                    <span class="badge bg-label-success">Active</span>
                                    @else
                                    <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Role :</span>
                                    @if($dataEmployee->user_class == 'SuperAdmin')
                                        <span class="badge bg-label-danger">ผู้ดูแลระบบ</span>
                                    @elseif($dataEmployee->user_class == 'Admin')
                                        <span class="badge bg-label-warning">เจ้าหน้าที่</span>
                                    @elseif($dataEmployee->user_class == 'user')
                                        <span class="badge bg-label-primary">ผู้บันทึกข้อมูล</span>
                                    @else
                                    <span class="badge bg-label-info">ผู้ใช้งานทั่วไป</span>
                                    @endif
                                    {{-- <span>Author</span> --}}
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">วันที่เริ่มงาน :</span>
                                    <span>{{  $getCalWorking['formatted_date'] }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">อายุงาน :</span>
                                    <span>{{ $getCalWorking['service_period']['years'] }} ปี {{ $getCalWorking['service_period']['months'] }} เดือน {{ $getCalWorking['service_period']['days'] }} วัน</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">บริษัท :</span>
                                    <span>{{ $aboutDepartment[0]->company_name_th }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">สังกัด / ฝ่าย :</span>
                                    <span>{{ $aboutDepartment[0]->departmentName }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-md-8 order-md-1">
                <div class="row">
                    <div class="col-12">
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-pills mb-3" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#myProfile" aria-controls="#myProfile" aria-selected="true">
                                        ข้อมูลส่วนตัว
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#changePassword" aria-controls="#changePassword" aria-selected="true"
                                        id="reTabA">
                                        เปลี่ยนแปลงรหัสผ่าน
                                    </button>
                                </li>

                                {{-- <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#Manager" aria-controls="#Manager" aria-selected="true"
                                        id="reTabB">
                                        ผู้ใต้บังคับบัญา
                                    </button>
                                </li> --}}


                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="myProfile" role="tabpanel">
                                    <div id="personal-info-vertical" class="content">
                                        <div class="content-header mb-3">
                                            <h5 class="pb-2 border-bottom mb-4 ">ข้อมูลส่วนบุคคล (เบื้องต้น)</h5>
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
        
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="changePassword" role="tabpanel">
                                    <form id="formChangePasswordUser">
                                        <div class="alert alert-warning" role="alert">
                                            <h6 class="alert-heading fw-bold mb-1">คําแนะนําการเปลี่ยนรหัสผ่าน</h6>
                                            <span>ความยาวขั้นต่ำ 6 ตัวอักษร ตัวพิมพ์ใหญ่ และสัญลักษณ์</span>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-password-toggle">
                                                <label class="form-label" for="newPassword">รหัสผ่านใหม่</label>
                                                <div class="input-group input-group-merge">
                                                    <input class="form-control" type="password" id="newPassword"
                                                        name="newPassword"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="bx bx-hide"></i></span>
                                                </div>
                                            </div>

                                            <div class="mb-3 col-md-6 form-password-toggle">
                                                <label class="form-label" for="confirmPassword">ยืนยันรหัสผ่านใหม่</label>
                                                <div class="input-group input-group-merge">
                                                    <input class="form-control" type="password"
                                                        name="confirmPassword" id="confirmPassword"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="bx bx-hide"></i></span>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="changePassword"
                                                    id="changePassword"
                                                    class="btn btn-info btn-form-block-overlay"><i
                                                        class='menu-icon tf-icons bx bxs-paper-plane'></i>
                                                    เปลี่ยนแปลงรหัสผ่าน</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="Manager" role="tabpanel">
                                    <div id="tree-container"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ User Content -->
        </div>
    </div>
    {{-- {{ dd($dataManager[0]) }} --}}
@endsection
@section('script')
    <script src="{{ asset('/assets/custom/myProfile/my_profile.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
