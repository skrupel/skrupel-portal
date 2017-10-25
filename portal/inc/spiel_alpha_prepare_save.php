<?php
include 'inc/conf.php';
include 'inc/_header.php';
?>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td><h1>Neues Spiel erstellen</h1></td></tr></table></center>

<form name="formular" id="formular" method="post" action="spiel_alpha.php?fu=100">
<?php
foreach ($_POST as $key => $value) {

    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
<br><br><br><br><br>
<center>
<img src=<?php echo $skrupel_path; ?>"bilder/rad.gif" height="46" width="51"><br><br>
Einen Moment Geduld bitte.
<br><br>
Das Spiel wird erstellt.
</center>
</form>
<script language=JavaScript>
  document.getElementById('formular').submit();
 </script>
<?php
include 'inc/_footer.php';
