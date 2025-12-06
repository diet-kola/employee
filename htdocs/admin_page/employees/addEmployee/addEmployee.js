document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById("addEmployeeModal");

    const openBtn = document.getElementById("openAddEmployee");
    const closeBtn = document.getElementById("closeAddEmployee");
    
    const addErrorMsg = document.getElementById("addErrMsg");

    // Open modal
    openBtn.addEventListener("click", () => {
        modal.style.display = "flex"; 
    });

    //close Modal
    closeBtn.addEventListener("click", () => {
        modal.style.display = "none";
        //removes previous input
        const addForm = addModal.querySelector("form.addEmployee");
        if (addForm) addForm.reset();
        // removes error message
        if (addErrorMsg) addErrorMsg.textContent = "";
    });
});