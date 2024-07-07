
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admission form | Sign up</title>
  <style>
    :root {
      --primary_color: #9010BF;
      --main_bg_color: #FAFAFA;
      --font-main-color: #6A696B;
    }

    @font-face {
      font-family: Time;
      src: url('../public/fonts/times.ttf');
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
      font-family: Poppin;
      margin: 0;
      padding: 0;
      background-color: var(--main_bg_color);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      width: 100%;
      background: #FBF7FDff;
    }

    .form-container {
      width: 400px;
      height: 550px;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      background: white;
      border-radius: 20px;
      border: 1px solid lightgrey;
      padding: 30px 0;
      margin-top: 60px;
      position: relative;
      
    }


    form {
        height: 500px; 
    }

    .anime-title {
      font-family: Poppin_bold;
    }




    .input-group {
      position: relative;
      margin-bottom: 15px;

    }

    .shift-label {
      position: absolute;
      top: 13px;
      left: 12px;
      font-size: 14px;
      font-weight: 400;
      color: var(--font_main_color);
      transition: 0.2s;
    }

    input {
      width: 300px;
      padding: 16px 15px;
      font-size: 17px;
      outline: none;
      font-weight: 400;
      border-radius: 5px;
      border: 1px solid lightgrey;
      color: var(--font-main-color);
      background: white;

    }

    #search {
      width: 290px;
      margin-bottom: 15px;
    }

    option {
      color: var(--font-main-color);
    }

    input:hover {
      border-color: var(--primary_color);
    }

    input:focus~.shift-label {
      color: var(--primary_color);
      top: -10px;
      left: 12px;
      background: white;
      padding: 3px 10px;
      font-size: 14px;
    }

    .error {
      color: red;
      font-family: Poppin;
      margin: 2px 6px;
      font-size: 15px;
      margin-bottom: 5px;
    }

    .steps {
      height: 100px;
      width: 328px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-bottom: 15px;
    }

    .account-creation {
      font-size: 20px;
      font-weight: 450;
      margin-bottom: 4px;
      color: var(--primary_color);
    }

    .percentage {
      width: 220px;
      display: flex;
      color: var(--font_main_color);
      align-items: center;
      justify-content: space-between;
      font-family: Poppin;
      margin-top: 15px;
      font-size: 14px;
      margin: 15px 0;

    }

    .status {
      padding: 2px 5px;
      margin: 0 2px;
      background: var(--main_bg_color);
      border-radius: 10px;
    }


    .form-wrapper {
      width: 328px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-bottom: 35px;
      

    }

    .sec-title {
      font-size: 18px;
      font-family: Poppin;
      margin: 10px 0;
    }

    .status {
      position: relative;
    }

    .status:hover::after {
      content: attr(title);
      position: absolute;
      top: 100%;
      left: 50%;
      transform: translateX(-50%);
      padding: 5px 10px;
      background-color: #000;
      color: #fff;
      border-radius: 5px;
      white-space: nowrap;
    }

    .select {
      width: 300px;
      display: flex;
      padding: 16px 13px;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 8px;
      border-radius: 5px;
      background: var(--main_bg_color);
      border: 1px solid var(--main_bg_color);
      cursor: pointer;
    }

    .select:hover {
      border: 1px solid var(--primary_color);
    }

    
    .icon {
      width: 12px;
      transition: 0.1s;
    }

    .rotate-icon {
      transform: rotate(60deg);
    }

    .btn {
      width: 330px;
      padding: 15px;
      font-family: Poppin;
      font-size: 14px;
      background: var(--primary_color);
      color: white;
      text-align: center;
      cursor: pointer;
      border-radius: 10px;
    }

    .btn-wrapper {
      margin-top: 10px;
      display: flex;
      align-items: flex-end;
      justify-content: flex-end;
    }

    .sign-in {
      width: 300px;
      text-align: center;
      margin-top: 70px;
      padding: 15px;
      position: relative;

    }

    .sign-in::before {
      content: '';
      display: block;
      width: 220px;
      background: lightgray;
      height: 1px;
      position: absolute;
      left: 60px;
      top: -10px;
      ;
    }

    .sign-in::after {
      content: 'Or';
      display: block;
      width: 20px;
      background: white;
      position: absolute;
      left: 150px;
      top: -27px;
      ;
      color: lightgray;
      padding: 10px;
    }

    .login {
      color: blue;
      font-weight: 500;
    }

    form {
      display: flex;

    }

    #personal-information {
      display: block;
      transition: .5s;
    }



    }

    .input-group {
      position: relative;
    }

    .show {
      position: absolute;
      right: 4px;
      font-size: 12px;
      top: 4px;
      padding: 12px;
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
      font-weight: bold;
      z-index: 1;
      cursor: pointer;
      background: var(--main_bg_color);
      display: none;
    }

    .login-title {
      font-size: 30px;
      font-weight: bold;
      font-family: Poppin_bold;
      position: relative;
    }
    
    .login-title::before {
      content: '';
      width: 35px;
      height: 4px;
      background: var(--primary_color);
      position: absolute ;
      left: 19px;
      top: 40px;
      border-radius: 12px;
    }
    
    .btn {
      font-size: 16px;
    }
    
    
    .forgot-wrapper {
      margin: 30px 0px;
      font-size: 16px;
      text-align: center;
      
    }
    
        .forgot-wrapper a {
          color: var(--font-main-color);
          font-family: Poppin;
          
        }
    /* 
      .status-1, {
      background: rgb(230, 244, 234);
      color: green;
      }
      
      */
      
      .login {
        text-decoration: none;
      }
      
      .forgot {
        text-decoration: none;
      }
      
      .animation-wrapper {
      width: 400px;
      height: 550px;
      display: none;
      align-items: flex-start;
      justify-content: center;
      background: white;
      border-radius: 20px;
      
      padding:  0;
      overflow: hidden ;
      position: absolute;
      top: 0;
      z-index: 2;
      opacity: 0.6;
      }
      
      .active {
        display: flex;
      }
      
      .left {
        width: 400px;
        height: 8px;
        position: relative;
        background: #fafafa;
      }
      
      .loader {
        width: 90px;
        height: 8px;
        background: #9010bf;
        border-radius: 12px;
        position: absolute;
        left: -40px;
        animation: spinner 0.7s infinite;
      }
      
      @keyframes spinner {
        0 {
          left: 0%;
        } 100% {
          left: 100%;
        }
      }
  </style>
</head>

<body>

  <div class="form-container" id="student-data">
    <div class="animation-wrapper">
      <div class="left">
        <div class="loader">
          
        </div>
      </div>
    </div>
    
    <div class="input-container">
      <div class="steps">
        <div class="login-title">
          Login 
        </div>
      </div>
      <div class="form-wrapper">

      
        <form>
          <div id="personal-information">
            <div class="input-group">
             
              <input type="text" id="email" name="email">
              <label for="email" class="shift-label">
                Email or Admission Id
              </label>
              <div class="error">
                
              </div>
            </div>

            <div class="input-group">
              <input type="password" id="password" name="password">
              <label for="password" class="shift-label">
                Password
              </label>
              <div class="error"></div>
              <div class="show">
                Show
              </div>
            </div>
            <div class="input-group">
              <input type="submit" id="submit" name="submit" class="btn" value="Sign in">
              <label for="submit" hidden class="shift-label">

              </label>
              
              <div class="forgot-wrapper">
                <a href="forgot.php" class="forgot">Forgot password?</a>
              </div>
              <div class="error"></div>
            </div>
            <div class="sign-in">
              Don't have an account? <a href="form.php" class="login">Sign up</a>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', (event) => {



      // Add event listener for input blur for real-time validation 
      var inputs = document.querySelectorAll('input');
      var password = document.getElementById('password');
      var passwordErr = document.getElementById('pass-err');
      var shows = document.querySelector('.show');

    

      inputs.forEach(input => {
        input.addEventListener('blur', () => {
          var siblingEle = input.nextElementSibling;
          if (siblingEle !== null) {
            if (input.value.length > 0) {

              // Update styles for non-empty input
              siblingEle.style.top = '-10px';
              siblingEle.style.left = '15px';
              siblingEle.style.background = 'white';
              siblingEle.style.padding = '3px 10px';
              siblingEle.style.fontSize = '14px';
              siblingEle.style.color = 'var(--primary_color)';
            } else {

              // Update styles for empty input
              siblingEle.style.top = '13px';
              siblingEle.style.left = '2px';
              siblingEle.style.background = 'white';
              siblingEle.style.fontSize = '14px';
              siblingEle.style.color = 'var(--font_main_color)';
            }
          }

          if (input.value.length > 0 && input.id === 'password' ) {
            shows.style.display = 'block';
               } else {
            shows.style.display = 'none';
          }
          
          
          
          // Real-time error remove if at least the input field 
          // is greater than 0, then remove the error text
          var err = input?.nextElementSibling.nextElementSibling;


          if (input.value.length > 0 && input.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            err.textContent = '';
          }


          



        });
      });



      // Add event listener for input focus for real-time validation.
      inputs.forEach(input => {
        input.addEventListener('focus', () => {

          var siblingEle = input.nextElementSibling;

          if (siblingEle !== null) {
            siblingEle.style.top = '-10px';
            siblingEle.style.left = '15px';
            siblingEle.style.background = 'white';
            siblingEle.style.padding = '3px 10px';
            siblingEle.style.fontSize = '14px';
            siblingEle.style.color = 'var(--primary_color)';
          }

          shows.style.display = 'block';


        });
        
        
      });




shows.addEventListener('click', () => {

          if (inputs[1].id === 'password' && inputs[1].type === 'password') {
            inputs[1].type = 'text';
            shows.textContent = 'Hidden';
          } else if (inputs[1].id === 'password' && inputs[1].type === 'text') {
            inputs[1].type = 'password';
            shows.textContent = 'Show';
          }

        });




  var form = document.querySelector('form');
  var loader = document.querySelector('.animation-wrapper');
  var error = document.querySelectorAll(".error");
  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    if(this.email.value.trim() === "") {
        error[0].textContent = "Emai or admission number is required.";
    } else {
      error[0].textContent = ""
    }
    
    
    if(this.password.value.trim() === "") {
        error[1].textContent = "Password is required."
    } else {
      error[1].textContent = ''
    }
    
    let formData = new FormData(this);
    
    try {
      
      if(this.email.value.trim() !== "" && this.password.value.trim() !== "" ) {
      
      const res = await fetch('../include/login.php', {
        method: 'POST',
        body: formData
      });
      loader.classList.add('active');
      
      if(!res.ok) {
       throw Error('Something wrong with the server, try again.');
      }
      
      const result = await res.json();
        ///alert(result )
      
      if(result.redirect) {
        setTimeout(() => {
         window.location = './dashboard.php';
        }, 1000);
      }
      
      if(result.email) {
        error[0].textContent = result.email;
      }
      
    
      
      if (result.password) {
        error[1].textContent = result.password;
      }
      
      
      }
    } catch(err) {
       
      alert(err.message)
    } finally {
      setTimeout(() => {
          loader.classList.remove('active');
        }, 1000);
      
    }
    
  });

    });
  </script>
</body>

</html>