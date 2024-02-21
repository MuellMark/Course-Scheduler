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
            <a href="landing_page.php">
            <button>Back</button>
            </a><br>

    </body>
</html>