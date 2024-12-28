function getPositions() {
    $.ajax({
        url: 'staff/addStaff/getOptionPosition', // URL đến route Laravel
        method: 'GET',
        success: function(positions) {
            // Làm mới dữ liệu trong select trước khi thêm các option mới
            $('#optionPosition').empty();
            positions.forEach(function(position) {
                $('#optionPosition').append(`
                    <option selected hidden value="">Chọn chức vụ</option>
                    <option id="selectedValue" value="${position.position_code}">${position.position_name}</option>
                `);
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
