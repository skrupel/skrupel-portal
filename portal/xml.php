<?php
  header("Content-type: text/xml");
  header("Content-Encoding: UTF-8");
include "inc/conf.php";
  require_once ("inc/initial.php"); 
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
  if ( $_GET["action"] == "details_active" && is_numeric($_GET["game_id"]) )
  {
    $sql   = "SELECT spiele.*, user1.nick as spieler_1_name FROM $skrupel_spiele as spiele LEFT JOIN $skrupel_user as user1 on spiele.spieler_1 = user1.id WHERE spiele.id = {$_GET["game_id"]}";
    $query = mysql_query($sql);
    $data  = mysql_fetch_assoc($query);
?><skrupelgame>
  <name><?=utf8_encode($data["name"])?></name>
  <goal><?=$data["ziel_id"]?></goal>
  <goal_info><?=$data["ziel_info"]?></goal_info>
  <out><?=utf8_encode($data["oput"] != null ? $data["oput"] : $data["out"])?></out>
  <user_1><?=utf8_encode($data["spieler_1"])?></user_1>
  <user_2><?=utf8_encode($data["spieler_2"])?></user_2>
  <user_3><?=utf8_encode($data["spieler_3"])?></user_3>
  <user_4><?=utf8_encode($data["spieler_4"])?></user_4>
  <user_5><?=utf8_encode($data["spieler_5"])?></user_5>
  <user_6><?=utf8_encode($data["spieler_6"])?></user_6>
  <user_7><?=utf8_encode($data["spieler_7"])?></user_7>
  <user_8><?=utf8_encode($data["spieler_8"])?></user_8>
  <user_9><?=utf8_encode($data["spieler_9"])?></user_9>
  <user_10><?=utf8_encode($data["spieler_10"])?></user_10>
  <race_1><?=utf8_encode($data["spieler_1_rassename"])?></race_1>
  <race_2><?=utf8_encode($data["spieler_2_rassename"])?></race_2>
  <race_3><?=utf8_encode($data["spieler_3_rassename"])?></race_3>
  <race_4><?=utf8_encode($data["spieler_4_rassename"])?></race_4>
  <race_5><?=utf8_encode($data["spieler_5_rassename"])?></race_5>
  <race_6><?=utf8_encode($data["spieler_6_rassename"])?></race_6>
  <race_7><?=utf8_encode($data["spieler_7_rassename"])?></race_7>
  <race_8><?=utf8_encode($data["spieler_8_rassename"])?></race_8>
  <race_9><?=utf8_encode($data["spieler_9_rassename"])?></race_9>
  <race_10><?=utf8_encode($data["spieler_10_rassename"])?></race_10>
  <admin><?=utf8_encode($data["spieler_admin"])?></admin>
  <max><?=$data["plasma_max"]?></max>
  <wahr><?=$data["plasma_wahr"]?></wahr>
  <lang><?=$data["plasma_lang"]?></lang>
  <umfang><?=$data["umfang"]?></umfang>
  <moduls><?=$data["module"]?></moduls>
  <fogofwar><?=$data["nebel"]?></fogofwar>
  <pirates_center><?=$data["piraten_mitte"]?></pirates_center>
  <pirates_outer><?=$data["piraten_aussen"]?></pirates_outer>
  <pirates_min><?=$data["piraten_min"]?></pirates_min>
  <pirates_max><?=$data["piraten_max"]?></pirates_max>  
  <spieler_1_name><?=$data["spieler_1_name"]?></spieler_1_name>    
</skrupelgame><?php  
  }
  elseif ( $_GET["action"] == "details_waiting" && is_numeric($_GET["game_id"]) )
  {
    $sql   = "SELECT * FROM $skrupel_portal_games WHERE id = {$_GET["game_id"]}";
    $query = mysql_query($sql);
    $data  = mysql_fetch_assoc($query);
?><skrupelgame>
  <name><?=utf8_encode($data["spiel_name"])?></name>
  <goal><?=utf8_encode($data["siegbedingungen"])?></goal>
  <goal_info_1><?=utf8_encode($data["zielinfo_1"])?></goal_info_1>
  <goal_info_2><?=utf8_encode($data["zielinfo_2"])?></goal_info_2>
  <goal_info_3><?=utf8_encode($data["zielinfo_3"])?></goal_info_3>
  <goal_info_4><?=utf8_encode($data["zielinfo_4"])?></goal_info_4>
  <goal_info_5><?=utf8_encode($data["zielinfo_5"])?></goal_info_5>
  <out><?=utf8_encode($data["oput"] != null ? $data["oput"] : $data["out"])?></out>
  <user_1><?=utf8_encode($data["user_1"])?></user_1>
  <user_2><?=utf8_encode($data["user_2"])?></user_2>
  <user_3><?=utf8_encode($data["user_3"])?></user_3>
  <user_4><?=utf8_encode($data["user_4"])?></user_4>
  <user_5><?=utf8_encode($data["user_5"])?></user_5>
  <user_6><?=utf8_encode($data["user_6"])?></user_6>
  <user_7><?=utf8_encode($data["user_7"])?></user_7>
  <user_8><?=utf8_encode($data["user_8"])?></user_8>
  <user_9><?=utf8_encode($data["user_9"])?></user_9>
  <user_10><?=utf8_encode($data["user_10"])?></user_10>
  <race_1><?=utf8_encode($data["rasse_1"])?></race_1>
  <race_2><?=utf8_encode($data["rasse_2"])?></race_2>
  <race_3><?=utf8_encode($data["rasse_3"])?></race_3>
  <race_4><?=utf8_encode($data["rasse_4"])?></race_4>
  <race_5><?=utf8_encode($data["rasse_5"])?></race_5>
  <race_6><?=utf8_encode($data["rasse_6"])?></race_6>
  <race_7><?=utf8_encode($data["rasse_7"])?></race_7>
  <race_8><?=utf8_encode($data["rasse_8"])?></race_8>
  <race_9><?=utf8_encode($data["rasse_9"])?></race_9>
  <race_10><?=utf8_encode($data["rasse_10"])?></race_10>
  <admin><?=utf8_encode($data["spieler_admin"])?></admin>
  <startposition><?=$data["startposition"]?></startposition>
  <imperiumgroesse><?=$data["imperiumgroesse"]?></imperiumgroesse>
  <geldmittel><?=$data["geldmittel"]?></geldmittel>
  <mineralienhome><?=$data["mineralienhome"]?></mineralienhome>
  <sternendichte><?=$data["sternendichte"]?></sternendichte>
  <mineralien><?=$data["mineralien"]?></mineralien>
  <species><?=$data["spezien"]?></species>
  <max><?=$data["max"]?></max>
  <wahr><?=$data["wahr"]?></wahr>
  <lang><?=$data["lang"]?></lang>
  <instabil><?=$data["instabil"]?></instabil>
  <stabil><?=$data["stabil"]?></stabil>
  <leminvorkommen><?=$data["leminvorkommen"]?></leminvorkommen>
  <umfang><?=$data["umfang"]?></umfang>
  <struktur><?=$data["struktur"]?></struktur>
  <modul_0><?=$data["modul_0"]?></modul_0>
  <modul_2><?=$data["modul_2"]?></modul_2>
  <modul_3><?=$data["modul_3"]?></modul_3>
  <team1><?=$data["team1"]?></team1>
  <team2><?=$data["team2"]?></team2>
  <team3><?=$data["team3"]?></team3>
  <team4><?=$data["team4"]?></team4>
  <team5><?=$data["team5"]?></team5>
  <team6><?=$data["team6"]?></team6>
  <team7><?=$data["team7"]?></team7>
  <team8><?=$data["team8"]?></team8>
  <team9><?=$data["team9"]?></team9>
  <team10><?=$data["team10"]?></team10>
  <fogofwar><?=$data["nebel"]?></fogofwar>
  <pirates_center><?=$data["piraten_mitte"]?></pirates_center>
  <pirates_outer><?=$data["piraten_aussen"]?></pirates_outer>
  <pirates_min><?=$data["piraten_min"]?></pirates_min>
  <pirates_max><?=$data["piraten_max"]?></pirates_max>
  <playable><?=$data["playable"]?></playable>
</skrupelgame><?php  
  }
  else
  {
    header("HTTP/1.0 404 Not Found");
  }
?>