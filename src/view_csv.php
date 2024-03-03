<html>
    <head>
        <title>CSV Test Viewer</title>
    </head>
    <body>
        <?php
        if($_FILES['csv']['error'] == 0){
            // Can access imported files from the _FILES array
            $file = $_FILES["csv"];
            // Source: https://stackoverflow.com/questions/37008227/what-is-the-difference-between-name-and-tmp-name
            $csvData = file_get_contents($file["tmp_name"]);

            /**
             * This below does not work currently as expected
             * but it essentially just a test to add in new
             * values in a CSV 
             * 
             */
            //if(isset($_REQUEST["newCourse"])){ 
                //$fileAccess = new SplFileObject($file["tmp_name"], 'a');
                //$fileAccess->fputcsv(array('4', 'test'));
                //$fileAccess = null;
            //} 

            // Seperate by new line
            $csvRows = explode("\n", $csvData);
            foreach ($csvRows as $row) {
                // Source: https://stackoverflow.com/questions/6169235/str-getcsv-example
                $csvItem = str_getcsv($row);
                echo "<br>";
                foreach ($csvItem as $item) {
                    echo "$item, ";
                    }
                }
                // This line can be removed I was curious how it was stored
                echo "<br>The file temp location is " .$file["tmp_name"];
        }
        ?>

    <?php
    // Source: https://www.php.net/manual/en/function.oci-connect.php
    // Connects to the XE service (i.e. database) on the "localhost" machine
    $conn = oci_connect('csullivan', 'Coursescheduler123!');
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $stid = oci_parse($conn, 'SELECT * FROM course');
    oci_execute($stid);

    echo "<table border='1'>\n";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";

    ?>

            <a href="landing_page.php">
            <button>Back</button>
            </a><br>

    </body>
</html>