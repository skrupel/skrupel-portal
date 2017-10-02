<?php
include "inc/conf.php";
include "inc/initial.php";
$page_name="Erweiterungen";
require_once ("inc/_header.php");

$ext=Array();
$ext[0]["title"]="Die KI-Erweiterung";
$ext[0]["file"]="ki";
$ext[0]["text"]="erlaubt es, in Galaxien gegen Computergegner anzutreten.";
$ext[1]["title"]="Die XStats-Erweiterung";
$ext[1]["file"]="xstats";
$ext[1]["text"]="erstellt ausf&uuml;hrliche Statistiken zu den beendeten Spielen.";
$ext[2]["title"]="Die MovieGif-Erweiterung";
$ext[2]["file"]="moviegif";
$ext[2]["text"]="zeigt den Rundenverlauf eines beendeten Spieles als Grafik dar.";
$ext[3]["title"]="Das MovieFlash-Addon";
$ext[3]["file"]="movieflash";
$ext[3]["text"]="stattet die MovieGif mit einem Flash-Player aus, mit welchem man durch die einzelnen Bilder navigieren kann.";
$ext[4]["title"]="Die RSS-Erweiterung";
$ext[4]["file"]="rss";
$ext[4]["text"]="stellt den Rundenstatus eines beliebigen Spielers als RSS-Feed dar.";
$ext[5]["title"]="Das BBC-Addon";
$ext[5]["file"]="bbc";
$ext[5]["text"]="stattet Forum & Chat mit unz&auml;hligen BBCodes aus. Welche BBCodes jedoch verwendet werden, obliegt der Administrative.";
?>
<h2>Erweiterungen</h2>
<?php

for ($zaehler=0; $zaehler<count($ext); $zaehler++)
{ if (file_exists($skrupel_path."extend/".$ext[$zaehler]["file"]."/"))
{ echo "<big><strong>".$ext[$zaehler]["title"]."</strong></big> ".$ext[$zaehler]["text"]."<br />&nbsp;<br />"; }
else { echo "- ".$ext[$zaehler]["title"]." wurde noch nicht installiert.<br />"; } }

require_once ("inc/_footer.php");
?>