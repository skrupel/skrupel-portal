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
<h1>Impressum</h1>
<form name="settings" action="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=2" method="post">
<table>
<tr><td colspan="2"><strong>Pflichtangaben nach §5 TMG</strong></td></tr>
<tr><td>Vorname:</td><td><input name="vorname" value="<?php echo $impressum_vorname; ?>" maxlength="30" /></td></tr>
<tr><td>Nachname:</td><td><input name="nachname" value="<?php echo $impressum_nachname; ?>" maxlength="30" /></td></tr>
<tr><td>Stra&szlig;e:</td><td><input name="strasse" value="<?php echo $impressum_strasse; ?>" maxlength="30" /></td></tr>
<tr><td>Hausnummer:</td><td><input name="hausnummer" value="<?php echo $impressum_hausnummer; ?>" maxlength="30" /></td></tr>
<tr><td>Postleitzahl:</td><td><input name="postleitzahl" value="<?php echo $impressum_postleitzahl; ?>" maxlength="30" /></td></tr>
<tr><td>Ortsname:</td><td><input name="ortsname" value="<?php echo $impressum_ortsname; ?>" maxlength="30" /></td></tr>
<tr><td>Mail-Adresse:</td><td><input name="email" value="<?php echo $impressum_email; ?>" maxlength="30" /></td></tr>
<tr><td colspan="2"><strong>Zus&auml;tzliche Module</strong></td></tr>
<tr><td colspan="2"><input type="checkbox" name="haftung" <?php if ($impressum_settings_haftung==1){?> checked<?php } ?> /> Haftungsausschluss</td></tr>
<tr><td colspan="2"><input type="checkbox" name="facebook" <?php if ($impressum_settings_facebook==1){?> checked<?php } ?> /> Face-Book-Datenschutz</td></tr>
<tr><td colspan="2"><input type="submit" value="Einstellungen &auml;ndern" /></td></tr>
</table></form>
<?php
require_once ("inc/_footer.php");
} 
else if ($_GET["fu"]==2) {
$impressum_vorname=str_replace("'", "", $_POST["vorname"]);
$impressum_nachname=str_replace("'", "", $_POST["nachname"]);
$impressum_strasse=str_replace("'", "", $_POST["strasse"]);
$impressum_hausnummer=str_replace("'", "", $_POST["hausnummer"]);
$impressum_postleitzahl=str_replace("'", "", $_POST["postleitzahl"]);
$impressum_ortsname=str_replace("'", "", $_POST["ortsname"]);
$impressum_email=str_replace("'", "", $_POST["email"]);

if ($_POST["haftung"]=="on" || $_POST["haftung"]=="true")
{ $impressum_settings_haftung=1; } else { $impressum_settings_haftung=0; }

if ($_POST["facebook"]=="on" || $_POST["facebook"]=="true")
{ $impressum_settings_facebook=1; } else { $impressum_settings_facebook=0; }

$impressum_settings=$impressum_settings_haftung.$impressum_settings_facebook;

$update=mysql_query("UPDATE $skrupel_portal SET impressum_vorname='$impressum_vorname', impressum_nachname='$impressum_nachname', impressum_strasse='$impressum_strasse', impressum_hausnummer='$impressum_hausnummer', impressum_postleitzahl='$impressum_postleitzahl', impressum_ortsname='$impressum_ortsname', impressum_email='$impressum_email', impressum_settings='$impressum_settings'");
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