document.addEventListener('DOMContentLoaded', function () {
    const messageArea = document.getElementsByClassName("message-area")[0];
    document.getElementById('editPaymentForm').addEventListener('submit', function (event) {
        const cardNumber = document.getElementById('cardNumber').value;
        const cvv = document.getElementById('cardCvc').value;

        if (cardNumber.length < 16 || !!isNaN(parseInt(cardNumber))) {
            messageArea.innerHTML += "<div id=\"message-error\" class=\"error\">\n" +
                "                <img src=\"/images/caution-icon.png\"></img>\n" +
                "                Card number not valid\n" +
                "            </div>";
            event.preventDefault();
        }
        if (cvv.length !== 3 || !!isNaN(parseInt(cvv))) {
            messageArea.innerHTML += "<div id=\"message-error\" class=\"error\">\n" +
                "                <img src=\"/images/caution-icon.png\"></img>\n" +
                "                CVV not valid\n" +
                "            </div>";
            event.preventDefault();
        }
    });
});
