<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขข้อมูลรายการข้อมูลบัญชีที่อายัดในระบบ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <div class="modal-body">
        <form id="formEditTeleList" class="form-block">

            <div class="row g-2">

                <div class="col-md-12 mb-3">
                    <label class="form-label-md mb-2" for="tele_department">แผนก</label>
                    <input type="text" id="tele_department" class="form-control" name="tele_department"
                        id="tele_department" autocomplete="off" value="{{ $getTeleList->tele_department }}" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="edit_date_receive">วันที่รับ</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="YYYY-MM-DD"
                        id="edit_date_receive" name="edit_date_receive" value="{{ $getTeleList->date_receive }}" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="edit_date_sent">วันที่ส่ง</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="YYYY-MM-DD"
                        id="edit_date_sent" name="edit_date_sent" value="{{ $getTeleList->date_sent }}" />

                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="tele_machine">เครื่อง</label>
                    <input type="text" id="tele_machine" class="form-control" name="tele_machine" id="tele_machine"
                        autocomplete="off" value="{{ $getTeleList->tele_machine }}" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="freeze_account_id">บัญชีที่ยกเลิกการใช้งาน</label>
                    <select id="freeze_account_id" name="freeze_account_id" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        @foreach ($getFreezeAccountList as $key => $value)
                            <option value="{{ $value->id }}" @if ($getTeleList->freeze_account_id == $value->id) selected @endif>{{ $value->bookbank_name }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="col-mb-12 mb-3">
                    <label class="form-label-md mb-2" for="tele_reason">หมายเหตุ</label>
                    <textarea id="tele_reason" name="tele_reason" rows="3" class="form-control">{{ $getTeleList->tele_reason }}</textarea>
                </div>

            </div>
        </form>

<input type="hidden" name="teleDepartmentID" id="teleDepartmentID" value="{{ $getTeleList->id }}">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

        <button type="submit" name="saveEditTeleDepartment" id="saveEditTeleDepartment"
            class="btn btn-warning btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i>
            บันทึกข้อมูล</button>
    </div>

    <script type="text/javascript"
        src="{{ asset('/assets/custom/teleList/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    {{-- <script src="{{ asset('assets/js/forms-extras.js') }}"></script> --}}
    <script>
        var datePickers = ['edit_date_receive', 'edit_date_sent'];
        initializeDatePickers(datePickers);
        clearInputDateModal('#editTeleDepartmentModal',datePickers);
    </script>
    
