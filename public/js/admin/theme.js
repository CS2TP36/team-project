addEventListener('DOMContentLoaded', () => {
    // code copied from js/darkmode.js, but adapted to work with the admin page and pico
    let darkmode = localStorage.getItem('dark-mode')
    const themeToggle = document.getElementById('theme-toggle')
    const pageTheme = (theme) => {
        document.getElementById('admin-page').setAttribute('data-theme', theme)
    }
    const enableDarkmode = () => {
        pageTheme('dark')
        localStorage.setItem('dark-mode', 'active')
    }

    const disableDarkmode = () => {
        pageTheme('light')
        localStorage.setItem('dark-mode', null)
    }

    if (darkmode === "active") enableDarkmode()

    themeToggle.addEventListener("click", () => {
        darkmode = localStorage.getItem("dark-mode")
        darkmode !== "active" ? enableDarkmode() : disableDarkmode()
    });
});
