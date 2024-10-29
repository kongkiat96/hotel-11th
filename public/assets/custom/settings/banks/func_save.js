$(document).ready(function () {
    $("#saveBank").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddBank")[0];
        const fv = setupFormValidationBank(form);
        const formData = new FormData(form);

        // // รวมข้อมูลจาก Dropzone เข้ากับ formData
        // const myDropzone = Dropzone.forElement("#pic-bank");
        // if (myDropzone.files.length > 0) {
        //     myDropzone.files.forEach(file => {
        //         formData.append("file[]", file); // ใช้ file[] หากต้องการส่งหลายไฟล์
        //     });
        // }

        const maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        // Include files from Dropzone in formData
        const myDropzone = Dropzone.forElement("#pic-bank");
        if (myDropzone.files.length > 0) {
            for (let file of myDropzone.files) {
                if (file.size > maxFileSize) {
                    Swal.fire({
                        icon: 'error',
                        text: `ไฟล์ "${file.name}" มีขนาดใหญ่เกิน ${maxFileSize / (1024 * 1024)}MB. กรุณาเลือกไฟล์ขนาดเล็กกว่า.`,
                        showConfirmButton: false,
                        timer: 5500
                    });
                    return; // Stop form submission if any file exceeds the limit
                }
                formData.append("file", file); // Use file[] if you want to send multiple files
            }
        }

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/bank-list/save-bank", formData)
                    .done(onSaveBankSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});


function setupFormValidationBank(formElement){
    return FormValidation.formValidation(formElement, {
        fields: {
            bankName: {
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
            statusOfBank: {
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

function onSaveBankSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#addBankModal", "#formAddBank");
}