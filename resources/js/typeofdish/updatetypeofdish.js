document.addEventListener('DOMContentLoaded', function() {
    console.log('test');
    var modalUpdateTypeOfDish = new bootstrap.Modal(document.querySelector('[id^="updateTypeOfDish"]'));
    modalUpdateTypeOfDish.show();
});