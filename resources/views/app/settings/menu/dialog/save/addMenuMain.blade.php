<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มรายชื่อเมนู (หลัก)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formAddMenuMain" class="form-block">

        <div class="modal-body pt-1">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label-md mb-2" for="menuName">ชื่อเมนู</label>
                    <input type="text" id="menuName" class="form-control" name="menuName"
                        autocomplete="off" />
                </div>

                <div class="col-md-6">
                    <label class="form-label-md mb-2" for="pathMenu">Path Menu</label>
                    <input type="text" id="pathMenu" class="form-control" name="pathMenu"
                        autocomplete="off" placeholder="(Route::Prefix), Ex : settings-system"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label-md mb-2" for="iconMenu">Icon Menu <a href="https://boxicons.com/" target="_blank"><i class="fa fa-question-circle"></i></a></label>
                    <input type="text" id="iconMenu" class="form-control" name="iconMenu"
                        autocomplete="off" placeholder="bx-menu-alt-right"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label-md mb-2" for="statusMenu">สถานะการใช้งาน</label>
                    <select id="statusMenu" name="statusMenu" class="form-select select2"
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

            <button type="submit" name="saveMenuMain" id="saveMenuMain" class="btn btn-success btn-form-block-overlay"><i
                    class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript" src="{{ asset('/assets/custom/settings/menu/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
