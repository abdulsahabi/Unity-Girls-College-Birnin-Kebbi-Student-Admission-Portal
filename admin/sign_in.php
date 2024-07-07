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
      src: url('../public/fonts/Roboto-Bold.ttf');
    }

    @font-face {
      font-family: Roboto;
      src: url('../public/fonts/Poppins-Bold.ttf');
    }


    body {
      margin: 0;
      padding: 0;
      font-family: Poppin;
      /*   background: #FBF7FDff; */
      position: relative;
      min-height: 100vh;
      width: 100%;
      overflow: hidden;
      /*     background: #F9F2FCff; */
      color: #6A696B;
      background: #fcfcfc;
    }

    .signup-wrapper {
      max-width: 320px;

      background: white;
      border-radius: 15px;
      margin: 120px auto;
      box-shadow: 1px 1px 5px #efefef;
      padding: 50px;
    }

    .title {
      color: black;
      font-size: 25px;
      font-family: Poppin_bold;
      margin: 6px 0;
    }

    .help {
      font-size: 12px;
      margin: 10px 0;
    }

    .input-group {
      display: flex;
      color: black;
      flex-direction: column;
      position: relative;
      margin: 25px 0px;
    }

    input {
      width: 300px;
      padding: 8px;
      border: 1px solid #efefef;
      padding-top: 24px;
      font-family: Poppin_bold;
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
      color: #6A696B;
    }

    .show {
      width: 12px;
      position: absolute;
      top: 10px;
      padding: 8px;
      cursor: pointer;
      right: 10px;
      display: none;
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
      width: 320px;
      padding: 12px 8px;
      color: white;
      background: #9020bf;
      border-radius: 5px;
      font-family: Poppin;
      border: none;
      margin-top: -23px;
    }

    .already {
      color: black;
      font-size: 12px;
      margin: 25px 0px;
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
  </style>
</head>

<body>
  <div class="signup-wrapper">
    <div class="title">
      Login your account
    </div>

    <form id="signup-form">
      
      <div class="input-group">
        <label for="email">email address</label>
        <input type="text" name="email" id="email">
        <div class="error"> </div>
      </div>

      <div class="input-group">
        <label for="username">password</label>
        <input type="password" name="password" id="password">
        <div class="error"></div>
        <img src="../public/icons/eye (1).png" alt="" class="show">
      </div>
      <button>Submit</button>
    </form>

    <div class="already">
      No account? <a href="./sign_up.php" class="a">Sign up <img src="../public/icons/right-arrow.png" alt="" class="learn-icon"></a>
    </div>
  </div>
  
  
  <script>
    let showButton = document.querySelector(".show");
    let passwordInput = document.getElementById("password");
   showButton.addEventListener("click", () => {
     
     if(passwordInput.type === 'password') {
       showButton.src = "../public/icons/hidden.png";
       passwordInput.type = 'text'
     } else {
       showButton.src = "../public/icons/eye (1).png";
       passwordInput.type = 'password'
       
     }
   });
   
   passwordInput.addEventListener('input', () => {
     showButton.style.display = 'block';
   });
   
   passwordInput.addEventListener('blur', () => {
     if(passwordInput.value.trim() === '') {
      showButton.style.display = 'none';
     }
   });
   
   var error = document.querySelectorAll(".error");
  // error[0].textContent = "yy"
    document.getElementById("signup-form").addEventListener("submit", async function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      try {
        const res = await fetch("../include/sign_in.php", {
          method: "POST",
          body: formData
        });
        const result = await res.json();
        
      
         
        if(result.redirect) {
              window.location.assign("./admin.php")
        }
        
        if(result.email) {
          
            error[0].textContent  = result.email
      
      
      
        } else { 
             error[0].textContent  = ""
        }
       
        if(result.password) {
            error[1].textContent = result.password
        } else {
             error[1].textContent  = ""
        }
        
      } catch (err) {
        console.error("Error:", err);
      }
    });
  </script>
</body>

</html>