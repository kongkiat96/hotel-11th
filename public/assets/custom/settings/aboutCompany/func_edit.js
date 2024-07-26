$(document).ready(function () {
    $("#saveEditCompany").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditCompany")[0];
        const companyID = $('#comID').val();
        const fv = setupFormValidationEditCompany(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/edit-company/" + companyID, formData)
                    .done(onSaveEditCompanySuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationEditCompany(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            edit_companyNameTH: {
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
            edit_companyNameEN: {
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
            edit_statusOfCompany: {
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

function onSaveEditCompanySuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editCompanyModal", "#formEditCompany");
}

$(document).ready(function () {
    $("#saveEditDepartment").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditDepartment")[0];
        const departmentID = $('#depID').val();
        const fv = setupFormValidationEditDepartment(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/edit-department/" + departmentID, formData)
                    .done(onSaveEditDepartmentSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationEditDepartment(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            edit_departmentName: {
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
            edit_company: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล บริษัท'
                    }
                }
            },
            edit_statusOfDepartment: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล สถานะการใช้งาน'
                    }
                }
            }
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
    });
}

function onSaveEditDepartmentSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editDepartmentModal", "#formEditDepartment");
}

$(document).ready(function () {
    $("#saveEditGroup").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditGroup")[0];
        const groupID = $('#groupID').val();
        const fv = setupFormValidationEditGroup(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/edit-group/" + groupID, formData)
                    .done(onSaveEditGroupSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});
function setupFormValidationEditGroup(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            edit_groupName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อกลุ่มงาน'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_companyForGroup: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล ชื่อบริษัท'
                    }
                }
            },
            edit_department: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล สังกัด / ฝ่าย'
                    }
                }
            },
            edit_statusOfGroup: {
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
    });
}

function onSaveEditGroupSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editGroupModal", "#formEditGroup");
}

$(document).ready(function () {
    $("#saveEditPrefixName").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditPrefixName")[0];
        const prefixID = $('#prefixID').val();
        const fv = setupFormValidationEditPrefixName(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/edit-prefix-name/" + prefixID, formData)
                    .done(onSaveEditPrefixSuccess)
                    .fail(handleAjaxSaveError);
            }
        })
    })
});

function setupFormValidationEditPrefixName(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            edit_prefixName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อคํานําหน้า'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s.]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_statusOfPrefixName: {
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
    });
}

function onSaveEditPrefixSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editPrefixNameModal", "#formEditPrefixName");
}

$(document).ready(function () {
    $('#saveEditClassList').on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditClassList")[0];
        const classListID = $('#classListID').val();
        const fv = setupFormValidationEditClassList(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/edit-class-list/" + classListID, formData)
                    .done(onSaveEditClassListSuccess)
                    .fail(handleAjaxSaveError);
            }
        })
    })
})

function setupFormValidationEditClassList(formElement){
    return FormValidation.formValidation(formElement, {
        fields: {
            edit_classList: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อระดับตำแหน่งาน'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_statusOfClassList: {
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
    });
}

function onSaveEditClassListSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editClassListModal", "#formEditClassList");
}
