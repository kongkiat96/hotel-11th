var setURLEmployee = '/employee/search-all-employee'
$(function () {
    var dt_SearchEmployee = $('.dt-search-employee')
    dt_SearchEmployee.DataTable({
        processing: true,
        paging: true,
        pageLength: 50,
        deferRender: true,
        ordering: true,
        lengthChange: true,
        bDestroy: true,
        scrollX: true,
        fixedColumns: {
            leftColumns: 3
        },
        language: {
            processing:
                '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>',
        },
        data: [], // เริ่มต้นด้วยข้อมูลว่าง
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },
            },
            { data: "employee_code", class: "text-nowrap" },
            { data: "email", class: "text-nowrap" },
            { data: "full_name", class: "text-nowrap" },
            { data: "class_name", class: "text-nowrap" },
            { data: "position_name", class: "text-nowrap" },
            { data: "company_name_th", class: "text-nowrap" },
            { data: "department_name", class: "text-nowrap" },
            { data: "group_name", class: "text-nowrap" },
            // { data: "branch_name", class: "text-nowrap" },
            { data: "user_class", class: "text-nowrap", render: renderUserClassBadge },
            {
                data: "status_login",
                orderable: false,
                searchable: false,
                class: "text-center",
                render: renderStatusBadge
            },
            {
                data: 'ID',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: (data, type, row) => renderGroupActionButtons(data, type, row, 'EmployeeCurrent')
            }
        ],
        columnDefs: [
            {
                targets: 0,
            },
        ],
    });

})

$(document).ready(function () {

    $('#searchDataEmployee').click(function () {
        var company_id = $('#company').val();
        var department_id = $('#department').val();
        var group_department_id = $('#groupOfDepartment').val();
        var user_class = $('#user_class').val();
        var status_login = $('#status_login').val();
        var employee_code = $('#employee_code').val();
        $.ajax({
            url: setURLEmployee + "/get-data-search-employee",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: {
                company_id: company_id,
                department_id: department_id,
                group_department_id: group_department_id,
                user_class: user_class,
                status_login: status_login,
                employee_code: employee_code
            },
            success: function (data) {
                // ล้างข้อมูลเก่าและอัปเดต DataTable
                const table = $('.dt-search-employee').DataTable();
                table.clear(); // ล้างข้อมูลเดิม
                table.rows.add(data.data); // เพิ่มข้อมูลใหม่
                table.draw(); // วาดตารางใหม่
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    text: 'เกิดข้อผิดพลาดในการดึงข้อมูล',
                    showConfirmButton: false
                });
            }
        });
    });

    $('#resetSearchEmployee').click(function () {
        window.location.reload();
    });
});


function reTable() {

}

function funcEditEmployeeCurrent(employeeID) {
    window.location.href = `/employee/edit-employee/show-edit-employee/${employeeID}`
}

function funcDeleteEmployeeCurrent(employeeID) {
    // alert(employeeID)
    handleAjaxDeleteResponse(employeeID, "/employee/delete-employee/" + employeeID);
}