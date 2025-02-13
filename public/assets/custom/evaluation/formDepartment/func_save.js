$(document).ready(function () {
    $("#saveSelectEmployee").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddSelectEmployee")[0];
        const fv = setupFormValidationSelectEmployee(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/evaluation/form-department/save-select-employee", formData)
                    .done(onSaveSelectEmployeeSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });

    $('#saveFormEvaluation').on('click', function (e) {
        e.preventDefault();
        const form = $("#formAddEvaluation")[0];
        const formData = new FormData(form);
        postFormData("/evaluation/form-department/save-form-evaluation", formData).done(onSaveFormEvaluationSuccess).fail(handleAjaxSaveError)
    });

    $('#drawFormEvaluation').on('click', function (e) {
        e.preventDefault();
        const form = $("#formAddEvaluation")[0];
        const formData = new FormData(form);
        postFormData("/evaluation/form-department/draw-form-evaluation", formData).done(onSaveFormEvaluationSuccess).fail(handleAjaxSaveError)
    });
});

function setupFormValidationSelectEmployee(formElement) {
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
        select_employee: validators.notEmpty('เลือกข้อมูล พนักงาน'),

    };

    return FormValidation.formValidation(formElement, {
        fields: validationRules,
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.col-md-12'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
    });
}

function onSaveSelectEmployeeSuccess(response) {
    // console.log(response)
    if (response.status == 200) {
        window.location.href = '/evaluation/form-department/show-evaluation/' + response.message;
        // closeAndResetModal("#addFreezeAccountAgentModal", "#formAddFreezeAccount");

    }
}

function onSaveFormEvaluationSuccess(response) {
    if (response.status === 200) {
        Swal.fire({
            icon: 'success',
            text: 'บันทึกข้อมูลสำเร็จ',
            confirmButtonText: 'ตกลง'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload(); // รีโหลดหน้าฟอร์มหลังจากกดตกลง
            }
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
            text: 'โปรดลองอีกครั้งหรือติดต่อผู้ดูแลระบบ',
            confirmButtonText: 'ตกลง'
        });
    }
}