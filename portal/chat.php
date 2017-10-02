<?php
  include "inc/conf.php";
  include "inc/initial.php";
    include ($skrupel_path."inc.conf.php");
if (file_exists($skrupel_path."extend/bbc/bbc.php"))
{ require ($skrupel_path."extend/bbc/bbc.php"); }
$file=$skrupel_path."lang/de/lang.kommunikation_ch.php";
include ($file);
$nutzer_id=$_SESSION["user_id"];

$page_name="Chatbereich";
 require_once ("inc/_header.php");

 if (isset($_POST["nachricht"]) && $_POST["nachricht"]!="" && isset($nutzer_id) && $nutzer_id!="" && $_GET["fu"]==2) {
    $zeiger = @mysql_query("SELECT chatfarbe From $skrupel_user where id='$nutzer_id' ");
    $array = @mysql_fetch_array($zeiger);
    $spieler_chatfarbe = $array["chatfarbe"];
    
if (!$_POST["an"])
{ $_POST["an"]=0; }
        $farbe=$spieler_chatfarbe;
        $nachricht=$_POST["nachricht"];
        $zeiger = @mysql_query("INSERT INTO $skrupel_chat (datum,text,an,von,farbe) VALUES ('".time()."','$nachricht','".$_POST["an"]."','".$_SESSION["name"]."','$farbe');");
} 

$zeiger = @mysql_query("SELECT chatfarbe FROM $skrupel_user where id='$nutzer_id'");
    $array = @mysql_fetch_array($zeiger);
    $spieler_chatfarbe = $array["chatfarbe"];

    $aktuell=time();
    $aktuell=$aktuell-86400;

    $zeiger = @mysql_query("DELETE FROM $skrupel_chat WHERE datum<$aktuell");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_chat where an='0' OR an='$nutzer_id' OR von='".$_SESSION["name"]."' ORDER BY datum DESC ");
    $chatanzahl = @mysql_num_rows($zeiger);

    if ($chatanzahl>=1) {

        for ($i=$chatanzahl-1; $i>=0;$i--) {
            $ok = @mysql_data_seek($zeiger,$i);

            $array = @mysql_fetch_array($zeiger);
if (file_exists($skrupel_path."extend/bbc/bbc.php"))
           { $textn=bbc($array["text"]); }
else { $textn=$array["text"]; }

            $von=$array["von"];
            $vonfarbe=$array["farbe"];
            $an=$array["an"];
            $datum=$array["datum"];

            $jetzt=date("d.m.o - H:i:s",$datum);

            if ($an==$nutzer_id) {
                $textn="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td valign=\"top\" style=\"color:".$vonfarbe."; white-space:nowrap; font-weight:bold\">[".$von."] ".$lang['kommunikationch']['fluestert']."&nbsp;</td><td valign=\"top\"><nobr>@ ".$jetzt."&nbsp;</nobr></td><td valign=\"top\">$textn</td></tr></table>";
            } else {
                $textn="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td valign=\"top\" style=\"color:".$vonfarbe."; white-space:nowrap; font-weight:bold\">[".$von."]&nbsp;</td><td valign=\"top\">@ ".$jetzt."&nbsp;</td><td valign=\"top\">$textn</td></tr></table>";
            }
            $neutext=$neutext.$textn;
        }
    }
?>
	<div><h1>Chatbereich</h1><hr /></div>
            <div  style="width:90%; height:100pt"><div style="width:100%; height:100%; overflow:auto"><?php echo $neutext; ?></div></div>
	<div><hr /></div>
<?php if ($nutzer_id){?>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="3"><img src="<?php echo $skrupel_path; ?>bilder/empty.gif" border="0" width="1" height="9"></td>
                    <td><form name="formular" method="post" action="chat.php?fu=2"></td>
                    <td><input type="hidden" name="neu" value="1"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td></td>
                                <td>
                                    <select name="an" style="width:150px;">
                                        <option value="0"><?php echo str_replace('{1}',$lang['kommunikationch']['alle'],$lang['kommunikationch']['an'])?></option>
                                        <?php
                                        $zeiger = @mysql_query("SELECT * FROM $skrupel_user ORDER BY nick");
                                        $user_anzahl = @mysql_num_rows($zeiger);
                                        for  ($i=0; $i<$user_anzahl;$i++) {
                                            $ok = @mysql_data_seek($zeiger,$i);
                                            $array = @mysql_fetch_array($zeiger);
                                            $a_nick=$array["nick"];
                                            $a_user_id=$array["id"];
                                            $a_spielerchatfarbe=$array["chatfarbe"];
			if (preg_match("#Computer #", $a_nick)!=1){
                                            ?>
                                            <option value="<?php echo $a_user_id; ?>" style="color:#<?php echo $a_spielerchatfarbe?>;" <?php if($_POST["an"]==$a_user_id) echo "selected";?> ><?php echo str_replace('{1}',$a_nick,$lang['kommunikationch']['an']); ?></option>
                                            <?php
                                        } }
                                        ?>
                                    </select>
                                </td>
                                <td><center><input type="text" name="nachricht" maxlength="1000" style="width:275px;" autocomplete="off" /></center></td>
                            </tr>
                        </table>
                    </td>
                            
                </tr>
                <tr>
                    <td colspan="3"><img src="<?php echo $skrupel_path; ?>bilder/empty.gif" border="0" width="1" height="7" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><center><input type="submit" name="subben" value="<?php echo $lang['kommunikationch']['aktualisieren']; ?>" style="width:425px;" /></center></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"><img src="<?php echo $skrupel_path; ?>bilder/empty.gif" border="0" width="1" height="7" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td></form></td></tr></table>

<?php
} else {?>
Sie sind nicht eingeloggt und k&ouml;nnen daher keinen Eintrag verfassen.
<?php 
} require_once ("inc/_footer.php");
?>
