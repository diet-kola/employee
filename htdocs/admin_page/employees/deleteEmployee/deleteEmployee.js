const deleteModal = document.getElementById("deleteEmployeeModal");
const closeDeleteBtn = document.getElementById("closeDeleteModal");
const cancelDeleteBtn = document.getElementById("cancelDelete");
const confirmDeleteBtn = document.getElementById("confirmDelete");

let formToSubmit = null;

// Open delete modal when clicking a Delete button
document.querySelectorAll(".del-button").forEach(btn => {
    btn.addEventListener("click", () => {
        formToSubmit = btn.closest("form"); // store the form
        deleteModal.style.display = "flex";
    });
});

// Close delete modal
closeDeleteBtn.addEventListener("click", () => deleteModal.style.display = "none");
cancelDeleteBtn.addEventListener("click", () => deleteModal.style.display = "none");


// Confirm delete
confirmDeleteBtn.addEventListener("click", () => {
    if (formToSubmit) formToSubmit.submit();
});
