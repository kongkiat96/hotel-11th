@extends('layouts.app')
@section('stylesheets')
<style>
.progress{
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
    <div class="modal fade" id="addBankModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="editBankModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#set-bank-list" aria-controls="set-bank-list" aria-selected="true">
                            ตั้งค่าเกี่ยวกับระบบ
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="set-bank-list" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <form action="/upload" class="dropzone needsclick" id="pic-app">
                                    <div class="dz-message needsclick">
                                        อัพโหลดรูปภาพบริษัท (Logo)
                                        <span class="note needsclick">(กรณีต้องการปรับเปลี่ยนรูปภาพบริษัท (Logo))</span>
                                    </div>
                                    <div class="fallback">
                                        <input name="file" id="pic-app" type="file" />
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h4 class="card-title">รายละเอียด</h4>
                                                <hr>
                                            </div>
                                            <form class="form-block" id="formAboutApp">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label-md mt-2"
                                                                    for="company_name">ชื่อบริษัท</label>
                                                                <input type="text" class="form-control"
                                                                    name="company_name" id="company_name"
                                                                    placeholder="ชื่อบริษัท"
                                                                    value="{{ !$dataAboutApp ? '' : $dataAboutApp->company_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label-md mt-2"
                                                                    for="show_app_name">ชื่อที่ใช้แสดงในหน้าระบบ</label>
                                                                <input type="text" class="form-control"
                                                                    id="show_app_name" name="show_app_name"
                                                                    placeholder="ชื่อที่ใช้แสดงในหน้าระบบ"
                                                                    value="{{ !$dataAboutApp ? '' : $dataAboutApp->show_app_name }}">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label-md mt-2"
                                                            for="company_address">ที่อยู่</label>
                                                        <textarea class="form-control" name="company_address" id="company_address" cols="3" placeholder="ที่อยู่">{{ !$dataAboutApp ? '' : $dataAboutApp->company_address }}</textarea>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label-md mt-2" for="company_email">อีเมล</label>
                                                        <input type="text" class="form-control" id="company_email"
                                                            name="company_email" placeholder="อีเมล"
                                                            value="{{ !$dataAboutApp ? '' : $dataAboutApp->company_email }}">
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="card-footer text-center">
                                                <button type="submit" name="saveAboutApp" id="saveAboutApp"
                                                    class="btn btn-warning btn-form-block-overlay"><i
                                                        class='menu-icon tf-icons bx bxs-save'></i> เปลี่ยนแปลงข้อมูล</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript"
        src="{{ asset('/assets/custom/settings/aboutApp/aboutApp.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script>
        @if ($dataAboutApp->about_app_img == null)
            AddPic('#pic-app');
        @else
            ViewPicEdit(
                "{{ $dataAboutApp->about_app_img ? asset('storage/public/uploads/aboutApp/' . $dataAboutApp->about_app_img) : asset('storage/public/uploads/not-found.jpg') }}",
                '#pic-app', '#delete_about_app_img');
        @endif
    </script>
@endsection
