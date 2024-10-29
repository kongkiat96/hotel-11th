$(document).ready(function () {
    $("#saveRentAccount").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddRentAccount")[0];
        const fv = setupFormValidationRentAccount(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/accounting/rent-account/save-rent-account", formData)
                    .done(onSaveRentAccountSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationRentAccount(formElement) {
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
        rent_department: validators.notEmptyAndRegexp('ระบุชื่อ แผนก', /^[a-zA-Z0-9ก-๏\s]+$/u),
        rent_total: validators.notEmptyAndRegexp('ระบุ จำนวน', /^[0-9,]+(\.[0-9]{1,2})?$/u),
        date_request_rent: validators.dateValidator('ระบุ วันที่รับ'),

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

function onSaveRentAccountSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#addRentAccountModal", "#formAddRentAccount");
}