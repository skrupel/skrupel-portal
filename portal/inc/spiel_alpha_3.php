<?php
if ($_GET['fu'] == 3) {

require_once $skrupel_path.'/inc.conf.php';

$lang = array();
include $skrupel_path.'/lang/de/lang.admin.spiel_alpha.php';
 require_once 'inc/_header.php';

$file = $skrupel_path.'daten/gala_strukturen.txt';
$fp = @fopen("$file", 'r');
if ($fp) {
while (!feof($fp)) {
    $buffer = @fgets($fp, 4096);
    $strukturdaten = explode(':', $buffer);
    if ($strukturdaten[1] == $_POST['struktur']) {
       $spieleranzahlmog = trim($strukturdaten[2]);
    }
}
@fclose($fp); }


?>
<script language="JavaScript" type="text/javascript">

  spielermog = new Array(0,1,<?php if (strstr($spieleranzahlmog, '2')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog, '3')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog, '4')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog, '5')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog, '6')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog, '7')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog, '8')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog, '9')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog, '10')) { echo '1'; } else { echo '0'; } ?>);

function check() {

  var spieleranzahl=0, zaehler, zaehler2;

  if (document.formular.user_1.value != '0') { spieleranzahl++; }
  if (document.formular.user_2.value != '0') { spieleranzahl++; }
  if (document.formular.user_3.value != '0') { spieleranzahl++; }
  if (document.formular.user_4.value != '0') { spieleranzahl++; }
  if (document.formular.user_5.value != '0') { spieleranzahl++; }
  if (document.formular.user_6.value != '0') { spieleranzahl++; }
  if (document.formular.user_7.value != '0') { spieleranzahl++; }
  if (document.formular.user_8.value != '0') { spieleranzahl++; }
  if (document.formular.user_9.value != '0') { spieleranzahl++; }
  if (document.formular.user_10.value != '0') { spieleranzahl++; }

<?php if  ($_POST['startposition'] == 1) { ?>
  if (spielermog[spieleranzahl]==0) {
    alert ('<?php echo str_replace('{1}', $spieleranzahlmog, $lang['admin']['spiel']['alpha']['nur_spieler']); ?>');
    return false;
  }

<?php } ?>

<?php for ($oprt = 1;$oprt <= 10;$oprt++) { ?>
  if (document.formular.user_<?php echo $oprt?>.value >= '1') {
         var anzahle=0;
           <?php for ($n = 1;$n <= 10;$n++) { ?>
             if (document.formular.user_<?php echo $n; ?>.value == document.formular.user_<?php echo $oprt; ?>.value) { anzahle++; }
           <?php } ?>
         if (anzahle!=1) {
           alert("<?php echo $lang['admin']['spiel']['alpha']['max_slot']?>");
           return false;
         }
   }
<?php } ?>
<?php if ($_POST['siegbedingungen'] == 6) {  ?>
<?php for ($oprt = 1;$oprt <= 10;$oprt++) { ?>
  if (document.formular.user_<?php echo $oprt; ?>.value >= '1' || document.formular.user_<?php echo $oprt; ?>.value == '-1') {
    <?php for ($op = 0;$op <= 4;$op++) { ; ?>
     if (document.formular.team<?php echo $oprt; ?>[<?php echo $op; ?>].checked == true) {
         var anzahl=0;
           <?php for ($n = 1;$n <= 10;$n++) { ; ?>
             if (document.formular.team<?php echo $n; ?>[<?php echo $op; ?>].checked == true) { anzahl++; }
           <?php } ?>
         if (anzahl!=2) {
           alert("<?php echo $lang['admin']['spiel']['alpha']['zwei_spieler']; ?>");
           return false;
         }
     }
    <?php } ?>
  if ((document.formular.team<?php echo $oprt; ?>[0].checked == false) <?php for ($n = 1;$n <= 4;$n++) { ?> && (document.formular.team<?php echo $oprt; ?>[<?php echo $n; ?>].checked == false)<?php } ?>)  {
      alert("<?php echo $lang['admin']['spiel']['alpha']['team_spieler']; ?>");
      return false;
  }
  } else {
  if ((document.formular.team<?php echo $oprt; ?>[0].checked == true) <?php for ($n = 1;$n <= 4;$n++) { ?> || (document.formular.team<?php echo $oprt; ?>[<?php echo $n; ?>].checked == true)<?php } ?>)  {
      alert("<?php echo $lang['admin']['spiel']['alpha']['kein_team']; ?>");
      return false;
  }
  }
<?php } ?>




<?php }  ?>
for (zaehler=0; zaehler<20; zaehler+=2)
{ if (document.getElementsByTagName("select")[zaehler].value!=-1 && document.getElementsByTagName("select")[zaehler].value!=-0 && document.getElementsByTagName("select")[zaehler+1].value==-1)
{ document.getElementsByTagName("select")[zaehler+1].value=document.getElementsByTagName("select")[zaehler+1].options[Math.round(1+document.getElementsByTagName("select")[zaehler+1].length*Math.random())].value; }
else if (document.getElementsByTagName("select")[zaehler].value==-1 || document.getElementsByTagName("select")[zaehler].value==0)
{ document.getElementsByTagName("select")[zaehler+1].value==-1; }
}
return true;
}

</script>

<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']; ?></h1></td></tr></table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=4" onSubmit="return check();">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>

<center><table border="0" cellspacing="0" cellpadding="2">


<?php

$verzeichnis = $skrupel_path.'daten/';
$handle = opendir("$verzeichnis");

$zaehler = 0;
while ($file = readdir($handle)) {
   if ((substr($file, 0, 1) != '.') and (substr($file, 0, 7) != 'bilder_') and (substr($file, strlen($file) - 4, 4) != '.txt'))
   {
     if (trim($file) == 'unknown' || trim($file) == 'CVS') { }
     else {
       $datei = $skrupel_path.'daten/'.$file.'/daten.txt';
       $fp = @fopen("$datei", 'r');
       if ($fp) {
         $zaehler2 = 0;
         while (!feof($fp)) {
           $buffer = @fgets($fp, 4096);
           $daten[$zaehler][$zaehler2] = $buffer;
           $zaehler2++;
         }
         @fclose($fp); }

         $filename[$zaehler] = $file;

         $zaehler++;
     }
   }
}
closedir($handle);

  $zeiger = @mysql_query("SELECT * FROM $skrupel_user ORDER BY nick");
  $useranzahl = @mysql_num_rows($zeiger);

   ?>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wer_volk']; ?></td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="1">
   <tr>
   <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
   <td style="color:#aaaaaa;"><!--<?php echo $lang['admin']['spiel']['alpha']['admin']; ?>--></td>
<?php if ($_POST['siegbedingungen'] == 6) {  ?>
   <td>&nbsp;&nbsp;</td>
   <td><?php echo $lang['admin']['spiel']['alpha']['teams']; ?></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['i']; ?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['ii']; ?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['iii']; ?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['iv']; ?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['v']; ?></center></td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
<?php } ?>
   </tr>
<?php for ($k = 1;$k < 11;$k++) {?>
        <tr>
          <td style="color:<?php echo $spielerfarbe[$k]; ?>;"><select id="<?php echo $k; ?>" name="user_<?php echo $k; ?>" onChange="var zaehler; if (this.value!=0 && this.value!=-1) {document.formular.rasse_<?php echo $k; ?>.style.display='block'; for (zaehler=0; zaehler<document.formular.rasse_<?php echo $k; ?>.options.length; zaehler++) { if (document.formular.rasse_<?php echo $k; ?>.options[zaehler].value==-1) { document.formular.rasse_<?php echo $k; ?>.options[zaehler].style.display='none'; } else { document.formular.rasse_<?php echo $k; ?>.options[zaehler].selected=true; break; } } } else { for (zaehler=0; zaehler<document.formular.rasse_<?php echo $k; ?>.options.length; zaehler++) { if (document.formular.rasse_<?php echo $k; ?>.options[zaehler].value==-1){ document.formular.rasse_<?php echo $k; ?>.options[zaehler].style.display='block'; } } document.formular.rasse_<?php echo $k; ?>.value=-1; document.formular.rasse_<?php echo $k; ?>.style.display='none'; }">
            <?php if ($k > 1) { ?>
             <option value="0" style="background-color:<?php echo $spielerfarbe[$k]; ?>;"><?php echo $lang['admin']['spiel']['alpha']['leer_slot']; ?></option>
             <option value="-1" style="background-color:<?php echo $spielerfarbe[$k]; ?>;">Wartet auf Spieler</option>
<?php for ($n = 0;$n < $useranzahl;$n++) {
   $ok = @mysql_data_seek($zeiger, $n);
   $array = @mysql_fetch_array($zeiger);
   $uid = $array['id'];
   $nick = $array['nick'];
    if ($nick == 'Computer (Leicht) '.($k - 1) || $nick == 'Computer (Mittel) '.($k - 1)){
?>
     <option value="<?php echo $uid; ?>" style="background-color:<?php echo $spielerfarbe[$k]; ?>;"><?php echo $nick; ?></option>     
<?php }} ?>
  <?php }
        else
        {
          echo "<option value=\"{$_SESSION['user_id']}\" style=\"background-color:{$spielerfarbe[$k]}\">{$_SESSION['name']}</option>";
       //   echo "<option value=\"-1\" style=\"background-color:{$spielerfarbe[$k]};\">Wartet auf Spieler</option>";
        }
        ?>
   </select></td>
          <td>&nbsp;</td>
          <td><select id="rasse_<?php echo $k; ?>" name="rasse_<?php echo $k; ?>"<?php if ($k > 1){?> style="display:none"<?php } ?>>
<?php if ($k == 1) {
   for ($n = 0;$n < $zaehler;$n++) { ?>
     <option value="<?php echo $filename[$n]; ?>" style="background-color:<?php echo $spielerfarbe[$k]; ?>;"><?php echo $daten[$n][0]; ?></option>
<?php }
  } else
   { echo "<option value=\"-1\" style=\"background-color:{$spielerfarbe[$k]};\">Durch Spieler w&auml;hlbar</option>";
  for ($n2 = 0;$n2 < $zaehler;$n2++) { ?>
     <option value="<?php echo $filename[$n2]; ?>" style="background-color:<?php echo $spielerfarbe[$k]; ?>;"><?php echo $daten[$n2][0]; ?></option>
<?php }}  ?>          </select></td>
          <td>&nbsp;</td>
          <td><input type="hidden" name="spieler_admin" value="<?php echo $_SESSION['user_id']; ?>"></td>
<?php if ($_POST['siegbedingungen'] == 6) {  ?>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="1"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="2"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="3"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="4"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="5"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="0" checked></center></td>
<?php } ?>
        </tr>
<?php } ?>
   <tr>
   <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
   <td><!--<table border="0" cellspacing="0" cellpadding="0"><tr><td><input type="radio" name="spieler_admin" value="0" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['niemand']; ?></td></tr></table>--></td>
   </tr>



</table></center>
           <br>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}', 5, $lang['admin']['spiel']['alpha']['weiter_']); ?>"></td><td></form></td>
</tr></table></table></center>
<?php
 require_once 'inc/_footer.php';
 }
