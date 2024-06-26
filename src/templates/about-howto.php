<!DOCTYPE html>
<html>

<head>
    <!-- Title Of Page -->
    <title>About/HowTo</title>
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='css/style.css') }}">
    <!-- Linking to CSS file -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Viewport settings to make webpage responsive -->
</head>

<body>
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
                        <li> <a href="{{ url_for('howto')}}"> Guides</a> </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!--Header Pic-->
        <div id="headerImage">
            <img src="{{url_for('static', filename='images/48430_211016_HomecomingDroneSunset-HDR_2 (1).jpg')}}">
        </div>
    </header>

    <div class="docs-container">
        <div class="docs-section">
            <h1> <span> Documentation </span></h1>
            <iframe src="{{ url_for('static', filename='docs/Backend- Get Started.pdf') }}" class="pdf-iframe"></iframe>

        </div>
        <div class="howTo-section">

            <h1> <span> Guides </span></h1>

            <iframe src="{{ url_for('static', filename='docs/Southwestern Course Scheduler.pdf') }}" class="pdf-iframe"></iframe>
        </div>
    </div>

    <!-- JavaScript used to enable hamburger menu -->
    <script>
        window.onload = function () { //When webpage opens, run this code
            var menu = document.getElementById('menubar'); //Access menu bar
            if (window.innerWidth < 750) { //If the windows width is less than 750 px, then hide the menu
                menu.style.display = 'none'
            }
        };

        function toggleMenu() { //Toggle the visibility of the menu
            var menu = document.getElementById('menubar');
            var contentWrapper = document.querySelector('.content-wrapper'); //Toggle the display style between block and none
            if (menu.style.display === 'block') { //If the window is resizdd to below 750, then hide the menu
                menu.style.display = 'none'; //Hide the menu
                contentWrapper.classList.remove('menu-opened');
            } else { //Else, show it
                menu.style.display = 'block';
                contentWrapper.classList.add('menu-opened');
            }
        }
    </script>

</body>

<div id="github-icon-container">
    <a href="https://github.com/MuellMark/Course-Scheduler" id="githublink">
        <img src="{{url_for('static', filename='images/github.png')}}" alt="Link to Github" id="github-icon">
    </a>
</div>

</html>