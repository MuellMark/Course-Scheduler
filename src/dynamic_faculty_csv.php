<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Course Information Form</title>
    <script type="text/javascript" src="createCSV.js"></script>
</head>
    <body>

    <h2>Dynamic Table</h2>
    <button onclick="addRow()">Add Row</button>
    <button onclick="addCourse()">Add Course Row</button>
    <button onclick="tableToCSV()">Save as CSV</button>
    <br><a href="final_schedule_result.php">
            <button>Run script</button>
    </a>
    This doesn't actually run anything yet
    <br><a href="landing_page.php">
            <button>Back</button>
    </a>


    <table id="dynamic-table">
        <tr>
            <th>Professor Name</th>
            <th>Prime time</th>
            <th>Classes</th>
        </tr>
    </table>

    <script>
        addRow(); // Start with one empty row
        // addCourse(); // This does not work currently
        // Source help: https://www.w3schools.com/jsref/met_table_insertrow.asp
        function addRow() {
            var table = document.getElementById("dynamic-table");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            /**
             * TODO There might be an easy way to implement this into the select row
             * so that it dynamically fills it. A way to do it is create a new 
             * string that will be concatenated and then placed in cell1.innerHTML
             */
            // <label for="courseList">Select a Course:</label>
            // <select id="courseList" name="courseList">
            //     <!-- TODO implement a way to dynamically populate dropdown menu from previous responses -->
            //     <option value="test">Choose one</option>
            //     <?php 
            //         $file = fopen("csv/courses.csv", "r");

            //         while (($data = fgetcsv($file)) !== FALSE)
            //             echo "<option value=\"" .$data[1]. "\">" .$data[1]. "</option>"
            //     ?>
            // </select>
            cell1.innerHTML = "<input type='text' id='facultyName' name='facultyName' placeholder='Enter Faculty Name'>";
            cell2.innerHTML = "<select name='primetime'>" +
                                "<option value='no'>No</option>" +
                                "<option value='yes'>Yes</option>" +
                                "</select>";
            // TODO find a better way to input more courses
            cell3.innerHTML = "<input type='text' id='courses' name='courses' placeholder='Enter Courses Taught'>";
        }
        function addCourse() {
            var table = document.getElementById("dynamic-table");
            var row = table.insertRow(table.rows.length);
            var cell4 = row.insertCell(4);
            cell4.innerHTML = "<input type='text' id='courses' name='courses' placeholder='Enter Courses Taught'>";
        }
    </script>

    </body>
</html>
