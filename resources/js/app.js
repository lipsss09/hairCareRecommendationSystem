import './bootstrap';
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("profileBtn");
    const dropdown = document.getElementById("profileDropdown");
    const editBtn = document.getElementById("editButton");
    const modal = document.getElementById("editModal");
    const closeModal = document.getElementById("closeModal");

    // Toggle dropdown
    btn.addEventListener("click", function (e) {
        e.stopPropagation();
        dropdown.classList.toggle("hidden");

    });

    // JANGAN tutup kalau klik di dalam dropdown
    dropdown.addEventListener("click", function (e) {
        e.stopPropagation();
    });

    // Klik luar baru tutup
    document.addEventListener("click", function () {
        dropdown.classList.add("hidden");
    });

    // Open modal
    editBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    });

    // Close modal
    closeModal.addEventListener("click", function () {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    });

    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }
    });
});

