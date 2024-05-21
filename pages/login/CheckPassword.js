function CheckPassword() {
  let password = document.getElementById("Login_pw").value;
  let confirm_password = document.getElementById("Login_pw_confirm").value;
  if (password.length < 6) {
    alert("비밀번호는 6자 이상이어야 합니다.");
    return false;
  }
  if (password != confirm_password) {
    alert("비밀번호가 일치하지 않습니다.");
    return false;
  } else {
    return true;
  }
}
