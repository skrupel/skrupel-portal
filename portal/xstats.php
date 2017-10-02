<?php
include "inc/conf.php";
include "inc/initial.php";
require ($skrupel_path."inc.conf.php");
require ($skrupel_path.'/extend/xstats/xstatsUtil.php');
require ($skrupel_path.'/extend/xstats/xstatsVersion.php');
$page_name="XStats";
require_once ("inc/_header.php");
?>
        <div id="logo">
            <img src="../extend/xstats/images/skrupel_logo.png" alt="" />
        </div>

        <div class="borderedBoxWrap">
            <div class="borderedBox">
                <div class="borderedBoxInner">
                    <ul class="listGames">
<?php
$result = @mysql_query("SELECT * FROM skrupel_spiele") or die(mysql_error());
$gameCount = 0;
while ($row = mysql_fetch_array($result)) {
      echo ('<li>');
      $statsGameId = $row['id'];
      $gameCount++;
      $statsGameDisplay = '<strong>' . $row['name'] . '</strong>';
      $statsAvailableIds = xstats_getAvailablePlayerIndicies($statsGameId);
      $statsSize = $row['umfang'] . 'x' . $row['umfang'];
      $statsGameDisplay = $statsGameDisplay . ' (' . count($statsAvailableIds) . ' Spieler, ' . $statsSize . ')';
      if (xstats_gameIsFinished($statsGameId)) {
            if (xstats_gameExistsInStats($statsGameId)) {
                  echo ($statsGameDisplay . ' <a href="../extend/xstats/DisplaySingleGame.php?gameid=' . $statsGameId . '&outputtype=IMAGE" target="_new">Bildversion</a>' .
                        ' <a href="../extend/xstats/DisplaySingleGame.php?gameid=' . $statsGameId . '&outputtype=FLASH" target="_new">Flashversion</a>');
	if (file_exists($skrupel_path."extend/movieflash/MovieFlash.swf")) {
                         echo (' <a href="../extend/movieflash/MovieFlash.swf?game_id=' . $statsGameId . ' "target="_new">MovieFlash</a>'); }
            } else {
                  echo ($statsGameDisplay . ' (Keine Statistikaufzeichnungen verf&uuml;gbar)');
            }
      } else {
            echo ($statsGameDisplay . "<i> (Keine Statistik verf&uuml;gbar, Spiel ist noch nicht beendet)</i>");
      }
      echo ('</li>');
}
if ($gameCount == 0) {
      echo ("Es ist leider kein Spiel verf&uuml;gbar.");
}
?>
                    </ul></div>
<hr />
<a href="finished.php">Zu den normalen Statistiken wechseln</a>.</div></div>
<?php
require_once ("inc/_footer.php");
?>
