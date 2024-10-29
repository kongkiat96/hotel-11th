$(function () {
    var dt_rentAccount = $('.dt-rentAccount')
    dt_rentAccount.DataTable({
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
            url: "/accounting/rent-account/table-rent-account",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: function (d) {
                // return $.extend({}, d, {
                //     "statusOfFreeze": 'Y',
                // });
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
            { data: 'rent_department', class: "text-center" },
            { data: 'date_request_rent', class: "text-center" },
            { data: 'date_send', class: "text-center" },


            { data: 'rent_total', class: "text-nowrap" },
            {
                data: 'rent_reason',
                class: "text-center",
                render: function (data, type, row) {
                    if (data && data.length > 50) { // เช็คความยาวของข้อความ
                        return data.substring(0, 50) + '...'; // ตัดข้อความเหลือ 20 ตัวอักษร พร้อมใส่ "..." ต่อท้าย
                    }
                    return data; // แสดงข้อความตามปกติหากสั้นกว่า 20 ตัวอักษร
                }
            },
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
                    // console.log(row)
                    const Permission = (row.Permission);
                    return renderGroupActionButtonsPermission(data, type, row, 'RentAccount', Permission);
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
    $('#addRentAccount').click(function () {
        showModalWithAjax('#addRentAccountModal', '/accounting/rent-account/add-rent-account-modal',[]);
    });

});
function reTable() {
    $('.dt-rentAccount').DataTable().ajax.reload();
}

function funcEditRentAccount(rentAccountID) {
    showModalWithAjax('#editRentAccountModal', '/accounting/rent-account/show-edit-rent-account-modal/' + rentAccountID,[]);
}

function funcDeleteRentAccount(rentAccountID) {
    handleAjaxDeleteResponse(rentAccountID, "/accounting/rent-account/delete-rent-account/" + rentAccountID);
}

function funcViewRentAccount(rentAccountID) {
    showModalViewWithAjax('#viewRentAccountModal', '/accounting/rent-account/view-rent-account/' + rentAccountID,[]);
}