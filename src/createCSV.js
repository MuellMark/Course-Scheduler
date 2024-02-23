// https://www.geeksforgeeks.org/how-to-export-html-table-to-csv-using-javascript/
// Taken from this website but will be modified to fit our tasks
function tableToCSV() {

    // Variable to store the final csv data
    let csv_data = [];

    // Get each row data
    let rows = document.getElementsByTagName('tr');
    for (let i = 1; i < rows.length; i++) {

        // Get each column data
        let cols = rows[i].querySelectorAll('td,th');

        // Stores each csv row data
        let csvrow = [];
        // All the IDs that are used in the form in dynamic_class_csv file
        let IDs = ['CourseID','newCourse','meeting','sections'];
        let weekIDs = ['monday','tuesday','wednesday','thursday','friday'];
        j = 0;
        while(j < IDs.length){

            // Get the text data of each cell
            // of a row and push it to csvrow
            var text = document.getElementById(IDs[j]).value;
            if(text)
                csvrow.push(text);
            j++;
        }
        j=0;
        while(j < weekIDs.length){
            var text = document.getElementById(weekIDs[j]).value;
            // https://stackoverflow.com/questions/9887360/how-can-i-check-if-a-checkbox-is-checked
            if (document.getElementById(weekIDs[j]).checked)
                csvrow.push(text);
            j++;
        }
        // Original script uses this to symbolize new line
        csvrow.push("$");
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