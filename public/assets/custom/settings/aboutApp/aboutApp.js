$(document).ready(function () {
    $("#saveAboutApp").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAboutApp")[0];
        const fv = setupFormValidationAboutApp(form);
        const formData = new FormData(form);

        const maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        // Include files from Dropzone in formData
        const myDropzone = Dropzone.forElement("#pic-app");
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
                postFormData("/settings-system/about-app/save-about-app", formData)
                    .done(onSaveAboutAppSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationAboutApp(formElement) {
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
        company_name: validators.notEmptyAndRegexp('ระบุชื่อ แผนก', /^[a-zA-Z0-9ก-๏\s]+$/u),
        show_app_name: validators.notEmptyAndRegexp('ระบุชื่อ เครื่อง', /^[a-zA-Z0-9ก-๏\s]+$/u),
    };

    return FormValidation.formValidation(formElement, {
        fields: validationRules,
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.col-md-6, .col-md-12'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
    });
}

function onSaveAboutAppSuccess(response) {
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
        console.error('Unexpected status code: ' + response.status);
    }
}