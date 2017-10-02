<?php
include "inc/conf.php";
require ($skrupel_path."inc.conf.php");
include "inc/initial.php";
$page_name="Nachrichten";

if (file_exists($skrupel_path."extend/bbc/bbc.php"))
{ require ($skrupel_path."extend/bbc/bbc.php"); }

function getNick($user_id)
{ include "inc/conf.php";
include ($skrupel_path."inc.conf.php");
$sql=mysql_query("SELECT nick FROM $skrupel_user WHERE id='$user_id' LIMIT 1");
while ($daten=mysql_fetch_array($sql))
{ $nick=$daten["nick"]; }
if (! isset($nick) || empty($nick))
{ if ($abs_id==0)
{ $nick="System"; }
else {$nick="Gel&ouml;scht"; } }
return $nick; }

if (! isset($_SESSION["user_id"]))
{ header('Location: index.php'); exit; }

if ($_GET["delete"])
{ $del=$_GET["delete"];
$user=$_SESSION["user_id"];
if ($del=="all")
{ if ($_SESSION["name"]==ADMIN)
{ $delete=mysql_query("DELETE FROM $skrupel_portal_messages WHERE empfaenger='$user' OR empfaenger='0'"); }
else { $delete=mysql_query("DELETE FROM $skrupel_portal_messages WHERE empfaenger='$user'1"); } }
else if ($_SESSION["name"]==ADMIN)
{ $delete=mysql_query("DELETE FROM $skrupel_portal_messages WHERE id='$del' LIMIT 1"); }
else { $delete=mysql_query("DELETE FROM $skrupel_portal_messages WHERE id='$del' AND empfaenger='$user' LIMIT 1");
$delete=mysql_query("DELETE FROM $skrupel_portal_messages WHERE id='$del' AND absender='$user' AND status='1' LIMIT 1"); } }

if ($_GET["mark"])
{ $mark=$_GET["mark"];
$user=$_SESSION["user_id"];
if ($mark=="all")
{ if ($_SESSION["name"]==ADMIN)
{ $delete=mysql_query("UPDATE $skrupel_portal_messages SET status='1' WHERE empfaenger='$user' OR empfaenger='0'"); }
else { $delete=mysql_query("UPDATE $skrupel_portal_messages SET status='1' WHERE empfaenger='$user'1"); } }
else if ($_SESSION["name"]==ADMIN)
{ $delete=mysql_query("UPDATE $skrupel_portal_messages SET status='1' WHERE id='$mark'"); }
else { $delete=mysql_query("UPDATE $skrupel_portal_messages SET status='1' WHERE id='$mark' AND empfaenger='$user'"); } }

if (! $_GET["fu"])
{ $_GET["fu"]=1; }

if ($_GET["fu"]==1)
{ $page_name="Posteingang";
require_once ("inc/_header.php");
?>
<h1>Posteingang</h1>
<?php
if ($_SESSION["name"]==ADMIN)
{ $zeiger=mysql_query("SELECT count(*) AS zaehler FROM $skrupel_portal_messages WHERE empfaenger='".$_SESSION["user_id"]."' OR empfaenger=0 LIMIT 1"); }
else { $zeiger=mysql_query("SELECT count(*) AS zaehler FROM $skrupel_portal_messages WHERE empfaenger='".$_SESSION["user_id"]."' LIMIT 1"); }
while($data=mysql_fetch_array($zeiger))
{ if ($data["zaehler"]>0) {
?>
<table width="90%">
<caption align="bottom"><hr /><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1&mark=all">Alle als gelesen markieren</a> | <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1&delete=all">Alle l&ouml;schen</a></caption>
<tr><th>Status</th><th>Nachricht</th><th>Absender</th><th>Datum</th><th>Aktionen</th></tr>
<?php
if ($_SESSION["name"]==ADMIN)
{ $zeiger2=mysql_query("SELECT * FROM $skrupel_portal_messages WHERE empfaenger='".$_SESSION["user_id"]."' OR empfaenger=0 ORDER BY status ASC, id DESC"); }
else { $zeiger2=mysql_query("SELECT * FROM $skrupel_portal_messages WHERE empfaenger='".$_SESSION["user_id"]."' ORDER BY status ASC, id ASC"); }
while ($data2=mysql_fetch_array($zeiger2)) { 
$pn_id=$data2["id"];
$betreff=$data2["title"];
$time=date("d.m.y", $data2["time"]);
$time2=date("d.m.y, H:m:s", $data2["time"]);
$abs_id=$data2["absender"];
$abs_name=getNick($abs_id);
$read=$data2["status"];
if ($read==0)
{ $pic="pics/mail/mail_new.png"; $pic_title="Ungelesen"; }
else if ($read==1) { $pic="pics/mail/mail_read.png"; $pic_title="Gelesen"; }

?>
<tr align="center"><td><img src="<?php echo $pic; ?>" alt="PN" title="<?php echo $pic_title; ?>" width="35" height="35" /></td><td><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=2&id=<?php echo $pn_id; ?>"><?php echo $betreff; ?></a></td><td><?php echo $abs_name; ?></td><td title="<?php echo $time2; ?>"><?php echo $time; ?></td>
<td><?php if ($read==0){?><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1&mark=<?php echo $pn_id; ?>"><img src="pics/ja.gif" alt="DONE" title="Als gelesen markieren" height="25" width="25" /></a> <?php } ?>
<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1&delete=<?php echo $pn_id; ?>"><img src="pics/nein.gif" alt="DEL" title="L&ouml;schen" width="25" height="25" /></a>
<?php if ($abs_id!=0 && $abs_name!="Gel&ouml;scht") { ?><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=3&op=reply&id=<?php echo $pn_id; ?>"><img src="pics/mail/mail_answered2.png" alt="Answer" title="Antworten" width="25" height="25" /></a><?php } ?>
<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=3&op=submit&id=<?php echo $pn_id; ?>"><img src="pics/mail/mail_answered.png" alt="Relegate" title="Weiterleiten" width="25" height="25" /></a></td></tr>
<?php } ?>
</table>
<?php
} else { ?>
Keine Nachrichten vorhanden.
<?php } }
require_once ("inc/_footer.php");
}


else if ($_GET["fu"]==2)
{ if (! isset($_GET["id"]))
{ header('Location: '.$_SERVER["PHP_SELF"].'?fu=1'); exit; }
$pn_id=$_GET["id"];
$zeiger=mysql_query("SELECT * FROM $skrupel_portal_messages WHERE id='$pn_id' LIMIT 1");
while($data=mysql_fetch_array($zeiger))
{ $empf_id=$data["empfaenger"];
$empf_name=getNick($empf_id);
$content=$data["text"];
if (file_exists($skrupel_path."extend/bbc/bbc.php"))
{ $content=bbc($content); }
else { $content=str_replace("<", "&lt;", $content);
$content=str_replace(">", "&gt;", $content);
$content=nl2br($content); }
$status=$data["status"];
$betreff=$data["title"];
$abs_id=$data["absender"];
$abs_name=getNick($abs_id);} 
if ($_SESSION["user_id"]!=$empf_id && $_SESSION["user_id"]!=$abs_id && $_SESSION["name"]!=ADMIN)
{ header('Location: '.$_SERVER["PHP_SELF"].'?fu=1'); exit; }
else if ($_SESSION["user_id"]==$empf_id)
{ $update = mysql_query("UPDATE $skrupel_portal_messages SET status= '1' WHERE id = '$pn_id'"); }
else if ($empf_id==0 && $_SESSION["name"]==ADMIN && isset($_SESSION["user_id"]))
{ $update = mysql_query("UPDATE $skrupel_portal_messages SET status= '1' WHERE id = '$pn_id'"); }
$page_name="Nachricht lesen"; require_once ("inc/_header.php");
?>
<h1 style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2); font-family:Times;"><?php echo $betreff; ?></h1>
<table width="90%">
<tr><td><?php if ($_SESSION["user_id"]!=$abs_id){?>von: <b><?php echo $abs_name; ?></b> <?php } if ($_SESSION["user_id"]!=$empf_id){?>an: <b><?php echo $empf_name; ?></b><?php } ?></td></tr>
<tr><td><?php if ($_SESSION["user_id"]==$empf_id || $status==0){?><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1&delete=<?php echo $pn_id; ?>" title="Nachricht l&ouml;schen">L&ouml;schen</a> <?php if ($abs_id!=0 && $abs_name!="Gel&ouml;scht") { echo "|"; } } if ($abs_id!=0 && $abs_name!="Gel&ouml;scht") { ?>  <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=3&op=reply&id=<?php echo $pn_id; ?>">Antworten</a> <?php } ?>| <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=3&op=submit&id=<?php echo $pn_id; ?>">Weiterleiten</a></td></tr>
<tr><td><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1">Posteingang</a> | <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=5">Postausgang</a></td></tr>
<tr><td><?php echo $content; ?></td></tr>
</table>
<?php
require_once ("inc/_footer.php");
}

else if ($_GET["fu"]==3)
{ 
if (isset($_GET["id"]))
{ $pn_id=$_GET["id"];
if ($_SESSION["name"]==ADMIN)
{ $zeiger=mysql_query("SELECT * FROM $skrupel_portal_messages WHERE id='$pn_id' LIMIT 1"); }
else { $zeiger=mysql_query("SELECT * FROM $skrupel_portal_messages WHERE id='$pn_id' AND empfaenger='".$_SESSION["user_id"]."' LIMIT 1"); }
while($data=mysql_fetch_array($zeiger))
{ $betreff=$data["title"];
if (preg_match("#RE: #is", $betreff)==0 && $_GET["op"]=="reply")
{ $betreff="RE: ".$betreff; }
$abs_id=$data["absender"];
$abs_name=getNick($abs_id);
$content=$data["text"];
if (file_exists($skrupel_path."extend/bbc/bbc.php"))
{ $content="\n\n[quote=".$abs_name."]".$content."[/quote]"; }
else { $content="\n\n---------- Vorherige Nachricht ----------\n".$content; }
if ($_GET["op"]=="reply")
{ $empf=$abs_name; }
else { $empf=""; } } }
if (isset($_GET["to"]))
{ $empf=$_GET["to"]; }

$page_name="Neue Nachricht"; require_once ("inc/_header.php");
?>
<h1>Nachricht verfassen</h1>
<form name="message" action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?fu=4" method="post" onSubmit="if(this.empf.value=='<?php echo $_SESSION["name"]; ?>'){alert('Du kannst dir nicht selbst eine PN schicken!'); return false;}">
<table>
<caption align="bottom"><hr /></caption>
<tr><td><div>Empf&auml;nger:</td><td><input style="height:18px; width:130px; z-index:1;" onKeyUp="load()" name="empf" value="<?php echo $empf; ?>" autocomplete="off" /><div id="af"><span id="Daten"></span></div></div></td></tr>
<tr><td>Betreff:</td><td><input type="text" name="betreff" style="z-index:1;" value="<?php echo $betreff; ?>"></td></tr>
</table>
<big>Nachricht<?php if (file_exists($skrupel_path."extend/bbc/bbc.php")){?> (BBCodes erlaubt)<?php } ?>:</big>
<br /><textarea name="inhalt" cols="40" rows="8"><?php echo $content; ?></textarea>
<br /><input type="submit" value="Absenden" />
</form>
<?php
require_once ("inc/_footer.php"); }

else if ($_GET["fu"]==4)
{ include "inc/pn_delivery.php";
$page_name="Nachricht versenden"; require_once ("inc/_header.php");
if (isset($_POST["inhalt"]) && isset($_POST["betreff"]) && isset($_POST["empf"]))
{ $_POST["empf"]=str_replace("\r\n", "", $_POST["empf"]);
$_POST["empf"]=str_replace("\n", "", $_POST["empf"]);
$submit=sendUserPN($_POST["empf"], $_POST["betreff"], $_POST["inhalt"]);
if ($submit!=0){echo "Nachricht erfolgreich versandt."; }}
else { echo "Fehler: Nicht alle Daten angegeben."; }
?> <br /><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=3" title="Weitere Nachricht schreiben">Neue Nachricht</a> | <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1">Posteingang</a> <?php
require_once ("inc/_footer.php"); }


else if ($_GET["fu"]==5)
{ $page_name="Postausgang"; require_once ("inc/_header.php");
?>
<h1>Postausgang</h1>
<?php
$zeiger=mysql_query("SELECT count(*) AS zaehler FROM $skrupel_portal_messages WHERE absender='".$_SESSION["user_id"]."' LIMIT 1");
while($data=mysql_fetch_array($zeiger))
{ if ($data["zaehler"]>0) {
?>
<table width="90%">
<tr><th>Status</th><th>Nachricht</th><th>Empf&auml;nger</th><th>Datum</th></tr>
<?php
$zeiger2=mysql_query("SELECT * FROM $skrupel_portal_messages WHERE absender='".$_SESSION["user_id"]."' ORDER BY id ASC");
while ($data2=mysql_fetch_array($zeiger2)) { 
$pn_id=$data2["id"];
$betreff=$data2["title"];
$time=date("d.m.y", $data2["time"]);
$time2=date("d.m.y, H:m:s", $data2["time"]);
$empf_id=$data2["empfaenger"];
$empf_name=getNick($empf_id);
$read=$data2["status"];
if ($read==0)
{ $pic="pics/mail/mail_new.png"; $pic_title="Ungelesen"; }
else if ($read==1) { $pic="pics/mail/mail_read.png"; $pic_title="Gelesen"; }

?>
<tr align="center"><td><img src="<?php echo $pic; ?>" alt="PN" title="<?php echo $pic_title; ?>" width="35" height="35" /></td><td><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=2&id=<?php echo $pn_id; ?>"><?php echo $betreff; ?></a></td><td><?php echo $empf_name; ?></td><td title="<?php echo $time2; ?>"><?php echo $time; ?></td>
<td></tr>
<?php } ?>
</table>
<?php
} else { ?>
Noch keine Nachrichten versandt.
<?php } }
require_once ("inc/_footer.php");
}

?>