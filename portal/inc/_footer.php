		</div>
	</div>
	<div id="footer">
		<ul id="footermenu">
				<li><a href="index.php">Home</a></li>
				<li><a href="agb.php">AGB</a></li>
				<li><a href="impressum.php">Impressum</a></li>
				<li><a href="kontakt.php">Kontakt</a></li>
		</ul>
	</div>
</div>
	<div id="valid">
		<!-- Es ist nicht erlaubt, Änderungen an der Copyright-Zeile vorzunehmen. -->
		<div id="designed_by">&copy; 2011 Till Affeldt
<?php
include "styles/design.php";
for ($zaehler = 0; $zaehler < count($design); $zaehler++) {
	if ($design[$zaehler]["path"] == $_SESSION["layout"]) {
		echo $design[$zaehler]["copy"];
	}
}
$sql = mysql_query("SELECT * FROM $skrupel_info LIMIT 1");
while ($row = mysql_fetch_object($sql)) {
	$skrupel_version = $row->version;
}
$mtime = microtime();
$mtime = explode(' ', $mtime);
$mtime = $mtime[1] + $mtime[0];
$time2 = $mtime;
$loadtime = ($time2 - $time1);
$loadtime = round($loadtime, 2);
?><br>
			<a href="http://www.skrupel.de/" target="_blank">Skrupel</a> V<?php echo $skrupel_version; ?> - <a href="http://www.space-pirates.4lima.de/webmaster/portal/" target="_blank">Portal</a> V<?php echo $portal_version; ?><br>
			Seitengenerierung: <?php echo $loadtime; ?> Sekunde<?php if ($loadtime!=1){ ?>n<?php } ?>
		</div>
	</div>
</body>

</html>