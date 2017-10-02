<?php
  include "inc/conf.php";
  require ($skrupel_path."inc.conf.php");
  include "inc/initial.php";
$page_name="Neuigkeiten";
  require_once ("inc/_header.php");

  if(file_exists($skrupel_path."extend/bbc/bbc.php"))
	{ require ($skrupel_path."extend/bbc/bbc.php"); $bbc=1; }
else { $bbc=0; }

  $query = mysql_query("SELECT datum, beitrag FROM $skrupel_forum_beitrag WHERE verfasser = \"Gott\" ORDER BY id DESC LIMIT ".$news_limit);
  echo "<table align=\"center\">";
  while ( $news = mysql_fetch_assoc( $query ) )
  {
$beitrag=$news["beitrag"];
if ($bbc==1)
{ $beitrag = bbc($beitrag); }
    echo "<tr><td align=\"right\"><span style=\"font-size:14px; font-weight:bold;\">".strftime( "%d.%m.%Y %T", $news["datum"]) ."</span></td></tr><tr><td>". $beitrag ."</td></tr>";
  }  
  echo "</table>";
?>
<hr />
<img src="pics/rss.png" alt="RSS" /> <a href="news.xml.php" target="_blank">RSS-Version anzeigen</a>
<?php
  require_once ("inc/_footer.php");
?>

