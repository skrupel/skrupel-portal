<?php
require 'inc/initial.php';

if (!$_GET['sprache']) {
    $_GET['sprache'] = $language;
}

require $skrupel_path.'/lang/de/lang.meta_spezien.php';

$fp = @fopen($skrupel_path.'/daten/dom_spezien.txt', 'r');
if ($fp) {
    $zaehler = 0;
    while (!feof($fp)) {
        $buffer = @fgets($fp, 4096);
        $ur[$zaehler] = explode(':', $buffer);
        $zaehler++;
    }
    @fclose($fp);
}

$page_name = 'Dominante Spezies';
require_once 'inc/_header.php';
?>
    <h1>Dominante Spezies</h1>
    <table border="0" cellspacing="0" cellpadding="4" width="100%" class="info">
<?php foreach ($ur as $spezies): ?>
        <tr>
            <th colspan="3"><?php echo $lang['metaspezien'][$spezies[1]]['name'] ?></th>
        </tr>
        <tr>
            <td><img src="<?= $skrupel_path ?>/daten/bilder_spezien/<?php echo $spezies[2] ?>" border="1" width="100" height="100"></td>
            <td>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td rowspan="2" style="vertical-align: top"><img src="<?= $skrupel_path ?>/bilder/icons/native_2.gif" border="0" width="17" height="17"></td>
                        <td><strong><?php echo $lang['metaspezien']['artgestalt'] ?></strong></td>
                    </tr>
                    <tr>
                        <td>
                            <nobr><?php echo $lang['metaspezien']['art'][$spezies[3]]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="vertical-align: top"><img src="<?= $skrupel_path ?>/bilder/icons/cantox.gif" border="0" width="17" height="17"></td>
                        <td><strong><?php echo $lang['metaspezien']['abgaben'] ?></strong></td>
                    </tr>
                    <tr>
                        <td>
                            <nobr><?php echo str_replace('{1}', $spezies[4] * 100, $lang['metaspezien']['vh']); ?></nobr>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align: middle; width: 100%">
                <div style="vertical-align: middle">
                    <?php echo $lang['metaspezien'][$spezies[1]]['beschreibung']; ?>
                    <div style="text-align: center; margin-top: 1em"><?php echo $lang['metaspezien'][$spezies[1]]['effekt']; ?></div>
                </div>
            </td>
        </tr>
<?php endforeach; ?>
    </table>
<?php
require_once 'inc/_footer.php';
