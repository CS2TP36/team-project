const themeToggle = document.getElementById("theme-toggle");

function toggleTheme() {
    const body = document.body;
    body.classList.toggle("light-theme");
    body.classList.toggle("dark-theme");
}

document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    themeToggle.addEventListener('click', toggleTheme);
});