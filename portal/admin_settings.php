<?php
include "inc/conf.php";
include "inc/initial.php";
include ($skrupel_path."inc.conf.php");
$page_name="Portal-Einstellungen";
include "styles/design.php";

if (!$_SESSION["user_id"] || $_SESSION["name"]!=ADMIN)
{ header('Location: index.php'); exit; }

if ($_GET["fu"]!=1 && $_GET["fu"]!=2)
{ $_GET["fu"]=1; }

if ($_GET["fu"]==1) {
require_once ("inc/_header.php");
?>
<h1>Portal-Einstellungen</h1>
<form name="settings" action="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=2" method="post">
<table>
<tr><td colspan="2"><strong>Server-Info</strong></td></tr>
<tr><td>Servername:</td><td><input name="servername" value="<?php echo $servername; ?>" maxlength="30" /></td></tr>
<tr><td>Seitentitel:</td><td><input name="seitentitel" value="<?php echo $seitentitel; ?>" maxlength="40" /></td></tr>
<tr><td>Keywords:</td><td><input name="keywords" value="<?php echo $keywords; ?>" maxlength="300" /></td></tr>
<tr><td>Beschreibung:</td><td><textarea name="description" maxlength="500"><?php echo $description; ?></textarea></td></tr>
<tr><td colspan="2"><strong>Technisches</strong></td></tr>
<tr><td>Cookie-Verfallszeit:</td><td><input name="cookie_dauer_1" value="<?php echo $cookie_dauer_1; ?>" maxlength="10" />
<select name="cookie_dauer_2">
<option value="1"<?php if ($cookie_dauer_2==1){?> selected<?php } ?>>Sekunden</option>
<option value="60"<?php if ($cookie_dauer_2==60){?> selected<?php } ?>>Minuten</option>
<option value="3600"<?php if ($cookie_dauer_2==3600){?> selected<?php } ?>>Stunden</option>
<option value="86400"<?php if ($cookie_dauer_2==86400){?> selected<?php } ?>>Tage</option>
<option value="604800"<?php if ($cookie_dauer_2==604800){?> selected<?php } ?>>Wochen</option>
</select></td></tr>
<tr><td>Offenbarungen anzeigen:</td><td><input name="news_limit" value="<?php echo $news_limit; ?>" maxlength="3" /></td></tr>
<tr><td>Standard-Template:</td><td><select name="template">
<?php
for ($zaehler=0; $zaehler<count($design); $zaehler++)
{ echo "<option value=\"".$design[$zaehler]["path"]."\"";
if ($template==$design[$zaehler]["path"]){ echo " selected"; }
echo ">".$design[$zaehler]["name"]."</option>"; }
?></select></td></tr>
<tr><td colspan="2"><input type="submit" value="Einstellungen &auml;ndern" /></td></tr>
</table></form>
<?php
require_once ("inc/_footer.php");
} 
else if ($_GET["fu"]==2) {
$servername=str_replace("\r\n", "", $_POST["servername"]);
$servername=str_replace("'", "", $servername);
$keywords=str_replace("\r\n", "", $_POST["keywords"]);
$keywords=str_replace("'", "", $keywords);
$seitentitel=str_replace("\r\n", "", $_POST["seitentitel"]);
$seitentitel=str_replace("'", "", $seitentitel);
$description=str_replace("'", "", $description);
$template=str_replace("'", "", $_POST["template"]);

if (isset($_POST["cookie_dauer_1"]) && is_numeric($_POST["cookie_dauer_1"]))
{ $cookie_dauer_1=$_POST["cookie_dauer_1"]; }
$cookie_dauer_2=$_POST["cookie_dauer_2"];

if (isset($_POST["news_limit"]) && is_numeric($_POST["news_limit"]))
{ $news_limit=$_POST["news_limit"]; }

$update=mysql_query("UPDATE $skrupel_portal SET servername='$servername', keywords='$keywords', seitentitel='$seitentitel', description='$description', cookie_dauer='$cookie_dauer_1', cookie_dauer_2='$cookie_dauer_2', news_limit='$news_limit', template='$template'");
echo mysql_error();
require_once ("inc/_header.php");
?>
&Auml;nderungen erfolgreich.
<form name="back" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get" onSubmit="location.href='<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1'; return false;">
<input type="hidden" name="fu" value="1" />
<input type="submit" value="Zur&uuml;ck" />
</form>
<?php 
require_once ("inc/_footer.php");
} ?>