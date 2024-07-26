<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขรายการแผนก</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formEditGroup" class="form-block">
        @csrf
        <div class="modal-body">

            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label" for="edit_groupName">ชื่อแผนก</label>
                    <input type="text" id="edit_groupName" class="form-control" name="edit_groupName"
                        autocomplete="off" value="{{ $dataGroup[0]->group_name }}" />
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_companyForGroup">ชื่อบริษัท</label>
                    <select id="edit_companyForGroup" name="edit_companyForGroup" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        @foreach ($getCompany as $key => $value)
                            <option value="{{ $value->ID }}" @if ($dataGroup[0]->company_id == $value->ID) selected @endif>
                                {{ $value->company_name_th }}</option>
                        @endforeach
                    </select>
                </div>
{{-- {{ dd($getDepartment) }} --}}
                <div class="col-md-6">
                    <label class="form-label" for="edit_department">สังกัด / ฝ่าย</label>
                    <select id="edit_department" name="edit_department" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        @foreach ($getDepartment as $key => $value)
                            <option value="{{ $value->ID }}" @if ($dataGroup[0]->department_id == $value->ID) selected @endif>
                                {{ $value->departmentName }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="col-md-6">
                    <label class="form-label" for="edit_statusOfGroup">สถานะการใช้งาน</label>
                    <select id="edit_statusOfGroup" name="edit_statusOfGroup" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="1" @if ($dataGroup[0]->status == 1) selected @endif>กำลังใช้งาน</option>
                        <option value="0" @if ($dataGroup[0]->status == 0) selected @endif>ปิดการใช้งาน</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
            <input type="text"  name="groupID" hidden id="groupID" value="{{ $dataGroup[0]->ID  }}">
            <button type="submit" name="saveEditGroup" id="saveEditGroup"
                class="btn btn-warning btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript"src="{{ asset('/assets/custom/settings/aboutCompany/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
<script>
    mapSelectedCompanyDepartment('#edit_department','#edit_companyForGroup',false)
</script>
