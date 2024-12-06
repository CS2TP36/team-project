const themeToggle = document.getElementById("theme-toggle");
let dark = true;
// switches between the 2 themes in css
function toggleTheme() {
    dark = !dark;
    // ensures the cookie is updated
    if (dark) {
        setTheme("dark");
    } else {
        setTheme("light");
    }
    const body = document.body;
    body.classList.toggle("light-theme");
    body.classList.toggle("dark-theme");
}

// runs when any page loaded
document.addEventListener('DOMContentLoaded', () => {
    dark = true;
    if (getTheme() === 'light'){
        toggleTheme();
    }
    // when the button is pressed needs to swap themes
    const themeToggle = document.getElementById('theme-toggle');
    themeToggle.addEventListener('click', toggleTheme);
});

function setTheme(value){
    document.cookie = `theme=${value}; path=/`;
}
// gets pre-set theme from the cookie, if none exists set to light (looks a lot better)
function getTheme() {
    // gets the value from the cookie
    let cookie = document.cookie.split(';')[0];
    let theme = cookie.split('=')[1];
    if (theme === 'dark') {
        return 'dark';
    } else if (theme === 'light') {
        return 'light';
    } else {
        // sets light by default if none selected
        setTheme("light");
        return 'light';
    }
}
