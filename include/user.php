<?php

class User
{
  private $fullname;
  private $email;
  private $dob;
  private $nationality;
  private $state;
  private $localG;
  private $address;
  private $phone_no;
  private $previous_school;
  private $year_of_passing;
  private $admission_type;
  private $admission_class;
  private $guardian;
  private $guardian_relationship; // Corrected spelling here
  private $guardian_contact;
  private $display_image;
  private $password;

  private $errors = [];

  public function __construct(array $data)
  {
    $this->fullname = isset($data["fullname"]) ? trim($data["fullname"]) : "";
    $this->email = isset($data["email"]) ? trim($data["email"]) : "";
    $this->dob = isset($data["dob"]) ? trim($data["dob"]) : "";
    $this->nationality = isset($data["nationality"])
      ? trim($data["nationality"])
      : "";
    $this->state = isset($data["state"]) ? trim($data["state"]) : "";
    $this->localG = isset($data["localG"]) ? trim($data["localG"]) : "";
    $this->address = isset($data["address"]) ? trim($data["address"]) : "";
    $this->phone_no = isset($data["phone_no"]) ? trim($data["phone_no"]) : "";
    $this->previous_school = isset($data["previous_school"])
      ? trim($data["previous_school"])
      : "";
    $this->year_of_passing = isset($data["year_of_passing"])
      ? trim($data["year_of_passing"])
      : "";
    $this->admission_type = isset($data["admission_type"])
      ? trim($data["admission_type"])
      : "";
    $this->admission_class = isset($data["admission_class"])
      ? trim($data["admission_class"])
      : "";
    $this->guardian = isset($data["guardian"]) ? trim($data["guardian"]) : "";
    $this->guardian_relationship = isset($data["guardian_relationship"])
      ? trim($data["guardian_relationship"])
      : "";
    $this->guardian_contact = isset($data["guardian_contact"])
      ? trim($data["guardian_contact"])
      : "";
    $this->display_image = isset($data["display_image"])
      ? trim($data["display_image"])
      : "";
    $this->password = isset($data["password"]) ? trim($data["password"]) : "";
  }

  public function validateData(): void
  {
    // 1.  Full name validator
    if (empty($this->fullname)) {
      $this->errors["fullname"] = "Full name is required.";
    } else {
      $pattern = "/^[a-zA-Z]\w+(\s[a-zA-Z]\w+)+$/";

      if (!preg_match($pattern, $this->fullname)) {
        $this->errors["fullname"] = "Please provide your full name";
      }
    }

    //2.  Email address validator
    if (empty($this->email)) {
      $this->errors["email"] = "Email address is required.";
    } else {
      $pattern = "/^[a-zA-Z]w+\s[a-zA-Z]w+$/";
      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->errors["email"] = "Please provide your correct email";
      }
    }

    //3. Date of birth validator
    if (empty($this->dob)) {
      $this->errors["dob"] = "Date of birth is required.";
    } else {
      $pattern = "/^\d{4}\-\d{2}\-\d{2}$/";
      if (!preg_match($pattern, $this->dob)) {
        $this->errors["dob"] = "Please provide your correct date format";
      }
    }

    //4.  Nationality validator
    if (empty($this->nationality)) {
      $this->errors["nationality"] = "Nationality is required.";
    }

    //6.  State of origin validator
    if (empty($this->state)) {
      $this->errors["state"] = "State is required.";
    }

    //7. Local government validator
    if (empty($this->localG)) {
      $this->errors["localG"] = "Local government is required.";
    }

    //8. Hone address validator
    if (empty($this->address)) {
      $this->errors["address"] = "Home address is required.";
    }

    //9.  Phone number validator
    if (empty($this->phone_no)) {
      $this->errors["phone_no"] = "Phone number is required.";
    } else {
      if (!is_numeric($this->phone_no)) {
        $this->errors["phone_no"] = "Invalid phone number";
      }
    }

    //10. Previous school validator
    if (empty($this->previous_school)) {
      $this->errors["previous_school"] = "Previous school is required.";
    }

    //11. Year of passing validator
    if (empty($this->year_of_passing)) {
      $this->errors["year_of_passing"] = "Year of passing is required.";
    } else {
      if (!is_numeric($this->year_of_passing)) {
        $this->errors["year_of_passing"] = "Invalid year";
      }
    }

    //12. Admission type validator
    if (empty($this->admission_type)) {
      $this->errors["admission_type"] = "Admission type is required.";
    }

    //13.  Admission class validator
    if (empty($this->admission_class)) {
      $this->errors["admission_class"] = "Admission class is required.";
    }

    // 14.  Parent/Guardian validator
    if (empty($this->guardian)) {
      $this->errors["guardian"] = "Guardian/parent is required.";
    }

    // 15. Parent/Guardian validator
    if (empty($this->guardian_relationship)) {
      $this->errors["guardian_relationship"] =
        "Relationship to the Candidate is required .";
    }

    // 16. Parent / Guardian validator
    if (empty($this->guardian_contact)) {
      $this->errors["guardian_contact"] =
        "Parent/guardian phone number is required.";
    } else {
      if (!is_numeric($this->guardian_contact)) {
        $this->errors["guardian_contact"] = "Invalid phone number";
      }
    }

    // 17. Password validator
    if (empty($this->password)) {
      $this->errors["password"] = "Password is required.";
    }
    /*
    if (empty($this->display_image)) {
      $this->errors["display_image"] = "Please upload your profile image.";
    } */
  }

  public function uniqueImageName(array $file): void
  {
    if (isset($file["image"])) {
      $basedName = $file["image"]["name"];
      $fileExtension = pathinfo($basedName, PATHINFO_EXTENSION);
      $tmp = $file["image"]["tmp_name"];
      $current_time = time();
      $randomNum = mt_rand(1000, 9999);
      $uniqueName =
        "Unity_img_" . $current_time . "_" . $randomNum . "." . $fileExtension;
      $destination = "../public/uploads/" . $uniqueName;

      $imageExtensions = [
        "jpeg",
        "jpg",
        "png",
        "gif",
        "bmp",
        "tiff",
        "tif",
        "svg",
        "raw",
        "webp",
      ];
      if (in_array($fileExtension, $imageExtensions)) {
        if ($file["image"]["size"] > 1024 * 1024 * 2) {
          $this->errors["display_image"] = "Image is too large!";
        } else {
          move_uploaded_file($tmp, $destination);
          $this->display_image = $uniqueName;
        }
      } else {
        $this->errors["display_image"] = "Invalid file, image is required.";
      }
    } else {
      $this->errors["display_image"] =
        "Please select your profile display image";
    }
  }

  public function getError(): array
  {
    return $this->errors;
  }

  public function getData(): array
  {
    return [
      "fullname" => $this->fullname,
      "email" => $this->email,
      "dob" => $this->dob,
      "nationality" => $this->nationality,
      "state" => $this->state,
      "localG" => $this->localG,
      "address" => $this->address,
      "phone_no" => $this->phone_no,
      "previous_school" => $this->previous_school,
      "year_of_passing" => $this->year_of_passing,
      "admission_type" => $this->admission_type,
      "admission_class" => $this->admission_class,
      "guardian" => $this->guardian,
      "guardian_relationship" => $this->guardian_relationship,
      "guardian_contact" => $this->guardian_contact,
      "display_image" => $this->display_image,
      "pass" => password_hash($this->password, PASSWORD_DEFAULT),
    ];
  }
}

class Login
{
  private $emailOrAdmissionId;
  private $password;
  private $errors = [];

  public function __construct(string $email, string $password)
  {
    $this->emailOrAdmissionId = isset($email)
      ? htmlspecialchars(trim($email))
      : "";

    $this->password = isset($password) ? htmlspecialchars(trim($password)) : "";
  }

  public function validateData(): void
  {
    if (empty($this->emailOrAdmissionId)) {
      $this->errors["email"] = "Email or admission is required ";
    }
    if (empty($this->password)) {
      $this->errors["password"] = "Password is required";
    }
  }

  public function getErrors(): array
  {
    return $this->errors;
  }

  public function getLoginDetails(): array
  {
    return [
      "email" => strtolower($this->emailOrAdmissionId),
      "password" => $this->password,
    ];
  }
}

class Complain
{
  private $nature;
  private $body;
  private $followUp;
  private $errors = [];

  public function __construct(array $data)
  {
    $this->nature = isset($data["nature"]) ? trim($data["nature"]) : "";
    $this->body = isset($data["body"]) ? trim($data["body"]) : "";
    $this->followUp = isset($data["followUp"]) ? trim($data["followUp"]) : "";
  }
  public function validatePost()
  {
    if (empty($this->nature)) {
      $this->errors["nature"] = "Nature of the complaint is required.";
    }
    if (empty($this->body)) {
      $this->errors["body"] = "Body of the complaint is required.";
    }
    if (empty($this->followUp)) {
      $this->errors["followUp"] = "Follow up is required.";
    }
  }

  public function getData(): array
  {
    return [
      "nature" => htmlspecialchars($this->nature),
      "body" => htmlspecialchars($this->body),
      "followUp" => htmlspecialchars($this->followUp),
    ];
  }

  public function getError(): array
  {
    return $this->errors;
  }
}

class Post
{
  private $title;
  private $body;
  private $feature_image;
  private $errors = [];

  public function __construct(array $data)
  {
    $this->title = isset($data["title"])
      ? htmlspecialchars($data["title"])
      : "";
    $this->body = isset($data["body"])
      ? htmlspecialchars(trim($data["body"]))
      : "";
  }

  public function uniqueImageName(array $file): void
  {
    if (isset($file["feature_image"])) {
      $basedName = $file["feature_image"]["name"];
      $fileExtension = pathinfo($basedName, PATHINFO_EXTENSION);
      $tmp = $file["feature_image"]["tmp_name"];
      $current_time = time();
      $randomNum = mt_rand(1000, 9999);
      $uniqueName =
        "Unity_post_img_" .
        $current_time .
        "_" .
        $randomNum .
        "." .
        $fileExtension;
      $destination = "../public/uploads/" . $uniqueName;

      $imageExtensions = [
        "jpeg",
        "jpg",
        "png",
        "gif",
        "bmp",
        "tiff",
        "tif",
        "svg",
        "raw",
        "webp",
      ];
      if (in_array($fileExtension, $imageExtensions)) {
        if ($file["feature_image"]["size"] > 1024 * 1024 * 2) {
          $this->errors["feature_image"] = "Image is too large!";
        } else {
          move_uploaded_file($tmp, $destination);
          $this->feature_image = $uniqueName;
        }
      } else {
        $this->errors["feature_image"] = "Invalid file, image is required.";
      }
    } else {
      $this->errors["feature_image"] =
        "Please select an image to feature in your post";
    }
  }

  public function validatePost()
  {
    if (empty($this->title)) {
      $this->errors["title"] = "Please provide a title for your post";
    }
    if (empty($this->body)) {
      $this->errors["body"] =
        "Your message body cannot be empty. Please enter some content.";
    }
  }

  public function getErrors(): array
  {
    return $this->errors;
  }
  public function getPost(): array
  {
    return [
      "title" => $this->title,
      "body" => $this->body,
      "feature_image" => $this->feature_image,
    ];
  }
}

class Admin
{
  private $username;
  private $email;
  private $password;
  private $display_image;

  private $errors = [];

  public function __construct(array $data)
  {
    $this->username = isset($data["username"]) ? trim($data["username"]) : "";
    $this->email = isset($data["email"]) ? trim($data["email"]) : "";
    $this->password = isset($data["password"]) ? trim($data["password"]) : "";
  }

  public function validateData(): void
  {
    // Username validator
    if (empty($this->username)) {
      $this->errors["username"] = "Username cannot be left blank.";
    } else {
      $pattern = "/^[a-zA-Z]\w+$/";

      if (!preg_match($pattern, $this->username)) {
        $this->errors["username"] = "Username should be free of any spaces.";
      }
    }

    // Email address validator
    if (empty($this->email)) {
      $this->errors["email"] = "Email cannot be left blank.";
    } else {
      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->errors["email"] = "Please provide your correct email";
      }
    }

    // Password validator
    if (empty($this->password)) {
      $this->errors["password"] = "Password is required.";
    }
  }

  public function getError(): array
  {
    return $this->errors;
  }

  public function getData(): array
  {
    return [
      "username" => $this->username,
      "email" => $this->email,
      "password" => password_hash($this->password, PASSWORD_DEFAULT),
      "display_image" => $this->display_image,
    ];
  }

  public function uniqueImageName(array $file): void
  {
    if (isset($file["image"])) {
      $basedName = $file["image"]["name"];
      $fileExtension = pathinfo($basedName, PATHINFO_EXTENSION);
      $tmp = $file["image"]["tmp_name"];
      $current_time = time();
      $randomNum = mt_rand(1000, 9999);
      $uniqueName =
        "Unity_Admin_" .
        $current_time .
        "_" .
        $randomNum .
        "." .
        $fileExtension;
      $destination = "../public/uploads/" . $uniqueName;

      $imageExtensions = [
        "jpeg",
        "jpg",
        "png",
        "gif",
        "bmp",
        "tiff",
        "tif",
        "svg",
        "raw",
        "webp",
      ];
      if (in_array($fileExtension, $imageExtensions)) {
        if ($file["image"]["size"] > 1024 * 1024 * 2) {
          $this->errors["display_image"] = "Image is too large!";
        } else {
          move_uploaded_file($tmp, $destination);
          $this->display_image = $uniqueName;
        }
      } else {
        $this->errors["display_image"] = "Invalid file, image is required.";
      }
    } else {
      $this->errors["display_image"] =
        "Please select your profile display image";
    }
  }
}
