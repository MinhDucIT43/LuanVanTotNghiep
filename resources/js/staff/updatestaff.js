document.addEventListener('DOMContentLoaded', function(event) {
    console.log(document.querySelector('[id^="updateStaff"]'));
    var modalUpdateStaff = new bootstrap.Modal(document.querySelector('[id^="updateStaff"]'));
    modalUpdateStaff.show();
});