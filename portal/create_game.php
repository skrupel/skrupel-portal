<?php
  session_start();
include "inc/conf.php";
include "inc/_db.php";
if ($_SESSION["user_id"]) 
{
  
  if ($_GET["action"] == "preparea" && is_numeric($_GET["game_id"]))
  {
    require_once ("inc/_header.php");

    $sql   = "SELECT spiel_name, siegbedingungen, zielinfo_1, zielinfo_2, zielinfo_3, zielinfo_4, zielinfo_5, out, user_1, user_2, user_3, user_4, user_5, user_6, user_7, user_8, user_9, user_10, rasse_1, rasse_2, rasse_3, rasse_4, rasse_5, rasse_6, rasse_7, rasse_8, rasse_9, rasse_10, spieler_admin, startposition, imperiumgroesse, geldmittel, mineralienhome, sternendichte, mineralien, spezien, max, wahr, lang, instabil, stabil, leminvorkommen, umfang, struktur, modul_0, modul_2, modul_3, team1, team2, team3, team4, team5, team6, team7, team8, team9, team10, nebel, piraten_mitte, piraten_aussen, piraten_min, piraten_max FROM $skrupel_portal_games WHERE id = {$_GET["game_id"]} AND spieler_admin = {$_SESSION["user_id"]}";
    $query = mysql_query($sql);
    if (mysql_num_rows($query) == 1)
    {
      $data = mysql_fetch_assoc( $query );
?>  
<script>
<!--
  function sendRequest( url, data )
  { 
    if (window.XMLHttpRequest)
    {    
      //branch for native XMLHttpRequest
      req = new XMLHttpRequest();
      req.onreadystatechange = processReqChange;
      if (req.overrideMimeType) {
        req.overrideMimeType('text/xml');
      }      
      req.open("POST", url, true);
      req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      req.send(data);
    }    
    else if (window.ActiveXObject)
    {
      //branch for IE/Windows ActiveX version
      isIE = true;
      req = new ActiveXObject("Microsoft.XMLHTTP");
      if (req)
      {
        req.onreadystatechange = processReqChange;
        req.open("POST", url, true);
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        req.send(data);
      }
    }
  }
  function processReqChange()
  {    
    //only if req shows loadeidd
    if (req.readyState == 4)
    {
    alert("loaded");
      //only if "OK"
      if (req.status == 200)
      {
        alert("status ok");
        data = req.responseText;
        alert(data);
        
      }
      else
      {
        alert("There was a problem retrieving the XML data:\n" + req.StatusText);
      }
    }
  }
-->
</script>
<br><br><br><br><br>
<center>
  <img src="<?php echo $skrupel_path; ?>bilder/radd.gif" height="46" width="51"><br><br>
  Einen Moment Geduld bitte.
  <br><br>
  Das Spiel wird erstellt.
</center>
<script>
  sendRequest("create_game.php","action=create&game_id=<?php echo $_GET["game_id"]; ?><?php 
                                                foreach ( $data as $field => $entry)
                                                {
                                                  echo "&{$field}={$entry}";
                                                }
                                              ?>");
</script>
<?php  
    }
    require_once ("inc/_footer.php");
  }
  elseif ($_GET["action"] == "prepare" && is_numeric($_GET["game_id"]))
  { 
    require "inc/_header.php"; 
    $sql   = "SELECT * FROM $skrupel_portal_games WHERE id = {$_GET["game_id"]}";
    $query = mysql_query($sql);
if ($_SESSION["name"]==ADMIN && isset($_SESSION["user_id"]))
{  $server_admin=1; } else { $server_admin=0; }
    if (mysql_num_rows($query) == 1)
    {
      $data = mysql_fetch_assoc( $query );
      if ( !in_array( $_SESSION["user_id"] , array( $data["user_1"],
                                                    $data["user_2"],
	      					    $data["user_3"],
	 					    $data["user_4"],
	 					    $data["user_5"],
						    $data["user_6"],
						    $data["user_7"],
						    $data["user_8"],
						    $data["user_9"],
						    $data["user_10"]) ) && $server_admin==0 )
     {
echo "Achtung! Es ist ein Fehler aufgetreten.<br />Du konntest nicht als Teilnehmer dieses Spiels identifiziert werden.<br />Vorgang abgebrochen...";
require_once ("inc/_footer.php"); exit;
     }						    
?>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1>Neues Spiel erstellen</h1></td></tr></table></center>
<center>
<img src="<?php echo $skrupel_path?>bilder/radd.gif" height="46" width="51"><br><br>
Einen Moment Geduld bitte.
<br><br>
Das Spiel wird erstellt.
</center>
<form name="formular" id="formular" method="post" action="create_game.php?action=create">
<?php
  foreach( $data as $key => $value )
  {
    if ( in_array( $key , array( "id", "playable" ) ) ) continue;
    echo "<input type=\"hidden\" name=\"{$key}\" value=\"{$value}\">";
  }
?>
<input type="hidden" name="game_id" value="<?php echo $_GET["game_id"]; ?>"> 
<input type="hidden" name="spiel_name" value="<?php echo $data["spiel_name"]; ?>">
<input type="hidden" name="siegbedingungen" value="<?php echo $data["siegbedingungen"]; ?>">
<input type="hidden" name="zielinfo_1" value="<?php echo $data["zielinfo_1"]; ?>">
<input type="hidden" name="zielinfo_2" value="<?php echo $data["zielinfo_2"]; ?>">
<input type="hidden" name="zielinfo_3" value="<?php echo $data["zielinfo_3"]; ?>">
<input type="hidden" name="zielinfo_4" value="<?php echo $data["zielinfo_4"]; ?>">
<input type="hidden" name="zielinfo_5" value="<?php echo $data["zielinfo_5"]; ?>">
<input type="hidden" name="user_1" value="<?php echo $data["user_1"]; ?>">
<input type="hidden" name="user_2" value="<?php echo $data["user_2"]; ?>">
<input type="hidden" name="user_3" value="<?php echo $data["user_3"]; ?>">
<input type="hidden" name="user_4" value="<?php echo $data["user_4"]; ?>">
<input type="hidden" name="user_5" value="<?php echo $data["user_5"]; ?>">
<input type="hidden" name="user_6" value="<?php echo $data["user_6"]; ?>">
<input type="hidden" name="user_7" value="<?php echo $data["user_7"]; ?>">
<input type="hidden" name="user_8" value="<?php echo $data["user_8"]; ?>">
<input type="hidden" name="user_9" value="<?php echo $data["user_9"]; ?>">
<input type="hidden" name="user_10" value="<?php echo $data["user_10"]; ?>">
<input type="hidden" name="rasse_1" value="<?php echo $data["rasse_1"]; ?>">
<input type="hidden" name="rasse_2" value="<?php echo $data["rasse_2"]; ?>">
<input type="hidden" name="rasse_3" value="<?php echo $data["rasse_3"]; ?>">
<input type="hidden" name="rasse_4" value="<?php echo $data["rasse_4"]; ?>">
<input type="hidden" name="rasse_5" value="<?php echo $data["rasse_5"]; ?>">
<input type="hidden" name="rasse_6" value="<?php echo $data["rasse_6"]; ?>">
<input type="hidden" name="rasse_7" value="<?php echo $data["rasse_7"]; ?>">
<input type="hidden" name="rasse_8" value="<?php echo $data["rasse_8"]; ?>">
<input type="hidden" name="rasse_9" value="<?php echo $data["rasse_9"]; ?>">
<input type="hidden" name="rasse_10" value="<?php echo $data["rasse_10"]; ?>">
<input type="hidden" name="spieler_admin" value="1"><?php echo $data["spieler_admin"]; ?>
<input type="hidden" name="startposition" value="<?php echo $data["startposition"]; ?>">
<input type="hidden" name="imperiumgroesse" value="<?php echo $data["imperiumgroesse"]; ?>">
<input type="hidden" name="geldmittel" value="<?php echo $data["geldmittel"]; ?>">
<input type="hidden" name="mineralienhome" value="<?php echo $data["mineralienhome"]; ?>">
<input type="hidden" name="sternendichte" value="<?php echo $data["sternendichte"]; ?>">
<input type="hidden" name="mineralien" value="<?php echo $data["mineralien"]; ?>">
<input type="hidden" name="spezien" value="<?php echo $data["spezien"]; ?>">
<input type="hidden" name="max" value="<?php echo $data["max"]; ?>">
<input type="hidden" name="wahr" value="<?php echo $data["wahr"]; ?>">
<input type="hidden" name="lang" value="<?php echo $data["lang"]; ?>">
<input type="hidden" name="instabil" value="<?php echo $data["instabil"]; ?>">
<input type="hidden" name="stabil" value="<?php echo $data["stabil"]; ?>">
<input type="hidden" name="leminvorkommen" value="<?php echo $data["leminvorkommen"]; ?>">
<input type="hidden" name="umfang" value="<?php echo $data["umfang"]; ?>">
<input type="hidden" name="struktur" value="<?php echo $data["struktur"]; ?>">
<input type="hidden" name="modul_0" value="<?php echo $data["modul_0"]; ?>">
<input type="hidden" name="modul_2" value="<?php echo $data["modul_2"]; ?>">
<input type="hidden" name="modul_3" value="<?php echo $data["modul_3"]; ?>">
<input type="hidden" name="out" value="<?php echo $data["out"]; ?>">
<input type="hidden" name="nebel" value="<?php echo $data["nebel"]; ?>">

<input type="hidden" name="piraten_mitte" value="<?php echo $data["piraten_mitte"]; ?>">
<input type="hidden" name="piraten_aussen" value="<?php echo $data["piraten_aussen"]; ?>">
<input type="hidden" name="piraten_min" value="<?php echo $data["piraten_min"]; ?>">
<input type="hidden" name="piraten_max" value="<?php echo $data["piraten_max"]; ?>">

<input type="hidden" name="game_id" value="<?php echo $_GET["game_id"]; ?>">

<input type="hidden" name="user_1_x" value="<?php echo $data["user_1_x"]; ?>">
<input type="hidden" name="user_2_x" value="<?php echo $data["user_2_x"]; ?>">
<input type="hidden" name="user_3_x" value="<?php echo $data["user_3_x"]; ?>">
<input type="hidden" name="user_4_x" value="<?php echo $data["user_4_x"]; ?>">
<input type="hidden" name="user_5_x" value="<?php echo $data["user_5_x"]; ?>">
<input type="hidden" name="user_6_x" value="<?php echo $data["user_6_x"]; ?>">
<input type="hidden" name="user_7_x" value="<?php echo $data["user_7_x"]; ?>">
<input type="hidden" name="user_8_x" value="<?php echo $data["user_8_x"]; ?>">
<input type="hidden" name="user_9_x" value="<?php echo $data["user_9_x"]; ?>">
<input type="hidden" name="user_10_x" value="<?php echo $data["user_10_x"]; ?>">
<input type="hidden" name="user_1_y" value="<?php echo $data["user_1_y"]; ?>">
<input type="hidden" name="user_2_y" value="<?php echo $data["user_2_y"]; ?>">
<input type="hidden" name="user_3_y" value="<?php echo $data["user_3_y"]; ?>">
<input type="hidden" name="user_4_y" value="<?php echo $data["user_4_y"]; ?>">
<input type="hidden" name="user_5_y" value="<?php echo $data["user_5_y"]; ?>">
<input type="hidden" name="user_6_y" value="<?php echo $data["user_6_y"]; ?>">
<input type="hidden" name="user_7_y" value="<?php echo $data["user_7_y"]; ?>">
<input type="hidden" name="user_8_y" value="<?php echo $data["user_8_y"]; ?>">
<input type="hidden" name="user_9_y" value="<?php echo $data["user_9_y"]; ?>">
<input type="hidden" name="user_10_y" value="<?php echo $data["user_10_Y"]; ?>">

<? if ($data["siegbedingungen"]==6) {  ?>
<input type="hidden" name="team1" value="<?php echo $data["team1"]?>">
<input type="hidden" name="team2" value="<?php echo $data["team2"]?>">
<input type="hidden" name="team3" value="<?php echo $data["team3"]?>">
<input type="hidden" name="team4" value="<?php echo $data["team4"]?>">
<input type="hidden" name="team5" value="<?php echo $data["team5"]?>">
<input type="hidden" name="team6" value="<?php echo $data["team6"]?>">
<input type="hidden" name="team7" value="<?php echo $data["team7"]?>">
<input type="hidden" name="team8" value="<?php echo $data["team8"]?>">
<input type="hidden" name="team9" value="<?php echo $data["team9"]?>">
<input type="hidden" name="team10" value="<?php echo $data["team10"]?>">
<? } ?>

</form>

<script language=JavaScript>
  document.getElementById('formular').submit();
 </script>
<?
      require_once ("inc/_footer.php");
    }
    else
    {
      echo "Konnte Spiel nicht finden";
    }
  } 
  elseif ( ($_GET["action"]=="create" || $_POST["action"]=="create") && is_numeric($_POST["game_id"]) ) 
  {
    $sql = "SELECT spiel_name, spieler_admin, user_1, user_2, user_3, user_4, user_5, user_6, user_7, user_8, user_9, user_10 FROM $skrupel_portal_games WHERE id = {$_POST["game_id"]}";
    $spiel = mysql_fetch_assoc(mysql_query($sql));
    echo mysql_error();
    if ( !in_array( $_SESSION["user_id"] , array( $data["user_1"],
                                                    $data["user_2"],
                                                    $data["user_3"],
                                                    $data["user_4"],
                                                    $data["user_5"],
                                                    $data["user_6"],
                                                    $data["user_7"],
                                                    $data["user_8"],
                                                    $data["user_9"],
                                                    $data["user_10"]) ) )

    {
      for ($i = 1; $i <=10;$i++)
      {
        if ($spiel["user_".$i] == -1)
        {
          $sql = "UPDATE $skrupel_portal_games SET user_$i = 0 WHERE id = {$_POST["game_id"]} AND user_$i = -1";
          mysql_query($sql);
        }
      }
      $mailsto = "";
      for ($i = 1; $i <=10;$i++)
      {
        if ($spiel["user_".$i] > 0)
        {
          $mailsto .=  ($mailsto != "" ? "," : "") . $spiel["user_{$i}"];
        }
      }
      define("MAILSTO", $mailsto);
      define("SPIELNAME", $spiel["spiel_name"]);
      $ftploginname = $HTTP_COOKIE_VARS["ftploginname"] = $_COOKIE["ftploginname"] = $admin_login;
      $ftploginpass = $HTTP_COOKIE_VARS["ftploginpass"] = $_COOKIE["ftploginpass"] = $admin_pass;
      $HTTP_GET_VARS["fu"] = 9; //0.969
      $_GET["fu"]          = 9; //0.97+
      $sql = "DELETE FROM $skrupel_portal_games WHERE id = {$_POST["game_id"]}";
      mysql_query($sql); 
      require_once ("inc/_header.php");
      require ("inc/game-transfer.php");  

      // Send mails that the game has started
      @mysql_close();

      require ("inc/_db.php");
      
      $sql = "UPDATE $skrupel_spiele SET kommentar = '".time()."' WHERE id={$spiel}";
      mysql_query($sql);

      $sql="SELECT email FROM $skrupel_user WHERE id in (".MAILSTO.")";
      $query= mysql_query( $sql );
      $header    = "From: $absenderemail\r\n"."Reply-To: $absenderemail\r\n"."X-Mailer: PHP/" . phpversion();
      $betreff   = $servername." - Spiel gestartet";
      $nachricht="Das Spiel \"".SPIELNAME."\" für das Du Dich angemeldet hast wurde so eben gestartet.\n\nViel Spass und viel Erfolg bei dieser Skrupel-Runde!\n\n------------------------------------------------------------\nDies ist eine automatisch generierte E-Mail\nBitte nicht antworten";
      while ( $data = mysql_fetch_assoc( $query ) )
      {  
        if ( $conf["mail"]["extrasendmailparam"] )
          @mail($data["email"], $betreff, $nachricht, $header, "-f {$absenderemail} {$data["email"]}");
	else
          @mail($data["email"], $betreff, $nachricht, $header);
      }
      require_once ("inc/_footer.php");    
    }      
    else
    {
      if ($_POST["action"] == "create")
      {
        echo "ok";
      }
      else
      {
        require_once ("inc/_header.php");     
?><table width="99%" height="100%"><tr><td align="center">Du versuchst ein Spiel zu starten, welches nicht von dir erstellt wurde.</td></tr></table><?php         
        require_once ("inc/_footer.php");
      }
    }
  }  
}
else
{
  require "inc/_header.php"; 
?><table width="99%" height="100%"><tr><td align="center">Sie m&uuml;ssen angemeldet und eingeloggt sein, um ein Spiel zu erstellen.</td></tr></table><?php     
  require "inc/_footer.php";
}
  
?>
