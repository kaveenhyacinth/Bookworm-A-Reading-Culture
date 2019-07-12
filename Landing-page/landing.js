function signin(){
    document.getElementById("getstartbtn").innerHTML="<button id='log' onclick='signinform()' type='button'>Signin</button> <button id='sign' onclick='signupform()'>Signup</button>";
}

function signup(){
    location.href = "Registration.php";
}

function signinform(){
    document.getElementById("getstartbtn").style.display = "none";
    document.getElementById("signin_container").style.display = "block";
}
function signupform(){
    document.getElementById("getstartbtn").style.display = "none";
    document.getElementById("signup_container").style.display = "block";
}

function l_reset(){
    document.getElementById("getstartbtn").style.display = "block";
    document.getElementById("signin_container").style.display = "none";
}
function r_reset(){
    document.getElementById("getstartbtn").style.display = "block";
    document.getElementById("signup_container").style.display = "none";
}