$(function () {
    var dt_datablacklist = $('.dt-datablacklist')
    dt_datablacklist.DataTable({
        processing: true,
        paging: true,
        pageLength: 50,
        deferRender: true,
        ordering: true,
        lengthChange: true,
        bDestroy: true, // เปลี่ยนเป็น true
        scrollX: true,
        fixedColumns: {
            leftColumns: 3
        },

        language: {
            processing:
                '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>',
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        ajax: {
            url: "/import/get-data-blacklist",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: function (d) {
                // return $.extend({}, d, {
                //     "statusOfFreeze": 'Y',
                // });
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    // เริ่มลำดับใหม่ทุกหน้า
                    return meta.row + 1;
                },
            },
            { data: 'first_name', class: "text-center" },
            { data: 'last_name', class: "text-center" },
            { data: 'detail', class: "text-nowrap" },
            // { data: 'flag_blacklist', class: "text-center" },
            { data: "flag_blacklist", class: "text-center", render: renderFlagBlacklistBadge },
            { data: 'created_at', class: "text-center" },
            { data: 'created_user', class: "text-center" },
            { data: 'updated_at', class: "text-center" },
            { data: 'updated_user', class: "text-center" },
            {
                data: 'ID',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: function (data, type, row) {
                    // console.log(row)
                    const Permission = (row.Permission);
                    return renderGroupActionButtonsPermission(data, type, row, 'Blacklist', Permission);
                }
            }

        ],
        columnDefs: [
            {
                // searchable: false,
                // orderable: false,
                targets: 0,
            },
        ],
    });
});

$(document).ready(function () {
    $("#btnImports").on("click", function (e) {
        e.preventDefault();
        var fileInput = $('#filename')[0];
        if (fileInput.files.length === 0) {
            // alert('กรุณาเลือกไฟล์ก่อนดำเนินการ!');
            $('#msgAlert').html('<div class="alert alert-warning alert-bold mt-3" role="alert">กรุณาเลือกไฟล์ก่อนดำเนินการ ! </div>').show();

            return;
        }

        // ตรวจสอบชนิดของไฟล์ที่เลือก
        var fileName = fileInput.files[0].name;
        var fileExtension = fileName.split('.').pop().toLowerCase();
        var allowedExtensions = ['xls', 'xlsx'];

        if (!allowedExtensions.includes(fileExtension)) {
            $('#msgAlert').html('<div class="alert alert-danger alert-bold mt-3" role="alert">กรุณาเลือกไฟล์ที่มีนามสกุล .xls หรือ .xlsx เท่านั้น</div>').show();
            return;
        }

        $("#btnImports").attr("disabled", true);
        $('#msgAlert').html('<div class="alert alert-info alert-bold mt-3" role="alert">กำลังอ่านข้อมูล กรุณารอสักครู่...... <div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>').show();
        var form = $('#frmImport')[0];
        var formData = new FormData(form);

        $.ajax({
            url: "/import/import-data-blacklist",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            async: true,
            success: function (data) {
                $("#btnImports").attr("disabled", true);
                if (data.status !== true) {
                    $('#msgAlert').html('<div class="alert alert-solid-danger alert-bold mt-3" role="alert"><div class="alert-text">รูปแบบไฟล์ไม่ถูกต้อง กรุณาเลือกไฟล์ใหม่</div></div>');
                } else {
                    $('#msgAlert').html('<div class="alert alert-solid-info alert-bold mt-3" role="alert"><div class="alert-text">กำลังอ่านข้อมูล กรุณารอสักครู่...... <div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div></div>').hide();
                    
                    // $('#data-import-table').show();
                    Swal.fire({
                        text: "นำเข้าข้อมูลสําเร็จ",
                        icon: "success",
                        confirmButtonText: "ตกลง",
                    }).then(() => {
                        location.reload();
                    });
                }
            },
            error: function (err) {
                // console.log('err=msg=' + err);
                Swal.fire(Error + ': ' + err, "", "error");
            }
        });
    });
});

function reTable(){
    $('.dt-datablacklist').DataTable().ajax.reload();
}

function funcEditBlacklist(BlacklistID) {
    showModalWithAjax('#editBlacklistModal', '/import/show-edit-blacklist-modal/' + BlacklistID,["#flag_blacklist"]);
}

function funcDeleteBlacklist(BlacklistID) {
    handleAjaxDeleteResponse(BlacklistID, "/import/delete-blacklist/" + BlacklistID);
}

function funcViewBlacklist(BlacklistID) {
    showModalViewWithAjax('#viewBlacklistModal', '/import/view-blacklist/' + BlacklistID,["#flag_blacklist"]);
}

function setupFormValidationBlacklist(formElement) {
    const validators = {
        notEmpty: message => ({
            validators: {
                notEmpty: { message }
            }
        }),
        notEmptyAndRegexp: (message, regexp) => ({
            validators: {
                notEmpty: { message },
                regexp: { regexp, message: 'ข้อมูลไม่ถูกต้อง' }
            }
        }),
    };
    const validationRules = {
        first_name: validators.notEmpty('ระบุชื่อ'),
        last_name: validators.notEmpty('ระบุนามสกุล'),
        flag_blacklist: validators.notEmpty('เลือกข้อมูล สถานะ'),
    };

    return FormValidation.formValidation(formElement, {
        fields: validationRules,
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.col-md-6'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
    });
}