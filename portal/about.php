<?php
include "inc/conf.php";
include "inc/initial.php";
$page_name="Server-Info";
require_once ("inc/_header.php");
require($skrupel_path."inc.conf.php");
   $sql_benutzerliste = "SELECT * FROM $skrupel_user ORDER BY nick";
   $sql_sternenbasen = "SELECT * FROM $skrupel_sternenbasen";
   $sql_spiele = "SELECT * FROM $skrupel_spiele ORDER BY name";
   $sql_schiffe = "SELECT * FROM $skrupel_schiffe";
   $sql_planeten = "SELECT kolonisten FROM $skrupel_planeten";
   $sql_serverversion = "SELECT version FROM $skrupel_info LIMIT 1";
   $sql_spiele_wartend = "SELECT * FROM $skrupel_portal_games ORDER BY id";

   $abf_benutzerliste = mysql_query($sql_benutzerliste);
   $abf_sternenbasen = mysql_query($sql_sternenbasen);
   $abf_spiele = mysql_query($sql_spiele);
   $abf_schiffe = mysql_query($sql_schiffe);
   $abf_planeten = mysql_query($sql_planeten);
   $abf_serverversion = mysql_query($sql_serverversion);
   $abf_spiele_wartend = mysql_query($sql_spiele_wartend);

$skrupelversion="Unbekannt";
$count_spiele=0;
$count_spiele_aktiv="0";
$count_spiele_beendet="0";
$count_spiele_wartend="0";
$count_sternenbasen="0";
$count_schiffe="0";
$count_schiffe_lj="0";
$count_benutzer="0";
$count_planeten="0";
$count_planeten_kolonisiert="0";
$count_kolonisten="0";

   while($row = mysql_fetch_array($abf_serverversion))
      {
      $skrupelversion = $row["version"];
      }

   while($row = mysql_fetch_array($abf_spiele))
      {
      if ($row["phase"]==0)
	{ $count_spiele_aktiv++; }
      else if ($row["phase"]==1)
	{ $count_spiele_beendet++; }
      $count_spiele++;
      $count_umfang += $row["umfang"];
      }

  while($row = mysql_fetch_array($abf_spiele_wartend))
     {
     $count_spiele++;
     $count_spiele_wartend++;
     }

   while($row = mysql_fetch_array($abf_sternenbasen))
      {
      $count_sternenbasen++;
      }

   while($row = mysql_fetch_array($abf_schiffe))
      {
      $count_schiffe++;
      $count_schiffe_lj = $count_schiffe_lj + $row["strecke"];
      }

   while($row = mysql_fetch_array($abf_benutzerliste))
      {
      $count_benutzer++;
      }
if (file_exists($skrupel_path."extend/ki/"))
{ $count_benutzer-=20; }

   while($row = mysql_fetch_array($abf_planeten))
      {
      $count_planeten++;
      if($row["kolonisten"]>0)
         {
         $count_planeten_kolonisiert++;
         $count_kolonisten = $count_kolonisten + $row["kolonisten"];
         }
      }

   ?>
    <table width="100%"  border="0">
     <tr>
      <td><h2>Details zum Univerum <?php echo $servername; ?></h2>
<hr /><table><tr><td valign="top"><img src="<?php echo $skrupel_path; ?>bilder/logo_login.gif" /></td><td valign="top"><?php if (file_exists($skrupel_path."extend/bbc/bbc.php")){ require($skrupel_path."extend/bbc/bbc.php");  echo bbc($description); } else { echo nl2br($description); } ?></td></tr></table><hr />
</td>
     </tr>
     <tr>
      <td>&nbsp;</td>
     </tr>
    </table>
    <table width="100%"  border="0">
     <tr>
      <td align="right"><h3>Allgemein</h3></td>
      <td align="left">&nbsp;</td>
     </tr>
     <tr>
      <td align="right">Server URL&nbsp;</td>
      <td align="left"><em><?php echo $_SERVER['SERVER_NAME']; ?></em></td>
     </tr>
     <tr>
      <td align="right">Skrupel Version&nbsp;</td>
      <td align="left"><em><?php echo $skrupelversion; ?></em></td>
     </tr>
     <tr>
      <td align="right">&nbsp;</td>
      <td align="left">&nbsp;</td>
     </tr>
     <tr>
      <td align="right"><h3>Das Universum</h3></td>
      <td align="left">&nbsp;</td>
     </tr>
     <tr>
      <td align="right">Gesamtgröße&nbsp;</td>
      <td align="left"><em><?php echo$count_umfang."x".$count_umfang; ?></em></td>
     </tr>
     <tr>
      <td align="right">Planeten&nbsp;</td>
      <td align="left"><em><?php echo $count_planeten; ?></em></td>
     </tr>
     <tr>
      <td align="right">Besiedelte Planeten&nbsp;</td>
      <td align="left"><em><?php echo $count_planeten_kolonisiert; ?></em></td>
     </tr>
     <tr>
      <td align="right">Kolonisten&nbsp;</td>
      <td align="left"><em><?php echo $count_kolonisten; ?></em></td>
     </tr>
     <tr>
      <td align="right">Sternenbasen&nbsp;</td>
      <td align="left"><em><?php echo $count_sternenbasen; ?></em></td>
     </tr>
     <tr>
      <td align="right">Schiffe gesamt&nbsp;</td>
      <td align="left"><em><?php echo $count_schiffe; ?></em></td>
     </tr>
     <tr>
      <td align="right">geflogene Lichtjahre&nbsp;</td>
      <td align="left"><em><?php echo $count_schiffe_lj; ?></em></td>
     </tr>
     <tr>
      <td align="right">&nbsp;</td>
      <td align="left">&nbsp;</td>
     </tr>
     <tr>
      <td align="right"><h3>Spiele</h3></td>
      <td align="left">&nbsp;</td>
     </tr>
     <tr>
      <td align="right">Spiele gesamt&nbsp;</td>
      <td align="left"><em><?php echo $count_spiele; ?></em></td>
     </tr>
     <tr>
      <td align="right">Aktive Spiele&nbsp;</td>
      <td align="left"><em><?php echo $count_spiele_aktiv; ?></em></td>
     </tr>
     <tr>
      <td align="right">Wartende Spiele&nbsp;</td>
      <td align="left"><em><?php echo $count_spiele_wartend; ?></em></td>
     </tr>
     <tr>
      <td align="right">Beendete Spiele&nbsp;</td>
      <td align="left"><em><?php echo $count_spiele_beendet; ?></em></td>
     </tr>
     <tr>
      <td align="right">Spieler insgesamt&nbsp;</td>
      <td align="left"><em><?php echo $count_benutzer; ?></em></td>
     </tr>
    </table>
    <table width="100%"  border="0">
     <tr>
      <td>&nbsp;</td>
     </tr>
     <tr>
      <td>&nbsp;</td>
     </tr>
    </table>
<?php
require_once ("inc/_footer.php");
?>