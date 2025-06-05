<?php
    require("fp_page.php");

    $formPage = new Page();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--
            Frog Parts uploaded file browsing page
            Author: Jonathan Kinney
            Date Created: 06/03/2025
            Date Modified: 06/05/2025

            Filename: fp_browsedir.php
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
        <div class="file-browse-div">
            <h1>Browsing</h1>

            <?php
                $current_dir = '/Users/student/Server-Side-Web-Development/Frog-Parts/uploads/';
                $dir = opendir($current_dir);

                echo '<p>Upload directory is '.$current_dir.'</p>';
                echo '<p>Directory listing:</p><ul>';

                while(false !== ($file = readdir($dir))) {
                    // strip out the two entries of . and ..
                    if($file != "." && $file != "..") {
                        echo '<li><a href="fp_filedetails.php?file='.$file.'">'.$file.'</a></li>';
                    }
                }
                echo '</ul>';
                closedir($dir);
            ?>

        </div>
        <?php $formPage->DisplayFooter(); ?>
    </body>
</html>