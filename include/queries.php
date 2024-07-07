<?php

define(
  "REGISTER_CAN",
  "
 INSERT INTO candidate_personal_info
 (fullname, email, dob, phone_no, admission_type, admission_class, display_image, pass, createdAt) 
 VALUES (?,?,?,?,?,?,?,?,?);
"
);

define(
  "FINDEMAIL",
  "SELECT can_id FROM candidate_personal_info WHERE email = ?;"
);

define("FINDWITHID", "SELECT * FROM candidate_personal_info WHERE can_id = ?;");

define(
  "CONTACTINFO",
  "
INSERT INTO candidate_contact_details
(nationality, state, localG, address, 
 previous_school, year_of_passing, guardian,
 guardian_relationship, guardian_contact, can_id
    ) VALUES (
    ?,?,?,?,?,?,?,?,?,?
    );
    "
);

define(
  "ADDITIONALINFO",
  "INSERT INTO candidate_additional_info(verify_digit, can_id, expiredAt) 
    VALUES (?,?,?);"
);

define(
  "CANDIDATES",

  "
SELECT DISTINCT
    p.can_id,
    p.fullname,
    p.email,
    p.dob,
    p.admission_no,
    p.admission_type,
    p.admission_class,
    p.display_image,
    p.phone_no,
    c.nationality,
    c.state,
    c.localG,
    c.address,
    c.previous_school,
    c.year_of_passing,
    c.guardian,
    c.guardian_relationship,
    c.guardian_contact,
    a.school_fee,
    a.isVerify,
    a.isPaid,
    a.isApproved,
    a.isClick,
    a.isAccept,
    a.isDeclined,
    a.decision_message
    
FROM
    candidate_personal_info p
INNER JOIN
    candidate_contact_details c ON p.can_id = c.can_id
INNER JOIN
    candidate_additional_info a ON p.can_id = a.can_id
  ORDER BY p.admission_no DESC
"
);

define(
  "CANDIDATE",
  "SELECT 
    p.can_id,
    p.fullname,
    p.email,
    p.dob,
    p.admission_no,
    p.admission_type,
    p.admission_class,
    p.display_image,
    p.phone_no,
    c.nationality,
    c.state,
    c.localG,
    c.address,
    c.previous_school,
    c.year_of_passing,
    c.guardian,
    c.guardian_relationship,
    c.guardian_contact,
    a.school_fee,
    a.isVerify,
    a.isPaid,
    a.isApproved,
    a.isClick,
    a.isAccept,
    a.isDeclined,
    a.decision_message,
    a.verify_digit,
    a.expiredAt
FROM
    candidate_personal_info p
INNER JOIN
    candidate_contact_details c ON p.can_id = c.can_id
INNER JOIN
    candidate_additional_info a ON p.can_id = a.can_id
WHERE 
    a.can_id = ?;
"
);

define(
  "FINDWITHADMISSION",
  "SELECT * FROM candidate_personal_info WHERE admission_no = ?;"
);

define(
  "FINDWITHEMAIL",
  "SELECT * FROM candidate_personal_info WHERE email = ?;"
);

define(
  "FINDUSERADS",
  "SELECT * FROM candidate_additional_info WHERE can_id = ?"
);

define(
  "PAID",
  "UPDATE candidate_additional_info SET isPaid = 1
WHERE can_id = ?;"
);

define(
  "ACCEPTED",
  "
UPDATE candidate_additional_info SET isAccept = 1, isClick = 1, decision_message = 'We are pleased to announce that your admission request has been accepted! Your personal qualities have impressed us, and we are confident that you will make a positive impact in the Unity Girls College, Birnin Kebbi. Your application has been reviewed.'
WHERE can_id = ?;
"
);

define(
  "DECLINED",
  "UPDATE candidate_additional_info SET isClick = 1, isDeclined = 1, decision_message = 'We understand that choosing the right school is an important decision, and we respect your choice. If you have any questions or need further assistance, please don\'t hesitate to reach out to our admissions team. We wish you all the best in your academic journey and hope you find the perfect fit for your educational goals.' 
WHERE can_id = ?;
"
);

define(
  "COMPLAIN",
  "INSERT INTO complain (nature , body, can_id, followUp, createdAt) VALUES
(?,?,?,?,?)
"
);

define(
  "UPDATEPASSWORD",
  "UPDATE candidate_personal_info SET pass = ? WHERE can_id = ?;"
);

define(
  "POST",
  "
INSERT INTO Posts (title, body, feature_img, admin_id, createdAt)
VALUES(?,?,?,?,?);
"
);

define(
  "CANDIDATESS",

  "
SELECT DISTINCT
    p.can_id,
    p.fullname,
    p.email,
    p.display_image,
    p.admission_no,
    a.isApproved
  
 
   
    
FROM
    candidate_personal_info p
INNER JOIN
    candidate_contact_details c ON p.can_id = c.can_id
INNER JOIN
    candidate_additional_info a ON p.can_id = a.can_id
  WHERE isApproved = 0 ORDER BY p.admission_no DESC LIMIT :offset, :itemsPerPage;
"
);

define(
  "APPROVED",

  "
SELECT DISTINCT
    p.can_id,
    p.fullname,
    p.email,
    p.display_image,
    p.admission_no,
    a.isApproved
  
 
   
    
FROM
    candidate_personal_info p
INNER JOIN
    candidate_contact_details c ON p.can_id = c.can_id
INNER JOIN
    candidate_additional_info a ON p.can_id = a.can_id
  WHERE  isApproved = 1 LIMIT :offset, :itemsPerPage;
"
);

define(
  "ADMIT",
  "UPDATE candidate_additional_info SET
 isApproved = 1 WHERE can_id = ?
"
);

define(
  "CANCELADMIT",
  "UPDATE candidate_additional_info SET
 isApproved = 0, isAccept = 0, isClick = 0, isDeclined = 0 WHERE can_id = ?
"
);

define(
  "DELETECAN",
  "
DELETE FROM candidate_personal_info WHERE
can_id = ?
"
);

define(
  "DELETEPOST",
  "
DELETE FROM Posts WHERE
post_id = ?
"
);

define(
  "POSTS",
  "SELECT * FROM Posts ORDER BY createdAt DESC LIMIT :offset, :postPerPage;
"
);

define("FINDWITHADMINID", "SELECT * FROM Admin WHERE admin_id = ?;");

define("UPDATEADMINPASSWORD", "UPDATE Admin SET pass = ?  WHERE admin_id = ?;");

define(
  "COMPLAINS",
  "SELECT p.admission_no, c.nature, c.body, c.createdAt, c.isOpened, c.id FROM candidate_personal_info p INNER JOIN complain c ON p.can_id = c.can_id ORDER BY c.createdAt DESC;"
);
define(
  "EMAIL",

  "SELECT * FROM Admin WHERE email = ?"
);

define(
  "ADMINBYID",

  "SELECT * FROM Admin WHERE admin_id = ?"
);

define(
  "INSERTADMIN",
  "
INSERT INTO Admin(username, email, pass) 
VALUES(?,?,?);
"
);

define(
  "ADMINPROFILE",
  "UPDATE Admin SET profile_display = ? WHERE admin_id = ?"
);

define(
  "CANPROFILE",
  "UPDATE candidate_personal_info SET display_image = ? WHERE can_id = ?"
);

define(
  "VERIFY",
  "UPDATE candidate_additional_info SET isVerify = ? WHERE can_id = ?;"
);
define(
  "UPDATEADDITIONALINFO",
  "UPDATE candidate_additional_info SET verify_digit = ?, expiredAt = ? WHERE can_id = ?"
);

define(
  "FORGOT",
  "SELECT 
    p.can_id,
    p.fullname,
    p.email,
    p.dob,
    p.admission_no,
    p.admission_type,
    p.admission_class,
    p.display_image,
    p.phone_no,
    c.nationality,
    c.state,
    c.localG,
    c.address,
    c.previous_school,
    c.year_of_passing,
    c.guardian,
    c.guardian_relationship,
    c.guardian_contact,
    a.school_fee,
    a.isVerify,
    a.isPaid,
    a.isApproved,
    a.isClick,
    a.isAccept,
    a.isDeclined,
    a.decision_message,
    a.verify_digit,
    a.expiredAt
FROM
    candidate_personal_info p
INNER JOIN
    candidate_contact_details c ON p.can_id = c.can_id
INNER JOIN
    candidate_additional_info a ON p.can_id = a.can_id
WHERE 
    p.email = ?;
"
);

