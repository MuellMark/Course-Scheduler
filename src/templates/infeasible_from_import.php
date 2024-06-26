<!DOCTYPE html>
<html>

<head>
    <!-- Title Of Page -->
    <title>CSV Create Options</title>
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='css/style.css') }}">
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
<!-- Landing page for when the user imports a schdule that is infeasible from the start -->
    <br>
    <div>
        <h1 style="margin-top: 75px"><span>The file you tried to import is infeasible!</span></h1>
        <br>
        <br>
        <br>
        <p style="margin-left: auto; margin-right: auto; max-width: 700px">This means no schedule can be created given these parameters. Try and upload a different CSV file, or create a new one below!</p>
    </div>

    <br>

    <!-- Container for buttons -->
    <div class="container2">
        <div class="info-box">
            <button class="button-style2" onclick="window.location.href='{{ url_for('dynamic')}}'"
                style="height:50px; width:250px; margin-right: 10px">Create a New CSV</button>
            <button class="button-style2" onclick="window.location.href='{{ url_for('importpg')}}'"
                style="height:50px; width:250px">Import a CSV</button>
        </div>
    </div>

    <!-- JavaScript used to enable hamburger menu -->
    <script>
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
            }

        }
    </script>

</body>

</html>