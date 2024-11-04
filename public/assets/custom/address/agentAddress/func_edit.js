$(document).ready(function () {
    $("#saveEditAgentAddress").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditAgentAddress")[0];
        const AgentAddressID = $('#AgentAddressID').val();
        const fv = setupFormValidationAgentAddress(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/address/agent-address/edit-agent-address/" + AgentAddressID, formData)
                    .done(onSaveEditAgentAddressSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationAgentAddress(formElement) {
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
        address_department: validators.notEmptyAndRegexp('ระบุชื่อ แผนก', /^[a-zA-Z0-9ก-๏\s]+$/u),
        employee_total: validators.notEmptyAndRegexp('ระบุ จำนวน', /^[0-9,]+(\.[0-9]{1,2})?$/u),

    };

    return FormValidation.formValidation(formElement, {
        fields: validationRules,
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.col-md-8, .col-md-4'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
    });
}

function onSaveEditAgentAddressSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editAgentAddressModal", "#formEditAgentAddress");
}