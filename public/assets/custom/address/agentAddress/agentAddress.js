$(function () {
    var dt_agentAddress = $('.dt-agentAddress')
    dt_agentAddress.DataTable({
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
            url: "/address/agent-address/table-agent-address",
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
            { data: 'address_department', class: "text-center" },
            { data: 'employee_total', class: "text-center" },
            {
                data: 'space_working',
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
                    return renderGroupActionButtonsPermission(data, type, row, 'AgentAddress', Permission);
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

function reTable() {
    $('.dt-agentAddress').DataTable().ajax.reload();
}

$(document).ready(function () {
    $('#addAgentAddress').click(function () {
        showModalWithAjax('#addAgentAddressModal', '/address/agent-address/add-agent-address-modal',[]);
    });

});


function funcEditAgentAddress(AgentAddress) {
    showModalWithAjax('#editAgentAddressModal', '/address/agent-address/show-edit-agent-address-modal/' + AgentAddress,[]);
}

function funcDeleteAgentAddress(AgentAddress) {
    handleAjaxDeleteResponse(AgentAddress, "/address/agent-address/delete-agent-address/" + AgentAddress);
}

function funcViewAgentAddress(AgentAddress) {
    showModalViewWithAjax('#viewAgentAddressModal', '/address/agent-address/view-agent-address/' + AgentAddress,[]);
}