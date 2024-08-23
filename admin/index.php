<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin panel</title>
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
      background: #F9F2FCff;

    }

    .wrapper {
      max-width: 800px;
      margin: 100px auto;
      border-radius: 12px;
    }

    .header {
      font-size: 30px;
      font-family: Poppin_bold;
      color: #9010bf;
    }

    .school-title {
      font-size: 20px;
      color: black;
    }

    .tip {
      margin: 30px 0;
      margin-bottom: 50px;
    }


    .tip .a {
      color: black;
      padding: 1px 5px;
      border: 1px solid grey;
      border-radius: 5px;
      text-decoration: none;
      font-size: 13px;

      display: inline-block;
    }

    .learn-icon {
      width: 10px;
    }

    .link {
      font-size: 18px;
      display: block;
      text-decoration: none;
      width: 300px;
      text-align: center;
      padding: 8px;
      color: white;
      margin-top: 15px;
      border-radius: 12px;
      background: #9010bf;
    }

    .link:hover {
      border: 1px solid white;
      box-shadow: 1px 1px 4px lightgray;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="header">
      Administrator panel
    </div>
    <div class="school-title">
      GOVERNMENT GIRLS UNITY COLLEGE, BIRNIN KEBBI
    </div>
    <div class="tip">
      One step toward the school management dashboard to perform various actions with candidates' data <a href="#" class="a">Learn more <img src="../public/icons/right-arrow.png" alt="" class="learn-icon"></a>
    </div>

    <a href="./sign_up.php" class="link">
      Get started
    </a>
    <a href="./sign_in.php" class="link">Sign in</a>
  </div>
</body>

</html>