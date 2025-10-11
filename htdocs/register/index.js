document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('signIn');
    btn?.addEventListener('click', e => {
        e.preventDefault();
        window.location.href = '../login/index.php';
    });
});