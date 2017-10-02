<?php

  // Definition - Kategorien, die zur Auswahl stehen sollen
  $kat=Array();
  $kat[0]="Allgemein";
  $kat[1]="Fehler/Bugs";
  $kat[2]="Anregungen";
  $kat[3]="Portal";
  $kat[4]="Beschwerden";
  $kat[5]="Fragen";
  sort($kat);
  // Ende der Kategorie-Definition

include "inc/conf.php";
require ($skrupel_path."inc.conf.php");
include "inc/initial.php";
include "inc/pn_delivery.php";
 $page_name="Kontakt";

if (!$_GET["fu"])
{ $fu=1; }
else if ($_GET["fu"]!=1 && $_GET["fu"]!=2)
{ $fu=1; }
else { $fu=$_GET["fu"]; }

if ($fu==1) {
require_once "inc/_header.php";
?>
<form name="kontakt" action="kontakt.php?fu=2" method="post" onSubmit="if(this.index.value=='' || this.mail.value==''){return false;}">
<h1>Support-Tickets</h1><table>
<?php if (!$_SESSION["user_id"]){?>
<tr><td>EMail:</td><td><input type="text" name="address" value="<?php echo $HTTP_COOKIE_VARS["mail"]; ?>" /></td></tr>
<?php
} else { ?>
<tr style="display:none"><td></td><td><input type="text" readonly name="address" value="<?php echo $_SESSION["name"]; ?>"></td></tr>
<?php } ?>
<tr><td>Betreff:</td><td><select name="betreff" style="width:110pt">
<?php
for ($zaehler=0; $zaehler<count($kat); $zaehler++) {
$kategorie=$kat[$zaehler]; ?>
<option value="<?php echo $kategorie; ?>"><?php echo $kategorie; ?></option>
<?php } ?>
</select></td></tr>
</table>
<textarea name="index" cols="35" rows="8"></textarea>
<br />
<?php
if (! isset($_SESSION["user_id"])) { ?>
<table><tr>
<td rowspan="2"><img id="captcha" src="inc/captcha.php" alt="Captcha" width="150" height="75"<?php if ($_GET["op"]=="wrong-captcha"){?> style="border-width:2pt; border-color:red; border-style:solid"<?php } ?> />
<br /><a href="javascript:void(0)" onClick="document.getElementById('captcha').src='<?php echo $skrupel_path; ?>/bilder/radb.gif'; setTimeout('document.getElementById(\'captcha\').src=\'inc/captcha.php#\'+Math.random()', 10)">Neu laden</a></td>
<td>Captcha eingeben:</td></tr>
<tr><td><input name="captcha" value=""<?php if ($_GET["op"]=="wrong-captcha"){?> style="border-width:2pt; border-color:red; border-style:solid; color:maroon"<?php } ?> /></td></tr></table>
<?php } ?>
<br /><input type="submit" value="Absenden" />
</form>
<?
} else {
if (! isset($_SESSION["user_id"]))
{ if (! isset($_SESSION["captcha"]) || $_POST["captcha"]!=$_SESSION["captcha"] || empty($_SESSION["captcha"]))
{ unset($_SESSION["captcha"]); header('Location: '.$_SERVER["PHP_SELF"].'?fu=1&op=wrong-captcha'); exit; }
unset($_SESSION["captcha"]); }

require_once "inc/_header.php";
 $submit=sendAnfrage($_POST["address"], $_POST["betreff"], $_POST["index"]);

// Bei Bedarf aktivieren:
// echo mysql_error();
?>
Die Anfrage wurde erfolgreich versandt.
<br /><a href="kontakt.php?fu=1">Zur&uuml;ck</a>
<?
}
  require_once ("inc/_footer.php");
?>
