<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขรายการธนาคาร</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-5">
                <form action="/upload" class="dropzone needsclick ml-1" id="edit_pic-bank">
                    <div class="dz-message needsclick">
                        อัพโหลดรูปธนาคาร
                        <span class="note needsclick">(กรณีต้องการเพิ่มรูปภาพธนาคาร)</span>
                    </div>
                    <div class="fallback">
                        <input name="file" id="edit_pic-bank" type="file" />
                    </div>
                    <input type="hidden" name="delete_bank_logo" id="delete_bank_logo" value="1">

                </form>
            </div>

            <div class="col-md-7">
                <form id="formEditBank" class="form-block">
                    <div class="col-md-12 mb-3">
                        <label class="form-label-md mb-2" for="edit_bankName">ชื่อธนาคาร (เต็ม)</label>
                        <input type="text" id="edit_bankName" class="form-control" name="edit_bankName"
                            autocomplete="off" value="{{ $getEditBank->bank_name }}" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label-md mb-2" for="edit_bankNameShort">ชื่อธนาคาร (ย่อ)</label>
                        <input type="text" id="edit_bankNameShort" class="form-control" name="edit_bankNameShort"
                            autocomplete="off" value="{{ $getEditBank->bank_short_name }}" />
                    </div>

                    <div class="col-md-12">
                        <label class="form-label-md mb-2" for="edit_statusOfBank">สถานะการใช้งาน</label>
                        <select id="edit_statusOfBank" name="edit_statusOfBank" class="form-select select2"
                            data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="1" @if ($getEditBank->status == 1) selected @endif>กำลังใช้งาน
                            </option>
                            <option value="0" @if ($getEditBank->status == 0) selected @endif>ปิดการใช้งาน
                            </option>
                        </select>
                    </div>
                    <input type="text" value="{{ $getEditBank->ID }}" name="bankID" id="bankID" hidden>
                </form>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                    class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
            <button type="submit" name="saveEditBank" id="saveEditBank"
                class="btn btn-warning btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i>
                บันทึกข้อมูล</button>
        </div>
    </div>

    <script type="text/javascript"
        src="{{ asset('/assets/custom/settings/banks/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script>
        ViewPicEdit("{{ $getEditBank->bank_logo ? asset('storage/public/uploads/banks/' . $getEditBank->bank_logo) : asset('storage/public/uploads/not-found.jpg') }}",'#edit_pic-bank','#delete_bank_logo');
    </script>
</div>
