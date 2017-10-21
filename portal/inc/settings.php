<?php
require_once 'inc/_db.php';

$sql = mysql_query("SELECT * FROM $skrupel_portal LIMIT 1");
while ($row = mysql_fetch_object($sql)) {
    $portal_version = $row->version;
    $servername = $row->servername;
    $seitentitel = $row->seitentitel;
    $template = $row->template;
    $keywords = $row->keywords;
    $description = $row->description;
    $encoding = $row->encoding;
    $cookie_dauer_1 = $row->cookie_dauer;
    $cookie_dauer_2 = $row->cookie_dauer_2;
    $cookie_dauer = $cookie_dauer_1 * $cookie_dauer_2;
    $news_limit = $row->news_limit;

    $impressum_vorname = $row->impressum_vorname;
    $impressum_nachname = $row->impressum_nachname;
    $impressum_strasse = $row->impressum_strasse;
    $impressum_hausnummer = $row->impressum_hausnummer;
    $impressum_postleitzahl = $row->impressum_postleitzahl;
    $impressum_ortsname = $row->impressum_ortsname;
    $impressum_email = $row->impressum_email;
    $impressum_settings = $row->impressum_settings;
    $impressum_settings_haftung = substr($impressum_settings, 0, 1);
    $impressum_settings_facebook = substr($impressum_settings, 1, 2);
}

if (!isset($impressum_email) || empty($impressum_email) || $impressum_email == '') {
    $impressum_email = $absenderemail;
}
