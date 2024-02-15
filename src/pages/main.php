<!DOCTYPE html>
<head>
    <title>Add Course Information Form</title>
    <script defer src="https://pyscript.net/alpha/pyscript.js"></script>
    <py-env>
        - pandas
        - paths:
          - ./scripts/testScript.py
          - ./csv/courses.csv

    </py-env>
</head>
    <body>

        <h2>Add Course Information Form</h2>

        <form id="courseForm">
            <!-- There should be a drop down that lists all of the CS and Math courses with an option to add a new course -->
            <label for="courseList">Select a Course:</label>
            <select id="courseList" name="courseList">
                <!-- TODO implement a way to dynamically populate dropdown menu from previous responses -->
                <option value="test">This is fake</option>
                <?php 
                    $file = fopen("csv/courses.csv", "r");

                    while (($data = fgetcsv($file)) !== FALSE)
                        echo "<option value=\"" .$data[1]. "\">" .$data[1]. "</option>"
                ?>
            </select>
            <?php 
                    #$command = escapeshellcmd('scripts/testScript.py');
                    #$output = shell_exec($command);
                    #echo $output;
            ?>
            <py-script>

            </py-script>

            <br>
            <!-- This is the option to add a new course -->
            <label for="newCourse">Or Add a New Course:</label>
            <input type="text" id="newCourse" name="newCourse" placeholder="Enter New Course" value=<?=$_REQUEST["newCourse"]?>>

            <br>
            <!-- the abbreviation for the course, autofilled if it's a course already in drop down -->
            <label for="abbreviation">Abbreviation:</label>
            <input type="text" id="abbreviation" name="abbreviation">
            
            <br>
            <!-- a checkbox if it's a 4 contact hour course (also autofilled) -->
            <label for="contactHours">4 Contact Hour Course:</label>
            <input type="checkbox" id="contactHours" name="contactHours">

            <br>
            <!-- the number of sections offered -->
            <label for="sections">Number of Sections:</label>
            <input type="number" id="sections" name="sections" min="1">

            <br>
            <!-- a check box for all of the times to select when the course cannot be taught -->
            <label for="unavailableTimes">Times When Course Cannot Be Taught:</label>
            <input type="checkbox" id="monday" name="unavailableTimes" value="monday">
            <label for="monday">Monday</label>
            <input type="checkbox" id="tuesday" name="unavailableTimes" value="tuesday">
            <label for="tuesday">Tuesday</label>
            <input type="checkbox" id="wednesday" name="unavailableTimes" value="monday">
            <label for="wednesday">Wednesday</label>
            <input type="checkbox" id="thursday" name="unavailableTimes" value="tuesday">
            <label for="thursday">Thursday</label>
            <input type="checkbox" id="friday" name="unavailableTimes" value="tuesday">
            <label for="friday">Friday</label>

            <br>
            <!-- TODO took away submit and just made it a refresh -->
             <input type="submit" value="Submit"><br>
        </form>
        <a href="display.html">
            <button>To Scheduler</button>
        </a><br>
        <a href="main.html">
            <button>Back</button>
        </a>
        <!-- py-env fetches myscript.py and loads it into the virtual filesystem -->
        <py-script>
            print("This executes before the script file")
            newCourse = Element('newCourse').element.value
            courseList = Element('courseList').element.value
            abbreviation = Element('abbreviation').element.value
            contactHours = Element('contactHours').element.value
            from testScript import main
            main(courseList, newCourse, abbreviation, contactHours)
            print("Script file done executing")
            from testScript import courseList
            #courseList()
        </py-script>

    </body>
</html>
