<?php
include "inc/conf.php";
include "inc/initial.php";
require ($skrupel_path."inc.conf.php");
$page_name="Neue Offenbarung";

if (!$_SESSION["user_id"] || $_SESSION["name"]!=ADMIN)
{ header('Location: index.php'); exit; }

require ($skrupel_path."lang/de/lang.admin.allgemein_alpha.php");
require_once ("inc/_header.php");
if (@file_exists($skrupel_path."extend/bbc/bbc.php"))
{ require($skrupel_path."extend/bbc/bbc.php"); }

if ($_GET["fu"]!=1 && $_GET["fu"]!=2)
{ $_GET["fu"]=1; }

if ($_GET["fu"]==1) {
        ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0" height="100%">
                    <tr>
                        <td>
                            <center>
                                <table border="0" cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td><h1><?php echo $lang['admin']['allgemein']['alpha']['offenbarung']?></h1></td>
                                    </tr>
                                </table>
                            </center>
                            <br />
                            <center><?php echo $lang['admin']['allgemein']['alpha']['offenbarung_text']?></center>
                            <form name="formular" method="post" action="admin_offenbarung.php?fu=2">
		<input type="checkbox" name="multiMail" /> PN an alle Spieler senden
                            <br /><textarea name="nachricht" style="width:100%;height:255px;"></textarea>
                            <br /><br />
                            <center>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><input type="submit" name="dumdidum" value="Offenbarung verk&uuml;nden" style="width:250px;"></td>
                                        <td></form></td>
                                    </tr>
                                </table>
                            </center>
                            <br>
                        </td>
                    </tr>
                </table>
            </center>
            <?php
 }

if ($_GET["fu"]==2) {
        $forum=1;
        $icon=1;
          
        $beginner=$lang['admin']['allgemein']['alpha']['gott'];
          
        $letzter=time();
          
        $beitrag=$_POST["nachricht"];
        $thema=substr($beitrag,0,30)."...";

        include "inc/pn_delivery.php";
	if ($_POST["multiMail"]=="on" || $_POST["multiMail"]=="true")
	{ $mail=sendMultiNews($_POST["nachricht"]); }
        
        if (@file_exists($skrupel_path."extend/bbc/bbc.php"))
        { $thema = bbc($thema); }
        

        else {
        $thema=str_replace("&","&amp;",$thema);
        $thema=str_replace("<","&lt;",$thema);
        $thema=str_replace(">","&gt;",$thema);
          
        $beitrag=str_replace("&","&amp;",$beitrag);
        $beitrag=str_replace("<","&lt;",$beitrag);
        $beitrag=str_replace(">","&gt;",$beitrag);
          
        $beitrag=nl2br(stripslashes($beitrag));
        $beitrag=str_replace("'", "",$beitrag);
        $beitrag=str_replace("\"", "",$beitrag);
        $beitrag=str_replace("\\", "",$beitrag); }
        
        $zeiger = @mysql_query("INSERT INTO $skrupel_forum_thema (forum,icon,thema,beginner,antworten,letzter) values ($forum,$icon,'$thema','$beginner',0,'$letzter');");
          
        $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_thema where forum=$forum and icon=$icon and beginner='$beginner' and thema='$thema' and letzter='$letzter' and antworten=0;");
        $array = @mysql_fetch_array($zeiger);
        $idthema=$array["id"];
          
        $zeiger = @mysql_query("INSERT INTO $skrupel_forum_beitrag (thema,forum,datum,beitrag,verfasser,spielerid) values ($idthema,$forum,'$letzter','$beitrag','$beginner',0);");
          
        $nachricht=$idthema.$lang['admin']['allgemein']['alpha']['lauschegott'].$beitrag;
        $datum=time();
         
        $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_spiele where phase=0 order by id");
        $spielanzahl = @mysql_num_rows($zeiger_temp);
        if ($spielanzahl>=1) {
            for  ($iii=0; $iii<$spielanzahl;$iii++) {
                $ok_temp = @mysql_data_seek($zeiger_temp,$iii);
                $array22 = @mysql_fetch_array($zeiger_temp);
                 
                $spiel=$array22["id"];
              
                $spieler_1=$array22["spieler_1"];
                $spieler_2=$array22["spieler_2"];
                $spieler_3=$array22["spieler_3"];
                $spieler_4=$array22["spieler_4"];
                $spieler_5=$array22["spieler_5"];
                $spieler_6=$array22["spieler_6"];
                $spieler_7=$array22["spieler_7"];
                $spieler_8=$array22["spieler_8"];
                $spieler_9=$array22["spieler_9"];
                $spieler_10=$array22["spieler_10"];
              
                if ($spieler_1>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',1,$spiel,1);"); }
                if ($spieler_2>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',2,$spiel,1);"); }
                if ($spieler_3>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',3,$spiel,1);"); }
                if ($spieler_4>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',4,$spiel,1);"); }
                if ($spieler_5>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',5,$spiel,1);"); }
                if ($spieler_6>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',6,$spiel,1);"); }
                if ($spieler_7>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',7,$spiel,1);"); }
                if ($spieler_8>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',8,$spiel,1);"); }
                if ($spieler_9>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',9,$spiel,1);"); }
                if ($spieler_10>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',10,$spiel,1);"); }
            }
        ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0" height="100%">
                    <tr>
                        <td>
                            <?php echo $lang['admin']['allgemein']['alpha']['verkuendung']?>
                        </td>
                    </tr>
                </table>
            </center>
            <?php
    }
}
require ("inc/_footer.php");
?>
