<?
include "inc/conf.php";
require ($skrupel_path."inc.conf.php");

$pamm = @mysql_connect("$server","$login","$password");
$db = @mysql_select_db("$database",$pamm);

if ($db)
 {
 function compressed_output()
  {
  $rmpaqvmt = getEnv("HTTP_ACCEPT_ENCODING");
  $gerdntrmf = getEnv("HTTP_USER_AGENT");
  $zrfuaq = trim(getEnv("REQUEST_METHOD"));
  $zevr = preg_match("=msie=i", $gerdntrmf);
  $tlvb = preg_match("=gzip=i", $rmpaqvmt);
  if ($tlvb && ($zrfuaq != "POST" or !$zevr))
   {
   ob_start("ob_gzhandler");
   }
   else{
       ob_start();
       }
  }

 //compressed_output();

 $logname=$HTTP_COOKIE_VARS["ftploginname"];
 $logpass=$HTTP_COOKIE_VARS["ftploginpass"];

 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Skrupel - Tribute Compilation | Spielauswertung</title>
<link rel="stylesheet" href="font/font.css" />
</head>
<body bgcolor="black">

<?php
if ($HTTP_GET_VARS["fu"]==1)
 {
   $spiel_id=$HTTP_GET_VARS["spiel_id"];

   $abfrage = mysql_query("SELECT * FROM $skrupel_portal_games");
   while ($row = mysql_fetch_object ($abfrage))
         {
         if ($spiel_id==$row->id)
			{
            $spiel_name=$row->spiel_name;
  	        $startposition=$row->startposition;
            if ($startposition==1)
	           {
		       $startposition="Vorgegeben";
	           }
            if ($startposition==2)
 	 	       {
 		       $startposition="Zuf�llig";
 	           }

	        $imperiumgroesse=$row->imperiumgroesse;
            if ($imperiumgroesse==2)
	           {
		       $imperiumgroesse="Planet und Basis";
	           }
            if ($imperiumgroesse==4)
 	 	       {
 		       $imperiumgroesse="Ein Planet";
 	           }

	        $geldmittel=$row->geldmittel;
	        $mineralienhome=$row->mineralienhome;
            if ($mineralienhome==1)
	           {
		       $mineralienhome="2000-3000";
	           }
            if ($mineralienhome==2)
 	 	       {
 		       $mineralienhome="1500-2500";
 	           }
            if ($mineralienhome==3)
 	 	       {
 		       $mineralienhome="1000-2000";
 	           }
			if ($imperiumgroesse==4)
	           {
		       $mineralienhome="500-1000";
	           }
	        $sternendichte=$row->sternendichte;

	        $mineralien=$row->mineralien;
            if ($mineralien==1)
	           {
		       $mineralien="1000-7000";
	           }
            if ($mineralien==2)
 	 	       {
 		       $mineralien="800-5000";
 	           }
            if ($mineralien==3)
 	 	       {
 		       $mineralien="500-3500";
 	           }
            if ($mineralien==4)
 	 	       {
 		       $mineralien="1000-2000";
 	           }
	        $spezien=$row->spezien;
	        $max=$row->max;
	        $wahr=$row->wahr;
	        $lang=$row->lang;
	        $instabil=$row->instabil;
	        $stabil=$row->stabil;
	        $leminvorkommen=$row->leminvorkommen;
            if ($leminvorkommen==1)
	           {
		       $leminvorkommen="normal";
	           }
            if ($leminvorkommen==2)
 	 	       {
 		       $leminvorkommen="erh�ht";
 	           }
            if ($leminvorkommen==3)
 	 	       {
 		       $leminvorkommen="stark erh�ht";
 	           }
            $umfang=$row->umfang;
            $struktur=$row->struktur;
            $modul_0=$row->modul_0;
            $modul_2=$row->modul_2;
            $piraten_mitte=$row->piraten_mitte;
            $piraten_aussen=$row->piraten_aussen;
            $piraten_min=$row->piraten_min;
            $piraten_max=$row->piraten_max;
            $nebel=$row->nebel;
            }
		 }?>

 <table width="100%"  border="0">
  <tr>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times">Details zum Spiel: <? echo $spiel_name; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
 </table>
 <table width="100%" border="0">
  <tr>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times" width="37%">Startbedingungen</td>
    <td style="color:silver; font-style:italic" width="18%">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times" width="2%">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times" width="37%">Wurml&ouml;cher</td>
    <td style="color:silver; font-style:italic" width="6%">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Startposition</td>
    <td style="color:silver; font-style:italic"><? echo $startposition; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Anzahl instabiler Wurml&ouml;cher </td>
    <td style="color:silver; font-style:italic"><? echo $stabil; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Imperiumgr&ouml;&szlig;e</td>
    <td style="color:silver; font-style:italic"><? echo $imperiumgroesse; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Anzahl stabiler Wurml&ouml;cher</td>
    <td style="color:silver; font-style:italic"><? echo $instabil; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times">Umgebungsbedingungen</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times">Plasmastuerme</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Struktur der Galaxie</td>
    <td style="color:silver; font-style:italic"><? echo $struktur; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Maximal gleichzeitg</td>
    <td style="color:silver; font-style:italic"><? echo $max; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Umfang der Galaxie </td>
    <td style="color:silver; font-style:italic"><? echo $umfang; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Wahrscheinlicht des Auftretens </td>
    <td style="color:silver; font-style:italic"><? echo $wahr; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Sternendichte der Galaxie </td>
    <td style="color:silver; font-style:italic"><? echo $sternendichte; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Anzahl der Runden </td>
    <td style="color:silver; font-style:italic"><? echo $lang; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Spezies</td>
    <td style="color:silver; font-style:italic"><? echo $spezien; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp; </td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp; </td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times">Ressourcen</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times">Piraten (Auftreten und Beute)</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Geldmittel (Cantox)</td>
    <td style="color:silver; font-style:italic"><? echo $geldmittel; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Wahrscheinlichkeit im Zentrum</td>
    <td style="color:silver; font-style:italic"><? echo $piraten_mitte; ?>%</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Leminvorkommen</td>
    <td style="color:silver; font-style:italic"><? echo $leminvorkommen; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Wahrscheinlichkeit am Rand</td>
    <td style="color:silver; font-style:italic"><? echo $piraten_aussen; ?> %</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Mineralien auf dem Heimatplaenten </td>
    <td style="color:silver; font-style:italic"><? echo $mineralienhome; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Minimale Beute der Piraten</td>
    <td style="color:silver; font-style:italic"><? echo $piraten_min; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Mineralienvorkommen</td>
    <td style="color:silver; font-style:italic"><? echo $mineralien; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Maximale Beute der Piraten</td>
    <td style="color:silver; font-style:italic"><? echo $piraten_max; ?></td>
  </tr>
  <tr>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times"> &nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times"> &nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
  </tr>
 </table>
 <?
}


if ($HTTP_GET_VARS["fu"]==2)
 {
 $spiel_id=$HTTP_GET_VARS["spiel_id"];
 $spiel_name=$HTTP_GET_VARS["spiel_name"];
 ?>
    <table width="100%"  border="0">
     <tr>
      <td style="color:snow; font-weight:bold; font-family:pdark, Times">Details zum aktiven Spiel: <? echo $spiel_name; ?></td>
     </tr>
     <tr>
      <td>&nbsp;</td>
     </tr>
    </table>
    <?

   $sql_spiel = "SELECT * FROM $skrupel_spiele";
   $abf_spiel = mysql_query($sql_spiel);
   while($row = mysql_fetch_array($abf_spiel))
      {
      if($row["id"]==$spiel_id)
         {
         $spielname = $row["name"];
         $spielziel = $row["ziel_id"];
         $adminspieler = $row["spieler_admin"];

         if($spielziel==0){$spielziel = "JustforFun";}
         if($spielziel==1){$spielziel = "&Uuml;berleben";}
         if($spielziel==2){$spielziel = "Todfeind";}
         if($spielziel==3){$spielziel = "Dominanz";}
         if($spielziel==4){$spielziel = "King of the Planet";}
         if($spielziel==5){$spielziel = "Spice";}
         if($spielziel==6){$spielziel = "TeamTodfeind";}

         $sql_schiffe = "SELECT besitzer,strecke FROM $skrupel_schiffe WHERE spiel=$spiel_id";
         $abf_schiffe = mysql_query($sql_schiffe);
         while($row_schiffe = mysql_fetch_object($abf_schiffe))
            {
            $player_schiffe++;
            $count_schiffe_lichtjahre = $count_schiffe_lichtjahre + $row_schiffe->strecke;
            }
         $sql_planeten = "SELECT kolonisten FROM $skrupel_planeten WHERE spiel=$spiel_id";
         $abf_planeten = mysql_query($sql_planeten);
         while($row_planeten = mysql_fetch_object($abf_planeten))
            {
            $game_planeten++;
            if($row_planeten->kolonisten<>0)
               {
               $count_planeten++;
               $count_kolonisten = $count_kolonisten + $row_planeten->kolonisten;
               }
            }
         $sql_basen = "SELECT besitzer FROM $skrupel_sternenbasen WHERE spiel=$spiel_id";
         $abf_basen = mysql_query($sql_basen);
         while($row_basen = mysql_fetch_object($abf_basen))
            {
            $player_basen++;
            }
         $auswertung = date("d.m.Y - H:i:s", $row["lasttick"]);
         if($auswertung=="01.01.1970 - 01:00:00"){$auswertung = "niemals";}

         $meldung = $row["letztermonat"];
         $runde = $row["runde"];
         $umfang = $row["umfang"]."x".$row["umfang"];

         $autozug = $row["autozug"];
         if($autozug==0){$autozug = "niemals";}
         if($autozug>0){$autozug = "alle ".$autozug." Stunden";}


         $i = 1;
         do
	        {
            $player_id[$i] = $row["spieler_$i"];
            $player_rasse[$i] = $row["spieler_".$i."_rasse"];
            if($player_rasse[$i]==orion){$player_rasse[$i] = "Orion Konglomerat";}
            if($player_rasse[$i]==borg){$player_rasse[$i] = "die Borg";}
            if($player_rasse[$i]==eldar){$player_rasse[$i] = "Eldanesh";}
            if($player_rasse[$i]==erdallianz){$player_rasse[$i] = "die Erd-Allianz";}
            if($player_rasse[$i]==foederation){$player_rasse[$i] = "F&ouml;deration der Vereinigten Planeten";}
            if($player_rasse[$i]==imperium){$player_rasse[$i] = "das Imperium";}
            if($player_rasse[$i]==isa){$player_rasse[$i] = "die ISA";}
            if($player_rasse[$i]==kuatoh){$player_rasse[$i] = "Kuatoh";}
            if($player_rasse[$i]==replikator){$player_rasse[$i] = "Replikatoren";}
            if($player_rasse[$i]==romulan){$player_rasse[$i] = "das Romulanische Imperium";}
            if($player_rasse[$i]==schatten){$player_rasse[$i] = "die Schatten";}
            if($player_rasse[$i]==silverstarag){$player_rasse[$i] = "Silver Star AG";}
            if($player_rasse[$i]==zylonen){$player_rasse[$i] = "das zylonische Imperium";}
            if($player_rasse[$i]==protoss){$player_rasse[$i] = "die Protoss";}

  	        $player_lichtjahre[$i] = $row["spieler_".$i."_schiffe"];
            $player_wertung[$i] = $row["spieler_".$i."_platz"];
            $player_out[$i] = $row["spieler_".$i."_raus"];
            if($player_out[$i]==1)
               {
               $player_out[$i] = "<img border=\"0\" src=\"pics/nein.gif\" alt=\"nein\">";
               }
            else
               {
               $player_out[$i] = "<img border=\"0\" src=\"pics/ja.gif\" alt=\"ja\">";
               }

            $player_zug[$i] = $row["spieler_".$i."_zug"];
            if($player_zug[$i]==0)
               {
               $player_zug [$i]= "<img border=\"0\" src=\"pics/nein.gif\" alt=\"nein\">";
               }
            else
               {
               $player_zug[$i] = "<img border=\"0\" src=\"pics/ja.gif\" alt=\"ja\">";
               }

            $player_lichtjahre[$i] = 0;
            $sql_lichtjahre = "SELECT besitzer,strecke FROM $skrupel_schiffe WHERE spiel=$spiel_id";
            $abf_lichtjahre = mysql_query($sql_lichtjahre);
            while($row_lichtjahre = mysql_fetch_object($abf_lichtjahre))
               {
               if($row_lichtjahre->besitzer==$i)
                  {
                  $player_lichtjahre[$i] = $player_lichtjahre[$i] + $row_lichtjahre->strecke;
                  }
               }


            if($player_id[$i]>0)
               {
               $count_player++;
               $sql_spieler = "SELECT nick FROM $skrupel_user WHERE id=$player_id[$i]";
               $abf_spieler = mysql_query($sql_spieler);
               while($row_player = mysql_fetch_object($abf_spieler))
                  {
                  if($i==$adminspieler)
                     {
                     $player_name[$i] = $row_player->nick." (Admin)";
                     }
                  else
                     {
                     $player_name[$i] = $row_player->nick;
                     }
                  }
               }
            $i++;
            } while($i<=10);
	     }
      }?>

 <table width="100%" border="0">
  <tr>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times" width="37%">Allgemeines</td>
    <td style="color:silver; font-style:italic" width="18%">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times" width="2%">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times" width="37%">Spieldaten</td>
    <td style="color:silver; font-style:italic" width="6%">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Spielname</td>
    <td style="color:silver; font-style:italic"><? echo $spielname; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Mitspieler</td>
    <td style="color:silver; font-style:italic"><? echo $count_player; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Spielziel</td>
    <td style="color:silver; font-style:italic"><? echo $spielziel; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Kartengr��e</td>
    <td style="color:silver; font-style:italic"><? echo $umfang; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Runden</td>
    <td style="color:silver; font-style:italic"><? echo $runde; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Planeten</td>
    <td style="color:silver; font-style:italic"><? echo $game_planeten; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Letzte Auswertung</td>
    <td style="color:silver; font-style:italic"><? echo $auswertung; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Besiedelte Planeten</td>
    <td style="color:silver; font-style:italic"><? echo $count_planeten; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">Automatischer Zug</td>
    <td style="color:silver; font-style:italic"><? echo $autozug; ?></td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Kolonisten</td>
    <td style="color:silver; font-style:italic"><? echo $count_kolonisten; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Sternenbasen</td>
    <td style="color:silver; font-style:italic"><? echo $player_basen; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Schiffe</td>
    <td style="color:silver; font-style:italic"><? echo $player_schiffe; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">Lichtjahre gesamt</td>
    <td style="color:silver; font-style:italic"><? echo $count_schiffe_lichtjahre; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:snow; font-weight:bold; font-family:Times">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
  </tr>
 </table>
 <table>
  <tr>
    <td valign="top" style="color:snow; font-weight:bold; font-family:pdark, Times" width="15%">Letzte Meldung</td>
    <td valign="top" style="color:silver; font-style:italic" width="85%"><? echo $meldung; ?></td>
  </tr>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:Times" width="15%">&nbsp;</td>
    <td style="color:silver; font-style:italic" width="85%">&nbsp;</td>
  </tr>
 </table>
 <table>
  <tr>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times" width="15%">Spieler</td>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times" width="15%" align="center">Aktiv</td>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times" width="15%" align="center">Zug beendet</td>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times" width="25%">Rasse</td>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times" width="15%" align="center">Lichtjahre geflogen</td>
    <td style="color:snow; font-weight:bold; font-family:pdark, Times" width="15%" align="center">Wertung</td>
  </tr><?

  $i = 1;
  do
   {?>
   <tr>
    <td style="color:silver; font-style:italic"><nobr><? echo $player_name[$i]; ?></nobr></td>
    <td style="color:silver; font-style:italic" align="center"><? echo $player_out[$i]; ?></td>
    <td style="color:silver; font-style:italic" align="center"><? echo $player_zug[$i]; ?></td>
    <td style="color:silver; font-style:italic"><? echo $player_rasse[$i]; ?></td>
    <td style="color:silver; font-style:italic" align="center"><? echo $player_lichtjahre[$i]; ?></td>
    <td style="color:silver; font-style:italic" align="center"><? echo $player_wertung[$i]; ?></td>
  </tr><?

  $i++;
  }
  while($i<=$count_player);
  ?>
  <tr>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
    <td style="color:silver; font-style:italic">&nbsp;</td>
  </tr>
 </table>
 <?
 } ?>

</body>
</html>