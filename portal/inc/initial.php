<?php
require_once 'inc/conf.php';
require_once $skrupel_path.'/inc.conf.php';
require_once $skrupel_path.'/inhalt/inc.hilfsfunktionen.php';

require_once 'inc/_db.php';
require_once 'inc/settings.php';

session_start();

if (!isset($_SESSION['layout'])) {
    if (isset($_COOKIE['layout'])) {
        $_SESSION['layout'] = $_COOKIE['layout'];
    } elseif (isset($template)) {
        $_SESSION['layout'] = $template;
        setcookie('layout', $template, time() + $cookie_dauer);
    } else {
        $_SESSION['layout'] = 'classic';
        setcookie('layout', 'classic', time() + $cookie_dauer);
    }
}

if (!file_exists('styles/'.$_SESSION['layout'].'/css/style.css')) {
    if (isset($template) && file_exists('styles/'.$template.'/css/style.css')) {
        $_SESSION['layout'] = $template;
    } else {
        require 'styles/design.php';
        $_SESSION['layout'] = $design[0]['path'];
    }
}

if (isset($_SESSION['user_id'])) {
    $sql = "SELECT user.uid, spiele.sid FROM $skrupel_user AS user LEFT JOIN $skrupel_spiele AS spiele ON phase = 0 AND (user.id = spieler_1 OR user.id = spieler_2 OR user.id = spieler_3 OR user.id = spieler_4 OR user.id = spieler_5 OR user.id = spieler_6 OR user.id = spieler_7 OR user.id = spieler_8 OR user.id = spieler_9 OR user.id = spieler_10) WHERE user.id=\"{$_SESSION['user_id']}\" GROUP BY user.id";
    $query = mysql_query($sql);
    if (mysql_num_rows($query) == 1) {
        $data = mysql_fetch_assoc($query);
        $_SESSION['uid'] = $data['uid'];
        $_SESSION['sid'] = $data['sid'];
        $update = mysql_query("UPDATE $skrupel_user SET portal_activity='".time()."' WHERE id='".$_SESSION['user_id']."' ");
    }
} elseif ($_COOKIE['user'] && $_COOKIE['password']) {
    $_POST['login'] = $_COOKIE['user'];
    $_POST['pass'] = $_COOKIE['password'];
    $_POST['return'] = $_SERVER['REQUEST_URI'];
    include '../index.php';
    exit;
}
