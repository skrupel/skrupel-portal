<?php
  include "inc/conf.php";
  include "inc/initial.php";
  require ($skrupel_path."inc.conf.php");
$page_name="Beendete Spiele";
  require_once "inc/_header.php";

  $user = array();
  $sql   = "SELECT * FROM $skrupel_user";
  $query = mysql_query( $sql );
  while ( $data = mysql_fetch_assoc($query) )
    $user[$data["id"]]=$data;
  
  if ( $_SESSION["user_id"] == ADMIN && $_GET["remind_user"] && $_GET["remind_game"] && is_numeric($_GET["remind_user"]) && is_numeric($_GET["remind_game"]) )
  {
    $sql   = "SELECT nick, email FROM $skrupel_user WHERE id = {$_GET["remind_user"]}";
    $query = mysql_query( $sql );
    $userd = mysql_fetch_assoc( $query );

    $sql   = "SELECT name, lasttick FROM $skrupel_spiele WHERE id = {$_GET["remind_game"]}";
    $query = mysql_query( $sql );
    $game  = mysql_fetch_assoc( $query );

    $msg     = "Hallo {$userd["nick"]},\n\ndu hattest dich für das Spiel \"{$game["name"]}\" eingetragen. Das Spiel wurde schon vor einiger Zeit gestartet, aber deine Mitspieler warten immer noch darauf, dass du deinen Zug abgibst.\n\nSolltest du weiterhin interesse haben geb bitte m�glichst bald deinen Zug ab. Falls du nicht mehr mitspielen willst geb wenigstens kurz bescheid damit wir uns um einen Ersatz f�r dich k�mmern k�nnen und das Spiel nicht weiter blockiert wird.";
    if ( $conf["mail"]["extrasendmailparam"] )
      @mail($userd["email"], "Skrupel - Erinnerung", $msg,"From: $absenderemail\r\n"."Reply-To: $absenderemail\r\n"."X-Mailer: PHP/" . phpversion(), "-f $absenderemail {$userd["email"]}");
    else
      @mail($userd["email"], "Skrupel - Erinnerung", $msg,"From: $absenderemail\r\n"."Reply-To: $absenderemail\r\n"."X-Mailer: PHP/" . phpversion());
  }

  $sql = "SELECT * FROM $skrupel_spiele WHERE phase = 1 ORDER BY lasttick DESC";
  $query = mysql_query($sql);
?>
<table align="center" cellspacing="3" cellpadding="3">
  <tr>
    <td colspan="8" align="center"><h1>Beendete Spiele</h1></td>
  </tr>
<?php
  if ( mysql_num_rows($query) > 0 )
  {
?>
  <tr>
    <td align="center"><b>Spielname</b></td>
    <td align="center"><b>Spielziel</b></td>
    <td align="center"><b>Runde</b></td>
    <td align="center"><b>Kartengr&ouml;&szlig;e</b></td>
    <td align="center"><b>Letzte Auswertung</b></td>
    <td align="center" colspan="3"><b>Infos</b></td>
  </tr>
<?php
    while ( $data = mysql_fetch_assoc($query) )
    {
?>
  <tr>
    <td onClick="showHide('game_<?=$data["id"]?>')"><?=$data["name"]?></td>
    <td><?php
          if ($data["ziel_id"] == 0 )
            echo "JustforFun";
          elseif ($data["ziel_id"] == 1 )
            echo "&Uuml;berleben";
          elseif ($data["ziel_id"] == 2 )
            echo "Todfeind";
          elseif ($data["ziel_id"] == 3 )
            echo "Dominanz";
          elseif ($data["ziel_id"] == 4 )
            echo "King of the Planet";
          elseif ($data["ziel_id"] == 5 )
            echo "Spice";
          elseif ($data["ziel_id"] == 6 )
            echo "Teamtodfeind";
        ?></td>
    <td align="center"><?=$data["runde"]?></td>
    <td><?php echo $data["umfang"]."x".$data["umfang"]; ?></td>
    <td><?=($data["lasttick"] > 0 ? strftime("%d.%m.%Y %T",$data["lasttick"]) : "Bisher keine Auswertung" )?></td>
    <td><a href="spielinfo.php?fu=2&spiel_id=<?php echo $data["id"]; ?>" rel="shadowbox[<?php echo $data["name"]; ?>];title=Details - <?php echo $data["name"]; ?>;width=875;height=600">Details</a></td>    
<?php if (file_exists($skrupel_path."extend/xstats/index.php")) { ?>
<td><a href="<?php echo $skrupel_path; ?>extend/xstats/DisplaySingleGame.php?gameid=<?php echo  $data["id"] ;?>&outputtype=FLASH" rel="shadowbox[<?php echo $data["name"]; ?>];title=XStats - <?php echo $data["name"]; ?>;width=850;height=600">XStats</a></td>
<?php } ?>
<td><a href="<?php echo $skrupel_path; ?>inhalt/runde_ende.php?fu=1&spiel=<?php echo $data["id"]; ?>" rel="shadowbox[<?php echo $data["name"]; ?>];title=Auswertung - <?php echo $data["name"]; ?>;width=800;height=600">Auswertung</a></td>
  </tr>
  <tr>
   <td colspan="9">
     <div id="game_<?=$data["id"]?>" style="display:none; position:relative;left:20px;">
       <table cellspacing="0">
         <tr>
           <td>Spieler</td>
           <td>Rasse</td>
           <td>Platz</td>
         </tr>
       <?php
         for ( $i = 1; $i <= 10; $i++ )
         {
           if ($data["spieler_{$i}"] > 0 )
           {
       ?>  <tr>
           <td><?=$user[$data["spieler_{$i}"]]["nick"]?></td>
           <td><?=$data["spieler_{$i}_rassename"]?> (<?=$data["spieler_{$i}_rasse"]?>)</td>
           <td align="center"><?=$data["spieler_{$i}_platz"]?></td>
         </tr>           
       <?php
           }
         }
       ?>
       </table>
     </div>
   </td>
  </tr>
<?php    
    }
  }
  else
  {
?>
  <tr>
    <td colspan="8">Es wurden noch keine Spiele bis zum Ende gespielt oder alle beendeten Spiele wurden bereits entfernt.</td>
  </tr>
<?php  
  }
?>  
</table>
<hr />
<?php
if (file_exists($skrupel_path."extend/xstats/")) { ?>
<a href="xstats.php">Zu den XStats-Aufzeichnungen wechseln</a>.
<?php  
} else { ?>
XStats-Erweiterung nicht installiert.
<?php
}
  require_once ("inc/_footer.php");
?>
