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
      font-family: sans-serif;
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

    .animation-loading {
      width: 350px;
      height: 650px;
      background: white;
      position: absolute;
      z-index: 1;
      opacity: 0.7;
      display: none;
      border-radius: 20px;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }



    .active_anime {
      display: flex;
    }

    .anime-spinner {
      width: 40px;
      height: 40px;
      background: transparent;
      border: 10px solid #F0F0F0;
      border-radius: 50%;
      border-left-color: var(--primary_color);
      animation: spinner 0.5s infinite;
    }

    .anime-title {
      font-family: Poppin_bold;
    }


    @keyframes spinner {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .input-group {
      position: relative;
      margin-bottom: 15px;

    }

    .shift-label {
      position: absolute;
      top: 18px;
      left: 12px;
      font-size: 14px;
      font-weight: 400;
      color: var(--font_main_color);
      transition: 0.2s;
      font-family: Poppin
    }

    input {
      width: 300px;
      padding: 16px;
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


    .input-group {
      position: relative;
    }

    .show {
      position: absolute;
      right: 4px;
      font-size: 12px;
      top: 6px;
      padding: 14px 15px;
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
      font-weight: bold;
      z-index: 1;
      cursor: pointer;
      background: var(--main_bg_color);
      display: none;
      border-left: 1px solid lightgrey;
    }

    .login-title {
      font-size: 25px;
      font-weight: bold;
      font-family: Poppin_bold;
      position: relative;
    }

    .login-title::before {
      content: '';
      width: 50px;
      height: 4px;
      background: var(--primary_color);
      position: absolute;
      left: 55px;
      top: 30px;
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

    .button {
      width: 305px;
      padding: 15px;
      font-family: Poppin;
      font-size: 14px;
      background: var(--primary_color);
      color: white;
      cursor: pointer;
      border-radius: 10px;
      text-align: center;
      border: 1px solid white;
      transition: .2s;
    }

    .button:hover {
      border: 1px solid var(--primary_color);
      color: var(--font-main-color);
      background: white;
    }

    .profile {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      width: 320px;
      padding: 12px 0;
      padding-left: 10px;
      background: var(--main_bg_color);
    }

    .user-dp {
      width: 80px;
      height: 80px;
      margin-right: 20px;
      border-radius: 30%;
      ;
    }

    .name {
      font-family: Poppin;
      font-size: 20px;
    }

    .email-address {
      font-family: Poppin;
    }



    #verify-code {
      text-align: center;
      font-family: Poppin;
      padding: 12px;
      width: 310px;
    }

    #verify-code::placeholder {
      font-size: 16px;
      font-family: Poppin;
    }


    .not-deliver {
      width: 310px;
      padding: 20px 12px;
      padding-bottom: 5px;
      text-align: center;
      font-family: Poppin;
      color: var(--font-main-color);
    }

    .sms-notify {
      font-family: Poppin;
      color: var(--font-main-color);
      font-size: 15px;
      padding-top: 20px;
      padding-bottom: 5px;
      padding-left: 5px;
    }

    .email-encode {
      font-family: Poppin_bold;
      color: #2D2D2D;
      padding: 0 3px;
    }


    #find-container {
      display: block;
    }

    #result-container {
      display: none;
    }


    .verify-wrapper {
      display: block;
    }

    .change-wrapper {
      display: none;

    }

    #resend {
      margin-top: 15px;
      display: none;
    }

    #expired {
      display: none;
    }


    .anime {
      width: 305px;
      padding: 15px;
      font-family: Poppin;
      font-size: 14px;
      background: var(--primary_color);
      color: white;
      cursor: pointer;
      border-radius: 10px;
      text-align: center;
      border: 1px solid white;
      transition: .2s;
      display: none;
    }

    .anime::before {
      display: block;
      content: "Please wait.";
      width: 300px;
      animation-name: loading;
      animation-duration: 1.5s;
      animation-iteration-count: infinite;
    }

    @keyframes loading {
      0% {
        content: "Please wait";
      }

      35% {
        content: "Please wait.";
      }

      70% {
        content: "Please wait..";
      }

      100% {
        content: "Please wait...";
      }
    }

    #change-btn {
      width: 300px;
      margin: 15px 0;
    }
  </style>
</head>

<body>

  <div class="form-container" id="student-data">
    <div class="input-container">
      <div class="steps">
        <div class="login-title" id="test">
          Forgot password
        </div>
      </div>
      <div class="form-wrapper">


        <form>
          <div class="div" id="find-container">
            <div class="input-group">
              <input type="text" id="email" name="email">
              <label for="email" class="shift-label">
                Find by email
              </label>
              <div class="error"></div>
            </div>

            <div class=" anime anime-1"> </div>
            <div id="find" class="button">
              Find my account
            </div>
          </div>
          <div id="result-container">
            <div class="input-group">
              <div class="profile">
                <img src="../public/icons/user.png" alt="student profile" class="user-dp">
                <div class="user-details">
                  <div class="name">
                    Nafisa Sahabi
                  </div>
                  <div class="email-address">
                    <span class="email-encode">example@google.com </span>
                  </div>
                  <div class="admission-id">
                    UNT/24/0022
                  </div>
                </div>
              </div>
            </div>
            <div class="verify-wrapper">
              <div class="sms-notify">
                To reset your password, please paste the code sent to your email<span class="email-encode">example@google.com </span>below.
              </div>
              <div class="input-group">
                <input type="number" id="verify-code" name="verify-code" placeholder="Enter the 6-digit code">
                <label for="" hidden></label>
                <div class="error"></div>
              </div>
              <div class="digits"></div>
              <div class="button" id="verify-btn">
                Verify
              </div>

              <input type="text" value="2024-05-24 14:34:25" id="expiredAt" hidden>
              <div class="not-deliver" id="expired">Code expires in <span id="time">10:00</span></div>
              <div class="button" id="resend">
                Resend
              </div>
            </div>

            <div class="change-wrapper">
              <div class="input-group">
                <input type="password" name="password" id="password">
                <label for="password" class="shift-label">Password</label>
                <div class="error" id="er1"></div>
                <!--
                <div class="show">Show</div>
                -->
              </div>
              <div class="input-group">
                <input type="password" name="cpassword" id="cpassword">
                <label for="cpassword" class="shift-label">Retype password</label>
                <div class="error" id="er2"></div>
                <!--<div class="show">Show</div>-->
              </div>
              <button type="submit" class="button" id="change-btn">
                Create new password
              </button>
            </div>
          </div>
        </form>

        <div class="show"></div>
      </div>
    </div>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', (event) => {


      var expiredAt = document.getElementById('expiredAt');





      // Add event listener for input blur for real-time validation 
      var inputs = document.querySelectorAll('input');
      var errors = document.querySelectorAll('.error');
      var password = document.getElementById('password');
      var passwordErr = document.getElementById('pass-err');
      var email = document.getElementById('email');
      var shows = document.querySelectorAll('.show');
      var findMyAccount = document.getElementById('find');


      // Container height controller
      var container = document.querySelector('#student-data');
      container.style.height = '330px';
      var findContainer = document.getElementById('find-container');

      var userData = document.getElementById('result-container');

      var fullName = userData.querySelector('.name'),
        studentEmail = userData.querySelectorAll('.email-encode'),
        admissionId = userData.querySelector('.admission-id'),
        studentCode = userData.querySelector('#verify-code'),

        profileImage = userData.querySelector('.user-dp');
      digits = userData.querySelector('.digits');

      findMyAccount.addEventListener('click', async () => {
        var emailValue = email.value.trim();
        var header = document.querySelector('.login-title');
        var loading = document.querySelector(".anime-1");

        try {
          if (emailValue === '') {
            errors[0].textContent = 'Please provide your Email';
          } else {


            if (emailValue.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
              loading.style.display = "block"
              findMyAccount.style.display = "none"
              const findForm = new FormData();
              findForm.append('email', emailValue);
              const findReq = await fetch("../include/forgot.php", {
                method: 'POST',
                body: findForm
              });

              const result = await findReq.json();
              loading.style.display = "block";

              if (result.redirect) {
                container.style.minHeight = '550px';
                findContainer.style.display = 'none';
                userData.style.display = 'block';

                // Outputs the student data on the container 
                fullName.textContent = result['fullname'];
                admissionId.textContent = `UNT/24/${result['admission_no']}`;
                profileImage.src = `../public/uploads/${result.image}`;
                studentEmail.forEach(em => em.textContent = result['email']);
                setExpiredAtValue(result["expiredAt"]);


                // Encoding student email address:
                var emailEncodeTag = document.querySelectorAll('.email-encode');
                emailEncodeTag.forEach(emailEncodeTxt => {
                  var emailEncoded = emailEncodeTxt.textContent.trim();
                  var sliceText = emailEncoded.slice(3, 6);
                  var encodedEmail = emailEncoded.replace(sliceText, '....');
                  emailEncodeTxt.textContent = encodedEmail;
                });

                header.textContent = 'Verify Account';
              }

              if (result.error) {
                errors[0].textContent = result.error
              }


            } else {
              errors[0].textContent = 'Invalid email'
            }


          }
        } catch (err) {
          alert(err.message)
          console.log(err);
        } finally {
          loading.style.display = "none";
          findMyAccount.style.display = "block";
        }


      })


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



          if (input.value.length > 0 && input.id === 'email') {
            errors[0].textContent = '';
          }

          // Real-time error remove if at least the input field 
          // is greater than 0, then remove the error text
          var err = input?.nextElementSibling.nextElementSibling;


          if (input.value.length > 0 && input.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            err.textContent = '';
          }






        });
      });

      /*
       var cpass = document.querySelector('#cpassword');

       cpass.addEventListener('blur', () => {
         if (cpass.value.trim().length > 0) {
           shows[1].style.display = 'block';
         } else {
           shows[1].style.display = 'none';
         }
       });

      var pass = document.querySelector('#password');

       pass.addEventListener('blur', () => {
         if (pass.value.trim().length > 0) {
           shows[0].style.display = 'block';
         } else {
           shows[0].style.display = 'none';
         }
       }); */



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

          /*  if (input.id === 'password') {
              shows[0].style.display = 'block';
            }


            if (input.id === 'cpassword') {
              shows[1].style.display = 'block';

            } */


        });


      });


      /*

            shows[1].addEventListener('click', () => {
             alert("confirmed")
              if (inputs[3].id === 'cpassword' && inputs[3].type === 'password') {
                inputs[3].type = 'text';
                shows[1].textContent = 'Hidden';
              } else if (inputs[3].id === 'cpassword' && inputs[3].type === 'text') {
                inputs[3].type = 'password';
                shows[1].textContent = 'Show';
              }

            });



            shows[0].addEventListener('click', () => {
              alert("Password")
              if (inputs[2].id === 'password' && inputs[2].type === 'password') {
                inputs[2].type = 'text';
                shows[0].textContent = 'Hidden';
              } else if (inputs[2].id === 'password' && inputs[2].type === 'text') {
                inputs[2].type = 'password';
                shows[0].textContent = 'Show';
              }

            });


      */
      var verifyBtn = document.getElementById('verify-btn');
      var changeContainer = document.querySelector('.change-wrapper');
      var verifyContainer = document.querySelector('.verify-wrapper');



      verifyBtn.addEventListener('click', async () => {

        var verifyCode = studentCode.value.trim();
        var verifyCode = studentCode.value.trim();


        let verifyForm = new FormData();
        verifyForm.append("digits", verifyCode)

        try {
          const res = await fetch("../include/re-verify-forgot-password.php", {
            method: "POST",
            body: verifyForm
          });

          const result = await res.json();

          if (result.error) {
            errors[1].textContent = result.error;
          } else {
            errors[1].textContent = ''
          }

          if (result.redirect) {
            errors[1].textContent = '';
            changeContainer.style.display = 'block';
            verifyContainer.style.display = 'none';
          }

        } catch (err) {
          alert(err.message)
        }


        /*
             if (verifyCode.length === 6 && verifyCode !== '' && verifyCode === digitsValue) {
               errors[1].textContent = '';
               changeContainer.style.display = 'block';
               verifyContainer.style.display = 'none';
             } else {
               errors[1].textContent = 'Please provide 6-digit code emailed you.';
               changeContainer.style.display = 'none';
               verifyContainer.style.display = 'block';
             }
             
          */
      });

      // Last-change request API
      var changeBtn = document.getElementById('change-btn');
      changeBtn.addEventListener('click', async () => {
        var password = pass.value.trim();
        var retypePass = cpass.value.trim();
        var admission = admissionId.textContent;
        var emailAddress = studentEmail[0].textContent;
        var verifyCode = studentCode.value.trim();


        var dataObj = {
          admissionId: admission,
          emailAddress: emailAddress,
          verifyCode: verifyCode,
          newPassword: password
        }

        try {
          if (password !== retypePass) {
            errors[3].textContent = 'Password mismatched!';
            return;
          }



          console.log(dataObj);

        } catch (err) {
          console.log(err)
        }
      });

    });

    function countdown() {
      var resendBtn = document.getElementById('resend');
      resendBtn.style.display = "none";
      const interval = setInterval(() => {
        const expiredAtElement = document.getElementById('expired');
        const expireCurrentDate = document.getElementById('expiredAt').value;
        var displayTime = document.getElementById('time');
        const expireDate = new Date(expireCurrentDate.replace(" ", "T") + "Z");
        const expireTime = 60; // * 10;
        const currentDate = new Date();
        const time = Math.floor((currentDate.getTime() - expireDate.getTime()) / 1000);

        const timeDFF = expireTime - time;
        const minutes = Math.floor(timeDFF / 60);
        const seconds = timeDFF % 60;

        const timeTxt = `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;

        displayTime.textContent = timeTxt;



        if (timeDFF < 0) {
          expiredAtElement.style.display = "none";
          resendBtn.style.display = "block";
        } else {
          expiredAtElement.style.display = "block";
          resendBtn.style.display = "none";
        }

      }, 1000);
    }


    countdown()


    // Re-send the verification code for a forgot password

    var resendBtn = document.getElementById("resend");

    //resendBtn.style.display = "block"
    resendBtn.addEventListener("click", async () => {
      try {
        const response = await fetch("../include/resend.php");
        if (!response.ok) {
          throw Error("Could not resend verify code.")
        }
        const result = await response.json();
        if (result.redirect) {
          resendBtn.style.display = "none";
          setExpiredAtValue(result["expiredAt"]);
        }
      } catch (err) {
        alert(err.message);
      }
    })


    // Add an event listener to detect changes to the expiredAt input field

    expiredAt.addEventListener('input', () => {
      countdown();
    });

    function setExpiredAtValue(new_date) {
      expiredAt.value = new_date;
      const event = new Event('input', {
        bubbles: true,
        cancelable: true
      });
      expiredAt.dispatchEvent(event);
    }

    /* Final stage of a password changing */
    const createPassword = document.querySelector("form")


    createPassword.addEventListener("submit", async function(e) {
      e.preventDefault();
      let passwordInput = e.target.password.value;
      let confirmInput = e.target.cpassword.value;
      let userEmail = e.target.email.value;

      console.log(userEmail, passwordInput);

      let er1 = document.getElementById("er1")
      let er2 = document.getElementById("er2")

      if (passwordInput.trim() === "") {
        er1.textContent = "Field cannot be empty.";
      } else if (passwordInput.length <= 5) {
        er1.textContent = "Minimum password length is 6 characters.";
      } else {
        er1.textContent = ""
      }

      if (confirmInput.trim() !== passwordInput.trim()) {
        er2.textContent = "Password mismatch.";
      } else {
        er2.textContent = "";
      }

      if ((confirmInput.trim() === passwordInput.trim()) && passwordInput.length >= 6) {

        let verifyForm = new FormData();
        verifyForm.append("password", passwordInput.trim())
        verifyForm.append("email", userEmail.trim())

        try {
          const res = await fetch("../include/set_password.php", {
            method: "POST",
            body: verifyForm
          });

          const result = await res.json();

          if (!res.ok) {
            alert("Error is occurred, please try again!")
          }

          if (result.redirect) {
            window.location = "http://localhost/unity/views/login.php";
          }

        } catch (err) {
          alert(err.message)
        }

      }
    })
  </script>
</body>

</html>