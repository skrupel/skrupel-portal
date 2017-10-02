<?php
include "inc/conf.php";
include "inc/initial.php";
include ($skrupel_path."inc.conf.php");
include ($skrupel_path."lang/de/lang.admin.welcome.php");

if (file_exists($skrupel_path."extend/bbc/bbc.php"))
{ $bbc=1; } else { $bbc=0; }

if (!$_SESSION["user_id"] || $_SESSION["name"]!=ADMIN)
{ header('Location: index.php'); exit; }

$page_name="Administration";
require_once ("inc/_header.php");

?>
<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><center>
    <img src="<?php echo $skrupel_path; ?>bilder/logo_login.gif" width="329" height="208"><br>
    <table border="0" cellspacing="0" cellpadding="0">
    <tr><td><h1><?php echo $lang['admin']['welcome']['admin']?></h1></td></tr>
    </table>
    </center></td>
  </tr>
<tr><td>
<table border width="500">
<colgroup>
<?php if ($bbc==1){ ?>
<col span="3" width="33%" />
<?php } else { ?>
<col span="2" width="50%" />
<?php } ?>
</colgroup>
<!--caption align="top"><?php
//$update = file_get_contents ("http://www.space-pirates.4lima.de/webmaster/portal/updates.php?portal=".$portal_version."&patch=".$patch_version);
//if (! $update )
//{ echo 'Das Update-Panel ist abgest&uuml;rzt.<br />N&auml;heres hierzu <a href="http://board.skrupel.de/viewtopic.php?f=9&t=20914">im Forum</a> oder beim <a href="http://www.space-pirates.4lima.de/webmaster/portal/">Entwickler</a>.'; }
//else { echo $update; }
?></caption-->
<tr align="center"><th>Portal (Info)</th><th>Portal (Einstellungen)</th><th>Portal (Links)</th>
<tr align="center"><td><a href="admin_feedback.php">Feedback</a></td><td><a href="admin_impressum.php">Impressum</a></td><td><a href="http://www.space-pirates.4lima.de/portal/webmaster.php" target="_blank">Webmaster-Tools</a></td></tr>
<tr align="center"><td>Besucher-Stats</td><td><a href="admin_settings.php">Konfiguration</a></td><td><a href="http://www.space-pirates.4lima.de/webmaster/portal/" target="_blank">Ofiizielle Website</a></td></tr>
<tr align="center"><td>&nbsp;</td><td>Updates</td><td><a href="http://board.skrupel.de/viewtopic.php?f=9&t=20914&st=0&sk=t&sd=a" target="_blank">Diskussion</a></td></tr>
</table>
</td></tr>
<tr><td><table border width="500">
<colgroup>
<col span="3" width="33%" />
</colgroup>
<tr><th>Allgemein</th><th>Mitspieler</th><th>Aktive Galaxien</th></tr>
<tr align="center"><td><a href="admin_offenbarung.php">Offenbarung</a></td><td><a href="admin_newmember.php">Spieler anlegen</a></td><td><a href="spiel_alpha.php">Spiel erstellen</a></td></tr>
<tr align="center"><td><a href="admin_conf.php">Spieleinstellungen</a></td><td><a href="admin_bann.php">Spieler bannen</a></td><td><a href="admin_editspiel.php">Spiele bearbeiten</a></td></tr>
<tr align="center"><td><a href="admin_extend.php">Erweiterungen</a></td><td><a href="admin_delspieler.php">Spieler l&ouml;schen</a></td><td><a href="admin_delspiel.php">Spiele l&ouml;schen</a></td></tr>
</table></td></tr></table>
<?php if (file_exists($skrupel_path."extend/bbc/bbc.php")){ ?><hr /><a href="admin_bbc.php">BBCode-Einstellungen &auml;ndern</a><?php } ?>
</center>
<?php
require_once ("inc/_footer.php");
?>