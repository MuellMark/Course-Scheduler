<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="createCSV.js"></script>
    <title>Create CSV</title>
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
                        <li> <a href="dynamic_class_csv.php"> Create CSV</a> </li>
                        <li> <a href="about-howto.php"> About/HowTo</a> </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!--Header Pic-->
        <div id="headerimage">
            <img src="./images/48430_211016_HomecomingDroneSunset-HDR_2 (1).jpg" alt="Picture Of Campus At Sunset">
        </div>
    </header>

    <h1>Create CSV</h1>
    <button class ="button-style" onclick="addRow()">Add Row</button>
    <button class ="button-style" onclick="tableToCSV()">Save as CSV</button>
    <button class ="button-style" onclick="clearTable()">Clear Table</button>
    <br><a href="final_schedule_result.php">
        <button class = "button-style">Run script</button>
    </a>
    <br><a href="landing_page.php">
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
            var rowCount = table.rows.length;
            var row = table.insertRow(table.rows.length);
            if(rowCount < 21){
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
                //      ?>
                // </select>
            }
        else{
        alert("Cannot add more than 20 rows")
    }
    
    }
        function clearTable() {
            var table = document.getElementById("dynamic-table");

            //Need to be more than 1 row to delte
            while(table.rows.length >1){
                table.deleteRow(1);
            }
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

    <!-- JavaScript used to enable hamburger menu -->
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

</body>

</html>