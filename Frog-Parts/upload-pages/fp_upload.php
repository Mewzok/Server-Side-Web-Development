<?php
    require("fp_page.php");

    $formPage = new Page();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--
            Frog Parts upload page
            Author: Jonathan Kinney
            Date Created: 06/03/2025
            Date Modified: 06/05/2025

            Filename: fp_upload.php
        -->
        <meta charset="utf-8" />
        <?php
            $formPage->DisplayKeywords();
            $formPage->DisplayTitle();
            $formPage->DisplayStyles();
        ?>
    </head>
    <body>
        <?php $formPage->DisplayHeader(); ?>
        <div class="upload-div">

            <h1>Upload a File</h1>
            <form action="fp_processupload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <label for="the_file">Upload a file:</label>
                <input type="file" name="the_file" id="the_file" />
                <input type="submit" value="Upload File" />
            </form>
            
        </div>
        <?php $formPage->DisplayFooter(); ?>
    </body>
</html>