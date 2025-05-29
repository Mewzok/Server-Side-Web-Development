<?php
    include('fp_functions.php');
    header('Content-Type: image/png');

    // create array of allowed parts
    $allColors = ['green', 'red', 'blue'];
    $allArms = ['armfrog', 'armcrab', 'armdog'];
    $allLegs = ['legfrog', 'legcrab', 'legdog'];

    // retrieve variables
    $color = $_GET['frogcolor'] ?? 'green';
    $arm = $_GET['frogarm'] ?? 'frog';
    $leg = $_GET['frogleg'] ?? 'frog';

    // verify input
    if(!in_array($color, $allColors)) {
        $color = 'green';
    }
    if(!in_array($arm, $allArms)) {
        $arm = 'frog';
    }
    if(!in_array($leg, $allLegs)) {
        $leg = 'frog';
    }

    $basefrog = imagecreatefrompng("resources/frogbase{$color}.png");
    imagesavealpha($basefrog, true);

    $basefrog = loadFrogImg($basefrog, $arm, $color);
    $basefrog = loadFrogImg($basefrog, $leg, $color);

    imagepng($basefrog);
?>