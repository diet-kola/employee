document.addEventListener("DOMContentLoaded", () => {
    const user = document.getElementById("email");
    const pass = document.getElementById("password");

    if (user) user.value = "";
    if (pass) pass.value = "";
});

// Handles back/forward cache restore
window.addEventListener("pageshow", (event) => {
    if (event.persisted) {
        const user = document.getElementById("email");
        const pass = document.getElementById("password");

        if (user) user.value = "";
        if (pass) pass.value = "";
    }
});