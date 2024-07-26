<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขรายการคำนำหน้าชื่อ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formEditPrefixName" class="form-block">

        <div class="modal-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label" for="edit_prefixName">คำนำหน้าชื่อ</label>
                    <input type="text" id="edit_prefixName" class="form-control" name="edit_prefixName"
                        autocomplete="off" value="{{ $dataPrefixName[0]->prefix_name }}"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_statusOfPrefixName">สถานะการใช้งาน</label>
                    <select id="edit_statusOfPrefixName" name="edit_statusOfPrefixName" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="1" @if ($dataPrefixName[0]->status == 1) selected @endif>กำลังใช้งาน</option>
                        <option value="0" @if ($dataPrefixName[0]->status == 0) selected @endif>ปิดการใช้งาน</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                    class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
                <input type="text"  name="prefixID" hidden id="prefixID" value="{{ $dataPrefixName[0]->ID  }}">
            <button type="submit" name="savePrefixName" id="saveEditPrefixName" class="btn btn-warning btn-form-block-overlay"><i
                    class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript" src="{{ asset('/assets/custom/settings/aboutCompany/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
