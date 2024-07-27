$(document).ready(function () {
    $("#saveEditMenuMain").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditMenuMain")[0];
        const menuMainID = $('#menuMainID').val();
        const fv = setupFormValidationEditMenuMain(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/menu/edit-menu-main/" + menuMainID, formData)
                    .done(onSaveEditMenuMainSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationEditMenuMain(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            edit_menuName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อ เมนู'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_pathMenu: {
                validators: {
                    notEmpty: {
                        message: 'ระบุ path เมนู'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s\-]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_iconMenu: {
                validators: {
                    notEmpty: {
                        message: 'ระบุ icon เมนู'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s\-]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_statusMenu: {
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
        },
    });
}

function onSaveEditMenuMainSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editMenuMainModal", "#formEditMenuMain");
}

$(document).ready(function () {
    $("#saveEditMenuSub").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditMenuSub")[0];
        const menuSubID = $('#menuSubID').val();
        const fv = setupFormValidationEditMenuSub(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/menu/edit-menu-sub/" + menuSubID, formData)
                    .done(onSaveEditMenuSubSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
})

function setupFormValidationEditMenuSub(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            edit_menuName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อ เมนู'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_pathMenu: {
                validators: {
                    notEmpty: {
                        message: 'ระบุ path เมนู'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s\-]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_iconMenu: {
                validators: {
                    notEmpty: {
                        message: 'ระบุ icon เมนู'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s\-]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            menuMain: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล เมนูหลัก'
                    }
                }
            },
            edit_statusMenu: {
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
        },
    });
}

function onSaveEditMenuSubSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editMenuSubModal", "#formEditMenuSub");
}