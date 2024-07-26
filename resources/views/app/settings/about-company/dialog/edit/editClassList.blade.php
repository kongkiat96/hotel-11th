<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขรายการระดับตำแหน่งงาน</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formEditClassList" class="form-block">

        <div class="modal-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label" for="edit_className">ระดับตำแหน่งงาน</label>
                    <input type="text" id="edit_className" class="form-control" name="edit_className"
                        autocomplete="off" value="{{ $dataClassList[0]->class_name }}" />
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_statusOfClassList">สถานะการใช้งาน</label>
                    <select id="edit_statusOfClassList" name="edit_statusOfClassList" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="1" @if ($dataClassList[0]->status == 1) selected @endif>กำลังใช้งาน</option>
                        <option value="0" @if ($dataClassList[0]->status == 0) selected @endif>ปิดการใช้งาน</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                    class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
                <input type="text" name="classListID" hidden value="{{ $dataClassList[0]->ID }}" id="classListID">
            <button type="submit" name="saveEditClassList" id="saveEditClassList"
                class="btn btn-warning btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i>
                บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript"
    src="{{ asset('/assets/custom/settings/aboutCompany/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
