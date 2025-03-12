addEventListener('DOMContentLoaded', () => {
    // code copied from js/darkmode.js, but adapted to work with the admin page and pico
    let darkmode = localStorage.getItem('dark-mode')
    const themeToggle = document.getElementById('theme-toggle')
    const pageTheme = (theme) => {
        document.getElementById('admin-page').setAttribute('data-theme', theme)
    }
    // Function to enable dark mode, sets it to active
    const enableDarkmode = () => {
        pageTheme('dark')
        localStorage.setItem('dark-mode', 'active')
    }
    // Function to disable dark mode, sets it to null
    const disableDarkmode = () => {
        pageTheme('light')
        localStorage.setItem('dark-mode', null)
    }
    // If statement that automatically determines what mode the website is in
    if (darkmode === "active") enableDarkmode()
    // Once the theme toggle is clicked, the mode is reversed
    themeToggle.addEventListener("click", () => {
        darkmode = localStorage.getItem("dark-mode")
        darkmode !== "active" ? enableDarkmode() : disableDarkmode()
    });
});
