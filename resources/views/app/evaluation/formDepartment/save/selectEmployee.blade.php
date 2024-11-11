<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มข้อมูลประเมินสำหรับพนักงาน</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <div class="modal-body">
        <form id="formAddSelectEmployee" class="form-block">

            <div class="row g-1">

                <div class="col-md-12 mb-3">
                    <label class="form-label-md mb-2" for="select_employee">เลือกข้อมูลพนักงานที่จะประเมิน</label>
                    <select id="select_employee" name="select_employee" class="form-select select2" data-allow-clear="true">
                        <option value="">Select</option>
                        @foreach ($dataEmployee as $key => $value)
                            <option value="{{ $value->employee_code }}">{{ $value->full_name }}, [รหัสพนักงาน : {{ $value->employee_code }}, บริษัท : {{ $value->company_name_th }}, แผนก : {{ $value->department_name }}]</option>
                            
                        @endforeach
                    </select>
                </div>
            </div>
        </form>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

        <button type="submit" name="saveSelectEmployee" id="saveSelectEmployee"
            class="btn btn-success btn-form-block-overlay">
            ต่อไป   <i class='menu-icon tf-icons bx bxs-arrow-to-right'></i></button>
    </div>

    <script type="text/javascript" src="{{ asset('/assets/custom/evaluation/formDepartment/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    
