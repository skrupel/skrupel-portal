<?php
  include "inc/conf.php";
  include"inc/initial.php";
    require ($skrupel_path."inc.conf.php");
    if(!$_GET["sprache"]){$_GET["sprache"]=$language;}
    $file=$skrupel_path."lang/de/lang.meta_spezien.php";
    require ($file);
$bildpfad=$skrupel_path."bilder/";
$page_name="dom. Spezies";
  require_once ("inc/_header.php");
    ?>
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <?php
        $file='../daten/dom_spezien.txt';
        $fp = @fopen("$file","r");
        if ($fp) {
            $zaehler=0;
            while (!feof ($fp)) {
                $buffer = @fgets($fp, 4096);
                $ur[$zaehler]=explode(":",$buffer);
                $zaehler++;
            }
            @fclose($fp);
    
        ?>
        <center><h1>Dominante Spezies</h1></center>
        <table border="0" cellspacing="0" cellpadding="4">
            <?php
            for ($i=0;$i<$zaehler;$i++) {
                ?>
                <tr>
                    <td colspan="5"><?php echo $lang['metaspezien'][$ur[$i][1]]['name']?></td>
                <tr>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="../daten/bilder_spezien/<?php echo $ur[$i][2]?>" border="0" width="100" height="100"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/native_2.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metaspezien']['artgestalt']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><nobr><?php echo $lang['metaspezien']['art'][$ur[$i][3]]; ?></nobr></td>
                            </tr>
                            <tr>
                                <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metaspezien']['abgaben']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><nobr><?php echo str_replace('{1}',$ur[$i][4]*100,$lang['metaspezien']['vh']);?></nobr></td>
                            </tr>
                        </table>
                    </td>
                <td valign="top" width="100%">
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                            <td style="color:#aaaaaa;"><?php echo $lang['metaspezien'][$ur[$i][1]]['beschreibung']; ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><center><?php echo $lang['metaspezien'][$ur[$i][1]]['effekt']; ?></center></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    </div>
    <?php
    require_once ("inc/_footer.php");
}
?>
