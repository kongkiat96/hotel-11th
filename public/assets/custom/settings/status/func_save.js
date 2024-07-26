$(document).ready(function () {
    $("#saveStatus").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddStatus")[0];
        const fv = setupFormValidationStatus(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/work-status/save-status", formData)
                    .done(onSaveStatusSuccess)
                    .fail(handleAjaxSaveError);
            }
        })
    });

    $("#saveFlagType").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddFlagType")[0];
        const fv = setupFormValidationFlagType(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/work-status/save-flag-type", formData)
                    .done(onSaveFlagTypeSuccess)
                    .fail(handleAjaxSaveError);
            }
        })
    })
})

function onSaveStatusSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#addStatusModal", "#formAddStatus");
}

function setupFormValidationStatus(formElement){
    return FormValidation.formValidation(formElement, {
        fields: {
            statusName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุ ชื่อสถานะ'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s./]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            statusUse: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล รูปแบบการใช้งาน'
                    }
                }
            },
            flagType: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล ประเภทสถานะ'
                    }
                }
            },
            statusOfStatus: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล สถานะการใช้งาน'
                    }
                }
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.col-md-6'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        }
    })
}

function onSaveFlagTypeSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#addFlagTypeModal", "#formAddFlagType");
}

function setupFormValidationFlagType(formElement){
    return FormValidation.formValidation(formElement, {
        fields: {
            flagName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุ ชื่อรูปแบบสถานะงาน'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s./]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            typeWork: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล ประเภทสถานะ'
                    }
                }
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.col-md-6'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        }
    })
}
