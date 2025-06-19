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
        <header><h1>Today's Letters</h1></header>
        <main>
            <?php if(count($images) > 0): ?>
                <div id="todaysImagesDiv">
                    <?php foreach($images as $image): ?>
                        <img src="<?php echo $image; ?>" class="letter-image" />
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No letters written today.</p>
            <?php endif; ?>
        </main>
    </body>
</html>