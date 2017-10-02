<?php
require_once 'inc/initial.php';
require_once $skrupel_path . '/inc.conf.php';
require_once $skrupel_path . '/inhalt/inc.hilfsfunktionen.php';

//@mysql_close();

if (!$conn = open_db()) {
    //header("Location: error.php?id=db&msg=" . mysql_error($conn));
    header("Location: error.php");
}
