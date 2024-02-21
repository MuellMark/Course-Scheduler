<!DOCTYPE html>
<html>
<head>
    <title>Create Course Schedule</title>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div id="headerBar">
            <!--Logo Placement-->
            <div id="logo">
                <img src="./images/Logo.png"> 
            </div>
            <!--Navigation Bar-->
            <nav>
                <div id="menubar">
                    <ul>
                        <form action="./home.html">
                        <li> <a href="#"> Home</a> </li>
                    </form>
                    <ul>
                        <form action="./faq.html">
                        <li> <a href="#"> FAQ</a> </li>
                    </form>
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
<form action="view_csv.php" method="post" enctype="multipart/form-data">
        <input type="file" name="csv" value="" required/>
        <input type="submit" name="submit" value="View" />
</form>
</header>

<h1> Create Course Schedule </h1>
</body>
</html>
