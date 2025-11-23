function openNav() {
    document.getElementById("sidebar").style.width = "300px";
    document.getElementById("main").style.marginLeft = "300px";
    document.getElementById("header").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("header").style.marginLeft = "0";
}

window.addEventListener('DOMContentLoaded', () => {
    if(localStorage.getItem('sidebarOpen') === 'true') {
        openNav();
    } else {
        closeNav();
    }
});