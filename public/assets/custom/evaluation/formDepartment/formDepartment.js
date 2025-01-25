$(function () {
    var dt_formDepartmentDetail = $('.dt-formDepartmentDetail')
    dt_formDepartmentDetail.DataTable({
        processing: true,
        paging: false,  // ปิดการแบ่งหน้า (pagination)
        deferRender: true,
        ordering: false,
        lengthChange: false,  // ปิดตัวเลือกเปลี่ยนจำนวนแถวต่อหน้า
        bDestroy: true, // เปลี่ยนเป็น true
        scrollX: true,
        fixedColumns: {
            leftColumns: 2
        },

        language: {
            processing:
                '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>',
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        ajax: {
            url: '/assets/json/formDepartmentDetail.json', // ใช้เส้นทางที่เป็นไฟล์ JSON
            type: 'GET',
            dataSrc: 'data' // ใช้ 'data' เพื่อให้ DataTables นำข้อมูลจากฟิลด์ 'data' ใน JSON มาแสดง
        },
        columns: [
            { data: 'num', class: "text-center" },
            { data: 'title', class: "text-center" },
            { data: 'detail', class: "text-left" },
            { data: 'score', class: "text-center" },
            { data: 'criterion', class: "text-left" },
        ],
        columnDefs: [
            {
                // searchable: false,
                // orderable: false,
                targets: 0,
            },
        ],
    });

    var dt_EvaluationFormDepartment = $('.dt-EvaluationFormDepartment')
    dt_EvaluationFormDepartment.DataTable({
        processing: true,
        paging: true,
        pageLength: 10,
        deferRender: true,
        ordering: true,
        lengthChange: true,
        bDestroy: true, // เปลี่ยนเป็น true
        scrollX: true,
        fixedColumns: {
            leftColumns: 2
        },

        language: {
            processing:
                '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>',
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        ajax: {
            url: "/evaluation/form-department/table-evaluation",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: function (d) {
                return $.extend({}, d, {
                });
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    // เริ่มลำดับใหม่ทุกหน้า
                    return meta.row + 1;
                },
            },
            { data: 'GroupMonth', class: "text-center" },
            // { data: 'total_invoices', class: "text-center" },
            {
                data: 'SearchMonth',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: function (data, type, row) {
                    // console.log(row)
                    const countTotal = (row.total_evaluations);
                    return renderGroupActionButtonsSearchMonth(data, type, row, 'SearchMonth', 'all_month', 'info', countTotal);
                }
            },
            // { data: 'draft_count', class: "text-center" },
            {
                data: 'SearchMonth',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: function (data, type, row) {
                    // console.log(row)
                    const countTotal = (row.draft_count);
                    return renderGroupActionButtonsSearchMonth(data, type, row, 'SearchMonth', 'draft_month', 'secondary', countTotal);
                }
            },
            // { data: 'save_count', class: "text-center" },
            {
                data: 'SearchMonth',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: function (data, type, row) {
                    // console.log(row)
                    const countTotal = (row.save_count);
                    return renderGroupActionButtonsSearchMonth(data, type, row, 'SearchMonth', 'save_month', 'success', countTotal);
                }
            }

        ],
        columnDefs: [
            {
                // searchable: false,
                // orderable: false,
                targets: 0,
            },
        ],
    });

    var dt_EvaluationListSearch = $('.dt-EvaluationListSearch')
    dt_EvaluationListSearch.DataTable({
        processing: true,
        paging: true,
        pageLength: 10,
        deferRender: true,
        ordering: true,
        lengthChange: true,
        bDestroy: true, // เปลี่ยนเป็น true
        scrollX: true,
        fixedColumns: {
            leftColumns: 2
        },

        language: {
            processing:
                '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>',
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        ajax: {
            url: "/evaluation/form-department/table-search-evaluation",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: function (d) {
                return $.extend({}, d, {
                    searchMonth: $("#searchMonth").val(),
                    searchTag: $("#searchTag").val(),
                });
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    // เริ่มลำดับใหม่ทุกหน้า
                    return meta.row + 1;
                },
            },
            { data: 'emp_name', class: "text-center" },
            { data: 'date_evaluation', class: "text-center" },
            {
                data: "evaluation_status",
                orderable: false,
                searchable: false,
                class: "text-center",
                render: renderStatusDocumentBadge
            },
            { data: 'created_at', class: "text-center" },
            { data: 'created_user', class: "text-center" },
            // { data: 'status_freeze', class: "text-center" },

            { data: 'updated_at', class: "text-center" },
            { data: 'updated_user', class: "text-center" },
            {
                data: 'ID',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: function (data, type, row) {
                    // console.log(row)
                    const Permission = (row.Permission);
                    return renderGroupActionButtonsPermission(data, type, row, 'EvaluationList', Permission);
                }
            }

        ],
        columnDefs: [
            {
                // searchable: false,
                // orderable: false,
                targets: 0,
            },
        ],
    });
});

$(document).ready(function () {
    $('#addFormDepartment').click(function () {
        showModalWithAjax('#addFormDepartmentModal', '/evaluation/form-department/add-form-department-modal', ['#select_employee']);
    });

    $("#deleteFormEvaluation").on("click", function (e) {
        e.preventDefault();
        const evaluationID = $('#id').val();
        Swal.fire({
            text: "ยืนยันการลบข้อมูล",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน",
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // ส่งคำขอ AJAX เพื่อลบข้อมูล
                $.ajax({
                    url: `/evaluation/form-department/delete-evaluation/${evaluationID}`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire({
                            text: "ลบข้อมูลสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",
                        }).then(() => {
                            window.location.href = '/evaluation/form-department';
                        });
                    },
                    error: function (xhr) {
                        handleAjaxSaveError();
                    }
                });
            }
        }).catch(() => {
            handleAjaxSaveError();
        });
    });
});

function reTable() {
    $('.dt-formDepartmentDetail').DataTable().ajax.reload();
    $('.dt-EvaluationFormDepartment').DataTable().ajax.reload();
    $('.dt-EvaluationListSearch').DataTable().ajax.reload();
    // $('.dt-InvoiceListSearch').DataTable().ajax.reload();
}

var datePickers = ['date_a', 'date_b', 'date_c', 'date_d', 'date_e', 'date_f', 'date_g', 'date_h', 'date_i', 'date_j', 'date_k', 'date_l', 'date_m', 'date_n', 'date_o', 'date_p'];
initializeDatePickers(datePickers);
// ฟังก์ชันสำหรับคำนวณคะแนนรวม
function calculateTotalScore() {
    let totalScore = 0;

    // หา input ทุกตัวที่มี class 'score-input'
    const scoreInputs = document.querySelectorAll('.score-input');

    // Loop ผ่าน input ทุกตัว
    scoreInputs.forEach(function (input) {
        const score = parseFloat(input.value) || 0;  // ใช้ค่าคะแนนที่กรอก ถ้าไม่ใช่ตัวเลขจะให้เป็น 0
        totalScore += score;
    });

    // แสดงผลรวมคะแนน
    document.getElementById('total-score').textContent = totalScore;
}

// ฟังก์ชันที่ใช้ตรวจสอบและปรับปรุงค่าที่กรอก
function checkMaxValue(input) {
    const min = parseFloat(input.min);
    const max = parseFloat(input.max);
    let value = parseFloat(input.value);

    // ถ้าค่าที่กรอกน้อยกว่าค่าต่ำสุดให้ตั้งเป็นค่าต่ำสุด
    if (value < min) {
        input.value = min;
    }
    // ถ้าค่าที่กรอกมากกว่าค่าสูงสุดให้ตั้งเป็นค่าสูงสุด
    else if (value > max) {
        input.value = max;
    }
}

// เรียกฟังก์ชัน checkMaxValue ทุกครั้งที่มีการกรอกคะแนน
const scoreInputs = document.querySelectorAll('.score-input');
scoreInputs.forEach(function (input) {
    input.addEventListener('input', function () {
        checkMaxValue(input);  // ตรวจสอบค่าที่กรอก
        calculateTotalScore();  // คำนวณคะแนนรวมใหม่
    });
});

// เรียกฟังก์ชันครั้งแรกเพื่อให้แสดงผลรวมเริ่มต้น
calculateTotalScore();

function funcEditEvaluationList(EvaluationListID) {

    location.href = '/evaluation/form-department/show-evaluation/' + EvaluationListID;
}

function funcViewEvaluationList(EvaluationListID) {

    location.href = '/evaluation/form-department/view-evaluation/' + EvaluationListID;
}

function funcViewSearchMonth(SearchMonth, tag_search) {
    // alert(SearchMonth);
    // console.log(SearchMonth,tag_search)
    location.href = '/evaluation/form-department/search-month/' + SearchMonth + '/' + tag_search;
}

function renderStatusDocumentBadge(data, type, full, row) {
    const statusMap = {
        1: { title: 'แบบร่าง', className: 'bg-label-secondary' },
        2: { title: 'บันทึกข้อมูลแล้ว', className: 'bg-label-success' }
    };
    const status = statusMap[data] || { title: 'Undefined', className: 'bg-label-danger' };
    return `<span class="badge ${status.className}">${status.title}</span>`;
}

function funcDeleteEvaluationList(evaluationID) {
    Swal.fire({
        text: "ยืนยันการลบข้อมูล",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "ยืนยัน",
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            // ส่งคำขอ AJAX เพื่อลบข้อมูล
            $.ajax({
                url: `/evaluation/form-department/delete-evaluation/${evaluationID}`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        text: "ลบข้อมูลสำเร็จ",
                        icon: "success",
                        confirmButtonText: "ตกลง",
                    }).then(() => {
                        // location.reload();
                        reTable();
                    });
                },
                error: function (xhr) {
                    handleAjaxSaveError();
                }
            });
        }
    }).catch(() => {
        handleAjaxSaveError();
    });
}