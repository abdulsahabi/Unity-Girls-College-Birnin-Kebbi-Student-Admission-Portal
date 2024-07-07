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
$firstname = explode(" ", $user["fullname"])[0];

// Paying school fees request
$error = [];
if (isset($_POST["pay"])) {
  $feeStr = htmlspecialchars($_POST["amount"]);
  $fee = floatval(trim($feeStr));
  $payment = floatval($user["school_fee"]);

  if ($fee === $payment) {
    $paidStmt = $pdo->prepare(PAID);
    $paidStmt->execute([$can_id]);
    if ($paidStmt->rowCount() > 0) {
      header("Location: ./dashboard.php");
    } else {
      $error["pay_error"] = "Please pay your school fee";
    }
  } else {
    $error["pay_error"] = "Please pay your school fee";
  }
}
?>



<!DOCTYPE html>

<html>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Candidate | dashboard</title>
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
      font-family: Time;
      background: #FBF7FDff;
      position: relative;
      min-height: 100vh;
      width: 100%;
      overflow: hidden;
      /*   background: #F9F2FCff; */
      color: #939290;
    }



    /* Two sections: Sidebar and Main sidebar contents*/
   
    .sidebar {
      width: 280px;
      height: 100%;
      background: white;
      box-shadow: 0 0 1px lightgrey;
      position: fixed;
      /* Change to fixed */
      left: 0px;
      border-right: 1px solid lightgrey;
      z-index: 1;

      background: #FBF7FDff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
    }

    .main-sidebar {}

    /* Styling the footer container */
    footer {
      position: relative;
      width: cal(100%-230px);
      margin-left: 230px;
      height: 100px;

      left: 0;
      bottom: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      color: var(--font-main-color);
    }

    #main-content {
      width: cal(100%-290px);
      margin-left: 290px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;


    }

    #contents {
      min-width: 700px;
      height: 500px;
      margin: auto;
      margin: 80px 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;

    }


    /* Sidebar */

    .dashboard {
      width: 280px;
      height: 50px;
      display: flex;
      background: #ffffff;
      align-items: center;
      justify-content: center;
      border-bottom: 1px solid #9010BF;
    }

    .header-icon {
      width: 18px;
      height: 18px;
      margin-right: 5px;
    }

    .dash-title {
      font-size: 22px;
      font-family: Poppin_bold;
      color: #9010BF;
    }

    .user-image {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      margin-bottom: 5px;
      box-shadow: 1px 1px 5px lightgray;
    }

    .user-profile {
      width: 280px;
      height: 175px;
      display: flex;
      background: transparent;
      align-items: center;
      justify-content: center;
      border-bottom: 1px solid lightgrey;
      flex-direction: column;
      position: relative;
    }

    .user-name span {
      font-size: 16px;
      color: var(--font-main-color);
      font-family: Time;
    }

    .user-name .name {
      font-size: 22px;
      color: black;
      font-family: Poppin_bold;
    }

  

   .user-profile .upload-image {
      position: absolute;
      right: 122px;
      top: 90px;
      background: transparent;
      display: flex;
      height: 30px;
      width: 30px;
      align-items: center;
      justify-content: center;
      
      
      
      
    }

  .upload-image   .edit-icon {
      width: 10px;
      height: 10px;
      object-fit: cover;
      background: #9010BF;
      padding: 3px;
      border-radius: 50%;
    }

    #image-wrapper {
      cursor: pointer;
    }

    /* Menu icons */
    .menu-wrapper {
      width: 280px;
      height: 300px;
      display: flex;
      background: transparent;
      align-items: flex-start;
      justify-content: flex-start;
      border-bottom: 1px solid lightgrey;
      flex-direction: column;

    }

    .icon {
      width: 28px;
      margin-right: 10px;
    }

    .list-wrapper {
      margin: 30px 5px;

    }

    .test {
      width: 230px;
      display: flex;
      background: transparent;
      margin-left: 2px;
      padding: 8px;
      border-left: 5px solid transparent;
      color: black;
      font-size: 18px;
      font-family: Poppin;
      color: black;
      margin: 5px 2px;
      transition: .2s;
    }

    .test:hover {
      padding-left: 20px;
    }

    .active-menu {
      color: black;
      border-top-right-radius: 12px;
      border-bottom-right-radius: 12px;
      border-left: 5px solid #9010BF;
      background: #E6CAF1ff;
      padding-left: 20px;
    }

    /* Account Settings and Logout */
    .account-settings {
      width: 280px;
      height: 150px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      
    }

    .account-settings div {
      margin: 0;
    }


    /* Main content containers styles */

    .child-format {
      width: 650px;
      height: 100px;
      background: white;
      border-radius: 20px;
      box-shadow: 1px 1px 5px lightgray;
      margin-bottom: 20px;
      display: none;
      flex-direction: column;
    }
    
    .active-container {
      display: flex;
    }
    
    
      .container-title {
      width: 630px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;

    }

    .container-title .title {
      font-size: 25px;
      font-family: Roboto;
      font-weight: bold;
      color: #6A696B;
    }
    
    
    .title-container {
      width: 610px;
      height: 25px;
      margin-bottom: 20px;
      border-bottom: 1px solid grey;
      display: flex;
      align-items: center ;
    }
    
    .title-container .title {
      font-size: 15px;
      font-family: Roboto;
      padding-bottom: 15px;
    }
    
    .error-mssg {
      color: red;
    }
    
    
    /* Settings styles */
    
        #settings {
      width: 610px;
      height: 400px;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #f1f1f1;
      overflow-y: scroll;
    }
    
    .password-wrapper {
      height: 300px;
      width: 580px;
      display: flex;
      align-items: flex-start;
      justify-content: flex-start;
      margin-top: 20px;
      
      
    }
    
    label {
      font-size: 15px;
    
      
    }
    
    input {
      border: none;
      padding: 10px;
      font-family: Poppin;
    
      font-size: 15px;
      border-bottom: 2px solid #939290;
      margin-bottom: 5px;
      outline: none;
      background: white;
      width: 320px;
    }
    
    .input-group {
      display: flex;
      align-items: flex-start ;
      flex-direction: column;
      justify-content: flex-start ;
      position: relative;
      margin-bottom: 15px;
    }
    
    .show {
      width: 17px;
      position: absolute;
      right: 5px;
      top: 12px;
      padding: 10px;
      cursor: pointer;
      border-radius: 10px;
    }
    input:hover {
      border-bottom: 2px solid #9010BF;
    }
    
    .error {
      color: red;
      font-size: 14px;
    }
    
    .forgot-password {
      height: 200px;
      width: 200px;
      margin-left: 40px;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
      background: lightgoldenrodyellow;
      color: black;
    }
    
    
    .password-changed {
      height: 200px;
      width: 200px;
      margin-left: 40px;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
      background: limegreen;
      color: white;
    }
    
    .forgot-password-active {
      display: none;
    }
    
    .success-icon {
      width: 60px;
    }
    #change-btn {
      width: 340px;
      padding: 10px;
      font-family: Poppin;
      font-weight: bold;
      font-size: 15px;
      background: #9010BF;
      color: white;
      border-radius: 12px;
      border: none;
    }
      #change-btn:hover {
        box-shadow: 1px 1px 5px grey;
      } 
      
      .link {
        color: blue;
        font-weight: bold;
      }
    
    
    
    /* Admissions status conatiner */
    
    #admission-status {
      width: 600px;
      height: 500px;
      padding: 30px;
      border-radius: 12px;
      border: 1px solid #f1f1f1;
      
    }
    
    #approved-list {
        height: 580px;
    }
    .status-container {
      width: 500px;
      height: 300px;
    }
    
    .approved {
      
      padding: 20px;
      border-radius: 15px;
      
    }
    
    
    .message-1 {
      background: rgb(230, 244, 234);
      color: green;
      display: inline-block;
      padding: 5px 18px;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    
    .message-2 {
      color: black;
      font-size: 14px;
      line-height: 1.5;
    }
    
    .pending {
      border: 1px solid #D3D3D3;
      padding: 20px;
      border-radius: 15px;
      display: block;
    }
    
    .message-3 {
      background: #FFE5CC;
      color: black;
      display: inline-block;
      padding: 5px 18px;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    
    .message-4 {
      color: black;
      font-size: 14px;
      line-height: 1.5;
    }
    
    .pending-icon {
      width: 20px;
      margin-left: 5px;
    }
    
    .approved-icon {
      width: 18px;
     margin-top: -15px;
     margin-left: 2px;
    }
    
    
    /* personal-information */
    
    .personal-information {
      width: 600px;
      height: 400px;
      padding: 20px 30px;
      border-radius: 12px;
      border: 1px solid #f1f1f1;
      
      flex-direction: column;
      justify-content: space-between;
      align-items: center ;
    }
    
    .student-profile {
      width: 570px;
      height: 80px;
      padding:  10px 30px;
      border-radius: 12px;
      
      display: flex;
      align-items: center ;
    }
    
    .student-profile .column-1 {
      width: 100px;
      height: 90px;
      margin-right: 15px;
      
    }
    
        
    .student-profile .column-2 {
      width: 350px;
      height: 90px;
      
    }
    
    
    .title-1 {
      font-size: 12px;
    }
    
    .email, .fullname, .admission-id {
      font-size: 14px;
      margin-bottom: 5px;
      color: black;
    }
    
    .std-img {
      width: 100px;
      height: 90px;
      object-fit: cover;
      border-radius: 12px;
    }
    
    
    .student-details {
      width: 610px;
      height: 280px;
      border-radius: 12px;
      border: 1px solid #efefef;
      display: flex;
      flex-direction: column;
      justify-content: flex-start ;
      align-items: center ;
      margin-top: 15px;
    }
    
    .student-details .header-btn {
      width: 580px;
      height: 25px;
      margin-top: 5px;
      border-radius: 10px;
      display: flex;
      justify-content: flex-end;
      align-items: center ;
      
    }
    .edit-icon {
      width: 10px;
      margin-left: 6px;
    }
    
    .edit-btn {
      color: black ;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 70px;
      height: 24px;
      margin-right: 15px;
      border-radius: 12px;
      border: 1px solid #efefef;
      font-size: 13px;
      cursor: pointer;
    }
    
    .save-btn {
      color: black ;
      display: none;
      justify-content: center;
      align-items: center;
      width: 70px;
      height: 24px;
      margin-right: 15px;
      border-radius: 12px;
      border: 1px solid #9010bf;
      font-size: 13px;
      background: #9010bf;
      color: white;
      cursor: pointer;
    }
    
    .edited {
      border: 1px solid #9010BF;
    }
    
    .details-info {
      width: 600px;
      height: 235px;
      margin-top: 5px;
      border-radius: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center ;
      
    }
    
    .details-info .rows {
      width: 190px;
      height: 235px;
    }
    
      .details-info .rows:nth-child(1),    .rows:nth-child(2) {
      border-right: 1px solid #efefef;
    }
    
    .rows-title {
      font-size: 13px;
      font-weight: bold;
      color: black;
      font-family: Poppin;
      margin-left: 8px;
      
      margin-bottom: 10px;
    }
    
    .title {
      font-size: 12px;
      margin-left: 8px;
    }
    
    .font-1 {
      font-size: 14px;
      margin-bottom: 8px;
      color: black;
      margin-left: 8px;
      width: 130px;
      padding: 4px 0;
      border-radius: 10px;
      border: none;
    }
    
    .font {
      font-size: 14px;
      margin-bottom: 8px;
      color: black;
      margin-left: 8px;
    }
    
    .font-1:hover {
      border: none;
    }
    
  
    
    #blogs-btn {
      display: none;
    }
    
    
    /* School fees style*/
    
    .school-fees {
      width: 600px;
      height: 300px;
      padding: 20px 30px;
      border-radius: 12px;
      border: 1px solid #f1f1f1;
      
      flex-direction: column;
      justify-content: flex-start;
      align-items: center ;
    }
    
    .row-1 {
      width: 550px;
      height: 200px;
      border-radius: 12px;
      border: 1px solid #f1f1f1;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    
    
    .pay-wrap {
      width: 150px;
      height: 150px;
      border-radius: 12px;
      background: #9E9E9E;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-right: 15px;
    }
    
    .payment-send {
      width: 180px;
      height: 150px;
      border-radius: 12px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
    }

    
    .bank-icon {
      width: 100px;
      height: 100px;
    }
    
    .pay-input {
      width: 150px;
      padding: 5px;
      border: 1px solid lightgray;
      border-radius: 8px;
      font-weight: normal;
      font-family: Poppin;
    }
    
    .pay-txt {
      font-size: 12px;
    }
    .amount-pay {
      color: black;
      font-size: 25px;
      margin: 8px 0;
    }
    
     .pay-input:hover {
       border: 1px solid lightgray;
     }
     
     #submit-btn {
       color: white;
       background: blue;
       border-color: white;
       width: 163px;
     }
     
     .payment-completed {
      width: 180px;
      height: 150px;
      border-radius: 12px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
     }
     
     .paid {
       background: rgb(230, 244, 234);
       padding: 8px 12px;
       border: 1px solid green;
       color: green;
       border-radius: 6px;
     }
     
     .issue {
       color: black;
       font-size: 12px;
       margin: 5px;
     }
     
     
     
     /* Complain box */
     
     #complain {
      width: 600px;
      height: 420px;
      padding: 20px 30px;
      border-radius: 12px;
      border: 1px solid #f1f1f1;
      
      flex-direction: column;
      justify-content: flex-start;
      align-items: center ;
      
     }
     
     
     
     .complain-wrapper {
       width: 500px;
       padding: 0 20px;
       
     }
     
     .submitted {
       width: 320px;
       font-size: 12px;
       border: 1px solid green;
       border-radius: 4px;
       padding: 10px 3px;
       margin-bottom: 6px;
       color: green;
       background: rgb(230, 244, 234);
       text-align: center ;
       display: none;
     }
     form {
       display: flex;
       flex-direction: column;
       justify-content: center;
       align-items: flex-start;
     }
     
     label {
       font-size: 14px;
       color: black;
     }
     
   
       .label-2   {
       margin-bottom: 8px;
     }
     textarea {
       width: 300px;
       font-size: 14px;
       font-family: Poppin;
       resize: none;
       border: 1px solid lightgrey;
       padding: 8px;
       border-radius: 6px;
       outline: none;
       height: 90px;
       overflow-y: scroll;
     }
     
     select {
       width: 320px;
       font-size: 14px;
       font-family: Poppin;
       border: none;
       padding: 8px;
       margin-bottom: 20px;
       margin-top: -14px;
       outline: none;
       background: white;
       border-bottom: 1px solid lightgrey;
     }
     
     .txt {
       font-size: 10px;
       margin-top: -7px;
     }
     
     .com {
       width: 20px;
       margin-right: 15px;
       background: black;
     }
     .radio-input {
       display: flex;
       margin-top: 5px;
       align-items: center ;
     }
     
     .label-3 {
       margin-top: 20px;
     }
     
     button {
       width: 320px;
       padding: 8px;
       font-size: 12px;
       text-align: center;
       font-family: Poppin_bold;
       color: white;
       border: none;
       border-radius: 5px;
       background: blue;
       margin-top: 8px;
       cursor: pointer;
     }
     
     button:hover {
       box-shadow: 1px 1px 8px darkgrey;
     }
     
     .error-message {
       color: red;
       font-size: 11px;
       width: 320px;
     }
     
     textarea:hover, select:hover {
       border-color: blue;
       box-shadow: 1px 1px 4px lightgray;
     }
     
     
     .review-icon {
       width: 70px;
     }
     
     .reviewed {
       display: flex;
       align-items: center;
     }
     
     .good-news {
       background: rgb(230, 244, 234);
       color: green;
       border: 1px solid green;
       padding: 2px 4px;
       font-size: 11px;
       border-radius: 4px;
     }
     
     .app-status {
       width: 130px;
     }
     
     .current-state {
       display: flex;
       align-items: center;
       margin-bottom: 2px;
     }
     
     .message-2 {
       width: 270px;
       text-align: justify ;
       margin: 15px 0;
     }
     
      .action-buttons  {
       display: flex;
       align-items: center;
     }
     
     .action-buttons .accept, .decline {
       background: green;
       color: white;
       width: 120px;
       padding: 6px 5px;
       font-size: 11px;
       text-align: center ;
       margin-top: 6px;
       border-radius: 5px;
       margin-right: 10px;
       cursor: pointer;
     }
     
  .action-buttons .decline {
    background: orangered;
  }
  
  .learn {
    width: 247px;
    padding: 11px;
    font-size: 11px;
    text-align: center;
    margin-top: 15px;
    border-radius: 5px;
    
  }
  
  .accepted, .declined {
    width: 247px;
    padding: 11px;
    font-size: 11px;
    text-align: center;
    margin-top: 15px;
    border-radius: 5px;
    color: green;
    border: 1px solid green;
    background: rgb(230, 244, 234);
    display: block;
  }
  
  .declined {
    background: #FFEDEDff;
    color: red;
    border-color: red;
  }
  
  
  .learn a {
    color: blue;
    margin: 0 8px;
  }
  
  .link {
      text-decoration: none;
      font-size: 13px;
  }
 
  .password-changed {
      display: none;
  }
  
  #temporary-paid {
      display: none;
  }
  
  #profile-peview {
      object-fit: cover;
  }
  </style>
  
  
</head>

<body>

  <!-- Two sections: Sidebar and Main sidebar contents-->
  <div class="sidebar">
    <div class="dashboard">
      <img class="header-icon" src="../public/icons/dashboard-main.png" alt="">
      <div class="dash-title">
        DASHBOARD
      </div>
    </div>
        <div class="user-profile">
          <div id="image-wrapper">
            <img src="../public/uploads/<?php echo $user["display_image"] ??
              "user.png"; ?>" alt="User image here" class="user-image " id="profile-peview">
    
            <div class="upload-image" id="upload-image">
            <!--  <input type="file" name="profile" id="profile-change" accept="image/" hidden> -->
              <img src="../public/icons/camera.png" alt="Upload-image" class="edit-icon" >
                <form id="form">
          <input type="file" name="image" id="profile-change" hidden accept="image/" >
          <button id="profile-btn" hidden type="submit">
          </button>
        </form>
            </div>
    
          </div>
          <div class="error-mssg"></div>
          <div class="user-name">
            <span>Hi,</span> <span class="name">
              <?php echo $firstname; ?>
            </span>
          </div>
        </div>
    <div class="menu-wrapper">
      <div class="list-wrapper">
        <div class="test active-menu" id="admission-list-btn">
          <img src="../public/icons/time.png" alt="" class="icon">
          Admission Status
        </div>
        <div class="test" id="approved-list-btn">
          <img src="../public/icons/user (2).png" alt="" class="icon">
          Personal Information 
        </div>
         <div class="test" id="blogs-btn">
          <img src="../public/icons/news.png" alt="" class="icon">
          News & Updates 

        </div> 
        <div class="test" id="insights-btn">
          <img src="../public/icons/credit-card.png" alt="" class="icon">
          Payment Method 
        </div>
        <div class="test" id="complaint-btn">
          <img src="../public/icons/complain (1).png" alt="" class="icon">
          Having a issue?
        </div>
      </div>
    </div>

    <div class="account-settings">
      <div class="test" id="settings-btn">
        <img src="../public/icons/gear.png" alt="" class="icon">
        Account Settings
      </div>
      <div class="test" id="logout-btn">
        <img src="../public/icons/logout.png" alt="" class="icon">
        Logout
      </div>
    </div>
  </div>
  <div id="main-content">
    <div id="contents">
      
      <!-- ADMISSION STATUS -->
      <div class="child-format active-container" id="admission-status">
        <div class="title-container">
         <div class="title">
           Admission status 
         </div>
        </div>
        
        <div class="status-container">
          <?php if ($user["isApproved"]) { ?>
          <div class="approved">
            <div class="reviewed">
              <img src="../public/icons/review.png" class="review-icon" alt="">
              <div class="review-details">
                <div class="current-state">
                  <span>
                    <div class="app-status">
                      Grade level:
                    </div>
                    </span>
                  <span>
                      <?php echo $user["admission_class"]; ?>
                  </span>
                </div>
                <div class="current-state">
                  <span>
                    <div class="app-status">
                      Application status:
                    </div>
                 </span>
                  <span class="good-news">Good news!</span>
                </div> 
              </div>
            </div>
            
            

            <div class="message-2">
            <?php echo $user["decision_message"]; ?>
            </div>
            <?php if (!$user["isClick"]) { ?>
            <div class="action-buttons" >
              <div class="accept ac-btn" data-accept="accept">Accept Offer</div>
              <div class="decline ac-btn"data-declined="declined">Decline Offer</div>
            </div>
            <?php } ?>
            
            <?php if ($user["isAccept"] && !$user["isDeclined"]) { ?>
            <div class="accepted">
              Thank you
            </div>
          <?php } elseif (!$user["isAccept"] && $user["isDeclined"]) { ?>
            <div class="declined">
               Declined 
            </div>
           <?php } ?>
            
            <div class="learn">
              <a href="#">
                Learn more
              </a>
              <a href="#">
                Next Steps
              </a>
            </div>
            
            
          </div>  
          <?php } else { ?>
          <div class="pending">
            <div class="message-3">
              Application is in progress
            </div>
            <span>
              <img src="../public/icons/paper-plane.png" alt="" class="pending-icon">   
            </span>
            <div class="message-4">
              Hang in there! We know waiting can be tough, but your application is being carefully reviewed. Keep positive, and we'll be in touch soon. Stay hopeful!
            </div>
               <div class="learn">
              <a href="#">
                Learn more
              </a>
              <a href="#">
                Next Steps
              </a>
            </div>
          </div>  
          <?php } ?>
        </div>
        
      </div>
      
      
      <div class="child-format personal-information" id="approved-list">
          <div class="title-container">
         <div class="title">
            User profile 
         </div>
        </div> 
          
       <div class="student-profile">
         <div class="column-1">
           <img src="../public/uploads/<?php echo $user[
             "display_image"
           ]; ?>" class="std-img" alt="student profile">
         </div>
         <div class="column-2">
           <div class="title-1">Full name:</div>
           <div class="fullname">
             <?php echo $user["fullname"]; ?>
               </div>
           <div class="title-1">Email Address:</div>
           <div class="email">
               <?php echo $user["email"]; ?>
           </div>
           <div class="title-1">Admission number:</div>
           <div class="admission-id">UNT/21/<?php echo $user[
             "admission_no"
           ]; ?></div>
         </div>
       </div>
       
       <div class="student-details">
         <div class="header-btn">
           <a class="edit-btn">
             <div class="edit-txt">Edit</div>
             <img src="../public/icons/edit.png" class="edit-icon" alt="">
           </a>
           <a class="save-btn">
             <div class="save-txt">Save</div>
             <img src="../public/icons/diskette.png" class="edit-icon" alt="">
           </a>
         </div>
         <div class="details-info">
           <div class="rows">
             <div class="rows-title">
               Personal Information 
             </div>
             
              <div class="title">Phone number:</div>
                <input type="text" value="<?php echo $user[
                  "phone_no"
                ]; ?>" class="phone-number font-1" readOnly>
                
                <div class="title">Date of Birth: </div>
                <input type="text" class="dob font-1" value="<?php echo $user[
                  "dob"
                ]; ?>" readOnly>
                
                <div class="title">Account status:</div>
                <?php if ($user["isVerify"]) { ?>
                <div class="account-status font">Verified</div>
                <?php } else { ?>
                <div class="account-status font">Unverified</div>
                 <?php } ?>
           </div>
           <div class="rows">
             <div class="rows-title">
               Contact Information
             </div>
              <div class="title">Home address:</div>
                <div class="home-address font"><?php echo $user[
                  "address"
                ]; ?></div>
                <div class="title">Local government: </div>
                <div class="font"><?php echo $user["localG"]; ?></div>
                <div class="title">State of origin: </div>
                <div class="state-origin font"><?php echo $user[
                  "state"
                ]; ?></div>
                <div class="title">Nationality: </div>
                <div class="nationality font"><?php echo $user[
                  "nationality"
                ]; ?></div>
           </div>
           <div class="rows">
             <div class="rows-title">
               Educational Background 
             </div>
              <div class="title">Previous school:</div>
                <div class="previous-school font"><?php echo $user[
                  "previous_school"
                ]; ?></div>
                <div class="title">Year of passing </div>
                <div class="year-of-passing font"><?php echo $user[
                  "year_of_passing"
                ]; ?></div>
                <div class="title">Admission type:</div>
                <div class="admission-type font"><?php echo $user[
                  "admission_type"
                ]; ?></div>
                <div class="title">Admission class: </div>
                <div class="admission-class font"><?php echo $user[
                  "admission_class"
                ]; ?></div>
           </div>
         </div>
       </div>
      </div>
      
      
      <div class="child-format" id="blogs">
        <center>
          <h1>Blogs Management</h1>
        </center>
      </div>
      
      
      <div class="child-format school-fees" id="insights">
        <div class="title-container">
         <div class="title">
           Payment Method 
         </div>
        </div>
        
        <div class="row-1">
          <div class="pay-wrap">
            <img src="../public/icons/bank-building.png"class="bank-icon" alt="">
          </div>
          <?php if (!$user["isPaid"]) { ?>
          <div class="payment-send">
            <div class="pay-txt">
              Kindly pay admission fee
            </div>
            <div class="amount-pay">
              N<?php echo $user["school_fee"]; ?>
            </div>
           <form id="pay-btn">
               
                <input type="text" name="amount" id="fee" class="pay-input" placeholder="Enter pay amount">
            <div class="pay-error">
              
            </div>
            <input type="submit"  id="submit-btn" value="Pay now" class="pay-input">
               
           </form>
           
          </div>
          
           <div id="temporary-paid" class="payment-completed">
              <div class="paid">
                Payment completed 
              </div>
              <div class="issue">
                 Paid admission fee. Thanks!
              </div>
          </div>
          <?php } else { ?>
           <div class="payment-completed">
              <div class="paid">
                Payment completed 
              </div>
              <div class="issue">
                 Payment verified! Your investment in yourself is the first step to greatness
              </div>
          </div>
          <?php } ?>
        </div>
      </div>
      
      
      
      <div class="child-format " id="complain">
        <div class="title-container">
         <div class="title">
           Complain form
         </div>
        </div>
        
        <div class="complain-wrapper">
          <form id="complain-form">
            
            <div class="submitted">
              Your complaint has been received. Team will review it soon.
            </div>
            
            <label for="nature-of-complaint">Nature of Complaint:</label><br>
            <select id="nature-of-complaint" name="nature">
              <option value="Technical issues">Technical Issues with the Admission Portal</option>
              <option value="Application inquiry">Application Status Inquiry</option>
              <option value="Payment concerns">Payment and Fee-related Concerns</option>
              <option value="Documentation problems">Documentation Submission Problems</option>
              <option value="Communication issues">Communication Delays or Issues</option>
              <option value="Admission appeal">Admission Decision Appeal</option>
              <option value="other">Other</option>
            </select>
            <label class="label-2">Details of Complaint:</label>
            <textarea name="body"></textarea>
             <label class="label-2 label-3">
               Follow-up Communication:
             </label>
             <div class="txt">
               Would you like to receive updates on the status of your complaint?
             </div>
             
             <div class="radio-input">
               <label>Yes</label>
                <input type="radio" name="com" value="Yes"  class="com" />
                <label>No</label>
                <input type="radio" value="No" name="com"class="com" > 
             </div>
            <div class="error-message">
             
            </div>
             <button>Submit</button>
          </form>
        </div>
        
        
      </div>
      
      
      
      <div class="child-format" id="settings">
       <div class="title-container">
         <div class="title">
           Settings 
         </div>
       </div>
      
         <div class="password-wrapper">
           <form id="form-2">
       
             <div class="input-group">
               <label for="current-password">
                 Current password
               </label>
               <input type="password" name="current" id="current-password">
               <img src="../public/icons/eye (1).png" alt="" class="show current-password">
               <div class="error">
       
               </div>
             </div>
             <div class="input-group">
               <label for="new-password">New password</label>
               <input type="password" name="newpassword" id="new-password">
               <img src="../public/icons/eye (1).png" alt="" class="show new-password">
               <div class="error ">
       
               </div>
             </div>
             <div class="input-group">
               <label for="retype">Retype password</label>
               <input type="password" name="retype" id="retype">
               <img src="../public/icons/eye (1).png" alt="" class="show retype">
               <div class="error">
       
               </div>
             </div>
             <input type="submit" id="change-btn" value="Change password">
           </form>
       
           <div class="forgot-password-wrapper">
             <div id="warn" class="forgot-password forgot-password-active">
               Oops, that password is incorrect. Click <a href="#" class="link">Forgot password</a> to reset and try again
             </div>
       
             <div class="password-changed">
               <img src="../public/icons/security (1).png" alt="" class="success-icon">
               <div>
                 You have successfully changed your password.
               </div>
             </div>
           </div>
         </div>
       
      
      </div>
      
      
    </div>
  </div>



  <!-- Footer container -->
  <footer>
    <div class="copyright">
      &copy; Sumayya Garba Diggi 2024
    </div>
  </footer>

  <!-- Script container -->
  <script>
  
    // Paying school via API 
    let payform = document.querySelector(".payment-send");
    let payButton = document.getElementById("pay-btn");
    let payErr = document.querySelector(".pay-error");
    let paidNotify = document.getElementById("temporary-paid");
    payButton?.addEventListener("submit", async function(e) {
         e.preventDefault()
        payErr.textContent = "";
        let amountForm = new FormData(this);
        try {
           const res = await fetch("../include/school_fee.php", {
               method: "POST",
               body: amountForm
           });
           
           const result = await res.json();
           // alert(result )
          if(result.paid) {
              paidNotify.style.display = "flex"
              payform.style.display = "none"
          }
          
          if(result.error) {
              payErr.textContent = result.error
              payErr.style.color = "red"
              payErr.style.fobtSize = "12px"
          }
           
           
        } catch(err) {
        alert(err.message);
        }
    });
    
       // COMPLAIN FORM
    let complainForm = document.getElementById('complain-form');
    complainForm.addEventListener('submit', async function (e){
      e.preventDefault();
      
       var error = document.querySelector('.error-message')
       var submittedPopUp = document.querySelector('.submitted')
       var textarea = document.querySelector('textarea');
       var select = document.querySelector('select');
        var radioButtons = document.getElementsByName('com');
        var chosen = null;
        
        
        radioButtons.forEach(radio => {
          if(radio.checked) {
            chosen = radio.value;
          }
        })
        
        
        if(chosen === null) {
          error.textContent  = 'Please select whether you would like to receive updates on the status of your complaint.'
        } else {
          error.textContent  = ''
        } 
        
        if(textarea.value <= 0) {
          textarea.style.borderColor = 'red';
        } else {
          textarea.style.borderColor = 'lightgray';
        }
        
        let complaintForm = new FormData(this);
         complaintForm.append("followUp", chosen);
        
        
        
        try {
          if(chosen !== null && textarea.value.length >= 0) {
          
          
          const res = await fetch('../include/complain.php', {
            method: 'POST',
            body: complaintForm
          })
          
          const result = await res.json();
         
          if(result.redirect) {
          submittedPopUp.style.display = 'block';
          }
          
        } 
   
        } catch(err) {
          alert(err.message);
        } finally {
          setTimeout(() => {
          submittedPopUp.style.display = 'none';
        }, 6000);
        }
    
        
        
        
        
       
        
    });
    
    
    
    // Accept and decline offer
    var acceptBtn = document.querySelector('.accept');
    var declineBtn = document.querySelector('.decline');
    var acceptedMessage = document.querySelector('.accepted');
    var declineMessage = document.querySelector('.message-2');
    var declined = document.querySelector('.declined');
    var acOrDe = document.querySelectorAll('.ac-btn');
   
    acOrDe?.forEach((btn) => {
    
     btn.addEventListener('click', async function(){
         
         let formData = new FormData();
         formData.append("accept", this.dataset.accept);
         formData.append("declined", this.dataset.declined);
        
        
        try {
            const res = await fetch("../include/decision.php", {
                method: "POST",
                body: formData
            });
            
            if(!res.ok) {
              throw Error("Sever");
            }
            const result = await res.json();
   
            
            if(result.accept) {
            window.location = "./dashboard.php"
            }
            
            if(result.declined) {
                  window.location = "./dashboard.php"
                  }
           
        } catch(err) {
          alert(err.message);
        } 
    })
    });
    
 
    
    
    
    
    acceptBtn?.addEventListener('click', () => {
      acceptedMessage.style.display = 'block'
      acceptBtn.style.display = 'none'
      declineBtn.style.display = 'none'
    });
    /*
    declineBtn?.addEventListener('click', () => {
        
        alert("Decline")
      
      acceptBtn.style.display = 'none'
      declineBtn.style.display = 'none'
      declined.style.display = 'block'
      declineMessage.textContent = 'We understand that choosing the right school is an important decision, and we respect your choice. If you have any questions or need further assistance, please don\'t hesitate to reach out to our admissions team. We wish you all the best in your academic journey and hope you find the perfect fit for your educational goals.';
    })
    */
    
    
    
    const imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'svg', 'raw', 'webp'];
    const isInArray = imageExtensions.includes('jpg');
    
    var profilePreview = document.querySelector('.user-image');
    let uploadImage = document.getElementById("image-wrapper");
    let inputImage = document.getElementById("profile-change");
    var profileErr = document.querySelector('.error-mssg');
    
    uploadImage.addEventListener('click', () => {
      inputImage.click();
    });
    
    inputImage.addEventListener('change', function() {
    
      if (this.files && this.files[0]) {
        var reader = new FileReader();
        var imageName = this.files[0].name;
    
    
        reader.onload = function(e) {
          profilePreview.src = e.target.result;
          profilePreview.style.display = 'block';
    
    
    
          const imageArr = imageName.split('.')
          var imageExt = imageArr.pop();
    
          if (imageExtensions.includes(imageExt.toLowerCase())) {
            profileErr.textContent = ''
          } else {
            profileErr.textContent = 'Oops! Sorry, upload only image is allowed.'
            profilePreview.src = '../public/icons/user.png'
    
          }
    
    
    
        };
    
        reader.readAsDataURL(this.files[0]);
    
      }
    });
    
    



    // Main-contents containers references
    let admissionListWrap = document.getElementById("admission-status");
    let approvedListWrap = document.getElementById("approved-list");
    let blogsWrap = document.getElementById("blogs");
    let insightsWrap = document.getElementById("insights");
    let complainWrap = document.getElementById("complain");
    let settingsWrap = document.getElementById("settings");
    
    // Lists of the above containers 
    let wrappers = document.querySelectorAll(".child-format");
    



    // Sidebar buttons controller
    let buttons = document.querySelectorAll('.test');
    buttons.forEach(button => {
      button.addEventListener('click', () => {
        buttons.forEach(button => button.classList.remove('active-menu'))
        if(button.id !== 'logout-btn'){
        wrappers.forEach(wrapper => wrapper.classList.remove('active-container'))
        }
        
        
        button.classList.add('active-menu');
        

        // Main containers switcher — with logic

        if (button.id === 'admission-list-btn') {
          admissionListWrap.classList.add('active-container');
        }

        if (button.id === 'approved-list-btn') {
          approvedListWrap.classList.add('active-container');
        }

        if (button.id === 'blogs-btn') {
          blogsWrap.classList.add('active-container');
        }

        if (button.id === 'insights-btn') {
          insightsWrap.classList.add('active-container');
        }

        if (button.id === 'complaint-btn') {
          complainWrap.classList.add('active-container');
        }

        if (button.id === 'settings-btn') {
          settingsWrap.classList.add('active-container');
        }

      });
    })
    
    
    
    
        // FORGOT PASSWORD
    
    
    let currentPassword = document.getElementById('current-password');
    let currentPasswordWarn  = document.getElementById('warn');
    let form  = document.querySelector('#form-2');
    let errors = document.querySelectorAll('.error'); 
    
    let shows = document.querySelectorAll('.show'); 
    
    shows.forEach(btn => {
      btn.addEventListener('click', () => {
        
        if(btn.classList.contains('current-password')) {
          let input = btn.previousElementSibling;
          
          if(input.type === 'password') {
            input.type = 'text';
            btn.src = '../public/icons/hidden.png'
          } else {
            input.type = 'password';
            btn.src = '../public/icons/eye (1).png'
          }
        }
        
        if(btn.classList.contains('new-password')) {
          let input = btn.previousElementSibling;
          
          if(input.type === 'password') {
            input.type = 'text';
            btn.src = '../public/icons/hidden.png'
          } else {
            input.type = 'password';
            btn.src = '../public/icons/eye (1).png'
          }
        }
        
        if (btn.classList.contains('retype')) {
          let input = btn.previousElementSibling;
          
          if (input.type === 'password') {
            input.type = 'text';
            btn.src = '../public/icons/hidden.png'
          } else {
            input.type = 'password';
            btn.src = '../public/icons/eye (1).png'
          }
        }

        
      });
    })
    
    currentPassword.addEventListener('input', () => {
      
      currentPasswordWarn.classList.add('forgot-password-active');
      
      
    })
   currentPassword.addEventListener('blur', async function ()  {

      var passwordData = new FormData();
      passwordData.append("current", this.value);
    try {
      const res = await fetch('../include/current_password.php', {
        method: 'POST',
        body: passwordData
      });
      
      
      
      if(!res.ok) {
        throw Error("Something wrong with the server, try again ");
      }
      
      const result = await res.json();
      
      if(result.error) {
        currentPasswordWarn.classList.remove('forgot-password-active');
      }
     
      
      if(result.redirect) {
        currentPasswordWarn.classList.add('forgot-password-active');
      }
      
    } catch(err) {
      alert(err.message);
    }
    
    });
    
    var changedSuccessfully  = document.querySelector('.password-changed')
    form.addEventListener('submit', async function (e) {
      e.preventDefault();
     
      var retypePassword = e.target.retype.value.trim();
      var password = e.target.newpassword.value.trim();
      
      if(retypePassword !== password ) {
        errors[2].textContent = 'Password mismatched, try again.'
      } else {
           errors[2].textContent = "";
      }
  
      
      if (password.length === 0) {
        errors[1].textContent = 'Password cannot be empty.'
      } else  if (password.length <= 5) {
        errors[1].textContent = 'Password must be at least 6 characters long.'; 
      } else {
        errors[1].textContent = ''; 
      }
      
      var changeDetails = new FormData(this);
      
      
      try {
        if( password !== '' && password.length >= 6 && password === retypePassword )  {
          
          const res = await fetch('../include/update_password.php', {
            method: "POST",
            body: changeDetails
          })
          
          const result = await res.json();
     
          if(result.password) {
             errors[1].textContent = 'Password mbe.'; 
          }
          
          if(result.redirect) {
           changedSuccessfully.style.display = 'flex';
           this.newpassword.value = "";
           this.retype.value  = "";
           this.current.value = "";
          }
          
            if(result.error) {
        currentPasswordWarn.classList.remove('forgot-password-active');
      }
          
        }
        
        
      } catch(err) {
        console.log(err.message);
      } finally {
        setTimeout(() => {
          changedSuccessfully.style.display = 'none';
        }, 5000);
      }
      
    });
    
    
    var editBtn = document.querySelector('.edit-btn');
    var saveBtn = document.querySelector('.save-btn');
    editBtn.addEventListener('click', () => {
      saveBtn.style.display = 'flex';
      editBtn.style.display = 'none';
    });
    
    saveBtn.addEventListener('click', () => {
      saveBtn.style.display = 'none';
      editBtn.style.display = 'flex';
    });
    
    
    // User logout
    let logoutButton = document.getElementById("logout-btn");
    
    logoutButton.addEventListener("click", async () => {
        try {
          const res =  await fetch("../include/logout.php");
          if(res.ok) {
              window.location = "../index.php"
          }
        } catch(err) {
            alert(err.message);
        }
    });
    
    
    let formChangeProfile = document.getElementById("form");
    let submitBtn = document.getElementById("profile-btn");
    let inputDp = document.getElementById("profile-change");

    inputDp.addEventListener("change", () => {
      submitBtn.click();
    });

    formChangeProfile.addEventListener("submit", async function (e) {
      e.preventDefault();
      try {
          let changedForm = new FormData(this);
          const res = await fetch("../include/candidate_update_profile.php", {
              method: "POST",
              body: changedForm
          });
          const result = await res.json();
    
       
      } catch(err) {
          alert(err.message);
      }
    });
     
  </script>
</body>

</html>