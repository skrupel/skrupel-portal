<?php
require_once 'inc/conf.php';
require_once $skrupel_path.'/inc.conf.php';
require_once 'inc/initial.php';

function sendUserPN($empf, $betreff, $index)
{
    global $skrupel_user;

    $sql = mysql_query("SELECT id FROM $skrupel_user WHERE nick='$empf' LIMIT 1");
    while ($data = mysql_fetch_array($sql)) {
        $empfaenger = $data['id'];
    }

    if (!isset($empfaenger) || empty($empfaenger)) {
        echo 'Fehler: Benutzer nicht gefunden.';

        return 0;
    } else {
        return sendPN($_SESSION['user_id'], $empfaenger, $betreff, $index);
    }
}

function sendPN($abs, $empf, $betreff, $index)
{
    global $skrupel_portal_messages;

    $index = str_replace("'", '"', $index);

    return @mysql_query("INSERT INTO $skrupel_portal_messages (absender,empfaenger,title,text,time) VALUES ($abs,$empf,'$betreff','$index','".time()."')");
}

function sendAnfrage($from, $thema, $inhalt)
{
    if (isset($_SESSION['user_id'])) {
        $abs = $_SESSION['user_id'];
        $from = $_SESSION['name'];
    } else {
        $abs = 0;
    }

    $betreff = 'Support-Ticket';
    if (isset($from) && $from != '') {
        $index = 'Eine neue Anfrage zum Thema '.$thema." wurde gesendet.\nSie stammt von ".$from." und hat folgenden Inhalt:\n\n".$inhalt;
    } else {
        $index = 'Eine neue Anfrage zum Thema '.$thema." wurde gesendet.\nKontaktdaten wurden nicht hinterlegt, aber sie hat folgenden Inhalt:\n\n".$inhalt;
    }

    return sendPN($abs, 0, $betreff, $index);
}

function sendMultiNews($inhalt)
{
    $from = 0;
    $content = $_SESSION['name']." hat eine neue Offenbarung verk�nden lassen:\n\n".$inhalt;
    $sql = mysql_query("SELECT id FROM $skrupel_user");
    while ($data = mysql_fetch_array($sql)) {
        $submit = sendPN($from, $data['id'], 'Neue Offenbarung', $content);
    }
}
