<?php
    include('fp_functions.php');
    header('Content-Type: image/png');

    // retrieve variables
    $color = $_GET['frogcolor'];
    $arm = $_GET['frogarm'];
    $leg = $_GET['frogleg'];

    $basefrog = imagecreatefrompng("resources/frogbase{$color}.png");
    imagesavealpha($basefrog, true);

    $basefrog = loadFrogImg($basefrog, $arm, $color);
    $basefrog = loadFrogImg($basefrog, $leg, $color);

    imagepng($basefrog);
?>