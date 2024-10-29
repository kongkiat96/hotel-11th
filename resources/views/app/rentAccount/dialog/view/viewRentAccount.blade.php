<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขข้อมูลรายการข้อมูลแจ้งขอเช่าบัญชี</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <div class="modal-body">
        <form id="formEditRentAccount" class="form-block">

            <div class="row g-2">

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="rent_department">แผนก</label>
                    <input type="text" id="rent_department" class="form-control" name="rent_department"
                        id="rent_department" autocomplete="off" value="{{ $dataRentAccount->rent_department }}"/>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="rent_total">จำนวนบัญชี</label>
                    <input type="text" id="rent_total" name="rent_total" class="form-control numeral-mask" placeholder="ระบุจำนวนบัญชี" value="{{ number_format($dataRentAccount->rent_total,0) }}"/>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="edit_date_request_rent">วันที่แจ้งขอเช่าบัญชี</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="YYYY-MM-DD"
                        id="edit_date_request_rent" name="edit_date_request_rent" value="{{ $dataRentAccount->date_request_rent }}"/>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="edit_date_sent">วันที่ส่งบัญชี</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="YYYY-MM-DD"
                        id="edit_date_sent" name="edit_date_sent" value="{{ $dataRentAccount->date_sent }}"/>

                </div>

                <div class="col-mb-12 mb-3">
                    <label class="form-label-md mb-2" for="rent_reason">หมายเหตุ</label>
                    <textarea id="rent_reason" name="rent_reason" rows="3" class="form-control">{{ $dataRentAccount->rent_reason }}</textarea>
                </div>

            </div>
        </form>

        <input type="hidden" id="rentAccountID" name="rentAccountID" value="{{ $dataRentAccount->id }}">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
    </div>

    
