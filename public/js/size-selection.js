
const buttons = document.querySelectorAll(".size-selection");

buttons.forEach(button => {
    button.addEventListener("click", () => {
        buttons.forEach(btn => {
            btn.style.backgroundColor = "#4D4D4D";
        });
        button.style.backgroundColor = "#1D1D1D";
    });
});

function selectSize(size) {
    document.getElementById('size').value = size;
    document.getElementById('wishsize').value = size;
}
