<?php
$zaehler=0;
$design=Array();
if ($handle = opendir('styles')) {
    while (false !== ($file = readdir($handle))) {
        if ($file!="." && $file!=".." && preg_match("#.php#is", $file)==0) {
            $name=''; $creator=''; $info='';
	if (file_exists("styles/".$file."/details.php"))
	{ require ("styles/".$file."/details.php");
	$design[$zaehler]["path"]=$file;
	$design[$zaehler]["name"]=$name; $design[$zaehler]["copy"]="<p>Design by: ".$creator."</p>".$info; $design[$zaehler]["creator"]=$creator; }
	$zaehler++;
        }
    }
    closedir($handle);
}
sort($design);
// print_r ($design);
?>