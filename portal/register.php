<?php
  include "inc/conf.php";
  include "inc/initial.php";
  require ($skrupel_path."inc.conf.php");
$page_name="Registration";

if ($_SESSION["user_id"])
{ header('Location:index.php'); }

if (! $_GET["fu"])
{ $_GET["fu"]=1; }
?>
<?php

if ($_GET["fu"]==1)
{ 
  require_once ("inc/_header.php");
?>
<center><img src="<?php echo $skrupel_path; ?>bilder/logo_login.gif" />
       <table border="0" cellspacing="0" cellpadding="4">
	<caption align="bottom"><hr />* Angabe ist optional</caption>
         <tr>
          <td><form action="<? echo $_SERVER["PHP_SELF"]; ?>?fu=2" method="post" name="formular" onSubmit="if(this.loginname.value==''){alert('Bitte Benutzername angeben!'); return false; } if (this.passwort.value==''){alert('Bitte ein Passwort angeben!'); return false; } if (this.passwort.value!=this.passwort2.value){alert('Die Angabe der Passwoerter muss identisch sein!'); return false;}"></td>
          <td align="right">Benutzername&nbsp;</td>
          <td><input type="text" name="loginname" maxlength="30" style="width:350px<?php if ($_GET["op"]=="wrong-name"){?>; border-width:2pt; border-color:red; border-style:solid; color:maroon<?php } ?>" value="" /></td>
          <td></td>
                                 </tr>
<tr><td></td><td align="right">Passwort&nbsp;</td>
<td><input type="password" name="passwort" maxlength="50" style="width:350px" value=""></td></tr>
<tr><td></td><td align="right">Passwort wiederholen&nbsp;</td>
<td><input type="password" name="passwort2" maxlength="50" style="width:350px" value=""></td></tr>
                                 <tr>
                                        <td></td>
          <td align="right">E-Mail-Adresse*&nbsp;</td>
          <td><input type="text" name="email"" maxlength="255" style="width:350px;" value=""></td>
                                        <td></td>
                                 </tr>
<tr><td colspan="3"><hr /></td></tr>
<tr><td colspan="2" rowspan="2"><img id="captcha" src="inc/captcha.php" alt="Captcha" width="150" height="75"<?php if ($_GET["op"]=="wrong-captcha"){?> style="border-width:2pt; border-color:red; border-style:solid"<?php } ?> /><br /><a href="javascript:void(0)" onClick="document.getElementById('captcha').src='<?php echo $skrupel_path; ?>/bilder/radb.gif'; setTimeout('document.getElementById(\'captcha\').src=\'inc/captcha.php#\'+Math.random()', 10)">Neu laden</a></td><td>Captcha eingeben:</td></tr>
<tr><td><input type="text" name="captcha" value=""<?php if ($_GET["op"]=="wrong-captcha"){?> style="border-width:2pt; border-color:red; border-style:solid; color:maroon"<?php } ?> /></td></tr>
         <tr>
                                        <td></td>
          <td align="right">&nbsp;</td>
          <td align="center"><input type="submit" value="Registrieren!" style="width:300px;"></td>
          <td></form></td>
         </tr>
       </table></center>
<?php }
else if ($_GET["fu"]==2 && $_POST["loginname"] && $_POST["passwort"] && $_POST["loginname"]!="" && $_POST["passwort"]!="" && $_POST["passwort"]==$_POST["passwort2"])
{ if (! isset($_SESSION["captcha"]) || $_POST["captcha"]!=$_SESSION["captcha"] || empty($_SESSION["captcha"]))
{ unset($_SESSION["captcha"]); header('Location: '.$_SERVER["PHP_SELF"].'?fu=1&op=wrong-captcha'); exit; }
unset($_SESSION["captcha"]);
$loginname=$_POST["loginname"]; $passwort=$_POST["passwort"]; 
if (! $_POST["email"] || $_POST["email"]=="")
{ $email=""; }
else
{ $email=$_POST["email"];
$text="Herzlich willkommen bei <a href=\"http://".$_SERVER["SERVER_NAME"]."\">".$servername."</a>!<br />Sie erhalten diese E-Mail, da Sie diese Adresse bei der Registration angegeben haben.<br />Im Folgenden Ihre Login-Daten:<hr /><ul><li>Benutzername: ".$loginname."</li><li>Passwort: ".$passwort."</li></ul><hr />Liebe Gr&uuml;&szlig;e,<br />Ihr ".$servername."-Team.";
$extra="From: Skrupel - Tribute Compilation <".$absenderemail.">\n"; $extra .= "Content-Type: text/html\n";
mail($email, "Ihre Registrierung bei $servername", $text, $extra); }

  $zeiger = mysql_query("SELECT count(*) as total FROM $skrupel_user where nick='$loginname'");
  $array = @mysql_fetch_array($zeiger);
  $total=$array["total"];
  if ($total>=1) { header('Location: '.$_SERVER["PHP_SELF"].'?fu=1&op=wrong-name'); die("Benutzername bereits vorhanden.");}
else {
  $zeiger = @mysql_query("INSERT INTO $skrupel_user (nick,passwort,email,optionen,portal_layout) VALUES ('$loginname','$passwort','$email','10111111111000','$template')");
  $zeiger = @mysql_query("INSERT INTO $skrupel_chat (datum,text,von,farbe) VALUES ('".time()."', '$loginname hat sich f�r dieses Spiel registriert.', 'System', '000000')");
  require_once ("inc/_header.php");
?>
<center><img src="<?php echo $skrupel_path; ?>bilder/logo_login.gif" />
Sie haben sich erfolgreich registriert.
<form name="login" method="post" action="index.php"><input type="hidden" name="login" value="<?php echo $loginname; ?>" /><input type="hidden" name="pass" value="<?php echo $passwort; ?>" /><input type="submit" value="Einloggen!" /></form></center>
<?php } } 
require_once ("inc/_footer.php"); ?>