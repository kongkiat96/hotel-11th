$(document).ready(function () {
    $("#saveMenuMain").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddMenuMain")[0];
        const fv = setupFormValidationMenuMain(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/menu/save-menu-main", formData)
                    .done(onSaveMenuMainSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });

    $("#saveMenuSub").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddMenuSub")[0];
        const fv = setupFormValidationMenuSub(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/menu/save-menu-sub", formData)
                    .done(onSaveMenuSubSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });

    $("#saveAccessMenu").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddAccessMenu")[0];
        // const fv = setupFormValidationAccessMenu(form);
        const formData = new FormData(form);

        // fv.validate().then(function (status) {
        // if (status === 'Valid') {
        postFormData("/settings-system/menu/save-access-menu", formData)
            .done(onSaveAccessMenuSuccess)
            .fail(handleAjaxSaveError);
        // }
        // });
    });

})

function setupFormValidationMenuMain(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            menuName: {
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
            pathMenu: {
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
            iconMenu: {
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
            menuSort: {
                validators: {
                    notEmpty: {
                        message: 'ระบุลําดับเมนู'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            statusMenu: {
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

function setupFormValidationMenuSub(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            menuName: {
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
            pathMenu: {
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
            iconMenu: {
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
            statusMenu: {
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

function onSaveMenuMainSuccess(response) {
    handleAjaxSaveResponse(response);
    if (response.status == 200) {
        closeAndResetModal("#menuMainModal", "#formAddMenuMain");
    }
}

function onSaveMenuSubSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#menuSubModal", "#formAddMenuSub");
}
function onSaveAccessMenuSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#accessMenuModal", "#formAddAccessMenu");
}