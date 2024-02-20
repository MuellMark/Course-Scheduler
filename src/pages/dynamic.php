<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Course Information Form</title>
</head>
    <body>

    <h2>Dynamic Table</h2>
    <button onclick="addRow()">Add Row</button>
    <button >Save as CSV</button>

    <table id="dynamic-table">
        <tr>
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
            var cell6 = row.insertCell(4);
            var cell7 = row.insertCell(4);
            var cell8 = row.insertCell(4);
            var cell9 = row.insertCell(4);

            cell1.innerHTML = "<input type='text' id='newCourse' name='newCourse' placeholder='Enter New Course'>";
            cell2.innerHTML = "<input type='text' id='abbreviation' name='abbreviation'>";
            cell3.innerHTML = "<input type='checkbox' id='contactHours' name='contactHours'>";
            cell4.innerHTML = "<input type='number' id='sections' name='sections' min='1'>";
            // TODO need to fix unavailable format
            cell5.innerHTML = "<input type='checkbox' id='monday' name='monday' value='monday'>";
            cell6.innerHTML = "<input type='checkbox' id='tuesday' name='tuesday' value='tuesday'>";
            cell7.innerHTML = "<input type='checkbox' id='wednesday' name='wednesday' value='wednesday'>";
            cell8.innerHTML = "<input type='checkbox' id='thursday' name='thursday' value='thursday'>";
            cell9.innerHTML = "<input type='checkbox' id='friday' name='friday' value='friday'>";
        }
    </script>

    </body>
</html>
