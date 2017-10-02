<?php 
  include "inc/initial.php";
  if ( $_SESSION["user_id"]) 
  {
    header("Location: index.php"); 
  }
$page_name="Login-Bereich";
  require_once ("inc/_header.php");
?>
<form action="index.php" method="post" name="formular" onSubmit="if(this.login.value=='' || this.pass.value==''){ alert('Nicht alle Felder ausgefüllt!'); return false; }">
<center>
 <img src="<?php echo $skrupel_path; ?>bilder/logo_login.gif" width="329" height="208" alt="Skrupel Logo" title="" /><br>
 <table border="0" cellspacing="0" cellpadding="4" align="center">
<?php if (isset($login_error) && $login_error=="wrong_data"){ ?>
<tr><td /><td style="color:red;">Login-Daten falsch.</td></tr>
<?php } else if (isset($login_error) && $login_error=="bann"){ ?>
<tr><td /><td style="color:red;">Dieser Account wurde aus dem Portal gebannt.</td></tr>
<?php } ?>
   <tr>     
     <td align="right">Benutzername&nbsp;</td>
     <td><input type="text" name="login" maxlength="50" style="width:350px;<?php if(isset($_POST["login"])){ ?> border-color:red; color:red<?php } ?>" value="<?php if (isset($_POST["login"])) { echo $_POST["login"]; } else { echo $HTTP_COOKIE_VARS["login_name"]; } ?>" /></td>     
    </tr>
    <tr>
      <td align="right">Passwort&nbsp;</td>
      <td><input type="password" name="pass" maxlength="50" style="width:350px;<?php if(isset($_POST["login"])){ ?> border-color:red; color:red<?php } ?>" value="" /></td>      
    </tr>
<tr><td /><td align="center"><input type="submit" name="submit" value="Login" style="width:300px;" />
      </td>      
    </tr>
    <tr>
      <td /><td align="left">
        <input type="hidden" name="return" value="active.php" />
<input type="checkbox" name="cookie" /> Bei Seitenbesuchen automatisch einloggen
        </td></tr>
  </table>
</center>
</form>
<?php  
  require_once ("inc/_footer.php");
?>