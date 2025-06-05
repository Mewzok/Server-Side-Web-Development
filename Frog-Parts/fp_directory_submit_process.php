<?php 
    require("fp_page.php");  

    $formPage = new Page();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <!--
        Frog Parts website information lookup processing page
        Author: Jonathan Kinney
        Date Created:  06/05/2025
        Date Modified: 06/05/2025

        Filename: fp_directory_submit_process.php
    -->
    <meta charset="utf-8" />
        <?php 
            $formPage->DisplayKeywords();
            $formPage->DisplayTitle();
            $formPage->DisplayStyles();
        ?>
    </head>
    <body>
        <div class="directory-submit-process-div">
            <h1>Site Submission Results</h1>

            <?php
                // extract form fields
                $url = $_POST['url'];
                $email = $_POST['email'];

                // check the URL
                $url = parse_url($url);
                $host = $url['host'];

                if(!($ip = gethostbyname($host))) {
                    echo 'Host for URL does not have a valid IP address.';
                    exit;
                }

                echo 'Host ('.$host.') is at IP '.$ip.'<br />';

                // check the email address
                $email = explode('@', $email);
                $emailhost = $email[1];

                if(!getmxrr($emailhost, $mxhostsarr)) {
                    echo 'Email address is not at valid host.';
                    exit;
                }

                echo 'Email is delivered via: <br /><ul>';

                foreach($mxhostsarr as $ms) {
                    echo '<li>'.$ms.'</li>';
                }
                echo '</ul>';

                // if reached here, all okay
                echo '<p>All submitted details are okay.</p>';
                echo '<p>You submitted your site. It will be visited soon.</p>';
                echo '<p>While you wait, consider what you\'ve done.</p>';
                // hypothetically add to database of waiting sites here
            ?>
        </div>
    <?php $formPage->DisplayFooter(); ?>
    </body>
</html>