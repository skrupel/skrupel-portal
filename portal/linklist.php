<?php
include "inc/conf.php";
include "inc/initial.php";
require ($skrupel_path."inc.conf.php");
$page_name="Partner";

function clearText($text)
{ $edit=Array();
$edit[0]="<";
$edit[1]=">";
$edit[2]="Ä";
$edit[3]="Ü";
$edit[4]="Ö";
$edit[5]="ä";
$edit[6]="ü";
$edit[7]="ö";
$edit[8]="ß";
$change=Array();
$change[0]="&lt;";
$change[1]="&gt;";
$change[2]="&Auml;";
$change[3]="&Uuml;";
$change[4]="&Ouml;";
$change[5]="&auml;";
$change[6]="&uuml;";
$change[7]="&ouml;";
$change[8]="&szlig;";
for ($zaehler=0; $zaehler<count($edit); $zaehler++)
{ $text=str_replace($edit[$zaehler], $change[$zaehler], $text);
} return $text; }

if (! $_GET["fu"] || $_GET["fu"]==1)
{ require_once ("inc/_header.php");

$order=$_GET["order"];
$sort=$_GET["sort"];
if ($order!="title" && $order!="id" && $order!="views")
{ $order="views"; }
if ($sort!="ASC" && $sort!="DESC")
{ $sort="DESC"; }
$select=$order." ".$sort;

?>
<center>
<h1>Unsere Partner</h1>
<form name="select" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
<input type="hidden" name="fu" value="1" />
<select name="order">
<option value="title"<?php if($order=="title"){?> selected<?php } ?>>Name (Alphabet)</option>
<option value="id"<?php if($order=="id"){?> selected<?php } ?>>Eintragsdatum</option>
<option value="views"<?php if($order=="views"){?> selected<?php } ?>>Klicks</option>
</select>
<select name="sort">
<option value="DESC"<?php if($sort=="DESC"){?> selected<?php } ?>>Absteigend</option>
<option value="ASC"<?php if($sort=="ASC"){?> selected<?php } ?>>Aufsteigend</option>
</select>
<input type="submit" value="Sortieren!" /></form>
<table width="90%">
<thead><tr><th align="left">Website</th><th align="left">Klicks</th>
<?php if (isset($_SESSION["user_id"]) && $_SESSION["name"]==ADMIN) { ?>
<th align="left">Administration</th>
<?php } ?>
</tr></thead>

<tbody>
<?php
$count=0;
$ergebnis = mysql_query("SELECT id, title, url, views, description FROM $skrupel_portal_linklist ORDER BY $select, title ASC");
while($row = mysql_fetch_object($ergebnis))
{ $count++; ?>
<tr><td style="white-space:nowrap"><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=2&url=<?php echo $row->url; ?>" title="<?php echo clearText($row->description); ?>" target="_blank"><?php echo $row->title; ?></a></td><td align="center"><?php echo $row->views; ?></td>
<?php
if (isset($_SESSION["user_id"]) && $_SESSION["name"]==ADMIN)
{ ?>
<td style="white-space:nowrap" align="left"><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=4&id=<?php echo $row->id; ?>&ok=0" rel="shadowbox;title=<?php echo $row->title; ?> - Eintrag bearbeiten;width=800;height=400">Bearbeiten</a> | <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=5&id=<?php echo $row->id; ?>&ok=0" rel="shadowbox;title=<?php echo $row->title; ?> - Eintrag entfernen;width=800;height=400">L&ouml;schen</a>
<?php } ?>
</tr>
<?php }
if ($count==0)
{ ?>
<tr><td>Kein Eintrag vorhanden.</td></tr>
<?php }
?>
</tbody>
</table><hr />
<?php
if (isset($_SESSION["user_id"]) && $_SESSION["name"]==ADMIN)
{ ?>
<div align="center"><input type="button" onClick="var inner = this.parentNode.getElementsByTagName('div')[0]; if (inner.style.display == 'none'){inner.style.display = ''; this.value='Formular einklappen';}else{inner.style.display = 'none'; this.value='Formular ausklappen';}" value="Seite eintragen..."><div style="display:none" align="left">
<form name="new" action="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=3" method="post">
<table><tr><td>Seitenname:</td><td><input name="title" maxlength="40" /></td></tr>
<tr><td>Seiten-URL:</td><td><input name="url" maxlength="150" value="http://" /></td></tr>
<tr><td colspan="2"><textarea name="description" cols="30" rows="4"></textarea></td></tr>
<tr><td colspan="2"><input type="submit" value="Seite eintragen!" /></td></tr></table>
</form></div></div>
<?php } 
require_once ("inc/_footer.php"); }

else if ($_GET["fu"]==2)
{ $page=$_GET['url'];
if ($page=="" || empty($page) || ! isset($page))
{ header('Location:'.$_SERVER["PHP_SELF"].'?fu=1'); exit; }
else
{ 
$ergebnis = mysql_query("SELECT id, views FROM $skrupel_portal_linklist WHERE url='$page'");
while($row = mysql_fetch_object($ergebnis))
{
$views=$row->views+1;
}

$aendern = mysql_query("UPDATE $skrupel_portal_linklist SET views = '$views' WHERE url = '$page'"); }
header('Location: '.$page); exit;
}

else if ($_GET["fu"]==3)
{ 
if (! isset($_SESSION["user_id"]) || $_SESSION["name"]!=ADMIN || ! isset ($_POST["url"]) || ! isset ($_POST["title"]) || $_POST["url"]=="" || $_POST["title"]=="")
{ header('Location: '.$_SERVER["PHP_SELF"].'?fu=1'); exit; }

$title=str_replace(";", ",", $_POST["title"]);
$url=$_POST["url"];
$description=$_POST["description"];
$eintragen = mysql_query("INSERT INTO $skrupel_portal_linklist (title, url, views, description) VALUES ('$title', '$url', '0', '$description')");
require_once ("inc/_header.php");
?>
Eintrag erfolgreich.
<form name="back" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
<input type="hidden" name="fu" value="1" />
<input type="submit" value="Zur&uuml;ck" />
</form>
<?php
require_once ("inc/_footer.php");
}
else if ($_GET["fu"]==4)
{ 
if (! isset($_GET["id"]) || $_GET["id"]=="" || ! isset($_SESSION["user_id"]) || $_SESSION["name"]!=ADMIN)
{ die(); }
$ok=$_GET["ok"];
if ($ok!=0 && $ok!=1)
{ $ok=0; }

if ($ok==0)
{ $ergebnis = mysql_query("SELECT id, title, url, views, description FROM $skrupel_portal_linklist WHERE id='".$_GET["id"]."'");
while($data = mysql_fetch_array($ergebnis)){
?>
<center>
<span style="color:silver"><h1>Eintrag editieren</h1></span>
<form name="edit" action="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=4&ok=1&id=<?php echo $_GET["id"]; ?>" method="post">
<table style="color:silver"><tr><td>Seitenname:</td><td><input name="title" maxlength="40" value="<?php echo $data["title"]; ?>" /></td></tr>
<tr><td>Seiten-URL:</td><td><input name="url" maxlength="150" value="<?php echo $data["url"]; ?>" /></td></tr>
<tr><td colspan="2"><textarea name="description" cols="30" rows="4"><?php echo $data["description"]; ?></textarea></td></tr>
<tr><td colspan="2"><input type="submit" value="Eintrag &auml;ndern" /></td></tr></table>
</form></center>
<?php } }
else {
if (! isset($_GET["id"]) || ! isset($_SESSION["user_id"]) || $_SESSION["name"]!=ADMIN)
{ die(); }
$id=$_GET["id"];
$title=str_replace(";", ",", $_POST["title"]); $url=$_POST["url"]; $description=$_POST["description"];
if (! isset($title) || $title=="" || ! isset($url) || $url=="")
{ header('Location: '.$_SERVER["PHP_SELF"].'?fu=4&ok=0&id='.$id); exit; }
$update = mysql_query("UPDATE $skrupel_portal_linklist SET title='$title', url='$url', description='$description' WHERE id='$id'");
?>
<center>
<span style="color:silver">
<h1>Eintrag editieren</h1>
&Auml;nderungen erfolgreich.</span>
<form name="back" action="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=4&ok=0&id=<?php echo $id; ?>" method="post">
<input type="submit" value="Zur&uuml;ck" />
</form>
</center>
<?php
} }
else if ($_GET["fu"]==5)
{
$id=$_GET["id"];
$ok=$_GET["ok"];
if ($ok!=0 && $ok!=1)
{ $ok=0; }
if (! isset($id) || $id=="" || ! isset($_SESSION["user_id"]) || $_SESSION["name"]!=ADMIN)
{ die(); }
if ($ok==0){ ?>
<form name="delete" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
<input type="hidden" name="fu" value="5" />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="ok" value="1" />
<span style="color:silver">
<h1>Eintrag l&ouml;schen</h1>
M&ouml;chten Sie den Eintrag wirklich l&ouml;schen</span>
<br /><input type="submit" value="Ja, l&ouml;schen" />
</form>
<?php
} else {
$del = mysql_query("DELETE FROM $skrupel_portal_linklist WHERE id='$id'");
?>
<span style="color:silver">
<h1>Eintrag l&ouml;schen</h1>
Eintrag erfolgreich entfernt.</span>
<?php
} }
?>