<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขข้อมูลรายการที่อยู่เอเย่นต์</h5>
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

        <button type="submit" name="saveEditAgentAddress" id="saveEditAgentAddress"
            class="btn btn-warning btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i>
            บันทึกข้อมูล</button>
    </div>

    <script type="text/javascript" src="{{ asset('/assets/custom/address/agentAddress/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    
