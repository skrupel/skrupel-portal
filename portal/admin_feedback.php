<?php
include "inc/conf.php";
include "inc/initial.php";
require ($skrupel_path."inc.conf.php");
if (file_exists($skrupel_path."extend/bbc/bbc.php"))
{ require ($skrupel_path."extend/bbc/bbc.php"); $bbc=1; }
else { $bbc=0; }

if (! $_SESSION["mail"] || $_SESSION["mail"]=="")
{ $mail=$absenderemail; }
else { $mail=$_SESSION["mail"]; }

if (! $_SESSION["user_id"] || $_SESSION["name"]!=ADMIN)
{ header('Location: index.php'); }

$page_name="Feedback";
require_once ("inc/_header.php");

if ($_GET["fu"]!=1 && $_GET["fu"]!=2)
{ $_GET["fu"]=1; }

if ($_GET["fu"]==1){?>
<form name="feedback" action="admin_feedback.php?fu=2" method="post" onSubmit="if (this.name.value=='' || this.mail.value=='' || this.content.value==''){alert('Nicht alle Felder ausgefüllt!'); return false;}">
<table>
<caption align="top"><h1>Feedback</h1>Hier haben Sie die M&ouml;glichkeit, <br />dem Ersteller des SpacePirates-Portals eine Mail zu senden.</caption>
<thead>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><th colspan="2">Pers&ouml;nliche Angaben</th></tr>
<tr><td>Name</td><td align="left"><input type="text" name="name" value="<?php echo $_SESSION["name"]; ?>" /></td></tr>
<tr><td>EMail</td><td align="left"><input type="text" name="mail" value="<?php echo $mail; ?>" /></td></tr>
</thead>
<tbody>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><th colspan="2">Nachricht <?php if ($bbc==1) {?>(<em>BBCodes erlaubt</em>)<?php } ?></th></tr>
<tr><td colspan="2"><textarea name="content" style="width:350pt; height:200pt"></textarea></td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Absenden!">
</tbody></table>
</form>
<?php } 
else {
if (! $_POST["name"] || ! $_POST["mail"] || ! $_POST["content"])
{ die ("Mail konnte nicht gesendet werden."); }
$empfaenger = "korathin@web.de";
$absender = $_POST["mail"];
$betreff = "Feedback eines Portal-Nutzers";

$header  = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";

$header .= "From: ".$absender."\r\n";
$header .= "X-Mailer: PHP ". phpversion();

$content=$_POST["content"];
if ($bbc==1) { $content=bbc($content); }
$mailtext="Ein Portal-Nutzer namens".$_POST["name"]." hat Feedback gegeben.<br />Die Mail kommt vom Server ".$_SERVER["SERVER_NAME"]." :<br /><br />".$content;

$submit = @mail( $empfaenger, $betreff, $mailtext, $header);
if ($submit)
{ echo "Die Mail wurde erfolgreich versandt."; }
else { echo "Die Mail konnte leider nicht versandt werden.<br />Bitte &uuml;berpr&uuml;fen Sie Ihre Angaben."; }
} require_once ("inc/_footer.php");
?>