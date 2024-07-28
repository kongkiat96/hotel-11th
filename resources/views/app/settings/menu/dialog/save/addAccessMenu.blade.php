<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มรหัสพนักงาน <strong><u>{{ $getUser[0]->emp_code }}</u></strong> เพื่อเข้าถึงเมนู
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formAddAccessMenu" class="form-block">

        <div class="modal-body pt-1">
            <div class="row g-2">
                {{-- <div class="col-md-12 mb-3">
                    <label class="form-label-md mb-2" for="selectUser">เลือกผู้ใช้งาน</label>
                    <select id="selectUser" name="selectUser" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        @foreach ($getUser as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <hr> --}}
                <div class="col-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>เมนูหลัก</th>
                                <th>เมนูย่อย</th>
                                <th>อนุญาตเข้าถึง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // สร้าง array ของ menu_sub_IDs จาก $getAccessMenu
                                $accessMenuSubIDs = $getAccessMenu->pluck('menu_sub_ID')->toArray();
                            @endphp
                            @foreach ($getMenuToAccess as $key => $menu)
                                <tr>
                                    <td>
                                        <i
                                            class="bx {{ $menu->menu_icon }} fs-5 text-info me-3"></i><strong>{{ $menu->menu_name }}</strong>
                                    </td>
                                    <td><i
                                            class="bx {{ $menu->menu_sub_icon }} fs-5 text-warning me-3"></i>{{ $menu->menu_sub_name }}
                                    </td>
                                    <td class="text-center">
                                        {{-- <input type="checkbox" name="access_menu_list[]" value=" {{ $menu->ID }}"> --}}
                                        <input type="checkbox" name="access_menu_list[]" value="{{ $menu->ID }}" @if (in_array($menu->ID, $accessMenuSubIDs)) checked @endif>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <input type="text" name="emp_code" hidden value="{{ $getUser[0]->emp_code }}">
            <input type="text" name="emp_name" hidden value="{{ $getUser[0]->name }}">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                    class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

            <button type="submit" name="saveAccessMenu" id="saveAccessMenu"
                class="btn btn-success btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i>
                บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript"
    src="{{ asset('/assets/custom/settings/menu/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
