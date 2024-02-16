<html>
    <head>
        <title>CSV Test Viewer</title>
    </head>
    <body>
        <?php
            // Can access imported files from the _FILES array
            $file = $_FILES["csv_file"];
            // Source: https://stackoverflow.com/questions/37008227/what-is-the-difference-between-name-and-tmp-name
            $csvData = file_get_contents($file["tmp_name"]);
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
        ?>
        <form action="" method="post" enctype="multipart/form-data"><br>
            <label for="csv_file">Upload CSV File:</label><br>
            <input type="file" name="csv_file" id="csv_file" accept=".csv" required><br>
            <button type="submit">View CSV</button>
        </form>

    </body>
</html>