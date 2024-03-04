<!DOCTYPE html>
<html>

<head>
    <title>Create CSV</title>
    <script type="text/javascript" src="scripts/createCSV.js"></script>
    <script type="text/javascript" src="scripts/faculty_script.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
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
                        <li> <a href="about-howto.php"> About/HowTo</a> </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!--Header Pic-->
        <div id="headerImage">
            <img src="./images/48430_211016_HomecomingDroneSunset-HDR_2 (1).jpg" alt="Picture Of Campus At Sunset">
        </div>
    </header>

    <h1><span>Create CSV</span></h1>

    <!---------------------------- Course dynamic table ---------------------------->

    <h4><span>Course Table</span></h4>
    <button class="button-style" onclick="addRow()">Add Row</button>
    <button class="button-style" onclick="tableToCSV()">Save as CSV</button>
    <button class="button-style" onclick="clearTable('course-table')">Clear Table</button>
    <button class="button-style" onclick="addToDB()">Add to Firebase</button>
    <button class="button-style" onclick="addColumn(this.parentNode.parentNode)"> Add Column </button>
    <br><a href="landing_page.php"></a>

    <br>

    <!-- Source help: https://www.w3schools.com/html/html_table_borders.asp -->
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    
    /* Source help: https://stackoverflow.com/questions/43954090/resize-html-table-width-based-on-screen-size 
    @media screen and (max-width: 300px) {
    table {
        width: 25%;}
    }
    */

    th, td {
        border: 1px solid #ddd;
        padding: 5px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    </style>

    <table id="course-table">
        <tr>
            <th>Remove row</th>
            <!--<th>Add row</th> -->
            <th>Class name</th>
            <th>Abbreviation</th>
            <th>4 Contact Hours</th>
            <th>Sections</th>
            <th>Unavailable Times</th>
            <th>Select CourseID</th>
        </tr>
    </table>

    <br>
    <button class="button" onclick="addRow()">Add Row</button>

    <script>
        addRow(); // Start with one empty row
        // Source help: https://www.w3schools.com/jsref/met_table_insertrow.asp

        /**
         * Adds a new row to the course table.
         */
        function addRow() {
            var table = document.getElementById("course-table");
            var rowCount = table.rows.length;
            var row = table.insertRow(table.rows.length);
            if (rowCount < 21) {
                // Remove
                var cellRemove = row.insertCell(0);
                cellRemove.innerHTML = '<button type="button" onclick="deleteRow(this)">-</button>';

                //add
                //var cellAdd = row.insertCell(1);
                //cellAdd.innerHTML = '<button type="button" onclick="addRow()">+</button>';

                // Class name
                var cell2 = row.insertCell(1);
                cell2.innerHTML = "<input type='text' id='newCourse' name='newCourse' placeholder='Enter New Course'>";

                // Abbreviation
                var cell3 = row.insertCell(2);
                cell3.innerHTML = "<input type='text' id='abbreviation' name='abbreviation'>";

                // 4 Contact Hours
                var cell4 = row.insertCell(3);
                cell4.innerHTML = "<select name='meeting_hours' id='meeting'>" +
                    "<option value='FALSE'>No</option>" +
                    "<option value='TRUE'>Yes</option>" +
                    "</select>";

                // Sections
                var cell5 = row.insertCell(4);
                cell5.innerHTML = "<input type='number' id='sections' name='sections' min='1'>";

                // Unavailable Times
                var cell6 = row.insertCell(5);
                cell6.innerHTML = "<input type='checkbox' id='monday' name='monday' value='monday'>" +
                    "<input type='checkbox' id='tuesday' name='tuesday' value='tuesday'>" +
                    "<input type='checkbox' id='wednesday' name='wednesday' value='wednesday'>" +
                    "<input type='checkbox' id='thursday' name='thursday' value='thursday'>" +
                    "<input type='checkbox' id='friday' name='friday' value='friday'>";

                // CourseID
                var cell7 = row.insertCell(6);
                cell7.innerHTML = "<select name='CourseID' id='CourseID'>" +
                    "<option value='empty'>Choose one</option>" +
                    "<option value='CS11'>CS11</option>" +
                    "<option value='CS21'>CS21</option>" +
                    "<option value='DIS1'>DIS1</option>" +
                    "</select>";

                // Add button            
                //var cellAdd = row.insertCell(8);
                //cellAdd.innerHTML = "<button class ='button-style' button onclick='addColumn(this.parentNode.parentNode)'>Add Column </button>";
                /**
                 * TODO There might be an easy way to implement this into the select row
                 * so that it dynamically fills it. A way to do it is create a new 
                 * string that will be concatenated and then placed in cell1.innerHTML
                 * 
                 * Update:
                 * I am going to leave this here but I don't think we will need to
                 * implement it like this as we can easily grab the info from firebase 
                 * and set the value attribute
                 */
                // <label for="courseList">Select a Course:</label>
                // <select id="courseList" name="courseList">
                //     <!-- TODO implement a way to dynamically populate dropdown menu from previous responses -->
                //     <option value="test">Choose one</option>
                //     <?php
                //         $file = fopen("csv/courses.csv", "r");
                
                //         while (($data = fgetcsv($file)) !== FALSE)
                //             echo "<option value=\"" .$data[1]. "\">" .$data[1]. "</option>"
                //        ?>
                // </select>
            }
            else {
                alert("Cannot add more than 20 rows")
            }
        }
    </script>
</body>

<!---------------------------- Faculty dynamic table ---------------------------->

<body>
    <br>
    <h4><span>Faculty Table</span></h4>
    <button class="button-style" onclick="addRowFac()">Add Row</button>
    <button class="button-style" onclick="tableToCSVFac()">Save as CSV</button>
    <button class="button-style" onclick="clearTable('faculty-table')">Clear Table</button>
    <button class="button-style" onclick="addToDBFac()">Add to Firebase</button>
    <br>
    <br>
    <table id="faculty-table">
        <tr>
            <th>Remove</th>
            <th>Professor Name</th>
            <th>Prime time</th>
            <th>Classes</th>
        </tr>
    </table>

    <script>
        addRowFac(); // Start with one empty row
        // addCourse(); // This does not work currently
        // Source help: https://www.w3schools.com/jsref/met_table_insertrow.asp

        /**
         * Adds a new row to the faculty table.
         */
        function addRowFac() {
            var table = document.getElementById("faculty-table");
            var row = table.insertRow(table.rows.length);

            // Remove
            var cellRemove = row.insertCell(0);
            cellRemove.innerHTML = '<button type="button" onclick="deleteRow(this)">-</button>';

            // Professor Name
            var cell1 = row.insertCell(1);
            cell1.innerHTML = "<input type='text' id='facultyName' name='facultyName' placeholder='Enter Faculty Name'>";

            // Prime time
            var cell2 = row.insertCell(2);
            cell2.innerHTML = "<select name='primetime'>" +
                "<option value='no'>No</option>" +
                "<option value='yes'>Yes</option>" +
                "</select>";

            // Classes                  
            var cell3 = row.insertCell(3);
            cell3.innerHTML = "<input type='text' id='courses' name='courses' placeholder='Enter Courses Taught'>";
            // https://www.w3schools.com/jsref/prop_node_parentnode.asp

            // Add extra courses
            var cell4 = row.insertCell(4);
            cell4.innerHTML = "<button onclick='addColumn(this.parentNode.parentNode)'>Add Column</button>";
        }
    </script>
</body>

<!---------------------------- Collection of JS scripts used to manipulate both dynamic forms ---------------------------->
<script>
    /**
     * Clears all rows from the HTML table, except the header title row.
     */
    function clearTable(table) {
        var table = document.getElementById(table);

        // Need to be more than 1 row to delete
        while (table.rows.length > 1) {
            table.deleteRow(1);
        }
    }
    /**
     * Adds a new column with an input field to the specified row.
     * @param row - The row to which the column should be added.
     */
    function addColumn(row) {
        var cell = row.insertCell(row.cells.length - 1); // Insert before the last cell
        cell.innerHTML = "<input type='text' name='courses' placeholder='Enter new course'>"; // TODO might need an ID
    }
    /**
     * Deletes specified individual row.
     * @param thisRow - The row to be deleted.
     */
    function deleteRow(thisRow) {
        var row = thisRow.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>

<!---------------------------- JavaScript used to put data into database ---------------------------->
<script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyAj2EMSoi-M8Z7SF52P23A98jPTf6r2Zpk",
        authDomain: "course-scheduler-b4f7e.firebaseapp.com",
        databaseURL: "https://course-scheduler-b4f7e-default-rtdb.firebaseio.com",
        projectId: "course-scheduler-b4f7e",
        storageBucket: "course-scheduler-b4f7e.appspot.com",
        messagingSenderId: "334389325155",
        appId: "1:334389325155:web:8f42d91a5bd7e9120fb756",
        measurementId: "G-1S979YX5DB"
    };

    firebase.initializeApp(firebaseConfig);
    var database = firebase.database();

    /**
     * Function to handle course form submission and send data to Firebase.
     */
    function addToDB() {
        // Function to handle form submission and send data to Firebase
        var table = document.getElementById("course-table");
        var rows = table.getElementsByTagName("tr");

        // Skip first title row
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("td");
            var courseID = cells[6].querySelector("select").value;

            if (courseID !== 'empty') {
                var className = cells[1].querySelector("input").value;
                var abbreviation = cells[2].querySelector("input").value;
                var contactHours = cells[3].querySelector("select").value;
                var sections = cells[4].querySelector("input").value;

                // Get the text data of each cell from weekday checkbox and push it to unavailableTimesList
                var unavailableTimes = rows[i].querySelectorAll('[type="checkbox"]:checked'); // Select all weekday checkbox that are selected
                let unavailableTimesList = [];
                for (let j = 0; j < unavailableTimes.length; j++) {
                    unavailableTimesList.push(unavailableTimes[j].value)
                }

                // Get the text data of each cell from weekday checkbox and push it to unavailableTimesList
                var courses = rows[i].querySelectorAll('[name="courses"]');
                let coursesList = [];
                for (let k = 0; k < courses.length; k++) {
                    // Get the text data of each cell from the additional courses and push it to classList
                    coursesList.push(courses[k].value);
                }
                // Push data to Firebase and map data to Firebase using CourseID as key
                // https://firebase.google.com/docs/database/web/read-and-write
                // TODO rename path
                database.ref('temp_courses/' + courseID).set({
                    class_name: className,
                    abbreviation: abbreviation,
                    contact_hours: contactHours,
                    sections: sections,
                    unavailableTimes: unavailableTimesList,
                    extraCourses: coursesList
                });
                // TODO remove this or make a better message       
                alert("Yippee it worked!");
            }
            else
                alert("Please select a course from the dropdown");
        }
    }

    /**
     * Function to handle faculty form submission and send data to Firebase.
     */
    function addToDBFac() {
        // Function to handle form submission and send data to Firebase
        var table = document.getElementById("faculty-table");
        var rows = table.getElementsByTagName("tr");

        // Skip first title row
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("td");
            var facName = cells[1].querySelector("input").value;

            // Faculty name is the key
            if (facName !== '') {
                var primeTime = cells[2].querySelector("select").value;
                // Stores each provided course given by user
                let classList = [];
                var classes = rows[i].querySelectorAll('[name="courses"]');
                for (let j = 0; j < classes.length; j++) {
                    // Get the text data of each cell from the additional courses and push it to classList
                    classList.push(classes[j].value);
                }

                // Push data to Firebase and map data to Firebase using CourseID as key
                // https://firebase.google.com/docs/database/web/read-and-write
                // TODO rename path
                database.ref('temp_faculty/' + facName).set({
                    faculty_name: facName,
                    prime_time: primeTime,
                    classes: classList
                });
                // TODO remove this or make a better message       
                alert("Yippee it worked!");
            }
            else
                alert("Please select a course from the dropdown!");
        }
    }
</script>

<!---------------------------- JavaScript used to enable hamburger menu ---------------------------->
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
<a href="https://github.com/MuellMark/Course-Scheduler" id="githublink">
    <img src="./images/github.png" alt="Link to Github" id="github-icon">
</a>

</html>