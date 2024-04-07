<!DOCTYPE html>
<html>

<head>
    <title>Import A CSV</title> <!-- Title Of Page -->
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='css/style.css') }}"> <!-- Linking to CSS file -->
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
                        <li> <a href="{{ url_for('howto')}}"> How To Guides</a> </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!--Header Pic-->
        <div id="headerImage">
            <img src="{{url_for('static', filename='images/48430_211016_HomecomingDroneSunset-HDR_2 (1).jpg')}}">
        </div>
    </header>

    <style>
    #githublink {
        position: fixed;
        bottom: 20px; /* Adjust as needed */
        right: 20px; /* Adjust as needed */
    }
    </style>

    <br>
    <h1 style="margin-top: 25px"><span>Import A CSV</span></h1>
    <br>
    <br>
    <p style="margin-left: auto; margin-right: auto; max-width: 825px"> The Course Scheduler allows users to upload existing CSV files to create schedules. To do so, upload one below. 
    <br>
    <br>
    <div style="text-align: center">
        <form action="/upload" method="post" enctype="multipart/form-data">
            <input type="file" style="margin-left: 80px" name="csv_file" accept=".csv"><br><br>
            <input type="submit" value="Upload">
        </form>
    </div>

    <div id="github-icon">
        <a href="https://github.com/MuellMark/Course-Scheduler" id="githublink">
        <img src="{{url_for('static', filename='images/github.png')}}" alt="Link to Github" id="github-icon">
        </a>
    </div>

</html>