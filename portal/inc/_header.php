<?php
$mtime = explode(' ', microtime());
$time1 = $mtime[1] + $mtime[0];

require_once 'inc/initial.php';

$spiel_setting = array();
$zeiger = mysql_query("SELECT * FROM $skrupel_info");
while ($array = mysql_fetch_array($zeiger)) {
    $spiel_settings['chat'] = $array['chat'];
    $spiel_settings['forum'] = $array['forum'];
    $spiel_settings['forum_url'] = $array['forum_url'];
    $spiel_settings['anleitung'] = $array['anleitung'];
}

if (isset($_SESSION['user_id'])) {
    $empf_messages = 0;
    $empf_messages_new = 0;
    if ($_SESSION['name'] == ADMIN) {
        $zeiger = mysql_query("SELECT * FROM $skrupel_portal_messages WHERE empfaenger='".$_SESSION['user_id']."' OR empfaenger='0'");
    } else {
        $zeiger = mysql_query("SELECT * FROM $skrupel_portal_messages WHERE empfaenger='".$_SESSION['user_id']."'");
    }
    while ($array = mysql_fetch_array($zeiger)) {
        $empf_messages++;
        if ($array['status'] == 0) {
            $empf_messages_new++;
        }
    }

    $abs_messages = 0;
    $abs_messages_new = 0;
    $zeiger = mysql_query("SELECT * FROM $skrupel_portal_messages WHERE absender='".$_SESSION['user_id']."'");
    while ($array = mysql_fetch_array($zeiger)) {
        $abs_messages++;
        if ($array['status'] == 0) {
            $abs_messages_new++;
        }
    }
}

header('Content-Type: text/html; charset='.$encoding);
header('Cache-Control: store, cache, max-age=5');
header('Pragma: cache');
?>
<!DOCTYPE html>
<html dir="ltr">

<head profile="http://dublincore.org/documents/dcq-html/">
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $encoding; ?>" />
    <meta http-equiv="content-language" content="de" />
    <title><?php echo $servername; ?> - <?php echo $seitentitel; if (isset($page_name)) { echo ' - '.$page_name; } ?></title>
    <meta name="keywords" content="<?php echo $servername.', '.$keywords; ?>" />
    <meta name="description" content="<?php echo str_replace("\r\n", ' ', $description); ?>" />
    <meta name="author" content="Till Affeldt" />
    <meta name="license" content="GNU GPL" />
    <meta name="robots" content="index, follow" />
    <meta name="DC.title" content="<?php echo $servername; if (isset($page_name)) { echo ' - '.$page_name; }?>">
    <meta name="DC.publisher" content="Till Affeldt" />
    <meta name="DC.constributor" content="Till Affeldt" />
    <meta name="DC.constributor" content="Bernd Kantoks" />
    <meta name="DC.constributor" content="Tiramon" />
    <meta name="DC.subject" content="Kostenloses Weltraum-Browsergame." />
    <meta name="DC.type" content="InteractiveResource" scheme="DCTERMS.DCMIType" />
    <meta name="DC.type" content="Browsergame" />
    <meta name="DC.format" content="text/html" scheme="DCTERMS.IMT" />
    <meta name="DC.language" content="de" scheme="DCTERMS.RFC3066" />
    <meta name="DC.source" content="https://github.com/kantoks/skrupel" scheme="DCTERMS.URI" />
    <meta name="DC.relation" content="https://github.com/kantoks/skrupel" scheme="DCTERMS.URI" />
    <meta name="DC.rights" content="https://github.com/skrupel/skrupel-portal/blob/master/LICENSE.txt" scheme="DCTERMS.URI" />
    <meta name="DC.rights" content="http://www.space-pirates.zx9.de/portal/agb.php" scheme="DCTERMS.URI" />
    <meta name="DC.identifer" content="http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>" />

    <link rel="stylesheet" href="font/font.css" type="text/css" />
    <link rel="stylesheet" href="styles/<?php echo $_SESSION['layout']; ?>/css/style.css" type="text/css" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
    <script type="text/javascript" src="shadowbox/shadowbox.js"></script>
    <script type="text/javascript">
        Shadowbox.init({
            handleOversize: "drag"
        });
    </script>
<?php if (preg_match('#spiel_alpha.php#is', $_SERVER['PHP_SELF']) != 1): ?>
    <script type="text/javascript">
        if (top.location != self.location) {
            top.location.replace(self.location.href);
        }
    </script>
<?php endif; ?>
<?php if (preg_match('#messages.php#is', $_SERVER['PHP_SELF']) == 1 && $_GET['fu'] == 3): ?>
    <script language="JavaScript" type="application/javascript">
    // <![CDATA[
        var XMLHTTP = null;

        if (window.XMLHttpRequest) {
            XMLHTTP = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            try {
                XMLHTTP = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (ex) {
                try {
                    XMLHTTP = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (ex) {
                }
            }
        }

        function DatenAusgeben() {
            if (XMLHTTP.readyState == 4) {
                var d = document.getElementById("Daten");
                d.innerHTML = XMLHTTP.responseText;
            }
        }

        var bvar = null;
        function load(bvar) {
            XMLHTTP.open("POST", "autoverv.php", true);
            XMLHTTP.onreadystatechange = DatenAusgeben;
            XMLHTTP.setRequestHeader("Content-Type",
                "application/x-www-form-urlencoded");
            XMLHTTP.send("a=" + document.message.empf.value + "&b=" + bvar);
        }

        function sendText(e, text) {
            e.value = text;
        }
    // ]]>
    </script>

    <style type="text/css">
        .autolist {
            background-color: snow;
            border-color: silver;
            border-width: 1px;
            border-style: solid;
            color: black;
            cursor: pointer;
            z-index: 2;
        }
    </style>
<?php endif; ?>
</head>

<body>
    <div id="wrapper">
        <div id="masthead" style="cursor:default">
            <h2>Skrupel</h2><br />
            <h1 style="text-align:center"><?php echo $servername; ?></h1>
<?php if (!isset($_SESSION['user_id'])): ?>
            <form name="login-form" method="post" action="index.php" style="cursor:auto; position:absolute; z-index:12">
                <input type="hidden" name="return" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
                <input type="text" name="login" value="<?= isset($_COOKIE['login_name']) ? $_COOKIE['login_name'] : '' ?>" placeholder="Benutzername"><br />
                <input type="password" name="pass" value="" placeholder="Passwort">
                <input type="submit" name="submit" value="Login" /><br />
                <label><input type="checkbox" name="cookie" /> Eingeloggt bleiben</label>
            </form>
<?php endif; ?>
        </div>
        <div id="top_nav">
            <ul id="topmenu">
<?php if (!isset($_SESSION['user_id'])): ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Registration</a></li>
<?php else: ?>
                <li><a href="logout.php">Logout</a></li>
<?php endif; ?>
                <li><a href="news.php">Neuigkeiten</a></li>
                <li><a href="active.php">Aktive Spiele</a></li>
                <li><a href="stats.php">Statistik</a></li>
            </ul>
        </div>
        <div id="container">
            <div id="left_col">
<?php if (!isset($_SESSION['user_id'])): ?>
                <h3>Login</h3>
                <ul class="menu">
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Registration</a></li>
                    <!-- <a href="lost_pw.php">Passwort vergessen</a></li>-->
<?php endif; ?>
                </ul>
                <h3>Galaxien</h3>
                <ul class="menu">
<?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="spiel_alpha.php">Spiel erstellen</a></li>
<?php endif; ?>
                    <li><a href="active.php">Aktive Spiele</a></li>
                    <li><a href="waiting.php">Wartende Spiele</a></li>
                    <li><a href="finished.php">Beendete Spiele</a></li>
                </ul>
<?php if (isset($_SESSION['user_id'])): ?>
                <h3>Persoenliches</h3>
                <ul class="menu">
                    <li><a href="meta_optionen.php">Optionen</a></li>
                    <li><a href="status.php">Runden-&Uuml;bersicht</a></li>
                </ul>
                <h3>Nachrichten</h3>
                <ul class="menu">
                    <li><a href="messages.php"<?php if ($empf_messages_new > 0){?> style="color:red"<?php } ?>>Posteingang <?php echo '('.$empf_messages_new.'/'.$empf_messages.')'; ?></a></li>
                    <li><a href="messages.php?fu=5">Postausgang <?php echo '('.$abs_messages_new.'/'.$abs_messages.')'; ?></a></li>
                    <li><a href="messages.php?fu=3">Neue Nachricht</a></li>
                </ul>
<?php endif; ?>
                <h3>About</h3>
                <ul class="menu">
                    <li><a href="about.php">Server-Info</a></li>
                    <li><a href="features.php">Erweiterungen</a></li>
                    <li><a href="linklist.php">Unsere Partner</a></li>
                </ul>
            </div>
            <div id="right_col">
<?php if (isset($_SESSION['user_id']) && $_SESSION['name'] == ADMIN): ?>
                <h3>Administration</h3>
                <ul class="menu">
                    <li><a href="admin.php">&Uuml;bersicht</a></li>
                    <li><a href="admin_offenbarung.php">Offenbarung</a></li>
                    <li><a href="admin_feedback.php" target="_blank">Feedback</a></li>
                </ul>
<?php endif; ?>
                <h3>Community</h3>
                <ul class="menu">
                    <li><a href="news.php">Neuigkeiten</a>
                    <li><a href="stats.php">Nutzer-Statistik</a></li>
                    <li><a href="kontakt.php">Kontaktformular</a></li>
<?php if ($spiel_settings['forum'] == 0): ?>
                    <li><a href="board.php">Foren-&Uuml;bersicht</a></li>
<?php elseif ($spiel_settings['forum'] == 2): ?>
                    <li><a href="<?= $spiel_settings['forum_url']; ?>" target="_blank">Zum Forum</a></li>
<?php endif; ?>
<?php if ($spiel_settings['chat'] == 0): ?>
                    <li><a href="chat.php">Chatbereich</a></li>
<?php endif; ?>
                </ul>
                <h3>Spielfaktoren</h3>
                <ul class="menu">
                    <li><a href="meta_rassen.php">Rassen</a></li>
                    <li><a href="meta_spezien.php">dom. Spezies</a></li>
                    <li><a href="meta_pklassen.php">Planetenklassen</a></li>
                </ul>
                <h3>Spielvorschau</h3>
                <ul class="menu">
                    <li><a href="movie.php">Screenshots & Filme</a></li>
<?php if ($spiel_settings['anleitung'] == 0): ?>
                    <li><a href="http://www.skrupel.de/www/index.php/Spielanleitung" target="_blank">Spielanleitung</a>
<?php endif; ?>
                </ul>
            </div>
            <div id="page_content">
                <div id="details"></div>
