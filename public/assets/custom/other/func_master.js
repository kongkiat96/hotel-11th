function handleAjaxSaveResponse(response) {
    let icon, text, timer;
    switch (response.status) {
        case 200:
            icon = 'success';
            text = 'บันทึกข้อมูลสำเร็จ';
            timer = 2500;
            break;
        case 23000:
            icon = 'warning';
            text = 'พบข้อมูลซ้ำในระบบ';
            timer = undefined;
            break;
        default:
            icon = 'error';
            text = 'เกิดข้อผิดพลาดในการบันทึกข้อมูล';
            timer = undefined;
    }
    Swal.fire({
        icon: icon,
        text: text,
        showConfirmButton: false,
        timer: timer
    });
    if (response.status === 200) {
        reTable();
    }
}

function handleAjaxEditResponse(response) {
    const isSuccess = response.status === 200;
    Swal.fire({
        icon: isSuccess ? 'success' : 'error',
        text: isSuccess ? 'แก้ไขข้อมูลสำเร็จ' : 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล',
        showConfirmButton: false,
        timer: isSuccess ? 2500 : undefined
    });
    if (isSuccess) {
        reTable();
    }
}

function handleAjaxDeleteResponse(itemId, deleteUrl) {
    Swal.fire({
        text: "ยืนยันการลบข้อมูล",
        icon: "question",
        showCancelButton: true,
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "ยืนยัน",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return postFormData(deleteUrl, itemId)
                .then(response => {
                    if (response.status === 200) {
                        Swal.fire({
                            text: "ลบข้อมูลสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",
                        });
                        reTable();
                    } else {
                        throw new Error(response.message);
                    }
                })
                .catch(() => {
                    handleAjaxSaveError();
                });
        },
    });
}

function handleAjaxSaveError(xhr, textStatus, errorThrown) {
    Swal.fire({
        icon: 'error',
        title: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
        text: 'โปรดลองอีกครั้งหรือติดต่อผู้ดูแลระบบ',
    });
}

function closeAndResetModal(modalSelector, formSelector) {
    setTimeout(function () {
        $(modalSelector).modal('hide');
        $(formSelector).find('input, select').val('').trigger('change');
    }, 3000);
}

function applyBlockUI(selector, options) {
    $(selector).block(options);
}

$(document).on('click', '.btn-form-block-overlay', function () {
    var defaultOptions = {
        message: '<div class="spinner-border text-primary" role="status"></div>',
        timeout: 1000,
        css: {
            backgroundColor: 'transparent',
            border: '0'
        },
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8
        }
    };

    var formSection = $('.form-block');
    if (formSection.length) {
        applyBlockUI(formSection, defaultOptions);
    }
});

function removeValidationFeedback() {
    $('.fv-plugins-message-container.invalid-feedback').remove();
    $('.is-invalid').removeClass('is-invalid');
}

function postFormData(url, formData) {
    return $.ajax({
        url: url,
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        contentType: false,
        processData: false
    });
}

function showModalWithAjax(modalId, url, select2Selectors) {
    $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {
            $(modalId + ' .modal-dialog').html(response);
            initializeSelectWithModal(select2Selectors, modalId);
            $(modalId).modal('show');
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function initializeSelectWithModal(selectors, modalId) {
    if (!Array.isArray(selectors)) {
        console.error('initializeSelect2 expects the first argument to be an array of selectors.');
        return;
    }
    if (!modalId || !$(modalId).length) {
        console.error('initializeSelect2 expects a valid modalId as the second argument.');
        return;
    }

    selectors.forEach(function (selector) {
        var $selectElement = $(selector, modalId);
        if ($selectElement.length) {
            $selectElement.select2({
                dropdownParent: $(modalId),
                allowClear: true,
                placeholder: "เลือกข้อมูล"
            });
        } else {
            console.warn('Selector not found:', selector);
        }
    });
}

function initializeDatePickers(pickerIds) {
    pickerIds.forEach(function (pickerId) {
        const pickerElement = document.querySelector('#' + pickerId);
        if (pickerElement) {
            pickerElement.flatpickr({
                monthSelectorType: 'static',
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
                        longhand: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์']
                    },
                    months: {
                        shorthand: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                        longhand: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']
                    },
                    rangeSeparator: ' ถึง ',
                    weekAbbreviation: 'สัปดาห์',
                    scrollTitle: 'เลื่อนเพื่อเพิ่ม',
                    toggleTitle: 'คลิกเพื่อสลับ',
                    yearAriaLabel: 'ปี'
                }
            });
        }
    });
}
function renderStatusBadge(data, type, full, row) {
    const statusMap = {
        1: { title: 'กำลังใช้งาน', className: 'bg-label-success' },
        0: { title: 'ปิดการใช้งาน', className: 'bg-label-danger' }
    };
    const status = statusMap[data] || { title: 'Undefined', className: 'bg-label-secondary' };
    return `<span class="badge ${status.className}">${status.title}</span>`;
}

function renderStatusWorkBadge(data, type, full, row) {
    const statusMap = {
        all: { title: 'ใช้งานทั้งหมด', className: 'bg-label-success' },
        it: { title: 'ใช้งานฝ่าย IT', className: 'bg-label-info' },
        building: { title: 'ใช้งานฝ่ายอาคาร', className: 'bg-label-warning' },
        hr: { title: 'ใช้งานฝ่าย HR', className: 'bg-label-primary' }
    };
    const status = statusMap[data] || { title: 'Undefined', className: 'bg-label-secondary' };
    return `<span class="badge ${status.className}">${status.title}</span>`;
}

function renderUserClassBadge(data, type, full, row) {
    const statusMap = {
        it: { title: 'สังกัด IT', className: 'bg-label-info' },
        mt: { title: 'สังกัด อาคาร', className: 'bg-label-warning' },
        hr: { title: 'สังกัด บุคคล', className: 'bg-label-primary' },
        userOther: { title: 'ผู้ใช้ทั่วไป', className: 'bg-label-danger' }
    };
    const status = statusMap[data] || { title: 'Undefined', className: 'bg-label-secondary' };
    return `<span class="badge ${status.className}">${status.title}</span>`;
}

function renderStatusWorkTypeBadge(data, type, full, row) {
    const statusMap = {
        Complete: { title: 'ดำเนินงานเสร็จสิ้น', className: 'bg-label-success' },
        Wating: { title: 'อยู่ระหว่างดำเนินงาน', className: 'bg-label-warning' },
        Hold: { title: 'รอชั่วคราว', className: 'bg-label-warning' },
        Doing: { title: 'กำลังดำเนินงาน', className: 'bg-label-primary' },
        Cancel: { title: 'ยกเลิกงาน / ยกเลิกการแจ้ง', className: 'bg-label-danger' },
        Other: { title: 'อื่น ๆ', className: 'bg-label-info' },
    };
    const status = statusMap[data] || { title: 'Undefined', className: 'bg-label-secondary' };
    return `<span class="badge ${status.className}">${status.title}</span>`;
}


function renderGroupActionButtons(data, type, row, useFunc) {
    // console.log(useFunc)
    const editFunction = `funcEdit${useFunc}`;
    const deleteFunction = `funcDelete${useFunc}`;
    return `
    <button type="button" class="btn btn-icon btn-label-warning btn-outline-warning" onclick="${editFunction}(${row.ID})">
        <span class="tf-icons bx bx-edit-alt"></span>
    </button>
    <button type="button" class="btn btn-icon btn-label-danger btn-outline-danger" onclick="${deleteFunction}(${row.ID})">
        <span class="tf-icons bx bx-trash"></span>
    </button>
`;
}

function mapSelectedCompanyDepartment(disabledElement, selectElement, disableStatus) {
    var originalContent = $(disabledElement).html();
    $(disabledElement).prop('disabled', disableStatus);
    $(selectElement).on('change', function () {
        var companyID = $(this).val();
        var $departmentSelect = $(disabledElement);
        $departmentSelect.prop('disabled', !companyID);

        if (companyID) {
            $.ajax({
                url: '/getMaster/get-department/' + companyID,
                type: 'GET',
                dataType: 'json',
                success: function (departmentsData) {
                    $departmentSelect.empty().append('<option value="">Select</option>');
                    departmentsData.forEach(function (department) {
                        var optionElement = $('<option>').val(department.ID).text(department.departmentName);
                        $departmentSelect.append(optionElement);
                    });

                    $('#groupOfDepartment').prop('disabled', true);
                    $('#groupOfDepartment').empty().append('<option value="">Select</option>');
                    $('#mapIDGroup').val('');
                },
                error: function () {
                    $departmentSelect.html(originalContent);
                }
            });
        } else {
            $('#groupOfDepartment').prop('disabled', true);
            $('#groupOfDepartment').empty().append('<option value="">Select</option>');
            $('#mapIDGroup').val('');
            $departmentSelect.html(originalContent);
            $departmentSelect.empty().append('<option value="">Select</option>');
        }
    });
}

function mapSelectedDepartmentGroup(disabledElement, selectElement, disableStatus) {
    var originalContent = $(disabledElement).html();
    $(disabledElement).prop('disabled', disableStatus);
    $(selectElement).on('change', function () {
        var departmentID = $(this).val();
        var $groupOfDepartmentSelect = $(disabledElement);
        $groupOfDepartmentSelect.prop('disabled', !departmentID);

        if (departmentID) {
            $.ajax({
                url: '/getMaster/get-group/' + departmentID,
                type: 'GET',
                dataType: 'json',
                success: function (groupOfDepData) {
                    $groupOfDepartmentSelect.empty().append('<option value="">Select</option>');
                    groupOfDepData.forEach(function (group) {
                        var optionElement = $('<option>').val(group.ID).text(group.group_name).data('getID', group.ID);
                        $groupOfDepartmentSelect.append(optionElement);
                    });

                    $groupOfDepartmentSelect.on('change', function () {
                        var getID = $(this).find('option:selected').data('getID');
                        $('#mapIDGroup').val(getID);
                    });
                    $('#mapIDGroup').val('');
                },
                error: function () {
                    $groupOfDepartmentSelect.html(originalContent);
                }
            });
        } else {
            $('#mapIDGroup').val('');
            $groupOfDepartmentSelect.html(originalContent);
            $groupOfDepartmentSelect.empty().append('<option value="">Select</option>');
        }
    });
}

function mapSelectedProvince(disabledAumphoe, selectElement, disableStatus) {
    var originalContent = $(disabledAumphoe).html();
    $(disabledAumphoe).prop('disabled', disableStatus);
    $(selectElement).on('change', function () {
        var provinceCode = $(this).val();
        var $aumphoeSelect = $(disabledAumphoe);
        $aumphoeSelect.prop('disabled', !provinceCode);

        if (provinceCode) {
            $.ajax({
                url: '/getMaster/get-amphoe/' + provinceCode,
                type: 'GET',
                dataType: 'json',
                success: function (amphoeData) {
                    $aumphoeSelect.empty().append('<option value="">Select</option>');

                    $('#tambon').prop('disabled', true);
                    $('#tambon').empty().append('<option value="">Select</option>');
                    $('#zipcode').val('');
                    $('#mapIDProvince').val('');

                    amphoeData.forEach(function (amphoe) {
                        var optionElement = $('<option>').val(amphoe.amphoe_code).text(amphoe.amphoe);
                        $aumphoeSelect.append(optionElement);
                    });
                },
                error: function () {
                    $aumphoeSelect.html(originalContent);
                }
            });
        } else {
            $aumphoeSelect.html(originalContent);
            $('#tambon').prop('disabled', true);
            $('#tambon').empty().append('<option value="">Select</option>');
            $('#zipcode').val('');
            $('#mapIDProvince').val('');

            $aumphoeSelect.empty().append('<option value="">Select</option>');
        }
    });
}

function mapSelectedAumphoe(disabledTambon, selectElement, disableStatus) {
    var originalContent = $(disabledTambon).html();
    $(disabledTambon).prop('disabled', disableStatus);
    $(selectElement).on('change', function () {
        var aumphoeCode = $(this).val();
        var $tambonSelect = $(disabledTambon);
        $tambonSelect.prop('disabled', !aumphoeCode);

        if (aumphoeCode) {
            $.ajax({
                url: '/getMaster/get-tambon/' + aumphoeCode,
                type: 'GET',
                dataType: 'json',
                success: function (tambonData) {
                    $tambonSelect.empty().append('<option value="">Select</option>');
                    $('#zipcode').val('');
                    $('#mapIDProvince').val('');

                    tambonData.forEach(function (tambon) {
                        var optionElement = $('<option>').val(tambon.id).text(tambon.tambon).data('zip', tambon.zipcode).data('id', tambon.id);
                        $tambonSelect.append(optionElement);
                    });

                    $tambonSelect.on('change', function () {
                        var selectedZipCode = $(this).find('option:selected').data('zip');
                        var getID = $(this).find('option:selected').data('id');
                        $('#zipcode').val(selectedZipCode);
                        $('#mapIDProvince').val(getID);
                    });
                },
                error: function () {
                    $tambonSelect.html(originalContent);
                }
            });
        } else {
            $tambonSelect.html(originalContent);
            $tambonSelect.empty().append('<option value="">Select</option>');
            $('#zipcode').val('');
            $('#mapIDProvince').val('');
        }
    });
}
