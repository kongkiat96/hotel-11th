$(document).ready(function () {
    $("#saveTeleDepartment").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddTeleList")[0];
        const fv = setupFormValidationTeleList(form);
        const formData = new FormData(form);
        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/tele/telelist/save-telelist", formData)
                    .done(onSaveTeleListSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationTeleList(formElement) {
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
        date_receive: validators.dateValidator('ระบุ วันที่รับ'),
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

function onSaveTeleListSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#addteleDepartmentModal", "#formAddTeleList");
}