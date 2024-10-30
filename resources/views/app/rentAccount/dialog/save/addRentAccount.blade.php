<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มข้อมูลรายการแจ้งขอเช่าบัญชี</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <div class="modal-body">
        <form id="formAddRentAccount" class="form-block">

            <div class="row g-2">

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="rent_department">แผนก</label>
                    <input type="text" id="rent_department" class="form-control" name="rent_department"
                        id="rent_department" autocomplete="off" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="rent_total">จำนวนบัญชี</label>
                    <input type="text" id="rent_total" name="rent_total" class="form-control numeral-mask" placeholder="ระบุจำนวนบัญชี" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="date_request_rent">วันที่แจ้งขอเช่าบัญชี</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="YYYY-MM-DD"
                        id="date_request_rent" name="date_request_rent" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="date_sent">วันที่ส่งบัญชี</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="YYYY-MM-DD"
                        id="date_sent" name="date_sent" />

                </div>

                <div class="col-mb-12 mb-3">
                    <label class="form-label-md mb-2" for="rent_reason">หมายเหตุ</label>
                    <textarea id="rent_reason" name="rent_reason" rows="3" class="form-control"></textarea>
                </div>

            </div>
        </form>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

        <button type="submit" name="saveRentAccount" id="saveRentAccount"
            class="btn btn-success btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i>
            บันทึกข้อมูล</button>
    </div>

    <script type="text/javascript"
        src="{{ asset('/assets/custom/rentAccount/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script>
        var datePickers = ['date_request_rent', 'date_sent'];
        initializeDatePickers(datePickers);
        clearInputDateModal('#addRentAccountModal',datePickers);
    </script>
    
