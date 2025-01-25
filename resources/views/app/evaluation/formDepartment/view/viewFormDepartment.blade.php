@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">หน้าแรก</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('form-department') }}">รายการแบบฟอร์มการประเมินแผนก</a>
            </li>
            <li class="breadcrumb-item active">{{ $urlName }} [{{ $getDataEvaluation->emp_code }}]</li>
        </ol>
    </nav>
    <hr>

    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link " role="tab" data-bs-toggle="tab"
                            data-bs-target="#evaluation-form" aria-controls="#evaluation-form" aria-selected="true">
                            แบบฟอร์มการประเมิน
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#form-department-detail" aria-controls="#form-department-detail"
                            aria-selected="true">
                            รายละเอียดการให้/หักคะแนนประเมินเอเย่นต์
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade " id="evaluation-form" role="tabpanel">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>แบบประเมินภาพรวมการทำงานของ แผนก </h4>
                            </div>
                            <div class="card-body">
                                <form id="formAddEvaluation">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="text-center align-middle">
                                                    <th style="width: 5%">ลำดับ</th>
                                                    <th style="width: 20%">รายละเอียดการประเมิน</th>
                                                    <th style="width: 5%">ช่องทาง<br>การประเมิน</th>
                                                    <th style="width: 10%">เกณฑ์<br>การให้คะแนน</th>
                                                    <th style="width: 20%">เวลาประเมิน</th>
                                                    <th style="width: 10%">คะแนน (0-15)</th>
                                                    <th style="width: 30%">หมายเหตุ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>หน้าเว็บ รูปแบบโครงสร้าง สี ขนาดตัวอักษร เมนู
                                                        ตามที่กำหนดรูปแบบตัวอักษรอ่านง่าย <br>และข้อความเข้าใจได้ง่าย</td>
                                                    <td class="text-center">หน้าเว็บ</td>
                                                    <td class="text-center">5</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_a"
                                                            name="date_a" value="{{ $getDataEvaluation->date_a }}" /></td>

                                                    <td><input type="number" name="score_a" id="score_a"
                                                            class="form-control score-input text-center" style="width: 100%"
                                                            min="1" max="5"
                                                            value="{{ $getDataEvaluation->score_a }}"></td>
                                                    <td>รูปแบบโครงสร้างหน้าเว็บไซต์สีสันสวยงาม ทันสมัย
                                                        ขนาดตัวอักษรอ่านเข้าใจง่ายและเด่นชัด มีการจัดวางข้อมูลที่น่าสนใจ
                                                        <br>
                                                        สามารถมองเห็นข้อมูลได้อย่างชัดเจน
                                                        และหน้าเว็บไซต์มีการแจ้งอัปเดตอัตราจ่าย
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>แสดงเมนู ที่หน้า Website อย่างชัดเจนและสามารถใช้งานได้จริง</td>
                                                    <td class="text-center">หน้าเว็บ/ระบบ</td>
                                                    <td class="text-center">5</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_b"
                                                            name="date_b" value="{{ $getDataEvaluation->date_b }}" /></td>

                                                    <td><input type="number" name="score_b" id="score_b"
                                                            class="form-control score-input text-center" style="width: 100%"
                                                            min="1" max="5"
                                                            value="{{ $getDataEvaluation->score_b }}"></td>
                                                    <td>เมนูปุ่มสมัครสมาชิก และ ปุ่มโปรโมชั่นสามารถใช้งานได้จริงทั้งระบบ ios
                                                        ,
                                                        Android และ Computer</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td>มีโปรโมชั่น รายละเอียด แจ้งลูกค้าอย่างชัดเจน / มีป้าย Banner โฆษณา
                                                        Website
                                                        <br>อย่างน้อย 1 ป้าย
                                                    </td>
                                                    <td class="text-center">หน้าเว็บ</td>
                                                    <td class="text-center">5</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_c"
                                                            name="date_c" value="{{ $getDataEvaluation->date_c }}" /></td>

                                                    <td><input type="number" name="score_c" id="score_c"
                                                            class="form-control score-input text-center" style="width: 100%"
                                                            min="1" max="5"
                                                            value="{{ $getDataEvaluation->score_c }}"></td>
                                                    <td>มีแบนเนอร์โปรโมชั่นหน้าเว็บและหน้าระบบ
                                                        พร้อมแจ้งรายละเอียดแต่ละโปรโมชั่นได้ชัดเจน</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">4</td>
                                                    <td>มีเบอร์โทร / ไอดีไลน์ / QR Code ที่สามารถใช้งานได้จริง</td>
                                                    <td class="text-center">หน้าเว็บ</td>
                                                    <td class="text-center">5</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_d"
                                                            name="date_d" value="{{ $getDataEvaluation->date_d }}" />
                                                    </td>

                                                    <td><input type="number" name="score_d" id="score_d"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="5"
                                                            value="{{ $getDataEvaluation->score_d }}"></td>
                                                    <td>เบอร์โทรศัพท์สามารถติดต่อได้จริง ไอดีไลน์และ QR Code
                                                        สามารถใช้งานได้จริง
                                                        ทั้งหน้าเว็บไซต์และหน้าระบบ </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">5</td>
                                                    <td>มีการติดต่อกลับหาสมาชิกที่สมัครใหม่ภายใน 24 ชม.</td>
                                                    <td class="text-center">โทร</td>
                                                    <td class="text-center">15</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_e"
                                                            name="date_e" value="{{ $getDataEvaluation->date_e }}" />
                                                    </td>

                                                    <td><input type="number" name="score_e" id="score_e"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="15"
                                                            value="{{ $getDataEvaluation->score_e }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" rowspan="3">6</td>
                                                    <td rowspan="3">สามารถแก้ไขปัญหาได้รวดเร็ว
                                                        และชัดเจนในทุกช่องทางการติดต่อ</td>
                                                    <td class="text-center">ไลน์</td>
                                                    <td class="text-center">8</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_f"
                                                            name="date_f" value="{{ $getDataEvaluation->date_f }}" />
                                                    </td>

                                                    <td><input type="number" name="score_f" id="score_f"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="8"
                                                            value="{{ $getDataEvaluation->score_f }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">โทร</td>
                                                    <td class="text-center">5</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_g"
                                                            name="date_g" value="{{ $getDataEvaluation->date_g }}" />
                                                    </td>

                                                    <td><input type="number" name="score_g" id="score_g"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="5"
                                                            value="{{ $getDataEvaluation->score_g }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">กล่องข้อความ</td>
                                                    <td class="text-center">2</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_h"
                                                            name="date_h" value="{{ $getDataEvaluation->date_h }}" />
                                                    </td>

                                                    <td><input type="number" name="score_h" id="score_h"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="2"
                                                            value="{{ $getDataEvaluation->score_h }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" rowspan="2">7</td>
                                                    <td rowspan="2">คอลเซ็นเตอร์และแอดมินใช้น้ำเสียงถ้อยคำหรือข้อความ
                                                        ที่น่าเชื่อถือในการตอบลูกค้า<br>ทุกช่องทางการติดต่อไม่แสดงอารมณ์
                                                        หรือถ้อยคำที่ไม่สุภาพ กับลูกค้า</td>
                                                    <td class="text-center">ไลน์</td>
                                                    <td class="text-center">5</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_i"
                                                            name="date_i" value="{{ $getDataEvaluation->date_i }}" />
                                                    </td>

                                                    <td><input type="number" name="score_i" id="score_i"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="5"
                                                            value="{{ $getDataEvaluation->score_i }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">โทร</td>
                                                    <td class="text-center">5</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_j"
                                                            name="date_j" value="{{ $getDataEvaluation->date_j }}" />
                                                    </td>

                                                    <td><input type="number" name="score_j" id="score_j"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="5"
                                                            value="{{ $getDataEvaluation->score_j }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" rowspan="2">8</td>
                                                    <td rowspan="2">สามารถติดต่อประสานงานกับลูกค้าที่ติดปัญหา
                                                        และอธิบายปัญหาที่เกิดขึ้นปัจจุบันให้ชัดเจน</td>
                                                    <td class="text-center">ไลน์</td>
                                                    <td class="text-center">3</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_k"
                                                            name="date_k" value="{{ $getDataEvaluation->date_k }}" />
                                                    </td>

                                                    <td><input type="number" name="score_k" id="score_k"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="3"
                                                            value="{{ $getDataEvaluation->score_k }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">กล่องข้อความ</td>
                                                    <td class="text-center">2</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_l"
                                                            name="date_l" value="{{ $getDataEvaluation->date_l }}" />
                                                    </td>

                                                    <td><input type="number" name="score_l" id="score_l"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="2"
                                                            value="{{ $getDataEvaluation->score_l }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">9</td>
                                                    <td>โพสต์ รายละเอียดโปรโมชั่นตามที่บริษัทแจ้ง ในช่องทาง Facebook,
                                                        Twitter,
                                                        Tiktok</td>
                                                    <td class="text-center">การตลาด</td>
                                                    <td class="text-center">15</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_m"
                                                            name="date_m" value="{{ $getDataEvaluation->date_m }}" />
                                                    </td>

                                                    <td><input type="number" name="score_m" id="score_m"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="15"
                                                            value="{{ $getDataEvaluation->score_m }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">10</td>
                                                    <td>เพจ Facebook ต้องมีสมาชิกกด ติดตาม ขั้นต่ำ 5,000 คน และ มีการอัปเดต
                                                        ทุกๆ
                                                        3 วัน</td>
                                                    <td class="text-center">การตลาด</td>
                                                    <td class="text-center">10</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_n"
                                                            name="date_n" value="{{ $getDataEvaluation->date_n }}" />
                                                    </td>

                                                    <td><input type="number" name="score_n" id="score_n"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="10"
                                                            value="{{ $getDataEvaluation->score_n }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">11</td>
                                                    <td>เพจ Twitter ต้องมีสมาชิกกดติดตาม ขั้นต่ำ 500 คน และมีการอัปเดตทุกๆ 3
                                                        วัน
                                                    </td>
                                                    <td class="text-center">การตลาด</td>
                                                    <td class="text-center">5</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_o"
                                                            name="date_o" value="{{ $getDataEvaluation->date_o }}" />
                                                    </td>

                                                    <td><input type="number" name="score_o" id="score_o"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="5"
                                                            value="{{ $getDataEvaluation->score_o }}"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">12</td>
                                                    <td>ช่อง Tiktok ต้องมีสมาชิกกดติดตาม ขั้นต่ำ 500 คน และมีการอัปเดตทุกๆ 3
                                                        วัน
                                                    </td>
                                                    <td class="text-center">การตลาด</td>
                                                    <td class="text-center">5</td>
                                                    <td><input type="text" class="form-control" style="width: 140px"
                                                            autocomplete="off" placeholder="YYYY-MM-DD" id="date_p"
                                                            name="date_p" value="{{ $getDataEvaluation->date_p }}" />
                                                    </td>

                                                    <td><input type="number" name="score_p" id="score_p"
                                                            class="form-control score-input text-center"
                                                            style="width: 100%" min="1" max="5"
                                                            value="{{ $getDataEvaluation->score_p }}"></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="text-center align-middle">
                                                    <td colspan="5">รวมคะแนนเต็ม 100 </td>
                                                    <td class="text-center" id="total-score">0</td>
                                                    <td class="text-center">คะแนน</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <input type="hidden" name="id" id="id"
                                        value="{{ $getDataEvaluation->id }}">
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <button type="button" name="cancelFormEvaluation" id="cancelFormEvaluation"
                                    class="btn btn-warning btn-form-block-overlay" onclick="history.back()"><i
                                        class='menu-icon tf-icons bx bxs-chevron-left'></i> กลับ
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="form-department-detail" role="tabpanel">
                        <div class="text-nowrap table-responsive">
                            <table class="dt-formDepartmentDetail table table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>หัวข้อ</th>
                                        <th class="text-center">รายละเอียด</th>
                                        <th>คะแนน</th>
                                        <th class="text-center">เกณฑ์การให้คะแนน</th>
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
        src="{{ asset('/assets/custom/evaluation/formDepartment/formDepartment.js?v=') }}@php echo date("H:i:s") @endphp">
    </script>

    <script type="text/javascript"
        src="{{ asset('/assets/custom/evaluation/formDepartment/func_save.js?v=') }}@php echo date("H:i:s") @endphp">
    </script>

    <script>
        // Disable all inputs except password fields
        $('input').attr('readonly', true);
    </script>
@endsection
