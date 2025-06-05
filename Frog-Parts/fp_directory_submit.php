<?php 
    require("fp_page.php");  

    $formPage = new Page();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <!--
        Frog Parts website information lookup
        Author: Jonathan Kinney
        Date Created:  06/05/2025
        Date Modified: 06/05/2025

        Filename: fp_directory_submit.php
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
        <h1>Submit Site</h1>
        <form action="fp_directory_submit_process.php" method="post">
            <label for="url">Enter the URL:</label>
            <input type="text" name="url" id="lookupUrl" value="http://" /><br />
            <label for="email">Enter the Email Contact:</label>
            <input type="text" name="email" id="lookupEmail" /><br />
            <input type="submit" value="Submit Site"/>
    <?php $formPage->DisplayFooter(); ?>
    </body>
</html>