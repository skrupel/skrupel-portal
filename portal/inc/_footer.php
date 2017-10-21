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
		<div id="designed_by">
			&copy; 2017 <a href="source.php">Till Affeldt und Skrupel-Community</a>
<?php
    include 'styles/design.php';

    for ($zaehler = 0; $zaehler < count($design); $zaehler++) {
        if ($design[$zaehler]['path'] == $_SESSION['layout']) {
            echo '<br>'.$design[$zaehler]['copy'];
        }
    }

    $sql = mysql_query("SELECT * FROM $skrupel_info LIMIT 1");
    while ($row = mysql_fetch_object($sql)) {
        $skrupel_version = $row->version;
    }

    $mtime = explode(' ', microtime());
    $time2 = $mtime[1] + $mtime[0];
    $loadtime = ($time2 - $time1);
    $loadtime = round($loadtime, 2);
?>
			<p><a href="http://www.skrupel.de/" target="_blank">Skrupel</a> V<?php echo $skrupel_version; ?> | <a href="http://www.space-pirates.4lima.de/webmaster/portal/" target="_blank">Portal</a> V<?php echo $portal_version; ?></p>
			<p>Seitengenerierung: <?php echo $loadtime; ?> Sekunde<?php if ($loadtime != 1){ ?>n<?php } ?></p>
		</div>
	</div>
</body>

</html>