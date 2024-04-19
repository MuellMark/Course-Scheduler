<!DOCTYPE html>
<html>


<head>
    <title>Create CSV</title>
    <script src="{{url_for('static', filename='scripts/createCSV.js')}}"></script>
    <script type="text/javascript" src="scripts/faculty_script.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='css/style.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <div id="headerBar">
            <div class="hamburger" onclick="toggleMenu()"> &#9776;</div>
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
<body>
    <h1><span>Course Schedule</span></h1>
    <br>
    <br>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, 
        td {
            width: calc(100% / 3);
        }
    </style>

    <table border="1">
        <th>Time</th>
        <th>Course ID</th>
        <th>Faculty</th>
        {% for row in csv_data %}
        <tr>
            {% for col in row %}
                {% if col == "1" %}
                    
                {% elif col == "m800" %}
                    <td>MWF at 8:00 AM</td>
                {% elif col == "m930" %}
                    <td>MWF at 9:30 AM</td>
                {% elif col == "m1100" %}
                    <td>MWF at 11:00 AM</td>
                {% elif col == "m200" %}
                    <td>MWF at 2:00 PM</td>
                {% elif col == "m330" %}
                    <td>MWF at 3:30 PM</td>

                {% elif col == "t830" %}
                    <td>TTH at 8:30 AM</td>
                {% elif col == "t1000" %}
                    <td>TTH at 10:00 AM</td>
                {% elif col == "t1130" %}
                    <td>TTH at 11:30 AM</td>
                {% elif col == "t100" %}
                    <td>TTH at 1:00 PM</td>
                {% elif col == "t230" %}
                    <td>TTH at 2:30 PM</td>
                {% else %}
                    <td>{{ col }}</td>
                {% endif %}
            {% endfor %}
        </tr>
        {% endfor %}
    </table>
    <form method="post" action="swap">
    <label for="course">Choose a course to swap:</label>
    <select id="course" name="course">
        <option value="CS2">CS2</option>
    </select> 
    <label for="time">When will it be taught:</label>
    <select id="time" name="time">
        <option value="m200">m200</option>
    </select> 
    <input type="submit" value="submit" name="submit"/>
    </form>
</body>

</html>
