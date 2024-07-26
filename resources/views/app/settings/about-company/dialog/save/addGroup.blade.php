<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มรายการแผนก</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formAddGroup" class="form-block">
        @csrf
        <div class="modal-body">

            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label" for="groupName">ชื่อแผนก</label>
                    <input type="text" id="groupName" class="form-control" name="groupName" autocomplete="off" />
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="companyForGroup">ชื่อบริษัท</label>
                    <select id="companyForGroup" name="companyForGroup" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        @foreach ($getCompany as $key => $value)
                            <option value="{{ $value->ID }}">
                                {{ $value->company_name_th }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="department">สังกัด / ฝ่าย</label>
                    <select id="department" name="department" class="form-select select2" data-allow-clear="true">
                        <option value="">Select</option>
                        {{-- @foreach ($getDepartment as $key => $value)
                            <option value="{{ $value->ID }}">
                                {{ $value->departmentName }}</option>
                        @endforeach --}}
                    </select>
                </div>



                <div class="col-md-6">
                    <label class="form-label" for="statusOfGroup">สถานะการใช้งาน</label>
                    <select id="statusOfGroup" name="statusOfGroup" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="1">กำลังใช้งาน</option>
                        <option value="0">ปิดการใช้งาน</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

            <button type="submit" name="saveGroup" id="saveGroup"
                class="btn btn-success btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript" src="{{ asset('/assets/custom/settings/aboutCompany/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
<script>
    mapSelectedCompanyDepartment('#department','#companyForGroup',true)
</script>
