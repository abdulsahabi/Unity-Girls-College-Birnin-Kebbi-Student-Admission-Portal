<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Sign up</title>
  <style>
    :root {
      --primary_color: #9010BF;
      --main_bg_color: #FAFAFA;
      --font-main-color: #6A696B;
    }

    @font-face {
      font-family: Time;
      src: url('../public/fonts/Roboto-Medium.ttf');
    }

    @font-face {
      font-family: Poppin;
      src: url('../public/fonts/Poppins-Medium.ttf');
    }

    @font-face {
      font-family: Poppin_bold;
      src: url('../public/fonts/Poppins-Bold.ttf');
    }

    @font-face {
      font-family: Roboto;
      src: url('../public/fonts/Roboto-Bold.ttf');
    }

    body {
      margin: 0;
      padding: 0;
      font-family: Poppin, sans-serif;
      position: relative;
      min-height: 100vh;
      width: 100%;
      overflow: hidden;
      color: #6A696B;
      background: #fcfcfc;
    }

    .signup-wrapper {
      max-width: 400px;
      background: white;
      border-radius: 15px;
      margin: 120px auto;
      box-shadow: 1px 1px 5px #efefef;
      padding: 50px;
    }

    .title {
      color: black;
      font-size: 25px;
      font-family: Poppin_bold, sans-serif;
      margin: 6px 0;
    }

    .help {
      font-size: 12px;
      margin: 10px 0;
    }

    .input-group {
      display: flex;
      flex-direction: column;
      position: relative;
      margin: 25px 0;
    }

    input {
      width: 100%;
      padding: 8px;
      border: 1px solid #efefef;
      padding-top: 24px;
      font-family: Poppin, sans-serif;
      border-radius: 4px;
      outline: none;
    }

    input:hover {
      border-color: #9010bf;
    }

    label {
      font-size: 14px;
      margin-left: 6px;
      position: absolute;
      top: 5px;
      left: 3px;
    }

    .show {
      width: 14px;
      position: absolute;
      top: 17px;
      right: 5px;
      cursor: pointer;
      display: none;
      padding: 6px;
    }

    .required {
      background: #fcfcfc;
      font-size: 10px;
      margin: 8px 0;
      padding: 5px;
      border-radius: 5px;
      width: 250px;
    }

    .star {
      color: red;
      margin-top: -13px;
    }

    .error {
      font-size: 12px;
      color: red;
      margin-left: 5px;
      margin-top: 6px;
    }

    button {
      width: 100%;
      padding: 12px 8px;
      color: white;
      background: #9020bf;
      border-radius: 5px;
      font-family: Poppin, sans-serif;
      border: none;
      margin-top: -23px;
      cursor: pointer;
    }

    .already {
      color: black;
      font-size: 12px;
      margin: 25px 0;
      display: flex;
      align-items: center;
    }

    .a {
      color: black;
      padding: 1px 5px;
      border: 1px solid grey;
      border-radius: 5px;
      text-decoration: none;
      font-size: 11px;
      margin-left: 5px;
    }

    .learn-icon {
      width: 10px;
    }
    
    #username {
        text-transform: lowercase;
    }
  </style>
</head>

<body>
  <div class="signup-wrapper">
    <div class="title">
      Sign up your account
    </div>
    <div class="help">
      Welcome to the Admin Registration Page. Please fill out the form below to create your admin account. Ensure all fields are completed accurately.
    </div>

    <form id="signup-form">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" >
        <div class="error"></div>
        <div class="required">
          <span class="star">*</span> <span>Choose a unique username for your admin account</span>
        </div>
      </div>
      <div class="input-group">
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email" >
        <div class="error"></div>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" >
        <div class="error"></div>
        <div class="required">
          <span class="star">*</span> <span>Create a strong password with at least 8 characters, including letters and numbers</span>
        </div>
        <img src="../public/icons/eye (1).png" alt="Show password" class="show" id="toggle-password">
      </div>
      <button type="submit">Submit</button>
    </form>

    <div class="already">
      Already have an account? <a href="./sign_in.php" class="a">Sign in <img src="../public/icons/right-arrow.png" alt="" class="learn-icon"></a>
    </div>
  </div>

  <script>
    document.getElementById("toggle-password").addEventListener("click", function() {
      const passwordInput = document.getElementById("password");
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.src = "../public/icons/hidden.png";
      } else {
        passwordInput.type = 'password';
        this.src = "../public/icons/eye (1).png";
      }
    });

    document.getElementById("password").addEventListener('input', function() {
      document.getElementById("toggle-password").style.display = 'block';
    });

    document.getElementById("password").addEventListener('blur', function() {
      if (this.value.trim() === '') {
        document.getElementById("toggle-password").style.display = 'none';
      }
    });
    
    var error = document.querySelectorAll(".error");
    document.getElementById("signup-form").addEventListener("submit", async function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      try {
        const res = await fetch("../include/admin.php", {
          method: "POST",
          body: formData
        });
        const result = await res.json();
       
         
        if(result.redirect) {
            window.location.assign("./admin.php")
        }
        if(result.email) {
            error[1].textContent  = result.email
        } else { 
             error[1].textContent  = ""
        }
        if(result.username) {
            error[0].textContent  = result.username
        } else {
             error[0].textContent  = ""
        }
        if(result.password) {
            error[2].textContent = result.password
        } else {
             error[2].textContent  = ""
        }
      } catch (err) {
        console.error("Error:", err);
      }
    });
  </script>
</body>

</html>
