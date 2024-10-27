$(document).ready(function () {
    $("#saveEditFreezeAgent").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditFreezeAccount")[0];
        const fv = setupFormValidationEditFreezeAccount(form);
        const freezeID = $('#freezeID').val();
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/freeze-account/agent/edit-freezeAccount-agent/" + freezeID, formData)
                    .done(onSaveEditFreezeSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationEditFreezeAccount(formElement) {
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
        })
    };

    const validationRules = {
        freeze_account: validators.notEmptyAndRegexp('ระบุชื่อ เอเย่นต์', /^[a-zA-Z0-9ก-๏\s]+$/u),
        machine_name: validators.notEmptyAndRegexp('ระบุชื่อ ชื่อเครื่อง', /^[a-zA-Z0-9ก-๏\s]+$/u),
        bookbank_name: validators.notEmptyAndRegexp('ระบุชื่อ ชื่อบัญชี', /^[a-zA-Z0-9ก-๏\s]+$/u),
        account_number: validators.notEmptyAndRegexp('ระบุชื่อ หมายเลขบัญชี', /^[0-9,]+(\.[0-9]{1,2})?$/u),
        amount_total: validators.notEmptyAndRegexp('ระบุชื่อ ยอดค้างในบัญชี', /^[0-9,]+(\.[0-9]{1,2})?$/u),
        bank_id: validators.notEmpty('เลือกข้อมูล ธนาคาร'),
        status_freeze: validators.notEmpty('เลือกข้อมูล สถานะการอายัด')

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

function onSaveEditFreezeSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editFreezeAccountAgentModal", "#formEditFreezeAccount");
}