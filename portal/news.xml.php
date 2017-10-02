<?php
$page_name="Neuigkeiten";
header('Content-Type: text/xml; charset='.$encoding);
  include "inc/conf.php";
  include "inc/initial.php";
  require ($skrupel_path."inc.conf.php");
if (file_exists($skrupel_path."extend/bbc/bbc.php"))
{ require ($skrupel_path."extend/bbc/bbc.php"); }
echo '<?xml version="1.0" encoding="'.$encoding.'"?>';
$server="http://".$_SERVER["SERVER_NAME"]."/";
$feed=$server."portal/news.php"; ?>
<rss version="2.0">
<channel>
<title><?php echo $servername; ?> - <?php echo $seitentitel; ?> - <?php echo $page_name; ?></title>
<link><?php echo $feed; ?></link>
<description>Hier kann man alle Neuigkeiten auf <?php echo $servername; ?> mitverfolgen.</description>
<image>
<url><?php echo $server; ?>bilder/logo.gif</url>
<title><?php echo $title; ?></title>
<link><?php echo $server; ?>portal/</link>
</image>
<language>de-de</language>
<copyright>Till Affeldt (Space-Pirates.zx9.de)</copyright>

<?php
  $query = mysql_query("SELECT datum, beitrag FROM $skrupel_forum_beitrag WHERE verfasser = \"Gott\" ORDER BY id DESC LIMIT ".$news_limit);
  while ( $news = mysql_fetch_assoc( $query ) )
  {
echo "<item>\n<title>".date("d.m.y", $news["datum"])."</title>\n";
$beitrag=$news["beitrag"];
if (file_exists($skrupel_path."extend/bbc/"))
{
if (function_exists(createXML))
{ $beitrag=createXML($beitrag, $encoding); }
}
else if (preg_match("#utf-8#is", $encoding)==1)
{ $beitrag = str_replace("ä", "ae", $beitrag);
$beitrag = str_replace("ü", "ue", $beitrag);
$beitrag = str_replace("ö", "oe", $beitrag);
$beitrag = str_replace("Ä", "Ae", $beitrag);
$beitrag = str_replace("Ü", "Ue", $beitrag);
$beitrag = str_replace("Ö", "Oe", $beitrag);
$beitrag = str_replace("ß", "ss", $beitrag); }

$beitrag = str_replace("&", " und ", $beitrag);

echo "<description>".$beitrag."</description>\n<link>".$feed."</link>\n<author>".$absenderemail." (".ADMIN.") </author>\n</item>";
  }  
?>
</channel>
</rss>