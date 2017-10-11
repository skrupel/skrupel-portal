<?php
if (!is_file('inc/conf.php')) {
    header('Location: install.php');
    die('Bitte Konfiguration &uuml;berpr&uuml;fen!');
}
require_once 'inc/conf.php';

if (!is_file($skrupel_path.'/inc.conf.php')) {
    header('Location: install.php');
    die('Bitte Konfiguration &uuml;berpr&uuml;fen');
}
require_once $skrupel_path.'/inc.conf.php';

session_start();
require_once 'inc/_db.php';

if ($_POST['login'] && $_POST['pass']) {
    $sql = "SELECT user.*, spiele.sid
              FROM $skrupel_user AS user 
              LEFT JOIN $skrupel_spiele AS spiele 
              ON phase = 0 
                 AND (user.id = spieler_1 
                      OR user.id = spieler_2 
                      OR user.id = spieler_3 
                      OR user.id = spieler_4 
                      OR user.id = spieler_5 
                      OR user.id = spieler_6 
                      OR user.id = spieler_7 
                      OR user.id = spieler_8 
                      OR user.id = spieler_9 
                      OR user.id = spieler_10) 
              WHERE user.nick=\"{$_POST['login']}\" 
              GROUP BY user.id";
    $query = mysql_query($sql);

    $login_error = '';

    if (mysql_num_rows($query) == 1) {
        $data = mysql_fetch_assoc($query);

        $passwort_crypt = cryptPasswd($_POST['pass'], $data['salt']);
        list($passwort, $salt) = explode(':', $passwort_crypt);

        if (strcmp($passwort, $data['passwort']) !== 0) {
            $login_error = 'wrong_data';
        } elseif ($data['portal_bann'] == 1) {
            $login_error = 'bann';
        }
    } else {
        $login_error = 'wrong_data';
    }

    if ($login_error == '') {
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['uid'] = $data['uid'];
        $_SESSION['sid'] = $data['sid'];
        $_SESSION['name'] = $data['nick'];
        //$_SESSION["pass"] = $_POST["pass"];
        $_SESSION['mail'] = $data['email'];
        $_SESSION['layout'] = $data['portal_layout'];

        setcookie('mail', $data['email'], time() + $cookie_dauer);
        setcookie('login_name', $data['nick'], time() + $cookie_dauer);
        setcookie('layout', $data['portal_layout'], time() + $cookie_dauer);

        if ($_POST['cookie'] == 'on' || $_POST['cookie'] == 'true') {
            setcookie('user', $data['nick'], time() + $cookie_dauer);
            //setcookie('password', $_POST['pass'], time() + $cookie_dauer);
        }

        $zeiger = mysql_query("INSERT INTO $skrupel_chat (datum,text,von,farbe) VALUES ('".time()."', '".$_POST['login']." hat sich eingeloggt.', 'System', '000000')");
    }
}

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    if ($_POST['return'] && file_exists($_POST['return'])) {
        header('Location: '.$_POST['return']);
        exit;
    } else {
        if ($_SERVER['HTTP_REFERER'] && file_exists($_SERVER['HTTP_REFERER'])) {
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header('Location: active.php');
            exit;
        }
    }
} else {
    require 'login.php';
}
