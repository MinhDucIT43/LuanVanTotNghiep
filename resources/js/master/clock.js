function updateClock() {
    const now = new Date();

    const day = String(now.getDate()).padStart(2, '0');
    const month = String(now.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0 nên cần +1
    const year = now.getFullYear();

    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    
    const timeString = `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    document.getElementById('clock').textContent = timeString;
}
// Cập nhật đồng hồ mỗi giây
setInterval(updateClock, 1000);
// Hiển thị thời gian ngay lập tức khi tải trang
updateClock();