<!DOCTYPE html>
<html>

<head>
    <title>Home</title> <!-- Title Of Page -->
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='css/style.css') }}">
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
                <img src="{{url_for('static', filename='images/Logo.png')}}">
            </div>
            <!--Navigation Bar-->
            <nav>
                <div id="menubar">
                    <ul>
                        <li> <a href="{{ url_for('home')}}"> Home</a> </li>
                        <li> <a href="{{ url_for('faq')}}"> FAQ</a> </li>
                        <li> <a href="{{ url_for('option')}}"> Create Schedule</a> </li>
                        <li> <a href="{{ url_for('howto')}}"> How To Guides</a> </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!--Header Pic-->
        <div id="headerImage">
            <img src="{{url_for('static', filename='images/48430_211016_HomecomingDroneSunset-HDR_2 (1).jpg')}}" alt="Picture Of Campus At Sunset">
        </div>
    </header>
    <div class="content-wrapper">
    <div class="container">
        <div class="info-box"> <!-- New div wrapper with class info-box -->
        <h4> <span> Scheduling Made Simple. </span> </h4>
            <div class="description" style="text-align: left">
                Join us in revolutionizing course scheduling. Empower your department with our intuitive, efficient, 
                and user-friendly solution. Let's simplify scheduling together!
            </div>
            <div style="text-align: center;">
                <a href="{{ url_for('option')}}">
                    <button class="button-style2"> Get Started </button>
                </a>
            </div>
        </div> <!-- End of info-box div -->
        <div id="examplePicture" class="image-container">
            <img src="{{url_for('static', filename='images/exampleOutput2.png')}}" alt="Picture of possible result output">
        </div>
    </div>
    </div>

    <!-- JavaScript used to enable hamburger menu -->
    <script>
        const start = () => {
            setTimeout(function () {
                confetti.start()
            }, 1000); // 1000 is time that after 1 second start the confetti ( 1000 = 1 sec)
        };

        //  for stopping the confetti 

        const stop = () => {
            setTimeout(function () {
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
</div>

</html>