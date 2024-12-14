const rows = document.querySelectorAll(".table tbody tr");
rows.forEach((row, index) => {
    row.cells[0].textContent = index + 1;
});