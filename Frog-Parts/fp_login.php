<?php 
    // handle login redirection first
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(
            isset($_POST['username']) && 
            isset($_POST['password']) &&
            $_POST['username'] === 'user' &&
            $_POST['password'] === 'pass' ) {
                header("Location: fp_form.php");
                exit();
            } else {
                header("Location: fp_rejection.php");
                exit();
            }
        }

  require("fp_page.php");  

  $formPage = new Page();
?>
<!DOCTYPE html>
<html>
    <head>
        <!--
        Frog Parts login page
        Author: Jonathan Kinney
        Date Created:  06/03/2025
        Date Modified: 06/03/2025

        Filename: fp_login.php
        -->
        <meta charset="utf-8" />
        <?php 
        $formPage->DisplayKeywords();
        $formPage->DisplayTitle();
        $formPage->DisplayStyles();
        ?>
    </head>
    <body>
        <h1 class="frogin-heading">Frog Log In</h1>

        <div class="frogin-div">
            <form method="post" action="fp_login.php" class="frogin-form">
                <p><label for="username">Username:</label>
                <input type="text" name="username" id="username" /></p>
                <p><label for="password">Password:</label>
                <input type="password" name="password" id="password" /></p>
                <button type="submit" name="submit">Frog In</button>
            </form>
        </div>
    </body>
</html>