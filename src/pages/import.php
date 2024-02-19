<html>
    <head>
        <title>CSV Test Viewer</title>
    </head>
    <script defer src="https://pyscript.net/alpha/pyscript.js"></script>
    <body>
        <?php
            if(isset($_FILES["csv_file"])){
                // Can access imported files from the _FILES array
                $file = $_FILES["csv_file"];
                // Source: https://stackoverflow.com/questions/37008227/what-is-the-difference-between-name-and-tmp-name
                $csvData = file_get_contents($file["tmp_name"]);
                //if(isset($_REQUEST["newCourse"])){ 
                    $fileAccess = new SplFileObject($file["tmp_name"], 'a');
                    $fileAccess->fputcsv(array('4', 'test'));
                    $fileAccess = null;
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
                    echo "<br>The file temp location is " .$file["tmp_name"];
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data"><br>
            <label for="csv_file">Upload CSV File:</label><br>
            <input type="file" name="csv_file" id="csv_file" accept=".csv" required><br>
            <button type="submit">View CSV</button>
            <label for="newCourse">Or Add a New Course:</label><br>
            <input type="text" id="newCourse" name="newCourse" placeholder="Enter New Course" value="<?=empty($_REQUEST["newCourse"]) ? "" : $_REQUEST["newCourse"] ?>">
        </form>
            <a href="base.php">
            <button>Back</button>
            </a><br>

    </body>
</html>