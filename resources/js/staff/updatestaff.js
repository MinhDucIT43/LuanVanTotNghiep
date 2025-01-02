document.addEventListener('DOMContentLoaded', function() {
    console.log(document.querySelector('[id^="updateStaff"]'));
    var modalUpdateStaff = new bootstrap.Modal(document.querySelector('[id^="updateStaff"]'));
    modalUpdateStaff.show();
});