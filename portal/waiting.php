<?php
include "inc/conf.php";
  include "inc/initial.php";
$page_name="Wartende Spiele";
  require_once ("inc/_header.php");
  
  if ( $_GET["action"] == "join" && is_numeric($_GET["game_id"]) )
  {
    if ($_SESSION["user_id"])
    {
      $sql = "SELECT * FROM $skrupel_portal_games WHERE id={$_GET["game_id"]}";
      $data = mysql_fetch_assoc( mysql_query($sql) );
      if ( $data["user_1"] != -1 && 
           $data["user_2"] != -1 && 
           $data["user_3"] != -1 && 
           $data["user_4"] != -1 && 
           $data["user_5"] != -1 && 
           $data["user_6"] != -1 && 
           $data["user_7"] != -1 && 
           $data["user_8"] != -1 && 
           $data["user_9"] != -1 &&
           $data["user_10"] != -1)
      {
?><table width="99%" height="100%"><tr><td align="center">Bei diesem Spiel ist kein Platz mehr frei.<br><a href="waiting.php">Zur&uuml;ck</a></td></tr></table><?php
      }
      elseif ( $data["user_1"] == $_SESSION["user_id"] || 
               $data["user_2"] == $_SESSION["user_id"] || 
               $data["user_3"] == $_SESSION["user_id"] || 
               $data["user_4"] == $_SESSION["user_id"] || 
               $data["user_5"] == $_SESSION["user_id"] || 
               $data["user_6"] == $_SESSION["user_id"] || 
               $data["user_7"] == $_SESSION["user_id"] || 
               $data["user_8"] == $_SESSION["user_id"] || 
               $data["user_9"] == $_SESSION["user_id"] ||
               $data["user_10"] == $_SESSION["user_id"])
      {
?><table width="99%" height="100%"><tr><td align="center">Du spielst bei diesem Spiel bereits mit.<br><a href="waiting.php">Zur&uuml;ck</a></td></tr></table><?php
      }
      else
      {
        //Rassen einlesen
        $verzeichnis=$skrupel_path."daten/";
        $handle=opendir("$verzeichnis");

        $zaehler=0;
        while ($file=readdir($handle)) {
          if ((substr($file,0,1)<>'.') and (substr($file,0,7)<>'bilder_') and (substr($file,strlen($file)-4,4)<>'.txt')) {

            if (trim($file)=='unknown') { } else {

              $datei=$skrupel_path.'daten/'.$file.'/daten.txt';
              $fp = @fopen("$datei","r");
              if ($fp) {
                $zaehler2=0;
                while (!feof ($fp)) {
                  $buffer = @fgets($fp, 4096);
                  $daten[$zaehler][$zaehler2]=$buffer;
                  $zaehler2++;
                }
                @fclose($fp); 
              }
 
              $filename[$zaehler]=$file;

              $zaehler++;
            }
          }
        }
        closedir($handle);
?>
<form action="waiting.php?action=join2" method="post">
<table align="center">
  <tr>
    <td align="center" colspan="2"><h1>Spiel beitreten</h1></td>
  </tr>
  <tr><td height="20" colspan="2"></td></tr>
  <tr>
    <td colspan="2">Sobald alle verf&uuml;gbaren Slots belegt sind, kann das Spiel gestartet werden.<!--startet das Spiel automatisch und Du erh&auml;ltst eine Email.--></td>
  </tr>  
  <tr>
    <td>Rasse</td>
    <td><select name="rasse">          
<?php
   for ($n=0;$n<$zaehler;$n++) { ?>
     <option value="<?=$filename[$n]?>"><?=$daten[$n][0]?></option>
<? }  ?>          </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" value="beitreten">
      <input type="hidden" name="game_id" value="<?=$_GET["game_id"]?>">
    </td>
  </tr>
</table>
</form>
<?php 
      }
    }
    else
    {
?><table width="99%" height="100%"><tr><td align="center">Du musst angemeldet und eingeloggt sein, um einem Spiel beizutreten.<br><a href="waiting.php">Zur&uuml;ck</a></td></tr></table><?php
    }   
  }
  elseif ( $_GET["action"] == "join2" && is_numeric($_POST["game_id"]) && $_POST["rasse"] )
  {
    if ($_SESSION["user_id"])
    {
      $sql = "SELECT * FROM $skrupel_portal_games WHERE id={$_POST["game_id"]}";
      $data = mysql_fetch_assoc( mysql_query($sql) );
      if ( $data["user_1"] != -1 && 
           $data["user_2"] != -1 && 
           $data["user_3"] != -1 && 
           $data["user_4"] != -1 && 
           $data["user_5"] != -1 && 
           $data["user_6"] != -1 && 
           $data["user_7"] != -1 && 
           $data["user_8"] != -1 && 
           $data["user_9"] != -1 &&
           $data["user_10"] != -1)
      {
?><table width="99%" height="100%"><tr><td align="center">Bei diesem Spiel ist leider kein Platz mehr frei.<br><a href="waiting.php">Zur&uuml;ck</a></td></tr></table><?php
      }
      elseif ( $data["user_1"] == $_SESSION["user_id"] || 
               $data["user_2"] == $_SESSION["user_id"] || 
               $data["user_3"] == $_SESSION["user_id"] || 
               $data["user_4"] == $_SESSION["user_id"] || 
               $data["user_5"] == $_SESSION["user_id"] || 
               $data["user_6"] == $_SESSION["user_id"] || 
               $data["user_7"] == $_SESSION["user_id"] || 
               $data["user_8"] == $_SESSION["user_id"] || 
               $data["user_9"] == $_SESSION["user_id"] ||
               $data["user_10"] == $_SESSION["user_id"])
      {
?><table width="99%" height="100%"><tr><td align="center">Du spielst bei diesem Spiel bereits mit.<br><a href="waiting.php">Zur&uuml;ck</a></td></tr></table><?php
      }
      else
      {
        for ($i = 1; $i <=10; $i++)
        {
          if ($data["user_$i"] == -1)
          {
            $sql = "UPDATE $skrupel_portal_games SET user_{$i}={$_SESSION["user_id"]}, rasse_{$i}=\"{$_POST["rasse"]}\" WHERE id = {$_POST["game_id"]}";
            mysql_query($sql);
?><table width="99%" height="100%"><tr><td align="center">Du bist erfolgreich dem Spiel beigetreten.<br><a href="waiting.php">Zur&uuml;ck</a></td></tr></table><?php            
            
            break;
          }
        }

        $sql = "SELECT * FROM $skrupel_portal_games WHERE id={$_POST["game_id"]}";
        $data = mysql_fetch_assoc( mysql_query($sql) );
        if ( $data["user_1"] != -1 &&
             $data["user_2"] != -1 &&
             $data["user_3"] != -1 &&
             $data["user_4"] != -1 &&
             $data["user_5"] != -1 &&
             $data["user_6"] != -1 &&
             $data["user_7"] != -1 &&
             $data["user_8"] != -1 &&
             $data["user_9"] != -1 &&
             $data["user_10"] != -1)
        {
          //Spiel ist voll
        }      
      }
    }
  }
  else if ($_GET["action"] == "delete" )
  {
if ($_SESSION["name"]==ADMIN && isset($_SESSION["user_id"]))
{    $sql = "DELETE FROM $skrupel_portal_games WHERE id = {$_GET["game_id"]} LIMIT 1"; }
else { $sql = "DELETE FROM $skrupel_portal_games WHERE id = {$_GET["game_id"]} AND spieler_admin = {$_SESSION["user_id"]} LIMIT 1"; }
    mysql_query( $sql );
    ?><table width="99%" height="100%"><tr><td align="center">Spiel wurde wie gew&uuml;nscht gel&ouml;scht.<br><a href="waiting.php">Zur&uuml;ck</a></td></tr></table><?php  
  }
  else
  {
  
    $user = Array();
    $sql   = "SELECT * FROM $skrupel_user";
    $query = mysql_query( $sql );
    while ( $data = mysql_fetch_assoc($query) )
      $user[$data["id"]]=$data;
  
if (ADMIN!=$_SESSION["name"] || ! isset($_SESSION["user_id"]))
{    $sql   = "SELECT * 
              FROM $skrupel_portal_games
              WHERE (
                                     (user_1 ".( $_SESSION["user_id"] ? "in (-1, {$_SESSION["user_id"]} )" : "= -1" )." OR 
                                      user_2 ".( $_SESSION["user_id"] ? "in (-1, {$_SESSION["user_id"]} )" : "= -1" )." OR 
                                      user_3 ".( $_SESSION["user_id"] ? "in (-1, {$_SESSION["user_id"]} )" : "= -1" )." OR 
                                      user_4 ".( $_SESSION["user_id"] ? "in (-1, {$_SESSION["user_id"]} )" : "= -1" )." OR 
                                      user_5 ".( $_SESSION["user_id"] ? "in (-1, {$_SESSION["user_id"]} )" : "= -1" )." OR
                                      user_6 ".( $_SESSION["user_id"] ? "in (-1, {$_SESSION["user_id"]} )" : "= -1" )." OR 
                                      user_7 ".( $_SESSION["user_id"] ? "in (-1, {$_SESSION["user_id"]} )" : "= -1" )." OR  
                                      user_8 ".( $_SESSION["user_id"] ? "in (-1, {$_SESSION["user_id"]} )" : "= -1" )." OR  
                                      user_9 ".( $_SESSION["user_id"] ? "in (-1, {$_SESSION["user_id"]} )" : "= -1" )." OR 
                                      user_10 ".( $_SESSION["user_id"] ? "in (-1, {$_SESSION["user_id"]} )" : "= -1" )."                                      
                                     ) ". ( $_SESSION["user_id"] ? "OR spieler_admin= {$_SESSION["user_id"]}" : "" ) ."
                                    ) ORDER BY id ASC";
}
else
{ $sql = "SELECT * FROM $skrupel_portal_games ORDER BY id ASC"; }
    $query = mysql_query( $sql );
?>
<table align="center" width="90%" cellpadding="6">
  <tr>
    <td align="center"><h1>Auf Spieler wartende Galaxien</h1></td>
  </tr>
<?php
    if ( $data = mysql_fetch_assoc( $query ) )
    {
    do 
    {
?>
  <tr>
    <td>  
  <table align="center" width="100%" cellpadding="2">  
<caption align="bottom"><hr /></caption>
    <tr>
      <td style="font-weight:bold">Spielname:</td>
      <td><?php echo $data["spiel_name"]; ?></td>
      <td style="font-weight:bold">Spielziel:</td>
      <td><?php
          if ($data["siegbedingungen"] == 0 )
            echo "JustforFun";   //es wird gespielt, bis die Runde langweilig wird
          elseif ($data["siegbedingungen"] == 1 )
            echo "&Uuml;berleben";    //Spiel endet, sobald nur noch {$data["zielinfo_1"]} Spieler existieren
          elseif ($data["siegbedingungen"] == 2 )
            echo "Todfeind";     //jeder Spieler erh&auml;lt einen Todfeind, den es zu vernichten gilt
          elseif ($data["siegbedingungen"] == 3 )
            echo "Dominanz";
          elseif ($data["siegbedingungen"] == 4 )
            echo "King of the Planet";
          elseif ($data["siegbedingungen"] == 5 )
            echo "Spice";        //{$data["zielinfo_5"]} KT Vomisaan m&uuml;ssen im freien Raum an Bord der eigenen Flotte gesichert werden
          elseif ($data["siegbedingungen"] == 6 )
            echo "Teamtodfeind"; //jedes Team aus 2 Spielern erh&auml;lt 2 Todfeinde, welche es zu vernichten gilt
          ?></td>
      <td style="font-weight:bold">Administrator:</td>
      <td><?php echo $user[$data["spieler_admin"]]["nick"]; ?></td>
    </tr>
    <tr>
      <td style="font-weight:bold">Details:</td>
      <td><a href="spielinfo.php?fu=1&spiel_id=<?php echo $data["id"]; ?>" rel="shadowbox[<?php echo $data["spiel_name"]; ?>];title=Details - <?php echo $data["spiel_name"]; ?>;width=875;height=600"><b>Anzeigen</b></a></td>
<?php      
      if ( $data["user_1"] != -1 && 
           $data["user_2"] != -1 && 
           $data["user_3"] != -1 && 
           $data["user_4"] != -1 && 
           $data["user_5"] != -1 && 
           $data["user_6"] != -1 && 
           $data["user_7"] != -1 && 
           $data["user_8"] != -1 && 
           $data["user_9"] != -1 &&
           $data["user_10"] != -1 )
      {
        if ( in_array( $_SESSION["user_id"], array( $data["user_1"],
                                                    $data["user_2"],
                                                    $data["user_3"],
                                                    $data["user_4"],
                                                    $data["user_5"],
                                                    $data["user_6"],
                                                    $data["user_7"],
                                                    $data["user_8"],
                                                    $data["user_9"], 
                                                    $data["user_10"] ) ) || $_SESSION["name"]==ADMIN && isset($_SESSION["user_id"]) )
        {
           ?><td><a href="create_game.php?action=prepare&game_id=<?php echo $data["id"]; ?>"><b>Spiel starten</b></a></td><?php
        }
      }
      else
      {
        if ($data["spieler_admin"] == $_SESSION["user_id"] || ADMIN==$_SESSION["name"])
        {
          ?><td><a href="create_game.php?action=prepare&game_id=<?php echo $data["id"]; ?>"><b>Spiel starten</b></a></td><?php
        }
      }
      if ($data["spieler_admin"] == $_SESSION["user_id"] || ADMIN==$_SESSION["name"])
      {
?>      <td><a href="waiting.php?action=delete&game_id=<?php echo $data["id"]; ?>"><b>Spiel l&ouml;schen</b></a></td>
<?php    
      }  
?>
    </tr>
    <tr>
      <td colspan="6" height="10"></td>
    </tr>
    <tr>
      <td colspan="2" style="font-weight:bold">Spieler</td>
      <td colspan="2" style="font-weight:bold">Rasse</td>
      <td colspan="2" style="font-weight:bold">Teilnahme</td>
    </tr>
<?php    
      for ( $i = 1; $i <= 10; $i++ )
      {
        if ($data["user_$i"] != 0)
        {
?>    
    <tr>
      <td colspan="2"><?php echo ( $data["user_$i"] == -1 ? "Wartet auf Mitspieler" : $user[$data["user_$i"]]["nick"]); ?></td>
      <td colspan="2"><?php echo ( $data["user_$i"] == -1 ? "Wird vom Mitspieler ausgew&auml;hlt" : $data["rasse_$i"]); ?></td>
      <td colspan="2"><?php echo ( $data["user_$i"] == -1 && 
                                   (
                                     $data["user_1"] != $_SESSION["user_id"] &&
                                     $data["user_2"] != $_SESSION["user_id"] &&
                                     $data["user_3"] != $_SESSION["user_id"] &&
                                     $data["user_4"] != $_SESSION["user_id"] &&
                                     $data["user_5"] != $_SESSION["user_id"] &&
                                     $data["user_6"] != $_SESSION["user_id"] &&
                                     $data["user_7"] != $_SESSION["user_id"] &&
                                     $data["user_8"] != $_SESSION["user_id"] &&
                                     $data["user_9"] != $_SESSION["user_id"] &&
                                     $data["user_10"] != $_SESSION["user_id"] 
                                   ) ? "<a href=\"waiting.php?action=join&game_id={$data["id"]}\">mitspielen</a>" : "") ?></td>
    </tr>
<?php
        }
      }      
?>   </table>
    </td>
  </tr>
<?php    
    } while ($data = mysql_fetch_assoc( $query ));
    }
    else
    {
?>  <tr>
     <td align="center">Zur Zeit gibt es keine offenen Galaxien, die noch auf Spieler warten.
<?php if ($_SESSION["user_id"]) { ?><br>Du kannst aber gerne selbst ein <a href="spiel_alpha.php">neues Spiel erstellen</a>.</td><?php } ?>
   </tr>
<?php
    }
?>
</table> 
<?php  
  }  
  require_once ("inc/_footer.php");
?>
