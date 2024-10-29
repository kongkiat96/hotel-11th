$(function () {
    var dt_teleListDepartment = $('.dt-teleListDepartment')
    dt_teleListDepartment.DataTable({
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
            url: "/tele/telelist/table-telelist",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },
            },
            { data: 'tele_department', class: "text-center" },
            { data: 'tele_machine', class: "text-center" },
            { data: 'date_receive', class: "text-center" },
            { data: 'date_send', class: "text-center" },
            { data: 'tele_reason', class: "text-nowrap" },
            { data: 'bookbank_name', class: "text-center" },
            { data: 'created_at', class: "text-center" },
            { data: 'created_user', class: "text-center" },
            { data: 'updated_at', class: "text-center" },
            { data: 'updated_user', class: "text-center" },
            {
                data: 'ID',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: function (data, type, row) {
                    const Permission = (row.Permission);
                    return renderGroupActionButtonsPermission(data, type, row, 'TeleListDepartment', Permission);
                }
            }
        ],
        columnDefs: [
            {
                targets: 0,
            },
        ],
        // footerCallback: function (row, data, start, end, display) {
        //     const api = this.api();
        //     const totalCount = api.data().count(); // อัปเดตการนับ
        //     $('#totalCount').html(totalCount);
        // }
    });

});

$(document).ready(function () {
    $('#addteleDepartment').click(function () {
        showModalWithAjax('#addTeleDepartmentModal', '/tele/telelist/add-telelist-modal', ['#freeze_account_id']);
    });
});

function reTable() {
    $('.dt-teleListDepartment').DataTable().ajax.reload();
    // $('.dt-UnfreezeAccountDepartment').DataTable().ajax.reload();
}

function funcEditTeleListDepartment(teleDepartmentID) {
    showModalWithAjax('#editTeleDepartmentModal', '/tele/telelist/show-edit-telelist-modal/' + teleDepartmentID, ['#freeze_account_id']);
}

function funcDeleteTeleListDepartment(teleDepartmentID) {
    handleAjaxDeleteResponse(teleDepartmentID, "/tele/telelist/delete-telelist/" + teleDepartmentID);
}

function funcViewTeleListDepartment(teleDepartmentID) {
    showModalViewWithAjax('#viewTeleDepartmentModal', '/tele/telelist/view-telelist/' + teleDepartmentID, ['#freeze_account_id']);
}