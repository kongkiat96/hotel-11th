$(function () {
    var dt_freezeAccountAgent = $('.dt-freezeAccountAgent')
    var dt_UnfreezeAccountAgent = $('.dt-UnfreezeAccountAgent')
    dt_freezeAccountAgent.DataTable({
        processing: true,
        paging: true,
        pageLength: 10,
        deferRender: true,
        ordering: true,
        lengthChange: false,
        bDestroy: false,
        fixedColumns: {
            leftColumns: 2 // ตรึงคอลัมน์แรก
        },
        language: {
            processing:
                '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>',
        },
        ajax: {
            url: "/freeze-account/agent/table-freezeAccount-agent",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: function (d) {
                return $.extend({}, d, {
                    "statusOfFreeze": 'Y',
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
            { data: 'freeze_account', class: "text-center" },
            { data: 'machine_name', class: "text-center" },
            {
                data: 'bank_logo',
                class: "text-left",
                render: function (data, type, row, meta) {
                    if (data && data.trim() !== '') {
                        return `<img src="/storage/public/uploads/banks/${data}" alt="Bank Logo" width="30" height="30" onerror="this.onerror=null; this.src='/storage/public/uploads/not-found.jpg';" /> ` + row.bank_name;
                    } else {
                        return `<img src="/storage/public/uploads/not-found.jpg" alt="Bank Logo" width="30" height="30" /> ` + row.bank_name;
                    }
                }
            },

            { data: 'bookbank_name', class: "text-center" },
            { data: 'account_number', class: "text-center" },
            { data: 'amount_total', class: "text-center" },
            { data: 'reason_freeze', class: "text-center" },
            { data: 'created_at', class: "text-center" },
            { data: 'created_user', class: "text-center" },
            // { data: 'status_freeze', class: "text-center" },
            {
                data: "status_freeze",
                orderable: false,
                searchable: false,
                class: "text-center",
                render: renderStatusFreezeBadge
            },
            { data: 'updated_at', class: "text-center" },
            { data: 'updated_user', class: "text-center" },
            {
                data: 'ID',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: (data, type, row) => renderGroupActionButtons(data, type, row, 'FreezeList')
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

    dt_UnfreezeAccountAgent.DataTable({
        processing: true,
        paging: true,
        pageLength: 10,
        deferRender: true,
        ordering: true,
        lengthChange: false,
        bDestroy: false,
        fixedColumns: {
            leftColumns: 2 // ตรึงคอลัมน์แรก
        },
        language: {
            processing:
                '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>',
        },
        ajax: {
            url: "/freeze-account/agent/table-freezeAccount-agent",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: function (d) {
                return $.extend({}, d, {
                    "statusOfFreeze": 'N',
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
            { data: 'freeze_account', class: "text-center" },
            { data: 'machine_name', class: "text-center" },
            {
                data: 'bank_logo',
                class: "text-left",
                render: function (data, type, row, meta) {
                    if (data && data.trim() !== '') {
                        return `<img src="/storage/public/uploads/banks/${data}" alt="Bank Logo" width="30" height="30" onerror="this.onerror=null; this.src='/storage/public/uploads/not-found.jpg';" /> ` + row.bank_name;
                    } else {
                        return `<img src="/storage/public/uploads/not-found.jpg" alt="Bank Logo" width="30" height="30" />`;
                    }
                }
            },

            { data: 'bookbank_name', class: "text-center" },
            { data: 'account_number', class: "text-center" },
            { data: 'amount_total', class: "text-center" },
            { data: 'reason_freeze', class: "text-center" },
            { data: 'created_at', class: "text-center" },
            { data: 'created_user', class: "text-center" },
            // { data: 'status_freeze', class: "text-center" },
            {
                data: "status_freeze",
                orderable: false,
                searchable: false,
                class: "text-center",
                render: renderStatusFreezeBadge
            },
            { data: 'updated_at', class: "text-center" },
            { data: 'updated_user', class: "text-center" },
            {
                data: 'ID',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: (data, type, row) => renderGroupActionButtons(data, type, row, 'FreezeList')
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
    $('#addFreezeAccountAgent').click(function () {
        showModalWithAjax('#addFreezeAccountAgentModal', '/freeze-account/agent/add-freezeAccount-agent-modal', ['#status_freeze', '#bankID']);
    });
});

function reTable() {
    $('.dt-freezeAccountAgent').DataTable().ajax.reload();
    $('.dt-UnfreezeAccountAgent').DataTable().ajax.reload();
}

function renderStatusFreezeBadge(data, type, full, row) {
    const statusMap = {
        'Y': { title: 'อายัดบัญชีในระบบ', className: 'bg-label-danger' },
        'N': { title: 'ยกเลิกอายัดบัญชีในระบบ', className: 'bg-label-success' }
    };
    const status = statusMap[data] || { title: 'Undefined', className: 'bg-label-secondary' };
    return `<span class="badge ${status.className}">${status.title}</span>`;
}

function funcEditFreezeList(freezeID) {
    showModalWithAjax('#editFreezeAccountAgentModal', '/freeze-account/agent/show-edit-freezeAccount-agent-modal/' + freezeID, ['#status_freeze']);
}

function funcDeleteFreezeList(freezeID) {
    handleAjaxDeleteResponse(freezeID, "/freeze-account/agent/delete-freezeAccount-agent/" + freezeID);
}