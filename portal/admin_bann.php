<?php
include "inc/conf.php";
include "inc/initial.php";
include ($skrupel_path."inc.conf.php");
$page_name="Spieler bannen";

if (!$_SESSION["user_id"] || $_SESSION["name"]!=ADMIN)
{ header('Location: index.php'); exit; }

if ($_GET["fu"]!=1 && $_GET["fu"]!=2 && $_GET["fu"]!=3)
{ $_GET["fu"]=1; }

require_once ("inc/_header.php");

if ($_GET["fu"]==1) { 
?><h1>Mitglieder bannen</h1><?php
$zeiger = @mysql_query("SELECT * FROM $skrupel_user WHERE portal_bann='0' AND nick!='".ADMIN."' ORDER BY nick");
$user_anzahl = @mysql_num_rows($zeiger);
if ($user_anzahl>0){ ?>
<form name="bann" action="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=2" method="post">
<select name="user" style="width:150px;">
<?php
for  ($i=0; $i<$user_anzahl;$i++) {
$ok = @mysql_data_seek($zeiger,$i);
$array = @mysql_fetch_array($zeiger);
$a_nick=$array["nick"];
$a_user_id=$array["id"];
?>
<option value="<?php echo $a_user_id; ?>" ><?php echo $a_nick; ?></option>
<?php
}
?>
</select>
<input type="submit" value="Bann auslegen!" />
</form>

<?php
} else { echo "Alle existierenden Mitglieder wurden bereits gebannt.<br />"; }
$zeiger = @mysql_query("SELECT * FROM $skrupel_user WHERE portal_bann='1' ORDER BY nick");
$user_anzahl = @mysql_num_rows($zeiger);
if ($user_anzahl>0) { ?>
<form name="re-bann" action="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=3" method="post">
<select name="user" style="width:150px;">
<?php
for  ($i=0; $i<$user_anzahl;$i++) {
$ok = @mysql_data_seek($zeiger,$i);
$array = @mysql_fetch_array($zeiger);
$a_nick=$array["nick"];
$a_user_id=$array["id"];
?>
<option value="<?php echo $a_user_id; ?>" ><?php echo $a_nick; ?></option>
<?php
}
?>
</select>
<input type="submit" value="Bann entfernen!" />
</form>
<?php } else { echo "Es wurde noch kein Mitglied gebannt.<br />"; } }


else if ($_GET["fu"]==2)
{ $user=$_POST["user"];
$sql=mysql_query("UPDATE $skrupel_user SET portal_bann=1 WHERE id=$user AND portal_bann=0");
echo mysql_error();
?>Das Mitglied wurde erfolgreich gebannt und kann sich nun nicht mehr in's Portal einloggen.
<br /><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1">Zur&uuml;ck</a>
<?php }

else if ($_GET["fu"]==3)
{ $user=$_POST["user"];
$sql=mysql_query("UPDATE $skrupel_user SET portal_bann=0 WHERE id=$user AND portal_bann=1");
echo mysql_error();
?>Das Mitglied wurde erfolgreich entbannt und kann sich nun wieder in's Portal einloggen.
<br /><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1">Zur&uuml;ck</a>
<?php }

require_once ("inc/_footer.php");
?>