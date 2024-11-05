
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