document.addEventListener("DOMContentLoaded", e => {
    document.getElementById("signup-form").addEventListener("submit", e => logInHandler(e))
})
//Handles login
async function logInHandler(e)
{
    e.preventDefault();

    console.log("hello");
}