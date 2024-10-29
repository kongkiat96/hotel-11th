
$(document).ready(function () {
    $("#saveEditBank").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditBank")[0];
        const bankID = $('#bankID').val();
        const delete_bank_logo = $('#delete_bank_logo').val();
        const fv = setupFormValidationBank(form);
        const formData = new FormData(form);

        const maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        // Include the file from Dropzone in formData
        const myDropzone = Dropzone.forElement("#edit_pic-bank");
        
        if (myDropzone.files.length > 0) {
            const file = myDropzone.files[0]; // ดึงไฟล์แรกจาก Dropzone
            if (file.size > maxFileSize) {
                Swal.fire({
                    icon: 'error',
                    text: `ไฟล์ "${file.name}" มีขนาดใหญ่เกิน ${maxFileSize / (1024 * 1024)}MB. กรุณาเลือกไฟล์ขนาดเล็กกว่า.`,
                    showConfirmButton: false,
                    timer: 5500
                });
                return; // หยุดการส่งฟอร์มหากไฟล์ใดๆ เกินขนาด
            }
            formData.append("file", file); // ใช้เพียง file แทน file[]
        }
        formData.append("delete_bank_logo", delete_bank_logo); // ใช้เพียง file แทน file[]
        
        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/bank-list/edit-bank/" + bankID, formData)
                    .done(onSaveEditStatusSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});


function setupFormValidationBank(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            edit_bankName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุ ชื่อธนาคาร'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s./]+$/u,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_statusOfBank: {
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
                rowSelector: '.col-md-12'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        }
    })
}

function onSaveEditStatusSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editBankModal", "#formEditBank");
}