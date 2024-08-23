<?php
include "./include/db.php";
include "./include/custom_functions.php";

// Fetching the blog posts
$postQuery = "SELECT P.post_id, A.username, P.title, P.body, P.total_views, P.createdAt, P.feature_img FROM Admin A
INNER JOIN Posts P 
ON A.admin_id = 
P.admin_id ORDER BY P.createdAt DESC";

$statement = $pdo->prepare($postQuery);
$statement->execute();
$rows = $statement->fetchAll();
?>




<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Unity admission portal</title>
    <link
        rel="stylesheet"
        href="node_modules/swiper/swiper-bundle.min.css" />

    <style>
        :root {
            --primary_color: #9010bf;
            --main_bg_color: #fafafa;
            --font_main_color: #6a696b;
        }

        @font-face {
            font-family: Time;
            src: url("./public/fonts/times.ttf");
        }

        @font-face {
            font-family: Poppin;
            src: url("./public/fonts/Poppins-Medium.ttf");
        }

        @font-face {
            font-family: Poppin_bold;
            src: url("./public/fonts/Roboto-Bold.ttf");
        }

        @font-face {
            font-family: MediumFont;
            src: url("./public/fonts/Roboto-Medium.ttf");
        }

        @font-face {
            font-family: Roboto;
            src: url("./public/fonts/Poppins-Bold.ttf");
        }

        body {
            font-family: MediumFont;
            margin: 0;
            background: var(--main_bg_color);
            background: #fbf7fdff;
        }

        /* Header styling */
        .header-1 {
            height: 80px;
            width: 100%;
            position: relative;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px;

            z-index: 999;
        }

        .header-2 {
            height: 80px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            /* border-bottom: 1px solid black; */
            padding: 15px;
            z-index: 99999;
            transition: 0.5s;
            transform: translateY(-100px);
            box-shadow: 0 -1px 5px var(--main_bg_color);
        }

        .logo-section {
            margin-left: 15px;
            padding: 0 5px;
            border-radius: 3px;
            border-left: 5px solid var(--primary_color);
        }

        .std-title {
            font-family: Poppin_bold;
            font-size: 18px;
        }

        .school-title {
            letter-spacing: 1px;
        }

        .links-section {
            width: 250px;
            margin-right: 60px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            font-size: 18px;
        }

        .sign-in-btn {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-family: Roboto;
            background: var(--primary_color);
            padding: 4px 20px;
            border-radius: 5px;
        }

        .apply-btn {
            text-decoration: none;
            color: var(--font_main_color);
            font-size: 15px;
            font-family: Roboto;
            background: white;
            padding: 4px 15px;
            border-radius: 5px;
        }

        .sign-in-btn:hover,
        .apply-btn:hover {
            border: 1px solid #9010bf;
            background: white;
            transition: 0.3s;
            color: var(--font_main_color);
            text-decoration: underline;
        }

        /* Styling Main section */

        main {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Typewriter animation */

        .typewriter-anime-wrap {
            height: 100px;
            width: 700px;
            margin: 50px 0;
            background: white;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 40px;
            padding-left: 25px;
        }

        .caption-header {
            font-family: Roboto;
            font-size: 25px;
            font-weight: 500;
            color: var(--primary_color);
            transition: 0.5s;
            text-align: center;

        }

        .caption-text {
            font-size: 20px;
            font-family: Poppin;
            display: flex;
            color: black;
        }

        .typed-text-red {
            color: red;
        }

        .typed-text-black {
            color: var(--font_main_color);
        }

        /* register-wrapper */
        .register-wrapper {
            position: relative;
            height: 200px;
            width: 700px;
            margin: 10px 0;
            background: white;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .admission-logo {
            position: absolute;
            top: -15px;
            height: 40px;
            width: 40px;
            color: white;
            border-radius: 50%;
            background: var(--primary_color);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .std-icon {
            width: 35px;
        }

        .motivate {
            font-size: 30px;
            font-family: Roboto;
        }

        .reg-link {
            margin-top: 10px;
            font-family: Poppin;
            text-decoration: none;
            font-size: 16px;
            padding: 5px 15px;
            background: var(--primary_color);
            border: 1px solid var(--primary_color);
            color: white;
            border-radius: 15px;
        }

        .reg-link:hover {
            border-color: var(--primary_color);
            background: var(--main_bg_color);
            color: black;
            border-radius: 10px;
            text-decoration: underline;
        }

        /* posts-wrapper */
        .posts-wrapper a {
            color: black;
            text-decoration: none;
            margin: 5px 10px;
        }

        .posts-wrapper {
            position: relative;

            width: 700px;
            margin-top: 80px;
            background: white;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }

        .news-wrap {
            height: 50px;
            width: 750px;
            background: var(--main_bg_color);
            text-align: center;
        }

        .news {
            font-family: Time;
            font-size: 25px;
            position: relative;
        }

        .news::before {
            border-radius: 13px;
            content: "";
            height: 5px;
            width: 60px;
            position: absolute;
            top: 25px;
            left: 45%;
            margin-top: 5px;
            background: var(--primary_color);
        }

        .post-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 600px;
            margin: 30px 20px;

        }

        .post {
            width: 150px;
            box-shadow: 0px 0px 6px #f0f0f0;

            border-radius: 10px;
            padding: 10px;
        }

        /* Skeleton loading animation */
        .skeleton-loading {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 150px;
            box-shadow: 0px 0px 6px #f0f0f0;
            height: 200px;
            border-radius: 10px;
            padding: 10px;
            background: #fcfcfc;
        }

        .image-skeleton {
            width: 120px;
            height: 120px;
            background: #f2f2f2;
            border-radius: 10px;
            animation: blink 0.7s infinite alternate;
            /* Blinking animation */
        }

        .title-skeleton {
            width: 120px;
            height: 20px;
            background: #f2f2f2;
            margin: 12px 0;
            animation: blink 0.7s infinite alternate;
            /* Blinking animation */
        }

        .date-sekeleton {
            width: 80px;
            height: 10px;
            background: #f2f2f2;
            animation: blink 0.7s infinite alternate;
            /* Blinking animation */
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0.5;
            }
        }

        .post {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-direction: column;
        }

        .post-image {
            height: 150px;
            width: 150px;
            border-radius: 10px;
            padding: 1px;
        }

        .post-title {
            font-size: 16px;
            font-weight: 500;
            padding: 8px 5px;
        }

        .post-date {
            font-size: 10px;
            border-top: 1px solid var(--primary_color);
            width: 130px;
            padding: 4px;
            text-align: center;
        }

        .swiper-container {
            overflow: hidden;
        }

        .swiper-pagination-bullet-active {
            background-color: var(--primary_color);
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: var(--primary_color);
        }

        /* Customize Swiper navigation arrows */
        .swiper-button-next,
        .swiper-button-prev {
            color: #9010bf;
        }

        /* Customize Swiper navigation arrow icons */
        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 24px;
        }

        /* Customize pagination color */
        .swiper-pagination-bullet {
            background-color: #9010bf;
        }

        /* Customize active pagination bullet color */
        .swiper-pagination-bullet-active {
            background-color: #6a696b;
        }

        .vision {
            width: 600px;
            padding: 20px;
            margin-top: 80px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }

        .vision-image {
            width: 300px;
            border-radius: 13px;
        }

        .vision-wrapper {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
        }

        .vision-content {
            width: 250px;
            margin-left: 20px;
            text-align: justify;
        }

        .vision-title {
            font-family: Poppin;
            font-size: 25px;
            letter-spacing: 2px;
            border-left: 5px solid var(--primary_color);
            padding: 3px 10px;
        }

        .vision-read-more {
            color: var(--primary_color);
            background: white;
            font-size: 15px;
            padding: 5px 15px;
            text-decoration: none;
            border: 1px solid var(--primary_color);
            transition: 0.3s;
        }

        .vision-read-more:hover {
            color: white;
            text-decoration: underline;
            background: var(--primary_color);
        }

        footer {
            height: 100px;
            width: 100%;
            position: relative;
            left: 0;
            bottom: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: white;
            font-size: 12px;
            color: grey;
            letter-spacing: 0.8;
            margin-top: 100px;
            border-top-left-radius: 120px;
            border-top-right-radius: 120px;
        }

        .footer-wrapper {
            width: 800px;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: flex-start;
            padding: 20px;
        }

        .guidelines {
            display: flex;
            flex-direction: column;
            justify-content: flex;
            align-items: flex-start;
            margin-top: 30px;
            margin-right: 50px;
        }

        .guidelines a {
            color: var(--font_main_color);
            text-decoration: none;
            font-size: 17px;
            margin-top: 5px;
        }

        .guide-title {
            font-family: Poppin_bold;
            color: black;
            padding: 2px 15px;
            border-bottom: 2px solid var(--primary_color);
            margin-bottom: 8px;
        }

        #s {
            display: none;
            transition: all 1s;
        }

        .post-title {
            color: black;
            text-decoration: none;
        }

        .post-image {
            object-fit: cover;
        }

        .view-icon {
            width: 13px;
        }

        .date-views {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 150px;

        }

        .views {
            border-left: 1px solid #eaeaea;
            width: 120px;
            height: 12px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .views img {
            margin-left: 15px;
            margin-right: 4px;
        }
    </style>
</head>

<body>
    <header class="header-1" id="header-1">
        <div class="logo-section">
            <div class="std-title">STUDENT ADMISSION PORTAL</div>
            <div class="school-title">GOVERNMENT GIRLS UNITY COLLEGE</div>
        </div>
        <div class="links-section">
            <div>
                <a href="./views/login.php" class="sign-in-btn">Sign in</a>
            </div>
        </div>
    </header>
    <header class="header-2" id="header-2">
        <div class="logo-section">
            <div class="std-title">STUDENT ADMISSION PORTAL</div>
            <div class="school-title">GOVERNMENT GIRLS UNITY COLLEGE</div>
        </div>
        <div class="links-section">
            <div>
                <a href="./views/login.php" class="sign-in-btn">Sign in</a>
            </div>
            <div>
                <a href="./views/form.php" class="apply-btn">Apply now</a>
            </div>
        </div>
    </header>

    <main>
        <div class="typewriter-anime-wrap">
            <div class="caption-header">Innovate. Educate. Elevate.</div>
            <div class="caption-text typed-output" id="typed-output">
                Empowering Minds, Inspiring Achievements.
            </div>
        </div>
        <div class="register-wrapper">
            <div class="admission-logo">
                <img
                    src="./public/images/20240310_213759.png"
                    alt=""
                    class="std-icon" />
            </div>
            <div class="motivate"></div>
            <div>
                Welcome to Academic Discovery — Apply for the Admission now
            </div>
            <a href="./views/form.php" class="reg-link">Register here</a>
        </div>

        <div class="posts-wrapper">
            <div class="news-wrap">
                <div class="news">NEWS & EVENTS</div>
            </div>

            <div id="s" class="post-wrapper  original-post swiper-container">



                <div class="swiper-wrapper original-post">
                    <?php foreach ($rows as $row) { ?>

                        <div class="post swiper-slide">
                            <img src="./public/uploads/<?php echo $row["feature_img"]; ?>" alt="post image" class="post-image">




                            <?php if (strlen($row["title"]) > 30) { ?>
                                <a class="post-title" href="/unity/views/post.php?id=<?php echo $row["post_id"]; ?>">
                                    <?php echo substr($row["title"], 0, 30); ?>....
                                </a>
                            <?php } else { ?>
                                <a class="post-title" href="/unity/views/post.php?id=<?php echo $row["post_id"]; ?>">
                                    <?php echo $row["title"]; ?>
                                </a>
                            <?php } ?>




                            <?php if (intval($row["total_views"]) > 0) { ?>
                                <div class="date-views">
                                    <div class="post-date">
                                        <?php echo postDateFormat($row["createdAt"]); ?>
                                    </div>
                                    <div class="views post-date">
                                        <img src="./public/icons/eye (1).png" class="view-icon">
                                        <?php echo $row["total_views"]; ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="post-date">
                                    <?php echo postDateFormat($row["createdAt"]); ?>
                                </div>
                            <?php } ?>
                        </div>

                    <?php } ?>
                </div>


                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>
            <div class="post-wrapper skeleton-container swiper-container">

                <div class="skeleton-post swiper-wrapper">
                    <?php for ($i = 0; $i <= 12; $i++) { ?>
                        <div class="skeleton-loading swiper-slide">
                            <div class="image-skeleton"></div>
                            <div class="title-skeleton"></div>
                            <div class="date-sekeleton"></div>
                        </div>
                    <?php } ?>
                </div>


                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>

        </div>

        <div class="vision">
            <div class="vision-wrapper">
                <img
                    src="./public/images/_e501ab11-330a-4741-8f86-d3a23bcb788a.jpeg"
                    class="vision-image"
                    alt="Student vision img" />
                <div class="vision-content">
                    <div class="vision-title">OUR VISION</div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Inventore dolores alias, ab maiores unde aut
                        sunt minus vitae non quisquam deleniti tempore magni
                        voluptatem. Laudantium vero nisi adipisci quisquam
                        incidunt. Lorem ipsum dolor sit amet, consectetur
                        adipisicing elit. Dolores ducimus corrupti
                        dignissimos quas similique laudantium, laboriosam
                        cupiditate enim totam, incidunt consequuntur fugit
                        temporibus obcaecati, nulla voluptatibus.
                    </p>
                    <a href="#" class="vision-read-more">Read more</a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div>Project by Sumayya Garba Diggi</div>
    </footer>
    <script src="node_modules/swiper/swiper-bundle.min.js"></script>
    <script src="./node_modules/typed.js/dist/typed.umd.js"></script>

    <script type="module">
        window.addEventListener("scroll", function() {
            var headerOne = document.getElementById("header-1");
            var headerTwo = document.getElementById("header-2");
            var scrollHeight = window.scrollY;
            if (scrollHeight > 100) {
                headerOne.style.opacity = 0;
                headerTwo.style.transform = "translateY(0px)";
            } else {
                headerOne.style.opacity = 1;
                headerTwo.style.transform = "translateY(-100px)";
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            var captionsHeader = [
                "Unlocking Academic Futures",
                "Dreams Take Academic Flight",
                "Inspiring Educational Empowerment",
                "Education Adventure Awaits",
                "Innovate. Educate. Elevate."
            ];

            function random(captions) {
                var randNum = Math.floor(Math.random() * captions.length);
                return randNum;
            }
            var captionHeader = document.querySelector(".caption-header");

            var randText = [
                "Dive into Learning, Soar into Success!",
                "Building Tomorrow's Leaders."
            ];

            var textToDisplay = randText[random(randText)];
            var elementTagToDis = document.querySelector(".motivate");
            elementTagToDis.textContent = textToDisplay;

            setInterval(() => {
                let randNum = random(captionsHeader);
                captionHeader.textContent = captionsHeader[randNum];
            }, 7000);

            // Colors
            var colors = ["typed-text-red", "typed-text-black"];
            var randNum = random(colors);

            var typed = new Typed("#typed-output", {
                strings: [
                    "Empowering Minds, Inspiring Achievements.",
                    "Where Dreams Take Flight – Welcome to Your Academic Journey!",
                    "Innovate, Educate, Elevate: Your Gateway to Excellence.",
                    "Discover, Learn, Succeed – Your Pathway to Success Starts Here.",
                    "Transforming Ambitions into Achievements – Enroll Today!",
                    "Discover, Learn, Succeed – Your Pathway to Success Starts Here.",
                    "Ignite Passion, Pursue Knowledge – Welcome to Academic Discovery.",
                    "Crafting Success Stories – Enroll for Your Chapter of Achievement."
                ],
                typeSpeed: 150,
                backSpeed: 50,
                loop: true,
                cursorChar: "",
                preStringTyped: (arrayPos, self) => {
                    // Change text color before typing each string
                    document
                        .getElementById("typed-output")
                        .classList.add(colors[randNum]);
                }
            });
        });

        var swiper = new Swiper(".swiper-container", {
            slidesPerView: 3,
            spaceBetween: 40,
            centeredSlides: true,
            loop: true,
            grabCursor: true,

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true
            },

            autoplay: {
                delay: 5000, // Delay between transitions in milliseconds
                disableOnInteraction: false
            },
            effect: "slide"
        });

        // Skeleton loading controller
        var skeletons = document.querySelector(".skeleton-container");
        var OrginalPost = document.querySelector(".original-post");

        setTimeout(() => {
            skeletons.style.display = "none";
            OrginalPost.style.display = "flex";
        }, 1000 * 10);
    </script>
</body>

</html>