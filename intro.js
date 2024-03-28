function validateForm()
var Firstname = document.getElementById("one").value;
var Secondname = document.getElementById("two").value;
var dob = document.getElementById("dob").value;
var Email = document.getElementById("three").value;
var Password = document.getElementById("four").value 
// Check if any field is empty 
if (
    Firstname === "" ||
    Secondname === "" ||
    dob === "" ||
    Email === "" ||
    Password == "" ||
) {
    alert("Please fill in all the fields.");
    return false;
}
//Validate username (only alphabets)
if(!/^[a-zA-Z]+$/.test(Firstname))
{
    showAndHideAlert("Firstname should only contain alphabets.",2000);
    return false;
}
//Calculate age based on date of birth