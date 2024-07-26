<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขชื่อบริษัท</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formEditCompany" class="form-block">
        <div class="modal-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label" for="edit_companyNameTH">ชื่อบริษัท (ภาษาไทย)</label>
                    <input type="text" id="edit_companyNameTH" class="form-control" name="edit_companyNameTH"
                        autocomplete="off" value="{{ $dataCompany[0]->company_name_th }}"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_companyNameEN">ชื่อบริษัท (ภาษาอังกฤษ)</label>
                    <input type="text" id="edit_companyNameEN" class="form-control" name="edit_companyNameEN"
                        autocomplete="off" value="{{ $dataCompany[0]->company_name_en }}"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="edit_statusOfCompany">สถานะการใช้งาน</label>
                    <select id="edit_statusOfCompany" name="edit_statusOfCompany" class="form-select select2" data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="1" @if ($dataCompany[0]->status == 1) selected @endif>กำลังใช้งาน</option>
                        <option value="0" @if ($dataCompany[0]->status == 0) selected @endif>ปิดการใช้งาน</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
            <input type="text" hidden name="comID" id="comID" value="{{ $dataCompany[0]->ID  }}">
            <button type="submit" name="saveEditCompany" id="saveEditCompany"
                class="btn btn-warning btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>
</div>

<script type="text/javascript" src="{{ asset('/assets/custom/settings/aboutCompany/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
