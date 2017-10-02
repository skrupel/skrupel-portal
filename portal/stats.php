<?php
include "inc/conf.php";
  include "inc/initial.php";
$page_name="Mitglieder";
  require_once ("inc/_header.php");

$order=Array();
$order[0]["value"]="nick";
$order[0]["text"]="Name (Aphabet)";

$order[1]["value"]="stat_teilnahme";
$order[1]["text"]="Spiele teilgenommen";

$order[2]["value"]="stat_sieg";
$order[2]["text"]="Spiele gewonnen";

$order[3]["value"]="stat_schlacht";
$order[3]["text"]="Schlachten geschlagen";

$order[4]["value"]="stat_schlacht_sieg";
$order[4]["text"]="Schlachten gewonnen";

$order[5]["value"]="stat_kol_erobert";
$order[5]["text"]="Kolonien erobert";

$order[6]["value"]="stat_lichtjahre";
$order[6]["text"]="Lichtjahre geflogen";

$order[7]["value"]="stat_monate";
$order[7]["text"]="Runden gespielt";

$order[8]["value"]="portal_activity";
$order[8]["text"]="Zuletzt online";

if (! $_GET["order"] || $_GET["order"]=="")
{ $_GET["order"]=$order[0]["value"]; }

$check=0;
for ($zaehl=0; $zaehl<count($order); $zaehl++)
{ if ($_GET["order"]==$order[$zaehl]["value"])
{ $check=1; } }

if ($check==0)
{ $_GET["order"]=$order[0]["value"]; }

if ($_GET["sort"]!="ASC" && $_GET["sort"]!="DESC")
{ $_GET["sort"]="ASC"; }

$select=$_GET["order"]." ".$_GET["sort"];

?>
<form name="order" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
<h1>Mitglieder</h1>
Sortieren nach: <select name="order">
<?php
for ($zaehler=0; $zaehler<count($order); $zaehler++)
{ ?>
<option value="<?php echo $order[$zaehler]["value"]; ?>" <?php if ($_GET["order"]==$order[$zaehler]["value"]) { ?>selected<?php } ?> ><?php echo $order[$zaehler]["text"]; ?></option>
<?php } ?>
</select> <select name="sort"><option value="DESC" <?php if ($_GET["sort"]=="DESC"){ ?>selected<?php } ?>>Absteigend</option><option value="ASC" <?php if ($_GET["sort"]=="ASC"){ ?>selected<?php } ?>>Aufsteigend</option></select>
<input type="submit" name="submit" value="Sortieren" />
</form>
<table align="center" border cellspacing="0" style="border-color:white; border-width:2pt; border-style:double; margin-left:-15pt">
<th>#</th>
<?php
for ($zaehler2=0; $zaehler2<count($order); $zaehler2++)
{ ?> 
<th<?php if ($_GET["order"]==$order[$zaehler2]["value"]){?> style="background-color:darkred"<?php } ?>><b><?php echo $order[$zaehler2]["text"]; ?></b></th>
<?php } ?>
  </tr>
<?php
$zaehler3=0;
  require_once "inc/_db.php";
  $sql = "SELECT nick, 
                 stat_teilnahme, 
                 stat_sieg, 
                 stat_schlacht, 
                 stat_schlacht_sieg, 
                 stat_kol_erobert, 
                 stat_lichtjahre, 
                 stat_monate,
                 portal_bann,
                 portal_activity
          FROM $skrupel_user 
          ORDER BY $select, nick ASC";
  $query = mysql_query( $sql );
  while ( $data = mysql_fetch_assoc( $query ) )
  { 	$nick=preg_replace("#Computer \((Leicht|Mittel)\) .#isU", "", $data["nick"]);
	if (isset($nick) && $nick!="") {
$zaehler3++;
if ($data["portal_activity"]>=time()-60*60*5)
{ $last_on="<b>Jetzt</b>"; } 
else if ($data["portal_activity"]==0) { $last_on="<i>Noch nicht</i>"; }
else { $last_on=date("d.m.y H:m:s", $data["portal_activity"]); }
?>
  <tr style="height:25pt">
    <td><?php echo $zaehler3; ?></td>
    <td<?php if ($zaehler3==1){?> style="background-color:mediumblue"<?php } else if ($data["nick"]==$_SESSION["name"]){ ?> style="background-color:darkblue"<?php } ?>><?php if ($data["portal_bann"]==1){ echo "<strike>".$data["nick"]."</strike>"; } else { echo $data["nick"]; } ?></td>
    <td align="right"><?php echo $data["stat_teilnahme"]; ?></td>
    <td align="right"><?php echo $data["stat_sieg"]; ?></td>
    <td align="right"><?php echo $data["stat_schlacht"]; ?></td>
    <td align="right"><?php echo $data["stat_schlacht_sieg"]; ?></td>
    <td align="right"><?php echo $data["stat_kol_erobert"]; ?></td>
    <td align="right"><?php echo $data["stat_lichtjahre"]; ?></td>
    <td align="right"><?php echo $data["stat_monate"]; ?></td>
    <td align="center"><?php echo $last_on; ?></td>
  </tr>
<?php    
  } }
?>
</table>
<?php 
  require_once ("inc/_footer.php");  
?>