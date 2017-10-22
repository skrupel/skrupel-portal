<?php
$zaehler = 0;
$design = array();

if ($handle = opendir('styles')) {
    while (false !== ($file = readdir($handle))) {
        if ($file == '.' || $file == '..' || preg_match('#.php#is', $file) !== 0) {
            continue;
        }

        $name = '';
        $creator = '';
        $info = '';

        $details_file = 'styles/'.$file.'/details.php';
        if (file_exists($details_file)) {
            require $details_file;
        }

        $design[$zaehler]['path'] = $file;
        $design[$zaehler]['name'] = $name;
        $design[$zaehler]['copy'] = 'Design by: '.$creator.($info !== '' ? ' ('.$info.')' : '');
        $design[$zaehler]['creator'] = $creator;

        $zaehler++;
    }

    closedir($handle);
}

sort($design);
