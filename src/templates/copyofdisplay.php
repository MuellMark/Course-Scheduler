<!DOCTYPE html>
<html>
<body>

<h1 style="text-align: center"><span>Courses Schedule</span></h1>
<br>

<form action="/download_csv" method="post">
<button type="submit" class='button-style5' style="float: right; margin-right: 10px; margin-bottom: 15px">Download</button>
<br>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, 
        td {
            width: calc(100% / 9);
        }
    </style>

    <!-- style for submit button for force and swap -->
    <style>
        .submit-button {
            padding: 0.5em;
            /*Make button bigger*/
            text-decoration: none;
            /*Do not have default text decorations*/
            font-weight: 6400;
            /*Set font weight*/
            color: #000000;
            /*Set color to black*/
            background-color: #ffcb08;
            /*Set color to SU color*/
            border: none;
            /*Remove border around text*/
            cursor: pointer;
            /*When hovering, make cursor a pointer*/
            white-space: nowrap;
            /*Do not wrap text*/
            margin-top: 21px;
            /*Add space above button*/
            font-size: 1em;
            /*Use the default font size on the users setting*/
            outline: none;
            /*Do not add an outline around button*/
            font-family: 'Arial', sans-serif;
            /*Same font family as before to keep consistent*/
            transition: background-color 0.2s ease-in-out;
            /*Add transition for the background color of button*/
        }

    .submit-button,
    .divScroll select {
        margin: 0;
        /* No margin */
        padding: 0.5em 1em;
        /* Padding around text */
        cursor: pointer;
        /* Pointer cursor on hover */
    }

    .submit-button:hover,
    .divScroll select:hover {
        background-color: #FFFFFF;
        /*When hovering over button, change color to white*/
    }
    </style>

    <table id="optimalTable" border="1">
        <th>Time</th>
        <th>Course Col 1</th>
        <th>Faculty</th>
        <th>Course Col 2</th>
        <th>Faculty</th>

        <tr>
            <td>MWF at 8:00 AM</td>
            <td>CS11</td>
            <td>Prof_2</td>
            <td>$</td>
        </tr>
        <tr>
            <td>MWF at 9:30 AM</td>
            <td>DIS1</td>
            <td>Prof_3</td>
            <td>$</td>
        </tr>
        <tr>
            <td>MWF at 11:00 AM</td>
            <td>ORG1</td>
            <td>Prof_5</td>
            <td>$</td>
        </tr>
        <tr>
            <td>MWF at 2:00 PM</td>
            <td>CS21</td>
            <td>Prof_5</td>
            <td>$</td>
        </tr>
        <tr>
            <td>MWF at 3:30 PM</td>
            <td>EXP1</td>
            <td>Prof_1</td>
            <td>$</td>
        </tr>
        <tr>
            <td>TTH at 8:30 AM</td>
            <td>ARI1</td>
            <td>Prof_5</td>
            <td>$</td>
        </tr>
        <tr>
            <td>TTH at 10:00 AM</td>
            <td>PRL1</td>
            <td>Prof_1</td>
            <td>$</td>
        </tr>
        <tr>
            <td>TTH at 11:30 AM</td>
            <td>ALG1</td>
            <td>Prof_1</td>
            <td>$</td>
        </tr>
        <tr>
            <td>TTH at 1:00 PM</td>
            <td>OPR1</td>
            <td>Prof_1</td>
            <td>$</td>
        </tr>
        <tr>
            <td>TTH at 2:30 PM</td>
            <td>TOC1</td>
            <td>Prof_2</td>
            <td>$</td>   
        </tr>
        <tr>
            <td>MWF at 8:00 AM</td>
            <td>DAT1</td>
            <td>Prof_5</td>
            <td>$</td>
        </tr>
        <tr>
            <td>MWF at 9:30 AM</td>
            <td>SYS1</td>
            <td>Prof_5</td>
            <td>$</td>
        </tr>
        <tr>
            <td>MWF at 11:00 AM</td>
            <td>CAP1</td>
            <td>Prof_1</td>
            <td>$</td>
        </tr>
        <tr>
            <td>MWF at 2:00 PM</td>
            <td>NUA1</td>
            <td>Prof_4</td>
            <td>$</td>
        </tr>
    </table>
    <br>

    <!-- Don't include these styles, simply putting to transfer css over -->
    <style>
     .button-style5 {
        padding: 1em;
        /*Make button bigger*/
        text-decoration: none;
        /*Do not have default text decorations*/
        font-weight: 6400;
        /*Set font weight*/
        color: #000000;
        /*Set color to black*/
        background-color: #ffcb08;
        /*Set color to SU color*/
        border: none;
        /*Remove border around text*/
        cursor: pointer;
        /*When hovering, make cursor a pointer*/
        white-space: nowrap;
        /*Do not wrap text*/
        margin-top: 21px;
        /*Add space above button*/
        font-size: 1em;
        /*Use the default font size on the users setting*/
        outline: none;
        /*Do not add an outline around button*/
        font-family: 'Arial', sans-serif;
        /*Same font family as before to keep consistent*/
        transition: background-color 0.2s ease-in-out;
        /*Add transition for the background color of button*/
    }

    .button-style5,
    .divScroll select {
        margin: 0;
        /* No margin */
        padding: 0.5em 1em;
        /* Padding around text */
        cursor: pointer;
        /* Pointer cursor on hover */
    }

    .button-style5:hover,
    .divScroll select:hover {
        background-color: #FFFFFF;
        /*When hovering over button, change color to white*/
    }

    h1 span {
        border-bottom: 5px solid #ccc;
        /*Add grey bar below text*/
        padding-bottom: 10px;
        /*Add padding*/
        font-family:  'Arial', sans-serif;
    }

    table {
        border-collapse: collapse;
        /* Collapse borders */
        width: 100%;
        /* Width 100% */
    }

    th,
    td {
        border: 1px solid #ddd;
        /* Light grey border */
        padding: 5px;
        /* Padding inside for spacing */
        text-align: center;
        /* Center text horizontally */
        align-items: center;
        /* Align text vertically */
        font-family:  'Arial', sans-serif;
    }

    th {
        background-color: #f2f2f2;
        /* Light grey background */
    }
</style>

<!-- Include these styles for force and swap containers: -->
    <style>
        #swapcontainer,
        #forcecontainer {
            /*float: right;*/
            display: inline-block;
            border: 1px solid black;
            padding: 5px 25px; /* top/bottom, left/right */
            text-align: center;
            width: 350px;
            height: 250px
        }
    </style>

    <style>
        #swapcontainer {
            margin-left: 25px;
        }
    </style>

    <style>
        #forceandswap {
            text-align: center;
        }
    </style>

    <!-- To keep containers together -->
    <div id="forceandswap"> 

    <div id="forcecontainer">
    <h3 style="font-family: 'Arial', sans-serif">Force Courses</h3>
    <form method="post" action="force">
    <p style="font-family: 'Arial', sans-serif; font-size: 15px"> Need a course to be assigned to a specific time? Utilize the force function below to do so:<p>
    <div id="courseMenu" style="font-family: Arial, sans-serif;"> Select a course: </div>
    <br>
    <label for="time" style="font-family: Arial, sans-serif;">Time to be taught:</label>
    <select id="time" name="time">
        <option value="m800">MWF at 8:00 AM</option>
        <option value="m930">MWF at 9:30 AM</option>
        <option value="m1100">MWF at 11:00 AM</option>
        <option value="m200">MWF at 2:00 PM</option>
        <option value="m330">MWF at 3:30 PM</option>
        <option value="t830">TTH at 8:30 AM</option>
        <option value="t1000">TTH at 10:00 AM</option>
        <option value="t1130">TTH at 11:30 AM</option>
        <option value="t100">TTH at 1:00 PM</option>
        <option value="t230">TTH at 2:30 PM</option>
    </select> 
    <br><br>
    <input type="submit" value="Submit" name="submit" class="submit-button"/>
    </form>
    </div>

    <div id="swapcontainer">
    <h3 style="font-family: 'Arial', sans-serif">Swap Courses</h3>
    <p style="font-family: 'Arial', sans-serif; font-size: 15px"> Need to switch the assigned time of two courses? Utilize the swap function below to do so:<p>
    <form method="post" action="swap">
    <div id="firstcourse" style="display: inline-block; font-family: Arial, sans-serif;"> First course: </div>
    <br><br>
    <div id="secondcourse" style="display: inline-block; font-family: Arial, sans-serif;"> Second course: </div>
    <br><br>
    <input type="submit" value="Submit" name="submit" class="submit-button"/>
    </form>
    </div>

    </div>

    <script>
         const start = () => {
            setTimeout(function () {
                confetti.start()
            }, 1000); // After 1 second start the confetti
        };

        const stop = () => {
            setTimeout(function () {
                confetti.stop()
            }, 5000); // After 5 second stop the confetti
        };
        // after this here we are calling both the function so it works
        start();
        stop();
        function playSound() {
            const audio = new Audio("/static/confetti.mp3"); // Replace 'path_to_your_sound_file.mp3' with the actual path to your sound file
            audio.play();
        }
        window.onload = playSound;

        // https://www.geeksforgeeks.org/how-to-access-tr-element-from-table-using-javascript/
        function createSelectFromColumn(tableId, columnIndex,containerType,selectId) {
        // Get the table element
        const table = document.getElementById(tableId);
        
        // Create the select element
        const select = document.createElement('select');
        select.id = selectId;
        select.name = selectId;
        
        // Loop through the rows in the table starting from the second row (index 1)
        for (let i = 1; i < table.rows.length; i++) {
            const row = table.rows[i];
            
            // Get the cell in the specified column index
            const cell = row.cells[columnIndex];
            
            // Create an option element for the cell value
            const option = document.createElement('option');
            option.value = cell.textContent.trim();
            option.textContent = cell.textContent.trim();
            
            // Append the option to the select element
            select.appendChild(option);
        }
        
        // Append the select element to the specified container
        const selectContainer = document.getElementById(containerType);
        selectContainer.appendChild(select);
        
        // Return the created select element
        return select;
        }

        // createSelectFromColumn('optimalTable', 0, 'timeMenu','time');
        createSelectFromColumn('optimalTable', 1, 'courseMenu','course');

        createSelectFromColumn('optimalTable', 1, 'firstcourse','course1');
        createSelectFromColumn('optimalTable', 1, 'secondcourse','course2');

  </script>

</body>
</html>