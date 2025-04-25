function submittingLogin(event) {
  event.preventDefault();
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");
  emailError.innerHTML = "";
  passwordError.innerHTML = "";
  if (!password) passwordError.textContent = "Please type your password";
  else if (!email) emailError.innerHTML = "Please type your email";
  if (email && password) {
    const formElement = document.getElementById("loginForm");
    const formData = new FormData(formElement);
    fetch("components/login.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data == "success") {
          window.location.href = "index.php";
        } else if (data == "password error") {
          passwordError.textContent = "Wrong Password";
        } else {
          emailError.textContent = "Wrong Email";
        }
        // You can handle the response here, like showing a message or redirecting
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
}

function submittingSignup(event) {
  event.preventDefault();
  const fname = document.querySelector("#fname").value;
  const lname = document.querySelector("#lname").value;
  const email = document.querySelector("#semail").value;
  const address = document.querySelector("#address").value;
  const password = document.querySelector("#spassword").value;
  const fnameError = document.getElementById("fnameError");
  const lnameError = document.getElementById("lnameError");
  const semailError = document.getElementById("semailError");
  const spasswordError = document.getElementById("spasswordError");
  const Success = document.getElementById("create_success");
  fnameError.textContent = "";
  lnameError.textContent = "";
  semailError.textContent = "";
  spasswordError.textContent = "";
  if (!fname) fnameError.textContent = "Please type your First name";
  if (!lname) lnameError.textContent = "Please type your Last name";
  if (!email) semailError.textContent = "Please type your Email address";
  if (!password) spasswordError.textContent = "Please type your password";
  if (fname && lname && email && password) {
    const formElement = document.getElementById("signupForm");
    const formData = new FormData(formElement);
    fetch("components/signup.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data == "success") {
          Success.textContent = "Account Created Successfully";
          document.querySelector("#fname").value = "";
          document.querySelector("#lname").value = "";
          document.querySelector("#semail").value = "";
          document.querySelector("#address").value = "";
          document.querySelector("#spassword").value = "";
        } else {
          Success.textContent = "Email is already used";
        }
        // You can handle the response here, like showing a message or redirecting
      })
      .catch((error) => {
        console.error("Error:", error);
        Success.textContent = "Try again";
      });
  }
}

const showpass = () => {
  const show = document.getElementById("passShow");
  const password = document.getElementById("password");
  if (password.type == "password") {
    password.type = "text";
    show.innerHTML = '<ion-icon name="eye-off-outline"></ion-icon>';
  } else {
    password.type = "password";
    show.innerHTML = '<ion-icon name="eye-outline"></ion-icon>';
  }
};
const showpass2 = () => {
  const show = document.getElementById("passShow2");
  const password = document.getElementById("spassword");
  if (password.type == "password") {
    password.type = "text";
    show.innerHTML = '<ion-icon name="eye-off-outline"></ion-icon>';
  } else {
    password.type = "password";
    show.innerHTML = '<ion-icon name="eye-outline"></ion-icon>';
  }
};
