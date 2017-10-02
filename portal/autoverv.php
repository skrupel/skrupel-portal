<?php
include "inc/conf.php";
include "inc/initial.php";

if($_POST['b'] == 'undefined') { 
    if (isset($_POST['a'])) {
        $suche = strip_tags($_POST['a']);
        if (!empty($suche)) {
            $abfrage = "SELECT nick, id FROM $skrupel_user WHERE nick LIKE '$suche%' ORDER BY nick desc LIMIT 10";
            $ergebnis = mysql_query($abfrage);
            while($row = mysql_fetch_object($ergebnis)) {
                echo '<div class="autolist" onClick="sendText(document.message.empf, \''.$row->nick.'\'); load(\'1\');">'.$row->nick.'</div>';
            }
        }
    }
}
?>
