<?php
include 'inc/initial.php';

if ($_SESSION['user_id']) {
    header('Location: index.php');
}

$page_name = 'Login-Bereich';
require_once 'inc/_header.php';
?>
    <center>
        <img src="<?php echo $skrupel_path; ?>/bilder/logo_login.gif" width="329" height="208" alt="Skrupel Logo" title=""/><br>
<?php if (isset($login_error) && $login_error == 'wrong_data'): ?>
        <p class="msg-error">Login-Daten falsch.</p>
<?php elseif (isset($login_error) && $login_error == 'bann'): ?>
        <p class="msg-error">Dieser Account wurde aus dem Portal gebannt.</p>
<?php endif; ?>
        <form action="index.php" method="post" name="formular" onSubmit="if (this.login.value == '' || this.pass.value == '') { alert('Nicht alle Felder ausgefüllt!'); return false; }">
            <table border="0" cellspacing="0" cellpadding="4" align="center">
                <tr>
                    <td align="right">Benutzername</td>
                    <td><input type="text" name="login" maxlength="50" style="width:350px;"<?php if (isset($_POST['login'])): ?> class="form-error"<?php endif; ?> value="<?= isset($_POST['login']) ? $_POST['login'] : $_COOKIE['login_name']; ?>"/></td>
                </tr>
                <tr>
                    <td align="right">Passwort&nbsp;</td>
                    <td><input type="password" name="pass" maxlength="50" style="width:350px;<?php if (isset($_POST['login'])) { ?> border-color:red; color:red<?php } ?>" value=""/></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="submit" value="Login" style="width:300px;"/></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <label>
                            <input type="hidden" name="return" value="active.php"/>
                            <input type="checkbox" name="cookie"/> Bei Seitenbesuchen automatisch einloggen
                        </label>
                    </td>
                </tr>
            </table>
        </form>
    </center>
<?php
require_once 'inc/_footer.php';
