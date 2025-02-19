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

    <div class="modal fade" id="editBlacklistModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="modal fade" id="viewBlacklistModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#ิdata-blacklist" aria-controls="#ิdata-blacklist" aria-selected="true"
                            id="reTabA">
                            รายการข้อมูลรายชื่อ Blacklist
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#import-blacklist" aria-controls="import-blacklist" aria-selected="true"
                            id="reTabB">
                            นำเข้ารายการข้อมูลรายชื่อ Blacklist
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="ิdata-blacklist" role="tabpanel">
                        <div class="text-nowrap table-responsive">
                            <table class="dt-datablacklist table table-hover table-striped">
                                <thead class="table-bordered">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อ</th>
                                        <th>นามสกุล</th>
                                        <th>หมายเหตุ</th>
                                        <th>สถานะ</th>
                                        <th>วันที่บันทึกข้อมูล</th>
                                        <th>ผู้บันทึกข้อมูล</th>
                                        <th>วันที่แก้ไขข้อมูล</th>
                                        <th>ผู้แก้ไขข้อมูล</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="import-blacklist" role="tabpanel">
                        <div class="row mt-4">
                            <form class="kt-form kt-form--fit" enctype='multipart/form-data' id="frmImport"
                                autocomplete="off">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="filename" name="filename"
                                                accept=".xlsx, .xls," required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 row">
                                        <div class="ml-5">
                                            <button class="btn btn-md btn-success ml-3 mr-3" type="button"
                                                id="btnImports"><i class="fa fas fa-file-upload"></i>บันทึกข้อมูล</button>
                                            <button class="btn btn-md btn-danger ml-3 mr-3 reset" type="button"
                                                onclick="reloadFrm();"><i class="fa fas fa-eraser"></i>ล้างข้อมูล</button>
                                        </div>

                                    </div>
                                </div>

                            </form>
                        </div>
                        <div id="msgAlert"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript"
        src="{{ asset('/assets/custom/import/importBlacklist.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
