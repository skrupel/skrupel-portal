<?php
include "inc/conf.php";
include "inc/initial.php";
require ($skrupel_path."inc.conf.php");
$lang="de";
$page_name="BBCode-Einstellungen";

require_once ("inc/_header.php");
require ($skrupel_path."extend/bbc/dat.php");

if ($_GET["fu"]!=1 && $_GET["fu"]!=2)
{ $_GET["fu"]=1; }

if ($_GET["fu"]==1){ 
if (file_exists($skrupel_path."extend/bbc/inc.bbc_conf.php"))
{ require ($skrupel_path."extend/bbc/inc.bbc_conf.php"); }
else {
$set=Array();
$set[0] = 0;
$set[1] = 0;
$set[2] = 1; 
$set[3] = 1; 
$set[4] = 1;
$set[5] = 1;
$set[6] = 2;
$set[7] = 1;
$set[8] = 1;
$set[9] = 1;
$set[10] = 0;
$set[11] = 1;
$set[12] = 0;
$set[13] = 1;
$set[14] = 0;
$set[15] = 1;
$set[16] = 1;
$set[17] = 1;
$dat[18] = 0;
$dat[19] = 0; }
?>
<form name="formular" action="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=2" method="post">
<h2><center><?php
echo "Einstellungen"; ?>
</center></h2>
<?php
if (file_exists($skrupel_path."extend/bbc/install.php"))
{ echo ("Bitte zuerst die install.php der BBCode-Erweiterung entfernen!!!"); }
?>
<center><table>
<?php
for ($zaehler1=0; $zaehler1<count($dat); $zaehler1++)
{ echo "<tr><td>".$dat[$zaehler1]["text"];
echo "<td><select name=\"".$zaehler1."\">";
for ($zaehler2=0; $zaehler2<count($dat[$zaehler1]["poss"]); $zaehler2++)
{ if ($set[$zaehler1]==$zaehler2)
{ $checked="selected"; }
else { $checked=""; }
echo "<option value=\"".$zaehler2."\" ".$checked.">".$dat[$zaehler1]["poss"][$zaehler2]."</option>"; }
echo "</select></td></tr>"; } ?>

<tr><td><input type="submit" value="Einstellungen &auml;ndern"></td></tr>
</table></center></form></body>
<?php
}
else if ($_GET["fu"]==2)
{ $file=fopen($skrupel_path."extend/bbc/inc.bbc_conf.php", "w");
$daten="<?php";
if (isset($_POST))
{ for ($zaehler3=0; $zaehler3<count($_POST); $zaehler3++)
{ $daten.="\n\$set[".$zaehler3."] = ".$_POST[$zaehler3].";"; } }
$daten.="\n?>";
fwrite($file, $daten);
?>
Die Daten wurden erfolgreich gespeichert. <br /><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1">Zur&uuml;ck</a>
<?php
} 
else
{
?>
<?php
echo "Achtung! Die Daten konnten nicht gespeichert werden!";
?>
</body>
<?php
} 
require_once ("inc/_footer.php");
?>