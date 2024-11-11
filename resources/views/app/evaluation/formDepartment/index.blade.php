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
                            data-bs-target="#form-department" aria-controls="#form-department" aria-selected="true">
                            รายการข้อมูลแบบฟอร์มการประเมิน
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="form-department" role="tabpanel">
                        <div class="inline-spacing text-end">
                            @if (Auth::user()->user_system != 'Viewer')
                            <button type="button" class="btn btn-info" id="addFormDepartment">
                                <i class='menu-icon tf-icons bx bxs-lock-alt'></i> เพิ่มข้อมูลประเมิน
                            </button>
                            @endif
                        </div>
                        <div class="text-nowrap table-responsive">
                            <table class="dt-InvoiceList table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ข้อมูลรายการประจำเดือน</th>
                                        <th>จำนวนที่ประเมิน</th>
                                        {{-- <th>ตรวจสอบ</th> --}}
                                        <th>จำนวนที่ประเมินยังไม่เรียบร้อย (แบบร่าง)</th>
                                        {{-- <th>ตรวจสอบ</th> --}}
                                        <th>จำนวนที่ประเมินเรียบร้อยแล้ว (บันทึกแล้ว)</th>
                                        {{-- <th>ตรวจสอบ</th> --}}
                                        {{-- <th>จัดการ</th> --}}
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
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('/assets/custom/evaluation/formDepartment/formDepartment.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
