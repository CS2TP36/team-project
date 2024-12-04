const themeToggle = document.getElementById("theme-toggle");
let dark = true;
function toggleTheme() {
    dark = !dark;
    if (dark) {
        setTheme("dark");
    } else {
        setTheme("light");
    }
    const body = document.body;
    body.classList.toggle("light-theme");
    body.classList.toggle("dark-theme");
}

document.addEventListener('DOMContentLoaded', () => {
    dark = true;
    if (getTheme() === 'light'){
        toggleTheme();
    }
    // console.log(dark);
    const themeToggle = document.getElementById('theme-toggle');
    themeToggle.addEventListener('click', toggleTheme);
});

function setTheme(value){
    document.cookie = `theme=${value}; path=/`;
}

function getTheme() {
    let cookie = document.cookie.split(';')[0];
    let theme = cookie.split('=')[1];
    // console.log(theme);
    if (theme === 'dark') {
        return 'dark';
    } else if (theme === 'light') {
        return 'light';
    } else {
        setTheme("dark");
        return 'dark';
    }
}
