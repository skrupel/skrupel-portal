<?php 
include "inc/conf.php";
include "inc/initial.php";
require ($skrupel_path."inc.conf.php");
require ($skrupel_path."lang/de/lang.admin.allgemein_gamma.php");

if (!$_SESSION["user_id"] || $_SESSION["name"]!=ADMIN)
{ header('Location: index.php'); exit; }

$erweiterung[0]['name']='Movie-GIF';
$erweiterung[0]['ordner']='moviegif';
$erweiterung[0]['autor']='Skrupel.de';
$erweiterung[0]['activate']=1;
$erweiterung[0]['activatepos']=0;

$erweiterung[1]['name']='RSS';
$erweiterung[1]['ordner']='rss';
$erweiterung[1]['autor']='JANNiS und bansa.de';
$erweiterung[1]['activate']=0;
$erweiterung[1]['activatepos']=0;

$erweiterung[2]['name']='KI';
$erweiterung[2]['ordner']='ki';
$erweiterung[2]['autor']='Wasserleiche';
$erweiterung[2]['activate']=1;
$erweiterung[2]['activatepos']=1;

$erweiterung[3]['name']='XStats';
$erweiterung[3]['ordner']='xstats';
$erweiterung[3]['autor']='Stefan Heller';
$erweiterung[3]['activate']=1;
$erweiterung[3]['activatepos']=2;

$erweiterung[4]['name']='BBC-Interpreter';
$erweiterung[4]['ordner']='bbc';
$erweiterung[4]['autor']='Space-Pirates.zx9.de';
$erweiterung[4]['activate']=0;
$erweiterung[4]['activatepos']=0;

if ($_GET["fu"]!=1 && $_GET["fu"]!=2)
{ $_GET["fu"]=1; }

$page_name="Erweiterungen verwalten";
require_once ("inc/_header.php");

if ($_GET["fu"]==1) {
        $zeiger = @mysql_query("SELECT extend FROM $skrupel_info");
        $array = @mysql_fetch_array($zeiger);
        $spiel_extend=$array["extend"];
        ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><h1><?php echo $lang['admin']['allgemein']['gamma']['erweiterung']?></h1></td>
                    </tr>
                </table>
            </center>
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td><?php echo $lang['admin']['allgemein']['gamma']['name']?></td>
                    <td><center><?php echo $lang['admin']['allgemein']['gamma']['ordner']?></center></td>
                    <td><center><nobr><?php echo $lang['admin']['allgemein']['gamma']['autor']?></nobr></center></td>
                    <td><?php echo $lang['admin']['allgemein']['gamma']['beschreibung']?></td>
                    <td><img src="../bilder/empty.gif" height="22" width="1"></td>
                </tr>
                <?php foreach($erweiterung as $ext) { ?>
                    <tr>
                        <td valign="top"><nobr> <?php echo $ext['name']; ?></nobr></td>
                        <td valign="top"> <?php echo $ext['ordner']; ?></td>
                        <td valign="top"><nobr> <?php echo $ext['autor']; ?></nobr></td>
<?php if (isset($ext["beschreibung"]) && $ext["beschreibung"]!="") { ?>
                        <td valign="top"><a href="#<?php echo $ext['name']; ?>" rel="shadowbox">Anzeigen</a><div style="display:none" id="<?php echo $ext['name']; ?>"><?php echo $ext['beschreibung']; ?></div></td>
<?php } else { ?>
	<td>&nbsp;</td>
<?php } ?>
                        <td valign="top"><nobr> <?php
                            if (@file_exists($skrupel_path.'extend/'.$ext['ordner'])) {
                                if ($ext['activate']==1) {
                                    if (@intval(substr($spiel_extend,$ext['activatepos'],1))==1) {
                                        echo $lang['admin']['allgemein']['gamma']['aktiviert']; 
                                        ?>
                                            <br><br><form name="formular" method="post" action="admin_extend.php?fu=2&pos=<?php echo $ext['activatepos']; ?>&value=0"><input type='submit' value='<?php echo $lang['admin']['allgemein']['gamma']['deaktivieren']?>' class='button'></form>
                                        <?php
                                    } else {
                                        echo $lang['admin']['allgemein']['gamma']['n_aktiviert'];
                                        ?>
                                            <br><br><form name="formular" method="post" action="admin_extend.php?fu=2&pos=<?php echo $ext['activatepos']; ?>&value=1"><input type='submit' value='<?php echo $lang['admin']['allgemein']['gamma']['aktivieren']?>' class='button'></form>
                                        <?php
                                    }
                                } else {  echo $lang['admin']['allgemein']['gamma']['vorhanden'];  }
                            } else { echo $lang['admin']['allgemein']['gamma']['n_vorhanden']; }
                            ?>
                        </nobr></td>
                    </tr>
                <?php } ?>
            </table>
            <?php
}

if ($_GET["fu"]==2) {
        $value=$_GET["value"];
        $pos=$_GET["pos"];
        $zeiger = @mysql_query("SELECT extend FROM $skrupel_info");
        $array = @mysql_fetch_array($zeiger);
        $spiel_extend=$array["extend"];
          
        $extend='';
          
        for ($n=0;$n<50;$n++) {
            
            if ($pos==$n) {
        
                if ($value=='1') {
                    $extend.='1';
                } else {
                    $extend.='0';
                }
            } else {

                if (@intval(substr($spiel_extend,$n,1))==1) {
                    $extend.='1';
                } else {
                    $extend.='0';
                }
            }
        }

        $zeiger = @mysql_query("update $skrupel_info set extend='$extend'");
        ?>
            <center>
                <table border="0" height="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <?php echo $lang['admin']['allgemein']['gamma']['aktualisiert']?>
                            <br><br><br>
                            <center>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><form name="formular"  method="post" action="admin_extend.php?fu=1"></td>
                                        <td><input type="submit" name="bla" value="<?php echo $lang['admin']['allgemein']['gamma']['zurueck']?>"></td>
                                        <td></form></td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                    </tr>
                </table>
            </center>
    <?php 
}
require_once ("inc/_footer.php");
?>
