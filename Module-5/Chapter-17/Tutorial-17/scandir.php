<!DOCTYPE html>
<html>
    <head>
        <title>Browse Directories</title>
    </head>
    <body>
        <h1>Browsing</h1>

        <?php
            $dir = '/Users/student/Server-Side-Web-Development/Module-5/Chapter-17/Tutorial-17/uploads';
            $files1 = scandir($dir);
            $files2 = scandir($dir, 1);

            echo '<p>Upload directory is '.$dir.'</p>';
            echo '<p>Directory Listing is in alphabetical order, ascending:</p><ul>';

            foreach($files1 as $file) {
                if($file != "." && $file != "..") {
                    echo '<li>'.$file.'</li>';
                }
            }

            echo '</ul>';

            echo '<p>Upload directory is '.$dir.'</p>';
            echo '<p>Directory Listing in alphabetical, descending:</p><ul>';

            foreach($files2 as $file) {
                if($file != "." && $file != "..") {
                    echo '<li>'.$file.'</li>';
                }
            }

            echo '</ul>';

        ?>
    </body>
</html>