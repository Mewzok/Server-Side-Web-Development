<?php 
    require("fp_page.php");  

    $formPage = new Page();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <!--
        Frog Parts display data from another website lol
        Author: Jonathan Kinney
        Date Created:  06/05/2025
        Date Modified: 06/05/2025

        Filename: fp_lookup.php
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
            <?php
                $url = 'https://jsonplaceholder.typicode.com/todos/1';

                if(!($contents = file_get_contents($url))) {
                    die('Failed to open '.$url);
                }

                // decode json
                $dataArray = json_decode($contents, true);

                echo "User ID: ".$dataArray['userId']."<br />";
                echo "ID: ".$dataArray['id']."<br />";
                echo "Title: ".$dataArray['title']."<br />";
                echo "Completed: ".($dataArray['completed'] ? 'True' : 'False')."<br />";

                // acknowledge source
                echo '<p>This information retrieved from <br /><a href="'.$url.'">'.$url.'</a>.</p>';
                ?>
        <?php $formPage->DisplayFooter(); ?>
    </body>
</html>