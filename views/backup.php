<?php

include "../include/db.php";
include "../include/queries.php";

// Getting candidates
$stmt = $pdo->prepare(CANDIDATES);
$stmt->execute();
$candidates = $stmt->fetchAll();

//print_r($candidates);
?>


<!DOCTYPE html>

<html>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | dashboard</title>
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
      object-fit: cover;
      height: 70px;
      border-radius: 50%;
      margin-bottom: 5px;
      box-shadow: 1px 1px 5px lightgray;
    }

    .user-profile {
      width: 280px;
      height: 120px;
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



    .upload-image {
      position: absolute;
      right: 110px;
      top: 60px;
      background: #9010BF;
      width: 20px;
      text-align: center;
      border-radius: 50%;
      height: 17px;

    }

    .edit-icon {
      width: 10px;

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
      height: 190px;
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
      width: 630px;
      background: white;
      border-radius: 20px;
      padding: 20px;
      box-shadow: 1px 1px 5px lightgray;
      margin-bottom: 20px;
      display: none;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
    }

    .active-container {
      display: flex;



    }

    /* CANDIDATE CONTAINER STYLE*/

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

    .search-wrapper input {
      width: 180px;
      font-size: 18px;
      font-weight: 500;
      margin-left: 8px;
      padding: 6px;
      border: 1px solid grey;
      border-radius: 6px;
      outline: none;
    }

    .search-wrapper input:hover {
      border: 1px solid #9010BF;
    }

    .search-wrapper label {
      font-size: 20px;

    }

    .candidates-container {
      width: 610px;
      max-height: 400px;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #f1f1f1;
      overflow-y: scroll;
    }

    .candidates-container::-webkit-scrollbar {
      width: 6px;
    }




    .candidates-container::-webkit-scrollbar-track {
      background-color: transparent;
      border-radius: 10px;
    }

    .candidates-container::-webkit-scrollbar-thumb {
      background: #9010BF;
      border-radius: 10px;

    }



    .next-btn {
      width: 630px;
      height: 20px;
      padding: 10px;
      background: #fafafa;
      border-radius: 12px;
      margin-top: 12px;

    }

    .next-btn .fetch-candidate {
      width: 60px;
      padding: 5px 10px;
      font-size: 12px;
      border: 1px solid grey;
      border-radius: 6px;
      cursor: pointer;
      margin-right: 10px;
      transition: 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .next-btn .fetch-candidate:hover {
      border: 1px solid #9010BF;
      color: black;

    }

    .candidate {
      width: 500px;
      padding: 12px;
      display: flex;
      align-items: center;
      border-left: 5px solid #f2f2f2;
      border-radius: 5px;
      margin-bottom: 15px;
    }


    .candidate:hover {
      border-left: 5px solid #E6CAF1ff;
     
    }
    
    .candidate:nth-child(odd) {
         background: #fafafa;
    }

    .candidate-icon {
      width: 80px;
      height: 80px;
      border-radius: 20px;
      margin: 0 12px;
    }

    .candidate-details .fullname,
    .email,
    .admission-no {
      font-size: 15px;
      color: #6A696B;
      font-family: Roboto;
    }

    .candidate-details .fullname {
      font-weight: bold;
      color: black;
      font-size: 18px;
    }

    .buttons a {
      width: 150px;
      background: #fafafa;
      font-size: 8px;
      border-radius: 6px;
      padding: 5px 10px;
      font-family: Robto;
      cursor: pointer;
    }

    .buttons .btn-1 {
      background: pink;
      color: black;
    }

    .buttons .btn-2 {
      background: green;
      color: white;
    }

    .buttons .btn-3 {
      background: red;
      color: white;
    }

    .list {
      display: block;
    }

    /* CANDIDATES SKELETON CONTAINER STYLES*/

    .candidate-skeleton {
      width: 500px;
      height: 75px;
      padding: 12px;
      display: flex;
      align-items: center;
      border-left: 5px solid #f2f2f2;
      border-radius: 5px;
      margin-bottom: 15px;
    }

    .candidate-skeleton .img-skl {
      width: 80px;
      height: 80px;
      border-radius: 20px;
      margin: 0 12px;
      background: #F3F3F3;
      position: relative;
      overflow: hidden;
    }

    .candidate-skeleton .details-skl {
      display: flex;
      flex-direction: column;
    }

    .candidate-skeleton .details-skl .fullname-skl,
    .email-skl,
    .admission-skl {
      width: 280px;
      height: 15px;
      border-radius: 5px;
      background: #F3F3F3;
      margin-bottom: 5px;
      position: relative;
      overflow: hidden;
    }

    .email-skl {
      width: 180px;
    }

    .admission-skl {
      width: 100px;
    }

    .buttons-skl {
      width: 300px;
      display: flex;
    }

    .buttons-skl div {
      width: 40px;
      height: 15px;
      margin-right: 5px;
      border-radius: 5px;
      background: #F3F3F3;
      position: relative;
      overflow: hidden;
    }


    .reflection {
      position: absolute;
      ;
      width: 100%;
      height: 80px;
      background: #e3e3e3;
      animation: reflect 1s infinite alternate;
    }


    @keyframes reflect {
      0% {
        opacity: 1;
        right: 0;
      }

      100% {
        opacity: 0.3;
        right: 100%;
      }
    }


    /* APPROVED CANDIDATES STYLE FORMAT */

    .details-2 {
      display: flex;
      width: 600px;
      justify-content: space-between;

    }

    .column-1 {
      width: 380px;

    }

    .column-2 {
      width: 100px;
      display: flex;
      flex-direction: column;

    }


    .details-2 .b {
      width: 80px;
      text-align: center;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .details-2 .b:nth-child(2) {
      background: yellow;
      color: black;
    }


    .details-2 .b:hover {
      outline: 1px solid black;
    }

    .next-refresh {
      display: flex;
      flex-direction: row;
      border: 1px solid lightgray;
      justify-content: space-between;
      align-items: center;
    }

    .next-refresh .refresh {
      width: 60px;
      cursor: pointer;
      padding: 5px 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      border-radius: 10px;
      background: #9010BF;
      color: white;
    }

    .next-refresh .refresh:hover {
      border: 1px solid black;
    }


    .icons-1 {
      width: 10px;
      margin: 0 3px;
    }

    .next-and-previous {
      display: flex;
    }




    /* Blogs styles */

    .blogs-state {
      width: 210px;
      display: flex;
      align-items: center;
      justify-content: center;

    }

    .blogs-state .blog-btn {
      width: 80px;
      cursor: pointer;
      padding: 5px 10px;
      font-size: 14px;
      border-radius: 5px;
      background: #fafafa;
      font-weight: bold;
      font-family: Roboto;

      text-align: center;
      margin-right: 8px;
      border: 1px solid black;
      color: black;
    }

    .blogs-state .blog-active {
      background: #9010BF;
      color: white;
    }

    .blogpost-container {
      width: 610px;
      height: 400px;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #f1f1f1;
      overflow-y: scroll;
    }

    .blogpost-container::-webkit-scrollbar {
      width: 6px;
    }




    .blogpost-container::-webkit-scrollbar-track {
      background-color: transparent;
      border-radius: 10px;
    }

    .blogpost-container::-webkit-scrollbar-thumb {
      background: #9010BF;
      border-radius: 10px;

    }



    .post {
      width: 580px;
      height: 60px;

      margin-bottom: 10px;
      display: flex;
      align-items: center;
      padding: 10px;
      border-radius: 12px;
    }

    .post:nth-child(odd) {
      background: #fafafa;
    }

    .post .post-image {
      width: 60px;
      height: 60px;
      border-radius: 12px;
      margin-right: 10px;
    }

    .post .title-date {
      width: 450px;
      height: 60px;

      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .post .title-date .title {
      font-size: 22px;
      color: black;
    }

    .post .delete-wrap {
      width: 100px;

    }

    .post .delete-wrap .delete {
      width: 60px;
      cursor: pointer;
      padding: 8px 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      border-radius: 10px;
      background: red;
      color: white;
      font-weight: bold;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: flex-start;
    }

    .profile-preview {
      width: 220px;
      height: 220px;
      object-fit: cover;
      border-radius: 10px;
      display: none;
    }

    .upload-btn {
      width: 180px;
      padding: 5px 10px;
      border-radius: 12px;
      border: 1px dashed grey;
      font-family: Poppin;
      font-size: 10px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 10px;
      cursor: pointer;
    }

    #error-message {
      color: red;
      width: 200px;
    }

    .upload-btn:hover {
      background: #9010BF;
      color: white;
      border-color: #9010BF;
    }

    #ttl {
      width: 400px;
      padding: 10px;
      font-size: 14px;
      border-radius: 10px;
      background: white;
      border: 1px solid grey;
      margin-bottom: 15px;
      outline: none;
      font-family: Poppin;
    }

    #body {
      width: 400px;
   
      padding: 10px;
      font-size: 18px;
      border-radius: 10px;
      background: white;
      border: 1px solid grey;
      margin-bottom: 15px;
      outline: none;
      font-family: Poppin;
      resize: none;
    }

    label {
      font-size: 22px;
      font-family: Poppin;
      color: grey;
    }

    #publish {
      margin-top: 10px;
      width: 200px;
      padding: 5px;
      font-size: 13px;
      border-radius: 10px;
      background: #9010BF;
      color: white;
      font-weight: bold;
      font-family: Poppin;
      border: none;
    }

    .blog-none {
      display: none;
    }

    .create-wrapper {
      display: none;
    }

    .refresh-loader {
      text-align: center;
      margin-bottom: 20px;
      font-family: Roboto;
      display: none;
      justify-content: center;
      align-items: center;
      background: white;

    }


    .loader-spinning {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 4px 8px;
      width: 100px;
      border: 1px solid grey;
      border-radius: 10px;
    }

    .loader-spinner {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      animation: spinner 1s linear infinite;
    }

    @keyframes spinner {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .active-spinner {
      display: flex;
    }

    a {
      text-decoration: none;
    }

    .error-mssg {
      color: red;
      font-size: 12px;
    }


    .candidate-information {
      width: 580px;
      height: 350px;

      border-radius: 12px;
      background: #FBF7FDff;
      border: 1px solid #f1f1f1;
      box-shadow: 1px 1px 4px lightgray;
      display: none;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
    }

    .candidate-active {
      display: flex;
    }

    .close-container {
      width: 540px;
      height: 20px;
      padding: 5px 20px;
      border-bottom: 1px solid lightgrey;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .user-detail {
      font-family: Roboto;
      font-size: 16px;

    }

    .close-btn {
      padding: 2px 10px;
      background: red;
      color: white;
      border-radius: 12px;
      font-size: 13px;
      cursor: pointer;
    }

    .candidate-profile-details {

      width: 540px;
      height: 80px;
      padding: 5px 20px;
      border-bottom: 1px solid lightgray;

    }

    .candidate-detail {
      display: flex;
      flex-direction: row;
      align-items: center;
    }

    .img {
      width: 70px;
      height: 70px;
      border-radius: 10px;
      object-fit: cover;
      margin: 0 20px;
    }


    .label {
      font-size: 10px;

    }

    .font {
      font-size: 11px;
      margin-top: -3px;
      color: black;
      font-weight: 500;
    }

    .candidate-info {
      width: 540px;
      height: 210px;
      display: flex;
      align-items: center;
      padding: 5px 20px;
      border-radius: 12px;

    }


    .hide-list {
      display: flex;
    }

    .personal-info,
    .contact-info,
    .background {
      width: 180px;
      height: 210px;
      border-right: 1px solid lightgray;
    }

    .background {
      border: none;
    }

    .label-1 {
      font-size: 10px;
    }

    .font-1 {
      font-size: 11px;
      color: black;
      margin-bottom: 10px;
    }

    .head {
      color: black;
      font-weight: bold;
      margin-bottom: 15px;
      margin-top: 5px;
      font-size: 14px;
    }

    .admission-status,
    .account-status {
      background: rgb(230, 244, 234);
      padding: 1px 5px;
      display: inline-block;
      font-size: 10px;
      border: 1px solid green;
      color: green;
      border-radius: 5px;
    }
    
    .contact-info, .background {
      margin-left: 20px;
    }
    
    
    
    
    
    /* Financial status style */
    
    
    #insights {
      width: 610px;
      height: 450px;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #f1f1f1;
      overflow-y: scroll;
    }
    
    .title-4 {
      margin-left: 15px;
    }
    
    .earning-dashboard {
      width: 550px;
      height: 150px;
      padding: 20px;
      background: blue;
      border-radius: 15px;
      margin-bottom: 20px;
      margin-left: 11px;
    }
    
    .report-dashboard {
      width: 550px;
      height: 100px;
      padding: 20px;
      background: blue;
      border-radius: 15px;
      margin-left: 11px;
    }
    
    
    .dash-title-1 {
      color: white;
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 10px;
    }
    
    .earning-wrappers {
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    
    .wrapper-title, .report-message {
      font-size: 18px;
      color: white;
    }
    
    .amount {
      font-size: 30px;
      color: white;
    }
    
    
    
    /* Complain box styles */
    
    #complain {
      width: 610px;
      height: 450px;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #f1f1f1;
      
    }
    
    .not {
      border-bottom: 1px solid grey;
      width: 590px;
    }
    
    .complain-wrapper {
      height: 350px;
      width: 580px;
      overflow-y: scroll;
    }
    
    
    .complain-wrapper::-webkit-scrollbar {
      width: 4px;
    }
    
    .complain-wrapper::-webkit-scrollbar-track {
      background-color: transparent;
      border-radius: 10px;
    }

    .complain-wrapper::-webkit-scrollbar-thumb {
      background: #9010BF;
      border-radius: 10px;

    }
    
    
    .message {
      width: 500px;
      padding-left: 12px;
      border-left: 2px solid #fafafa;
      margin-bottom: 10px;
      display: flex;
      align-items: center ;
      font-weight: bold;
      
    }
    
    .message-receive {
      color: black;
      cursor: pointer;
    }
    
    
    .message:hover {
      border-left: 2px solid #9010BF;
    }
    
    .complain-icon {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }
    
    .image-wrap {
      width: 60px;
      height: 60px;
      background: #fafafa;
      border-radius: 12px;
      display: flex;
      align-items: center ;
      justify-content: center ;
      margin-right: 15px;
    }
    
    
    /* Settings stylea */
    
    
    
    
    #settings {
      width: 610px;
      height: 450px;
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
      font-weight: bold;
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
      width: 22px;
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
  
   
   .candidate-icon {
       object-fit: cover;
   }
   
   .app-list
   .view-icon {
       width: 80px;
       height: 80px;
       object-fit: cover;
   }
   
   .app-list {
       display: block;
       
   }
   
   .head {
       font-size: 13px;
   }
   
   #body {
     min-height: 40px;
     font-size: 14px;
     max-height: 150px;
   }
   
   #body:hover, #ttl:hover {
       border-color: #9010bf;;
       box-shadow: 1px 1px 5px lightgray;
   }
   
   
   .post-error {
       color: red;
       margin-top: -5px;
       margin-bottom: 10px;
       font-size: 13px;
   }
   
   .created  {
       background: rgb(230, 244, 234);
       font-size: 14px;
       font-family: Poppin;
       color: green;
       border: 1px solid green;
       border-radius: 8px;
       padding: 5px;
       text-align: center;
       display: none;
       
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
        <img src="../public/images/_f3cd91b7-61bd-436f-a055-acfb38622ed4.jpeg" alt="User image here" class="user-image " id="profile-peview">

        <div class="upload-image" id="upload-image">
          <input type="file" name="profile" id="profile-change" accept="image/" hidden>
          <img src="../public/icons/camera.png" alt="Upload-image" class="edit-icon">
        </div>

      </div>
      <div class="error-mssg"></div>
      <div class="user-name">
        <span>Hi,</span> <span class="name">
          Sumayya
        </span>
      </div>
    </div>
    
    <div class="menu-wrapper">
      <div class="list-wrapper">
        <div class="test active-menu" id="admission-list-btn">
          <img src="../public/icons/candidate-profile.png" alt="" class="icon">
          Admission List
        </div>
        <div class="test" id="approved-list-btn">
          <img src="../public/icons/candidate.png" alt="" class="icon">
          Admitted Candidates
        </div>
        <div class="test" id="blogs-btn">
          <img src="../public/icons/blogging.png" alt="" class="icon">
          <span>Manage Blogs</span>


        </div>

        <div class="test" id="insights-btn">
          <img src="../public/icons/insight.png" alt="" class="icon">
          Financial Status
        </div>
        <div class="test" id="complaint-btn">
          <img src="../public/icons/complain (1).png" alt="" class="icon">
          Complaint Box
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

      <!-- Admissions List -->
      <div class="child-format active-container" id="admission-list">
        <div class="container-title">
          <div class="title">
            Candidates List
          </div>
          <div class="search-wrapper">
            <label for="search">Search</label>
            <input type="search" id="search" placeholder="e.g 'Sumayya Garba'" class="search">
          </div>
        </div>



        <div class="candidate-information adlist approved-list">
           <div class="close-container">
             <div class="user-detail">User Details</div>
             <a class="close-btn pending-list">Close</a>
           </div>
          
           <div class="candidate-profile-details">
          
             <div class="candidate-detail">
               <img src="../public/images/_03aaa487-5059-4de2-9c66-1109cafe5d95.jpeg" alt="" class="img capture">
          
               <div class="names-list">
                 <div class="label">Full name:</div>
                 <div class="name font">Sumayya Garba Diggie</div>
                 <div class="label">Admission number:</div>
                 <div class="admission font">UNT/21/0022</div>
                 <div class="label">Email address:</div>
                 <div class="email-address font">sumayya@google.com</div>
               </div>
             </div>
           </div>
          
           <div class="candidate-info">
             <div class="personal-info">
               <div class="head">
                 Personal Information
               </div>
               <div class="label-1">Phone number:</div>
               <div class="phone-number font-1">08167979956</div>
               <div class="label-1">Date of Birth: </div>
               <div class="dob font-1">05-01-2001</div>
               <div class="label-1">Account status:</div>
               <div class="account-status font-1">Verified</div>
              <!--  <div class="label-1">Scho status:</div>
              <div class="admission-status font-1">Approved</div> -->
             </div>
             <div class="contact-info">
               <div class="head">
                 Contact Information
               </div>
               <div class="label-1">Home address:</div>
               <div class="home-address font-1">Tudun Wada area</div>
               <div class="label-1">Local government: </div>
               <div class="local-g font-1">Zuru</div>
               <div class="label-1">State of origin: </div>
               <div class="state-origin font-1">Kebbi</div>
               <div class="label-1">Nationality: </div>
               <div class="nationality font-1">Nigeria</div>
          
          
             </div>
             <div class="background">
               <div class="head">
                 Educational Background
               </div>
               <div class="label-1">Previous school:</div>
               <div class="previous-school font-1">Andi gomo model primary school</div>
               <div class="label-1">Year of passing </div>
               <div class="year-of-passing font-1">2015</div>
               <div class="label-1">Admission type:</div>
               <div class="admission-type font-1">Transfer</div>
               <div class="label-1">Admission class: </div>
               <div class="admission-class font-1">JSS 3</div>
             </div>
           </div>
        </div>


        <div class="candidates-container">
          <!-- REFRESHING LOADER -->
          <div class="refresh-loader" id="refresh">
            <div class="loader-spinning">
              <span>Refreshing</span>
              <span>
                <img src="../public/icons/loading.png" alt="" class="icons-1 loader-spinner">
              </span>
            </div>


          </div>
          
          <!-- Candidates list before approval -->
          <div class="list hide-list list-before-approval before"  >
           
            <?php foreach ($candidates as $data) { ?>
            <?php if (!$data["isApproved"]) { ?>
            <div class="candidate">
              <img src="../public/uploads/<?php echo $data[
                "display_image"
              ]; ?>" alt="Profile image" class="candidate-icon" >
              <div class="candidate-details">
                <div class="fullname">
                  <?php echo $data["fullname"]; ?>
                </div>
                <div class="email">
                    <?php echo $data["email"]; ?>
                </div>
                <div class="admission-no">
                UNT/21/    <?php echo $data["admission_no"]; ?>
                </div>
                <div class="buttons">
                  <a class="btn views-btn btn-1 pending-list" data-id=" <?php echo $data[
                    "can_id"
                  ]; ?>">View Info</a>
                  <a class="btn btn-2">Admit</a>
                  <a class="btn btn-3">Cancel</a>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php } ?>
          </div>

          <!-- Skeleton loader -->
          <div class="list-skeleton">
          </div>
        </div>

        <div class="next-btn next-refresh">
          <div class="next-and-previous">
            <a class="fetch-candidate">
              <img src="../public/icons/back-arrow.png" alt="" class="icons-1">
              <div>Previous</div>

            </a>
            <a class="fetch-candidate">
              <div>Next</div>
              <img src="../public/icons/next (1).png" alt="" class="icons-1">
            </a>
          </div>
          <a href="#refresh" class="refresh first-refresh-btn" >
            <div>Refresh</div>
            <img src="../public/icons/refresh.png" alt="" class="icons-1">
          </a>
        </div>
      </div>

      <!-- Approved List -->
      <div class="child-format" id="approved-list">
        <div class="container-title">
          <div class="title">
            Approved Candidates
          </div>
          <div class="search-wrapper">
            <label for="search">Search</label>
            <input type="search" id="search" placeholder="e.g 'Sumayya Garba'" class="search">
          </div>
        </div>

        <div class="candidates-container">

          <!-- REFRESHING LOADER -->

          <div class="candidate-information approved-list aplist">
            <div class="close-container">
              <div class="user-detail">User Details</div>
              <a class="close-btn approved-list">Close</a>
            </div>

            <div class="candidate-profile-details">
              
              <div class="candidate-detail">
                <img src="../public/images/_03aaa487-5059-4de2-9c66-1109cafe5d95.jpeg" alt="" class="img capture">

                <div class="names-list">
                  <div class="label">Full name:</div>
                  <div class="name font">Sumayya Garba Diggie</div>
                  <div class="label">Admission number:</div>
                  <div class="admission font">UNT/21/0022</div>
                  <div class="label">Email address:</div>
                  <div class="email-address font">sumayya@google.com</div>
                </div>
              </div>
            </div>

            <div class="candidate-info">
              <div class="personal-info">
                <div class="head">
                  Personal Information
                </div>
                <div class="label-1">Phone number:</div>
                <div class="phone-number font-1">08167979956</div>
                <div class="label-1">Date of Birth: </div>
                <div class="dob font-1">05-01-2001</div>
                <div class="label-1">Account status:</div>
                <div class="account-status font-1">Verified</div>
                <div class="label-1">Admission status:</div>
                <div class="admission-status font-1">Approved</div>
              </div>
              <div class="contact-info">
                <div class="head">
                  Contact Information
                </div>
                <div class="label-1">Home address:</div>
                <div class="home-address font-1">Tudun Wada area</div>
                <div class="label-1">Local government: </div>
                <div class="local-g font-1">Zuru</div>
                <div class="label-1">State of origin: </div>
                <div class="state-origin font-1">Kebbi</div>
                <div class="label-1">Nationality: </div>
                <div class="nationality font-1">Nigeria</div>


              </div>
              <div class="background">
                 <div class="head">
                  Educational Background
                </div>
                <div class="label-1">Previous school:</div>
                <div class="previous-school font-1">Andi gomo model primary school</div>
                <div class="label-1">Year of passing </div>
                <div class="year-of-passing font-1">2015</div>
                <div class="label-1">Admission type:</div>
                <div class="admission-type font-1">Transfer</div>
                <div class="label-1">Admission class: </div>
                <div class="admission-class font-1">JSS 3</div>
              </div>
            </div>
            
            
          </div>

          <div class="refresh-loader" id="refresh-2">
            <div class="loader-spinning">
              <span>Refreshing</span>
              <span>
                <img src="../public/icons/loading.png" alt="" class="icons-1 loader-spinner">
              </span>
            </div>
          </div>

          <div class="list hide-list app-list">
           <?php foreach ($candidates as $data) { ?>
            <?php if ($data["isApproved"]) { ?>
            <div class="candidate">
               <div>
               <img src="../public/uploads/<?php echo $data[
                 "display_image"
               ]; ?>" alt="Profile image" class="candidate-icon" >
               </div>
              <div class="candidate-details details-2">
                <div class="column-1">
                  <div class="fullname">
                    <?php echo $data["fullname"]; ?>
                  </div>
                  <div class="email">
                    <?php echo $data["email"]; ?>
                  </div>
                  <div class="admission-no">
                    UNT/21/<?php echo $data["admission_no"]; ?>
                  </div>
                </div>
                <div class="column-2">
                  <div class="buttons column-2">
                    <a class="btn b views-btn btn-1 approved-list" data-id="<?php echo $data[
                      "can_id"
                    ]; ?>">View Info</a>
                    <a class="btn b btn-2">Cancel Admission</a>
                    <a class="btn b btn-3">Delete</a>
                  </div>
                </div>
              </div>
            </div>
              <?php } ?>
              <?php } ?>
          </div>


        </div>
        <div class="next-btn next-refresh">
          <div class="next-and-previous">
            <a class="fetch-candidate">
              <img src="../public/icons/back-arrow.png" alt="" class="icons-1">
              <div>Previous</div>

            </a>
            <a class="fetch-candidate">
              <div>Next</div>
              <img src="../public/icons/next (1).png" alt="" class="icons-1">
            </a>
          </div>
          <a href="#refresh-2" class="refresh approved">
            <div>Refresh</div>
            <img src="../public/icons/refresh.png" alt="" class="icons-1">
          </a>
        </div>
      </div>

      <!-- Blogs management -->
      <div class="child-format" id="blogs">
        <div class="container-title">
          <div class="title">
            Events and Updates
          </div>
          <div class="search-wrapper blogs-state">
            <div class="blog-btn blogs-btn blog-active">
              Blogspot
            </div>
            <div class="blog-btn create-btn ">
              Creates
            </div>
          </div>
        </div>


        <div class="blogpost-container">
          <div class="refresh-loader" id="refresh-3">
            <div class="loader-spinning">
              <span>Refreshing</span>
              <span>
                <img src="../public/icons/loading.png" alt="" class="icons-1 loader-spinner">
              </span>
            </div>
          </div>
          <div class="post">
            <img src="../public/images/_b1a7c3d1-69a1-4c95-acbd-bda4d19861fb.jpeg" alt="" class="post-image">
            <div class="title-date">
              <div class="title">Hello World</div>
              <div class="date"> 16 hours ago</div>
            </div>
            <div class="delete-wrap">
              <div class="delete">
                <div>Delete</div>
                <img src="../public/icons/delete (1).png" alt="" class="icons-1">
              </div>
            </div>
          </div>
          <div class="post">
            <img src="../public/images/_b1a7c3d1-69a1-4c95-acbd-bda4d19861fb.jpeg" alt="" class="post-image">
            <div class="title-date">
              <div class="title">Hello World</div>
              <div class="date"> 16 hours ago</div>
            </div>
            <div class="delete-wrap">
              <div class="delete">
                <div>Delete</div>
                <img src="../public/icons/delete (1).png" alt="" class="icons-1">
              </div>
            </div>
          </div>
          <div class="post">
            <img src="../public/images/_b1a7c3d1-69a1-4c95-acbd-bda4d19861fb.jpeg" alt="" class="post-image">
            <div class="title-date">
              <div class="title">Hello World</div>
              <div class="date"> 16 hours ago</div>
            </div>
            <div class="delete-wrap">
              <div class="delete">
                <div>Delete</div>
                <img src="../public/icons/delete (1).png" alt="" class="icons-1">
              </div>
            </div>
          </div>
          <div class="post">
            <img src="../public/images/_b1a7c3d1-69a1-4c95-acbd-bda4d19861fb.jpeg" alt="" class="post-image">
            <div class="title-date">
              <div class="title">Hello World</div>
              <div class="date"> 16 hours ago</div>
            </div>
            <div class="delete-wrap">
              <div class="delete">
                <div>Delete</div>
                <img src="../public/icons/delete (1).png" alt="" class="icons-1">
              </div>
            </div>
          </div>
          <div class="post">
            <img src="../public/images/_b1a7c3d1-69a1-4c95-acbd-bda4d19861fb.jpeg" alt="" class="post-image">
            <div class="title-date">
              <div class="title">Hello World</div>
              <div class="date"> 16 hours ago</div>
            </div>
            <div class="delete-wrap">
              <div class="delete">
                <div>Delete</div>
                <img src="../public/icons/delete (1).png" alt="" class="icons-1">
              </div>
            </div>
          </div>
        </div>
        <div class="blogpost-container create-wrapper">
          <form id="post">
            <label for="ttl">Title:</label>
            <input type="text" name="title" id="ttl">
            <div class="post-error">
                
            </div>
            <label for="body">Content</label>
            <textarea name="body" id="body"></textarea>
             <div class="post-error">
                
            </div>
            <label for="image"></label>
            <a class="upload-btn" id="profile-btn">
              Upload passport
            </a>
            <div id="error-message"></div>
            <img class="profile-preview" id="profile-preview">
            <input type="file" hidden name="feature_image" id="post-upload-image" accept="image/*">
             <div class="post-error">
                
            </div>
            <input type="submit" value="Publish" name="publish" id="publish">
            <div class="created">
                Success! Your post has been created and is now live
            </div>
                      </form>
        </div>


        <div class="next-btn next-refresh blog-footer hh">
          <div class="next-and-previous">
            <a class="fetch-candidate">
              <img src="../public/icons/back-arrow.png" alt="" class="icons-1">
              <div>Previous</div>

            </a>
            <a class="fetch-candidate">
              <div>Next</div>
              <img src="../public/icons/next (1).png" alt="" class="icons-1">
            </a>
          </div>
          <a href="#refresh-3" class="refresh">
            <div>Refresh</div>
            <img src="../public/icons/refresh.png" alt="" class="icons-1">
          </a>
        </div>


      </div>

      <!-- Financial status -->
      <div class="child-format" id="insights">
        <div class="container-title">
          <div class="title title-4">
           Stats & Financial status 
          </div>
        </div>
        
        <div class="earning-dashboard">
          <div class="dash-title-1">
            School earnings 
          </div>
          <div class="earning-wrappers">
            <div class="paid">
              <div class="wrapper-title">
                Paid Balance 
              </div>
              <div class="total-amount amount">
                N102,000,00
              </div>
            </div>
            <div class="unpaid">
              <div class="wrapper-title">
                Unpaid Balance
              </div>
               <div class="total-amount amount">
                 N321,000,00
               </div>
            </div>
          </div>
        </div>
        <div class="report-dashboard">
          <div class="dash-title-1">
            Reports 
          </div>
          
          <div class="report-message">
            Balance is updated once a candidate completes their payment. If they haven't paid their admission fees, the balance will remain unpaid.
          </div>
        </div>
      </div>
      
      <!-- Complaint box -->
      <div class="child-format" id="complain">
        <div class="container-title">
          <div class="title not title-4">
           Notifications 
          </div>
        </div>
        
        <div class="complain-wrapper">
          <div class="message message-receive">
            <div class="image-wrap">
               <img src="../public/icons/inbox.png" alt="" class="complain-icon">
            </div>
            <div class="message-detail">
              <div class="font">ID: UNT/21/0023</div>
              <div class="label">Subject: I haven't got a my admission since I joined this platform</div>
              <div class="label">body: Lorem ipsum sheheyw.....</div>
            </div>
           
          </div>
          <div class="message message-receive">
            <div class="image-wrap">
               <img src="../public/icons/inbox.png" alt="" class="complain-icon">
            </div>
            <div class="message-detail">
              <div class="font">ID: UNT/21/0023</div>
              <div class="label">Subject: I haven't got a my admission since I joined this platform</div>
              <div class="label">body: Lorem ipsum sheheyw.....</div>
            </div>
           
          </div>
          <div class="message message-receive">
            <div class="image-wrap">
              <img src="../public/icons/inbox.png" alt="" class="complain-icon">
            </div>
            <div class="message-detail">
              <div class="font">ID: UNT/21/0023</div>
              <div class="label">Subject: I haven't got a my admission since I joined this platform</div>
              <div class="label">body: Lorem ipsum sheheyw.....</div>
            </div>
          
          </div>
          <div class="message message-receive">
            <div class="image-wrap">
              <img src="../public/icons/inbox.png" alt="" class="complain-icon">
            </div>
            <div class="message-detail">
              <div class="font">ID: UNT/21/0023</div>
              <div class="label">Subject: I haven't got a my admission since I joined this platform</div>
              <div class="label">body: Lorem ipsum sheheyw.....</div>
            </div>
          
          </div>
          <div class="message">
            <div class="image-wrap">
              <img src="../public/icons/received.png" alt="" class="complain-icon">
            </div>
            <div class="message-detail">
              <div class="font">ID: UNT/21/0023</div>
              <div class="label">Subject: I haven't got a my admission since I joined this platform</div>
              <div class="label">body: Lorem ipsum sheheyw.....</div>
            </div>
          
          </div>
          <div class="message">
            <div class="image-wrap">
              <img src="../public/icons/received.png" alt="" class="complain-icon">
            </div>
            <div class="message-detail">
              <div class="font">ID: UNT/21/0023</div>
              <div class="label">Subject: I haven't got a my admission since I joined this platform</div>
              <div class="label">body: Lorem ipsum sheheyw.....</div>
            </div>
          
          </div>
          <div class="message">
            <div class="image-wrap">
              <img src="../public/icons/received.png" alt="" class="complain-icon">
            </div>
            <div class="message-detail">
              <div class="font">ID: UNT/21/0023</div>
              <div class="label">Subject: I haven't got a my admission since I joined this platform</div>
              <div class="label">body: Lorem ipsum sheheyw.....</div>
            </div>
          
          </div>
          <div class="message">
            <div class="image-wrap">
              <img src="../public/icons/received.png" alt="" class="complain-icon">
            </div>
            <div class="message-detail">
              <div class="font">ID: UNT/21/0023</div>
              <div class="label">Subject: I haven't got a my admission since I joined this platform</div>
              <div class="label">body: Lorem ipsum sheheyw.....</div>
            </div>
          
          </div>
        </div>
      </div>
      
      
      <div class="child-format" id="settings">
         <div class="container-title">
           <div class="title not title-4">
             Settings 
           </div>
         </div>
         
         <div class="password-wrapper">
           <form id="form">
             
            <div class="input-group">
              <label for="current-password">
                   Current password 
              </label>
              <input type="password" name="current-password" id="current-password" >
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
   
   var clickApproved = document.getElementById("approved-list-btn");
  
   if(localStorage.getItem('isclick')) {
   // clickApproved.click();
   document.getElementById('approved-list-btn').click();

   } 


  
  
  
    var viewsBtn = document.querySelectorAll('.views-btn');
    var viewsDetail = document.querySelectorAll('.candidate-information');
    var closeBtn = document.querySelectorAll('.close-btn');
    var searchInput = document.querySelectorAll('.search');
    var hiddenList = document.querySelectorAll('.hide-list');

    var nextButtonWrap = document.querySelectorAll('.next-btn');
    
    
   

    // Before approval 
    let adList = document.querySelector('.adlist');
    
   
    var pendingFname = document.querySelector(".adlist .name");
   
    var pendingAdmission = document.querySelector(".adlist  .admission");
    var pendingEmail = document.querySelector(".adlist   .email-address");
    var pendingPhoneNo = document.querySelector(".adlist .phone-number");
    var pendingDOB = document.querySelector(".adlist   .dob");
    var pendingAddress = document.querySelector(".adlist   .home-address");
    
    var pendingLocalG = document.querySelector(".adlist .local-g");
    var pendingState = document.querySelector(".adlist .state-origin");
    var pendingNat = document.querySelector(".adlist .nationality");
    
    var pendingPrevious = document.querySelector(".adlist .previous-school");
    var pendingPassing = document.querySelector(".adlist .year-of-passing");
    var pendingClass = document.querySelector(".adlist .admission-class");
    var pendingType = document.querySelector(".adlist .admission-type");
    var pendingIcon = document.querySelector(".adlist .capture");
    
    // After approval 
    let aplist = document.querySelector('.aplist');

var approvedFname = document.querySelector(".aplist .name");
var approvedAdmission = document.querySelector(".aplist  .admission");
var approvedEmail = document.querySelector(".aplist   .email-address");
var approvedPhoneNo = document.querySelector(".aplist .phone-number");
var approvedDOB = document.querySelector(".aplist   .dob");
var approvedAddress = document.querySelector(".aplist   .home-address");

var approvedLocalG = document.querySelector(".aplist .local-g");
var approvedState = document.querySelector(".aplist .state-origin");
var approvedNat = document.querySelector(".aplist .nationality");

var approvedPrevious = document.querySelector(".aplist .previous-school");
var approvedPassing = document.querySelector(".aplist .year-of-passing");
var approvedClass = document.querySelector(".aplist .admission-class")
var approvedType = document.querySelector(".aplist .admission-type")
var approvedIcon = document.querySelector(".aplist .capture");

 

    
    // Get candidate data
    
         
     
         viewsBtn.forEach(view => {
      view.addEventListener('click', async function(){
        
      
        if (view.classList.contains('pending-list')) {
          viewsDetail[0].style.display = 'block'
          searchInput[0].readOnly = true;
          searchInput[0].placeholder = 'Search not allowed';
          searchInput[0].style.border = '1px solid red';
          hiddenList[0].style.display = 'none'
          nextButtonWrap[0].style.display = 'none';
         
     
         let id = this.dataset.id;
         
        var findCandidate = new FormData();
         findCandidate.append('id', id);
      
      try {
        const res = await fetch("http://localhost:8080/include/getCan.php", {
            method: "POST",
            body: findCandidate
        });
       
        
        if(!res.ok) {
          throw Error("Something wrong with the server.")
        }
        
        const result = await res.json();
        
        if(result.data) {
         pendingFname.textContent = result["data"]["fullname"];
         pendingEmail.textContent = result["data"]["email"];
         pendingAdmission.textContent = "UNT/21/" + result["data"]["admission_no"];
         pendingPhoneNo.textContent = result["data"]["phone_no"];
         pendingDOB.textContent = result["data"]["dob"];
         pendingAddress.textContent = result["data"]["address"];
         pendingState.textContent = result["data"]["state"];
         pendingNat.textContent = result["data"]["nationality"];
         pendingPrevious.textContent = result["data"]["previous_school"];
         pendingPassing.textContent = result["data"]["year_of_passing"];
         pendingLocalG.textContent = result["data"]["localG"];
         pendingType.textContent = result["data"]["admission_type"];
         pendingClass.textContent = result["data"]["admission_class"];
         pendingIcon.src = "../public/uploads/" + result["data"]["display_image"];
        }
  
        
        
      } catch(err) {
          alert(err.message)
       // return err.message;
      }
    
        }

        
        if (view.classList.contains('approved-list')) {
          viewsDetail[1].style.display = 'block'
          searchInput[1].readOnly = true;
          searchInput[1].placeholder = 'Search not allowed';
          searchInput[1].style.border = '1px solid red';
          hiddenList[1].style.display = 'none'
          nextButtonWrap[1].style.display = 'none';
          
          let id = this.dataset.id;
         
        var findCandidate = new FormData();
         findCandidate.append('id', id);
      
      try {
        const res = await fetch("http://localhost:8080/include/getCan.php", {
            method: "POST",
            body: findCandidate
        });
       
        
        if(!res.ok) {
          throw Error("Something wrong with the server.")
        }
        
        const result = await res.json();
    
       if(result.data) {
     approvedFname.textContent = result["data"]["fullname"];
     approvedEmail.textContent = result["data"]["email"];
     approvedAdmission.textContent = "UNT/21/" + result["data"]["admission_no"];
     approvedPhoneNo.textContent = result["data"]["phone_no"];
     approvedDOB.textContent = result["data"]["dob"];
     approvedAddress.textContent = result["data"]["address"];
     approvedState.textContent = result["data"]["state"];
     approvedNat.textContent = result["data"]["nationality"];
     approvedPrevious.textContent = result["data"]["previous_school"];
     approvedPassing.textContent = result["data"]["year_of_passing"];
     approvedLocalG.textContent = result["data"]["localG"];
     approvedType.textContent = result["data"]["admission_type"];
     approvedClass.textContent = result["data"]["admission_class"];
     approvedIcon.src = "../public/uploads/" + result["data"]["display_image"];
}

        
        
      } catch(err) {
          alert(err.message)
       // return err.message;
      }
    
        }


      })
    })

 


    closeBtn.forEach(btn => {
      btn.addEventListener('click', () => {

        

        if (btn.classList.contains('pending-list')) {
          viewsDetail[0].style.display = 'none'
          searchInput[0].readOnly = false;
          searchInput[0].placeholder = "e.g 'Sumayya Garba'"

          searchInput[0].style.border = '1px solid grey';
          hiddenList[0].style.display = 'block'
          nextButtonWrap[0].style.display = 'flex';
        }
        
        
        if (btn.classList.contains('approved-list')) {
          
         
          viewsDetail[1].style.display = 'none'
          searchInput[1].readOnly = false;
          searchInput[1].placeholder = "e.g 'Sumayya Garba'"

          searchInput[1].style.border = '1px solid grey';
          hiddenList[1].style.display = 'block'
          nextButtonWrap[1].style.display = 'flex';
        }
        
        
        
        

      })
    })
  



    var postUploadBtn = document.getElementById('profile-btn');
    var postUploadImage = document.getElementById('post-upload-image');
    var imagePreview = document.getElementById('profile-preview');
    var imageErr = document.getElementById('error-message');


    const imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'svg', 'raw', 'webp'];
    const isInArray = imageExtensions.includes('jpg');






    postUploadBtn.addEventListener('click', () => {
      postUploadImage.click();
    });
    postUploadImage.addEventListener('change', function() {

      if (this.files && this.files[0]) {
        var reader = new FileReader();
        var imageName = this.files[0].name;


        reader.onload = function(e) {
          imagePreview.src = e.target.result;
          imagePreview.style.display = 'block';


          const imageArr = imageName.split('.')
          var imageExt = imageArr.pop();

          if (imageExtensions.includes(imageExt.toLowerCase())) {
            postUploadBtn.style.background = 'rgb(230, 244, 234)';
            postUploadBtn.style.borderColor = 'green';
            postUploadBtn.style.color = 'green';
            postUploadBtn.textContent = 'Image uploaded';
            imageErr.textContent = ''
          } else {
            imageErr.textContent = 'Sorry, only files with extensions: jpeg, jpg, png, gif, bmp, tiff, tif, svg, raw, or webp are allowed for upload.'

            postUploadBtn.style.background = 'var(--main-bg-color)';
            postUploadBtn.style.borderColor = 'var(--primary-color)';
            postUploadBtn.style.color = 'var(--font-main-color)';
            postUploadBtn.textContent = 'Passport uploaded';
            imagePreview.style.display = 'none'
            postUploadBtn.textContent = 'Upload passport';
          }

        };

        reader.readAsDataURL(this.files[0]);

      }
    });







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
    let admissionListWrap = document.getElementById("admission-list");
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
        if (button.id !== 'logout-btn') {
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




    let skeletonWrapoer = document.querySelector('.list-skeleton');

    function createCandidateSkeleton() {



      for (var i = 0; i < 6; i++) {
        // Create main container div with class "candidate-skeleton"
        var candidateSkeleton = document.createElement("div");
        candidateSkeleton.classList.add("candidate-skeleton");

        // Create div with class "img-skl" and append it to candidateSkeleton
        var imgSkeleton = document.createElement("div");
        imgSkeleton.classList.add("img-skl");
        candidateSkeleton.appendChild(imgSkeleton);

        // Create div with class "reflection" and append it to imgSkeleton
        var imgReflection = document.createElement("div");
        imgReflection.classList.add("reflection");
        imgSkeleton.appendChild(imgReflection);

        // Create div with class "details-skl" and append it to candidateSkeleton
        var detailsSkeleton = document.createElement("div");
        detailsSkeleton.classList.add("details-skl");
        candidateSkeleton.appendChild(detailsSkeleton);

        // Create div with class "fullname-skl" and append it to detailsSkeleton
        var fullnameSkeleton = document.createElement("div");
        fullnameSkeleton.classList.add("fullname-skl");
        detailsSkeleton.appendChild(fullnameSkeleton);

        // Create div with class "reflection" and append it to fullnameSkeleton
        var fullnameReflection = document.createElement("div");
        fullnameReflection.classList.add("reflection");
        fullnameSkeleton.appendChild(fullnameReflection);

        // Create div with class "email-skl" and append it to detailsSkeleton
        var emailSkeleton = document.createElement("div");
        emailSkeleton.classList.add("email-skl");
        detailsSkeleton.appendChild(emailSkeleton);

        // Create div with class "reflection" and append it to emailSkeleton
        var emailReflection = document.createElement("div");
        emailReflection.classList.add("reflection");
        emailSkeleton.appendChild(emailReflection);

        // Create div with class "admission-skl" and append it to detailsSkeleton
        var admissionSkeleton = document.createElement("div");
        admissionSkeleton.classList.add("admission-skl");
        detailsSkeleton.appendChild(admissionSkeleton);

        // Create div with class "reflection" and append it to admissionSkeleton
        var admissionReflection = document.createElement("div");
        admissionReflection.classList.add("reflection");
        admissionSkeleton.appendChild(admissionReflection);

        // Create div with class "buttons-skl" and append it to detailsSkeleton
        var buttonsSkeleton = document.createElement("div");
        buttonsSkeleton.classList.add("buttons-skl");
        detailsSkeleton.appendChild(buttonsSkeleton);


        // Create three divs with class "reflection" and append them to buttonsSkeleton
        var buttonReflection1 = document.createElement("div");
        buttonReflection1.classList.add("reflection");
        var buttonContainer1 = document.createElement("div");
        buttonContainer1.appendChild(buttonReflection1);
        buttonsSkeleton.appendChild(buttonContainer1);

        var buttonReflection2 = document.createElement("div");
        buttonReflection2.classList.add("reflection");
        var buttonContainer2 = document.createElement("div");
        buttonContainer2.appendChild(buttonReflection2);
        buttonsSkeleton.appendChild(buttonContainer2);

        var buttonReflection3 = document.createElement("div");
        buttonReflection3.classList.add("reflection");
        var buttonContainer3 = document.createElement("div");
        buttonContainer3.appendChild(buttonReflection3);
        buttonsSkeleton.appendChild(buttonContainer3);


        // Append the candidateSkeleton to the body or any other desired parent element




        skeletonWrapoer.appendChild(candidateSkeleton);
      }
    }

    // Call the function to create the candidate skeleton
    let candidatesLists = document.querySelector('.list');
    createCandidateSkeleton();

    candidatesLists.style.display = 'none';;
    setTimeout(() => {
      candidatesLists.style.display = 'block';
      skeletonWrapoer.style.display = 'none'
    }, 3000);



    // Blogs navigation setups 
    let blogBtn = document.querySelectorAll('.blog-btn')
    let blogsContainer = document.querySelectorAll('.blogpost-container')
    let blogFooter = document.querySelector('.blog-footer')

    blogBtn.forEach(btn => {
      btn.addEventListener('click', () => {
        blogBtn.forEach(btn => btn.classList.remove('blog-active'));
        blogsContainer.forEach(wrap => wrap.classList.add('blog-none'));


        btn.classList.add('blog-active');

        if (btn.classList.contains('create-btn')) {
          blogsContainer[1].classList.remove('blog-none')
          blogsContainer[1].classList.remove('create-wrapper');
          blogFooter.style.display = 'none';
        }

        if (btn.classList.contains('blogs-btn')) {
          blogsContainer[0].classList.remove('blog-none')
          blogFooter.style.display = 'flex';
        }


      })
    })



    // 
    let refreshLoader = document.querySelectorAll('.refresh-loader')
    let refreshBtn = document.querySelectorAll('.refresh')

    refreshBtn.forEach(btn => {
      btn.addEventListener('click', () => {
        refreshLoader.forEach(loader => loader.classList.add('active-spinner'));
        
        if(btn.classList.contains("approved")) {
          setTimeout(() => {
          localStorage.setItem('isclick', true);
          refreshLoader.forEach(loader => loader.classList.remove('active-spinner'));
          window.location.assign('./admin.php')
        }, 2000); 
       
        } else {
        setTimeout(() => {
          refreshLoader.forEach(loader => loader.classList.remove('active-spinner'));
          window.location.assign('./admin.php')
        }, 2000)
      }
      })
    })
    
    
    
    
    // FORGOT PASSWORD
    
    
    let currentPassword = document.getElementById('current-password');
    let currentPasswordWarn  = document.getElementById('warn');
    let form  = document.querySelector('#form');
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
    currentPassword.addEventListener('blur', () => {
    //  currentPasswordWarn.classList.remove('forgot-password-active');
    });
    
    
    form.addEventListener('submit', (e) => {
      e.preventDefault();
     
      var retypePassword = e.target.retype.value.trim();
      var password = e.target.newpassword.value.trim();
      
      if(retypePassword !== password ) {
        errors[2].textContent = 'Password mismatched, try again.'
      }
  
      
      if (password.length === 0) {
        errors[1].textContent = 'Password cannot be empty.'
      } else  if (password.length <= 5) {
        errors[1].textContent = 'Password must be at least 6 characters long.'; 
      } else {
        errors[1].textContent = ''; 
      }
      
    });
    
    
    
    
    // CREATES AND MANAGE BLOG POST
    
    var blogForm  = document.getElementById('post');
    var postErr = document.querySelectorAll('.post-error')
    var success = document.querySelector('.created')
    blogForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        
        var post = new FormData(this)
        
        try {
            const res = await fetch("../include/blog.php", {
                method: "POST",
                body: post
            });
            
            const result = await res.json();
           
            if(result.title) {
              postErr[0].textContent = result.title;  
            } else {
                 postErr[0].textContent = ""
            }
            if(result.feature_image) {
              postErr[2].textContent = result.feature_image;  
            } else {
                 postErr[2].textContent = ""
            }
            if(result.body) {
              postErr[1].textContent = result.body;  
            } else {
                 postErr[1].textContent = ""
            }
            
            if(result.redirect) {
                success.style.display = "block";
                this.title.value = "";
                this.body.value = "";
                this.feature_image.value = "";
            }
            
             
        } catch(err) {
            
            alert(err.message)
        } finally {
            setTimeout(() => {
                  success.style.display = "none";
            }, 3000)
        }
        
    })
    
  </script>
</body>

</html>
</body>

</html>