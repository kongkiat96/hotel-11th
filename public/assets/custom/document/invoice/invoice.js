
$(function () {
    var dt_InvoiceList = $('.dt-InvoiceList')
    var dt_InvoiceListSearch = $('.dt-InvoiceListSearch')
    dt_InvoiceList.DataTable({
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
            url: "/document/invoice/table-invoice",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: function (d) {
                return $.extend({}, d, {
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
            { data: 'GroupMonth', class: "text-center" },
            // { data: 'total_invoices', class: "text-center" },
            {
                data: 'SearchMonth',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: function (data, type, row) {
                    // console.log(row)
                    const countTotal = (row.total_invoices);
                    return renderGroupActionButtonsSearchMonth(data, type, row, 'SearchMonth', 'all_month', 'info', countTotal);
                }
            },
            // { data: 'draft_count', class: "text-center" },
            {
                data: 'SearchMonth',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: function (data, type, row) {
                    // console.log(row)
                    const countTotal = (row.draft_count);
                    return renderGroupActionButtonsSearchMonth(data, type, row, 'SearchMonth', 'draft_month', 'secondary', countTotal);
                }
            },
            // { data: 'save_count', class: "text-center" },
            {
                data: 'SearchMonth',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: function (data, type, row) {
                    // console.log(row)
                    const countTotal = (row.save_count);
                    return renderGroupActionButtonsSearchMonth(data, type, row, 'SearchMonth', 'save_month', 'success', countTotal);
                }
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

    dt_InvoiceListSearch.DataTable({
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
            url: "/document/invoice/table-search-invoice",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: function (d) {
                return $.extend({}, d, {
                    searchMonth: $("#searchMonth").val(),
                    searchTag: $("#searchTag").val(),
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
            { data: 'running_number', class: "text-center" },
            { data: 'tag_invoice', class: "text-center" },
            { data: 'date_invoice', class: "text-center" },
            { data: 'customer_name', class: "text-center" },
            {
                data: "document_status",
                orderable: false,
                searchable: false,
                class: "text-center",
                render: renderStatusDocumentBadge
            },
            { data: 'created_at', class: "text-center" },
            { data: 'created_user', class: "text-center" },
            // { data: 'status_freeze', class: "text-center" },

            { data: 'updated_at', class: "text-center" },
            { data: 'updated_user', class: "text-center" },
            {
                data: 'ID',
                orderable: false,
                searchable: false,
                class: "text-center",
                render: function (data, type, row) {
                    // console.log(row)
                    const Permission = (row.Permission);
                    return renderGroupActionButtonsPermission(data, type, row, 'InvoiceList', Permission);
                }
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
    $("#deletedInvoice").on("click", function (e) {
        e.preventDefault();

        const invoiceId = $('#invoice_id').val();
        Swal.fire({
            text: "ยืนยันการลบข้อมูล",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน",
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // ส่งคำขอ AJAX เพื่อลบข้อมูล
                $.ajax({
                    url: `/document/invoice/delete-invoice/${invoiceId}`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire({
                            text: "ลบข้อมูลสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",
                        }).then(() => {
                            window.location.href = '/document/invoice';
                        });
                    },
                    error: function (xhr) {
                        handleAjaxSaveError();
                    }
                });
            }
        }).catch(() => {
            handleAjaxSaveError();
        });
    });
});
function formatAmount(input) {
    $('input.numeral-mask').on('blur', function () {
        const value = this.value.replace(/,/g, '');
        this.value = parseFloat(value).toLocaleString('en-US', {
            style: 'decimal',
            maximumFractionDigits: 2,
            minimumFractionDigits: 2
        });
    });
}

function reTable() {
    $('.dt-InvoiceList').DataTable().ajax.reload();
    $('.dt-InvoiceListSearch').DataTable().ajax.reload();
}

function renderStatusDocumentBadge(data, type, full, row) {
    const statusMap = {
        1: { title: 'แบบร่าง', className: 'bg-label-secondary' },
        2: { title: 'บันทึกข้อมูลแล้ว', className: 'bg-label-success' }
    };
    const status = statusMap[data] || { title: 'Undefined', className: 'bg-label-danger' };
    return `<span class="badge ${status.className}">${status.title}</span>`;
}

function funcEditInvoiceList(InvoiceListID) {
    location.href = '/document/invoice/created-invoice/' + InvoiceListID;
}

function funcDeleteInvoiceList(InvoiceListID) {
    Swal.fire({
        text: "ยืนยันการลบข้อมูล",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "ยืนยัน",
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            // ส่งคำขอ AJAX เพื่อลบข้อมูล
            $.ajax({
                url: `/document/invoice/delete-invoice/${InvoiceListID}`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        text: "ลบข้อมูลสำเร็จ",
                        icon: "success",
                        confirmButtonText: "ตกลง",
                    }).then(() => {
                        // location.reload();
                        reTable();
                    });
                },
                error: function (xhr) {
                    handleAjaxSaveError();
                }
            });
        }
    }).catch(() => {
        handleAjaxSaveError();
    });
}

function funcViewInvoiceList(InvoiceListID) {
    window.location.href = '/document/invoice/view-invoice/' + InvoiceListID;
}

function funcViewSearchMonth(SearchMonth, tag_search) {
    // alert(SearchMonth);
    // console.log(SearchMonth,tag_search)
    location.href = '/document/invoice/search-month/' + SearchMonth + '/' + tag_search;
}