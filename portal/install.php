<?php
  session_start();
  $skrupel_path = "../";
?><html>
  <head>
<title>Skrupel-Portal - Installation</title>
    <link rel="stylesheet" type="text/css" href="styles/classic/css/style.css">
  </head>
  <body style="background-color: black;">
  <div id="portal_center">
<?php
  $supported_versions = array("0.974", "0.975");
if (! isset($_GET["step"]))
{ ?>
<br /><h1 style="text-align:center">Portal-Installation</h1>
<form action="install.php?step=tables" method="post">
<h2 style="text-align:center">Von Portal-Version updaten</h2>
<table align="center">
<tr><td><input type="radio" name="version" value="0" checked /></td><td>Neu installieren</td></tr>
<tr><td><input type="radio" name="version" value="1" /></td><td>Tiramon-Portal V0.5</td></tr>
<tr><td><input type="radio" name="version" value="2" /></td><td>SpacePirates-Portal V1.0</td></tr>
<tr><td><input type="radio" name="version" value="3" /></td><td>SpacePirates-Portal V1.0 + Patch</td></tr>
<tr><td colspan="2"><input type="submit" value="Weiter" /></td></tr>
</table></form>
<?php
} else if ($_GET["step"] == "tables")
  {
    //Enter Configuration Data
?><br /><h1 style="text-align:center">Portal-Installation</h1>
  <form action="install.php?step=1" method="post">
<input type="hidden" name="version" value="<?php echo $_POST["version"]; ?>" />
  <table align="center">
    <tr>
      <td>Pfad zu Skrupel</td>
      <td><input type="text" name="skrupel_path" value="../" style="width: 200px;" /></td>
    </tr>
<tr><td>Name der Tabelle f&uuml;r Portal-Einstellungen</td><td><input name="skrupel_portal" value="skrupel_portal" style="width:200px;" /></td></tr>
    <tr>
      <td>Name der Tabelle f&uuml;r wartende Spiele</td>
      <td><input type="text" name="skrupel_portal_games" value="skrupel_portal_games" style="width: 200px;" /></td>
    </tr>
<tr><td>Name der Tabelle f&uuml;r die Linkliste</td><td><input name="skrupel_portal_linklist" value="skrupel_portal_linklist" style="width:200px;" /></td></tr>
<tr><td>Name der Tabelle f&uuml;r PN's</td><td><input name="skrupel_portal_messages" value="skrupel_portal_messages" style="width:200px;" /></td></tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" value="Weiter" /><input type="reset" onClick="location.href='<?php echo $_SERVER["PHP_SELF"]; ?>'; return false;" value="Zur&uuml;ck" /></td>
    </tr>
  </table>
  </form>
<?php
  }
  else if ($_GET["step"] == 1)
  {
    //Check entered Configuration Data
    $ok = true;
    echo "<br><center>";
    if ( $_POST["skrupel_path"] == "" || $_POST["skrupel_path"] == "./" || $_POST["skrupel_path"] == "." )
    {
      echo "<font color=\"red\">Skrupel und das Portal sollten sich nicht im selben Ordner befinden.</font<br>";
    }
    if ( is_file($_POST["skrupel_path"]."inc.conf.php") )
    {
      echo "<font color=\"green\">Skrupel Konfigurationsdatei gefunden</font><br>";
      $conf_found = true;
    }
    else
    {
      echo "<font color=\"red\">Skrupel Konfigurationsdatei nicht gefunden</font><br>";
      $ok = false;
    }
    if ( is_dir($_POST["skrupel_path"]."admin") )
      echo "<font color=\"green\">Skrupel Admin-Ordner gefunden</font><br>";
    else
    {
      echo "<font color=\"red\">Skrupel Admin-Ordner nicht gefunden</font><br>";
      $ok = false;
    }
    if ( is_dir($_POST["skrupel_path"]."bilder") && is_file($_POST["skrupel_path"]."bilder/logo_login.gif") )
      echo "<font color=\"green\">Skrupel Bilder-Ordner gefunden</font><br>";
    else
    {
      echo "<font color=\"red\">Skrupel Bilder-Ordner nicht gefunden</font><br>";
      $ok = false;
    }

    if ( $conf_found )
    { 
      require $_POST["skrupel_path"]."inc.conf.php";
      if ( mysql_connect("$server","$login","$password") )
      {
        echo "<font color=\"green\">Verbindung zum Datenbank Server erfolgreich getestet</font><br>";
        if ( mysql_select_db($database) )
        {
          echo "<font color=\"green\">Datenbank erfolgreich ausgew&auml;hlt</font><br>";
          $query = mysql_query("SELECT version FROM `$skrupel_info`");
          if ( $data = mysql_fetch_assoc($query) )
          {
            if ( in_array($data["version"],$supported_versions ) )
              echo "<font color=\"green\">Skrupel Version {$data["version"]} wird unterst&uuml;tzt</font><br>";
            else
            {
              echo "<font color=\"red\">Skrupel Version nicht unterst&uuml;tzt (installiert: {$data["version"]} unterst&uuml;tzt: ".implode(", ", $supported_versions).")</font><br>";
              $ok = false;
            }
          }
        }
        else
        {
          echo "<font color=\"red\">Konnte angegebene Datenbank nicht ausw&auml;hlen</font><br>";
          $ok = false;
        }
      }
      else
      {
        echo "<font color=\"red\">Konnte nicht auf angegebenen Datenbank Server verbinden</font><br>";
        $ok = false;
      }
    }
    $file = "inc/conf.php";
    touch( $file );
    if ( is_writable($file) )
    {
       echo "<font color=\"green\">Schreibrechte f&uuml;r $file existieren</font><br>";    
    }
    else
    {      
      if (! chmod($file, 0777) )
      {
        echo "<font color=\"red\">Schreibrechte f&uuml;r $file sind nicht vorhanden</font><br>";
        echo "<font color=\"red\">Keine Rechte f&uuml;r chmod</font><br>";
        $ok = false;
      }
      else
      {        
        echo "<font color=\"green\">Schreibrechte wurde erfolgreich ge&auml;ndert</font><br>";        
        echo "<font color=\"green\">Schreibrechte f&uuml;r $file existieren</font><br>"; 
      }
    }

?><br />
  <form name="formular" action="install.php?step=install" method="post">
    <input type="hidden" name="version" value="<?php echo $_POST["version"]; ?>" />
    <input type="hidden" name="skrupel_path" value="<?php echo $_POST["skrupel_path"]; ?>" />
    <input type="hidden" name="skrupel_portal" value="<?php echo $_POST["skrupel_portal"]; ?>" />    
    <input type="hidden" name="skrupel_portal_games" value="<?php echo $_POST["skrupel_portal_games"]; ?>" />
    <input type="hidden" name="skrupel_portal_linklist" value="<?php echo $_POST["skrupel_portal_linklist"]; ?>" /> 
    <input type="hidden" name="skrupel_portal_linklist" value="<?php echo $_POST["skrupel_portal_linklist"]; ?>" /> 
    <input type="hidden" name="skrupel_portal_messages" value="<?php echo $_POST["skrupel_portal_messages"]; ?>" /> 
    <input type="submit" value="Installieren" /><input type="reset" value="Zur&uuml;ck" onClick="history.back(1); return false;" />
  </form>

  </center>
<?php
  }
  else if ( $_GET["step"] == "install" )
  {
    //Loader Screen while Installation is running
?>
  <br>
  <center><img src="<?php echo $_POST["skrupel_path"]; ?>bilder/rad.gif" alt="Eingabe wird verarbeitet"><br>
  Installation l&auml;uft.<br>
  Bitte warten</center>
  <form id="formular" action="install.php?step=doinstall" method="post">
    <input type="hidden" name="version" value="<?php echo $_POST["version"]; ?>" />
    <input type="hidden" name="skrupel_path" value="<?php echo $_POST["skrupel_path"]; ?>" />
    <input type="hidden" name="skrupel_portal" value="<?php echo $_POST["skrupel_portal"]; ?>" />    
    <input type="hidden" name="skrupel_portal_games" value="<?php echo $_POST["skrupel_portal_games"]; ?>" />
    <input type="hidden" name="skrupel_portal_linklist" value="<?php echo $_POST["skrupel_portal_linklist"]; ?>" /> 
    <input type="hidden" name="skrupel_portal_linklist" value="<?php echo $_POST["skrupel_portal_linklist"]; ?>" /> 
    <input type="hidden" name="skrupel_portal_messages" value="<?php echo $_POST["skrupel_portal_messages"]; ?>" /> 
  </form>
  <script type="text/javascript">
   window.setTimeout("document.getElementById('formular').submit()", 100 );
 </script>
<?php
  }
  else if ( $_GET["step"] == "doinstall" )
  {
    //Creation of Conf file and Database Tables

if (file_exists($_POST["skrupel_path"]."inc.conf.php"))
{ require ($_POST["skrupel_path"]."inc.conf.php"); }

    echo "<br><center>";
    /*
     * Konfigurationsdatei schreiben
     */
    $file = "inc/conf.php";
    $writeable = true;
    $successfull = true;
    if ( !is_writable($file) )
    {
      $writeable = false;
      echo "<font color=\"red\">Datei nicht schreibbar</font><br>";
      if (! chmod("inc/conf.php", 0777) )
      {
        echo "<font color=\"red\">Keine Rechte f&uuml;r CHMOD</font><br>";
        $writeable = false;
      }
      else
      {
        echo "<font color=\"green\">Schreibrechte wurden erfolgreich ge&auml;ndert</font><br>";
        $writeable = true;
      }
    }
    if ( !$writeable )
    {
      echo "Bitte geben Sie diesem Script Schreibrechte auf die Datei inc/conf.php und f&uuml;hren Sie die Installation anschlie&szlig;end erneut aus.<br />";   
      $successfull = false;
    }
    else
    {
      $conffile = fopen( "inc/conf.php","w" );
      fwrite( $conffile, "<?php\n\n");
      fwrite( $conffile, "// Pfadangaben\n" );
      fwrite( $conffile, "  \$skrupel_path = \"{$_POST["skrupel_path"]}\";\n\n" );
      fwrite( $conffile, "// Tabellen-Namen\n" );
      fwrite( $conffile, "  \$skrupel_portal = \"{$_POST["skrupel_portal"]}\";\n" );
      fwrite( $conffile, "  \$skrupel_portal_games = \"{$_POST["skrupel_portal_games"]}\";\n" );
      fwrite( $conffile, "  \$skrupel_portal_linklist = \"{$_POST["skrupel_portal_linklist"]}\";\n" );
      fwrite( $conffile, "  \$skrupel_portal_messages = \"{$_POST["skrupel_portal_messages"]}\";\n\n" );
      fwrite( $conffile, "// Administrator\n" );
      fwrite( $conffile, "  define( \"ADMIN\", ".$admin_login." );\n\n\n");
      fwrite( $conffile, "include \"inc/_db.php\";\n" );
      fwrite( $conffile, "require_once (\"inc/settings.php\");\n" );
      fwrite( $conffile, "?>" );
      fclose( $conffile );
      echo "<font color=\"green\">Konfigurationsdatei erfolgreich geschrieben.</font><br>";


      /*
       * Tabbelle einfuegen
       */
      require "inc/_db.php";
if ($_POST["version"]==0) {
      $sql="CREATE TABLE IF NOT EXISTS `".$_POST["skrupel_portal_games"]."` (
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
                 ) TYPE=MyISAM AUTO_INCREMENT=1 ";

      $query=mysql_query($sql); }

if ($_POST["version"]<2)
{ 
$sql="CREATE TABLE IF NOT EXISTS `".$_POST["skrupel_portal_linklist"]."` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `title` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  `views` char(10) NOT NULL default '0',
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ";
$query=mysql_query($sql);

$sql="INSERT INTO `".$_POST["skrupel_portal_linklist"]."` (`title`, `url`, `views`, `description`) VALUES
('Skrupel.de', 'http://www.skrupel.de', '7', 'Die offizielle Skrupel-Seite.')";
$query=mysql_query($sql);


$sql="CREATE TABLE IF NOT EXISTS `".$_POST["skrupel_portal_messages"]."` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `absender` int(11) NOT NULL default '0',
  `empfaenger` int(11) NOT NULL default '0',
  `title` text NOT NULL,
  `text` longtext NOT NULL,
  `time` varchar(50) NOT NULL default '0',
  `status` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ";
$query=mysql_query($sql);

$sql="INSERT INTO `".$_POST["skrupel_portal_messages"]."` (`absender`, `empfaenger`, `title`, `text`, `time`, `status`) VALUES
(0, 0, 'Willkommen im Portal!', 'Viel Spaß mit dem neuen Portal!', '".time()."', 0) ";
$query=mysql_query($sql);

$sql="ALTER TABLE `$skrupel_user` ADD `portal_layout` CHAR(15) NOT NULL default 'classic' ";
$query=mysql_query($sql);
}


if ($_POST["version"]<3)
{ $sql="ALTER TABLE `$skrupel_user` ADD `homepage` TINYTEXT NOT NULL ";
$query=mysql_query($sql); }



$sql="CREATE TABLE IF NOT EXISTS `".$_POST["skrupel_portal"]."` (
  `id` int(11) NOT NULL auto_increment,
  `version` varchar(10) NOT NULL default '2.0.2',
  `servername` text,
  `seitentitel` text NOT NULL,
  `template` varchar(50) NOT NULL default 'classic',
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ";
$query=mysql_query($sql);

$sql="INSERT INTO `".$_POST["skrupel_portal"]."` (`version`, `patch`, `servername`, `seitentitel`, `template`, `keywords`, `description`, `encoding`, `cookie_dauer`, `cookie_dauer_2`, `news_limit`, `impressum_settings`) VALUES
('2.0', '0', 'Skrupel-Server', 'Willkommen im Portal', 'classic', 'browsergame, skrupel, portal', 'Das Portal zum Game.', 'iso-8859-1', '7', '86400', '3', '10') ";
$query=mysql_query($sql);

$sql="ALTER TABLE `$skrupel_user` ADD `portal_bann` varchar(1) NOT NULL default '0' ";
$query=mysql_query($sql);

$sql="ALTER TABLE `$skrupel_user` ADD `portal_activity` char(20) NOT NULL default '0' ";
$query=mysql_query($sql);

$sql="ALTER TABLE `$skrupel_user` ADD `profil-text` longtext NOT NULL ";
$query=mysql_query($sql);

      if (!($error = mysql_error()))
        echo "<font color=\"green\">Datenbank-Tabellen erfolgreich erstellt.</font><br />";
      else
      {
        echo "<font color=\"red\">Konnte Datenbank-Tabellen nicht erstellen.<br />(".$error.")</font><br />";
        $successfull = false;
      }
    }
    if ( $_POST["skrupel_path"] != "" && $_POST["skrupel_path"] != "./" )
    {
      //echo system("rm -R bilder");
    }
    if ($successfull)
    {
      echo "<font color=\"green\" size=\"+1\"><b>Installation erfolgreich!</b></font><br>";
      echo "<b>Bitte l&ouml;schen sie nun die install.php aus ihrem Portal-Ordner,<br>damit niemand mehr im Nachhinein ihre Konfiguration ver&auml;ndern kann<br />und dadurch evtl. ihre Spiele sch&auml;digt.</b>";
    }
    else
      echo "<font color=\"red\" size=\"+1\"><b>Installation fehlgeschlagen!</b></font><br /><a href=\"".$_SERVER["PHP_SELF"]."\">Installation erneut starten</a>";
    echo "</center>";
  }
?>
</div>
</body>
</html>
