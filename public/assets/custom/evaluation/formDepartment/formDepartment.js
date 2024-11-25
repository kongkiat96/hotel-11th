$(function () {
    var dt_formDepartmentDetail = $('.dt-formDepartmentDetail')
    dt_formDepartmentDetail.DataTable({
        processing: true,
        paging: false,  // ปิดการแบ่งหน้า (pagination)
        deferRender: true,
        ordering: false,
        lengthChange: false,  // ปิดตัวเลือกเปลี่ยนจำนวนแถวต่อหน้า
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
            url: '/assets/json/formDepartmentDetail.json', // ใช้เส้นทางที่เป็นไฟล์ JSON
            type: 'GET',
            dataSrc: 'data' // ใช้ 'data' เพื่อให้ DataTables นำข้อมูลจากฟิลด์ 'data' ใน JSON มาแสดง
        },
        columns: [
            { data: 'num', class: "text-center" },
            { data: 'title', class: "text-center" },
            { data: 'detail', class: "text-left" },
            { data: 'score', class: "text-center" },
            { data: 'criterion', class: "text-left" },
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
    $('#addFormDepartment').click(function () {
        showModalWithAjax('#addFormDepartmentModal', '/evaluation/form-department/add-form-department-modal', ['#select_employee']);
    });
});

function reTable() {
    $('.dt-formDepartmentDetail').DataTable().ajax.reload();
    // $('.dt-InvoiceListSearch').DataTable().ajax.reload();
}

var datePickers = ['date_a', 'date_b', 'date_c', 'date_d', 'date_e', 'date_f', 'date_g', 'date_h', 'date_i', 'date_j', 'date_k', 'date_l', 'date_m', 'date_n', 'date_o', 'date_p'];
initializeDatePickers(datePickers);
// ฟังก์ชันสำหรับคำนวณคะแนนรวม
function calculateTotalScore() {
    let totalScore = 0;

    // หา input ทุกตัวที่มี class 'score-input'
    const scoreInputs = document.querySelectorAll('.score-input');

    // Loop ผ่าน input ทุกตัว
    scoreInputs.forEach(function (input) {
        const score = parseFloat(input.value) || 0;  // ใช้ค่าคะแนนที่กรอก ถ้าไม่ใช่ตัวเลขจะให้เป็น 0
        totalScore += score;
    });

    // แสดงผลรวมคะแนน
    document.getElementById('total-score').textContent = totalScore;
}

// ฟังก์ชันที่ใช้ตรวจสอบและปรับปรุงค่าที่กรอก
function checkMaxValue(input) {
    const min = parseFloat(input.min);
    const max = parseFloat(input.max);
    let value = parseFloat(input.value);

    // ถ้าค่าที่กรอกน้อยกว่าค่าต่ำสุดให้ตั้งเป็นค่าต่ำสุด
    if (value < min) {
        input.value = min;
    }
    // ถ้าค่าที่กรอกมากกว่าค่าสูงสุดให้ตั้งเป็นค่าสูงสุด
    else if (value > max) {
        input.value = max;
    }
}

// เรียกฟังก์ชัน checkMaxValue ทุกครั้งที่มีการกรอกคะแนน
const scoreInputs = document.querySelectorAll('.score-input');
scoreInputs.forEach(function (input) {
    input.addEventListener('input', function () {
        checkMaxValue(input);  // ตรวจสอบค่าที่กรอก
        calculateTotalScore();  // คำนวณคะแนนรวมใหม่
    });
});

// เรียกฟังก์ชันครั้งแรกเพื่อให้แสดงผลรวมเริ่มต้น
calculateTotalScore();