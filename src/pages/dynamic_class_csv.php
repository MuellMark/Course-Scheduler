<!DOCTYPE html>
<html lang="en">
<head>
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
            
        }
        // https://www.geeksforgeeks.org/how-to-export-html-table-to-csv-using-javascript/
        // Taken from this website but will be modified to fit our tasks
        function tableToCSV() {
 
            // Variable to store the final csv data
            let csv_data = [];
 
            // Get each row data
            let rows = document.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
 
                // Get each column data
                let cols = rows[i].querySelectorAll('td,th');
 
                // Stores each csv row data
                let csvrow = [];
                for (let j = 0; j < cols.length; j++) {
 
                    // Get the text data of each cell
                    // of a row and push it to csvrow
                    csvrow.push(cols[j].innerHTML);
                }
 
                // Combine each column value with comma
                csv_data.push(csvrow.join(","));
            }
 
            // Combine each row data with new line character
            csv_data = csv_data.join('\n');
 
            // Call this function to download csv file  
            downloadCSVFile(csv_data);
 
        }
 
        function downloadCSVFile(csv_data) {
 
            // Create CSV file object and feed
            // our csv_data into it
            CSVFile = new Blob([csv_data], {
                type: "text/csv"
            });
 
            // Create to temporary link to initiate
            // download process
            let temp_link = document.createElement('a');
 
            // Download csv file
            temp_link.download = "test.csv";
            let url = window.URL.createObjectURL(CSVFile);
            temp_link.href = url;
 
            // This link should not be displayed
            temp_link.style.display = "none";
            document.body.appendChild(temp_link);
 
            // Automatically click the link to
            // trigger download
            temp_link.click();
            document.body.removeChild(temp_link);
        }
    </script>
    </script>

    </body>
</html>
