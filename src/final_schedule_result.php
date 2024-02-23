<!doctype html>

<html>
    <head>
        <link rel="stylesheet" href="styles.css">

        <!-- Recommended meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <!-- This script tag bootstraps PyScript -->
        <script type="module" src="https://pyscript.net/releases/2024.1.1/core.js"></script>

        <title>PyScript Test</title>
    </head>

    <body>
        <h1>
            Course Scheduler
        </h1>
        <section class="pyscript">
            

            <!-- <div class="font-mono">
                start time: <label id="output1"></label>
            </div> -->
            
            
            <table style="width:70%">
                
                <tr>
                    <th>Time</th>
                    <th>Column 1</th>
                </tr>
                <tr>
                    <th>8:00 AM MWF</th>
                    <th><div id="output2" class="font-mono"></div></th>
                </tr>
                <tr>
                    <th>9:30 AM MWF</th>
                    <th></th>
                </tr>

            </table>


            <script type="py" src="./scripts/main.py" async></script>
        </section>
         <a href="landing_page.php">
            <button>Back</button>
        </a>
    </body>
</html>