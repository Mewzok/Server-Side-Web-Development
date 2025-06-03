<?php
    require("fp_page.php");

    $formPage = new Page();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--
            Frog Parts uploaded file details page
            Author: Jonathan Kinney
            Date Created: 06/03/2025
            Date Modified: 06/03/2025

            Filename: fp_filedetails.php
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

            if(!isset($_GET['file'])) {
                echo "You have not specified a file name.";
            } else {
                $uploads_dir = '/Users/student/Server-Side-Web-Development/Frog-Parts/uploads/';

                // strip off directory information for security
                $the_file = basename($_GET['file']);

                $safe_file = $uploads_dir.'/'.$the_file;

                echo '<h1>Details of File: '.$the_file.'</h1>';

                echo '<h2>File Data</h2>';
                echo 'File Last Accessed: '.date('j F Y H:i', fileatime($safe_file)).'<br />';
                echo 'File Last Modified: '.date('j F Y H:i', filemtime($safe_file)).'<br />';

                $user = posix_getpwuid(fileowner($safe_file));
                echo 'File Owner: '.$user['name'].'<br />';

                $group = posix_getgrgid(filegroup($safe_file));
                echo 'File Group: '.$group['name'].'<br />';

                echo 'File Permissions: '.decoct(fileperms($safe_file)).'<br />';
                echo 'File Type: '.filetype($safe_file).'<br />';
                echo 'File Size: '.filesize($safe_file).' bytes<br>';

                echo '<h2>File Tests</h2>';
                echo 'is_dir: '.(is_dir($safe_file)? 'true' : 'false').'<br />';
                echo 'is_executable: '.(is_executable($safe_file)? 'true' : 'false').'<br />';
                echo 'is_file: '.(is_file($safe_file)? 'true' : 'false').'<br />';
                echo 'is_link: '.(is_link($safe_file)? 'true' : 'false').'<br />';
                echo 'is_readable: '.(is_readable($safe_file)? 'true' : 'false').'<br />';
                echo 'is_writable: '.(is_writable($safe_file)? 'true' : 'false').'<br />';
            }
        ?>

        <?php $formPage->DisplayFooter(); ?>
    </body>
</html>