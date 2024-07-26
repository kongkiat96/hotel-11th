'use strict';
$(function () {
    var dt_status_table = $('.dt-settingStatus')
    var dt_flay_type_table = $('.dt-settingFlagType')
    if (dt_status_table.length) {
        dt_status_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/work-status/table-status'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "status_name", class: "text-nowrap" },
                { data: "status_use", class: "text-nowrap", render: renderStatusWorkBadge },
                { data: "type_work", class: "text-nowrap", render: renderStatusWorkTypeBadge },
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
                    render: (data, type, row) => renderGroupActionButtons(data, type, row, 'Status')
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

    if (dt_flay_type_table.length) {
        dt_flay_type_table.DataTable({
            serverSide: true,
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/work-status/table-flag-type'
            },
            columns: [
                { data: null, orderable: false, searchable: false, class: "text-center" },
                { data: "flag_name", class: "text-nowrap" },
                { data: "type_work", class: "text-nowrap", render: renderStatusWorkTypeBadge },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: (data, type, row) => renderGroupActionButtons(data, type, row, 'FlagType')
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
    $('.dt-settingStatus').DataTable().ajax.reload();
    $('.dt-settingFlagType').DataTable().ajax.reload();
}

$(document).ready(function () {
    $('#addStatus').click(function () {
        showModalWithAjax('#addStatusModal', '/settings-system/work-status/status-modal', ['#statusUse', '#flagType', '#statusOfStatus']);
    });

    $('#addFlagType').click(function () {
        showModalWithAjax('#addFlagTypeModal', '/settings-system/work-status/flag-type-modal',['#typeWork']);
    })
});

function funcEditStatus(statusID) {
    showModalWithAjax('#editStatusModal', '/settings-system/work-status/show-edit-status/' + statusID, ['#edit_statusUse', '#edit_flagType', '#edit_statusOfStatus']);
}

function funcDeleteStatus(statusID) {
    handleAjaxDeleteResponse(statusID, "/settings-system/work-status/delete-status/" + statusID);
}

function funcEditFlagType(flagTypeID) {
    showModalWithAjax('#editFlagTypeModal', '/settings-system/work-status/show-edit-flag-type/' + flagTypeID, ['#edit_typeWork']);
}

function funcDeleteFlagType(flagTypeID) {
    handleAjaxDeleteResponse(flagTypeID, "/settings-system/work-status/delete-flag-type/" + flagTypeID);
}


