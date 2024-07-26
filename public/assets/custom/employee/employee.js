'use strict';
$(function () {
    var dt_employee_current_table = $('.dt-employee-current')
    var dt_employee_disable_table = $('.dt-employee-disable')
    if (dt_employee_current_table.length) {
        dt_employee_current_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/employee/list-all-employee/table-employee-current'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "employee_code", class: "text-nowrap" },
                { data: "email", class: "text-nowrap" },
                { data: "full_name", class: "text-nowrap" },
                { data: "class_name", class: "text-nowrap" },
                { data: "position_name", class: "text-nowrap" },
                { data: "company_name_th", class: "text-nowrap" },
                { data: "department_name", class: "text-nowrap" },
                { data: "group_name", class: "text-nowrap" },
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
            fnCreatedRow: (nRow, aData, iDisplayIndex) => {
                $('td:first', nRow).text(iDisplayIndex + 1);
            },
            pagingType: 'full_numbers',
            drawCallback: function (settings) {
                const dataTableApi = this.api();
                const startIndexOfPage = dataTableApi.page.info().start;
                dataTableApi.column(0).nodes().each((cell, index) => {
                    cell.textContent = startIndexOfPage + index + 1;
                });
            },
            order: [[1, "desc"]],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 20,
            lengthMenu: [20, 25, 50, 75, 100]
        });
    }

    if (dt_employee_disable_table.length) {
        dt_employee_disable_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/employee/list-all-employee/table-employee-disable'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "employee_code", class: "text-nowrap" },
                { data: "email", class: "text-nowrap" },
                { data: "full_name", class: "text-nowrap" },
                { data: "class_name", class: "text-nowrap" },
                { data: "position_name", class: "text-nowrap" },
                { data: "company_name_th", class: "text-nowrap" },
                { data: "department_name", class: "text-nowrap" },
                { data: "group_name", class: "text-nowrap" },
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
            fnCreatedRow: (nRow, aData, iDisplayIndex) => {
                $('td:first', nRow).text(iDisplayIndex + 1);
            },
            pagingType: 'full_numbers',
            drawCallback: function (settings) {
                const dataTableApi = this.api();
                const startIndexOfPage = dataTableApi.page.info().start;
                dataTableApi.column(0).nodes().each((cell, index) => {
                    cell.textContent = startIndexOfPage + index + 1;
                });
            },
            order: [[1, "desc"]],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 20,
            lengthMenu: [20, 25, 50, 75, 100]
        });
    }
})

function funcEditEmployeeCurrent(employeeID) {
    window.location.href = `/employee/edit-employee/show-edit-employee/${employeeID}`
}

function funcDeleteEmployeeCurrent(employeeID) {
    // alert(employeeID)
    handleAjaxDeleteResponse(employeeID, "/employee/delete-employee/" + employeeID);
}

function reTable() {
    $('.dt-employee-current').DataTable().ajax.reload();
    $('.dt-employee-disable').DataTable().ajax.reload();
}
