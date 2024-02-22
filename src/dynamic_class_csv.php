<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="createCSV.js"></script>
    <title>Add Course Information Form</title>
</head>
    <body>

    <h2>Dynamic Table</h2>
    <button onclick="addRow()">Add Row</button>
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
            <th>Select CourseID</th>
            <th>Class name</th>
            <th>Abbreviation</th>
            <th>4 Contact Hours</th>
            <th>Sections</th>
            <th>Unavailable Times</th>
        </tr>
    </table>

    <script>
        addRow(); // Start with one empty row
        // Source help: https://www.w3schools.com/jsref/met_table_insertrow.asp
        function addRow() {
            var table = document.getElementById("dynamic-table");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cellDelete = row.insertCell(6);


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
            cell1.innerHTML = "<select name='CourseID'>" +
                            "<option value='empty'>Choose one</option>" +
                            "<option value='CS11'>CS11</option>" +
                            "<option value='CS21'>CS21</option>" +
                            "<option value='DIS1'>DIS1</option>" +
                          "</select>";
            cell2.innerHTML = "<input type='text' id='newCourse' name='newCourse' placeholder='Enter New Course'>";
            cell3.innerHTML = "<input type='text' id='abbreviation' name='abbreviation'>";
            cell4.innerHTML = "<select name='meeting_hours'>" +
                                "<option value='no'>No</option>" +
                                "<option value='yes'>Yes</option>" +
                                "</select>";
            cell5.innerHTML = "<input type='number' id='sections' name='sections' min='1'>";
            // TODO these are unreadable as to what each one is
            cell6.innerHTML = "<input type='checkbox' id='monday' name='monday' value='monday'>"+
                                "<input type='checkbox' id='tuesday' name='tuesday' value='tuesday'>"+
                                "<input type='checkbox' id='wednesday' name='wednesday' value='wednesday'>"+
                                "<input type='checkbox' id='thursday' name='thursday' value='thursday'>"+
                                "<input type='checkbox' id='friday' name='friday' value='friday'>";
            cellDelete.innerHTML = '<button type="button" onclick="deleteRow(this)">Remove Row</button>';
            
        }
        function deleteRow(thisRow) {
            var row = thisRow.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>

    </body>
</html>
