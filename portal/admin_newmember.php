<?php
include "inc/conf.php";
include "inc/initial.php";
require ($skrupel_path."inc.conf.php");
require ($skrupel_path."lang/de/lang.admin.mitspieler_alpha.php");

if (! $_SESSION["user_id"] || $_SESSION["name"]!=ADMIN)
{ header('Location: index.php'); exit; }

$page_name="Spieler anlegen";
require_once ("inc/_header.php");
if ($_GET["fu"]!=1 && $_GET["fu"]!=2)
{ $_GET["fu"]=1; }

if ($_GET["fu"]==1) {
?>
<center><table border="0" cellspacing="0" cellpadding="4"><tr>
<td><h1><?php echo $lang['admin']['mitspieler']['alpha']['neuspieler']?></h1></td>
</tr></table></center>
<form name="formular" method="post" action="admin_newmember.php?fu=2">
<br><br><br>
<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['mitspieler']['alpha']['nick']?></td></tr>
   <tr><td><input type="text" name="nick" class="eingabe" value="" maxlength="30" style="width:250px;"></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['mitspieler']['alpha']['passwort']?></td></tr>
   <tr><td><input type="text" name="passwort" class="eingabe" value="" maxlength="30" style="width:250px;"></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['mitspieler']['alpha']['email']?></td></tr>
   <tr><td><input type="text" name="email" class="eingabe" value="" maxlength="255" style="width:250px;"></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><input type="submit" name="dumdidum" value="<?php echo $lang['admin']['mitspieler']['alpha']['anlegen']?>" style="width:250px;"></td></tr>
   </table></form></center>
<?php 
 }
if ($_GET["fu"]==2) {

$nick=$_POST["nick"];
$email=$_POST["email"];
$passwort=$_POST["passwort"];

$zeiger = @mysql_query("INSERT INTO $skrupel_user (nick,passwort,email,optionen) values ('$nick','$passwort','$email','00111111111000')");

?>
<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $lang['admin']['mitspieler']['alpha']['erfolgreich']?></td>
  </tr>
</table></center><?php
 }
require_once ("inc/_footer.php");
?>