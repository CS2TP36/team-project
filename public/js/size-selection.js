const buttons = document.querySelectorAll(".size-selection");

buttons.forEach(button => {
    button.addEventListener("click", () => {
        buttons.forEach(btn => {
            btn.style.backgroundColor = "transparent";
            // Need to grab text colour variable
            btn.style.color = "var(--text-colour)";
        });
        button.style.backgroundColor = "#1E1E1E";
        button.style.color = "#F5F5F5";
    });
});

function selectSize(size) {
    document.getElementById('size').value = size;
    document.getElementById('wishsize').value = size;
}
