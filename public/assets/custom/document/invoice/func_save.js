$(document).ready(function () {



    $(document).on("click", ".bxs-trash-alt", function () {
        const itemToDelete = $(this).closest("[data-repeater-item]");
        // ดึง ID ของรายการที่ต้องการลบ
        const itemId = itemToDelete.find("input[name*='[id]']").val();
        // ถ้าต้องการลบจากฐานข้อมูล
        if (itemId) {
            $.ajax({
                url: '/document/invoice/delete-detail-invoice/' + itemId, // เปลี่ยน URL ตามที่คุณต้องการ
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status === 200) {
                        // ถ้าลบสำเร็จให้ลบจากฟอร์ม
                        itemToDelete.remove();
                        location.reload();
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + response.message);
                    }
                },
                error: function (error) {
                    alert('เกิดข้อผิดพลาดในการลบ');
                    console.error(error);
                }
            });
        } else {
            // ถ้าไม่พบ ID ก็ลบเฉพาะในฟอร์ม
            itemToDelete.remove();
        }
    });

    $("#saveListInvoice").on("click", function (e) {
        e.preventDefault();
        // ปิดปุ่มบันทึกชั่วคราวเพื่อป้องกันการคลิกซ้ำ
        $(this).prop("disabled", true);
        const form = $("#formListInvoice")[0];
        const formData = new FormData(form);
        // ตรวจสอบว่ามีข้อมูลที่ต้องบันทึก
        const hasValidData = Array.from(formData.entries()).some(([key, value]) => {
            return key.includes('group-detail-invoice') && value.trim() !== '';
        });

        const hasSelectedTagList = Array.from(formData.entries()).some(([key, value]) => {
            return key.includes('tag_list') && value.trim() !== '';
        });

        if (hasValidData && hasSelectedTagList) {
            // ส่งข้อมูลไปยังเซิร์ฟเวอร์
            postFormData("/document/invoice/add-detail-invoice", formData)
                .done(function (response) {
                    // เมื่อสำเร็จแล้ว ให้เรียกฟังก์ชัน handleSaveInvoice เพื่อบันทึกข้อมูลจากฟอร์ม saveInvoice
                    handleSaveInvoice("/document/invoice/save-invoice", true);
                })
                .fail(handleAjaxSaveError)
                .always(function () {
                    // เปิดปุ่มบันทึกอีกครั้งหลังจากการดำเนินการเสร็จสิ้น
                    $("#saveListInvoice").prop("disabled", false);
                });
        } else {
            Swal.fire({
                icon: 'warning',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน และเลือกประเภทค่าใช้จ่าย',
                confirmButtonText: 'ตกลง'
            });
            // เปิดปุ่มบันทึกอีกครั้งหากข้อมูลไม่ถูกต้อง
            $("#saveListInvoice").prop("disabled", false);
        }
    });

    function handleSaveInvoice(url, validate = true) {
        removeValidationFeedback();

        const customerName = $("#customer_name").val();
        const address = $("#address").val();
        const issuse = $("#issuse").val();
        const contact = $("#contact").val();
        const payment = $("#payment").val();
        const note = $("#note").val();
        const invoice_id = $("#invoice_id").val();
        const payment_tag = $("#payment_tag").val();
        // ตรวจสอบเฉพาะถ้า validate เป็น true
        if (validate && (!customerName || customerName.trim() === "")) {
            Swal.fire({
                icon: 'warning',
                text: 'กรุณาระบุลูกค้า / Customer',
                confirmButtonText: 'ตกลง'
            });
            $("#saveInvoice, #saveDrawingInvoice").prop("disabled", false);
            return;
        }

        const formData = new FormData();
        formData.append("customer_name", customerName);
        formData.append("address", address);
        formData.append("issuse", issuse);
        formData.append("contact", contact);
        formData.append("payment", payment);
        formData.append("note", note);
        formData.append("invoice_id", invoice_id);
        formData.append("payment_tag", payment_tag);

        // ส่งข้อมูลไปยัง URL ที่กำหนด
        postFormData(url, formData)
            .done(onSaveInvoiceSuccess)
            .fail(handleAjaxSaveError);
    }

    $("#saveInvoice").on("click", function (e) {
        e.preventDefault();
        handleSaveInvoice("/document/invoice/save-invoice", true);  // ต้องการ validate
    });

    $("#saveDrawingInvoice").on("click", function (e) {
        e.preventDefault();
        handleSaveInvoice("/document/invoice/save-invoice-drawing", false); // ไม่ต้องการ validate
    });

});

function onSaveInvoiceListSuccess(response) {
    if (response.status === 200) {
        // รีโหลดหน้าเพื่อแสดงข้อมูลที่อัปเดต
        location.reload(); // รีโหลดหน้าฟอร์ม
    } else {
        console.error('Unexpected status code: ' + response.status);
    }
    // handleAjaxSaveResponse(response);
    // ตรวจสอบว่าค่าของสถานะคือ 200 หรือไม่

}

function onSaveInvoiceSuccess(response) {
    if (response.status === 200) {
        Swal.fire({
            icon: 'success',
            text: 'บันทึกข้อมูลสำเร็จ',
            confirmButtonText: 'ตกลง'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload(); // รีโหลดหน้าฟอร์มหลังจากกดตกลง
            }
        });
    } else {
        console.error('Unexpected status code: ' + response.status);
    }
}