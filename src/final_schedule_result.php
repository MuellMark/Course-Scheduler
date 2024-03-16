<!DOCTYPE html>
<html>
<head>
    <title>Create Course Scheduler </title>
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

    <body>
        <h1>
            Course Scheduler
        </h1>
        <section class="pyscript">
        <br>

            <!-- <div class="font-mono">
                start time: <label id="output1"></label>
            </div> -->
            
            
        <style>
            table {
                table-layout: fixed;
                border-collapse: collapse;
                width: 70%;
                /* to center table */
                margin-left: auto; 
                margin-right: auto;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 5px;
                text-align: center;
                align-items:center;
            }

            th {
                background-color: #f2f2f2;
            }
        </style>

            <table>
                <tr>
                    <th>Time</th>
                    <th>Course</th>
                </tr>
                <tr>
                    <td>8:00 AM MWF</td>
                    <td><div id="output2" class="font-mono"></div></td>
                </tr>
                <tr>
                    <td>9:30 AM MWF</td>
                    <td></td>
                </tr>
            </table>
            
            <script type="py" src="./scripts/main.py" async></script>
        </section>
    

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