<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มรายชื่อผู้ใช้งานเพื่อเข้าถึงเมนู</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formAddMenuMain" class="form-block">

        <div class="modal-body pt-1">
            <div class="row g-2">
                <div class="col-md-12 mb-3">
                    <label class="form-label-md mb-2" for="selectEmployee">สถานะการใช้งาน</label>
                    <select id="selectEmployee" name="selectEmployee" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="1">กำลังใช้งาน</option>
                        <option value="0">ปิดการใช้งาน</option>
                    </select>
                </div>
                <hr>
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>เมนูหลัก</th>
                                <th>เมนูย่อย</th>
                                <th>อนุญาติเข้าถึง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getMenuToAccess as $key => $menu)
                                <tr>
                                    <td>
                                        {{-- <i class="fab fa-angular fa-lg text-danger me-3"></i>  --}}
                                        <i class="bx {{ $menu->menu_icon }} fs-5 text-info me-3"></i><strong>{{ $menu->menu_name }}</strong>
                                    </td>
                                    <td><i class="bx {{ $menu->menu_sub_icon }} fs-5 text-warning me-3"></i><strong>{{ $menu->menu_sub_name }}</strong></td>
                                    <td class="text-center">
                                        <input type="checkbox" name="access_menu_list[]" value=" {{ $menu->ID }}">
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                    class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

            <button type="submit" name="saveMenuMain" id="saveMenuMain"
                class="btn btn-success btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i>
                บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript"
    src="{{ asset('/assets/custom/settings/menu/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
