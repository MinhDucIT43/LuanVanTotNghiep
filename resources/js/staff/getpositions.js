function getPositions() {
    $.ajax({
        url: 'staff/addStaff/getOptionPosition', // URL đến route Laravel
        method: 'GET',
        success: function(positions) {
            // Làm mới dữ liệu trong select trước khi thêm các option mới
            $('#optionPosition').empty();
            //Điền dữ liệu vào thẻ select
            $('#optionPosition').append(`
                <option selected hidden value="">Chọn chức vụ</option>
            `);
            positions.forEach(function(position) {
                $('#optionPosition').append(`
                    <option value="${position.position_code}">${position.position_name}</option>
                `);
            });
            // Lưu giá trị đã chọn vào localStorage
            $('#optionPosition').on('change', function() {
                localStorage.setItem('selectedOption', $(this).val());
            });
            // Lấy giá trị đã chọn từ localStorage và gán vào select
            $(function() {
                var selectedValue = localStorage.getItem('selectedOption');
                if (selectedValue) {
                    $('#optionPosition').val(selectedValue);
                }
            });
        },
        error: function(err) {
            console.error(err);
        }
    });
}

$(function() {
    getPositions();
});
