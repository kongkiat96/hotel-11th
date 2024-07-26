<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขชื่อสังกัด / ฝ่าย</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formEditDepartment" class="form-block">
        <div class="modal-body">

            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label" for="edit_departmentName">ชื่อสังกัด / ฝ่าย</label>
                    <input type="text" id="edit_departmentName" class="form-control" name="edit_departmentName"
                        autocomplete="off" value="{{ $dataDepartment[0]->department_name }}"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_company">ชื่อบริษัท</label>
                    <select id="edit_company" name="edit_company" class="form-select select2" data-allow-clear="true">
                        <option value="">Select</option>
                        @foreach ($getCompany as $key => $value)
                            <option value="{{ $value->ID }}" @if ($dataDepartment[0]->company_id == $value->ID ) selected @endif>
                                {{ $value->company_name_th }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_statusOfDepartment">สถานะการใช้งาน</label>
                    <select id="edit_statusOfDepartment" name="edit_statusOfDepartment" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="1" @if ($dataDepartment[0]->status == 1) selected @endif>กำลังใช้งาน</option>
                        <option value="0" @if ($dataDepartment[0]->status == 0) selected @endif>ปิดการใช้งาน</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
            <input type="text" hidden name="depID" id="depID" value="{{ $dataDepartment[0]->ID  }}">
            <button type="submit" name="saveEditDepartment" id="saveEditDepartment"
                class="btn btn-warning btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript" src="{{ asset('/assets/custom/settings/aboutCompany/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>

