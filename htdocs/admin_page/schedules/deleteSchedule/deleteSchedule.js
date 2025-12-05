const deleteModal = document.getElementById("deleteSchedModal");
const closeDeleteBtn = document.getElementById("closeDeleteModal");
const cancelDeleteBtn = document.getElementById("cancelDelete");
const confirmDeleteBtn = document.getElementById("confirmDelete");

let formToSubmit = null;

// Open delete modal
document.querySelectorAll(".del-btn").forEach(btn => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();
        formToSubmit = btn.closest("form");
        deleteModal.style.display = "flex";
    });
});

// Close modal
closeDeleteBtn.addEventListener("click", () => deleteModal.style.display = "none");
cancelDeleteBtn.addEventListener("click", () => deleteModal.style.display = "none");

// Submit form on confirm
confirmDeleteBtn.addEventListener("click", () => {
    if (formToSubmit) formToSubmit.submit();
});