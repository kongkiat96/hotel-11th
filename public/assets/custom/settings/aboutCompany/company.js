'use strict';
$(function () {
    var dt_Company_table = $('.dt-settingCompany')
    var dt_Department_table = $('.dt-settingDepartment')
    var dt_Group_table = $('.dt-settingGroup')
    var dt_PrefixName_table = $('.dt-settingPrefixName')
    var dt_ClassList_table = $('.dt-settingClassList')

    if (dt_Company_table.length) {
        dt_Company_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/about-company/table-company'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "company_name_th", class: "text-nowrap" },
                { data: "company_name_en", class: "text-nowrap" },
                {
                    data: "status",
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: renderStatusBadge
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: (data, type, row) => renderGroupActionButtons(data, type, row, 'Company')
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

    if (dt_Department_table.length) {
        dt_Department_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/about-company/table-department'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "department_name", class: "text-nowrap" },
                { data: "company_name_th", class: "text-nowrap" },
                {
                    data: "status",
                    orderable: false,
                    searchable: false,

                    class: "text-center",
                    render: renderStatusBadge
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: (data, type, row) => renderGroupActionButtons(data, type, row, 'Department')

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

    if (dt_Group_table.length) {
        dt_Group_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/about-company/table-group'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "group_name", class: "text-nowrap" },
                { data: "department_name", class: "text-nowrap" },
                { data: "company_name_th", class: "text-nowrap" },
                {
                    data: "status",
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: renderStatusBadge
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: (data, type, row) => renderGroupActionButtons(data, type, row, 'Group')
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

    if (dt_PrefixName_table.length) {
        dt_PrefixName_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/about-company/table-prefix-name'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "prefix_name", class: "text-nowrap" },
                {
                    data: "status",
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: renderStatusBadge
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: (data, type, row) => renderGroupActionButtons(data, type, row, 'PrefixName')
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

    if (dt_ClassList_table.length) {
        dt_ClassList_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/about-company/table-class-list'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "class_name", class: "text-nowrap" },
                {
                    data: "status",
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: renderStatusBadge
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: (data, type, row) => renderGroupActionButtons(data, type, row, 'ClassList')
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
});


function reTable() {
    $('.dt-settingCompany').DataTable().ajax.reload();
    $('.dt-settingDepartment').DataTable().ajax.reload();
    $('.dt-settingGroup').DataTable().ajax.reload();
    $('.dt-settingPrefixName').DataTable().ajax.reload();
    $('.dt-settingClassList').DataTable().ajax.reload();
}

$(document).ready(function () {
    $('#AddCompanyModal').click(function () {
        showModalWithAjax('#companyModal', '/settings-system/about-company/company-modal', ['#statusOfCompany']);
    });

    $('#AddDepartmentModal').click(function () {
        showModalWithAjax('#departmentModal', '/settings-system/about-company/department-modal', ['#company', '#statusOfDepartment']);
    });

    $('#AddGroupModal').click(function () {
        showModalWithAjax('#groupModal', '/settings-system/about-company/group-modal', ['#companyForGroup', '#department', '#statusOfGroup']);
    });

    $('#AddPrefixNameModal').click(function () {
        showModalWithAjax('#prefixNameModal', '/settings-system/about-company/prefix-name-modal', ['#statusOfPrefixName']);
    });

    $('#AddClassListModal').click(function () {
        showModalWithAjax('#classListModal', '/settings-system/about-company/class-list-modal', ['#statusOfClassList']);
    })

});

function funcEditCompany(companyID) {
    showModalWithAjax('#editCompanyModal', '/settings-system/about-company/show-edit-company/' + companyID, ['#edit_statusOfCompany']);
}

function funcDeleteCompany(companyID) {
    handleAjaxDeleteResponse(companyID, "/settings-system/about-company/delete-company/" + companyID);
}

function funcEditDepartment(departmentID) {
    showModalWithAjax('#editDepartmentModal', '/settings-system/about-company/show-edit-department/' + departmentID, ['#edit_company', '#edit_statusOfDepartment']);
}

function funcDeleteDepartment(departmentID) {
    handleAjaxDeleteResponse(departmentID, "/settings-system/about-company/delete-department/" + departmentID);
}

function funcEditGroup(groupID) {
    // alert(groupID)
    showModalWithAjax('#editGroupModal', '/settings-system/about-company/show-edit-group/' + groupID, ['#edit_companyForGroup', '#edit_department', '#edit_statusOfGroup']);
}

function funcDeleteGroup(groupID) {
    handleAjaxDeleteResponse(groupID, "/settings-system/about-company/delete-group/" + groupID);
}

function funcEditPrefixName(prefixNameID) {
    showModalWithAjax('#editPrefixNameModal', '/settings-system/about-company/show-edit-prefix-name/' + prefixNameID, ['#edit_statusOfPrefixName']);
}

function funcDeletePrefixName(prefixNameID) {
    handleAjaxDeleteResponse(prefixNameID, "/settings-system/about-company/delete-prefix-name/" + prefixNameID);
}

function funcEditClassList(classListID) {
    showModalWithAjax('#editClassListModal', '/settings-system/about-company/show-edit-class-list/' + classListID, ['#edit_statusOfClassList']);
}

function funcDeleteClassList(classListID) {
    handleAjaxDeleteResponse(classListID, "/settings-system/about-company/delete-class-list/" + classListID);
}
