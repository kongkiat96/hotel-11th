<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">เพิ่มข้อมูลรายการข้อมูลบัญชีที่อายัดในระบบ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <div class="modal-body">
        <form id="formAddFreezeAccount" class="form-block">

            <div class="row g-2">

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="freeze_account">ชื่อแผนก</label>
                    <input type="text" id="freeze_account" class="form-control" name="freeze_account" autocomplete="off" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="machine_name">ชื่อเครื่อง</label>
                    <input type="text" id="machine_name" class="form-control" name="machine_name"
                        autocomplete="off" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="bookbank_name">ชื่อบัญชี</label>
                    <input type="text" id="bookbank_name" class="form-control" name="bookbank_name" id="bookbank_name"
                        autocomplete="off" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="account_number">หมายเลขบัญชี</label>
                    <input type="text" id="account_number" class="form-control" name="account_number" id="account_number"
                        autocomplete="off" />
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="bank_id">ธนาคาร</label>
                    <select id="bank_id" name="bank_id" class="form-select select2" data-allow-clear="true">
                        <option value="">Select</option>
                                @foreach ($getBankList as $key => $value)
                                    <option value="{{ $value->ID }}" data-image="{{ asset('storage/public/uploads/banks/' . $value->bank_logo) }}">{{ $value->bank_name }} ({{ $value->bank_short_name }})</option>
                                @endforeach

                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="amount_total">ยอดค้างในบัญชี</label>
                    <div class="input-group">
                        <input type="text" id="amount_total" name="amount_total" class="form-control numeral-mask"
                            placeholder="ระบุจำนวนเงิน" />

                        <span class="input-group-text" id="amount_total">฿</span>

                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label-md mb-2" for="status_freeze">สถานะการอายัด</label>
                    <select id="status_freeze" name="status_freeze" class="form-select select2" data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="Y">อายัดในระบบ</option>
                        <option value="N">ยกเลิกการอายัด</option>
                    </select>
                </div>

                <div class="col-mb-12 mb-3">
                    <label class="form-label-md mb-2" for="reason_freeze">หมายเหตุ</label>
                    <textarea id="reason_freeze" name="reason_freeze" rows="3" class="form-control"></textarea>
                </div>

            </div>
            <input type="hidden" id="tag_freeze" name="tag_freeze" value="department">
        </form>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

        <button type="submit" name="saveFreeze" id="saveFreeze" class="btn btn-success btn-form-block-overlay"><i
                class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
    </div>

    <script type="text/javascript" src="{{ asset('/assets/custom/freezeAccount/department/func_save.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script>
        // Initialize Select2 when the modal is shown
        $('#addFreezeAccountDepartmentModal').on('shown.bs.modal', function() {
            $('#bank_id').select2({
                placeholder: 'เลือกข้อมูล',
                allowClear: true, // Ensures the clear option is available
                dropdownParent: $(
                    '#addFreezeAccountDepartmentModal'), // Ensures dropdown appears within the modal
                templateResult: formatState,
                templateSelection: formatState,
                escapeMarkup: function(markup) {
                    return markup;
                }
            });

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var imageUrl = $(state.element).data('image');
                var markup = `
                    <div class="select2-option">
                        <img src="${imageUrl}" class="img-thumbnail" style="width: 30px; height: 30px; margin-right: 10px; vertical-align: middle;" />
                        <span style="vertical-align: middle;">${state.text}</span>
                    </div>`;
                return markup;
            }
        });
    </script>
    <style>
        .select2-option {
            display: flex;
            align-items: center;
            /* Center vertically */
        }

        .select2-option img {
            margin-right: 10px;
            /* Space between image and text */
        }
    </style>
