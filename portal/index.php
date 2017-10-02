<?php
  session_start();
  if ( !is_file("inc/conf.php") )
  {
    header("Location: install.php");
    die("Bitte Konfiguration &uuml;berpr&uuml;fen");
  }
  require_once "inc/conf.php";
/*  if ( is_file("install.php") )
  {
    die("Bitte erst die install.php l&ouml;schen");
  } */
  if ( !is_file($skrupel_path."inc.conf.php") ) 
  {
    header("Location: install.php");
    die("Bitte Konfiguration &uuml;berpr&uuml;fen");
  } 
  
  require_once $skrupel_path."inc.conf.php";
  require_once "inc/_db.php";
  
  if ($_POST["login"] && $_POST["pass"])
  {
    require_once "inc/_db.php";
    $sql   = "SELECT user.*, spiele.sid
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
              WHERE user.nick=\"{$_POST["login"]}\" 
                    AND user.passwort=\"{$_POST["pass"]}\" 
              GROUP BY user.id"; 
    $query = mysql_query($sql);
    if ( mysql_num_rows($query) == 1 )
    {
      $data = mysql_fetch_assoc($query);
if ($data["portal_bann"]!=1) {
      $_SESSION["user_id"] = $data["id"];
      $_SESSION["uid"]     = $data["uid"];
      $_SESSION["sid"]     = $data["sid"];
      $_SESSION["name"]    = $data["nick"]; 
      $_SESSION["pass"]    = $_POST["pass"];
      $_SESSION["mail"] = $data["email"];
      $_SESSION["layout"] = $data["portal_layout"];

setcookie("mail", $data["email"], time()+$cookie_dauer);
setcookie("login_name", $data["nick"], time()+$cookie_dauer);
setcookie("layout", $data["portal_layout"], time()+$cookie_dauer);

if ($_POST["cookie"]=="on" || $_POST["cookie"]=="true")
{ setcookie("user", $data["nick"], time()+$cookie_dauer);
setcookie("password", $_POST["pass"], time()+$cookie_dauer); }

$zeiger = mysql_query("INSERT INTO $skrupel_chat (datum,text,von,farbe) VALUES ('".time()."', '".$_POST["login"]." hat sich eingeloggt.', 'System', '000000')");
    }	else { $login_error="bann"; }
  }	else { $login_error="wrong_data"; }
}

  if (isset($_SESSION["user_id"]) && $_POST["return"] && file_exists($_POST["return"]))
{ header('Location:'.$_POST["return"]); exit; }
else if (isset($_SESSION["user_id"]) && $_SERVER["HTTP_REFERER"] && file_exists($_SERVER["HTTP_REFERER"]))
{ header('Location: '.$_SERVER["HTTP_REFERER"]); exit; }
else if (isset($_SESSION["user_id"]))
   { header('Location: active.php'); exit; }

  if (!$_SESSION["user_id"])
  { require "login.php"; }
 ?>
