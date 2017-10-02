<?php
include "inc/conf.php";
include "inc/initial.php";
require ($skrupel_path."inc.conf.php");

 if ($_GET["fu"]!=1 && $_GET["fu"]!=2 && $_GET["fu"]!=3)
{ $_GET["fu"]=1; }

if ($_GET["type"]!="name" && $_GET["type"]!="mail")
{ $_GET["type"]="name"; }

if (isset($_SESSION["user_id"]))
{ header('Location: index.php'); exit; }

if ($_GET["fu"]==1) {
require_once ("inc/_header.php");
?>
<h1>Zugangsdaten anfordern</h1>
<form name="next" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
<input type="hidden" name="fu" value="2" />
<select name="type"><option value="name" selected>Benutzername angeben</option>
<option value="mail">EMail angeben</option></select> <input type="submit" value="Weiter" />
</form>
<?php
require_once ("inc/_footer.php"); }
else if ($_GET["fu"]==2) {
require_once ("inc/_header.php");
?>
<h1>Zugangsdaten anfordern</h1>
<form name="next" action="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=3&type=<?php echo $_GET["type"]; ?>" method="post">
<table><tr>
<?php
if ($_GET["type"]=="name"){
?><td>Benutzername:</td><td><input name="name" value="<?php echo $HTTP_COOKIE_VARS["login_name"]; ?>" /></td></tr>
<?php } else { ?>
<td>EMail:</td><td><input name="mail" value="<?php echo $HTTP_COOKIE_VARS["mail"]; ?>" /></td></tr>
<?php } ?>
<tr><td colspan="2"><input type="submit" value="Daten anfordern" /></td></tr></table></form>
<?php
require_once ("inc/_footer.php"); }

else if ($_GET["fu"]==3 && $_GET["type"]=="name")
{ $zaehler=0;
$sql=mysql_query("SELECT * FROM $skrupel_user WHERE nick='{$_POST["name"]}'");
while ($row=mysql_fetch_object($sql))
{ if (isset($row->email) && ! empty ($row->email) && $row->email!="" && $row->email!="-" && $row->email!="/" && preg_match("#@#", $row->email)==1)
{ $zaehler++;
$submit=@mail($row->email, $servername." - Zugangsdaten", "Ihre Zugangsdaten lauten:\nBenutzer: ".$row->nick."\nPasswort: ".$row->pass."\nMail: ".$row->email."\n\nLiebe Grüße,\nIhr Team", "From: ".$servername." <".$absenderemail.">"); } }
require_once ("inc/_header.php");
if ($zaehler>0) { echo "Zugangsdaten erfolgreich versandt."; }
else { echo "Der Benutzer konnte nicht gefunden werden oder er hat keine g&uuml;ltige EMail-Adresse hinterlegt."; }
echo "<br /><a href=\"".$_SERVER["PHP_SELF"]."?fu=1\">Zur&uuml;ck</a>"; 
require_once("inc/_footer.php"); }

else if ($_GET["fu"]==3 && $_GET["type"]=="mail")
{ $zaehler=0;
$sql=mysql_query("SELECT * FROM $skrupel_user WHERE email='{$_POST["mail"]}'");
while ($row=mysql_fetch_object($sql))
{ if (isset($row->email) && ! empty ($row->email) && $row->email!="" && $row->email!="-" && $row->email!="/" && preg_match("#@#", $row->email)==1)
{ $zaehler++;
$submit=@mail($row->email, $servername." - Zugangsdaten", "Ihre Zugangsdaten lauten:\nBenutzer: ".$row->nick."\nPasswort: ".$row->pass."\nMail: ".$row->email."\n\nLiebe Grüße,\nIhr Team", "From: ".$servername." <".$absenderemail.">"); } }
require_once ("inc/_header.php");
if ($zaehler>0) { echo "Zugangsdaten erfolgreich versandt."; }
else { echo "Es konnte kein Benutzer mit dieser EMail-Adresse gefunden werden."; }
echo "<br /><a href=\"".$_SERVER["PHP_SELF"]."?fu=1\">Zur&uuml;ck</a>";
require_once("inc/_footer.php"); }