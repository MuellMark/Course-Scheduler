<!DOCTYPE html>
<html>

<head>
    <title>CSV Create Options</title> <!-- Title Of Page -->
    <link rel="stylesheet" href="css/style.css"> <!-- Linking to CSS file -->
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
                <img src="./images/Logo.png">
            </div>
            <!--Navigation Bar-->
            <nav>
                <div id="menubar">
                    <ul>
                        <li> <a href="landing_page.php"> Home</a> </li>
                        <li> <a href="faq.php"> FAQ</a> </li>
                        <li> <a href="dynamic_merge.php"> Create CSV</a> </li>
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

    <!-- Container for buttons -->
    <div class="container">
        <div class="info-box">

        <button class="button-style2" onclick="window.location.href='dynamic_merge.php'" style="margin-top: 200px; height:50px; width:250px; margin-right: 10px">Create A New CSV</button>
        <button class="button-style2" onclick="window.location.href='csv_option.php'" style="margin-top: 200px; height:50px; width:250px">Import A CSV</button>
        
        </div>
    </div>



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