document.getElementById('paymentForm').addEventListener('submit', function(event) {
const cardNumber = document.getElementById('cardNumber').value;
const cvv = document.getElementById('cvv').value;

if (cardNumber.length < 16 || cvv.length !== 3) {
alert('Invalid card details. Please check again.');
event.preventDefault();
        }
    });