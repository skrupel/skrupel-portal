<?php
include "inc/conf.php";
include "inc/initial.php";
require ($skrupel_path."inc.conf.php");
$lang = Array();
require ($skrupel_path."lang/de/lang.admin.spiel_alpha.php");
$prozentarray=array(0,1,2,3,4,5,6,7,8,9,10,15,20,30,40,50,60,70,80,90,100);
$page_name="Spiel erstellen";

if (! isset($_SESSION["user_id"]))
{ header('Location:index.php'); }

  if (!$HTTP_GET_VARS["fu"] && !$_GET["fu"]) 
  {
    $HTTP_GET_VARS["fu"] = 1; //0.969
    $_GET["fu"]          = 1; //0.970+
  }


  if ( $HTTP_GET_VARS["fu"] == 100  || $_GET["fu"] == 100) 
  {
    require "inc/spiel_alpha_save.php";        
  }

if ($_GET["fu"]==1) {
require_once ("inc/_header.php");
if (@intval(substr($spiel_extend,1,1))==1) {
    include($skrupel_path."extend/ki/ki_basis/kiEinrichten.php");
}
?>
<center><table border="0" cellspacing="0" cellpadding="4">
    <tr>
        <td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']; ?></h1></td>
    </tr>
</table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=10" onSubmit="if(this.spiel_name.value==''){alert('Bitte einen Namen angeben!');return false;}else{return true;}">

<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wie_name']; ?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><input type="text" name="spiel_name" class="eingabe" value="" maxlength="50" style="width:250px;"></td></tr>
   <tr><td>&nbsp;</td></tr>

   <tr><td><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['wie']; ?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="siegbedingungen" value="0" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['jff']?></td></tr>
      <tr><td><input type="radio" name="siegbedingungen" value="1"></td><td>&nbsp;</td><td><table border="0" cellspacing="0" cellpadding="0"><tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['ueberleben'][0]?></td><td><select name="zielinfo_1"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select></td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['ueberleben'][1]?></td></tr></table></td></tr>
      <tr><td><input type="radio" name="siegbedingungen" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['tf']?></td></tr>

      <tr><td><input type="radio" name="siegbedingungen" value="6"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['ttf']?></td></tr>
      <?php /* ?>
      <tr><td><input type="radio" name="siegbedingungen" value="3"></td><td>&nbsp;</td><td><table border="0" cellspacing="0" cellpadding="0"><tr><td style="color:#aaaaaa;">Dominanz (es gilt &nbsp;</td><td><select name="zielinfo_3"><option value="30">30 %</option><option value="40">40 %</option><option value="50">50 %</option><option value="60">60 %</option><option value="70">70 %</option><option value="80">80 %</option><option value="90">90 %</option></select></td><td style="color:#aaaaaa;">&nbsp;aller Planeten zu beherrschen)</td></tr></table></td></tr>
      <tr><td><input type="radio" name="siegbedingungen" value="4"></td><td>&nbsp;</td><td><table border="0" cellspacing="0" cellpadding="0"><tr><td style="color:#aaaaaa;">King of the Planet (in der Mitte der Galaxie befindet sich ein heiliger Planet, welcher &nbsp;</td><td><select name="zielinfo_4"><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="150">150</option><option value="200">200</option></select></td><td style="color:#aaaaaa;">&nbsp;Monate beherrscht werden mu?)</td></tr></table></td></tr>
      <?php */ ?>
      <tr><td><input type="radio" name="siegbedingungen" value="5"></td><td>&nbsp;</td><td><table border="0" cellspacing="0" cellpadding="0"><tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['spice'][0]?></td><td><select name="zielinfo_5"><option value="2500">2500</option><option value="5000">5000</option><option value="7500">7500</option><option value="10000">10000</option><option value="15000">15000</option></select></td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['spice'][1]?></td></tr></table></td></tr>

     </table></td></tr>
    <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['optional']['welche']; ?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><input type="checkbox" name="modul_0" value="1" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['sus']; ?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><input type="checkbox" name="modul_4" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['wysiwyg']; ?></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="modul_2" value="1" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['mf']; ?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <?php /*
            <td><input type="checkbox" name="modul_5" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['f']; ?></td>
            */ ?>
            <td></td><td></td><td></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="modul_3" value="1" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['tk']; ?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <?php /*
            <td><input type="checkbox" name="modul_6" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['h']; ?></td>
            */ ?>
            <td></td><td></td><td></td>
        </tr>

      <?php /* ?>
      <tr><td><input type="checkbox" name="modul_1" value="1" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['as'][0]; ?><select name="stat_delay"><?php for($i=0;$i<=15;$i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?></select><?php echo $lang['admin']['spiel']['alpha']['optional']['as'][1]; ?></td></tr>
            <?php */ ?>
      </table></td></tr>

</table></center>
<br><br>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',2,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center><?php
require_once ("inc/_footer.php");
 }

if ($_GET["fu"]==10) {
require_once ("inc/_header.php");
?>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></h1></td></tr></table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=2">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>

<center><table border="0" cellspacing="0" cellpadding="2">
  <tr><td><?php echo $lang['admin']['spiel']['alpha']['struktur']?><br><br></td></tr>
  <tr>
<?php
$zahl=0;
include ($skrupel_path."lang/".$language."/lang.admin.galaxiestrukturen.php");
$file=$skrupel_path.'daten/gala_strukturen.txt';
$fp = @fopen("$file","r");
if ($fp) {
$zaehler=0;
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $struktur[$zaehler]=$buffer;
    $zaehler++;
}
@fclose($fp); }

for ($n=0;$n<$zaehler;$n++) {

$strukturdaten=explode(':',$struktur[$n]);
?>
<td with="50%"><table border="0" cellspacing="0" cellpadding="2" with="100%">
 <tr>
   <td><input type="radio" name="struktur" value="<?php echo $strukturdaten[1]; ?>" <?php if ($n==0) { echo 'checked'; } ?>></td>
   <td style="color:#aaaaaa;" colspan="2"><?php echo $lang['admin']['galaxiestrukturen'][$strukturdaten[0]]; ?></td>
 </tr>
 <tr>
   <td></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td><img src="<?php echo $skrupel_path; ?>bilder/admin/gala_1.gif"></td>
       <td><img src="<?php echo $skrupel_path; ?>bilder/admin/gala_2.gif"></td>
       <td><img src="<?php echo $skrupel_path; ?>bilder/admin/gala_3.gif"></td>
     </tr>
     <tr>
       <td><img src="<?php echo $skrupel_path; ?>bilder/admin/gala_4.gif"></td>
       <td background="<?php echo $skrupel_path; ?>daten/bilder_galaxien/<?php echo $strukturdaten[1]; ?>.png"><img src="<?php echo $skrupel_path; ?>bilder/admin/gala_stars.gif"></td>
       <td><img src="<?php echo $skrupel_path; ?>bilder/admin/gala_5.gif"></td>
     </tr>
     <tr>
       <td><img src="<?php echo $skrupel_path; ?>bilder/admin/gala_6.gif"></td>
       <td><img src="<?php echo $skrupel_path; ?>bilder/admin/gala_7.gif"></td>
       <td><img src="<?php echo $skrupel_path; ?>bilder/admin/gala_8.gif"></td>
     </tr>
   </table></td>
   <td width="100%"><center><?php echo $lang['admin']['spiel']['alpha']['spieleranzahl']?><br><br>
     <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input type="button" style="height:20px;width:20px;" value="1"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'2')) { echo '2'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'3')) { echo '3'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'4')) { echo '4'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'5')) { echo '5'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'6')) { echo '6'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'7')) { echo '7'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'8')) { echo '8'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'9')) { echo '9'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'10')) { echo '10'; } ?>"></td>
      <tr>
     </table>
   </<center></td>
 </tr>

</table></td>
<?php
$zahl++;
if ($zahl==2) {
  $zahl=0;
  echo '</tr>';
}
} ?>





</table></center>


<br><br>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',3,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center><br><br><?php
require_once ("inc/_footer.php");
 }

if ($_GET["fu"]==3) {
    require "inc/spiel_alpha_3.php";
 }


/* ?>
<script language="JavaScript" type="text/javascript">

  spielermog = new Array(0,1,<?php if (strstr($spieleranzahlmog,'2')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'3')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'4')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'5')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'6')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'7')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'8')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'9')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'10')) { echo '1'; } else { echo '0'; } ?>);

function check() {

  var spieleranzahl=0;

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

  if ((document.formular.user_1.value == '0') <?php for ($n=2;$n<=10;$n++) { ?> && (document.formular.user_<?php echo $n; ?>.value == '0')<?php } ?>)  {
      alert("<?php echo $lang['admin']['spiel']['alpha']['min_spieler']?>");
          return false;
  }
<?php if  ($_POST["startposition"]==1) { ?>
  if (spielermog[spieleranzahl]==0) {
    alert ('<?php echo str_replace('{1}',$spieleranzahlmog,$lang['admin']['spiel']['alpha']['nur_spieler'])?>');
    return false;
  }
<?php } ?>

<?php for ($oprt=1;$oprt<=10;$oprt++) { ?>
  if (document.formular.user_<?php echo $oprt; ?>.value >= '1') {
         var anzahle=0;
           <?php for ($n=1;$n<=10;$n++) { ?>
             if (document.formular.user_<?php echo $n; ?>.value == document.formular.user_<?php echo $oprt; ?>.value) { anzahle++; }
           <?php } ?>
         if (anzahle!=1) {
           alert("<?php echo $lang['admin']['spiel']['alpha']['max_slot']?>");
           return false;
         }
   }
<?php } ?>
<?php if ($_POST["siegbedingungen"]==6) {  ?>
<?php for ($oprt=1;$oprt<=10;$oprt++) { ?>
  if (document.formular.user_<?php echo $oprt; ?>.value >= '1') {
    <?php for ($op=0;$op<=4;$op++) { ?>
     if (document.formular.team<?php echo $oprt; ?>[<?php echo $op; ?>].checked == true) {
         var anzahl=0;
           <?php for ($n=1;$n<=10;$n++) { ?>
             if (document.formular.team<?php echo $n; ?>[<?php echo $op; ?>].checked == true) { anzahl++; }
           <?php } ?>
         if (anzahl!=2) {
           alert("<?php echo $lang['admin']['spiel']['alpha']['zwei_spieler']?>");
           return false;
         }
     }
    <?php } ?>
  if ((document.formular.team<?php echo $oprt;?>[0].checked == false) <?php for ($n=1;$n<=4;$n++) { ?> && (document.formular.team<?php echo $oprt; ?>[<?php echo $n; ?>].checked == false)<?php } ?>)  {
      alert("<?php echo $lang['admin']['spiel']['alpha']['team_spieler']?>");
      return false;
  }
  } else {
  if ((document.formular.team<?php echo $oprt; ?>[0].checked == true) <?php for ($n=1;$n<=4;$n++) { ?> || (document.formular.team<?php echo $oprt; ?>[<?php echo $n; ?>].checked == true)<?php } ?>)  {
      alert("<?php echo $lang['admin']['spiel']['alpha']['kein_team']?>");
      return false;
  }
  }
<?php } ?>




<?php } ?>
  return true;
}

</script>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></h1></td></tr></table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=4" onSubmit="return check();">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>

<center><table border="0" cellspacing="0" cellpadding="2">


<?php

$verzeichnis="../daten/";
$handle=opendir("$verzeichnis");

$zaehler=0;
while ($file=readdir($handle)) {
   if ((substr($file,0,1)<>'.') and (substr($file,0,7)<>'bilder_') and (substr($file,strlen($file)-4,4)<>'.txt')) {

if (trim($file)=='unknown') { } else {

$datei=$skrupel_path.'daten/'.$file.'/daten.txt';
$fp = @fopen("$datei","r");
if ($fp) {
$zaehler2=0;
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $daten[$zaehler][$zaehler2]=$buffer;
    $zaehler2++;
}
@fclose($fp); }

$filename[$zaehler]=$file;

$zaehler++;
}
   }
}
closedir($handle);

  $zeiger = @mysql_query("SELECT * FROM $skrupel_user order by nick");
  $useranzahl = @mysql_num_rows($zeiger);

   ?>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wer_volk']?></td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="1">
   <tr>
   <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
   <td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['admin']?></td>
<?php if ($_POST["siegbedingungen"]==6) {  ?>
   <td>&nbsp;&nbsp;</td>
   <td><?php echo $lang['admin']['spiel']['alpha']['teams']?></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['i']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['ii']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['iii']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['iv']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['v']?></center></td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
<?php } ?>
   </tr>
<?php 
    if (@intval(substr($spiel_extend,1,1))==1) {
        $gefundene_KI_spieler = array();
        include($skrupel_path."extend/ki/ki_basis/spielerAuswahlKI.php");
    }
    for ($k=1;$k<11;$k++) { ?>
        <tr>
          <td style="color:<?php echo $spielerfarbe[$k];?>;"><select name="user_<?php echo $k;?>">
             <option value="0" style="background-color:<?php echo $spielerfarbe[$k]; ?>;"><?php echo $lang['admin']['spiel']['alpha']['leer_slot']?></option>
<?php 
   if (@intval(substr($spiel_extend,1,1))==1) $gefundene_KIs = array();
   for ($n=0;$n<$useranzahl;$n++) {
   $ok = @mysql_data_seek($zeiger,$n);
   $array = @mysql_fetch_array($zeiger);
   $uid=$array["id"];
   $nick=$array["nick"];
   if (@intval(substr($spiel_extend,1,1))==1) {
        $ergebnis = filterKI($gefundene_KI_spieler, $gefundene_KIs, $nick, $uid);
        $gefundene_KI_spieler = $ergebnis['ki_spieler'];
        $gefundene_KIs = $ergebnis['kis'];
        if($ergebnis['continue']) continue;
   }   
   ?>
     <option value="<?php echo $uid;?>" style="background-color:<?php echo $spielerfarbe[$k];?>;"><?php echo $nick;?></option>
<?php } ?>
   </select></td>
          <td>&nbsp;</td>
          <td><select name="rasse_<?php echo $k; ?>">
<?php for ($n=0;$n<$zaehler;$n++) { ?>
     <option value="<?php echo $filename[$n]; ?>" style="background-color:<?php echo $spielerfarbe[$k]; ?>;"><?php echo $daten[$n][0]; ?></option>
<?php } ?>
          </select></td>
          <td>&nbsp;</td>
          <td><input type="radio" name="spieler_admin" value="<?php echo $k; ?>"></td>
<?php if ($_POST["siegbedingungen"]==6) {  ?>
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
   <td><table border="0" cellspacing="0" cellpadding="0"><tr><td><input type="radio" name="spieler_admin" value="0" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['niemand']?></td></tr></table></td>
   </tr>



</table></center>
           <br>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',5,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?php
 } require_once ("inc/_footer.php");
 } */
if ($_GET["fu"]==2) {
require_once ("inc/_header.php");
?>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></h1></td></tr></table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=3">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>

<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['startpositionen']['wie']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="startposition" value="1" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['startpositionen']['vorg']?></td></tr>
      <tr><td><input type="radio" name="startposition" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['startpositionen']['zufl']?></td></tr>
      <tr><td><input type="radio" name="startposition" value="3"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['startpositionen']['admin']?></td></tr>
     </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['groesse']['welche']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <?php /* ?>
      <tr><td><input type="radio" name="imperiumgroesse" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['1']?></td></tr>
      <?php */ ?>
      <tr><td><input type="radio" name="imperiumgroesse" value="2" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['2']?></td></tr>
      <?php /* ?>
      <tr><td><input type="radio" name="imperiumgroesse" value="3"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['3']?></td></tr>
      <?php */ ?>
      <tr><td><input type="radio" name="imperiumgroesse" value="4"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['4']?></td></tr>
      <?php /* ?>
      <tr><td><input type="radio" name="imperiumgroesse" value="5"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['5']?></td></tr>
      <tr><td><input type="radio" name="imperiumgroesse" value="6"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['6']?></td></tr>
      <?php */ ?>
   </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['ausscheiden']['wann']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
   <tr><td><input type="radio" name="out" value="3" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ausscheiden']['1']?></td></tr>
   <tr><td><input type="radio" name="out" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ausscheiden']['2']?></td></tr>
   <tr><td><input type="radio" name="out" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ausscheiden']['3']?></td></tr>
      <tr><td><input type="radio" name="out" value="0"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ausscheiden']['4']?></td></tr>
      </table></td></tr>
</table></center>
<br><br>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',4,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center><br>
<?php
require_once ("inc/_footer.php");
 }
if ($_GET["fu"]==4) {
require_once ("inc/_header.php");

if (($_GET["startposset"] !== '1') and ($_POST["startposition"] == 3)) {
?>
<script type="text/javascript">
    function check () {
        for (n=0;n<document.formular.active.length;n++) {
            feldnamex = 'user_' + document.formular.active[n].value + '_xx';
            if (document.getElementById(feldnamex).value == '') {
                alert ('<?php echo $lang['admin']['spiel']['alpha']['jeder_startposition']?>');
                return false;
            }
        }
        return true;
    }
</script>
    <center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></h1></td></tr></table></center>
    <form name="formular" method="post" action="spiel_alpha.php?fu=4&startposset=1" onSubmit="return check();">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
    <center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wo_startposition']?></td><td><img src="<?php echo $skrupel_path; ?>bilder/empty.gif" width="220" height="1"></td></tr>
   <tr><td>&nbsp;</td><td></td></tr>
        <tr>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="0">
				    <tr>
                        <td colspan="3"><img src="<?php echo $skrupel_path; ?>bilder/aufbau/galaoben.gif" border="0" width="258" height="4"></td>
				    </tr>
				    <tr>
                        <td><img src="<?php echo $skrupel_path; ?>bilder/aufbau/galalinks.gif" border="0" width="4" height="250"></td>
                        <td><iframe src="spiel_alpha.php?fu=12&struktur=<?php echo $_POST["struktur"]; ?>" width="250" height="250" name="map" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe></td>
                        <td><img src="<?php echo $skrupel_path; ?>bilder/aufbau/galarechts.gif" border="0" width="4" height="250"></td>
                    </tr>
				    <tr>
                        <td colspan="3"><img src="<?php echo $skrupel_path; ?>bilder/aufbau/galaunten.gif" border="0" width="258" height="4"></td>
				    </tr>
			    </table>
            </td>
            <td valign="top">
                <table border="0" cellspacing="0" cellpadding="2">
                <?php
                $first = 0;
                for ($n=1;$n<=10;$n++) {
                    if (intval($_POST['user_'.$n]) >= 1) {
                        $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_user where id = ".intval($_POST['user_'.$n]));
                        $array_temp = @mysql_fetch_array($zeiger_temp);
                        echo '<tr><td><input type="radio" name="active" id="active" value="'.$n.'" ';
                        if ($first == 0) {
                            $first = 1;
                            echo 'checked';
                        }
                        echo '></td><td>&nbsp;</td><td style="color:'.$spielerfarbe[$n].';">';
                        echo $array_temp["nick"].'</td><td><input type="hidden" name="user_'.$n.'_x" id="user_'.$n.'_xx" value=""><input type="hidden" name="user_'.$n.'_y" id="user_'.$n.'_yy" value=""></td></tr>';
                    }
                }
                ?>
                </table>
            </td>
        </tr>
    </table></center>
    <br/>
    <center><table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><input type="submit" name="bla" value="Weiter"></td><td></form></td>
        </tr>
    </table></center>
<?php
} else {
?>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></h1></td></tr></table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=5">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>

<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['cantox']['wieviel']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="geldmittel" value="15000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['cantox']['1']?></td></tr>
      <tr><td><input type="radio" name="geldmittel" value="5000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['cantox']['2']?></td></tr>
      <tr><td><input type="radio" name="geldmittel" value="3500" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['cantox']['3']?></td></tr>
      <tr><td><input type="radio" name="geldmittel" value="1000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['cantox']['4']?></td></tr>
  </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['res']['wieviel']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="mineralienhome" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res']['1']?></td></tr>
      <tr><td><input type="radio" name="mineralienhome" value="2" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res']['2']?></td></tr>
      <tr><td><input type="radio" name="mineralienhome" value="3"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res']['3']?></td></tr>
      <tr><td><input type="radio" name="mineralienhome" value="4"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res']['4']?></td></tr>
  </table></td></tr>
   <tr><td>&nbsp;</td></tr>
</table></center>

<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',6,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?php
}

require_once ("inc/_footer.php");
 }
if ($_GET["fu"]==5) {
require_once ("inc/_header.php");
?>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></h1></td></tr></table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=6">

<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>


<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['welche']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input type="radio" name="umfang" value="1000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['1']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="umfang" value="3000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['5']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="sternendichte" value="400" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['b']['1']?></td>
      </tr>
      <tr>
        <td><input type="radio" name="umfang" value="1500"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['2']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="umfang" value="3500"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['6']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="sternendichte" value="300"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['b']['2']?></td>
      </tr>
     <tr>
        <td><input type="radio" name="umfang" value="2000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['3']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="umfang" value="4000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['7']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="sternendichte" value="200"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['b']['3']?></td>
     </tr>
     <tr>
        <td><input type="radio" name="umfang" value="2500" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['4']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="umfang" value="4500"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['8']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="sternendichte" value="100"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['b']['4']?></td>
     </tr>
 </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['wieviel']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="mineralien" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['1']?></td><td>&nbsp;&nbsp;</td><td><input type="radio" name="leminvorkommen" value="3"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['5']?></td></tr>
      <tr><td><input type="radio" name="mineralien" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['2']?></td><td>&nbsp;&nbsp;</td><td><input type="radio" name="leminvorkommen" value="2" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['6']?></td></tr>
      <tr><td><input type="radio" name="mineralien" value="3" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['3']?></td><td>&nbsp;&nbsp;</td><td><input type="radio" name="leminvorkommen" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['7']?></td></tr>
      <tr><td><input type="radio" name="mineralien" value="4"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['4']?></td><td></td><td></td><td></td><td></td></tr>
  </table></td></tr>

   <tr><td>&nbsp;</td></tr>

</table></center>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',7,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?php
require_once ("inc/_footer.php");
 }
if ($_GET["fu"]==6) {
require_once ("inc/_header.php");
?>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></h1></td></tr></table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=7">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>

<center><table border="0" cellspacing="0" cellpadding="2">

   <tr><td><?php echo $lang['admin']['spiel']['alpha']['ds']['wie']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="spezien" value="0"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ds']['1']?></td></tr>
      <tr><td><input type="radio" name="spezien" value="25"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ds']['2']?></td></tr>
      <tr><td><input type="radio" name="spezien" value="50" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ds']['3']?></td></tr>
      <tr><td><input type="radio" name="spezien" value="75"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ds']['4']?></td></tr>
      <tr><td><input type="radio" name="spezien" value="100"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ds']['5']?></td></tr>
  </table></td></tr>
    <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['plasmasturm_frage']['1']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['plasmasturm_frage']['2']?></td><td>&nbsp;</td><td><select name="max" style="width:100px;">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5" selected>5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['plasmasturm_frage']['3']?></td><td>&nbsp;</td><td><select name="wahr" style="width:100px;">
	<?php for($p=1;$p<21;$p++){ ?>
		<option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['vh']);?></option>
	<?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['plasmasturm_frage']['4']?></td><td>&nbsp;</td><td><select name="lang" style="width:100px;">
	<?php for($p=3;$p<13;$p++){ ?>
		<option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['runden']);?></option>
	<?php } ?>
    </select></td></tr>
      </table></td></tr>

   <tr><td>&nbsp;</td></tr>
</table></center>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',8,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?php
require_once ("inc/_footer.php");
 }
if ($_GET["fu"]==7) {
require_once ("inc/_header.php");
?>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></h1></td></tr></table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=8">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>

<center><table border="0" cellspacing="0" cellpadding="2">

   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wurmloch_frage']['1']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="instabil" value="0" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;">00</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;">02</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="10"></td><td>&nbsp;</td><td style="color:#aaaaaa;">10</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="30"></td><td>&nbsp;</td><td style="color:#aaaaaa;">30</td></tr>
      <tr><td><input type="radio" name="instabil" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;">01</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="5"></td><td>&nbsp;</td><td style="color:#aaaaaa;">05</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="20"></td><td>&nbsp;</td><td style="color:#aaaaaa;">20</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="50"></td><td>&nbsp;</td><td style="color:#aaaaaa;">50</td></tr>
 </table></td></tr>

   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wurmloch_frage']['2']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="stabil" value="0" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['1']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['2']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['3']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="3"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['4']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="4"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['5']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="5"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['6']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="6"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['7']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="7"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['8']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="8"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['9']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="9"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['10']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="10"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['11']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="11"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['12']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="12"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['13']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="13"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['14']?></td></tr>
  </table></td></tr>

       <tr><td>&nbsp;</td></tr>
</table></center>

<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',9,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?php
require_once ("inc/_footer.php");
 }
if ($_GET["fu"]==8) {
require_once ("inc/_header.php");
?>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></h1></td></tr></table></center>

<form name="formular" method="post" action="spiel_alpha.php?fu=11">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>

<center><table border="0" cellspacing="0" cellpadding="2">

   <tr><td><?php echo $lang['admin']['spiel']['alpha']['nebel']['wie']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="nebel" value="0"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['nebel']['1']?></td></tr>
      <tr><td><input type="radio" name="nebel" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['nebel']['2']?></td></tr>
      <tr><td><input type="radio" name="nebel" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['nebel']['3']?></td></tr>
      <tr><td><input type="radio" name="nebel" value="3" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['nebel']['4']?></td></tr>
     </table></td></tr>
   <tr><td>&nbsp;</td></tr>

   <tr><td><?php echo $lang['admin']['spiel']['alpha']['raumpiratenfrage']['1']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['raumpiratenfrage']['2']?></td><td>&nbsp;</td><td><select name="piraten_mitte" style="width:60px;">
	<?php for($p=0;$p<21;$p++){ ?>
		<option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['vh']);?></option>
	<?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['raumpiratenfrage']['3']?></td><td>&nbsp;</td><td><select name="piraten_aussen" style="width:60px;">
	<?php for($p=0;$p<21;$p++){ ?>
		<option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['vh']);?></option>
	<?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['raumpiratenfrage']['4']?></td><td>&nbsp;</td><td><select name="piraten_min" style="width:60px;">
	<?php for($p=1;$p<21;$p++){ ?>
		<option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['vh']);?></option>
	<?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['raumpiratenfrage']['5']?></td><td>&nbsp;</td><td><select name="piraten_max" style="width:60px;">
	<?php for($p=1;$p<21;$p++){ ?>
		<option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['vh']);?></option>
	<?php } ?>
    </select></td></tr>

      </table></td></tr>

    <tr><td>&nbsp;</td></tr>
</table></center>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo $lang['admin']['spiel']['alpha']['erstellen']?>"></td><td></form></td>
</tr></table></center>
<?php
require_once ("inc/_footer.php");
 }
if ($_GET["fu"]==12) {
require_once ("inc/_header.php");
?>
<script type="text/javascript">

function auswahl(xx, yy) {
    for (n=0;n<parent.document.formular.active.length;n++) {
        if (parent.document.formular.active[n].checked) {
            feldnamex = 'user_' + parent.document.formular.active[n].value + '_xx';
            feldnamey = 'user_' + parent.document.formular.active[n].value + '_yy';

            parent.document.getElementById(feldnamex).value = xx;
            parent.document.getElementById(feldnamey).value = yy;

            elementname = 'start_' + parent.document.formular.active[n].value;
            element = document.getElementById(elementname);
            element.style.top = (yy*2.5)-3.5;
            element.style.left = (xx*2.5)-3.5;
        }
    }
}

var IE = document.all?true:false;
var NS = (!document.all && document.getElementById)?true:false;
if (!IE && !NS) {
    document.captureEvents(Event.MOUSEMOVE);
}
document.onmousemove = getMouseXY;

var tempX = 0;
var tempY = 0;

function getMouseXY(e) {

  if (IE) {
    tempXX = event.clientX + document.body.scrollLeft;
    tempYY = event.clientY + document.body.scrollTop;
  } else {
    tempXX = e.pageX;
    tempYY = e.pageY;
  }

  if (tempXX!=tempX) {


  tempX=tempXX;
  tempY=tempYY;
  if (tempX < 0){tempX = 0;}
  if (tempY < 0){tempY = 0;;}

  }

}
</script>
<div id="galastruktur" style="z-index:1;position: absolute; left:0px; top:0px; width: 250px; height: 250px;">
    <img src="<?php echo $skrupel_path; ?>daten/bilder_galaxien/<?php echo $_GET['struktur']; ?>.png" width="250" height="250">
</div>
<div id="stars" style="z-index:2;position: absolute; left:0px; top:0px; width: 250px; height: 250px;">
    <img src="<?php echo $skrupel_path; ?>bilder/admin/gala_stars_big.gif" width="250" height="250" border="0">
</div>
<div id="empty" style="z-index:4;position: absolute; left:0px; top:0px; width: 250px; height: 250px;">
    <a href="#" onclick="auswahl(tempX/2.5, tempY/2.5);" style="cursor:crosshair;"><img src="<?php echo $skrupel_path; ?>bilder/empty.gif" width="250" height="250" border="0"></a>
</div>
<?php
for ($n=1;$n<11;$n++) {
    echo '<div id="start_'.$n.'" style="z-index:3;position: absolute; left:-1000px; top:-1000px; width: 7px; height: 7px;">';
    echo '<img src="<?php echo $skrupel_path; ?>bilder/karte/farben/schiff_5_'.$n.'.gif" width="7" height="7" border="0">';
    echo '</div>';
}
?>
<?php
require_once ("inc/_footer.php");
 }

if ($_GET["fu"]==11 || $_GET["fu"]==9) {
    require "inc/spiel_alpha_prepare_save.php";
 }

?>
