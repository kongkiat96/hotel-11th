@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">หน้าแรก</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/document/invoice') }}">รายการแบบฟอร์มการประเมินแผนก</a></li>

            <li class="breadcrumb-item active">{{ $urlName }}</li>
        </ol>
    </nav>
    <hr>

    <div class="modal fade" id="addFormDepartmentModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#invoice-list" aria-controls="#invoice-list" aria-selected="true">
                            รายการแบบฟอร์มการประเมินแผนก
                        </button>
                    </li>
                </ul>
                <input type="hidden" id="searchMonth" name="searchMonth" value="{{ $searchMonth }}">
                <input type="hidden" id="searchTag" name="searchTag" value="{{ $searchTag }}">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="invoice-list" role="tabpanel">
                        <div class="row">
                            {{-- <div class="col-6">
                                <div class="inline-spacing text-start">
                                        <a href="{{ url('/document/invoice') }}" class="btn btn-danger">
                                            <i class='menu-icon tf-icons bx bx-arrow-back'></i> ย้อนกลับ
                                        </a>
                                </div>
                            </div>
                            
                            <div class="col-6"> --}}
                            <div class="inline-spacing text-end">
                                @if (Auth::user()->user_system != 'Viewer')
                                    <button type="button" class="btn btn-info" id="addFormDepartment">
                                        <i class='menu-icon tf-icons bx bxs-food-menu'></i> เพิ่มข้อมูลการประเมิน
                                    </button>
                                @endif
                            </div>
                            {{-- </div> --}}
                        </div>
                        <div class="text-nowrap table-responsive">
                            <table class="dt-EvaluationListSearch table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อพนักงาน</th>
                                        <th>วันที่ประเมิน</th>
                                        <th>สถานะการประเมิน</th>
                                        <th>วันที่บันทึกข้อมูล</th>
                                        <th>ผู้บันทึกข้อมูล</th>
                                        <th>วันที่แก้ไขข้อมูล</th>
                                        <th>ผู้แก้ไขข้อมูล</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                {{-- <tfoot>
                                    <tr>
                                        <th colspan="12" class="text-right">จำนวนรวมทั้งหมด <span id="totalCount">0</span> รายการ</th>
                                    </tr>
                                </tfoot> --}}
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="inline-spacing text-start">
        <a href="{{ url('/evaluation/form-department') }}" class="btn btn-danger">
            <i class='menu-icon tf-icons bx bx-arrow-back'></i> ย้อนกลับ
        </a>
    </div>
@endsection
@section('script')
    <script type="text/javascript"
        src="{{ asset('/assets/custom/evaluation/formDepartment/formDepartment.js?v=') }}@php echo date("H:i:s") @endphp">
    </script>
@endsection
