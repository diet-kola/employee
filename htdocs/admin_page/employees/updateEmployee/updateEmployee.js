const updateModal = document.getElementById("updateEmployeeModal");
const closeUpdateBtn = document.getElementById("closeUpdateModal");
const updErrorMsg = document.getElementById("updErrMsg");

document.querySelectorAll(".upd-button").forEach(btn => {
    btn.addEventListener("click", () => {

        updateModal.querySelector('input[name="updateId"]').value = btn.dataset.id;
        updateModal.querySelector('input[name="first_name"]').value = btn.dataset.firstn;
        updateModal.querySelector('input[name="last_name"]').value = btn.dataset.lastn;
        updateModal.querySelector('input[name="email"]').value = btn.dataset.email;
        updateModal.querySelector('input[name="phoneNum"]').value = btn.dataset.phone;
        updateModal.querySelector('select[name="position_id"]').value = btn.dataset.position;

        updateModal.style.display = "flex";
    });
});

closeUpdateBtn.addEventListener("click", () => {
    updateModal.style.display = "none";
    if (updErrorMsg) updErrorMsg.style.display = 'none';
});