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
<img src="./images/48430_211016_HomecomingDroneSunset-HDR_2 (1).jpg" alt="Picture Of Campus At Sunset">
</div>
</header>

    <body>
        <h1><span>Course Scheduler</span></h1>
        <br>
        <section class="pyscript">
        <br>

            <!-- <div class="font-mono">
                start time: <label id="output1"></label>
            </div> -->
            
            
        <style>
            table {
                table-layout: fixed;
                border-collapse: collapse;
                width: 60%;
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
                    <th>Faculty</th>
                </tr>
                <tr>
                    <td>8:00 AM MWF</td>
                    <td>Calculus 1</td>
                    <!--<td><div id="output2" class="font-mono"></div></td>-->
                    <!--<td>Dr. John Ross</td>-->
                    <td>Professor C</td>
                </tr>
                <tr>
                    <td>9:30 AM MWF</td>
                    <td>Computer Science 1</td>
                    <td>Professor A</td>
                </tr>
                <tr>
                    <td>11:00 AM MWF</td>
                    <td>Computer Science 2</td>
                    <td>Professor B</td>
                </tr>
                <tr>
                    <td>10:00 AM TTH</td>
                    <td>Algorithms</td>
                    <td>Professor C</td>
                </tr>
                <tr>
                    <td>11:30 AM TTH</td>
                    <td>Artificial Intelligence</td>
                    <td>Professor D</td>
                </tr>
            </table>
            
            <script type="py" src="./scripts/main.py" async></script>
        </section>
    
        <button class="button-style4" style="float: right; margin-right: 305px; margin-top: 20px;">Download Schedule</button>

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