let darkmode = localStorage.getItem('dark-mode')
const themeToggle = document.getElementById('theme-toggle')

// Function to enable dark mode, sets it to active
const enableDarkmode = () => {
    document.body.classList.add('dark-mode')
    localStorage.setItem('dark-mode', 'active')
}

// Function to disable dark mode, sets it to null
const disableDarkmode = () => {
    document.body.classList.remove('dark-mode')
    localStorage.setItem('dark-mode', null)
}

// If statement that automatically determines what mode the website is in
if(darkmode === "active") enableDarkmode()

// Once the theme toggle is clicked, the mode is reversed
themeToggle.addEventListener("click", () => {
    darkmode =  localStorage.getItem("dark-mode")
    darkmode !== "active" ? enableDarkmode() : disableDarkmode()
})

