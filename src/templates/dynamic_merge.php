<!DOCTYPE html>
<html>

<head>
    <!-- Title Of Page -->
    <title>Create CSV</title>
    <!-- Script for creating CSVs -->
    <script src="{{url_for('static', filename='scripts/createCSV.js')}}"></script>
    <!-- Script for faculty restrictions -->
    <script type="text/javascript" src="scripts/faculty_script.js"></script>
    <!-- Firebase library  -->
    <script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='css/style.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <div id="headerBar">
            <!-- Hamburger menu  -->
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

    <h1 style="padding-top: 40px;"> Create CSV </h1>

    <button class="button-style6" style="margin-right: 25px" onclick="addToDB()">Next</button>
    <button class="button-style6" style="margin-right: 15px" onclick="tableToCSV()">Save as CSV</button>

    <!---------------------------- Course dynamic table ---------------------------->
    <h4><span>Course Table</span></h4>
    <!-- https://stackoverflow.com/questions/3487263/how-to-use-onclick-or-onselect-on-option-tag-in-a-jsp-page -->
    <div class="divScroll">
        <!-- Clear Table Button  -->
        <button class="button-style5" onclick="clearTable('course-table')">Clear Table</button>
        <!-- <button class="button-style5" onclick="addToDB()">Add to Firebase</button> -->
        <!-- Add Row Button  -->
        <button class="button-style5" onclick="addRow()">Add Row</button>
        <!-- Dropdown menu to add a new course from previous  -->
        <select id='addCourseRow' onchange="addRowFromKey(this.value);">
            <option value=''>New Course</option>
        </select>
        <!--<button class="button-style5" onclick="tableToCSV()">Save as CSV</button>-->
    </div>
    <table id="course-table">
        <tr>
            <th></th>
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
    <script>
        addRow(); // Start with one empty row
        // Source help: https://www.w3schools.com/jsref/met_table_insertrow.asp

        /**
         * Adds a new row to the course table.
         * @param fullName Full name of course
         * @param abbrName Abbreviated name of the course
         * @param meeting_hours If the course meets for 4 Hours
         * @param sections NUmber of sections for the course
         */
        function addRow(fullName = "", abbrName = '', meeting_hours = "FALSE", sections = '') {
            var table = document.getElementById("course-table");
            var rowCount = table.rows.length;
            var row = table.insertRow(table.rows.length);
            if (rowCount < 21) {
                // Remove
                var cellRemove = row.insertCell(0);
                cellRemove.innerHTML = '<button type="button" onclick="deleteRow(this)">-</button>';

                // Class name
                var cell2 = row.insertCell(1);
                cell2.innerHTML = "<input type='text' id='newCourse' name='newCourse' placeholder='Enter New Course' value = \"" + fullName + "\">";

                // Abbreviation
                var cell3 = row.insertCell(2);
                cell3.innerHTML = "<input type='text' id='abbreviation' name='abbreviation' placeholder='Enter Course Abbreviation' value = " + abbrName + ">";
                // 4 Contact Hours
                var selected = '';
                // If 4 contact hour is selected in DB
                if (meeting_hours !== "FALSE")
                    selected = 'selected';
                var cell4 = row.insertCell(3);
                cell4.innerHTML = "<select name='meeting_hours' id='meeting'>" +
                    "<option value='FALSE'>No</option>" +
                    "<option value='TRUE'" + selected + ">Yes</option>" +
                    "</select>";

                // Sections
                var cell5 = row.insertCell(4);
                cell5.innerHTML = "<input type='number' id='sections' name='sections' placeholder='Number of Sections' min='1'value = " + sections + ">";

                // Unavailable Times
                var cell6 = row.insertCell(5);
                cell6.className = "scrollable-cell";
                cell6.innerHTML =
                    "<fieldset><div>MWF <label for='m800'><input type='checkbox' id='m800' name='m800' value='m800'>8:00</label>" +
                    "<label for='m930'><input type='checkbox' id='m930' name='m930' value='m930'>9:30</label>" +
                    "<label for='m1100'><input type='checkbox' id='m1100' name='m1100' value='m1100'>11:00</label>" +
                    "<label for='m200'><input type='checkbox' id='m200' name='m200' value='m200'>2:00</label>" +
                    "<label for='m330'><input type='checkbox' id='m330' name='m330' value='m330'>3:30</label></div>" +
                    "<hr class='day-separator'> <!-- This is the line separator -->" +
                    "<div>TTh <label for='t830'><input type='checkbox' id='t830' name='t830' value='t830'>8:30</label>" +
                    "<label for='t1000'><input type='checkbox' id='t1000' name='t1000' value='t1000'>10:00</label>" +
                    "<label for='t1130'><input type='checkbox' id='t1130' name='t1130' value='t1130'>11:30</label>" +
                    "<label for='t100'><input type='checkbox' id='t100' name='t100' value='t100'>1:00</label>" +
                    "<label for='t230'><input type='checkbox' id='t230' name='t230' value='t230'>2:30</label></div></fieldset>";

                // CourseID
                var cell7 = row.insertCell(6);
                cell7.innerHTML = "<input type='text' id='CourseID' name='CourseID' placeholder='Enter Course ID' value = " + abbrName + sections + ">";

                // Add button            
                var cellAdd = row.insertCell(7);
                cellAdd.innerHTML = "<button class='button-style5' onclick='addColumn(this.parentNode.parentNode)'>Add Conflicting Course </button>";
                cellAdd.style.border = "none";
            }
            else {
                alert("Cannot add more than 20 rows")
            }
            // Fill course select
            // Reset select after click
            document.getElementById("addCourseRow").options[0].selected = 'selected';
        }
    </script>
</body>
<!---------------------------- Faculty dynamic table ---------------------------->

<body>
    <h4><span>Faculty Table</span></h4>
    <div class="divScroll">
        <button class="button-style5" onclick="clearTable('faculty-table')">Clear Table</button>
        <button class="button-style5" onclick="addRowFac()">Add Row</button>
        <!-- <button class="button-style5" onclick="addToDBFac()">Add to Firebase</button> -->
    </div>
    <table id="faculty-table">
        <tr>
            <th style="width: 25px"></th>
            <th style="width: 350px">Professor Name</th>
            <th style="width: 100px">Prime time</th>
            <th style="width: 300px">Classes</th>
            <th style="width: 300px">Unavailable Times</th>
        </tr>
    </table>
    </div>
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
            cell1.innerHTML = "<input type='text' id='facultyName' name='facultyName' class='input-style' placeholder='Enter Faculty Name'>";

            // Prime time
            var cell2 = row.insertCell(2);
            cell2.innerHTML = "<select name='primetime'>" +
                "<option value='TRUE'>No</option>" +
                "<option value='FALSE'>Yes</option>" +
                "</select>";


            //unavailable times
            var cell3 = row.insertCell(3);
            //cell3.innerHTML = "<input type='text' id='courses' name='courses' style='width: 200px' placeholder='Course Abbreviation Taught' autocomplete='off' onclick='addRow()'>";
            cell3.innerHTML = "<input type='text' id='courses' name='courses' style='width: 200px' placeholder='Course Abbreviation Taught'>";


            // Classes                  
            // TODO check if course exist in database and or in course table above
            // TODO could make value uppercase to simplify the check
            // Unavailable Times
            var cell4 = row.insertCell(4);

            //cell3.innerHTML = "<input type='text' id='courses' name='courses' style='width: 200px' placeholder='Course Abbreviation Taught' autocomplete='off' onclick='addRow()'>";
            cell4.innerHTML = "<input type='text' id='courses' name='courses' style='width: 200px' placeholder='Course Abbreviation Taught'>";

            cell4.className = "scrollable-cell";
            cell4.innerHTML =
                "<fieldset><div>MWF <label for='m800'><input type='checkbox' id='m800' name='m800' value='m800'>8:00</label>" +
                "<label for='m930'><input type='checkbox' id='m930' name='m930' value='m930'>9:30</label>" +
                "<label for='m1100'><input type='checkbox' id='m1100' name='m1100' value='m1100'>11:00</label>" +
                "<label for='m200'><input type='checkbox' id='m200' name='m200' value='m200'>2:00</label>" +
                "<label for='m330'><input type='checkbox' id='m330' name='m330' value='m330'>3:30</label></div>" +
                "<hr class='day-separator'> <!-- This is the line separator -->" +
                "<div>TTh <label for='t830'><input type='checkbox' id='t830' name='t830' value='t830'>8:30</label>" +
                "<label for='t1000'><input type='checkbox' id='t1000' name='t1000' value='t1000'>10:00</label>" +
                "<label for='t1130'><input type='checkbox' id='t1130' name='t1130' value='t1130'>11:30</label>" +
                "<label for='t100'><input type='checkbox' id='t100' name='t100' value='t100'>1:00</label>" +
                "<label for='t230'><input type='checkbox' id='t230' name='t230' value='t230'>2:30</label></div></fieldset>";

            // https://www.w3schools.com/jsref/prop_node_parentnode.asp

            // Add extra courses
            var cell5 = row.insertCell(5);
            cell5.innerHTML = "<button class='button-style5' onclick='addColumn(this.parentNode.parentNode)'>Add Course Taught</button>";
            cell5.style.border = "none";
            cell5.style.width = "150px";
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

        // Need to be more than 3 row to delete (so that header rows aren't removed)
        // I changed it to 0 to fix another issue but if need be we can revert it back to 3 - Colby
        while (table.rows.length > 0) {
            table.deleteRow(2);
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
        // I also changed it to 1 to fix another issue but if need be we can revert it back to 3 - Colby
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
        if (!table) return false;
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

    //Initilize Firebase
    firebase.initializeApp(firebaseConfig);
    var database = firebase.database();

    /**
     * Function to handle course form submission and send data to Firebase.
     */
    function addToDB() {
        //Check if all required fields are filled
        if (!checkIfFilled("course-table")) {
            alert("Please fill in all fields before continuing.");
            return false;
        }
        // Function to handle form submission and send data to Firebase
        var table = document.getElementById("course-table");
        var rows = table.getElementsByTagName("tr");
        // Skip first title row
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("td");
            // var courseID = cells[6].querySelector("input").value;
            var courseID = cells[1].querySelector("input").value;
            // User selected new course
            if (courseID == '')
                // courseID = cells[2].querySelector("input").value + cells[4].querySelector("input").value; //Concate abbr and sections
                courseID = cells[1].querySelector("input").value;
            if (courseID !== '' && courseID !== 'new') {
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
            }
            else {
                alert("Please select a course from the dropdown");
                return false;
            }

        }
        //Submit faculty data to Firebase
        addToDBFac();
        //Convert the table to a CSV format
        tableToCSV();
        //Redirect to final output
        window.location.href = '{{ url_for('importpg')}}'
    }

    /**
     * Function to handle faculty form submission and send data to Firebase.
     */
    function addToDBFac() {
        if (!checkIfFilled("faculty-table")) {
            alert("Please fill in all fields before continuing.");
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
            .then(function (snapshot) {
                var courseData = snapshot.val();
                if (courseData) {
                    var courseAbbr = courseData.abbreviation;
                    var courseName = courseData.class_name;
                    var meeting_hours = courseData.contact_hours;
                    var sections = courseData.sections;
                    addRow(courseName, courseAbbr, meeting_hours, sections);
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
        var contentWrapper = document.querySelector('.content-wrapper'); //Toggle the display style between block and none
        if (menu.style.display === 'block') { //If the window is resizdd to below 750, then hide the menu
            menu.style.display = 'none';
            contentWrapper.classList.remove('menu-opened');
        } else { //Else, show it
            menu.style.display = 'block';
            contentWrapper.classList.add('menu-opened');
        }
    }
</script>
<style>
    #githublink {
        position: fixed;
        bottom: 20px;
        /* Adjust as needed */
        right: 20px;
        /* Adjust as needed */
    }
</style>
<!---------------------------- Upload CSV ---------------------------->
<!-- <h1>Upload CSV File</h1>
      <form action="/upload" method="post" enctype="multipart/form-data">
          <input type="file" name="csv_file" accept=".csv"><br><br>
          <input type="submit" value="Upload">
      </form>
      
      <div id="github-icon">
          <a href="https://github.com/MuellMark/Course-Scheduler" id="githublink">
              <img src="{{url_for('static', filename='images/github.png')}}" alt="Link to Github" id="github-icon">
          </a>
      </div> -->

</html>