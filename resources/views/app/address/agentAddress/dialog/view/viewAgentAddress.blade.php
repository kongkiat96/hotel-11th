<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">ตรวจสอบข้อมูลรายการที่อยู่เอเย่นต์</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <div class="modal-body">
        <form id="formEditAgentAddress" class="form-block">

            <div class="row g-2">

                <div class="col-md-8 mb-3">
                    <label class="form-label-md mb-2" for="address_department">แผนก</label>
                    <input type="text" id="address_department" class="form-control" name="address_department"
                        id="address_department" autocomplete="off" value="{{ $dataAgentAddress->address_department }}"/>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label-md mb-2" for="employee_total">จำนวนพนักงาน</label>
                    <input type="text" id="employee_total" name="employee_total" class="form-control numeral-mask" placeholder="ระบุจำนวนพนักงาน" value="{{ $dataAgentAddress->employee_total }}"/>
                </div>

                <div class="col-mb-12 mb-3">
                    <label class="form-label-md mb-2" for="space_working">ภายนอกพื้นที่ทำงานบริษัท</label>
                    <textarea id="space_working" name="space_working" rows="3" class="form-control">{{ $dataAgentAddress->space_working }}</textarea>
                </div>

            </div>
        </form>

        <input type="hidden" id="AgentAddressID" name="AgentAddressID" value="{{ $dataAgentAddress->id }}">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
    </div>

    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    
