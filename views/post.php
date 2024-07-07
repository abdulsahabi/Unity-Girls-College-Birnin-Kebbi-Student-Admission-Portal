<?php
include_once "../include/db.php";

if (isset($_GET["id"])) {
  $id = htmlspecialchars($_GET["id"]);

  $getPostSql = "SELECT P.post_id, A.username, P.title, P.body, P.createdAt FROM Admin A
INNER JOIN Posts P 
ON A.admin_id = 
P.admin_id WHERE P.post_id = ?;";
  $statement = $pdo->prepare($getPostSql);
  $statement->execute([$id]);
  $row = $statement->fetch();

  $date = new DateTime($row["createdAt"]);
  $view = 1;

  $setView = "UPDATE Posts SET total_views = total_views + ? WHERE post_id = ?";

  $stmt = $pdo->prepare($setView);
  $stmt->execute([$view, $id]);
}
?>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
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
}

p {
  color: grey;
  text-align: left;
}
        
   .post-body {
     margin: 0;
     padding: 0;
     background: #FAFAFA;
     font-family: sans-serif;
   }
    .post-header {
      height: 60px;
      width: 100%;
      position: fixed;
      background: white;
      border-bottom: 1px solid var(--primary_color);
      top: 0;
      left: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .index-logo {
      max-width: 600px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 10px auto;
      font-family:  Poppin_bold;
      font-size: 22px;
    }
    
    .index-title span {
      color: green;
    }
    
    .index-title {
      font-size: 26px;
    }
    
    
    .main-post {
      max-width: 800px;
      margin: 100px auto;
      padding: 30px;
    }
    .post-article  {
      display: flex;
      flex-direction: column;
    }
    .post-title {
      font-size: 40px;
      border-left: 2px solid black;
      padding: 0 10px;
    }
    
    .post-update {
      background: #EEEEEE;
      color: black;
      margin: 10px 0;
      width: 300px;
      padding: 3px 5px;
    }
    
    .dir {
      font-size: 20px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      font-family: Poppin_bold;
    }
    
    .dir img {
      margin-right: 10px;
    }
    
    .post-wrapper {
      font-size: 20px;
      
      margin: 20px 10px;
    }
    
    .post-body .post-headline {
      font-size: 28px;
      font-family: PoppinBold;
    }
    
    index-footer {
          position: relative;
          bottom: 0;
          Left: 0;
          right: 0;
          width: 100%;
          height: 100px;
          border-top: 1px solid grey;
          font-family: Poppin;
        }
        
        .copyright {
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100%;
          margin: 30px 0;
          text-align: center;
        }
        
        a {
          color: var(--font-main-color);
        }
        
        .icon {
          width: 20px;
        }
        
        p {
            font-size: 15px;
        }
  </style>
</head>

<body class="privacy-body">
  
  

  
  
  <main class="main-post">
    <div class="post-article">
      <div class="post-title">
        <?php echo htmlspecialchars_decode($row["title"]); ?>
      </div>
      <div class="post-update">
       Published on: <?php echo $date->format("d M, Y"); ?>
      </div>
      <div class="dir">
        <img src="../public/icons/user.png" alt="" class="icon">
        <div>
         Author:   <?php echo htmlspecialchars_decode($row["username"]); ?>
        </div>
      </div>
      
      <div class="post-wrapper">
       <p>
             <?php echo htmlspecialchars_decode($row["body"]); ?>
       </p>
      </div>
    </div>
  </main>
  
   <footer class="index-footer">
   <div class="copyright">&copy; 2024 Sumayya Garba Diggie</div>
 </footer>
  </body>

</html>
