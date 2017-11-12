<?php
include 'inc/initial.php';

$user_name = $_SESSION['name'];
unset($_SESSION['user_id']);
unset($_SESSION['name']);
unset($_SESSION['pass']);
unset($_SESSION);

setcookie('user', '', time() - 60 * 60);
setcookie('password', '', time() - 60 * 60);

if ($user_name && $user_name != '' && !isset($_SESSION['user_id'])) {
    $zeiger = mysql_query("INSERT INTO $skrupel_chat (datum, text, von, farbe) VALUES (".time().", '$user_name hat sich ausgeloggt.', 'System', '000000')");
}

header('Location: index.php');
