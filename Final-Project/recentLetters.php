<?php
    require("page.php");

    $page = new Page();

    // add all images in today's folder to images array
    $todayFolder = 'letters/'.date('Y-m-d');
    $images = [];

    if(file_exists($todayFolder)) {
        $files = scandir($todayFolder);
        foreach($files as $file) {
            if(str_ends_with($file, '.png')) {
                $images[] = $todayFolder.'/'.$file;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $page->DisplayTitle();
            $page->DisplayStyles();
        ?>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <header><a href="recentLetters.php" class="headerLinks"><h1>Today's Letters</h1></a></header>
        <main>
            <?php if(count($images) > 0): ?>
                <div id="todaysImagesDiv">
                    <?php
                        $images = array_reverse($images);
                        foreach($images as $image) {
                            echo '<img src="'.$image.'"class="letter-image" />';
                        }
                    ?>
                </div>
            <?php else: ?>
                <p>No letters written today.</p>
            <?php endif; ?>
        </main>
        <?php $page->backToHomeButton(); ?>
    </body>
</html>