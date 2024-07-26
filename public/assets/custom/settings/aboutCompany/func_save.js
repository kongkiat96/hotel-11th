$(document).ready(function () {
    $("#saveCompany").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddCompany")[0];
        const fv = setupFormValidationCompany(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/save-company", formData)
                    .done(onSaveCompanySuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });

    $("#saveDepartment").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddDepartment")[0];
        const fv = setupFormValidationDepartment(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/save-department", formData)
                    .done(onSaveDepartmentSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });

    $("#saveGroup").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddGroup")[0];
        const fv = setupFormValidationGroup(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/save-group", formData)
                    .done(onSaveGroupSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });

    $("#savePrefixName").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddPrefixName")[0];
        const fv = setupFormValidationPrefixName(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/save-prefix-name", formData)
                    .done(onSavePrefixNameSuccess)
                    .fail(handleAjaxSaveError);
            }
        })
    });

    $('#saveClassList').on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddClassList")[0];
        const fv = setupFormValidationClassList(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/save-class-list", formData)
                    .done(onSaveClassListSuccess)
                    .fail(handleAjaxSaveError);
            }
        })
    })
});

function onSaveCompanySuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#companyModal", "#formAddCompany");
}
function onSaveDepartmentSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#departmentModal", "#formAddDepartment");
}
function onSaveGroupSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#groupModal", "#formAddGroup");
}

function onSavePrefixNameSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#prefixNameModal", "#formAddPrefixName");
}

function onSaveClassListSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#classListModal", "#formAddClassList");
}

function setupFormValidationCompany(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            companyNameTH: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อ บริษัท (ภาษาไทย)'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            companyNameEN: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อ บริษัท (ภาษาอังกฤษ)'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            statusOfCompany: {
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

function setupFormValidationDepartment(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            departmentName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อสังกัด / ฝ่าย'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            company: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล บริษัท'
                    }
                }
            },
            statusOfDepartment: {
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

function setupFormValidationGroup(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            groupName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อแผนก'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            companyForGroup: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล บริษัท'
                    }
                }
            },
            department: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล สังกัด / ฝ่าย'
                    }
                }
            },
            statusOfGroup: {
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

function setupFormValidationPrefixName(formElement){
    return FormValidation.formValidation(formElement, {
        fields: {
            prefixName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุคํานําหน้าชื่อ'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s.]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            statusOfPrefixName: {
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

function setupFormValidationClassList(formElement){
    return FormValidation.formValidation(formElement, {
        fields: {
            className: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อระดับตำแหน่ง'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s.]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            statusOfClassList: {
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
