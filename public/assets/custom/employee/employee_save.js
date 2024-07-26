const previewTemplate = `<div class="dz-preview dz-file-preview">
<div class="dz-details">
  <div class="dz-thumbnail">
    <img data-dz-thumbnail>
    <span class="dz-nopreview">No preview</span>
    <div class="dz-success-mark"></div>
    <div class="dz-error-mark"></div>
    <div class="dz-error-message"><span data-dz-errormessage></span></div>
    <div class="progress">
      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
    </div>
  </div>
  <div class="dz-filename" data-dz-name></div>
  <div class="dz-size" data-dz-size></div>
</div>
</div>`;

const myDropzone = new Dropzone('#pic-employee', {
    previewTemplate: previewTemplate,
    parallelUploads: 1,
    maxFilesize: 5,
    addRemoveLinks: true,
    maxFiles: 1,
    acceptedFiles: 'image/*'
});

myDropzone.on("success", function (file, response) {
    // console.log(response, file['dataURL']);
    document.getElementById('baseimg').value = file['dataURL'];
});
myDropzone.on("removedfile", function (file) {
    document.getElementById('baseimg').value = '';
});


function calculateAge(birthday) {
    var today = new Date();
    var birthDate = new Date(birthday);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

document.getElementById("birthday").addEventListener("change", function () {
    var birthday = this.value;
    var age = calculateAge(birthday);
    document.getElementById("age").value = age;
});


$(document).ready(function () {
    $('#saveEmployee').on("click", function (e) {
        // alert("ss")
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddEmployee")[0];
        const fv = setupFormValidationEmployee(form);
        const formData = new FormData(form);
        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/employee/add-employee/save-employee", formData)
                    .done(onSaveEmployeeSuccess)
                    .fail(handleAjaxSaveError);
            } else {
                Swal.fire({
                    icon: 'warning',
                    text: 'มีข้อมูลบางอย่างที่ไม่ถูกต้อง',
                    confirmButtonText: "ตกลง",
                });
            }
        })
    })
});

function onSaveEmployeeSuccess(response) {
    handleAjaxSaveResponse(response);
    console.log(response)
}

function setupFormValidationEmployee(formElement) {
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
        employee_code: validators.notEmptyAndRegexp('ระบุชื่อ รหัสพนักงาน', /^[a-zA-Z0-9ก-๏\s]+$/u),
        company: validators.notEmpty('เลือกข้อมูล บริษัท'),
        department: validators.notEmpty('เลือกข้อมูล สังกัด / ฝ่าย'),
        groupOfDepartment: validators.notEmpty('เลือกข้อมูล แผนก'),
        positionClass: validators.notEmpty('เลือกข้อมูล ระดับตําแหน่ง'),
        positionName: validators.notEmptyAndRegexp('ระบุชื่อตําแหน่ง', /^[a-zA-Z0-9ก-๏\s]+$/u),
        userClass: validators.notEmpty('เลือกข้อมูล ระดับสิทธิ์ผู้ใช้งาน'),
        statusLogin: validators.notEmpty('เลือกข้อมูล สถานะการเข้าสู่ระบบ'),
        prefixName: validators.notEmptyAndRegexp('ระบุคํานําหน้าชื่อ', /^[a-zA-Z0-9ก-๏\s.]+$/u),
        firstName: validators.notEmptyAndRegexp('ระบุชื่อ', /^[a-zA-Z0-9ก-๏\s.]+$/u),
        lastName: validators.notEmptyAndRegexp('ระบุนามสกุล', /^[a-zA-Z0-9ก-๏\s.]+$/u),
        email: validators.notEmptyAndRegexp('ระบุอีเมล์', /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/),

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
        },
    });
}
