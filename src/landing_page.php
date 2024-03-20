<!DOCTYPE html>
<html>

<head>
    <title>Home</title> <!-- Title Of Page -->
    <link rel="stylesheet" href="css/style.css"> <!-- Linking to CSS file -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Viewport settings to make webpage responsive -->
</head>

<body>
<!-- https://github.com/CoderZ90/confetti/blob/main/confetti.js -->
<script src="scripts/confetti.js"></script>
    <header>
        <div id="headerBar">
            <div class="hamburger" onclick="toggleMenu()"> &#9776;</div>
            <!-- Hamburger menu that starts toggleMenu when it is clicked -->
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
                        <!-- Just taking it out of the navigation on the home screen and replacing with get started button
                        <li> <a href="dynamic_merge.php"> Create CSV</a> </li>
                        -->
                        <li> <a href="about-howto.php"> How To Guides</a> </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!--Header Pic-->
        <div id="headerImage">
            <img src="./images/48430_211016_HomecomingDroneSunset-HDR_2 (1).jpg" alt="Picture Of Campus At Sunset">
        </div>
    </header>
    <div style="float: left; margin-left: 200px; margin-top: 50px; width: 600px">   
        <h1 style="font-size: 50px"> <span> Scheduling made simple. </span> </h1>
        <div class="description" style="text-align: left">
            <!--Imagine a streamlined and effective approach to university course scheduling that takes into account the
            complex
            puzzles of instructor availability, classroom setup, and student requirements. This web-based scheduler
            makes
            course planning at Southwestern University less complicated and helps maximize your time and resources by
            doing
            it automatically. 
            -->
            Join us in revolutionizing course scheduling. Empower your department with our intuitive, efficient, and user-friendly solution. Let's simplify scheduling together!
        </h2>
        <br>
        
        <a href="dynamic_merge.php">
            <button class="button-style2"> Get Started </button>
        </a>
        </div>
    </div>

    <style>
        #examplePicture img {
            float: right;
            width: 350px;
            height: 700;
            border: 1px solid black;
            margin-top: 45px;
            margin-right: 200px
        }
    </style>

    <div id="examplePicture">
        <!-- Placeholder photo until real schedule result picture made -->
        <img src="file:///C:/Users/katen/Downloads/Screenshot%202024-03-17%20085447.png" alt="Picture of possible result output">
    </div>

    <!-- JavaScript used to enable hamburger menu -->
    <script>
                const start = () => {
            setTimeout(function() {
                confetti.start()
            }, 1000); // 1000 is time that after 1 second start the confetti ( 1000 = 1 sec)
        };

        //  for stopping the confetti 

        const stop = () => {
            setTimeout(function() {
                confetti.stop()
            }, 5000); // 5000 is time that after 5 second stop the confetti ( 5000 = 5 sec)
        };
        // after this here we are calling both the function so it works
        start();
        stop();


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
            }

        }
        function playSound() {
            const audio = new Audio('confetti.mp3'); // Replace 'path_to_your_sound_file.mp3' with the actual path to your sound file
            audio.play();
        }
        window.onload = playSound;
    </script>
</body>

<a href="https://github.com/MuellMark/Course-Scheduler" id="githublink">
    <img src="./images/github.png" alt="Link to Github" id="github-icon">
</a>

</html>