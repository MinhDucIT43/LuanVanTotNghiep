document.addEventListener('DOMContentLoaded', function() {
    const userStoreUrl = "{{ route('manager.addStaff.getOptionPosition') }}";
    $(document).ready(function() {
        $('#btnFunctionNewAdd').click(function() {
            $.ajax({
                url: userStoreUrl, // URL đến route Laravel
                method: 'GET',
                success: function(positions) {
                    positions.forEach(function(position) {
                        $('#optionPosition').append(`
                            <option value="${position.position_code}">${position.position_name}</option>
                        `);
                    });
                },
                error: function(err) {
                    console.error(err);
                }
            });
        });
    });
    var modalAddStaff = new bootstrap.Modal(document.getElementById('addStaff'));
    modalAddStaff.show();
});