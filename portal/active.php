<?php
include "inc/conf.php";
  include "inc/initial.php";
  $page_name="Aktive Spiele";
  require_once ("inc/_header.php");

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

  $sql = "SELECT * FROM $skrupel_spiele WHERE phase = 0 ORDER BY lasttick DESC";
  $query = mysql_query($sql);
?>
<table align="center" cellspacing="3" cellpadding="3">
  <tr>
    <td colspan="8" align="center"><h1>Aktive Spiele</h1></td>
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
    <td align="center"><b>N&auml;chster Autozug</b></td>
    <td align="center"><b>Infos</b></td>
  </tr>
<?php
    while ( $data = mysql_fetch_assoc($query) )
    {

      if ($data["spieler_1"] == $_SESSION["user_id"] ||
              $data["spieler_2"] == $_SESSION["user_id"] ||
              $data["spieler_3"] == $_SESSION["user_id"] ||
              $data["spieler_4"] == $_SESSION["user_id"] ||
              $data["spieler_5"] == $_SESSION["user_id"] ||
              $data["spieler_6"] == $_SESSION["user_id"] ||
              $data["spieler_7"] == $_SESSION["user_id"] ||
              $data["spieler_8"] == $_SESSION["user_id"] ||
              $data["spieler_9"] == $_SESSION["user_id"] ||
              $data["spieler_10"] == $_SESSION["user_id"]
             ) 
       {
         echo "<tr name=\"owngame\">"; 
       }
       else
       {
         echo "<tr name=\"othergame\">";
       }
if ($data && $data["name"]!=""){
?>

    <td><?php echo $data["name"]; ?></td>
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
    <td align="center"><?php echo $data["runde"]; ?></td>
    <td><?php echo $data["umfang"]."x".$data["umfang"]; ?></td>
    <td><?php echo ($data["lasttick"] > 0 ? strftime("%d.%m.%Y %T",$data["lasttick"]) : "Bisher keine Auswertung" ); ?></td>
    <td align="center"><?php echo ($data["autozug"] > 0 ? strftime("%d.%m.%Y %T",$data["lasttick"]+($data["autozug"]*60*60)) : "Kein Autozug" ); ?></td>
    <td><a href="spielinfo.php?fu=2&spiel_id=<?php echo $data["id"]; ?>" rel="shadowbox[<?php echo $data["name"]; ?>];title=Details - <?php echo $data["name"]; ?>;width=875;height=600">Details</a></td>
    <!--<td><a href="#game_<?php echo $data["id"]; ?>" rel="shadowbox[<?php echo $data["name"]; ?>];title=Mitspieler - <?php echo $data["name"]; ?>;width=550;height=200">Mitspieler</a></td>-->
    <?php if ($data["spieler_1"] == $_SESSION["user_id"] ||
              $data["spieler_2"] == $_SESSION["user_id"] ||
              $data["spieler_3"] == $_SESSION["user_id"] ||
              $data["spieler_4"] == $_SESSION["user_id"] ||
              $data["spieler_5"] == $_SESSION["user_id"] ||
              $data["spieler_6"] == $_SESSION["user_id"] ||
              $data["spieler_7"] == $_SESSION["user_id"] ||
              $data["spieler_8"] == $_SESSION["user_id"] ||
              $data["spieler_9"] == $_SESSION["user_id"] ||
              $data["spieler_10"] == $_SESSION["user_id"] 
             ) { ?>
    <td><form method="post" action="<?php echo $skrupel_path; ?>index.php" target="_blank"><input type="hidden" name="login_f" value="<?=$_SESSION["name"]?>"><input type="hidden" name="spiel_slot" value="<?=$data["id"]?>"><input type="hidden" name="passwort_f" value="<?=$_SESSION["pass"]?>"><input type="submit" value="Login"></form></td>
    <?php } ?>
  </tr>
  <tr id="game_<?php echo $data["id"]?>" style="display:none">
   <td colspan="9">
     <table cellspacing="0" style="margin:10pt; width=90%" border>
		<colset>
			<col span="4" width="25%">
		</colset>
       <tr>
         <td style="white-space:nowrap"><b>Spieler</b></td>
         <td><b>Rasse</b></td>
         <td><b>Zug</b></td>
         <td style="white-space:nowrap"><b>Platz</b></td>
       </tr>
     <?php
       for ( $i = 1; $i <= 10; $i++ )
       {
         if ($data["spieler_{$i}"] > 0 )
         {
     ?>  <tr>
         <td style="white-space:nowrap"><?=$user[$data["spieler_{$i}"]]["nick"]?></td>
         <td><?php echo $data["spieler_{$i}_rassename"]; ?> (<?=$data["spieler_{$i}_rasse"]?>)</td>
         <td><?php echo ($data["spieler_{$i}_zug"] == 1 ? "Zug abgegeben" : "Zug ausstehend" ); ?></td>
         <td align="center" style="white-space:nowrap"><?php echo $data["spieler_{$i}_platz"]; ?></td>
       </tr>           
     <?php
         }
       }
     ?>
     </table>
   </td>
  </tr>
<?php    
    }
  } }
  else
  {
?>
  <tr>
    <td colspan="8">Zur Zeit wird in keiner Galaxie gespielt.</td>
  </tr>
<?php  
  }
?>  
</table>
<?php  
  require_once ("inc/_footer.php");
?>
