<!DOCTYPE html>
<html>

<head>
    <title>Import A CSV</title> <!-- Title Of Page -->
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

<!-- Landing page if no file is uploaded -->
    <br>
    <h1 style="margin-top: 25px"><span>No File Uploaded!</span></h1>
    <br>
    <br>
    <p style="margin-left: auto; margin-right: auto; max-width: 825px"> No File was uploaded! Please upload one here:
        <br>
        <br>
    <div style="text-align: center">
        <form action="/upload" method="post" enctype="multipart/form-data">
            <input class="button-style5" type="file" style="margin-left: 80px" name="csv_file" accept=".csv"><br><br>
            <input class="button-style5" type="submit" value="Upload">
        </form>
    </div>

</html>