<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มรายการธนาคาร</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-5">
                <form action="/upload" class="dropzone needsclick ml-1" id="pic-bank">
                    <div class="dz-message needsclick">
                        อัพโหลดรูปธนาคาร
                        <span class="note needsclick">(กรณีต้องการเพิ่มรูปภาพธนาคาร)</span>
                    </div>
                    <div class="fallback">
                        <input name="file" id="pic-bank" type="file" />
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <form id="formAddBank" class="form-block">

                    <div class="col-md-12 mb-3">
                        <label class="form-label-md mb-2" for="bankName">ชื่อธนาคาร (เต็ม)</label>
                        <input type="text" id="bankName" class="form-control" name="bankName" autocomplete="off" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label-md mb-2" for="bankNameShort">ชื่อธนาคาร (ย่อ)</label>
                        <input type="text" id="bankNameShort" class="form-control" name="bankNameShort" autocomplete="off" />
                    </div>

                    <div class="col-md-12">
                        <label class="form-label-md mb-2" for="statusOfBank">สถานะการใช้งาน</label>
                        <select id="statusOfBank" name="statusOfBank" class="form-select select2"
                            data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="1">กำลังใช้งาน</option>
                            <option value="0">ปิดการใช้งาน</option>
                        </select>
                    </div>
                </form>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                    class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

            <button type="submit" name="saveBank" id="saveBank" class="btn btn-success btn-form-block-overlay"><i
                    class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('/assets/custom/settings/banks/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script>
        AddPic('#pic-bank');
    </script>
