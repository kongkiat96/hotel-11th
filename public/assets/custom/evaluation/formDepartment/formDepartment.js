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
});

$(document).ready(function () {
    $('#addFormDepartment').click(function () {
        showModalWithAjax('#addFormDepartmentModal', '/evaluation/form-department/add-form-department-modal', ['#select_employee']);
    });
});

function reTable() {
    $('.dt-formDepartmentDetail').DataTable().ajax.reload();
    // $('.dt-InvoiceListSearch').DataTable().ajax.reload();
}