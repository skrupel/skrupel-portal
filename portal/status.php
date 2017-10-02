<?php
//////////////////////
// Teil 1: Globales //
//////////////////////
  include "inc/conf.php";
  include "inc/initial.php";
  require ($skrupel_path."inc.conf.php");
$page_name="Rundenstatus";
  require_once "inc/_header.php";
$_GET["name"]=$_SESSION["name"];
$rss_root = $_SERVER["SERVER_NAME"];
$rss_pubdate = date("D, d M Y H:i:s O");
$rss_name = "nobody";
$rss_gibts = 0;
$rss_user = array();
echo "<h1><u>Rundenstatus</u></h1>";
$rss_error_start = "<h2>Achtung! - Fehler</h2>";

$rss_conn = @mysql_connect("$server","$login","$password");
$rss_db = @mysql_select_db("$database",$rss_conn);

if ($rss_db) {
/*start: if ($rss_db)*/

if ($_GET["name"]) {
  $rss_name = $_GET["name"];
}

$rss_zeiger = @mysql_query("SELECT * FROM $skrupel_user where nick='$rss_name'");
$rss_anz = @mysql_num_rows($rss_zeiger);
$rss_user = @mysql_fetch_array($rss_zeiger);

if ($rss_anz!=1) {
  echo "$rss_error_start Name nicht gefunden. Bitte &uuml;berpr&uuml;fe nochmal die Schreibweise.";
  exit;
}

$rss_spieler_id = $rss_user["id"];
$rss_zeiger2 = @mysql_query("SELECT * FROM $skrupel_spiele where (spieler_1=$rss_spieler_id or spieler_2=$rss_spieler_id or spieler_3=$rss_spieler_id or spieler_4=$rss_spieler_id or spieler_5=$rss_spieler_id or spieler_6=$rss_spieler_id or spieler_7=$rss_spieler_id or spieler_8=$rss_spieler_id or spieler_9=$rss_spieler_id or spieler_10=$rss_spieler_id)");
$rss_anz2 = @mysql_num_rows($rss_zeiger2);

/*ende: if ($rss_db)*/
}
else {
  echo "$rss_error_start Verbindung zur Datenbank konnte nicht aufgebaut werden. Versuch es sp&auml;ter nochmal oder informiere deinen Admin.";
  exit;
}


///////////////////////
// Teil 2: RSS-Start //
///////////////////////


/////////////////////////
// Teil 3: Nachrichten      //
/////////////////////////

while ($rss_spiele = @mysql_fetch_array($rss_zeiger2)) {
  if ($rss_spiele["spieler_1"]==$rss_user["id"]) {$rss_spieler=1;}
  if ($rss_spiele["spieler_2"]==$rss_user["id"]) {$rss_spieler=2;}
  if ($rss_spiele["spieler_3"]==$rss_user["id"]) {$rss_spieler=3;}
  if ($rss_spiele["spieler_4"]==$rss_user["id"]) {$rss_spieler=4;}
  if ($rss_spiele["spieler_5"]==$rss_user["id"]) {$rss_spieler=5;}
  if ($rss_spiele["spieler_6"]==$rss_user["id"]) {$rss_spieler=6;}
  if ($rss_spiele["spieler_7"]==$rss_user["id"]) {$rss_spieler=7;}
  if ($rss_spiele["spieler_8"]==$rss_user["id"]) {$rss_spieler=8;}
  if ($rss_spiele["spieler_9"]==$rss_user["id"]) {$rss_spieler=9;}
  if ($rss_spiele["spieler_10"]==$rss_user["id"]) {$rss_spieler=10;}
  $rss_spiel = $rss_spiele["name"];
$zeichen=Array();
$zeichen[0]="ä";
$zeichen[1]="ö";
$zeichen[2]="ü";
$zeichen[3]="ß";
$zeichen[4]="Ä";
$zeichen[5]="Ö";
$zeichen[6]="Ü";

$ersatz=Array();
$ersatz[0]="ae";
$ersatz[1]="oe";
$ersatz[2]="ue";
$ersatz[3]="ss";
$ersatz[4]="Ae";
$ersatz[5]="Oe";
$ersatz[6]="Ue"; 

for ($zaehler=0; $zaehler<7; $zaehler++)
{ $rss_spiel=str_replace($zeichen[$zaehler], $ersatz[$zaehler], $rss_spiel); }
  $rss_fehlt = "";
  $rss_fehlt_anz = 0;
  $rss_i = 1;
  while ($rss_i <= 10) {
    if ($rss_i == $rss_spieler) {}
    elseif ($rss_spiele["spieler_".$rss_i."_zug"]==0 && $rss_spiele["spieler_".$rss_i]!=0) {
      $rss_zeiger3 = @mysql_query("SELECT * FROM $skrupel_user where id=".$rss_spiele["spieler_".$rss_i]);
      $rss_fehlt_user = @mysql_fetch_array($rss_zeiger3);
      $rss_fehlt_anz ++;
      $rss_fehlt .= $rss_fehlt_user["nick"].", ";
    }
    $rss_i ++;
  }
  if($rss_fehlt!="") {
    $rss_fehlt = substr($rss_fehlt,0,-2);
  }
  $rss_autotick = $rss_spiele["lasttick"] + ($rss_spiele["autozug"] * 3600);
  $rss_autotick_tag = date("d.n.y",$rss_autotick);
  $rss_autotick_zeit = date("G:i:s",$rss_autotick);
  if ($rss_spiele["phase"]==0) {
    if ($rss_spiele["spieler_".$rss_spieler."_zug"]==0) {
/* if: Zug nicht abgeschlossen */
?>

    <div>
<h2 style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2); font-family:Times;"><?php echo $rss_spiel; ?>: Zug noch nicht abgeschlossen!</h2>

     Im Spiel "<?php echo $rss_spiel; ?>" hast du deinen Zug noch nicht abgeschlossen<?php if($rss_fehlt_anz>=2): ?>.<br />Dabei bist du aber nicht der einzige, ausser dir gibt es noch <?php echo $rss_fehlt_anz; ?> weitere User, welche ihren Zug noch nicht gemacht haben: <?php echo $rss_fehlt; ?>.<?php elseif($rss_fehlt_anz==1): ?>. Ausser dir fehlt er auch noch von <?php echo $rss_fehlt; ?>.<?php else: ?>, du bist der einzige, von dem er noch fehlt!<?php endif; ?><?php if($rss_spiele["autozug"]!=0): ?><?php if($rss_autotick>=time()): ?> Du hast noch Zeit bis zum Autotick am <?php echo $rss_autotick_tag; ?> um <?php echo $rss_autotick_zeit; ?> Uhr.<?php else: ?> Leider liegt die Autotick-Zeit bereits seit dem <?php echo $rss_autotick_tag; ?> um <?php echo $rss_autotick_zeit; ?> in der Vergangenheit, beim Login beginnt also bereits die neue Runde. Dein Zug ist also verloren.<?php endif; ?><?php endif; ?>
    </div>

<?php
    }
    elseif ($rss_spiele["spieler_".$rss_spieler."_zug"]==1 && ($rss_autotick>=time() || $rss_spiele["autotick"]==0)) {
/* if: Zug abgeschlossen, Autotick aus oder in Zukunft */
?>

    <div>
      <h2 style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2); font-family:Times;"><?php echo $rss_spiel; ?>: Zug abgeschlossen!</h2>
      Im Spiel "<?php echo $rss_spiel; ?>" hast du deinen Zug bereits abgeschlossen<?php if($rss_fehlt_anz>=2): ?>, im Gegensatz zu <?php echo $rss_fehlt_anz; ?> anderen Usern: <?php echo $rss_fehlt; ?>. <?php else: ?>. <br />Allerdings hat <?php echo $rss_fehlt; ?> das noch nicht gemacht.<?php endif; ?><?php if($rss_spiele["autozug"]!=0): ?><br />Der Autotick läuft am <?php echo $rss_autotick_tag; ?> um <?php echo $rss_autotick_zeit; ?> Uhr.<?php endif; ?>
    </div>

<?php
    }
    else {
?>

    <div>
      <h2 style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2); font-family:Times;"><?php echo $rss_spiel; ?>: Autotick aktivierbar!</h2>
      Im Spiel "<?php echo $rss_spiel; ?>" kannst du den Autotick auslösen. <?php if($rss_fehlt_anz>=2): ?>Damit ist dann jedoch der Zug von <?php echo $rss_fehlt_anz; ?> Usern vorloren: <?php echo $rss_fehlt; ?>.<?php else: ?>Damit ist jedoch der Zug von <?php echo $rss_fehlt; ?> verloren.<?php endif; ?>Der Autotick ist seit dem <?php echo $rss_autotick_tag; ?> um <?php echo $rss_autotick_zeit; ?> Uhr bereit zum auslösen.
    </div>
<?php
    }
  }
}

///////////////////
// Teil 4: Ende!      //
///////////////////

?>
<hr />
<img src="pics/rss.png" alt="RSS" title="" />
<?php
if (file_exists($skrupel_path."extend/rss/runden.xml.php")) { ?>
<a href="<?php echo $skrupel_path; ?>extend/rss/runden.xml.php?name=<?php echo $_SESSION["name"]; ?>" target="_blank">RSS-Version anzeigen</a>

<?php
} else { ?>
RSS-Addon nicht installiert.

<?php
}
require_once ("inc/_footer.php");
?>