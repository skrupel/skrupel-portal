<?php
include "inc/conf.php";
include "inc/initial.php";
include "styles/design.php";
require ($skrupel_path."inc.conf.php");
$page_name="Optionen";

if (!$_SESSION["user_id"])
{ header('Location: index.php'); }

if ($_GET["fu"]!=1 && $_GET["fu"]!=2)
{ $_GET["fu"]=1; }

$file=$skrupel_path."lang/de/lang.meta_optionen.php";
include ($skrupel_path."lang/sprachen.php");
include ($file);

$user_id=$_SESSION["user_id"];

if ($_GET["fu"]==1) {
    $zeiger = @mysql_query("SELECT sprache, optionen, email, icq, jabber, avatar, chatfarbe, homepage, portal_layout, `profil-text` FROM $skrupel_user where id='$user_id'");
echo mysql_error();
    $array = @mysql_fetch_array($zeiger);
    $id=$_SESSION["user_id"];
    $spieler_sprache = $array["sprache"];
    if(!$spieler_sprache){$spieler_sprache=$language;}
    $spieler_avatar = $array["avatar"];
    $spieler_email = $array["email"];
    $spieler_icq = $array["icq"];
    $spieler_optionen = $array["optionen"];
    $spieler_chatfarbe = $array["chatfarbe"];
    $spieler_portal_layout = $array["portal_layout"];
    $spieler_homepage = $array["homepage"];
    $spieler_profil = $array["profil-text"];
require_once ("inc/_header.php");
    ?>
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td>
                        <center><h1>Optionen</h1></center>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td valign="top">
                                        <table border="0" cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td colspan="2"><?php echo $lang['metaoptionen']['datenpersoenlich']?></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td><td><form name="formular"  method="post" action="meta_optionen.php?fu=2"></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $lang['metaoptionen']['sprache']?></td>
                                                <td><select name="sprache" style="width:200px;">
                                                    <?php
                                                    $i=0;
                                                    $sprachnummer=0;///Standard Deutsch falls alle Stricke reissen
                                                    while($sprach_daten[0][$i]){
                                                        if ($spieler_sprache==$sprach_daten[0][$i]){
                                                            $sprachnummer=$i;
                                                        }
                                                        $i++;
                                                    }
                                                    $i=0;
                                                    while($sprach_daten[0][$i]){
                                                        ?>
                                                        <option value="<?php echo $sprach_daten[0][$i]; ?>" <?php if ($i==$sprachnummer) { echo 'selected'; } ?>><?php echo ($sprach_daten[1][$sprachnummer][$i])?$sprach_daten[1][$sprachnummer][$i]:$lang['metaoptionen']['keinedaten']?></option>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $lang['metaoptionen']['chatfarbe']; ?></td>
                                                <td><select name="chatfarbe" style="width:200px; background-color:#<?php echo $spieler_chatfarbe; ?>; background-image:none;" onChange="this.style.backgroundColor='#'+this.value; return true;">
                                                    <?php
                                                    $stufe=64;
                                                    for($i1=0;$i1<=256;$i1+=$stufe){
                                                        for($i2=0;$i2<=256;$i2+=$stufe){
                                                            for($i3=0;$i3<=256;$i3+=$stufe){
                                                                $j=(65536*(($i1>0)?$i1-1:0))+(256*(($i2>0)?$i2-1:0))+(($i3>0)?$i3-1:0);
                                                                for($b=0;$b<6;$b++){
                                                                    $k=$j%16;
                                                                    if($k<10){
                                                                        $farbe[5-$b]="$k";
                                                                    }elseif($k==10){
                                                                        $farbe[5-$b]="a";
                                                                    }elseif($k==11){
                                                                        $farbe[5-$b]="b";
                                                                    }elseif($k==12){
                                                                        $farbe[5-$b]="c";
                                                                    }elseif($k==13){
                                                                        $farbe[5-$b]="d";
                                                                    }elseif($k==14){
                                                                        $farbe[5-$b]="e";
                                                                    }elseif($k==15){
                                                                        $farbe[5-$b]="f";
                                                                    }
                                                                    $j=($j-$k)/16;
                                                                }
                                                                $farbe_echt='';
                                                                for($b=0;$b<6;$b++){
                                                                    $farbe_echt.=$farbe[$b];
                                                                }
                                                                ?>
                                                                <option value="<?php echo $farbe_echt; ?>" style="background-color:#<?php echo $farbe_echt; ?>;" <?php if ($farbe_echt==$spieler_chatfarbe) { echo 'selected'; } ?>></option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $lang['metaoptionen']['email']; ?>&nbsp;</td>
                                                <td><input type="text" class="eingabe" style="width:200px;" maxlength="255" name="email" value="<?php echo $spieler_email; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $lang['metaoptionen']['icq']; ?>&nbsp;</td>
                                                <td><input type="text" class="eingabe" style="width:200px;" maxlength="20" name="icq" value="<?php echo $spieler_icq; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $lang['metaoptionen']['jabber']; ?>&nbsp;</td>
                                                <td><input type="text" class="eingabe" style="width:200px;" maxlength="255" name="jabber" value="<?php echo $spieler_jabber; ?>"></td>
                                            </tr>          
                                            <tr>
                                                <td><?php echo $lang['metaoptionen']['avatar']; ?>&nbsp;</td>
                                                <td><input type="text" class="eingabe" style="width:200px;" maxlength="255" name="avatar" value="<?php echo $spieler_avatar; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $lang['metaoptionen']['homepage']; ?>&nbsp;</td>
                                                <td><input type="text" class="eingabe" style="width:200px;" maxlength="255" name="homepage" value="<?php echo $spieler_homepage; ?>"></td>
                                            </tr>
                                        </table>
                                        <table border="0" cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?php echo $lang['metaoptionen']['allgemein']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="email_nach" <?php if(@intval(substr($spieler_optionen,0,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['emailnachricht']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="icq_nach" <?php if(@intval(substr($spieler_optionen,1,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['messenger']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?php echo $lang['metaoptionen']['features']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="feature_i" <?php if(@intval(substr($spieler_optionen,11,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['cursor']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="feature_ii" <?php if(@intval(substr($spieler_optionen,12,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['tooltips']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="feature_iii" <?php if(@intval(substr($spieler_optionen,13,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['schieberegler']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="feature_iiii" <?php if(@intval(substr($spieler_optionen,15,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['animationen']; ?></td>
                                            </tr>    
                                            <tr>
                                                <td><input type="checkbox" value="1" name="feature_iiiii" <?php if(@intval(substr($spieler_optionen,16,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['png']; ?></td>
                                            </tr>  
                                            <tr>
                                                <td><input type="checkbox" value="1" name="feature_iiiiii" <?php if(@intval(substr($spieler_optionen,17,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['scroll']; ?></td>
                                            </tr> 
                                        </table>
                                    </td>
                                    <td><img border="0" src="<?php echo $skrupel_path; ?>bilder/empty.gif" width="17" height="1"></td>
                                    <td valign="top">
                                        <table border="0" cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td colspan="2"><?php echo $lang['metaoptionen']['tooltipss']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="tool_kol" <?php if(@intval(substr($spieler_optionen,2,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['kolonisten']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="tool_min" <?php if(@intval(substr($spieler_optionen,3,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['cantoxvorraete']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="tool_vorrat" <?php if(@intval(substr($spieler_optionen,4,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['mineralien']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="tool_cantox" <?php if(@intval(substr($spieler_optionen,5,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['minenundfabriken']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="tool_logbuch" <?php if(@intval(substr($spieler_optionen,6,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['logbuch']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?php echo $lang['metaoptionen']['tooltipsschiffe']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="tool_schiff_tank" <?php if (@intval(substr($spieler_optionen,7,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['schaden']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="tool_schiff_fracht" <?php if (@intval(substr($spieler_optionen,8,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['spezialmission']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="tool_schiff_spezial" <?php if (@intval(substr($spieler_optionen,9,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['fracht']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="tool_schiff_bild" <?php if(@intval(substr($spieler_optionen,14,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['bild']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" value="1" name="tool_schiff_logbuch" <?php if (@intval(substr($spieler_optionen,10,1))==1) { echo "checked"; } ?>></td>
                                                <td>&nbsp;<?php echo $lang['metaoptionen']['logbuchschiff']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                        </table>
                                        <table border="0" cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td colspan="2"><?php echo $lang['metaoptionen']['passwort']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td><td></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $lang['metaoptionen']['neuespasswort']; ?>&nbsp;</td>
                                                <td><input type="password" class="eingabe" style="width:165px;" maxlength="30" name="passwortneu" value=""></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
		<tr><td colspan="2"><strong>Portaleinstellungen&nbsp;</strong></td></tr>
		<tr><td>Layout&nbsp;</td><td><select name="portal_layout">
	<?php for ($zaehler=0; $zaehler<count($design); $zaehler++){?>
		<option value="<?php echo $design[$zaehler]["path"]; ?>" <?php if($design[$zaehler]["path"]==$spieler_portal_layout){ echo "selected"; }?> ><?php echo $design[$zaehler]["name"]; ?></option>
	<?php } ?>
		</select></td></tr>
			<tr><td colspan="2">Profil-Text<?php if (file_exists($skrupel_path."extend/bbc/bbc.php")) { ?> (BBCodes erlaubt)<?php } ?></td></tr>
			<tr><td colspan="2"><textarea name="profil-text"><?php echo $spieler_profil; ?></textarea></td></tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </center>
                        <br>
                        <center><input type="submit" value="<?php echo $lang['metaoptionen']['aenderungenspeichern']; ?>"></center>
                    </td>
                </tr>
            </table>
        </center></form>
        </div>
        <?php
}
if ($_GET["fu"]==2) {
        $email=$_POST["email"];
        $icq=$_POST["icq"];
        $jabber=$_POST["jabber"];
        $avatar=$_POST["avatar"];
        $chatfarbe=$_POST["chatfarbe"];
        $passwortneu=$_POST["passwortneu"];
        $optionen="";
        $homepage=$_POST["homepage"];
        $layout=$_POST["portal_layout"];
        $profil_text=$_POST["profil-text"];
    
        if ($_POST["email_nach"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["icq_nach"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["tool_kol"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["tool_min"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["tool_vorrat"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["tool_cantox"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["tool_logbuch"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["tool_schiff_tank"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["tool_schiff_fracht"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["tool_schiff_spezial"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["tool_schiff_logbuch"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["feature_i"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["feature_ii"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["feature_iii"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["tool_schiff_bild"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["feature_iiii"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["feature_iiiii"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        if ($_POST["feature_iiiiii"]==1) { $optionen=$optionen.'1'; } else { $optionen=$optionen.'0'; }
        
        $zeiger_temp = @mysql_query("UPDATE $skrupel_user set jabber='$jabber', email='$email', icq='$icq', optionen='$optionen', chatfarbe='$chatfarbe', avatar='$avatar', homepage='$homepage', portal_layout='$layout', `profil-text`='$profil_text', sprache='".$_POST["sprache"]."' WHERE id='$user_id'");

$_SESSION["layout"] = $layout;
setcookie("layout", $layout, time()+$cookie_dauer);
$_SESSION["mail"] = $email;
setcookie("mail", $email, time()+$cookie_dauer);
    
        if (strlen($passwortneu)>=1) {
    
            $zeiger_temp = @mysql_query("UPDATE $skrupel_user set passwort='$passwortneu' where id='$user_id'");
    
        }
    
require_once ("inc/_header.php");
?>
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
            <center>
                <table border="0" cellspacing="0" cellpadding="0" height="100%">
                    <tr>
                        <td>
                            <center><?php echo $lang['metaoptionen']['wurdengespeichert']?><br><br>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><form name="formular"  method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1" onSubmit="location.href='<?php echo $_SERVER["PHP_SELF"]; ?>?fu=1'; return false;"></td>
                                        <td><input type="submit" name="bla" value="<?php echo $lang['metaoptionen']['zurueck']; ?>" style="width:120px;"></td>
                                        <td></form></td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                    </tr>
                </table>
            </center>
        </div>
        <?php
}
require_once ("inc/_footer.php");
?>
