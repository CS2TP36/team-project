<script> 

function cancelEdit (){
 window.location.href = "profile.html";
}
document.getElementById('editAddressForm').addEventListener('submit', function(event){
    event.preventDefault();

const fullName = document.getElementById('full_Name').value.trim();
const phoneNumber = document.getElementById('phone_Number').value.trim();
const postCode = document.getElementById('post_Code').value.trim();
const addressLine1 = document.getElementById('address_Line1').value.trim();
const townCity = document.getElementById('town_City').value.trim();

if (!fullName|| !phoneNumber || !postCode || !addressLine1 || !townCity){
alert('please fill out all required fields.');
return;
}
const phoneRegex = /^\d{10}$/;
if(!phoneRegex.test(phoneNumber)){
    alert ('please enter a valid 10-digit phone number.');
    return;
}
this.submit();
});
 


</script>