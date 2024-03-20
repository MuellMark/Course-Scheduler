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
                        <li> <a href="about-howto.php"> How To Guides</a> </li>
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
    <!--<button class="button-style" onclick="addRow()">Add Row</button> -->
    <button class="button-style" onclick="tableToCSV()">Save as CSV</button>
    <!--<button class="button-style" onclick="clearTable('course-table')">Clear Table</button>-->
    <button class="button-style" onclick="addToDB()">Add to Firebase</button>
    <!-- <button class="button-style" onclick="getDBKeys()">getDBKeys</button> -->
    <!-- https://stackoverflow.com/questions/3487263/how-to-use-onclick-or-onselect-on-option-tag-in-a-jsp-page -->
    <!-- TODO create a function that grabs the necessary values based on selected-->
    <select name='addCourseRow' id='addCourseRow' onchange="addRowFromKey(this.value);">
        <option value=''>Add new course</option>
        <option value=''>New course</option>
    </select>
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

    <div class="divScroll">
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
    </div>

    <br>
    
    <button class="button" onclick="addRow()" style="float: right; margin-right: 15px; background-color: #ffcb08; font-family: 'lustria', serif">Add Row</button>
    <button class="button" onclick="clearTable('course-table')" style="float: right; margin-right: 15px; background-color: #ffcb08; font-family: 'lustria', serif">Clear Table</button>

    <script>
        addRow(); // Start with one empty row
        // Source help: https://www.w3schools.com/jsref/met_table_insertrow.asp

        /**
         * Adds a new row to the course table.
         */
        function addRow(fullName = "", abbrName = '', meeting_hours = "FALSE") {
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
                cell2.innerHTML = "<input type='text' id='newCourse' name='newCourse' placeholder='Enter New Course' value = \"" + fullName +"\">";

                // Abbreviation
                var cell3 = row.insertCell(2);
                cell3.innerHTML = "<input type='text' id='abbreviation' name='abbreviation' value = " + abbrName +">";

                // 4 Contact Hours
                var selected = '';
                // If 4 contact hour is selected in DB
                if(meeting_hours !== "FALSE")
                    selected = 'selected';
                var cell4 = row.insertCell(3);
                cell4.innerHTML = "<select name='meeting_hours' id='meeting'>" +
                    "<option value='FALSE'>No</option>" +
                    "<option value='TRUE'" +  selected +  ">Yes</option>" +
                    "</select>";

                // Sections
                var cell5 = row.insertCell(4);
                cell5.innerHTML = "<input type='number' id='sections' name='sections' min='1'>";

                // Unavailable Times
                // TODO need to fix this and make it match the script
                var cell6 = row.insertCell(5);
                cell6.innerHTML = "<div><input type='checkbox' id='m800' name='m800' value='m800'>" +
                    "<input type='checkbox' id='m930' name='m930' value='m930'>" +
                    "<input type='checkbox' id='m1100' name='m1100' value='m1100'>" +
                    "<input type='checkbox' id='m200' name='m200' value='m200'>" +
                    "<input type='checkbox' id='m330' name='m330' value='m330'></div><div>" +
                    "<input type='checkbox' id='t830' name='t830' value='t830'>" +
                    "<input type='checkbox' id='t1000' name='t1000' value='t1000'>" +
                    "<input type='checkbox' id='t1130' name='t1130' value='t1130'>" +
                    "<input type='checkbox' id='t100' name='t100' value='t100'>" +
                    "<input type='checkbox' id='t230' name='t230' value='t230'></div>";

                // CourseID
                var cell7 = row.insertCell(6);
                // This includes the add funcitionality from the drop down above
                //cell7.innerHTML = "<select name='CourseID' id='CourseID' onchange=\"addRow(this.value);\">" +

                
                //getDBKeys(cell7);
                cell7.innerHTML = "<select name='CourseID' id='CourseID'>" +
                    "<option value='empty'>Choose one</option>" +
                    "<option value='new'>New course</option>" +
                    "</select>";

                // Add button            
                var cellAdd = row.insertCell(7);
                cellAdd.innerHTML = "<button button onclick='addColumn(this.parentNode.parentNode)'>Add Conflicting Course </button>";
                cellAdd.style.border = "none";
            }
            else {
                alert("Cannot add more than 20 rows")
            }
            // Fill course select
            //getDBKeys(this.parentNode.parentNode);
            // Reset select after click
            document.getElementById("addCourseRow").options[0].selected = 'selected';
        }
    </script>
</body>

<!---------------------------- Faculty dynamic table ---------------------------->

<body>
    <br>
    <h4><span>Faculty Table</span></h4>
    <!--<button class="button-style" onclick="addRowFac()">Add Row</button>-->
    <!--<button class="button-style" onclick="tableToCSVFac()">Save as CSV</button>-->
    <!--<button class="button-style" onclick="clearTable('faculty-table')">Clear Table</button>-->
    <!--<button class="button-style" onclick="addToDBFac()">Add to Firebase</button>-->
    <br>
    <br>
    <div class="divScroll">
    <table id="faculty-table">
        <tr>
            <th>Remove</th>
            <th>Professor Name</th>
            <th>Prime time</th>
            <th>Classes</th>
        </tr>
    </table>
    </div>

    <button class="button" onclick="addRow()" style="float: right; margin-right: 15px; margin-top: 20px; background-color: #ffcb08; font-family: 'lustria', serif">Add Row</button>
    <button class="button" onclick="clearTable('course-table')" style="float: right; margin-right: 15px; margin-top: 20px; background-color: #ffcb08; font-family: 'lustria', serif">Clear Table</button>
    <br>
    <br>


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
            // TODO check if course exist in database and or in course table above
            // TODO could make value uppercase to simplify the check
            var cell3 = row.insertCell(3);
            cell3.innerHTML = "<input type='text' id='courses' name='courses' placeholder='Course Abbreviation Taught'>";
            // https://www.w3schools.com/jsref/prop_node_parentnode.asp

            // Add extra courses
            var cell4 = row.insertCell(4);
            cell4.innerHTML = "<button onclick='addColumn(this.parentNode.parentNode)'>Add Course Taught</button>";
            cell4.style.border = "none";
        }
    </script>
</body>

<!---------------------------- Collection of JS scripts used to manipulate both dynamic forms ---------------------------->
<script>
    /**
     * Clears all rows from the HTML table, except the header title row and first row.
     */
    function clearTable(table) {
        var table = document.getElementById(table);

        // Need to be more than 1 row to delete
        while (table.rows.length > 2) {
            table.deleteRow(1);
        }
    }
    /**
     * Adds a new column with an input field to the specified row.
     * @param row - The row to which the column should be added.
     */
    function addColumn(row) {
        var cell = row.insertCell(row.cells.length - 1); // Insert before the last cell
        cell.innerHTML = "<input type='text' name='courses' placeholder='Enter new course'>";
    }
    /**
     * Deletes specified individual row.
     * @param thisRow - The row to be deleted.
     */
    function deleteRow(thisRow) {
        var row = thisRow.parentNode.parentNode;
        var table = row.parentNode;
        var rowCount = table.rows.length;

        //Check if the table has more than 2 rows 
        if (rowCount > 2) {
            table.removeChild(row);
        }
        else {
            alert("At least one row is required.")
        }

    }

    /**
     * Check if all required fields are filled in table
     * @param tableId - Get ID of table
     * @returns boolena - Ture if all required fields are filled
     */
    function checkIfFilled(tableId) {
        var table = document.getElementById(tableId);
        var rows = table.getElementsByTagName("tr");
        //Start from row 1, and not the the header row
        for (var i = 1; i < rows.length; i++) {
            var inputs = rows[i].querySelectorAll("input[type='text'], input[type='number'], select");
            for (var j = 0; j < inputs.length; j++) {
                var input = inputs[j];
                //Check if Select Course ID is filled
                //Check if select is not selected
                if ((input.tagName === "SELECT" && input.value === "empty")
                    //Check if empty
                    || (input.type === "text" && input.value.trim() === "")
                    //Check if the number inputs are empty
                    || (input.type === "number" && input.value.trim() === "")) {
                    return false;
                }
            }
        }
        //All fields are filled
        return true;
    }
</script>

<!---------------------------- JavaScript used to put data into database ---------------------------->
<script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
<script>
    //import { getDatabase, ref, get } from "firebase/database";
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

        if (!checkIfFilled("course-table")) {
            alert("Please fill in all fields before adding to Firebase.");
            return false;
        }
        // Function to handle form submission and send data to Firebase
        var table = document.getElementById("course-table");
        var rows = table.getElementsByTagName("tr");

        // Skip first title row
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("td");
            var courseID = cells[6].querySelector("select").value;
            // User selected new course
            if(courseID == 'new')
                courseID = cells[2].querySelector("input").value + cells[4].querySelector("input").value; //Concate abbr and sections

            if (courseID !== 'empty' && courseID !== 'new') {
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
        if (!checkIfFilled("faculty-table")) {
            alert("Please fill in all fields before adding to Firebase.");
            return false;
        }
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
    /*
        Description:
        This function retrieves courseID values from the Firebase Database and 
        populates a dropdown list with these keys. 
        These values populate two different dropdown lists ('CourseID' and 'addCourseRow').

        Dependencies:
        - Firebase Database reference
        - HTML elements: 'course-table', 'CourseID', and 'addCourseRow'
    */
    // https://stackoverflow.com/questions/48152556/how-to-retrieve-data-from-firebase-using-javascript
    // More help: https://firebase.google.com/docs/database/web/read-and-write#web-modular-api
    function getDBKeys(cell7) {
        let dbKeys = [];
        const dataTable = document.getElementById('course-table').getElementsByTagName('tbody')[0];
        var ref = firebase.database().ref('temp_courses');

        ref.once('value')
        .then((snapshot) => {
            const data = snapshot.val();
            if (data) {
            Object.keys(data).forEach((key) => {
                if (!(key in dbKeys)) {
                    dbKeys.push(key);
                }
            });
            } 
                //dbKeys.forEach((element) => addRow(element)); // Used for debugging

                // Caution: I know this is inefficient but there needs
                // to be two loops because if not they will overwrite each other - Colby
                // TODO if we decide to get rid of one drop down then please remove it here as well
                const dropdown = document.getElementById('CourseID');
                // Loop through the array and create option elements from keys
                for (let i = 0; i < dbKeys.length; i++) {
                    const option = document.createElement('option');
                    option.text = dbKeys[i];
                    dropdown.add(option);
                }   

                const courseAdd = document.getElementById('addCourseRow');
                for (let i = 0; i < dbKeys.length; i++) {
                    const option = document.createElement('option');
                    option.text = dbKeys[i];
                    courseAdd.add(option);
            }
        })
    }


    /*
    Description:
    This function retrieves data from a Firebase Database using 
    the provided courseID key and then adds a row to the table 
    using the selected data.

    Parameters:
    - courseID: The courseID key passed from the add course drop down.
    */
    function addRowFromKey(courseID) {
        // Reference to the Firebase database path
        var ref = firebase.database().ref("temp_courses/" + courseID);
        ref.once('value')
            .then(function(snapshot) {
            var courseData = snapshot.val();
            if (courseData) {
                var courseAbbr = courseData.abbreviation;
                var courseName = courseData.class_name;
                var meeting_hours = courseData.contact_hours;
                addRow(courseName, courseAbbr,meeting_hours);
                }
            })
    }
    // On window start fill key array
    window.onload = getDBKeys();
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

<style>
    #githublink {
        position: fixed;
        bottom: 20px; /* Adjust as needed */
        right: 20px; /* Adjust as needed */
    }
</style>

<a href="https://github.com/MuellMark/Course-Scheduler" id="githublink">
    <img src="./images/github.png" alt="Link to Github" id="github-icon">
</a>

</html>