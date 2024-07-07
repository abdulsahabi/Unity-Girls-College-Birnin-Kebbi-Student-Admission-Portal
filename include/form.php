<?php
include "./session_config.php";
include "./user.php";
include "./db.php";
include "./queries.php";

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = new User($_POST);
  $user->validateData();

  $errors = $user->getError();
  $data = $user->getData();

  if (!array_filter($errors)) {
    // Check if the email is not exists
    $email = $data["email"];
    $checkEmail = $pdo->prepare(FINDEMAIL);
    $checkEmail->execute([$email]);
    $isEmailExist = $checkEmail->fetch();

    if (!$isEmailExist) {
      // To verify if the user has uploaded a profile image
      $user->uniqueImageName($_FILES);
      $image = $user->getData();
      $checkError = $user->getError();

      if (!array_filter($checkError)) {
        $fullname = $data["fullname"];
        $email = $data["email"];
        $dob = $data["dob"];
        $admission_type = $data["admission_type"];
        $admission_class = $data["admission_class"];
        $display_image = $image["display_image"];
        $password = $data["pass"];
        $phone_no = $data["phone_no"];

        $register_can = $pdo->prepare(REGISTER_CAN);
        $register_can->execute([
          $fullname,
          $email,
          $dob,
          $phone_no,
          $admission_type,
          $admission_class,
          $display_image,
          $password,
          date("Y-m-d h:i:s"),
        ]);

        if ($register_can->rowCount() > 0) {
          // FIND EMAIL AGAIN TO INSERT ADDITIONAL DATA
          $getCreated = $pdo->prepare(FINDEMAIL);
          $getCreated->execute([$email]);
          $result = $getCreated->fetch();
          $can_id = $result["can_id"];

          if ($getCreated->rowCount() > 0) {
            $nationality = $data["nationality"];
            $state = $data["state"];
            $localG = $data["localG"];
            $address = $data["address"];
            $previous_school = $data["previous_school"];
            $year_of_passing = $data["year_of_passing"];
            $guardian = $data["guardian"];
            $guardian_relationship = $data["guardian_relationship"];
            $guardian_contact = $data["guardian_contact"];

            $insertContact = $pdo->prepare(CONTACTINFO);
            $insertContact->execute([
              $nationality,
              $state,
              $localG,
              $address,
              $previous_school,
              $year_of_passing,
              $guardian,
              $guardian_relationship,
              $guardian_contact,
              $can_id,
            ]);

            if ($insertContact->rowCount() > 0) {
              $additionalInfo = $pdo->prepare(ADDITIONALINFO);
              $verifyCode = mt_rand(666666, 999999);

              $additionalInfo->execute([
                $verifyCode,
                $can_id,
                date("Y-m-d H:i:s"),
              ]);
              $fname = explode(" ", $fullname);
              $username = array_pop($fname);
              if ($additionalInfo->rowCount() > 0) {
                ob_start();
                include "./email.php";
                $htmlContent = ob_get_clean();

                include "./email_config.php";

                try {
                  $mail->isHTML(true);
                  $mail->Body = $htmlContent;
                  $mail->send();

                  start_session();
                  $_SESSION["canLastActivity"] = time();
                  $_SESSION["isCandidateLogged"] = true;
                  $_SESSION["can_id"] = $can_id;

                  header("Content-Type: application/json");
                  echo json_encode(["redirect" => "/"]);

                  //   header("Location: ../verify.php");
                  return;
                } catch (Exception $e) {
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
              }
            }
          }
        }
      } else {
        header("Content-Type: application/json");
        echo json_encode(["error" => $checkError]);
        return;
      }
    } else {
      header("Content-Type: application/json");
      echo json_encode(["email" => "Exist"]);
      return;
    }
  } else {
    header("Content-Type: application/json");
    // echo json_encode(["error" => $errors]);
    print_r($errors);
    return;
  }
} else {
  http_response_code(405); // Method Not Allowed
  echo json_encode(["error" => "Method Not Allowed"]);
}
