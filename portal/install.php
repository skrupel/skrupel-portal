<?php
session_start();

$supported_versions = array('0.974_nightly', '0.975');

$skrupel_path = '..';
$skrupel_portal = 'skrupel_portal';
$skrupel_portal_games = 'skrupel_portal_games';
$skrupel_portal_linklist = 'skrupel_portal_linklist';
$skrupel_portal_messages = 'skrupel_portal_messages';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Skrupel-Portal - Installation</title>
    <link rel="stylesheet" type="text/css" href="styles/classic/css/style.css">
    <style type="text/css">
        #window {
            margin: 30px;
            max-width: 500px;
            background: #444;
            vertical-align:middle;
            width:600px;
            height:319px;
            margin:15% auto 0;
            padding:15px;
            border:2px outset #666;
            text-align: center;
        }
        table {
            margin: 0 auto;
        }
        td {
            text-align: left;
        }
        #buttons {
            margin-top: 1.5em;
        }
        #loading {
            line-height: 2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="window">
<?php
    if (!isset($_GET['step'])) {
?>
        <h1>Portal-Installation</h1>
        <form action="install.php?step=config" method="post">
            <table>
                <tr>
                    <td><input type="radio" name="version" value="0" checked /></td>
                    <td>Neu installieren</td>
                </tr>
                <tr>
                    <td><input type="radio" name="version" value="1"/></td>
                    <td>Update von Tiramon-Portal v0.5</td>
                </tr>
                <tr>
                    <td><input type="radio" name="version" value="2"/></td>
                    <td>Update von SpacePirates-Portal v1.0</td>
                </tr>
                <tr>
                    <td><input type="radio" name="version" value="3"/></td>
                    <td>Update von SpacePirates-Portal v1.0 + Patch</td>
                </tr>
            </table>
            <p id="buttons">
                <button type="submit">Weiter</button>
            </p>
        </form>
<?php
    } elseif ($_GET['step'] == 'config') {
        // Enter Configuration Data
?>
        <h1>Portal-Installation</h1>
        <form action="install.php?step=check" method="post">
            <input type="hidden" name="version" value="<?= $_POST['version'] ?>"/>
            <table>
                <tr>
                    <td>Pfad zu Skrupel</td>
                    <td><input type="text" name="skrupel_path" value="<?= $skrupel_path ?>" style="width: 200px;"/></td>
                </tr>
                <tr>
                    <td>Name der Tabelle f&uuml;r Portal-Einstellungen</td>
                    <td><input name="skrupel_portal" value="<?= $skrupel_portal ?>" style="width:200px;"/></td>
                </tr>
                <tr>
                    <td>Name der Tabelle f&uuml;r wartende Spiele</td>
                    <td><input type="text" name="skrupel_portal_games" value="<?= $skrupel_portal_games ?>" style="width: 200px;"/></td>
                </tr>
                <tr>
                    <td>Name der Tabelle f&uuml;r die Linkliste</td>
                    <td><input name="skrupel_portal_linklist" value="<?= $skrupel_portal_linklist ?>" style="width:200px;"/></td>
                </tr>
                <tr>
                    <td>Name der Tabelle f&uuml;r PNs</td>
                    <td><input name="skrupel_portal_messages" value="<?= $skrupel_portal_messages ?>" style="width:200px;"/>
                    </td>
                </tr>
            </table>
            <p id="buttons">
                <button type="submit">Weiter</button>
                <button type="reset" onClick="location.href='<?= $_SERVER['PHP_SELF'] ?>'; return false;">Zur&uuml;ck</button>
            </p>
        </form>
<?php
    } elseif ($_GET['step'] == 'check') {
        // Check entered Configuration Data
        $ok = true;
        $conf_found = false;

        if ($_POST['skrupel_path'] == '' || $_POST['skrupel_path'] == '.' || $_POST['skrupel_path'] == './') {
            echo '<p><span style="color: red">Skrupel und das Portal sollten sich nicht im selben Ordner befinden!</span></p>';
        }

        if (is_file($_POST['skrupel_path'].'/inc.conf.php')) {
            echo '<p><span style="color: lightgreen">Skrupel Konfigurationsdatei gefunden.</span></p>';
            $conf_found = true;
        } else {
            echo '<p><span style="color: red">Skrupel Konfigurationsdatei nicht gefunden!</span></p>';
            $ok = false;
        }

        if (is_dir($_POST['skrupel_path'].'/admin')) {
            echo '<p><span style="color: lightgreen">Skrupel Admin-Ordner gefunden.</span></p>';
        } else {
            echo '<p><span style="color: red">Skrupel Admin-Ordner nicht gefunden!</span></p>';
            $ok = false;
        }

        if (is_dir($_POST['skrupel_path'].'/bilder') && is_file($_POST['skrupel_path'].'/bilder/logo_login.gif')) {
            echo '<p><span style="color: lightgreen">Skrupel Bilder-Ordner gefunden.</span></p>';
        } else {
            echo '<p><span style="color: red">Skrupel Bilder-Ordner nicht gefunden!</span></p>';
            $ok = false;
        }

        if ($conf_found) {
            require_once $_POST['skrupel_path'].'/inc.conf.php';
            require_once $_POST['skrupel_path'].'/inhalt/inc.hilfsfunktionen.php';

            if ($conn = open_db()) {
                echo '<p><span style="color: lightgreen">Verbindung zur Datenbank erfolgreich hergestellt.</span></p>';
                $query = mysql_query("SELECT version FROM `$skrupel_info`", $conn);
                if ($data = mysql_fetch_assoc($query)) {
                    if (in_array($data['version'], $supported_versions)) {
                        echo '<p><span style="color: lightgreen">Skrupel Version '.$data['version'].' wird unterst&uuml;tzt.</span></p>';
                    } else {
                        echo '<p><span style="color: red">Skrupel Version nicht unterst&uuml;tzt (installiert: '.$data['version'].', unterst&uuml;tzt: '.implode(', ', $supported_versions).')</span><br>';
                        $ok = false;
                    }
                }
            } else {
                echo '<p><span style="color: red">Konnte nicht mit der angegebenen Datenbank verbinden!</span></p>';
                $ok = false;
            }
        }

        $file = 'inc/conf.php';
        touch($file);
        if (is_writable($file)) {
            echo '<p><span style="color: lightgreen">Schreibrechte f&uuml;r '.$file.' existieren.</span></p>';
        } elseif (chmod($file, 0777)) {
            echo '<p><span style="color: lightgreen">Schreibrechte wurde erfolgreich ge&auml;ndert.</span></p>';
            echo '<p><span style="color: lightgreen">Schreibrechte f&uuml;r '.$file.' existieren.</span></p>';
        } else {
            echo '<p><span style="color: red">Schreibrechte f&uuml;r '.$file.' sind nicht vorhanden.</span></p>';
            echo '<p><span style="color: red">Keine Rechte f&uuml;r CHMOD!</span></p>';
            $ok = false;
        }

?>
        <form name="formular" action="install.php?step=install" method="post">
            <input type="hidden" name="version" value="<?= $_POST['version'] ?>"/>
            <input type="hidden" name="skrupel_path" value="<?= $_POST['skrupel_path'] ?>"/>
            <input type="hidden" name="skrupel_portal" value="<?= $_POST['skrupel_portal'] ?>"/>
            <input type="hidden" name="skrupel_portal_games" value="<?= $_POST['skrupel_portal_games'] ?>"/>
            <input type="hidden" name="skrupel_portal_linklist" value="<?= $_POST['skrupel_portal_linklist'] ?>"/>
            <input type="hidden" name="skrupel_portal_messages" value="<?= $_POST['skrupel_portal_messages'] ?>"/>

            <p id="buttons">
<?php if ($ok): ?>
                <button type="submit">Installieren</button>
<?php endif; ?>
                <button type="reset" onClick="history.back(); return false;">Zur&uuml;ck</button>
            </p>
        </form>
<?php
    } elseif ($_GET['step'] == 'install') {
        // Loader Screen while Installation is running
?>
        <div id="loading">
            <p><img src="<?= $_POST['skrupel_path'] ?>/bilder/rad.gif" alt="Eingabe wird verarbeitet"></p>
            <p>Installation l&auml;uft.<br>Bitte warten...</p>
        </div>
        <form id="formular" action="install.php?step=doinstall" method="post">
            <input type="hidden" name="version" value="<?= $_POST['version'] ?>"/>
            <input type="hidden" name="skrupel_path" value="<?= $_POST['skrupel_path'] ?>"/>
            <input type="hidden" name="skrupel_portal" value="<?= $_POST['skrupel_portal'] ?>"/>
            <input type="hidden" name="skrupel_portal_games" value="<?= $_POST['skrupel_portal_games'] ?>"/>
            <input type="hidden" name="skrupel_portal_linklist" value="<?= $_POST['skrupel_portal_linklist'] ?>"/>
            <input type="hidden" name="skrupel_portal_messages" value="<?= $_POST['skrupel_portal_messages'] ?>"/>
        </form>
        <script type="text/javascript">
            window.setTimeout("document.getElementById('formular').submit()", 100);
        </script>
<?php
    } elseif ($_GET['step'] == 'doinstall') {
        // Creation of Conf file and Database Tables

        if (file_exists($_POST['skrupel_path'].'/inc.conf.php')) {
            require($_POST['skrupel_path'].'/inc.conf.php');
        }

        /*
         * Konfigurationsdatei schreiben
         */
        $file = 'inc/conf.php';
        $writeable = true;
        $successful = true;

        if (!is_writable($file)) {
            $writeable = false;
            echo '<p><span style="color: red">Datei '.$file.' nicht schreibbar!</span></p>';
            if (!chmod($file, 0777)) {
                echo '<p><span style="color: red">Keine Rechte f&uuml;r CHMOD!</span></p>';
                $writeable = false;
            } else {
                echo '<p><span style="color: lightgreen">Schreibrechte wurden erfolgreich ge&auml;ndert.</span></p>';
                $writeable = true;
            }
        }

        if (!$writeable) {
            echo '<p>Bitte geben Sie diesem Script Schreibrechte auf die Datei inc/conf.php und f&uuml;hren Sie die Installation anschlie&szlig;end erneut aus.</p>';
            $successful = false;
        } else {
            $fh = fopen($file, 'w');
            fwrite($fh, "<?php\n\n");
            fwrite($fh, "// Pfadangaben\n");
            fwrite($fh, "\$skrupel_path = '{$_POST['skrupel_path']}';\n\n");
            fwrite($fh, "// Tabellen-Namen\n");
            fwrite($fh, "\$skrupel_portal = '{$_POST['skrupel_portal']}';\n");
            fwrite($fh, "\$skrupel_portal_games = '{$_POST['skrupel_portal_games']}';\n");
            fwrite($fh, "\$skrupel_portal_linklist = '{$_POST['skrupel_portal_linklist']}';\n");
            fwrite($fh, "\$skrupel_portal_messages = '{$_POST['skrupel_portal_messages']}';\n\n");
            fwrite($fh, "// Administrator\n");
            fwrite($fh, "define('ADMIN', '$admin_login');\n\n\n");
            fwrite($fh, "include 'inc/_db.php';\n");
            fwrite($fh, "require_once 'inc/settings.php';\n");
            fclose($fh);
            echo '<p><span style="color: lightgreen">Konfigurationsdatei erfolgreich geschrieben.</span></p>';

            /*
             * Tabellen einfuegen
             */
            require_once $_POST['skrupel_path'].'/inc.conf.php';
            require_once $_POST['skrupel_path'].'/inhalt/inc.hilfsfunktionen.php';
            require_once 'inc/functions_db.php';

            $conn = open_db();

            // Quick and dirty input string SQL escaping
            $_POST = array_map('db_escape', $_POST);

            if ($_POST['version'] == 0) {
                // Neuinstallation

                $sql = "CREATE TABLE IF NOT EXISTS `{$_POST['skrupel_portal_games']}` (
                   `id` int(11) NOT NULL auto_increment,
                   `spiel_name` varchar(50) NOT NULL default '',
                   `siegbedingungen` tinyint(1) unsigned NOT NULL default '0',
                   `zielinfo_1` varchar(10) NOT NULL default '',
                   `zielinfo_2` varchar(10) NOT NULL default '',
                   `zielinfo_3` varchar(10) NOT NULL default '',
                   `zielinfo_4` varchar(10) NOT NULL default '',
                   `zielinfo_5` varchar(10) NOT NULL default '',
                   `out` tinyint(1) unsigned NOT NULL default '0',
                   `user_1` int(11) NOT NULL default '0',
                   `user_2` int(11) NOT NULL default '0',
                   `user_3` int(11) NOT NULL default '0',
                   `user_4` int(11) NOT NULL default '0',
                   `user_5` int(11) NOT NULL default '0',
                   `user_6` int(11) NOT NULL default '0',
                   `user_7` int(11) NOT NULL default '0',
                   `user_8` int(11) NOT NULL default '0',
                   `user_9` int(11) NOT NULL default '0',
                   `user_10` int(11) NOT NULL default '0',
                   `rasse_1` varchar(255) NOT NULL default '',
                   `rasse_2` varchar(255) NOT NULL default '',
                   `rasse_3` varchar(255) NOT NULL default '',
                   `rasse_4` varchar(255) NOT NULL default '',
                   `rasse_5` varchar(255) NOT NULL default '',
                   `rasse_6` varchar(255) NOT NULL default '',
                   `rasse_7` varchar(255) NOT NULL default '',
                   `rasse_8` varchar(255) NOT NULL default '',
                   `rasse_9` varchar(255) NOT NULL default '',
                   `rasse_10` varchar(255) NOT NULL default '',
                   `spieler_admin` int(11) NOT NULL default '0',
                   `startposition` tinyint(1) unsigned NOT NULL default '0',
                   `imperiumgroesse` tinyint(1) unsigned NOT NULL default '0',
                   `geldmittel` int(11) NOT NULL default '0',
                   `mineralienhome` tinyint(1) unsigned NOT NULL default '0',
                   `sternendichte` int(11) NOT NULL default '0',
                   `mineralien` tinyint(1) unsigned NOT NULL default '0',
                   `spezien` int(11) NOT NULL default '0',
                   `max` tinyint(3) unsigned NOT NULL default '0',
                   `wahr` tinyint(3) unsigned NOT NULL default '0',
                   `lang` tinyint(3) unsigned NOT NULL default '0',
                   `instabil` tinyint(3) unsigned NOT NULL default '0',
                   `stabil` tinyint(3) unsigned NOT NULL default '0',
                   `leminvorkommen` tinyint(1) unsigned NOT NULL default '0',
                   `umfang` int(11) NOT NULL default '0',
                   `struktur` varchar(255) NOT NULL default '',
                   `modul_0` tinyint(1) unsigned NOT NULL default '0',
                   `modul_2` tinyint(1) unsigned NOT NULL default '0',
                   `modul_3` tinyint(1) unsigned NOT NULL default '0',
                   `modul_4` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
                   `team1` int(11) NOT NULL default '0',
                   `team2` int(11) NOT NULL default '0',
                   `team3` int(11) NOT NULL default '0',
                   `team4` int(11) NOT NULL default '0',
                   `team5` int(11) NOT NULL default '0',
                   `team6` int(11) NOT NULL default '0',
                   `team7` int(11) NOT NULL default '0',
                   `team8` int(11) NOT NULL default '0',
                   `team9` int(11) NOT NULL default '0',
                   `team10` int(11) NOT NULL default '0',
                   `nebel` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_mitte` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_aussen` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_min` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_max` tinyint(3) unsigned NOT NULL default '0',
                   `playable` int(11) NOT NULL default '0',
                   `user_1_x` int(10) unsigned,
                   `user_1_y` int(10) unsigned,
                   `user_2_x` int(10) unsigned,
                   `user_2_y` int(10) unsigned,
                   `user_3_x` int(10) unsigned,
                   `user_3_y` int(10) unsigned,
                   `user_4_x` int(10) unsigned,
                   `user_4_y` int(10) unsigned,
                   `user_5_x` int(10) unsigned,
                   `user_5_y` int(10) unsigned,
                   `user_6_x` int(10) unsigned,
                   `user_6_y` int(10) unsigned,
                   `user_7_x` int(10) unsigned,
                   `user_7_y` int(10) unsigned,
                   `user_8_x` int(10) unsigned,
                   `user_8_y` int(10) unsigned,
                   `user_9_x` int(10) unsigned,
                   `user_9_y` int(10) unsigned,
                   `user_10_x` int(10) unsigned,
                   `user_10_y` int(10) unsigned,
                   PRIMARY KEY  (`id`)
                 ) ENGINE=MyISAM AUTO_INCREMENT=1 ";
                mysql_query($sql, $conn);
            }

            if (2 < $_POST['version']) {
                // Neuinstallation, Tiramon-Portal

                $sql = "CREATE TABLE IF NOT EXISTS `{$_POST['skrupel_portal_linklist']}` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `title` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  `views` char(10) NOT NULL default '0',
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ";
                mysql_query($sql, $conn);

                $sql = "INSERT INTO `{$_POST['skrupel_portal_linklist']}` (`title`, `url`, `views`, `description`) VALUES
('Skrupel.de', 'http://www.skrupel.de', '7', 'Die offizielle Skrupel-Seite.')";
                mysql_query($sql, $conn);

                $sql = "CREATE TABLE IF NOT EXISTS `{$_POST['skrupel_portal_messages']}` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `absender` int(11) NOT NULL default '0',
  `empfaenger` int(11) NOT NULL default '0',
  `title` text NOT NULL,
  `text` longtext NOT NULL,
  `time` TIMESTAMP NOT NULL default '0',
  `status` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ";
                mysql_query($sql, $conn);

                $sql = "INSERT INTO `{$_POST['skrupel_portal_messages']}` (`absender`, `empfaenger`, `title`, `text`, `time`, `status`) VALUES
(0, 0, 'Willkommen im Portal!', 'Viel Spaß mit dem neuen Portal!', '".time()."', 0) ";
                mysql_query($sql, $conn);

                $sql = "ALTER TABLE `$skrupel_user` ADD `portal_layout` CHAR(20) NOT NULL default 'classic' ";
                mysql_query($sql, $conn);
            }

            if ($_POST['version'] < 3) {
                // Neuinstallation, Tiramon-Portal, SpacePirates-Portal v1.0

                $sql = "ALTER TABLE `$skrupel_user` ADD `homepage` TINYTEXT DEFAULT NULL";
                mysql_query($sql, $conn);
            }

            $sql = "CREATE TABLE IF NOT EXISTS `{$_POST['skrupel_portal']}` (
  `id` int(11) NOT NULL auto_increment,
  `version` varchar(10) NOT NULL default '2.0.2',
  `servername` text,
  `seitentitel` text NOT NULL,
  `template` char(20) NOT NULL default 'classic',
  `keywords` longtext NOT NULL,
  `description` longtext NOT NULL,
  `encoding` varchar(20) NOT NULL default 'iso-8859-1',
  `cookie_dauer` char(75) NOT NULL default '7',
  `cookie_dauer_2` char(20) NOT NULL default '86400',
  `news_limit` char(5) NOT NULL,
  `impressum_vorname` tinytext,
  `impressum_nachname` tinytext,
  `impressum_strasse` tinytext,
  `impressum_hausnummer` char(5) default NULL,
  `impressum_postleitzahl` varchar(15) default NULL,
  `impressum_ortsname` tinytext,
  `impressum_email` tinytext,
  `impressum_settings` char(2) NOT NULL default '10',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `version` (`version`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
            mysql_query($sql, $conn);

            $sql = "INSERT INTO `{$_POST['skrupel_portal']}` (`version`, `servername`, `seitentitel`, `template`, `keywords`, `description`, `encoding`, `cookie_dauer`, `cookie_dauer_2`, `news_limit`, `impressum_settings`) VALUES
('2.0.2', 'Skrupel-Server', 'Willkommen im Portal', 'classic', 'browsergame, skrupel, portal', 'Das Portal zum Game.', 'iso-8859-1', '7', '86400', '3', '10') ";
            mysql_query($sql, $conn);

            $sql = "ALTER TABLE `$skrupel_user` ADD `portal_bann` varchar(1) NOT NULL default '0'";
            mysql_query($sql, $conn);

            $sql = "ALTER TABLE `$skrupel_user` ADD `portal_activity` char(20) NOT NULL default '0'";
            mysql_query($sql, $conn);

            if (!db_column_exists('profil_text', $skrupel_user, $conn)) {
                $sql = "ALTER TABLE `$skrupel_user` ADD `profil_text` LONGTEXT DEFAULT NULL";
                mysql_query($sql, $conn);
            }

            if (!$error = mysql_error()) {
                echo '<p><span style="color: lightgreen">Datenbank-Tabellen erfolgreich erstellt.</span></p>';
            } else {
                echo '<p><span style="color: red">Konnte Datenbank-Tabellen nicht erstellen.<br>('.$error.')</span></p>';
                $successful = false;
            }
        }

        if ($successful) {
?>
<p style="color: lightgreen; font-size: 1.5em;"><strong>Installation erfolgreich!</strong></p>
<p style="color: #ddd;"><strong>Bitte l&ouml;schen sie nun die install.php aus ihrem Portal-Ordner,<br>damit niemand mehr im Nachhhinein ihre Konfiguration ver&auml;ndern kann<br />und dadurch evtl. ihre Spiele sch&auml;digt.</strong></p>
<p id="buttons"><button onClick="location.href='index.php'; return false;">Zum Portal</button></p>
<?php
        } else {
?>
<p style="color: red; font-size: 1.5em;"><strong>Installation fehlgeschlagen!</strong></p>
<p id="buttons"><button onClick="location.href='<?= $_SERVER['PHP_SELF'] ?>'; return false;">Installation erneut starten</button></p>
<?php
        }
    }
?>
    </div>
</body>
</html>
