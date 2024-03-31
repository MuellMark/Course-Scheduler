// https://www.geeksforgeeks.org/how-to-export-html-table-to-csv-using-javascript/
// Taken from this website but will be modified to fit our tasks
function tableToCSV() {

    /*error check to make sure course table is filled before saving, not working right now*/
    if (!checkIfFilled("course-table")) {
        alert("Please fill in all fields before saving CSV file.");
        return false;
    }

    // Variable to store the final csv data
    let csv_data = [];

    // Used to tell if it is the first row of each table
    let firstCSVRow = new Boolean(true);
    let firstFacRow = new Boolean(true);

    // Get each row data
    let rows = document.getElementsByTagName('tr');
    for (let i = 1; i < rows.length; i++) {

        // Get each column data
        let cols = rows[i].querySelectorAll('input[name="newCourse"][type="select"]:not([value="empty"]),input[name="sections"][type="number"],input[type="text"]:not([value=""]),input[type="checkbox"]:checked,[name="meeting_hours"],input[name="facultyName"],input[name="courses"],[name="primetime"]');

        // Stores each csv row data
        let csvrow = [];
        if(cols.length > 0){
            //if(cols[0].id == "newCourse" && (firstCSVRow))
            if(firstCSVRow)
            {
                firstCSVRow = false;
                csv_data.push("<course-table>");
            }
            if(cols[0].id == "facultyName" && (firstFacRow))
            {
                firstFacRow = false;
                csv_data.push("<faculty-table>");
            }
        }
        for (let j = 0; j < cols.length; j++) {
            // if(cols[j].id == "newCourse")
            //     csvrow.push("<course-table>");
            // if(cols[j].id == "facultyName")
            //     csvrow.push("<faculty-table>");
            // Get the text data of each cell
            // of a row and push it to csvrow
            if(cols[j].id != 'newCourse')
                csvrow.push(cols[j].value);
        }
        //csv_data.push('$');
        // Combine each column value with comma
        if(cols.length > 0)
            csvrow.push("$");
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
    temp_link.download = "course.csv";
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

function generateCSV() {
    const csvData = "Name,Email\nJohn Doe,johndoe@example.com\nJane Smith,janesmith@example.com";

    // https://www.w3schools.com/xml/xml_http.asp
    const xhr = new XMLHttpRequest();

    // Define the Python CGI script URL
    const url = 'display.py';

    // Set up the request
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define the callback function
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Display the response from Python script
            document.getElementById('csv-container').innerHTML = xhr.responseText;
        }
    };

    // Send the POST request with CSV data
    xhr.send(`csv_data=${encodeURIComponent(csvData)}`);
}
