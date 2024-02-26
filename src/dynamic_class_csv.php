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
            <th>Remove row</th>
            <th>Class name</th>
            <th>Abbreviation</th>
            <th>4 Contact Hours</th>
            <th>Sections</th>
            <th>Unavailable Times</th>
            <th>Select CourseID</th>
        </tr>
    </table>

    <script>
        addRow(); // Start with one empty row
        // Source help: https://www.w3schools.com/jsref/met_table_insertrow.asp
        function addRow() {
            var table = document.getElementById("dynamic-table");
            var row = table.insertRow(table.rows.length);
            // Remove 	Class name 	Abbreviation 	4 Contact Hours 	Sections 	Unavailable Times 	Select CourseID
            var cellRemove = row.insertCell(0);
            cellRemove.innerHTML = '<button type="button" onclick="deleteRow(this)">-</button>';
            var cell2 = row.insertCell(1);
            cell2.innerHTML = "<input type='text' id='newCourse' name='newCourse' placeholder='Enter New Course'>";
            var cell3 = row.insertCell(2);
            cell3.innerHTML = "<input type='text' id='abbreviation' name='abbreviation'>";
            var cell4 = row.insertCell(3);
            cell4.innerHTML = "<select name='meeting_hours' id='meeting'>" +
                                "<option value='FALSE'>No</option>" +
                                "<option value='TRUE'>Yes</option>" +
                                "</select>";
            var cell5 = row.insertCell(4);
            cell5.innerHTML = "<input type='number' id='sections' name='sections' min='1'>";
            var cell6 = row.insertCell(5);
            cell6.innerHTML = "<input type='checkbox' id='monday' name='monday' value='monday'>"+
                                "<input type='checkbox' id='tuesday' name='tuesday' value='tuesday'>"+
                                "<input type='checkbox' id='wednesday' name='wednesday' value='wednesday'>"+
                                "<input type='checkbox' id='thursday' name='thursday' value='thursday'>"+
                                "<input type='checkbox' id='friday' name='friday' value='friday'>";
            var cell7 = row.insertCell(6);
            cell7.innerHTML = "<select name='CourseID' id='CourseID'>" +
                            "<option value='empty'>Choose one</option>" +
                            "<option value='CS11'>CS11</option>" +
                            "<option value='CS21'>CS21</option>" +
                            "<option value='DIS1'>DIS1</option>" +
                          "</select>";
            var cellAdd = row.insertCell(7);
            cellAdd.innerHTML = "<button onclick='addColumn(this.parentNode.parentNode)'>Add Column</button>";
            // TODO Need to implement a remove course column button
            
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
            
        }
        function addColumn(row) {
            var cell = row.insertCell(row.cells.length - 1); // Insert before the last cell (actions cell)
            cell.innerHTML = "<input type='text' name='courses' placeholder='Enter new course'>"; // TODO might need an ID
        }
        function deleteRow(thisRow) {
            var row = thisRow.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>

    </body>
</html>
