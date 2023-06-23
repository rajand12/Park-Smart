function validation(){
    var user_name = document.getElementById('user-name').value;
    var password = document.getElementById('password').value;
    var userNameValidation = document.getElementById('username-validation');
    var passwordValidation = document.getElementById('password-validation');
    var isValidated = true;
    if(user_name.trim() == ""){
        userNameValidation.innerHTML = 'User name is empty';
        userNameValidation.style.display = 'block';
        isValidated = false;
    }
    else{
        userNameValidation.style.display = 'none';
    }
    if(password == ""){
        passwordValidation.innerHTML = 'Password is empty';
        passwordValidation.style.display = 'block';
        isValidated = false;
    }
    else{
        passwordValidation.style.display = 'none';
    }
    if(isValidated == true){
        document.getElementById("loginForm").submit();
    }
}