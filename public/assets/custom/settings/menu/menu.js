'use strict';
$(function () {
    var dt_Menu_table = $('.dt-settingMenu')
    var dt_Menu_sub_table = $('.dt-settingMenuSub')
    var dt_user_access_menu_table = $('.dt-user-access-menu')

    if (dt_Menu_table.length) {
        dt_Menu_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/menu/table-menu'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "menu_name", class: "text-nowrap" },
                {
                    data: "menu_icon",
                    class: "text-nowrap text-center",
                    render: function (data, type, row) {
                        return `<i class='menu-icon tf-icons bx ${data}'></i> `;
                    }
                },
                { data: "menu_link", class: "text-nowrap text-center" },
                { data: "menu_sort", searchable: false, class: "text-center" },
                {
                    data: "status",
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
                    // render: (data, type, row) => renderGroupActionButtons(data, type, row, 'MenuMain',disableButtons)
                    render: function (data, type, row) {
                        return renderGroupActionButtons(data, type, row, 'MenuMain');
                    }
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
            // order: [[1, "ASC"]],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 20,
            lengthMenu: [20, 25, 50, 75, 100]
        });
    }

    if (dt_Menu_sub_table.length) {
        dt_Menu_sub_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/menu/table-menu-sub'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "menu_name", class: "text-nowrap" },
                {
                    data: "menu_icon",
                    orderable: false, searchable: false,
                    class: "text-nowrap text-center",
                    render: function (data, type, row) {
                        return `<i class='menu-icon tf-icons bx ${data}'></i> `;
                    }
                },
                { data: "menu_link", class: "text-nowrap text-center" },
                { data: "menu_sub_name", class: "text-nowrap" },
                {
                    data: "menu_sub_icon",
                    orderable: false, searchable: false,
                    class: "text-nowrap text-center",
                    render: function (data, type, row) {
                        return `<i class='menu-icon tf-icons bx ${data}'></i> `;
                    }
                },
                { data: "menu_sub_link", class: "text-nowrap text-center" },
                
                {
                    data: "status",
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
                    render: (data, type, row) => renderGroupActionButtons(data, type, row, 'MenuSub')
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

    if (dt_user_access_menu_table.length) {
        dt_user_access_menu_table.DataTable({
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
                    render: (data, type, row) => renderGroupActionAccessMenuButtons(data, type, row, 'AccessMenu')
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
            order: [[9, "asc"]],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 20,
            lengthMenu: [20, 25, 50, 75, 100]
        });
    }

})

function reTable() {
    $('.dt-settingMenu').DataTable().ajax.reload();
    $('.dt-settingMenuSub').DataTable().ajax.reload();
}
$(document).ready(function () {
    $('#addMenuModal').click(function () {
        showModalWithAjax('#menuMainModal', '/settings-system/menu/menu-modal', ['#statusMenu']);
    });
    $('#addMenuSubModal').click(function () {
        showModalWithAjax('#menuSubModal', '/settings-system/menu/menu-sub-modal', ['#menuMain', '#statusMenu']);
    });

    $('#addAccessMenuModal').click(function () {
        showModalWithAjax('#accessMenuModal', '/settings-system/menu/access-menu-modal', ['#selectUser']);
    });
});

function funcEditMenuMain(menuMainID) {
    showModalWithAjax('#editMenuMainModal', '/settings-system/menu/show-edit-menu-main/' + menuMainID, ['#edit_statusMenu']);
}

function funcDeleteMenuMain(menuMainID) {
    handleAjaxDeleteResponse(menuMainID, "/settings-system/menu/delete-menu-main/" + menuMainID);
}

function funcEditMenuSub(menuSubID) {
    showModalWithAjax('#editMenuSubModal', '/settings-system/menu/show-edit-menu-sub/' + menuSubID, ['#menuMain', '#edit_statusMenu']);
}

function funcDeleteMenuSub(menuSubID) {
    handleAjaxDeleteResponse(menuSubID, "/settings-system/menu/delete-menu-sub/" + menuSubID);
}

function funcAccessMenu(idMapEmployee) {
    // showModalWithAjax('#editMenuSubModal', '/settings-system/menu/show-edit-menu-sub/' + menuSubID, ['#menuMain', '#edit_statusMenu']);
    showModalWithAjax('#accessMenuModal', '/settings-system/menu/access-menu-modal/'+ idMapEmployee,[]);
}