<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขรายการสถานะ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formEditStatus" class="form-block">
        <div class="modal-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label" for="edit_statusName">รายการสถานะ</label>
                    <input type="text" id="edit_statusName" class="form-control" name="edit_statusName"
                        autocomplete="off" value="{{ $dataStatus[0]->status_name }}"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_statusUse">รูปแบบการใช้งาน</label>
                    <select id="edit_statusUse" name="edit_statusUse" class="form-select select2" data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="it" @if ($dataStatus[0]->status_use == 'it') selected @endif>ใช้งานฝ่าย IT</option>
                        <option value="building" @if ($dataStatus[0]->status_use == 'building') selected @endif>ใช้งานฝ่ายอาคาร</option>
                        <option value="hr" @if ($dataStatus[0]->status_use == 'hr') selected @endif>ใช้งานฝ่าย HR</option>
                        <option value="all" @if ($dataStatus[0]->status_use == 'all') selected @endif>ใช้งานทุกระบบ</option>
                    </select>
                </div>
                {{-- {{ dd($flagType) }} --}}
                <div class="col-md-6">
                    <label class="form-label" for="edit_flagType">รูปแบบสถานะทำงาน</label>
                    <select id="edit_flagType" name="edit_flagType" class="form-select select2" data-allow-clear="true">
                        <option value="">Select</option>
                        @foreach ($getFlagType as $key => $value)
                            <option value="{{ $value->ID }}" @if ($dataStatus[0]->flag_type == $value->ID ) selected @endif>
                                {{ $value->flag_name }} / {{ $value->type_work }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_statusOfStatus">สถานะการใช้งาน</label>
                    <select id="edit_statusOfStatus" name="edit_statusOfStatus" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="1" @if ($dataStatus[0]->status == 1) selected @endif>กำลังใช้งาน</option>
                        <option value="0" @if ($dataStatus[0]->status == 0) selected @endif>ปิดการใช้งาน</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                    class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
                <input type="text" hidden id="statusID" name="statusID" value="{{ $dataStatus[0]->ID }}">
            <button type="submit" name="saveEditStatus" id="saveEditStatus"
                class="btn btn-warning btn-form-block-overlay"><i
                    class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>
</div>

<script type="text/javascript" src="{{ asset('/assets/custom/settings/status/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
