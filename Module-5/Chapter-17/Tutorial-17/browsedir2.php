<!DOCTYPE html>
<html>
    <head>
        <title>Browse Directories</title>
    </head>
    <body>
        <h1>Browsing</h1>

        <?php
            $dir = dir("/Users/student/Server-Side-Web-Development/Module-5/Chapter-17/Tutorial-17/uploads");

            echo '<p>Handle is '.$dir->handle.'</p>';
            echo '<p>Upload directory is '.$dir->path.'</p>';
            echo '<p>Directory Listing:</p><ul>';

            while(false !== ($file = $dir->read()))
                // strip out the two entries of . and ..
                if($file != "." && $file != "..") {
                    echo '<li>'.$file.'</li>';
                }

                echo '</ul>';
                $dir->close();
        ?>
    </body>
</html>