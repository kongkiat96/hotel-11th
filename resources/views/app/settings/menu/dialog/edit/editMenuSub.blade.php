<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มรายชื่อเมนู (ย่อย)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formEditMenuSub" class="form-block">

        <div class="modal-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label" for="menuMain">ชื่อเมนูหลัก</label>
                    <select id="menuMain" name="menuMain" class="form-select select2" data-allow-clear="true">
                        <option value="">Select</option>
                        @foreach ($getMenuMain as $key => $value)
                            <option value="{{ $value->ID }}" @if ($dataMenuSub[0]->menu_main_ID == $value->ID ) selected @endif>
                                {{ $value->menu_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_menuName">ชื่อเมนู</label>
                    <input type="text" id="edit_menuName" class="form-control" name="edit_menuName"
                        autocomplete="off" value="{{ $dataMenuSub[0]->menu_sub_name }}"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_pathMenu">Path Menu</label>
                    <input type="text" id="edit_pathMenu" class="form-control" name="edit_pathMenu"
                        autocomplete="off" placeholder="(Route::get), Ex : settings-system" value="{{ $dataMenuSub[0]->menu_sub_link }} "/>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_iconMenu">Icon Menu <a href="https://boxicons.com/" target="_blank"><i class="fa fa-question-circle"></i></a></label>
                    <input type="text" id="edit_iconMenu" class="form-control" name="edit_iconMenu"
                        autocomplete="off" placeholder="bx-menu-alt-right" value="{{ $dataMenuSub[0]->menu_sub_icon }} "/>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_statusMenu">สถานะการใช้งาน</label>
                    <select id="edit_statusMenu" name="edit_statusMenu" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="1" {{ $dataMenuSub[0]->status == 1 ? 'selected' : '' }}>กำลังใช้งาน</option>
                        <option value="0" {{ $dataMenuSub[0]->status == 0 ? 'selected' : '' }}>ปิดการใช้งาน</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
            <input type="text" show name="menuSubID" id="menuSubID" hidden value="{{ $dataMenuSub[0]->ID }}">
            <button type="submit" name="saveEditMenuSub" id="saveEditMenuSub"
                class="btn btn-warning btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript" src="{{ asset('/assets/custom/settings/menu/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
