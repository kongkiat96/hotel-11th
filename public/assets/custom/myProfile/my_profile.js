$(document).ready(function () {
    $('#changePassword').on('click', function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formChangePasswordUser")[0];
        const fv = setupFormValidationChangePassword(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/change-password", formData)
                    .done(onSaveActionSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationChangePassword(formElement) {
    const validators = {
        notEmpty: message => ({
            validators: {
                notEmpty: { message }
            }
        }),
        stringLength: (min, message) => ({
            validators: {
                stringLength: {
                    min,
                    message
                }
            }
        }),
        identical: (compare, message) => ({
            validators: {
                identical: {
                    compare,
                    message
                }
            }
        })
    };

    const validationRules = {
        newPassword: {
            validators: {
                notEmpty: {
                    message: 'กําหนดรหัสผ่านใหม่'
                },
                stringLength: {
                    min: 6,
                    message: 'กรุณาระบุรหัสผ่านเกิน 6 ตัวอักษร'
                }
            }
        },
        confirmPassword: {
            validators: {
                notEmpty: {
                    message: 'กรุณายืนยันรหัสผ่านใหม่'
                },
                stringLength: {
                    min: 6,
                    message: 'กรุณาระบุรหัสผ่านเกิน 6 ตัวอักษร'
                },
                identical: {
                    compare: function() {
                        return formElement.querySelector('[name="newPassword"]').value;
                    },
                    message: 'รหัสผ่านไม่ตรงกัน'
                }
            }
        }
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
        }
    });
}

function onSaveActionSuccess(response) {

    if (response.status === 200) {
        Swal.fire({
            icon: 'success',
            text: 'บันทึกข้อมูลสำเร็จ',
            confirmButtonText: 'ตกลง'
        }).then((result) => {
            window.location.reload();
        });
    } else {
        Swal.fire({
            icon: 'error',
            text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล'
        })
    }
}

function reTable() {

}
// Disable all inputs except password fields
$('input')
  .not('[name="newPassword"]')
  .not('[name="confirmPassword"]')
  .attr('readonly', true);

// Disable all selects
$('select').attr('disabled', true);