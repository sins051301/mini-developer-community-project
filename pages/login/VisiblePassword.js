function VisiblePassword(event){
    let passwordField = document.getElementById("pass");
    if (event.target.checked) {
        passwordField.type = "text";
      } else {
        passwordField.type = "password";
      }
}