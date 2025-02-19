<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">แก้ไขรายการข้อมูล Blacklist</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <hr>
    <form id="formEditBlacklist" class="form-block">
        <div class="modal-body pt-1">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label-md mb-2" for="first_name">ชื่อ</label>
                    <input type="text" id="first_name" class="form-control" name="first_name"
                        autocomplete="off" value="{{ $dataBlacklist->first_name }}"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label-md mb-2" for="last_name">นามสกุล</label>
                    <input type="text" id="last_name" class="form-control" name="last_name"
                        autocomplete="off" value="{{ $dataBlacklist->last_name }}"/>
                </div>

                <div class="col-md-6">
                    <label class="form-label-md mb-2" for="flag_blacklist">สถานะ</label>
                    <select id="flag_blacklist" name="flag_blacklist" class="form-select select2"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="Y" @if ($dataBlacklist->flag_blacklist == 'Y') selected @endif>Blacklist</option>
                        <option value="N" @if ($dataBlacklist->flag_blacklist == 'N') selected @endif>Un Blacklist</option>
                    </select>
                </div>

                <div class="col-mb-12 mb-3">
                    <label class="form-label-md mb-2" for="detail">หมายเหตุ</label>
                    <textarea id="detail" name="detail" rows="3" class="form-control" autocomplete="off">{{ $dataBlacklist->detail }}</textarea>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i
                    class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>
                <input type="text"  name="id" hidden id="id" value="{{ $dataBlacklist->id  }}">
            <button type="submit" name="saveEditBlacklist" id="saveEditBlacklist" class="btn btn-warning btn-form-block-overlay"><i
                    class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
        </div>
    </form>

</div>

<script type="text/javascript" src="{{ asset('/assets/custom/import/func_edit.js?v=') }}@php echo date("H:i:s") @endphp"></script>
