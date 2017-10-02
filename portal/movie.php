<?php
include "inc/conf.php";
include "inc/initial.php";

$movie_path="http://www.skrupel.de/www/movies/";
$movie=Array();
$movie[0]["bez"]="vorschau";
$movie[0]["name"]="Spielvorschau";
$movie[1]["bez"]="erstekolonie";
$movie[1]["name"]="Erste Kolonie";
$movie[2]["bez"]="schiffsbau";
$movie[2]["name"]="Schiffsbau";
$movie[3]["bez"]="kursundflug";
$movie[3]["name"]="Kurs &amp; Flug";

for ($zaehler=0; $zaehler<count($movie); $zaehler++)
{ if ($_GET["op"]==$movie[$zaehler]["bez"])
{ $select=$_GET["op"]; } }
if (! isset($select))
{  $page_name="Screenshots und FlashFilme";
require_once ("inc/_header.php");
?>
<h2>Flash-Filme</h2>
<table>
<tr><td><img src="pics/movie.jpg" alt="FlashFilme" /></td>
<td>
<?php
for ($zaehler2=0; $zaehler2<count($movie); $zaehler2++)
{ echo "<a href=\"?op=".$movie[$zaehler2]["bez"]."\" rel=\"shadowbox[movie];title=FlashFilm - ".$movie[$zaehler2]["name"].";width=620;height=410\">".$movie[$zaehler2]["name"]."</a><br />"; }
?>
</td></tr></table>
<hr />
<h2>Screenshots</h2>
<table><tr>
<?php
$zaehler4=0;
$screen=Array();
if ($handle = opendir('screenshots')) {
    while (false !== ($file = readdir($handle))) {
        if ($file!="." && $file!="..") {
	$screen[$zaehler4]=$file;
	$zaehler4++;
        }
    }
    closedir($handle);
}
sort($screen);


for ($zaehler3=0; $zaehler3<count($screen); $zaehler3++)
{ echo "<td><a href=\"screenshots/".$screen[$zaehler3]."\" rel=\"shadowbox[screenshot];title=Screenshot;width=900;height=800\"><img src=\"screenshots/".$screen[$zaehler3]."\" alt=\"".$screen[$zaehler3]."\" width=\"120\" height=\"90\" /></a></td>";
if (($zaehler3+1)%4==0)
{ echo "</tr><tr>"; } }
?>
</tr></table>
<?php
require_once ("inc/_footer.php"); }
else {
?>

<center><div style="border:1px solid #000000"><OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" WIDTH="610" HEIGHT=400 CODEBASE="http://active.macromedia.com/flash5/cabs/swflash.cab#version=5,0,0,0"><PARAM NAME=movie VALUE="<?php echo $movie_path.$select.".swf"; ?>"><PARAM NAME=play VALUE=true><PARAM NAME=loop VALUE=false><PARAM NAME=quality VALUE=low><EMBED SRC="<?php echo $movie_path.$select.".swf"; ?>" WIDTH=610 HEIGHT=400 quality=high loop=false TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED></OBJECT></div></center>

<?php
}
?>