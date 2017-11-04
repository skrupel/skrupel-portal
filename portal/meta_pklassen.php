<?php
require 'inc/initial.php';

if (!$_GET['sprache']) {
    $_GET['sprache'] = $language;
}

require $skrupel_path.'/lang/de/lang.meta_pklassen.php';

$page_name = 'Planetenklassen';
require_once 'inc/_header.php';
?>
    <h1>Planetenklassen</h1>
    <table border="0" cellspacing="0" cellpadding="4" width="100%" class="info">
        <tr>
            <th colspan="2"><?php echo str_replace('{1}', 'C', $lang['metapklassen']['klasse']) ?></th>
            <th colspan="2"><?php echo str_replace('{1}', 'F', $lang['metapklassen']['klasse']) ?></th>
        </tr>
        <tr>
            <td>
                <img src="<?= $skrupel_path ?>/bilder/planeten/7_2.jpg" border="1" width="113" height="97">
            </td>
            <td width="50%">
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['eisensilikat']?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['einfachundurchdringlich']?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['temperatur']?></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo str_replace(array('{1}','{2}'),array('40','55'),$lang['metapklassen']['grad'])?></td>
                    </tr>
                </table>
            </td>
            <td>
                <img src="<?= $skrupel_path ?>/bilder/planeten/9_1.jpg" border="1" width="113" height="97">
            </td>
            <td width="50%">
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['silikatmetalle']?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['sauerstoffreich']?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['temperatur']?></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo str_replace(array('{1}','{2}'),array('-10','10'),$lang['metapklassen']['grad'])?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th colspan="2"><?php echo str_replace('{1}', 'G', $lang['metapklassen']['klasse']) ?></th>
            <th colspan="2"><?php echo str_replace('{1}', 'I', $lang['metapklassen']['klasse']) ?></th>
        </tr>
        <tr>
            <td>
                <img src="<?= $skrupel_path ?>/bilder/planeten/5_6.jpg" border="1" width="113" height="97">
            </td>
            <td>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['oberflaeche'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['wuestenplanet'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['atmosphaere'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['sauerstoffhaltig'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['temperatur'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo str_replace(array('{1}', '{2}'), array('51', '65'), $lang['metapklassen']['grad']) ?></td>
                    </tr>
                </table>
            </td>
            <td>
                <img src="<?= $skrupel_path ?>/bilder/planeten/6_8.jpg" border="1" width="113" height="97">
            </td>
            <td>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['oberflaeche'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['silikatmetallefluessig'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['atmosphaere'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['edelgashaltig'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['temperatur'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo str_replace(array('{1}', '{2}'), array('35', '60'), $lang['metapklassen']['grad']) ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th colspan="2"><?php echo str_replace('{1}', 'J', $lang['metapklassen']['klasse']) ?></th>
            <th colspan="2"><?php echo str_replace('{1}', 'K', $lang['metapklassen']['klasse']) ?></th>
        </tr>
        <tr>
            <td>
                <img src="<?= $skrupel_path ?>/bilder/planeten/3_5.jpg" border="1" width="113" height="97">
            </td>
            <td>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['oberflaeche'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['silikat'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['atmosphaere'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['spaerlichedelgashaltig'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['temperatur'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo str_replace(array('{1}', '{2}'), array('-35', '-25'), $lang['metapklassen']['grad']) ?></td>
                    </tr>
                </table>
            </td>
            <td>
                <img src="<?= $skrupel_path ?>/bilder/planeten/8_7.jpg" border="1" width="113" height="97">
            </td>
            <td>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['oberflaeche'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['silikatwenigbiskeinwasser'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['atmosphaere'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['spaerlich'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['temperatur'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo str_replace(array('{1}', '{2}'), array('-15', '0'), $lang['metapklassen']['grad']) ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th colspan="2"><?php echo str_replace('{1}', 'L', $lang['metapklassen']['klasse']) ?></th>
            <th colspan="2"><?php echo str_replace('{1}', 'M', $lang['metapklassen']['klasse']) ?></th>
        </tr>
        <tr>
            <td>
                <img src="<?= $skrupel_path ?>/bilder/planeten/4_1.jpg" border="1" width="113" height="97">
            </td>
            <td>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['oberflaeche'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['silikatteilweisewasserbedeckt'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['atmosphaere'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['stickstoffsauerstoffargon'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['temperatur'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo str_replace(array('{1}', '{2}'), array('15', '40'), $lang['metapklassen']['grad']) ?></td>
                    </tr>
                </table>
            </td>
            <td>
                <img src="<?= $skrupel_path ?>/bilder/planeten/1_4.jpg" border="1" width="113" height="97">
            </td>
            <td>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['oberflaeche'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['silikatteilweisewasserbedeckt'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['atmosphaere'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['stickstoffsauerstoff'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['temperatur'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo str_replace(array('{1}', '{2}'), array('5', '25'), $lang['metapklassen']['grad']) ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th colspan="2"><?php echo str_replace('{1}', 'N', $lang['metapklassen']['klasse']) ?></th>
            <th colspan="2"><?php echo str_replace('{1}', 'X', $lang['metapklassen']['klasse']) ?></th>
        </tr>
        <tr>
            <td>
                <img src="<?= $skrupel_path ?>/bilder/planeten/2_4.jpg" border="1" width="113" height="97">
            </td>
            <td>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['oberflaeche'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['vollstaendigwasserbedeckt'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['atmosphaere'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['stickstoffsauerstoff'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['temperatur'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo str_replace(array('{1}', '{2}'), array('-5', '15'), $lang['metapklassen']['grad']) ?></td>
                    </tr>
                </table>
            </td>
            <td>
                <img src="<?= $skrupel_path ?>/bilder/planeten/10_3.jpg" border="1" width="113" height="97">
            </td>
            <td>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['oberflaeche'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['unbekannt'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['atmosphaere'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['unbekannt'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold"><?php echo $lang['metapklassen']['temperatur'] ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?= $skrupel_path ?>/bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $lang['metapklassen']['unbekannt'] ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?php
require_once 'inc/_footer.php';
