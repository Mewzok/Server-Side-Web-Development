<?php
    function loadFrogList($filepath) {
        $frogList = [];
        if(file_exists($filepath) && ($fp = fopen($filepath, "r")) !== false) {
          while(($curLine = fgetcsv($fp)) !== false) {
            if(count($curLine) >= 4) {
              $frogList[] = $curLine;
            }
          }
          fclose($fp);
        }
        return $frogList;
    }

    function compareName($x, $y) {
        if($x['name'] == $y['name']) {
        return 0;
        } else if($x['name'] < $y['name']) {
        return -1;
        } else {
        return 1;
        }
    }

    function loadFrogImg($basefrog, $limb, $color) {
        $limbimg = imagecreatefrompng("resources/{$limb}{$color}.png");
        imagesavealpha($limbimg, true);
        imagecopy($basefrog, $limbimg, 0, 0, 0, 0, imagesx($limbimg), imagesy($limbimg));

        return $basefrog;
    }
?>