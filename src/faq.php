<!DOCTYPE html>
<html>

<head>
    <title>FAQ</title>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <div id="headerBar">
            <div class="hamburger" onclick="toggleMenu()"> &#9776;</div>
            <!--Logo Placement-->
            <div id="logo">
                <img src="./images/Logo.png">
            </div>
            <!--Navigation Bar-->
            <nav>
                <div id="menubar">
                    <ul>
                        <li> <a href="landing_page.php"> Home</a> </li>
                        <li> <a href="faq.php"> FAQ</a> </li>
                        <li> <a href="csv_option.php"> Create Schedule</a> </li>
                        <li> <a href="about-howto.php"> How To Guides</a> </li>
                    </ul>
            </nav>
        </div>

        <!--Header Pic-->
        <div id="headerImage">
            <img src="./images/48430_211016_HomecomingDroneSunset-HDR_2 (1).jpg" alt="Picture Of Campus At Sunset">
        </div>
    </header>
    <section id="main-content">
        <div id="faq-section">
            <h1> FAQ </h1>
            <div class="faq-container">
                <div class="faq-item">
                    <button class="question"> What Is Course Scheduler? </button>
                    <div class="answer">
                        <p>
                            The Course Scheduler is a useful tool designed to generate course schedules based on various
                            faculty and course restrictions specified by users. In addition, faculty members will be
                            given the option to alter already generated schedules to check for feasibility.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="question"> How To Use Course Scheduler </button>
                    <div class="answer">
                        <p>
                            Answer to question 2.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="question"> Who To Contact? </button>
                    <div class="answer">
                        <p>
                            Answer to question 3.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="question"> What Is Firebase? </button>
                    <div class="answer">
                        <p>
                            The Firebase Realtime Database is a cloud, NOSQL database. It doesn't require an application
                            server to connect-- it is directly accessed through a web browser or mobile device.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="faqPicture">
            <img src="https://img.freepik.com/premium-vector/tiny-cartoon-business-people-standing-around-huge-question-mark-male-female-persons-asking-help-answers-flat-vector-illustration-communication-solution-concept-banner-website-design_74855-25331.jpg"
                alt="FAQ picture">
        </div>


    </section>

    <style>
        #faqPicture img {
            position: fixed;
            top: 50%;
            right: 100px;
            width: 500px;
            margin-top: -250px;
            z-index: 1;
        }
    </style>

    <!-- JavaScript used to enable hamburger menu -->
    <script>

        window.onload = function () { //When webpage opens, run this code
            var menu = document.getElementById('menubar');
            if (window.innerWidth < 750) { //If the windows width is less than 750 px, then hide the menu
                menu.style.display = 'none'
            }
        };

        function toggleMenu() {
            var menu = document.getElementById('menubar');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block'; //Toggle the display style between block and none
            window.onresize = function () { //This will know when the window is resized
                if (window.innerWidth < 750) { //If the window is resizdd to below 750, then hide the menu
                    menu.style.display = 'none';
                } else { //Else, show it
                    menu.style.display = 'block';
                }
            };

        }

        //Inspiration For Code:https://www.youtube.com/watch?v=IcyXS9aL4bs
        //ELements with the class "question"
        var faqQuestions = document.getElementsByClassName("question");
        for (var i = 0; i < faqQuestions.length; i++) {
            faqQuestions[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                content.style.display = content.style.display === "block" ? "none" : "block";
            });
        }

    </script>

</body>

<div id="github-icon-container">
<a href="https://github.com/MuellMark/Course-Scheduler" id="githublink">
    <img src="./images/github.png" alt="Link to Github" id="github-icon">
</a>
</div>

</html>