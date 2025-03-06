// used on the account/details page to validate if there have been changes to the form
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("submit-button").addEventListener("click", function() {
        const form = document.getElementById("details-form");
        let firstNameChanged = document.getElementById("first-name-new").value !== document.getElementById("first-name-old").value;
        let lastNameChanged = document.getElementById("last-name-new").value !== document.getElementById("last-name-old").value;
        let emailChanged = document.getElementById("email-new").value !== document.getElementById("email-old").value;
        let phoneChanged = document.getElementById("phone-number-new").value !== document.getElementById("phone-number-old").value;
        if (firstNameChanged || lastNameChanged || emailChanged || phoneChanged) {
            form.submit();
        } else {
            document.getElementsByClassName("message-area")[0].innerHTML += "<div class='message'>No changes have been made</div>";
        }
    });
});
