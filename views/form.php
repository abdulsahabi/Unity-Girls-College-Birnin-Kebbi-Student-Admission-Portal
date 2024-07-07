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
      font-family: Poppin;
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
      height: 650px;
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
      top: 13px;
      left: 12px;
      font-size: 14px;
      font-weight: 400;
      color: var(--font_main_color);
      transition: 0.2s;
    }

    input {
      width: 300px;
      padding: 13px;
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
      font-size: 14px;
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

    ul {
      max-height: 200px;
      min-height: 100px;
      width: 300px;
      padding: 12px;
      display: none;
      align-items: flex-start;
      justify-content: flex-start;
      flex-direction: column;
      background: var(--main_bg_color);
      border-radius: 10px;
      overflow-y: auto;
      box-shadow: 0 0 7px #D0D0D0;
      padding: 15px 8px;
      position: absolute;
      left: 8px;
      top: 46px;
      z-index: 1;
      transition: 0.5s;
    }

    .ul-active {
      display: flex;
    }

    ul li {
      list-style: none;
      font-size: 15px;
      font-family: Poppin;
      font-weight: 200;
      padding: 8px 5px;
      width: 260px;
      padding: 10px 10px;
      border-radius: 12px;
      transition: 0.2s;

    }

    ul::-webkit-scrollbar {
      width: 10px;
    }

    ul::-webkit-scrollbar-thumb {
      background: grey;
      border-radius: 20px;
    }


    li:hover {
      background: var(--primary_color);
      color: white;
      font-family: Roboto;
    }

    .icon {
      width: 12px;
      transition: 0.1s;
    }

    .rotate-icon {
      transform: rotate(60deg);
    }

    .btn {
      width: 100px;
      padding: 12px;
      font-family: Poppin;
      font-size: 16px;
      background: var(--primary_color);
      color: white;
      text-align: center;
      cursor: pointer;
      border-radius: 4px;
      transition: 0.3s;
    }

    .btn-wrapper {
      margin-top: 10px;
      display: flex;
      align-items: flex-end;

      justify-content: space-between;
    }

    .sign-in {
      width: 300px;
      text-align: center;
      margin-top: 70px;
      padding: 15px;
      position: relative;
      font-size: 13px;
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
      
      color: lightgray;
      padding: 10px;
    }
    
    .sign-in a {
        text-decoration: none;
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

    #contact {
      display: none;
      transition: .2s;
      transition: .5s;
    }

    #previous-education {
      display: none;
    }


    #parent-information {
      display: none;
    }

    #document-uploads {
      display: none;
    }

    : .two-btn {
      justify-content: space-between;
      margin-top: 50px;

    }

    .button:hover {}

    .btn:hover {
      border: 1px solid var(--primary_color);
      color: var(--font-main-color);
      background: white;
    }

    #admissions {
      height: 90px;
    }

    #other-relationship {
      display: none;
    }

    .images-uploads {
      width: 100px;
      height: 100px;
      margin: 5px 10px;
      border-radius: 50%;
      object-fit: cover;
    }

    .image-uploads-wrapper {
      display: flex;
      align-items: center;
      flex-direction: column;
    }

    .upload-btn {
      padding: 5px;
      background: var(--main_bg_color);
      font-size: 10px;
      width: 130px;
      text-align: center;
      font-weight: bold;
      color: var(--font_main_color);
      border-radius: 15px;
      border: 1px dashed var(--primary_color);
      margin-bottom: 30px;
    }

    .upload-btn:hover {
      color: var(--primary_color);
    }

    .new-format {
      display: flex;
      align-items: center;
      flex-direction: column;

    }

    .show {
      position: absolute;
      right: 2px;
      top: 2px;
      padding: 12px;
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
      font-weight: bold;
      z-index: 1;
      cursor: pointer;
      background: var(--main_bg_color);
      display: none;
      font-size: 14px;
    }


    /* 
      .status-1, {
      background: rgb(230, 244, 234);
      color: green;
      }
      
      */

    .incorrect-p,
    .incorrect-c {
      color: red;
      font-size: 14px;
    }
    
    .rotate {
        transform: rotate(60deg);
    }
    
    
    
    
  </style>
</head>

<body>

  <div class="form-container" id="student-data">
    <div class="animation-loading ">
      <div class="anime-spinner"></div>
      <div class="anime-title">Please wait...</div>
    </div>
    <div class="input-container">
      <div class="steps">
        <div class="account-creation">
          Registration form
        </div>
        <div class="sign-up">
          Sign up
        </div>
        <div class="percentage">
          <div class="status status-1" title="Step 1: Personal Information">20%</div>
          <div class="status status-2" title="Step 2:  Contact information">40%</div>
          <div class="status status-3" title="Step 3: Educational Background">60%</div>
          <div class="status status-4" title="Step 4: Parent Information">80%</div>
          <div class="status status-5" title="Step 5: Document upload">Go</div>
        </div>

      </div>
      <div class="form-wrapper">

        <div></div>
        <form>
          <div id="personal-information">
            <div class="personal-info-title sec-title">
              Personal Information:
            </div>
            <div class="input-group">
              <input type="text" id="fullname" name="fullname">
              <label for="fullname" class="shift-label">
                Full Name
              </label>
              <div class="error"></div>
            </div>
            <div class="input-group">
              <input type="email" id="email" name="email">
              <label for="email" class="shift-label">
                Email address
              </label>
              <div class="error email-error"></div>
            </div>
            <div class="input-group">
              <input type="date" id="dob" name="dob">
              <label for="dob" class="shift-label">
                Date of birth
              </label>
              <div class="error">
              </div>
            </div>

            <div class="input-group " id="search-group">
              <div class="select">
                <div id="nationality"> Select your nationality... </div>
                <img src="../public/icons/bleach-2.png" class="icon" alt="">
              </div>
              <ul id="countries">
                <input type="search" id="search" placeholder="Search your 'country' here...">
                <label for="search" hidden></label>
              </ul>
              <div class="error"></div>
            </div>
            <div class="input-group btn-wrapper">
              <a id="step-1-btn" class="btn">Next</a>
            </div>
            <div class="sign-in">
              Already have an account? <a href="login.php" class="login">Sign in</a>
            </div>
          </div>
          <div id="contact">
            <div class="personal-info-title sec-title">
              Contact Details:
            </div>

            <div class="input-group ">
              <div class="select" id="stateBtn">
                <div id="state">State of origin...</div>
                <img src="../public/icons/bleach-2.png" class="icon" alt="">
              </div>
              <ul id="state-list">

              </ul>
              <div class="error"></div>
            </div>

            <div class="input-group ">
              <div class="select" id="localBtn">
                <div id="localG">Local government...</div>
                <img src="../public/icons/bleach-2.png" class="icon" alt="">
              </div>
              <ul id="localG-list">

              </ul>
              <div class="error"></div>
            </div>
            <div class="input-group">
              <input type="text" id="address" name="address">
              <label for="address" class="shift-label">
                Home address
              </label>
              <div class="error">
              </div>
            </div>
            <div class="input-group">
              <input type="text" id="phone" name="phone_no">
              <label for="phone" class="shift-label">
                Phone number
              </label>
              <div class="error">
              </div>
            </div>
            <div class="input-group two-btn  btn-wrapper">
              <a id="step-2-btn-previous" class="btn">Previous</a>
              <a id="step-2-btn-next" class="btn">Next</a>
            </div>

          </div>
          <div id="previous-education">
            <div class="personal-info-title sec-title">
              Previous Education
            </div>
            <div class="input-group">
              <input type="text" id="previous-school" name="previous_school">
              <label for="previous-school" class="shift-label">
                Name of previous school
              </label>
              <div class="error"></div>
            </div>
            <div class="input-group">
              <input type="number" id="year-of-passing" name="year_of_passing">
              <label for="year-of-passing" class="shift-label">
                Year of passing
              </label>
              <div class="error"></div>
            </div>

            <div class="input-group ">
              <div class="select">
                <div id="admission-Type">Choose Admission Type...</div>
                <img src="../public/icons/bleach-2.png" class="icon" alt="">
              </div>
              <ul id="admissions">
                <li>Transfer Student</li>
                <li>New Admission (Fresh Student)</li>
              </ul>
              <div class="error"></div>
            </div>

            <div class="input-group ">
              <div class="select">
                <div id="admission-class">Choose Admission Class...</div>
                <img src="../public/icons/bleach-2.png" class="icon" alt="">
              </div>
              <ul id="admissions">
                <li>JSS 1</li>
                <li>JSS 2</li>
                <li>JSS 3</li>
                <li>SS 1</li>
                <li>SS 2</li>
                <li>SS 3</li>
              </ul>
              <div class="error"></div>
            </div>

            <div class="input-group two-btn  btn-wrapper">
              <a id="step-3-btn-previous" class="btn">
                Previous
              </a>
              <a id="step-3-btn-next" class="btn">
                Next
              </a>
            </div>
          </div>
          <div id="parent-information">
            <div class=" sec-title">
              Parent/Guardian Information
            </div>
            <div class="input-group">
              <input type="text" id="parent-name" name="guardian">
              <label for="parent-name" class="shift-label">
                Name of parent/guardian
              </label>
              <div class="error"></div>
            </div>

            <div class="input-group ">
              <div class="select">
                <div id="parent-relationship">
                  Relationship to the Candidate
                </div>
                <img src="../public/icons/bleach-2.png" class="icon" alt="">
              </div>
              <ul>
                <li>Mother</li>
                <li>Father</li>
                <li>Guardian</li>
                <li>Step-parent</li>
                <li>Other</li>
              </ul>
              <input type="text" id="other-relationship" placeholder="Please specify">
              <label for="other-relationship" class="shift-labe" hidden></label>
              <div class="error"></div>
            </div>


            <div class="input-group">
              <input type="number" id="parent-phone" name="guardian_contact">
              <label for="parent-phone" class="shift-label">
                Parent/Guardian phone number
              </label>
              <div class="error"></div>
            </div>





            <div class="input-group two-btn  btn-wrapper">
              <a id="step-4-btn-previous" class="btn">
                Previous
              </a>
              <a id="step-4-btn-next" class="btn">
                Next
              </a>
            </div>
          </div>
          <div id="document-uploads">
            <div class=" sec-title">
              Document uploads:
            </div>
            <div class="input-group image-uploads-wrapper">
              <div class="new-format">
                <img src="../public/icons/user.png" alt="profile" class="images-uploads" id="profile-preview">
                <a class="upload-btn" id="profile-btn">
                  Upload passport
                </a>
                <input type="file" hidden name="image" id="profile-image" class="candidate_dp" accept="image/*">
              </div>
              <label for="profile-image" hidden class="shift-label"></label>
              <div class="error" id="image-error"></div>
            </div>



            <div class="input-group">
              <input type="password" id="password" name="password">
              <label for="password" class="shift-label">
                Create your password
              </label>

              <div class="error pass-error"></div>
              <div class="incorrect-p"></div>
              <div class="show">
                Show
              </div>
            </div>

            <div class="input-group">
              <input type="password" id="re-password" name="re-password">
              <label for="re-password" class="shift-label">
                Retype your password
              </label>

              <div class="error re-error" id="pass-err"></div>
              <div class="incorrect-c"></div>
              <div class="show">
                Show
              </div>
            </div>




            <div class="input-group two-btn  btn-wrapper">
              <a id="step-5-btn-previous" class="btn">
                Previous
              </a>

              <input type="submit" class="btn" value="Submit">
              <label for="" hidden></label>
              <label for="" hidden></label>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', (event) => {

      // Global variables for checking if the steps pass the validation 
      var step1Check = false;
      var step2Check = false;
      var step3Check = false;
      var step4Check = false;




      var profileBtn = document.getElementById('profile-btn');
      var profileTag = document.getElementById('profile-image');
      var imagePreview = document.getElementById('profile-preview');
      var imageErr = document.getElementById('image-error');


      const imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'svg', 'raw', 'webp'];
      const isInArray = imageExtensions.includes('jpg');



      profileBtn.addEventListener('click', () => {
        profileTag.click();
      });
      profileTag.addEventListener('change', function() {

        if (this.files && this.files[0]) {
          var reader = new FileReader();
          var imageName = this.files[0].name;


          reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';


            const imageArr = imageName.split('.')
            var imageExt = imageArr.pop();

            if (imageExtensions.includes(imageExt.toLowerCase())) {
              profileBtn.style.background = 'rgb(230, 244, 234)';
              profileBtn.style.borderColor = 'green';
              profileBtn.style.color = 'green';
              profileBtn.textContent = 'Passport uploaded';
            } else {
              imageErr.textContent = 'Please upload a valid image'
              profileBtn.style.background = 'var(--main-bg-color)';
              profileBtn.style.padding = '2px';
              profileBtn.style.borderColor = 'var(--primary-color)';
              profileBtn.style.color = 'var(--font-main-color)';
             // profileBtn.textContent = 'Passport uploaded';
              imagePreview.src = '../public/icons/user.png';
              profileBtn.textContent = 'Upload passport';
            }

          };

          reader.readAsDataURL(this.files[0]);

        }
      });



      // Step-1 validation process 
      var step1Btn = document.getElementById('step-1-btn');
      var personalInfo = document.getElementById('personal-information'),
        fullNameEle = personalInfo.querySelector('#fullname'),
        emailEle = personalInfo.querySelector('#email'),
        dobEle = personalInfo.querySelector('#dob'),
        nationalityEle = personalInfo.querySelector('#nationality');
      var error = document.querySelectorAll('.error');
      
      
      
     


      // Step-2 validation process 
      var step2BtnPrevious = document.getElementById('step-2-btn-previous');
      var step2BtnNext = document.getElementById('step-2-btn-next');
      var contact = document.getElementById('contact'),
        stateEle = contact.querySelector('#state'),
        localGEle = contact.querySelector('#localG'),
        phoneEle = contact.querySelector('#phone'),
        addressEle = contact.querySelector('#address');

      // Step-3 validation process 
      var step3BtnPrevious = document.getElementById('step-3-btn-previous');
      var step3BtnNext = document.getElementById('step-3-btn-next');
      var previousEducation = document.getElementById('previous-education'),
        previousSchoolEle = previousEducation.querySelector('#previous-school'),
        yearOfpassingEle = previousEducation.querySelector('#year-of-passing'),
        admissionTypeEle = previousEducation.querySelector('#admission-Type'),
        addmissionClassEle = previousEducation.querySelector('#admission-class');

      // Step-4 validation process 
      var step4BtnPrevious = document.getElementById('step-4-btn-previous');
      var step4BtnNext = document.getElementById('step-4-btn-next');
      var parentInformation = document.getElementById('parent-information'),
        parentNameEle = parentInformation.querySelector('#parent-name'),
        relationToCanEle = parentInformation.querySelector('#parent-relationship'),
        otherRelationshipEle = parentInformation.querySelector('#other-relationship'),
        parentPhoneEle = parentInformation.querySelector('#parent-phone');
 

      // Step-5 validation process 
      var documentUpload = document.getElementById('document-uploads');
      var step5BtnPrevious = document.getElementById('step-5-btn-previous');
      var animationSpinner = document.querySelector('.animation-loading');
   


      // Ststus controller
      var steps = document.querySelectorAll('.status');


      // Step-1 Event trigger
      step1Btn.addEventListener('click', () => {
        var fullName = fullNameEle.value.trim(),
          email = emailEle.value.trim(),
          dob = dobEle.value.trim(),
          nationality = nationalityEle.textContent.trim();

        var emailReg = /^(\_|[a-zA-Z])\w+\@\w{3,7}\.\w+$/;
        if (fullName.length <= 0) {
          error[0].textContent = 'Please enter your full name.';
        }
        else if (!fullName.match(/^[a-zA-Z\_]\w{3,50}\s[a-zA-Z\_]\w{3,50}/)) {
          error[0].textContent = 'Please provide your full name';
        } else {
          error[0].textContent = '';
        }

        if (email.length <= 0) {
          error[1].textContent = 'Please enter your email address.';
        }
        else if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
          error[1].textContent = 'Please provide a valid email address';
        } else {
          error[1].textContent = '';
        }

        if (dob.length <= 0) {
          error[2].textContent = 'Please provide your date of birth.';
        } else {
          error[2].textContent = '';
        }

        if (nationality === 'Select your nationality...') {
          error[3].textContent = 'Please select your nationality.';
        } else {
          error[3].textContent = '';
        }


        if (nationality !== 'Select your nationality...' &&
          dob.length >= 0 && email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/) && fullName.match(/^[a-zA-Z\_]\w{3,50}\s[a-zA-Z\_]\w{3,50}/)
        ) {
          step1Check = true // passed 
          steps[0].style.background = 'rgb(230, 244, 234)';
          steps[0].style.color = 'green';


          personalInfo.style.transform = 'translateX(-300px)';
       //   personalInfo.style.opacity = 0;
          personalInfo.style.display = 'none';

          contact.style.transform = 'translateX(0px)';
          contact.style.display = 'block';
          contact.style.opacity = 1;



        } else {
          step1Check = false // failed 
          steps[0].style.background = 'rgb(230, 244, 234)';
          steps[0].style.color = 'red';
        }


      });



      // Step-2 Event triggers
      step2BtnPrevious.addEventListener('click', () => {
        personalInfo.style.transform = 'translateX(0px)';
        personalInfo.style.opacity = 1;
        personalInfo.style.display = 'block';

        contact.style.transform = 'translateX(-300px)';
        contact.style.opacity = 0;
        contact.style.display = 'none';
      });


      step2BtnNext.addEventListener('click', () => {
        var state = stateEle.textContent.trim(),
          localG = localGEle.textContent.trim(),
          address = addressEle.value.trim(),
          phone = phoneEle.value.trim();
        var numberReg = /^(234|\+234|0)[7-9][0-1]\d{8}$/;


        if (phone.length <= 0) {
          error[7].textContent = 'Please enter your phone number';
        }
        else if (!phone.match(numberReg)) {
          error[7].textContent = 'Please provide a valid phone number';
        } else {
          error[7].textContent = '';
        }


        if (address.length <= 0) {
          error[6].textContent = 'Please provide your home address.';
        } else {
          error[6].textContent = '';
        }


        if (state === 'State of origin...') {
          error[4].textContent = 'Please select your state of origin.';
        } else {
          error[4].textContent = '';
        }


        if (localG === 'Local government...') {
          error[5].textContent = 'Please select your local government.';
        } else {
          error[5].textContent = '';
        }


        if ((localG !== 'Local government...') && (state !== 'State of origin...') && (address.length > 0) &&
          (phone.match(numberReg))) {
          step2Check = true // passed 
          steps[1].style.background = 'rgb(230, 244, 234)';
          steps[1].style.color = 'green';

          previousEducation.style.transform = 'translateX(0px)';
          previousEducation.style.opacity = 1;
          previousEducation.style.display = 'block';

          contact.style.transform = 'translateX(-300px)';
          contact.style.display = 'none';
          contact.style.opacity = 0;

        } else {
          step2Check = false // failed 
          steps[1].style.background = 'rgb(230, 244, 234)';
          steps[1].style.color = 'red';
        }

      });






      // Step-3 Event triggers
      step3BtnPrevious.addEventListener('click', () => {
        contact.style.transform = 'translateX(0px)';
        contact.style.opacity = 1;
        contact.style.display = 'block';

        previousEducation.style.transform = 'translateX(300px)';
        previousEducation.style.opacity = 0;
        previousEducation.style.display = 'none';
      });


      step3BtnNext.addEventListener('click', () => {
        var previousSchool = previousSchoolEle.value.trim(),
          yearOfpassing = yearOfpassingEle.value.trim(),
          admissionType = admissionTypeEle.textContent.trim(),
          addmissionClass = addmissionClassEle.textContent.trim();

        if (previousSchool.length <= 0) {
          error[8].textContent = 'Please enter name of your previous school';
        }
        else {
          error[8].textContent = '';
        }


        if (yearOfpassing.length <= 0) {
          error[9].textContent = 'Please enter year of passing.';
        } else if(yearOfpassing.length > 4) {
          error[9].textContent = 'Invalid year';
        } else if(parseInt(yearOfpassing) < 1990 || parseInt(yearOfpassing) > 2024) {
          error[9].textContent = 'Please provide valid year of passing';
        } else if(typeof(parseInt(yearOfpassing)) !== 'number' ) {
          error[9].textContent = 'String values is not valid.';
        } else {
          error[9].textContent =  '';
        }
        
        


        if (admissionType === 'Choose Admission Type...') {
          error[10].textContent = 'Please select your state of origin.';
        } else {
          error[10].textContent = '';
        }


        if (addmissionClass === 'Choose Admission Class...') {
          error[11].textContent = 'Please select your local government.';
        } else {
          error[11].textContent = '';
        }



        if ((addmissionClass !== 'Choose Admission Class...') && (admissionType !== 'Choose Admission Type...') && (yearOfpassing.length === 4) &&
          (previousSchool.length > 0 && parseInt(yearOfpassing) >= 1990 && parseInt(yearOfpassing) <= 2024)) {

          step3Check = true // passed 


          steps[2].style.background = 'rgb(230, 244, 234)';
          steps[2].style.color = 'green';

          parentInformation.style.transform = 'translateX(0px)';
          parentInformation.style.opacity = 1;
          parentInformation.style.display = 'block';

          previousEducation.style.transform = 'translateX(-300px)';
          previousEducation.style.display = 'none';
          previousEducation.style.opacity = 0;

        } else {
          step3Check = false // false 


          steps[2].style.background = 'rgb(230, 244, 234)';
          steps[2].style.color = 'red';
        }




      });



      // Step-4 Event triggers
      step4BtnPrevious.addEventListener('click', () => {
        previousEducation.style.transform = 'translateX(0px)';
        previousEducation.style.opacity = 1;
        previousEducation.style.display = 'block';

        parentInformation.style.transform = 'translateX(300px)';
        parentInformation.style.opacity = 0;
        parentInformation.style.display = 'none';
      });



      step4BtnNext.addEventListener('click', () => {
        var parentName = parentNameEle.value.trim(),
          relationToCan = relationToCanEle.textContent.trim(),
          otherRelationship = otherRelationshipEle.value.trim(),
          parentPhone = parentPhoneEle.value.trim();


        var numberReg = /^(234|\+234|0)[7-9][0-1]\d{8}$/;

        if (parentName.length <= 0) {
          error[12].textContent = 'Please enter name of your parent/guardian';
        }
        else if(!parentName.match(/^[a-zA-Z\_]\w{3,50}\s[a-zA-Z\_]\w{3,50}/) ) {
          error[12].textContent = 'Please enter full name of your parent/guardian';
        } else {
          error[12].textContent = ''
        }
        
        
    
        if (parentPhone.length <= 0) {
          error[14].textContent = 'Please enter your parent/guardian contact';
        } else if (!parentPhone.match(numberReg)) {
          error[14].textContent = 'Please provide a valid number';

        } else {
          error[14].textContent = '';
        }


        if (relationToCan === 'Relationship to the Candidate' || relationToCan === 'Other') {
          error[13].textContent = 'Relationship to the Candidate is required.';
          error[13].style.color = 'red';
        } else {
          error[10].textContent = '';
        }


        if ((relationToCan !== 'Relationship to the Candidate' || relationToCan !== 'Other') && (parentPhone.match(numberReg)) && (parentName.length > 0) && relationToCan !== '' && parentName.match(/^[a-zA-Z\_]\w{3,50}\s[a-zA-Z\_]\w{3,50}/)) {

          step4Check = true // passed 


          steps[3].style.background = 'rgb(230, 244, 234)';
          steps[3].style.color = 'green';


          documentUpload.style.transform = 'translateX(0px)';
          documentUpload.style.opacity = 1;
          documentUpload.style.display = 'block';

          parentInformation.style.transform = 'translateX(-300px)';
          parentInformation.style.display = 'none';
          parentInformation.style.opacity = 0;

        } else {
          step4Check = false // failed 
          steps[3].style.background = 'rgb(230, 244, 234)';
          steps[3].style.color = 'red';
        }




      });


      // Step-4 Event triggers

      step5BtnPrevious.addEventListener('click', () => {
        parentInformation.style.transform = 'translateX(0px)';
        parentInformation.style.opacity = 1;
        parentInformation.style.display = 'block';

        documentUpload.style.transform = 'translateX(300px)';
        documentUpload.style.opacity = 0;
        documentUpload.style.display = 'none';
      });



      // Add event listener for input blur for real-time validation 
      var inputs = document.querySelectorAll('input');
      var password = document.getElementById('password');
      var passwordErr = document.getElementById('pass-err');

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
              siblingEle.style.top = '10px';
              siblingEle.style.left = '2px';
              siblingEle.style.background = 'white';
              siblingEle.style.fontSize = '14px';
              siblingEle.style.color = 'var(--font_main_color)';
            }
          }

          if (input.id === 'other-relationship') {
            relationToCanEle.textContent = input.value.trim();
          }



          // Real-time error remove if at least the input field 
          // is greater than 0, then remove the error text
          var err = input?.nextElementSibling.nextElementSibling;


          if (input.value.length > 0 && input.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            err.textContent = '';
          }


          if (input.value.length > 0 && !input.value.match(/^[a-zA-Z\_]\w{3,50}\s[a-zA-Z\_]\w{3,50}/) && input.id === 'fullname') {
            err.textContent = 'Please provide your full name';
          } else if (input.value.length > 0 && input.value.match(/^[a-zA-Z\_]\w{3,50}\s[a-zA-Z\_]\w{3,50}/) && input.id === 'fullname') {
            err.textContent = '';
          }





          if (input.value.length > 0 && input.id === 'dob') {
            err.textContent = '';
          } else if (input.value.length <= 0 && input.id === 'dob') {
            err.textContent = 'Please provide your date of birth.';
          }

          if (input.value.length > 0 && input.id === 'previous-school') {
            err.textContent = '';
          } else if (input.value.length <= 0 && input.id === 'previous-school') {
            err.textContent = 'Please enter name of your previous school';
          }


          if (input.value.length > 0 && input.id === 'year-of-passing') {
            err.textContent = '';
          } else if (input.value.length <= 0 && input.id === 'year-of-passing') {
            err.textContent = 'Please enter year of passing.';
          }

          if (input.value.length > 0 && input.id === 'address') {
            err.textContent = '';
          } else if (input.value.length <= 0 && input.id === 'address') {
            err.textContent = 'Please provide your home address.';
          }


          var numberReg = /^(234|\+234|0)[7-9][0-1]\d{8}$/;
          if (input.value <= 0 && input.id === 'phone') {
            err.textContent = 'Please enter your phone number';
          } else if (!input.value.match(numberReg) && input.id === 'phone') {
            err.textContent = 'Please provide a valid phone number';
          }


          if (input.value <= 0 && input.id === 'parent-phone') {
            err.textContent = 'Please enter your parent/guardian contact';
          } else if (!input.value.match(numberReg) && input.id === 'parent-phone') {
            err.textContent = 'Please provide a valid phone number';
          } else if (input.value.match(numberReg) && input.id === 'parent-phone') {
            err.textContent = '';
          }


          if (input.value.length > 0 && input.id === 'other-relationship') {
            err.textContent = '';
          } else if (input.value.length <= 0 && input.id === 'other-relationship') {
            err.textContent = 'Relationship to the Candidate is required.';
          }



          if (input.value.length > 0 && input.id === 'parent-name') {
            err.textContent = '';
          } else if (input.value.length <= 0 && input.id === 'parent-name') {
            err.textContent = 'Please enter name of your parent/guardian';
          } 


          /*

                    if (input.value.length > 0 && input.id === 're-password' && input.value !== password.value.trim()) {
                      passwordErr.textContent = 'Password mismatched.';

                    } else {
                      passwordErr.textContent = '';
                    }
          */



        });
      });



      // Add event listener for input focus for real-time validation.

      var shows = document.querySelectorAll('.show');
      inputs.forEach(input => {
        //console.log(input)

        shows[0].addEventListener('click', () => {

          if (input.id === 'password' && input.type === 'password') {
            input.type = 'text';
            shows[0].textContent = 'Hidden';
          } else if (input.id === 'password' && input.type === 'text') {
            input.type = 'password';
            shows[0].textContent = 'Show';
          }

        });
        shows[1].addEventListener('click', () => {

          if (input.id === 're-password' && input.type === 'password') {
            input.type = 'text';
            shows[1].textContent = 'Hidden';
          } else if (input.id === 're-password' && input.type === 'text') {
            input.type = 'password';
            shows[1].textContent = 'Show';
          }

        });

        input.addEventListener('input', function() {



          if (this.value.length > 0 && this.id === 'password') {
            shows[0].style.display = 'block';
          } else {
            shows[0].style.display = 'none';
          }

          if (this.value.length > 0 && this.id === 're-password') {
            shows[1].style.display = 'block';
          } else {
            shows[1].style.display = 'none';
          }


        });

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

          if (input.id === 'password' && input.type === 'password') {
            shows[0].style.display = 'block';
          }

          if (input.id === 're-password' && input.type === 'password') {
            shows[1].style.display = 'block';
          }

        });
      });

      var selectTags = document.getElementsByClassName('select');
      Array.from(selectTags).forEach(selectTag => {
        
        selectTag.addEventListener('click', () => {
          var ul = selectTag.nextElementSibling;
          selectIcon = selectTag.querySelector('.icon');
          ul.classList.toggle('ul-active');
          selectIcon.classList.toggle('rotate');
          console.log(selectIcon)
          
        });

      });


      // Fetch API for Countries json format!
      const countriesApi = async () => {
        try {
          const jsonData = await fetch('../state/countries.json');
          const data = await jsonData.json();
          var countries = document.getElementById('countries');

          data.forEach(country => {
            var li = document.createElement('li');
            li.textContent = country;
            countries.appendChild(li);
          });

        } catch (err) {
          console.log(err)
        }
      }

      (async () => {
        await countriesApi();

        var countries = document.querySelectorAll('#countries li');
        var countriesUl = document.getElementById('countries');
        var searchBtn = document.getElementById('search');
        var searchCon = document.getElementById('search-group');
        let child = countriesUl.firstElementChild;


        searchBtn.addEventListener('input', function() {
          countries.forEach(country => {
            var data = country.textContent.toLowerCase().trim();
            if (data.startsWith(this.value.toLowerCase().trim()) ||
              data.endsWith(this.value.toLowerCase().trim())) {
              country.style.display = 'flex';
            } else {
              country.style.display = 'none';
            }

          });
        })


      })();


      // Fetch Api for State and their local government!
      const stateApi = async () => {
        try {
          const requestState = await fetch('../state/states.json');
          const data = await requestState.json();
          var stateList = document.getElementById('state-list');

          data.forEach(({ state }) => {
            var li = document.createElement('li');
            li.textContent = state;
            stateList.appendChild(li);
          });

        } catch (err) {
          console.log(err)
        }
      }


      (async () => {
        await stateApi();
        var states = document.querySelectorAll('#state-list li');
        var localGList = document.getElementById('localG-list');
        const requestState = await fetch('../state/states.json');
        const data = await requestState.json();

        states.forEach(state => {
          state.addEventListener('click', () => {
            var activeState = state.textContent;

            var filterLocalG = data.filter(({ state }) => {
              return state === activeState;
            });

            // Looping through each <li> element and remove it
            while (localGList.firstChild) {
              localGList.removeChild(localGList.firstChild);
            }

            filterLocalG[0].localG.forEach(localG => {
              var li = document.createElement('li');
              li.textContent = localG;
              li.className = 'li';
              localGList.appendChild(li)

              li.addEventListener('click', () => {
                var localG = document.querySelector('#localG');
                var text = li.textContent;
                localG.textContent = text;

                localGList.classList.toggle('ul-active');
              })
            });
          });
        });



        var listItems = document.querySelectorAll('ul li');
        var otherRelationship = document.getElementById('other-relationship');
        Array.from(listItems).forEach(li => {
          var parentSibling =
            li.parentElement
            .previousElementSibling
            .firstElementChild;


          li.addEventListener('click', function() {
            parentSibling.textContent = this.textContent;
            error[3].textContent = '';
            error[4].textContent = '';
            error[5].textContent = '';
            error[10].textContent = '';
            error[11].textContent = '';
            error[13].textContent = '';
            li.parentElement.classList.toggle('ul-active');


            if (parentSibling.id === 'parent-relationship' && li.textContent.trim() === 'Other') {
              otherRelationship.style.display = 'block';
            } else if (parentSibling.id === 'parent-relationship' && li.textContent.trim() !== 'Other') {
              otherRelationship.style.display = 'none';
            }


          });
        });
      })();

      var localGList = document.getElementById('localG-list');
      var stateList = document.getElementById('state-list');
      var localBtn = document.getElementById('localBtn');
      var stateBtn = document.getElementById('stateBtn');
      localBtn.addEventListener('click', () => {
        if (stateList.classList.contains('ul-active')) {
          stateList.classList.toggle('ul-active')
        }
      })

      stateBtn.addEventListener('click', () => {
        if (localGList.classList.contains('ul-active')) {
          localGList.classList.toggle('ul-active')
        }
      })

        
      var emailError = document.querySelector('.email-error');
      var form = document.querySelector('form');
      form.addEventListener('submit', async function(e) {
        e.preventDefault();
        var fileInput = document.querySelector('.candidate_dp');
        var imageErr = document.getElementById('image-error');
        var passErr = document.querySelector('.incorrect-p');
        var confirmErr = document.querySelector('.incorrect-c');
        var password = document.getElementById('password');
        var confirm = document.getElementById('re-password');

        // Reset the text fields of error message 
        passErr.textContent = '';
        confirmErr.textContent = '';
        var extension = fileInput.files[0]?.name.split('.');
        var fileFormat = extension?.pop();
        var isImageUpload = imageExtensions.includes(fileFormat);




        if (!(fileInput.files.length > 0)) {
          imageErr.textContent = 'Please upload your profile image';
        } else {
          imageErr.textContent = "";
        }


        if (password.value.length <= 0) {
          passErr.textContent = 'Password field cannot be empty...';
        } else if (password.value.length <= 5) {
          passErr.textContent = 'Minimum password length is at least 6 character.';
        } else {
          passErr.textContent = '';
        }


        if (confirm.value.length <= 0) {
          confirmErr.textContent = 'Confirm password field cannot be empty.';
        } else if (confirm.value !== password.value) {
          confirmErr.textContent = "Password mistached"
        } else {
          confirmErr.textContent = '';
        }

        var nationalityValue = document.getElementById('nationality').textContent;
        var stateValue = document.getElementById('state').textContent;
        var localValue = document.getElementById('localG').textContent;
        var admissionTypeValue = document.getElementById('admission-Type').textContent;
        var admissionClassValue = document.getElementById('admission-class').textContent;

        var relationship = document.getElementById('parent-relationship').textContent;
        
         let signUp = document.querySelector('.sign-up');
         
         
         let em = document.querySelector('#email');
         
         if(!em.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            signUp.textContent = '';
          }


        try {


          var formData = new FormData(this);
          formData.append('nationality', nationalityValue);
          formData.append('state', stateValue);
          formData.append('localG', localValue);
         
          formData.append('admission_type', admissionTypeValue);
          formData.append('admission_class', admissionClassValue);
          formData.append('guardian_relationship', relationship);
          
          
          if (step1Check === true && step2Check === true && step3Check === true && step4Check === true && isImageUpload && (password.value.length >= 6) && (confirm.value === password.value)) {
          signUp.style.color = "black";
          signUp.style.fontSize = "18px";
          signUp.textContent = "Sign up";
          animationSpinner.style.display = 'flex';
            const res = await fetch('../include/form.php', {
              method: "POST",
              body: formData
            });

            if (!res.ok) {
             // throw Error("Server error, try again!");
            }


            const result = await res.json();
           
          
        
            // Redirect user to change if it's exists 
            
           if(result["email"] === "Exist") {
           
            contact.style.display = "none"
             previousEducation.style.display = "none";
             parentInformation.style.display = "none"; 
             documentUpload.style.display = "none"; 
             personalInfo.style.transform = 'translateX(0px)';         
             personalInfo.style.display = "block";
            emailError.textContent = "That email is in used already."
            }
            
            // Everything is clear to redirect:
            if(result.redirect) {
                
               window.location =  "./verify.php";
            } 
            
            // Sever-side may throw an errors
            // when client-side validation 
            //  failed, so it's
            // recommended to handle them 
            // for each input field that has error
            // you can find those errors in
            // the 'result' response.
            
          } else {
         
          signUp.style.color = "red";
          signUp.style.fontSize = "13px";
          signUp.textContent = "We're unable to process your bio data due to errors. Please review the form and correct any issues.";
          }


        } catch (error) {
          alert(error)
        } finally {
        //  setTimeout(() => {
            animationSpinner.style.display = 'none';
       //   }, 2000);
        }


      });




    });
  </script>

</body>

</html>