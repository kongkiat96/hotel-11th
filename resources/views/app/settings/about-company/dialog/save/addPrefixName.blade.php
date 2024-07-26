<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มรายการคำนำหน้าชื่อ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formAddPrefixName" class="form-block">

        <div class="modal-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label" for="prefixName">คำนำหน้าชื่อ</label>
                    <input type="text" id="prefixName" class="form-control" name="prefixName"
                        autocomplete="off" />
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="statusOfPrefixName">สถานะการใช้งาน</label>
                    <select id="statusOfPrefixName" name="statusOfPrefixName" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="1">กำลังใช้งาน</option>
                        <option value="0">ปิดการใช้งาน</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                    class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

            <button type="submit" name="savePrefixName" id="savePrefixName" class="btn btn-success btn-form-block-overlay"><i
                    class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript" src="{{ asset('/assets/custom/settings/aboutCompany/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
