'use strict';
$(function () {
    var dt_Menu_table = $('.dt-settingMenu')
    var dt_Menu_sub_table = $('.dt-settingMenuSub')

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
                    render: (data, type, row) => renderGroupActionButtons(data, type, row, 'MenuMain')
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
        showModalWithAjax('#accessMenuModal', '/settings-system/menu/access-menu-modal', ['#selectEmployee']);
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