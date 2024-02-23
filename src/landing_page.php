<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
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

<h1> What Is Course Schedule? </h1>

<script>
function toggleMenu() {
    var menu = document.getElementById('menubar');
    if (menu.style.display === 'flex') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'flex';
  }
}
</script>

</body>
</html>
