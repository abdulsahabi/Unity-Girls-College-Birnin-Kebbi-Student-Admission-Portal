<?php

include "../include/db.php";
include "../include/queries.php";

// Getting candidates
$stmt = $pdo->prepare(CANDIDATES);
$stmt->execute();
$candidates = $stmt->fetchAll();

//print_r($candidates);
$complainsStmt = $pdo->prepare(COMPLAINS);
$complainsStmt->execute();
$complains = $complainsStmt->fetchAll();
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
      font-size: 18px;
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
      height: 600px;
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
      font-size: 20px;
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
   
   /* Adjusting containers style */
    .list {
        height: 400px;
    }
    
      .no-content {
       height: 400px;
       width: 600px;
       background: white;
       display: flex;
       align-items: center ;
       justify-content: center ;
       flex-direction: column;
     }
     
     .man {
       width: 150px;
       height: 150px;
       
     }
     
     .no {
       font-size: 20px;
       font-family: Poppin_bold;
       color: black;
       
     }
     
     .tip {
         font-size: 10px;
         font-family: Time;
         width: 400px;
         margin-bottom: 15px;
     }
     
     .tip a {
         color: blue;
     }
     
      .password-changed {
          display: none;
      }
      
      .message-detail {
          display: flex;
          flex-direction: column;
      }
      
      .opened {
          color: #6A696B;
          font-family: Roboto;
      }
      
      .report-dashboard, .earning-dashboard {
          font-size: 12px;
          width: 500px;
      }
      
      .report-message {
          font-size: 12px;
      }
      
      #insights {
          overflow: hidden;
      }
      
      .title-4 {
          font-size: 14px;
      }
      
      .wrapper-title {
          font-size: 14px;
      }
      
      .user-profile {
          height: 150px;
      }
  </style>
</head>

<body>

  <!-- Two sections: Sidebar and Main sidebar contents-->
  <div class="sidebar">
    <div class="dashboard">
      <img class="header-icon" src="../public/icons/dashboard-main.png" alt="">
      <div class="dash-title">
        ADMIN — DASHBOARD
      </div>
    </div>
    <div class="user-profile">
      <div id="image-wrapper">
        <img src="../public/images/_f3cd91b7-61bd-436f-a055-acfb38622ed4.jpeg" alt="User image here" class="user-image " id="profile-peview">

        <div class="upload-image" id="upload-image">
          <input type="file" name="profile" id="profile-change" accept="image/" hidden>
          
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
          <div class="list hide-list list-before-approval-before pending"  >
           
           
          </div>

          <!-- Skeleton loader -->
          <div class="list-skeleton">
          </div>
        </div>

        <div class="next-btn next-refresh">
          <div class="next-and-previous">
            <a class="fetch-candidate" id="previous">
              <img src="../public/icons/back-arrow.png" alt="" class="icons-1">
              <div>Previous</div>

            </a>
            <a class="fetch-candidate" id="next">
              <div>Next</div>
              <img src="../public/icons/next (1).png" alt="" class="icons-1">
            </a>
          </div>
          <a href="#refresh" class="refresh first-refresh-btn pending" >
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
          
          </div>


        </div>
        <div class="next-btn next-refresh">
          <div class="next-and-previous">
            <a class="fetch-candidate" id="app-previous">
              <img src="../public/icons/back-arrow.png" alt="" class="icons-1">
              <div>Previous</div>

            </a>
            <a class="fetch-candidate" id="app-next">
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
          
           <div id="post-content">
           
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
            <div class="tip">
                Remember, you have the freedom to use valid HTML and CSS to style your content creatively. Explore different CSS properties and selectors to achieve the desired look and feel without limitations <a href="#">Learn more.</a>
            </div>
            <label for="image"></label>
            <a class="upload-btn" id="profile-btn">
              Feature image
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
            <a class="fetch-candidate" id="postPrevious">
              <img src="../public/icons/back-arrow.png" alt="" class="icons-1">
              <div>Previous</div>

            </a>
            <a class="fetch-candidate" id="postNext">
              <div>Next</div>
              <img src="../public/icons/next (1).png" alt="" class="icons-1">
            </a>
          </div>
          <a href="#refresh-3" class="refresh post-refresh">
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
            
          <?php foreach ($complains as $complain) { ?>
          
          
         <?php if (!$complain["isOpened"]) { ?>
          <a href="./complain.php?id=<?php echo $complain[
            "id"
          ]; ?>"class="message message-receive">
            <div class="image-wrap">
               <img src="../public/icons/inbox.png" alt="" class="complain-icon">
            </div>
            <div class="message-detail">
              <div class="font">ID: UNT/21/<?php echo $complain[
                "admission_no"
              ]; ?>
              </div>
              <div class="label">Subject: <?php echo $complain[
                "nature"
              ]; ?></div>
              <div class="label">body: <?php echo $complain["body"]; ?>...</div>
            </div>
           
          </a>
         <?php } else { ?>
            <a href="./complain.php?id=<?php echo $complain[
              "id"
            ]; ?>" class="message opened">
            <div class="image-wrap">
              <img src="../public/icons/received.png" alt="" class="complain-icon">
            </div>
            <div class="message-detail">
              <div class="font">ID: UNT/21/<?php echo $complain[
                "admission_no"
              ]; ?></div>
              <div class="label">Subject: <?php echo $complain[
                "nature"
              ]; ?></div>
              <div class="label">body: <?php echo $complain["body"]; ?>...</div>
            </div>
          
          </a>
       
         <?php } ?>
         <?php } ?>
        </div>
      </div>
      
      
      
      <div class="child-format" id="settings">
       <div class="title-container">
         <div class="title">
           Settings 
         </div>
       </div>
      
         <div class="password-wrapper">
           <form id="form">
       
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
    
         
    //    viewsDetail[0].style.display = 'block'
      


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
  
  
   // Pagination, viewBtn, delete and Admitted
   
   // For the approved sections 
   var currentPage = 1;
   var itemsPerPage = 4;
   
   const fetchPending = async (page) => {
       try {
        const res = await fetch(`../include/candidates.php?page=${page}&items=${itemsPerPage}`);
        
        const result = await res.json();
        //alert(result)
        displayPending(result);
       // updatePaginationButtons();
       } catch(error) {
           alert(error.message)
       }
   }
   
   var admissionList = document.querySelector('.list-before-approval-before');
     var pendingFname = document.querySelector(".adlist .name");
  function displayPending(data) {
     
    //  admissionList.innerHtml = ""
      if(data.limit) {
          var noContentDiv = document.createElement("div");
    noContentDiv.classList.add("no-content");
    noContentDiv.id = "no-content";

    // Create image element
    var img = document.createElement("img");
    img.src = "../public/icons/man.png";
    img.classList.add("man");
    img.alt = "";

    // Create div for "Oops! No Data"
    var noDiv = document.createElement("div");
    noDiv.classList.add("no");
    noDiv.textContent = "Oops! No Data";

    // Create div for "End of the line! Hit 'Refresh' to see recent data or return to the beginning."
    var moreDiv = document.createElement("div");
    moreDiv.classList.add("more");
    moreDiv.textContent = "End of the line! Hit 'Refresh' to see if there's recent data or return to the beginning.";

    // Append elements to main div
    noContentDiv.appendChild(img);
    noContentDiv.appendChild(noDiv);
    noContentDiv.appendChild(moreDiv);

    // Append main div to target element (replace 'targetElementId' with your target element's ID)
    var targetElement = document.getElementById("targetElementId");
    admissionList.appendChild(noContentDiv);
    }  else {  
        data.forEach(can =>
      {
         
              
         
          
                 // Create main container for candidate
        const candidateContainer = document.createElement('div');
        candidateContainer.classList.add('candidate');

        // Create image element and set source
        const profileImage = document.createElement('img');
        profileImage.classList.add('candidate-icon');
        profileImage.src = "../public/uploads/" + can.display_image;
        candidateContainer.appendChild(profileImage);

        // Create details container
        const detailsContainer = document.createElement('div');
        detailsContainer.classList.add('candidate-details');

        // Create fullname element
        const fullname = document.createElement('div');
        fullname.classList.add('fullname');
        fullname.textContent = can.fullname;
        detailsContainer.appendChild(fullname);

        // Create email element
        const email = document.createElement('div');
        email.classList.add('email');
        email.textContent = can.email;
        detailsContainer.appendChild(email);

        // Create admission number element
        const admissionNo = document.createElement('div');
        admissionNo.classList.add('admission-no');
        admissionNo.textContent = "UNT/21/" + can.admission_no;
        detailsContainer.appendChild(admissionNo);

        // Create buttons container
        const buttonsContainer = document.createElement('div');
        buttonsContainer.classList.add('buttons');

        // Create 'View Info' button
        const viewInfoBtn = document.createElement('a');
        viewInfoBtn.classList.add('btn', 'views-btn', 'btn-1', 'pending-list');
        viewInfoBtn.textContent = 'View Info';
        viewInfoBtn.setAttribute('data-id', can.can_id);
        buttonsContainer.appendChild(viewInfoBtn);

        // Create 'Admit' button
        const admitBtn = document.createElement('a');
        admitBtn.classList.add('btn', 'btn-2');
        admitBtn.textContent = 'Admit';
        admitBtn.style.margin = "0 5px";
        buttonsContainer.appendChild(admitBtn);

        // Create 'Cancel' button
        const cancelBtn = document.createElement('a');
        cancelBtn.classList.add('btn', 'btn-3');
        cancelBtn.textContent = 'Cancel';
        buttonsContainer.appendChild(cancelBtn);

        // Append buttons container to details container
        detailsContainer.appendChild(buttonsContainer);

        // Append details container to candidate container
        candidateContainer.appendChild(detailsContainer);

        admissionList.appendChild( candidateContainer);
        
        viewInfoBtn.addEventListener("click", async () => {
            
                viewsDetail[0].style.display = 'block'
          searchInput[0].readOnly = true;
          searchInput[0].placeholder = 'Search not allowed';
          searchInput[0].style.border = '1px solid red';
          hiddenList[0].style.display = 'none'
          nextButtonWrap[0].style.display = 'none';
         
     
         let id = can.can_id
         
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
    
      
        });
        admitBtn.addEventListener("click", async () => {
            var admitCandidate = new FormData();
            admitCandidate.append("can", can.can_id);
            try {
              const res = await fetch("../include/admit_candidate.php", {
                  method: "POST",
                  body: admitCandidate
              });
              
              
              const result = await res.json();
              
              if(result.redirect) {
                  admissionList.removeChild(candidateContainer);
                 if(admissionList.children.length <= 0) {
                    window.location = "./admin.php"
                }
              } else {
                  alert("Something went wrong, try again.");
              }
            } catch(err) {
               console.log(err.message);
            }
        });
        cancelBtn.addEventListener("click", async () => {
           try {
            var cancel = new FormData();
            cancel.append("can", can.can_id);
            var res = await fetch("../include/delete_can.php", {
                method: "POST",
                body: cancel
            });
            
            var result= await res.json();
          
            if(result.redirect) {
                admissionList.removeChild(candidateContainer);
                
                if(admissionList.children.length<= 0) {
                    window.location = "./admin.php"
                }
            } else {
                alert("Something went wrong!");
            }
            
           } catch (error) {
               alert(error.message);
           }
        })
      
       });
      
  }}
   
  
  
   var admissionListPrevious = document.getElementById("previous");
   var admissionListNext = document.getElementById("next");
  
  
  admissionListPrevious.addEventListener("click", () => {
      if(currentPage > 1) {
          while(admissionList.firstElementChild) {
           admissionList.removeChild(admissionList.firstElementChild)  ; 
          }
          currentPage --
          fetchPending(currentPage);
      }
  })
  
  admissionListNext.addEventListener("click", () => {
           while(admissionList.firstElementChild) {
           admissionList.removeChild(admissionList.firstElementChild)  ; 
          }
      currentPage++
     fetchPending(currentPage);
  })
  
   fetchPending(currentPage);
  
   // Approved list fetch Api
   var currentApprovedPage = 1;
   var approvedListPerPage = 4;
   
   
  async function fetchApproved(currentApprovedPage) {
       try {
          const res = await fetch(`../include/approved_can.php?page=${currentApprovedPage}&limit=${approvedListPerPage}`); 
          const result = await res.json();
        displayApproved(result);
       } catch(error) {
         alert(error.message);
       }
   }
  
  var approvedList = document.querySelector('.app-list')
  
  function displayApproved(data) {
      if(data.limit) {
            var noContentDiv = document.createElement("div");
    noContentDiv.classList.add("no-content");
    noContentDiv.id = "no-content";

    // Create image element
    var img = document.createElement("img");
    img.src = "../public/icons/man.png";
    img.classList.add("man");
    img.alt = "";

    // Create div for "Oops! No Data"
    var noDiv = document.createElement("div");
    noDiv.classList.add("no");
    noDiv.textContent = "Oops! No Data";

    // Create div for "End of the line! Hit 'Refresh' to see recent data or return to the beginning."
    var moreDiv = document.createElement("div");
    moreDiv.classList.add("more");
    moreDiv.textContent = "End of the line! Hit 'Refresh' to see if threre's recent data or return to the beginning.";

    // Append elements to main div
    noContentDiv.appendChild(img);
    noContentDiv.appendChild(noDiv);
    noContentDiv.appendChild(moreDiv);

    // Append main div to target element (replace 'targetElementId' with your target element's ID)
    var targetElement = document.getElementById("targetElementId");
    approvedList.appendChild(noContentDiv);
      } else {
          
       data.forEach(can => {
           
               // Create main container for candidate
    const candidateContainer = document.createElement('div');
    candidateContainer.classList.add('candidate');

    // Create image container and set source
    const imageContainer = document.createElement('div');
    const profileImage = document.createElement('img');
    profileImage.classList.add('candidate-icon');
    profileImage.src = "../public/uploads/" + can.display_image;
    imageContainer.appendChild(profileImage);
    candidateContainer.appendChild(imageContainer);

    // Create details container
    const detailsContainer = document.createElement('div');
    detailsContainer.classList.add('candidate-details', 'details-2');

    // Create column 1
    const column1 = document.createElement('div');
    column1.classList.add('column-1');

    const fullname = document.createElement('div');
    fullname.classList.add('fullname');
    fullname.textContent = can.fullname;
    column1.appendChild(fullname);

    const email = document.createElement('div');
    email.classList.add('email');
    email.textContent = can.email;
    column1.appendChild(email);

    const admissionNo = document.createElement('div');
    admissionNo.classList.add('admission-no');
    admissionNo.textContent = "UNT/21/" + can.admission_no;
    column1.appendChild(admissionNo);

    detailsContainer.appendChild(column1);

    // Create column 2 with buttons
    const column2 = document.createElement('div');
    column2.classList.add('column-2');

    const buttonsContainer = document.createElement('div');
    buttonsContainer.classList.add('buttons', 'column-2');

    const viewInfoBtn = document.createElement('a');
    viewInfoBtn.classList.add('btn', 'b', 'views-btn', 'btn-1', 'approved-list');
    viewInfoBtn.textContent = 'View Info';
    viewInfoBtn.setAttribute('data-id', can.can_id);
    buttonsContainer.appendChild(viewInfoBtn);

    const cancelAdmissionBtn = document.createElement('a');
    cancelAdmissionBtn.classList.add('btn', 'b', 'btn-2');
    cancelAdmissionBtn.textContent = 'Cancel Admission';
    buttonsContainer.appendChild(cancelAdmissionBtn);

    const deleteBtn = document.createElement('a');
    deleteBtn.classList.add('btn', 'b', 'btn-3');
    deleteBtn.textContent = 'Delete';
    buttonsContainer.appendChild(deleteBtn);

    column2.appendChild(buttonsContainer);
    detailsContainer.appendChild(column2);
    candidateContainer.appendChild(detailsContainer);

    approvedList.appendChild( candidateContainer);
    
    viewInfoBtn.addEventListener('click', async () => {
          viewsDetail[1].style.display = 'block'
          searchInput[1].readOnly = true;
          searchInput[1].placeholder = 'Search not allowed';
          searchInput[1].style.border = '1px solid red';
          hiddenList[1].style.display = 'none'
          nextButtonWrap[1].style.display = 'none';
          
          let id = can.can_id;
         
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
    });
    
    cancelAdmissionBtn.addEventListener("click", async() => {
        try {
            var cancel = new FormData();
            cancel.append("can", can.can_id);
            const res = await fetch("../include/cancel_admit.php", {
                method: "POST",
                body: cancel
            });
            
            const result = await res.json();
            
            if(result.redirect) {
                approvedList.removeChild(candidateContainer);
                if(approvedList.children.length <= 0) {
                    window.location = "./admin.php"
                }
            } else {
                alert("Something went wrong, try again.")
            }
        } catch(error) {
            
        }
    }) ;         
    deleteBtn.addEventListener("click", async() => {
        try {
            var deleteCan = new FormData();
            deleteCan.append("can", can.can_id);
            const res = await fetch("../include/delete_can.php", {
                method: "POST",
                body: deleteCan
            });
            
            const result = await res.json();
            
            if(result.redirect) {
                approvedList.removeChild(candidateContainer);
                 if(approvedList.children.length <= 0) {
                    window.location = "./admin.php"
                }
            } else {
                alert("Something went wrong, try again.")
            }
        } catch(error) {
            alert(error.message)
        }
    }) ;         
        });
    
      }
  }
  
  var approvedPreviousBtn = document.getElementById("app-previous");
  var approvedNextBtn = document.getElementById("app-next");
  approvedPreviousBtn.addEventListener('click', () => {
      if(currentApprovedPage > 1) {
           while(approvedList.firstElementChild) {
        approvedList.removeChild(approvedList.firstElementChild);
    }
          currentApprovedPage--
          fetchApproved(currentApprovedPage);
      }
  });
  
  approvedNextBtn.addEventListener('click', () => {
    while(approvedList.firstElementChild) {
        approvedList.removeChild(approvedList.firstElementChild);
    }
    currentApprovedPage++
    fetchApproved(currentApprovedPage);
  });
  fetchApproved(currentApprovedPage);
  
  
  
  
  
  
  
  
  
  
  
  
  
  



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
    
    
    
     // POST  and Deleted 
    var postContainer = document.getElementById("post-content");
    var postPrevious = document.getElementById("postPrevious");
    var postNext = document.getElementById("postNext");
    var currentPostPage = 1;
    var postPerPage = 5;
    
    async function fetchPost(page) {
        try {
            const res = await fetch (`../include/get_post.php?page=${page}&limit=${postPerPage}`);
            const result = await res.json();
            displayPost(result);
        } catch(err) {
            alert(err.message);
        }
    }
    
    function displayPost(posts) {
        if(posts.limit) {
              var noContentDiv = document.createElement("div");
    noContentDiv.classList.add("no-content");
    noContentDiv.id = "no-content";

    // Create image element
    var img = document.createElement("img");
    img.src = "../public/icons/man.png";
    img.classList.add("man");
    img.alt = "";

    // Create div for "Oops! No Data"
    var noDiv = document.createElement("div");
    noDiv.classList.add("no");
    noDiv.textContent = "Oops! No Data";

    // Create div for "End of the line! Hit 'Refresh' to see recent data or return to the beginning."
    var moreDiv = document.createElement("div");
    moreDiv.classList.add("more");
    moreDiv.textContent = "End of the line! Hit 'Refresh' to see if threre's recent data or return to the beginning.";

    // Append elements to main div
    noContentDiv.appendChild(img);
    noContentDiv.appendChild(noDiv);
    noContentDiv.appendChild(moreDiv);

    // Append main div to target element (replace 'targetElementId' with your target element's ID)
    var targetElement = document.getElementById("targetElementId");
    postContainer.appendChild(noContentDiv); 
        } else {
            posts.forEach(post => {
               const postDiv = document.createElement("div");
  postDiv.classList.add("post");

  const image = document.createElement("img");
  image.src = "../public/uploads/" + post.feature_img;
  image.alt = "";
  image.classList.add("post-image");
  postDiv.appendChild(image);

  const titleDateDiv = document.createElement("div");
  titleDateDiv.style.fontSize = "13px"
  titleDateDiv.classList.add("title-date");

  const titleDiv = document.createElement("div");
  titleDiv.classList.add("title");
  titleDiv.textContent = decodeHTML(post.title);
  titleDateDiv.appendChild(titleDiv);

  // Anchor tag for view
  const viewAnchor = document.createElement("a");
  viewAnchor.href = "./post.php?id=" + post.post_id; // Adjust the href according to your routing
  viewAnchor.textContent = "View";
  viewAnchor.style.color = "blue";
  viewAnchor.style.fontSize = "12px";
  titleDiv.style.fontSize = "14px";
  titleDiv.style.width = "350px";
  viewAnchor.style.width = "40px";
  image.style.objectFit = "cover";
  titleDateDiv.appendChild(viewAnchor);

  const dateDiv = document.createElement("div");
  dateDiv.classList.add("date");
  dateDiv.textContent = post.createdAt;
  titleDateDiv.appendChild(dateDiv);

  postDiv.appendChild(titleDateDiv);

  const deleteWrapDiv = document.createElement("div");
  deleteWrapDiv.classList.add("delete-wrap");

  const deleteDiv = document.createElement("div");
  deleteDiv.classList.add("delete");

  const deleteText = document.createElement("div");
  deleteText.textContent = "Delete";
  deleteDiv.appendChild(deleteText);

  deleteText.style.fontSize = "10px"
  const deleteImage = document.createElement("img");
  deleteImage.src = "../public/icons/delete (1).png";
  deleteImage.alt = "";
  deleteImage.classList.add("icons-1");
  deleteDiv.appendChild(deleteImage);

  deleteWrapDiv.appendChild(deleteDiv);
  postDiv.appendChild(deleteWrapDiv);

  postContainer.appendChild(postDiv);
  
  deleteWrapDiv.addEventListener("click", async () => {
      let deletePost = new FormData();
      deletePost.append("post_id", post.post_id);
      
      const res = await fetch("../include/delete_post.php", {
          method: "POST",
          body: deletePost
      });
      
      const result = await res.json();
      
      if(result.redirect) {
          postContainer.removeChild(postDiv);
      }
  });
  
                });
        }
    }
    
    function decodeHTML(html) {
  var txt = document.createElement("textarea");
  txt.innerHTML = html;
  return txt.value;
}
    
    
    postPrevious.addEventListener('click', () => {
        if(currentPostPage > 1) {
            while(postContainer.firstElementChild) {
                postContainer.removeChild(postContainer.firstElementChild);
            }
            currentPostPage--
            fetchPost(currentPostPage);
        }
    });
    
    postNext.addEventListener('click',() => {
        while(postContainer.firstElementChild) {
                postContainer.removeChild(postContainer.firstElementChild);
            }
        currentPostPage++
        fetchPost(currentPostPage);
    })    
    
    fetchPost(currentPostPage);
    
    
    



    // 
    let refreshLoader = document.querySelectorAll('.refresh-loader')
    let refreshBtn = document.querySelectorAll('.refresh')

    refreshBtn.forEach(btn => {
      btn.addEventListener('click', () => {
        refreshLoader.forEach(loader => loader.classList.add('active-spinner'));
        
        if(btn.classList.contains("approved")) {
          setTimeout(() => {
        while(approvedList.firstElementChild) {
        approvedList.removeChild(approvedList.firstElementChild);
        }
         currentApprovedPage = 1;
         fetchApproved(currentApprovedPage);
          refreshLoader.forEach(loader => loader.classList.remove('active-spinner'));
        }, 2000); 
       
        } 
        
          if(btn.classList.contains("pending")) {
        setTimeout(() => {
            
          refreshLoader.forEach(loader => loader.classList.remove('active-spinner'));
         while(admissionList.firstElementChild) {
        admissionList.removeChild(admissionList.firstElementChild);
        }
        currentPage = 1;
        fetchPending(currentPage);
        }, 2000)
      }
      
        if(btn.classList.contains("post-refresh")) {
        setTimeout(() => {
            
          refreshLoader.forEach(loader => loader.classList.remove('active-spinner'));
          
            while(postContainer.firstElementChild) {
                postContainer.removeChild(postContainer.firstElementChild);
            }
            currentPostPage = 1;
            fetchPost(currentPostPage);
        }, 2000)
        }
          
      })
    })
    
    
    
    /*
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
    
    */
    
    
    
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
    currentPassword.addEventListener('blur', async function ()  {

      var passwordData = new FormData();
      passwordData.append("current", this.value);
    try {
      const res = await fetch('../include/admin_current_password.php', {
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
          
          const res = await fetch('../include/admin_change_password.php', {
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