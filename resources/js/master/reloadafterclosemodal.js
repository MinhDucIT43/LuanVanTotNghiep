const closeModal = document.querySelectorAll(".closeModal");
// Lặp qua từng nút và gắn sự kiện click
closeModal.forEach(button => {
    button.addEventListener("click", function() {
        location.reload();
    });
});