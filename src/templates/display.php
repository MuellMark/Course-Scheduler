<!DOCTYPE html>
<html>


<head>
    <title>Create CSV</title>
    <script src="{{url_for('static', filename='scripts/createCSV.js')}}"></script>
    <script type="text/javascript" src="scripts/faculty_script.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
    <script src="{{url_for('static', filename='scripts/confetti.js')}}"></script>
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
            width: calc(100% / 9);
        }
    </style>

    <table id="optimalTable" border="1">
        <th>Time</th>
        <th>Course Col 1</th>
        <th>Faculty</th>
        <th>Course Col 2</th>
        <th>Faculty</th>
        <!-- <th>Course Col 3</th>
        <th>Faculty</th>
        <th>Course Col 4</th>
        <th>Faculty</th> -->
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
    <form method="post" action="force">
    <label for="course">Choose a course to force:</label>
    <!-- <select id="courseMenu" name="courseMenu"> -->
    <div id="courseMenu"></div>
    
    <label for="time">When will it be taught:</label>
    <!-- <select id="timeMenu" name="timeMenu"> -->
    <!-- <div id="timeMenu"></div> -->
    <select id="time" name="time">
        <option value="m800">MWF at 8:00 AM</option>
        <option value="m930">MWF at 9:30 AM</option>
        <option value="m1100">MWF at 11:00 AM</option>
        <option value="m200">MWF at 2:00 PM</option>
        <option value="m330">MWF at 3:30 PM</option>
        <option value="t830">TTH at 8:30 AM</option>
        <option value="t1000">TTH at 10:00 AM</option>
        <option value="t1130">TTH at 11:30 AM</option>
        <option value="t100">TTH at 1:00 PM</option>
        <option value="t230">TTH at 2:30 PM</option>
    </select> 
    <input type="submit" value="submit" name="submit"/>
    </form>
    <!-- <form method="post" action="swap">
    <label for="firstcourse">Swap courses</label>
    <div id="firstcourse"></div>
    <label for="secondcourse">Swap courses</label>
    <div id="secondcourse"></div>
    <input type="submit" value="submit" name="submit"/>
    </form> -->
    <script>
         const start = () => {
            setTimeout(function () {
                confetti.start()
            }, 1000); // After 1 second start the confetti
        };

        const stop = () => {
            setTimeout(function () {
                confetti.stop()
            }, 5000); // After 5 second stop the confetti
        };
        // after this here we are calling both the function so it works
        start();
        stop();
        function playSound() {
            const audio = new Audio("{{url_for('static', filename='confetti.mp3')}}"); // Replace 'path_to_your_sound_file.mp3' with the actual path to your sound file
            audio.play();
        }
        window.onload = playSound;

        // https://www.geeksforgeeks.org/how-to-access-tr-element-from-table-using-javascript/
        function createSelectFromColumn(tableId, columnIndex,containerType,selectId) {
        // Get the table element
        const table = document.getElementById(tableId);
        
        // Create the select element
        const select = document.createElement('select');
        select.id = selectId;
        select.name = selectId;
        
        // Loop through the rows in the table starting from the second row (index 1)
        for (let i = 1; i < table.rows.length; i++) {
            const row = table.rows[i];
            
            // Get the cell in the specified column index
            const cell = row.cells[columnIndex];
            
            // Create an option element for the cell value
            const option = document.createElement('option');
            option.value = cell.textContent.trim();
            option.textContent = cell.textContent.trim();
            
            // Append the option to the select element
            select.appendChild(option);
        }
        
        // Append the select element to the specified container
        const selectContainer = document.getElementById(containerType);
        selectContainer.appendChild(select);
        
        // Return the created select element
        return select;
        }

        // createSelectFromColumn('optimalTable', 0, 'timeMenu','time');
        createSelectFromColumn('optimalTable', 1, 'courseMenu','course');

        // createSelectFromColumn('optimalTable', 1, 'firstcourse','course1');
        // createSelectFromColumn('optimalTable', 1, 'secondcourse','course2');

  </script>
    <!-- <form method="post" action="force">
    <label for="course">Choose a course to swap:</label>
    <select id="course" name="course">
        <option value="CS2">CS2</option>
    </select> 
    <label for="time">When will it be taught:</label>
    <select id="time" name="time">
        <option value="m200">m200</option>
    </select> 
    <input type="submit" value="submit" name="submit"/>
    </form> -->
</body>

</html>
