<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขรายการรูปแบบสถานะ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formEditFlagType" class="form-block">
        <div class="modal-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label" for="edit_flagName">ชื่อรายการรูปแบบสถานะ</label>
                    <input type="text" id="edit_flagName" class="form-control" name="edit_flagName"
                        autocomplete="off" value="{{ $dataFlagType[0]->flag_name }}"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_typeWork">รูปแบบของสถานะ</label>
                    <select id="edit_typeWork" name="edit_typeWork" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="Complete" @if ($dataFlagType[0]->type_work == 'Complete') selected @endif>Complete</option>
                        <option value="Hold" @if ($dataFlagType[0]->type_work == 'Hold') selected @endif>Hold</option>
                        <option value="Doing" @if ($dataFlagType[0]->type_work == 'Doing') selected @endif>Doing</option>
                        <option value="Wating" @if ($dataFlagType[0]->type_work == 'Wating') selected @endif>Wating</option>
                        <option value="Cancel" @if ($dataFlagType[0]->type_work == 'Cancel') selected @endif>Canncel</option>
                        <option value="Other" @if ($dataFlagType[0]->type_work == 'Other') selected @endif>Other</option>
                    </select>
                </div>

            </div>



        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
            <input type="text" name="flagTypeID" id="flagTypeID" value="{{ $dataFlagType[0]->ID }}" hidden>
            <button type="submit" name="saveEditFlagType" id="saveEditFlagType" class="btn btn-warning btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>
</div>

<script type="text/javascript"src="{{ asset('/assets/custom/settings/status/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>

