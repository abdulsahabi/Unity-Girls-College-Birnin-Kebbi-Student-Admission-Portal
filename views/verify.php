<?php

include "../include/db.php";
include "../include/custom_functions.php";
include "../include/session_config.php";
include "../include/queries.php";
//start_session();
session_start();

//session_regenerate_id(true)
$lastActivity = $_SESSION["canLastActivity"] ?? 0;
$isCandidateLogged = $_SESSION["isCandidateLogged"] ?? false;

checkCanLastActivity($lastActivity, $isCandidateLogged);

// Updating candidates current session:
$_SESSION["canLastActivity"] = time();
$_SESSION["isCandidateLogged"] = true;

// Getting candidate using session can_id:
$can_id = $_SESSION["can_id"];
$stmt = $pdo->prepare(CANDIDATE);
$stmt->execute([$can_id]);
$user = $stmt->fetch();

//echo $user["expiredAt"];
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Account verification</title>
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
      background: #FBF7FDff;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      width: 100%;
    }

    .form-container {
      width: 400px;
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

    .bn {
      background-color: #9010BF;
      width: 335px;
      font-family: Poppin;
      color: white;
      border-radius: 15px;
      border: 1px solid #9010BF;
      transition: 0.3s;
      margin-top: 5px;
    }

    .bn:hover {
      background: white;
      color: black;
    }

    .not-deliver {
      font-family: Poppin;
      color: grey;
      font-size: 14px;
      width: 320px;
      padding: 12px;
      text-align: center;
      margin-top: 20px;
    }

    .button {
      width: 315px;
      background-color: #9010BF;
      text-align: center;
      padding: 14px 10px;
      font-family: Poppin;
      border-radius: 15px;
      border: 1px solid #9010BF;
      transition: 0.3s;
      color: white;
    }

    .veri {
      font-size: 25px;
      font-family: Poppin_bold;
      color: #9010BF;
      margin-bottom: 20px;
    }

    input::placeholder {
      text-align: center;
      font-family: Poppin;
    }

    input {
      text-align: center;
      font-family: Poppin;
    }

    .header {
      font-family: Poppin_bold;
      color: black;
      font-size: 16px;
      width: 320px;
    }

    p {
      font-family: Poppin;
      color: grey;
    }

    .icon-wrap {
      width: 350px;
      text-align: center;
      padding: 10 0px;
    }

    .icon-var {
      width: 100px;
    }

    .loading-wrapper {
      width: 400px;
      height: 680px;
      display: none;
      align-items: center;
      justify-content: center;
      background: white;
      border-radius: 20px;
      border: 1px solid lightgrey;
      padding: 30px 0;
      margin-top: 60px;
      flex-direction: column;
      position: absolute;
      top: -60px;
      z-index: 2;
      opacity: .8;

    }

    .loader-icon {
      width: 30px;
      animation: spinner .5s ease infinite;
    }


    .load-txt {
      font-size: 18px;
      font-weight: bold;

    }

    @keyframes spinner {
      0% {
        transform: rotate(0);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    p {
      font-size: 12px;
      width: 300px;
    }


    #resend {
      display: none;
      margin-top: 20px;
    }
  </style>
</head>

<body>

  <div class="form-container" id="student-data">
    <div class="loading-wrapper">
      <div>
        <img src="../public/icons/loading.png" alt="Loader image" class="loader-icon">
      </div>
      <div>

      </div>
      <div class="load-txt">Please wait...</div>
    </div>

    <div class="input-container">
      <div class="steps">
        <div class="veri">
          VERIFICATION
        </div>
      </div>
      <div class="form-wrapper">

        <form>

          <div class="icon-wrap">
            <img class="icon-var" src="../public/icons/verification.png" alt="">
          </div>
          <div class="header">
            We sent a code to <?php echo $user["email"]; ?>
          </div>
          <p>
            To complete the account verification process, please enter the verification code you received via email in the space provided below. If you do not see the email in your inbox, please check your spam or junk folder
          </p>
          <input type="text" name="digits" id="digits" placeholder="Enter the 6-digit code">
          <div class="error"></div>

          <input type="text" id="expired" value="<?php echo $user["expiredAt"]; ?>" hidden>

          <input type="submit" value="Verify" class="bn">


          <div class="not-deliver">Code expires in <span id="time"></span></div>
          <div class="button" id="resend">
            Resend
          </div>
        </form>

      </div>
    </div>
  </div>


  <script>
    let form = document.querySelector('form');
    let error = document.querySelector('.error');
    let verifyInput = document.querySelector('#digits');
    var resendBtn = document.getElementById("resend");
    let countElement = document.querySelector('.not-deliver');

    countElement.style.display = 'none';

    function countdown() {
      const clear = setInterval(() => {
        countElement.style.display = 'block';
        let displayExpire = document.getElementById('time');
        let expiredAt = document.getElementById('expired').value;

        // Fix the syntax error in parsing the date
        const expireDate = new Date(expiredAt.replace(" ", "T") + "Z");
        const currentDate = new Date();
        const time = currentDate.getTime() - expireDate.getTime();
        const timeInSeconds = Math.floor(time / 1000);
        const expiredIn = 600 - timeInSeconds;
        const minutes = Math.floor(expiredIn / 60);
        const seconds = expiredIn % 60;
        const sec = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        displayExpire.textContent = sec;

        if (expiredIn < 0) {
          clearInterval(clear);
          resendBtn.style.display = 'block';
          countElement.style.display = 'none';
        }
      }, 1000);
    }

    window.onload = countdown()

    form.addEventListener('submit', async function(e) {
      e.preventDefault();
      let verifyCode = new FormData(this);
      try {
        const res = await fetch("../include/verify.php", {
          method: "POST",
          body: verifyCode
        });

        const result = await res.json();

        if (result.error) {
          error.textContent = result.error;

        } else {
          error.textContent = ''
        }

        if (result.redirect) {
          window.location = "./dashboard.php";
        }

      } catch (err) {
        alert(err.message)
      }

    });


    // Resend Another code
    var loader = document.querySelector('.loading-wrapper');


    resendBtn.addEventListener("click", async () => {
      try {
        loader.style.display = "flex";
        const res = await fetch("../include/resend.php");
        const result = await res.json();
        if (result.redirect) {
          window.location = "./verify.php"
        }

      } catch (err) {
        alert(err.message)
      } finally {
        // setTimeout(() => {
        loader.style.display = "none";
        //  },3000);
      }

    });
  </script>
</body>

</html>