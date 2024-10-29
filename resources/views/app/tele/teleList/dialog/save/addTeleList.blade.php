<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มข้อมูลรายการข้อมูลบัญชีที่อายัดในระบบ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <div class="modal-body">
        <form id="formAddTeleList" class="form-block">

            <div class="row g-2">

                <div class="col-md-12 mb-3">
                    <label class="form-label-md mb-2" for="tele_department">แผนก</label>
                    <input type="text" id="tele_department" class="form-control" name="tele_department"
                        id="tele_department" autocomplete="off" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="date_receive">วันที่รับ</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="YYYY-MM-DD"
                        id="date_receive" name="date_receive" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="date_sent">วันที่ส่ง</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="YYYY-MM-DD"
                        id="date_sent" name="date_sent" />

                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="tele_machine">เครื่อง</label>
                    <input type="text" id="tele_machine" class="form-control" name="tele_machine" id="tele_machine"
                        autocomplete="off" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="freeze_account_id">บัญชีที่ยกเลิกการใช้งาน</label>
                    <select id="freeze_account_id" name="freeze_account_id" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        @foreach ($getFreezeAccountList as $key => $value)
                            {{-- <option value="{{ $value->id }}">{{ $value->freeze_account }} [{{ $value->machine_name .' '. $value->bookbank_name }}]</option> --}}
                            <option value="{{ $value->id }}">{{ $value->bookbank_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-mb-12 mb-3">
                    <label class="form-label-md mb-2" for="tele_reason">หมายเหตุ</label>
                    <textarea id="tele_reason" name="tele_reason" rows="3" class="form-control"></textarea>
                </div>

            </div>
        </form>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

        <button type="submit" name="saveTeleDepartment" id="saveTeleDepartment"
            class="btn btn-success btn-form-block-overlay"><i class='menu-icon tf-icons bx bxs-save'></i>
            บันทึกข้อมูล</button>
    </div>

    <script type="text/javascript"
        src="{{ asset('/assets/custom/teleList/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    {{-- <script src="{{ asset('assets/js/forms-extras.js') }}"></script> --}}
    <script>
        const datePickers = ['date_receive', 'date_sent'];
        let datePickerInstances = [];
    
        function initializeDatePickersAA(pickerIds) {
            pickerIds.forEach(function(pickerId) {
                const pickerElement = document.querySelector('#' + pickerId);
                if (pickerElement) {
                    const instance = pickerElement.flatpickr({
                        monthSelectorType: 'static',
                        locale: {
                            firstDayOfWeek: 1,
                            weekdays: {
                                shorthand: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
                                longhand: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์']
                            },
                            months: {
                                shorthand: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                                longhand: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']
                            },
                            rangeSeparator: ' ถึง ',
                            weekAbbreviation: 'สัปดาห์',
                            scrollTitle: 'เลื่อนเพื่อเพิ่ม',
                            toggleTitle: 'คลิกเพื่อสลับ',
                            yearAriaLabel: 'ปี'
                        }
                    });
                    datePickerInstances.push(instance); // เก็บ instance ของ date picker
                }
            });
        }
    

        clearInputDateModal('#addteleDepartmentModal',datePickers);
    </script>
    
