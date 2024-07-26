        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มรายการสถานะ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <form id="formAddStatus" class="form-block">
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label" for="statusName">รายการสถานะ</label>
                            <input type="text" id="statusName" class="form-control" name="statusName"
                                autocomplete="off" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="statusUse">รูปแบบการใช้งาน</label>
                            <select id="statusUse" name="statusUse" class="form-select select2" data-allow-clear="true">
                                <option value="">Select</option>
                                <option value="it">ใช้งานฝ่าย IT</option>
                                <option value="building">ใช้งานฝ่ายอาคาร</option>
                                <option value="hr">ใช้งานฝ่าย HR</option>
                                <option value="all">ใช้งานทุกระบบ</option>
                            </select>
                        </div>
                        {{-- {{ dd($flagType) }} --}}
                        <div class="col-md-6">
                            <label class="form-label" for="flagType">รูปแบบสถานะทำงาน</label>
                            <select id="flagType" name="flagType" class="form-select select2" data-allow-clear="true">
                                <option value="">Select</option>
                                @foreach ($getFlagType as $key => $value)
                                    <option value="{{ $value->ID }}">
                                        {{ $value->flag_name }} / {{ $value->type_work }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="statusOfStatus">สถานะการใช้งาน</label>
                            <select id="statusOfStatus" name="statusOfStatus" class="form-select select2"
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

                    <button type="submit" name="saveStatus" id="saveStatus"
                        class="btn btn-success btn-form-block-overlay"><i
                            class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
                </div>
            </form>
        </div>

        <script type="text/javascript" src="{{ asset('/assets/custom/settings/status/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
