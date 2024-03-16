<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Course Information Form</title>
    <script type="text/javascript" src="scripts/faculty_script.js"></script>
</head>
<body>
    
    <!-- Source help: https://www.w3schools.com/html/html_table_borders.asp -->
    <!-- table styling -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            align-items: center;
        }

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

    <h1>Dynamic Table</h1>
    <br><a href="final_schedule_result.php">
        <button>Run script</button>
    </a>
    This doesn't actually run anything yet
    <br>

    <table id="dynamic-table">
        <tr>
            <th>Professor Name</th>
            <th>Prime time</th>
            <th>Classes</th>
        </tr>
    </table>

    <br>
    <a href="landing_page.php">
        <button>Return Home</button>
    </a>
    <button onclick="addRow()">Add Row</button>
    <button onclick="tableToCSV()">Save as CSV</button>

    <script>
        addRow(); // Start with one empty row
        // addCourse(); // This does not work currently
        // Source help: https://www.w3schools.com/jsref/met_table_insertrow.asp
        function addRow() {
            var table = document.getElementById("dynamic-table");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            cell1.innerHTML = "<input type='text' id='facultyName' name='facultyName' placeholder='Enter Faculty Name'>";
            var cell2 = row.insertCell(1);
            cell2.innerHTML = "<select name='primetime'>" +
                                "<option value='no'>No</option>" +
                                "<option value='yes'>Yes</option>" +
                                "</select>";
            var cell3 = row.insertCell(2);
            cell3.innerHTML = "<input type='text' id='courses' name='courses' placeholder='Enter Courses Taught'>";
            // https://www.w3schools.com/jsref/prop_node_parentnode.asp
            var cell4 = row.insertCell(3);
            cell4.innerHTML = "<button onclick='addColumn(this.parentNode.parentNode)'>Add Column</button>";
            cell4.style.border = "none";
        }

        function addColumn(row) {
            var cell = row.insertCell(row.cells.length - 1); // Insert before the last cell (actions cell)
            cell.innerHTML = "<input type='text' name='courses' placeholder='Enter Courses Taught'>"; // TODO might need an ID
        }
    </script>

</body>
</html>
