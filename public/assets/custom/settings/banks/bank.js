$(function () {
    var dt_bankList = $('.dt-bankList')
    dt_bankList.DataTable({
        processing: true,
        paging: true,
        pageLength: 10,
        deferRender: true,
        ordering: true,
        lengthChange: false,
        bDestroy: false,
        language: {
            processing:
                '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>',
        },
        ajax: {
            url: "/settings-system/bank-list/get-data-banks",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    // เริ่มลำดับใหม่ทุกหน้า
                    return meta.row + 1;
                },
            },
            {
                data: 'bank_logo',
                class: "text-center",
                render: function (data) {
                    if (data && data.trim() !== '') {
                        return `<img src="/storage/public/uploads/banks/${data}" alt="Bank Logo" width="50" height="50" onerror="this.onerror=null; this.src='/storage/public/uploads/not-found.jpg';" />`;
                    } else {
                        return `<img src="/storage/public/uploads/not-found.jpg" alt="Bank Logo" width="50" height="50" />`;
                    }
                }
            },

            { data: 'bank_name', class: "text-center" },
            { data: 'bank_short_name', class: "text-center" },
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
                render: (data, type, row) => renderGroupActionButtons(data, type, row, 'BankList')
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
    $('#addBank').click(function () {
        showModalWithAjax('#addBankModal', '/settings-system/bank-list/add-bank-modal', ['#statusOfBank']);
    });
});

function reTable() {
    $('.dt-bankList').DataTable().ajax.reload();
}

function funcEditBankList(bankID) {
    showModalWithAjax('#editBankModal', '/settings-system/bank-list/show-bank-modal/' + bankID, ['#edit_statusOfBank']);
}

function funcDeleteBankList(bankID) {
    handleAjaxDeleteResponse(bankID, "/settings-system/bank-list/delete-bank/" + bankID);
}