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

// give a message when the user does not select a size
document.addEventListener('DOMContentLoaded', function () {
    let submitBtns = document.querySelectorAll("button[type='submit']");
    // Add event listener to all submit buttons
    for (let btn of submitBtns) {
        btn.addEventListener("click", function (event) {
            let size = document.getElementById('size').value;
            //check if size is set
            if (!size) {
                // dont submit the form
                event.preventDefault();
                let messageArea = document.getElementsByClassName("message-area")[0];
                messageArea.innerHTML += "<div id=\"message-error\" class=\"error\">\n" +
                    "                <img src=\"/images/caution-icon.png\"></img>\n" +
                    "                You have to select a size\n" +
                    "            </div>";
                return false;
            }
            // submit the form
            this.form.submit();
        });
    }
});
