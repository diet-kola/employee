
const modal = document.getElementById("addEmployeeModal");
const openBtn = document.getElementById("openAddEmployee");
const closeBtn = document.getElementById("closeAddEmployee");
const addErrorMsg = document.getElementById("addErrMsg");

// Open modal
openBtn.addEventListener("click", () => {
    modal.style.display = "flex";
    
});

closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
    if (addErrorMsg) addErrorMsg.style.display = "none";
});