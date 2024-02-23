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
                        <li> <a href="dynamic_class_csv.php"> Create CSV</a> </li>
                        <li> <a href="final_schedule_result.php"> Create Course Schedule</a> </li>
                    </ul>
                </div>
            </nav>
        </div>

<!--Header Pic-->
<div id="headerimage">
<img src="./images/48430_211016_HomecomingDroneSunset-HDR_2 (1).jpg" alt="Picture Of Campus At Sunset">
</div>
</header>

    <body>
        <h1>
            Course Scheduler
        </h1>
        <section class="pyscript">
            

            <!-- <div class="font-mono">
                start time: <label id="output1"></label>
            </div> -->
            
            
            <table style="width:70%">
                
                <tr>
                    <th>Time</th>
                    <th>Column 1</th>
                </tr>
                <tr>
                    <th>8:00 AM MWF</th>
                    <th><div id="output2" class="font-mono"></div></th>
                </tr>
                <tr>
                    <th>9:30 AM MWF</th>
                    <th></th>
                </tr>

            </table>
            
            <script type="py" src="./scripts/main.py" async></script>
        </section>
       
    </body>
</html>