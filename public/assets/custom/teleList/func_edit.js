$(document).ready(function () {
    $("#saveEditTeleDepartment").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditTeleList")[0];
        const teleDepartmentID = $('#teleDepartmentID').val();
        const fv = setupFormValidationEditTeleList(form);
        const formData = new FormData(form);
        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/tele/telelist/edit-telelist/" + teleDepartmentID, formData)
                    .done(onSaveEditTeleListSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationEditTeleList(formElement) {
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
        dateValidator: message => ({
            validators: {
                notEmpty: { message },
                date: {
                    format: 'YYYY-MM-DD', // กำหนดรูปแบบที่ต้องการ
                    message: 'วันที่ไม่ถูกต้อง'
                }
            }
        })
    };

    const validationRules = {
        tele_department: validators.notEmptyAndRegexp('ระบุชื่อ แผนก', /^[a-zA-Z0-9ก-๏\s]+$/u),
        tele_machine: validators.notEmptyAndRegexp('ระบุชื่อ เครื่อง', /^[a-zA-Z0-9ก-๏\s]+$/u),
        edit_date_receive: validators.dateValidator('ระบุ วันที่รับ'),
        freeze_account_id: validators.notEmpty('เลือกข้อมูล ธนาคาร'),
        // status_freeze: validators.notEmpty('เลือกข้อมูล สถานะการอายัด')

    };

    return FormValidation.formValidation(formElement, {
        fields: validationRules,
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.col-md-6, .col-md-12'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
    });
}

function onSaveEditTeleListSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editTeleDepartmentModal", "#formEditTeleList");
}