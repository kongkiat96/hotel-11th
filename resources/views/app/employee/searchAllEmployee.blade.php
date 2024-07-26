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

    <div class="card">
        <div class="card-body">
            <div class="row gy-3">
                <div class="col-md-4">
                    <label for="" class="form-label">บริษัท</label>
                    <input type="text" name="" id="" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="" class="form-label">สังกัด / ฝ่าย</label>
                    <input type="text" name="" id="" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="" class="form-label">แผนก</label>
                    <input type="text" name="" id="" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="" class="form-label">ระดับสิทธิ์การใช้งาน</label>
                    <input type="text" name="" id="" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="" class="form-label">สถานะการใช้งาน</label>
                    <input type="text" name="" id="" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="" class="form-label">รหัสพนักงาน</label>
                    <input type="text" name="" id="" class="form-control">
                </div>

            </div>
            <div class="demo-inline-spacing text-center">
                <button type="button" class="btn btn-label-info">
                    <span class="tf-icons bx bx-pie-chart-alt me-1"></span>Primary
                </button>
                <button type="button" class="btn btn-label-danger">
                    <span class="tf-icons bx bx-bell me-1"></span>Secondary
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
    </div>
@endsection

@section('script')
@endsection
