<?php
require 'inc/initial.php';

function fixforutf($string)
{
//  $string = htmlentities($string);
    $string = utf8_encode($string);

    return $string;
}

// leicht abgewandelte Original Skrupel Datei aus inhalt/

require $skrupel_path.'/lang/de/lang.meta_rassen.php';

if ($_GET['fu'] == 1 || !$_GET['fu']) {
    $page_name = 'Rassen';
    require_once 'inc/_header.php';
?>
    <h1>Rassen</h1>
    <div style="text-align: center;">
    <?php
    $verzeichnis = "{$skrupel_path}/daten/";

    $handle = opendir($verzeichnis);

    while ($file = readdir($handle)) {
        if ((substr($file, 0, 1) != '.') and (substr($file, 0, 7) != 'bilder_') and (substr($file, strlen($file) - 4, 4) != '.txt')) {
            if ($file == 'unknown' || $file == 'CVS') {
                continue;
            }
            $a = $verzeichnis.$file.'/daten.txt';
            $name = file($a);
?>
            <a href="?fu=2&rasse=<?php echo $file; ?>" rel="shadowbox['meta'];title=Rasseninfo - <?php echo $name[0]; ?>;width=850;height=600" border="0">
                <img src="<?php echo $skrupel_path; ?>daten/<?php echo $file; ?>/bilder_allgemein/menu.png" border="0" width="186" height="75" alt="<?php echo $name[0]; ?>">
            </a>&nbsp;
<?php
        }
    }
    closedir($handle);
?>
    </div>
<?php
    require_once 'inc/_footer.php';
} elseif ($_GET['fu'] == 2) {
    $rasse = $_GET['rasse'];

    $fp = fopen($skrupel_path.'/daten/'.$rasse.'/schiffe.txt', 'r');
    if ($fp) {
        $zaehler = 0;
        while (!feof($fp)) {
            $buffer = @fgets($fp, 4096);
            $schiff[$zaehler] = $buffer;
            $zaehler++;
        }
        @fclose($fp);
    }

    $fp = @fopen($skrupel_path.'/daten/'.$rasse.'/daten.txt', 'r');
    if ($fp) {
        $zaehler2 = 0;
        while (!feof($fp)) {
            $buffer = @fgets($fp, 4096);
            $daten[$zaehler2] = $buffer;
            $zaehler2++;
        }
        @fclose($fp);
    }

    $copyright = $daten[1];
    $attribute = explode(':', $daten[2]);
    $attribute2 = explode(':', $daten[4]);

    $beschreibung = '';
    $file = $skrupel_path.'/daten/'.$rasse.'/beschreibung_'.$language.'.txt';

    if (!file_exists($file)) {
        $file = $skrupel_path.'/daten/'.$rasse.'/beschreibung.txt';
    }

    $fp = @fopen($file, 'r');
    if ($fp) {
        while (!feof($fp)) {
            $buffer = @fgets($fp, 4096);
            $beschreibung = $beschreibung.$buffer;
        }
        @fclose($fp);
    }

    $fp = @fopen($skrupel_path.'/daten/dom_spezien_art.txt', 'r');
    if ($fp) {
        while (!feof($fp)) {
            $buffer = @fgets($fp, 4096);
            $art_b = explode(':', $buffer);
            $art[$art_b[0]] = $art_b[1];
        }
        @fclose($fp);
    }

    if ($attribute2[0] >= 1) {
        $assrasse = $art[(int) $attribute2[1]];
        if ($attribute2[1] == 0) {
            $assrasse = 'alle';
        }
    } else {
        $assrasse = 'keine';
    }
    $assgrad = $attribute2[0];

    $topic_image = false;
    $topic_image_path = "{$skrupel_path}/daten/{$rasse}/bilder_allgemein";
    foreach (array('topic.png', 'topic.gif') as $file) {
        if (file_exists($file = "$topic_image_path/$file")) {
            $topic_image = $file;
            break;
        }
    }

    $bild1 = $skrupel_path.'/daten/'.$rasse.'/bilder_basen/1.jpg';
    $bild2 = $skrupel_path.'/daten/'.$rasse.'/bilder_basen/2.jpg';
    $bild3 = $skrupel_path.'/daten/'.$rasse.'/bilder_basen/3.jpg';
    $bild4 = $skrupel_path.'/daten/'.$rasse.'/bilder_basen/4.jpg';

    if ($attribute[6] == 1) {
        $klassename = 'M';
    } elseif ($attribute[6] == 2) {
        $klassename = 'N';
    } elseif ($attribute[6] == 3) {
        $klassename = 'J';
    } elseif ($attribute[6] == 4) {
        $klassename = 'L';
    } elseif ($attribute[6] == 5) {
        $klassename = 'G';
    } elseif ($attribute[6] == 6) {
        $klassename = 'I';
    } elseif ($attribute[6] == 7) {
        $klassename = 'C';
    } elseif ($attribute[6] == 8) {
        $klassename = 'K';
    } elseif ($attribute[6] == 9) {
        $klassename = 'F';
    } else {
        $klassename = false;
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $servername; ?> - Rasseninfo</title>
    <link rel="stylesheet" href="font/font.css"/>
    <link rel="stylesheet" href="styles/<?= $_SESSION['layout'] ?>/css/style.css"/>
    <style type="text/css">
        body {
            margin: 12px;
        }
    </style>
</head>
<body>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td colspan="3"><img src="<?php echo $skrupel_path; ?>/bilder/empty.gif" border="0" width="1" height="10"></td>
        </tr>
        <tr>
            <td valign="top" width="100%">
<?php if ($topic_image): ?>
                <center><img src="<?php echo $topic_image; ?>" border="0" height="135"></center>
<?php endif; ?>
                <p style="text-align: center"><strong><?php echo $daten[0]; ?></strong></p>

                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="1" height="20"></td>
                    </tr>
                    <tr>
                        <td width="100%" style="color:#ccc;" valign="top"><?php echo fixforutf($beschreibung); ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="1" height="30"></td>
                    </tr>
<?php if (strlen($copyright) >= 5): ?>
                    <tr>
                        <td>
                            <center><i><?php echo $copyright; ?></i></center>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="1" height="30"></td>
                    </tr>
<?php endif; ?>
                </table>
            </td>
            <td align="right"><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="20" height="20"></td>
            <td align="right">
                <table border="0" cellspacing="0" cellpadding="0">
<?php if (file_exists($bild1)): ?>
                    <tr>
                        <td><img src="<?php echo $bild1; ?>" border="0" width="150" height="100"></td>
                    </tr>
<?php endif; ?>
<?php if (file_exists($bild2)): ?>
                    <tr>
                        <td><img src="<?php echo $bild2; ?>" border="0" width="150" height="100"></td>
                    </tr>
<?php endif; ?>
<?php if (file_exists($bild3)): ?>
                    <tr>
                        <td><img src="<?php echo $bild3; ?>" border="0" width="150" height="100"></td>
                    </tr>
<?php endif; ?>
<?php if (file_exists($bild4)): ?>
                    <tr>
                        <td><img src="<?php echo $bild4; ?>" border="0" width="150" height="100"></td>
                    </tr>
<?php endif; ?>
                </table>
            </td>
        </tr>
    </table>

<?php if ($klassename): ?>
    <center>
        <table border="0" cellspacing="0" cellpadding="3">
            <td style="color:#ccc;"><?php echo $lang['metarassen']['planetenklasse']; ?></td>
            <td><?php echo $klassename; ?></td>
            <td><img border="0" src="<?= $skrupel_path ?>/bilder/karte/planeten/<?php echo $attribute[6]; ?>.gif" width="10" height="10"></td>
        </table>
    </center><br>
<?php endif; ?>

    <center>
        <table border="0" cellspacing="0" cellpadding="3">
            <tr>
                <td style="color:#ccc;"><?php echo $lang['metarassen']['temperatur']; ?></td>
                <td><?php echo $attribute[0] >= 1 ? ($attribute[0] - 35).' Grad' : 'keine'; ?></td>
                <td style="color:#ccc;"><?php echo $lang['metarassen']['minenproduktion']; ?></td>
                <td><?php echo $attribute[2] * 100; ?> %</td>
                <td style="color:#ccc;"><?php echo $lang['metarassen']['bodenkampfangriff']; ?></td>
                <td><?php echo $attribute[3] * 100; ?> %</td>
                <td style="color:#ccc;"><?php echo $lang['metarassen']['assimilation']; ?></td>
                <td><?php echo fixforutf($assrasse); ?></td>
            </tr>
            <tr>
                <td style="color:#ccc;"><?php echo $lang['metarassen']['steuereinahmen']; ?></td>
                <td><?php echo $attribute[1] * 100; ?> %</td>
                <td style="color:#ccc;"><?php echo $lang['metarassen']['fabrikproduktion']; ?></td>
                <td><?php echo $attribute[5] * 100; ?> %</td>
                <td style="color:#ccc;"><?php echo $lang['metarassen']['bodenkampfverteidigung']; ?></td>
                <td><?php echo $attribute[4] * 100; ?> %</td>
                <td style="color:#ccc;"><?php echo $lang['metarassen']['aeffizienz']; ?></td>
                <td><?php echo $assgrad; ?> %</td>
            </tr>
        </table>
    </center>
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="20"><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="1" height="30"></td>
        </tr>
<?php
    for ($i = 0; $i < $zaehler; $i++) {
        $schiffwert = explode(':', $schiff[$i]);
        $fertigkeiten = trim($schiffwert[17]);
        $spezial = '';

        $cybern = @intval(substr($fertigkeiten, 48, 2));

        $subpartikel = @intval(substr($fertigkeiten, 0, 2));
        $terra_warm = @intval(substr($fertigkeiten, 5, 1));
        $terra_kalt = @intval(substr($fertigkeiten, 6, 1));
        $quark = @intval(substr($fertigkeiten, 7, 4));
        $sprungtriebwerk = @intval(substr($fertigkeiten, 11, 11));
        $tarnfeldgen = @intval(substr($fertigkeiten, 22, 1));
        $subraumver = @intval(substr($fertigkeiten, 23, 1));
        $scannerfert = @intval(substr($fertigkeiten, 24, 1));
        $sprungtorbau = @intval(substr($fertigkeiten, 25, 12));
        $fluchtmanoever = @intval(substr($fertigkeiten, 38, 2));
        $signaturmaske = @intval(substr($fertigkeiten, 40, 1));
        $viralmin = @intval(substr($fertigkeiten, 41, 2));
        $viralmax = @intval(substr($fertigkeiten, 43, 3));
        $erwtrans = @intval(substr($fertigkeiten, 46, 2));
        $cybern = @intval(substr($fertigkeiten, 48, 2));
        $destabil = @intval(substr($fertigkeiten, 50, 2));
        $overdrive_min = @intval(substr($fertigkeiten, 53, 1));
        $overdrive_max = @intval(substr($fertigkeiten, 54, 1));
        $luckyshot = @intval(substr($fertigkeiten, 55, 1));
        $orbitalschild = @intval(substr($fertigkeiten, 56, 1));
        $infanterie = @intval(substr($fertigkeiten, 57, 1));
        $hmatrix = @intval(substr($fertigkeiten, 58, 1));
        $fuehrung = @intval(substr($fertigkeiten, 59, 1));
        $fert_reperatur = @intval(substr($fertigkeiten, 37, 1));
        $strukturtaster = @intval(substr($fertigkeiten, 52, 1));

        $fert_quark_vorrat = @intval(substr($fertigkeiten, 7, 1)) * 113;
        $fert_quark_min1 = @intval(substr($fertigkeiten, 8, 1)) * 113;
        $fert_quark_min2 = @intval(substr($fertigkeiten, 9, 1)) * 113;
        $fert_quark_min3 = @intval(substr($fertigkeiten, 10, 1)) * 113;

        $fert_sub_vorrat = @intval(substr($fertigkeiten, 0, 2));
        $fert_sub_min1 = @intval(substr($fertigkeiten, 2, 1));
        $fert_sub_min2 = @intval(substr($fertigkeiten, 3, 1));
        $fert_sub_min3 = @intval(substr($fertigkeiten, 4, 1));

        $fert_sprungtorbau_min1 = @intval(substr($fertigkeiten, 25, 3));
        $fert_sprungtorbau_min2 = @intval(substr($fertigkeiten, 28, 3));
        $fert_sprungtorbau_min3 = @intval(substr($fertigkeiten, 31, 3));
        $fert_sprungtorbau_lemin = @intval(substr($fertigkeiten, 34, 3));

        $fert_sprung_kosten = @intval(substr($fertigkeiten, 11, 3));
        $fert_sprung_min = @intval(substr($fertigkeiten, 14, 4));
        $fert_sprung_max = @intval(substr($fertigkeiten, 18, 4));

        if ($cybern >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $wert = $cybern * 220;
            $textneu = str_replace(array('{1}'), array($wert), $lang['metarassen']['cybernrittnikk']);
            $spezial .= $textneu;
        }
        if ($destabil >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $textneu = str_replace(array('{1}'), array($destabil), $lang['metarassen']['destabilisator']);
            $spezial .= $textneu;
        }
        if ($erwtrans >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $textneu = str_replace(array('{1}'), array($erwtrans), $lang['metarassen']['erweitertertransporter']);
            $spezial .= $textneu;
        }
        if ($hmatrix == 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $spezial .= $lang['metarassen']['hmatrix'];
        }
        if ($infanterie == 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $spezial .= $lang['metarassen']['infanterie'];
        }
        if ($fuehrung == 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $spezial .= $lang['metarassen']['fuehrung'];
        }
        if ($fluchtmanoever >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            if ($fluchtmanoever == 1) {
                $spezial .= $lang['metarassen']['lloydsfluchtmanoever'][0];
            } else {
                $textneu = str_replace(array('{1}'), array($fluchtmanoever), $lang['metarassen']['lloydsfluchtmanoever'][1]);
                $spezial .= $textneu;
            }
        }
        if ($luckyshot >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $textneu = str_replace(array('{1}'), array($luckyshot), $lang['metarassen']['luckyshot']);
            $spezial .= $textneu;
        }
        if ($orbitalschild == 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $spezial .= $lang['metarassen']['orbitalschild'];
        }
        if (($overdrive_min >= 1) or ($overdrive_max >= 1)) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $wert1 = $overdrive_min * 10;
            $wert2 = $overdrive_max * 10;
            $textneu = str_replace(array('{1}', '{2}'), array($wert1, $wert2), $lang['metarassen']['overdrive']);
            $spezial .= $textneu;
        }
        if ($quark >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $textneu = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($fert_quark_vorrat, $fert_quark_min1, $fert_quark_min2, $fert_quark_min3), $lang['metarassen']['quarkreorganisator']);
            $spezial .= $textneu;
        }
        if ($fert_reperatur >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $textneu = str_replace(array('{1}'), array($fert_reperatur), $lang['metarassen']['reperaturunterstuetzung']);
            $spezial .= $textneu;
        }
        if ($scannerfert >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }

            if ($scannerfert == 1) {
                $spezial .= $lang['metarassen']['scanner'][0];
            } else {
                $spezial .= $lang['metarassen']['scanner'][1];
            }
        }
        if ($signaturmaske == 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $spezial .= $lang['metarassen']['signaturmaskierung'];
        }
        if ($sprungtorbau >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $textneu = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($fert_sprungtorbau_min1, $fert_sprungtorbau_min2, $fert_sprungtorbau_min3, $fert_sprungtorbau_lemin), $lang['metarassen']['sprungtorbau']);
            $spezial .= $textneu;
        }
        if ($sprungtriebwerk >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $textneu = str_replace(array('{1}', '{2}', '{3}'), array($fert_sprung_kosten, $fert_sprung_min, $fert_sprung_max), $lang['metarassen']['sprungtriebwerk']);
            $spezial .= $textneu;
        }
        if ($strukturtaster == 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $spezial .= $lang['metarassen']['strukturtaster'];
        }
        if ($subpartikel >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $textneu = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($fert_sub_vorrat, $fert_sub_min1, $fert_sub_min2, $fert_sub_min3), $lang['metarassen']['subpartikelcluster']);
            $spezial .= $textneu;
        }
        if ($subraumver >= 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $textneu = str_replace(array('{1}'), array($subraumver), $lang['metarassen']['subraumverzerrer']);
            $spezial .= $textneu;
        }
        if ($tarnfeldgen == 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $spezial .= $lang['metarassen']['tarnfeldgenerator'];
        }
        if ($terra_warm == 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $spezial .= $lang['metarassen']['terraformer'][0];
        }
        if ($terra_kalt == 1) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $spezial .= $lang['metarassen']['terraformer'][1];
        }
        if (($viralmin >= 1) or ($viralmax >= 1)) {
            if (strlen($spezial) >= 1) {
                $spezial .= '<br>';
            }
            $textneu = str_replace(array('{1}', '{2}'), array($viralmin, $viralmax), $lang['metarassen']['viralerangriff']);
            $spezial .= $textneu;
        }
?>
        <tr>
            <td colspan="20">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="font-size:15px;"><?php echo fixforutf($schiffwert[0]); ?></td>
                        <td style="color:#ccc;" valign="bottom">&nbsp;(Techlevel <?php echo $schiffwert[2]; ?>)</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="20"><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="1" height="10"></td>
        </tr>
        <tr>
            <td rowspan="4" bgcolor="#000000"><img src="<?php echo $skrupel_path; ?>/daten/<?php echo $rasse; ?>/bilder_schiffe/<?php echo $schiffwert[3]; ?>" border="1" width="150" height="100"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/crew.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['crew']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td><?php echo $schiffwert[15]; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/antrieb.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['antriebe']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td><?php echo $schiffwert[14]; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/cantox.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['cantox']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td><?php echo $schiffwert[5]; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>

            <td rowspan="4" valign="top" style="color:#ccc;">
                <div style="width:250px; height:120px">
                    <div style="width:100%; height:100%; overflow:auto"><?php echo fixforutf($spezial); ?></div>
                </div>
            </td>

        </tr>
        <tr>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/masse.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['masse']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td><?php echo $schiffwert[16]; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/laser.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['energetik']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td><?php echo $schiffwert[9]; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/mineral_1.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['baxterium']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td>
                <nobr><?php echo $schiffwert[6]; ?> KT</nobr>
            </td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
        </tr>
        <tr>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/lemin.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['tank']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td>
                <nobr><?php echo $schiffwert[13]; ?> KT</nobr>
            </td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/projektil.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['projektile']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td><?php echo $schiffwert[10]; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/mineral_2.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['rennurbin']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td>
                <nobr><?php echo $schiffwert[7]; ?> KT</nobr>
            </td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
        </tr>
        <tr>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/vorrat.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['fracht']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td>
                <nobr><?php echo $schiffwert[12]; ?> KT</nobr>
            </td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/hangar.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;"><?php echo $lang['metarassen']['hangar']; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td><?php echo $schiffwert[11]; ?></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/icons/mineral_3.gif" border="0" width="17" height="17"></td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td style="color:#ccc;">Vomisaan</td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
            <td>
                <nobr><?php echo $schiffwert[8]; ?> KT</nobr>
            </td>
            <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="10" height="1"></td>
        </tr>
        <tr>
            <td colspan="20"><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="1" height="20"></td>
        </tr>
<?php
    }
?>
    </table>
<?php
}
