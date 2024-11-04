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

        if (hasValidData) {
            // ส่งข้อมูลไปยังเซิร์ฟเวอร์
            postFormData("/document/invoice/add-detail-invoice", formData)
                .done(function (response) {
                    onSaveFreezeSuccess(response);
                })
                .fail(handleAjaxSaveError)
                .always(function () {
                    // เปิดปุ่มบันทึกอีกครั้งหลังจากการดำเนินการเสร็จสิ้น
                    $("#saveListInvoice").prop("disabled", false);
                });
        } else {
            alert('กรุณากรอกข้อมูลให้ครบถ้วน');
            // เปิดปุ่มบันทึกอีกครั้งหากข้อมูลไม่ถูกต้อง
            $("#saveListInvoice").prop("disabled", false);
        }
    });
});

function onSaveFreezeSuccess(response) {
    if (response.status === 200) {
        // รีโหลดหน้าเพื่อแสดงข้อมูลที่อัปเดต
        location.reload(); // รีโหลดหน้าฟอร์ม
    } else {
        console.error('Unexpected status code: ' + response.status);
    }
    // handleAjaxSaveResponse(response);
    // ตรวจสอบว่าค่าของสถานะคือ 200 หรือไม่

}


// ฟังก์ชันจัดรูปแบบจำนวนเงิน
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

function setupFormValidationDetailInvoice(formElement) {
    const validators = {
        notEmpty: message => ({
            validators: {
                notEmpty: { message }
            }
        }),
        notEmptyAndRegexp: (message, regexp) => ({
            validators: {
                notEmpty: { message },
                regexp: { regexp, message: 'ข้อมูลไม่ถูกต้อง' }
            }
        })
    };

    const validationRules = {
        detail_list: validators.notEmptyAndRegexp('ระบุชื่อ เอเย่นต์', /^[a-zA-Z0-9ก-๏\s]+$/u),
        quantity: validators.notEmptyAndRegexp('ระบุ ยอดค้างในบัญชี', /^[0-9,]+(\.[0-9]{1,2})?$/u),
        amount_total: validators.notEmptyAndRegexp('ระบุ ยอดค้างในบัญชี', /^[0-9,]+(\.[0-9]{1,2})?$/u),

    };

    return FormValidation.formValidation(formElement, {
        fields: validationRules,
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.col-md-6, .col-md-2, .col-md-4'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
    });
}