<?php
include 'inc/conf.php';
include 'inc/initial.php';
require $skrupel_path.'/inc.conf.php';

if ($_SESSION['user_id']) {
    header('Location: index.php');
}

$page_name = 'Registrierung';

if (!isset($_GET['fu']) || $_GET['fu'] == 1) {
    require_once 'inc/_header.php';
?>
    <script type="application/javascript">
        function checkForm(form) {
            if (form.loginname.value == '') {
                alert('Bitte Benutzername angeben!');
                return false;
            }
            if (form.passwort.value == '') {
                alert('Bitte ein Passwort angeben!');
                return false;
            }
            if (form.passwort.value != form.passwort2.value) {
                alert('Die Passwörter müssen identisch sein!');
                return false;
            }
            if (form.email.value == '' || form.email.value.indexOf('@') < 1) {
                alert('Bitte eine gültige E-Mail-Adresse angeben!');
                return false;
            }
            return true;
        }
        function reloadCaptcha() {
            document.getElementById('captcha').src='<?php echo $skrupel_path; ?>/bilder/radb.gif';
            setTimeout('document.getElementById(\'captcha\').src=\'inc/captcha.php#\'+Math.random()', 10);
        }
    </script>
    <center>
        <h1>Registrierung</h1>
<?php if ($_GET['op'] == 'save-error'): ?>
        <p class="msg-error">Die Registrierung konnte leider nicht verarbeitet werden. Bitte versuchen Sie es später noch einmal.</p>
<?php endif; ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>?fu=2" method="post" name="formular" onSubmit="return checkForm(this);">
            <table border="0" cellspacing="0" cellpadding="4">
                <tr>
                    <td align="right">Benutzername&nbsp;</td>
                    <td><input type="text" name="loginname" maxlength="30" style="width:350px"<?php if ($_GET['op'] == 'wrong-name'): ?> class="form-error"<?php endif; ?> value=""/></td>
                </tr>
                <tr>
                    <td align="right">Passwort&nbsp;</td>
                    <td><input type="password" name="passwort" maxlength="50" style="width:350px"<?php if ($_GET['op'] == 'invalid-pw'): ?> class="form-error"<?php endif; ?> value=""></td>
                </tr>
                <tr>
                    <td align="right">Passwort wiederholen&nbsp;</td>
                    <td><input type="password" name="passwort2" maxlength="50" style="width:350px"<?php if ($_GET['op'] == 'pw-mismatch'): ?> class="form-error"<?php endif; ?> value=""></td>
                </tr>
                <tr>
                    <td align="right">E-Mail-Adresse&nbsp;</td>
                    <td><input type="text" name="email" maxlength="255" style="width:350px;"<?php if ($_GET['op'] == 'invalid-mail'): ?> class="form-error"<?php endif; ?> value=""></td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td rowspan="2">
                        <img id="captcha" src="inc/captcha.php" alt="Captcha" width="150" height="75"<?php if ($_GET['op'] == 'wrong-captcha'): ?> class="form-error"<?php endif; ?> /><br/>
                        <a href="javascript:void(0)" onClick="reloadCaptcha();">Neu laden</a>
                    </td>
                    <td>Captcha eingeben:</td>
                </tr>
                <tr>
                    <td><input type="text" name="captcha" value=""<?php if ($_GET['op'] == 'wrong-captcha'): ?> class="form-error"<?php endif; ?> /></td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <button type="submit" style="width:300px;">Registrieren!</button>
                    </td>
                </tr>
            </table>
        </form>
    </center>
<?php
    require_once 'inc/_footer.php';
} elseif ($_GET['fu'] == 2) {
    if (!isset($_POST['loginname']) || $_POST['loginname'] == '') {
        header('Location: '.$_SERVER['PHP_SELF'].'?fu=1&op=invalid-name');
        exit;
    }

    if (!isset($_POST['passwort']) || $_POST['passwort'] == '') {
        header('Location: '.$_SERVER['PHP_SELF'].'?fu=1&op=invalid-pw');
        exit;
    }

    if (strcmp($_POST['passwort'], $_POST['passwort2']) !== 0) {
        header('Location: '.$_SERVER['PHP_SELF'].'?fu=1&op=pw-mismatch');
        exit;
    }

    if (!isset($_POST['email']) || $_POST['email'] == '' || !strpos($_POST['email'], '@')) {
        header('Location: '.$_SERVER['PHP_SELF'].'?fu=1&op=invalid-mail');
        exit;
    }

    if (!isset($_SESSION['captcha']) || $_POST['captcha'] != $_SESSION['captcha'] || empty($_SESSION['captcha'])) {
        unset($_SESSION['captcha']);
        header('Location: '.$_SERVER['PHP_SELF'].'?fu=1&op=wrong-captcha');
        exit;
    }
    unset($_SESSION['captcha']);

    $loginname = $_POST['loginname'];
    $email = $_POST['email'];

    $zeiger = mysql_query("SELECT count(*) as total FROM $skrupel_user where nick='$loginname'");
    $array = @mysql_fetch_array($zeiger);
    $total = $array['total'];
    if ($total >= 1) {
        header('Location: '.$_SERVER['PHP_SELF'].'?fu=1&op=wrong-name');
        die('Benutzername bereits vorhanden.');
    }

    // Crypt password
    $passwort_plain = $_POST['passwort'];
    $passwort_crypt = cryptPasswd($passwort_plain);
    list($passwort, $salt) = explode(':', $passwort_crypt);

    // Save data...
    $zeiger = @mysql_query("INSERT INTO $skrupel_user (nick, passwort, salt, email, optionen, portal_layout) VALUES ('$loginname', '$passwort', '$salt', '$email', '10111111111000', '$template')");
    if (!$zeiger) {
        header('Location: '.$_SERVER['PHP_SELF'].'?fu=1&op=save-error');
        exit;
    }

    // Show message in chat
    @mysql_query("INSERT INTO $skrupel_chat (datum, text, von, farbe) VALUES ('".time()."', '$loginname hat sich f?r dieses Spiel registriert.', 'System', '000000')");

    // Send welcome mail
    $text = 'Herzlich willkommen bei <a href="http://'.$_SERVER['SERVER_NAME'].'">'.$servername.'</a>!<br />Sie erhalten diese E-Mail, da Sie diese Adresse bei der Registration angegeben haben.<br />Im Folgenden Ihre Login-Daten:<hr /><ul><li>Benutzername: '.$loginname.'</li><li>Passwort: '.$passwort.'</li></ul><hr />Liebe Gr&uuml;&szlig;e,<br />Ihr '.$servername.'-Team.';
    $extra = "From: $servername <$absenderemail>\n";
    $extra .= "Content-Type: text/html\n";
    mail($email, "Ihre Registrierung bei $servername", $text, $extra);

    require_once 'inc/_header.php';
?>
    <center>
        <p><img src="<?php echo $skrupel_path; ?>/bilder/logo_login.gif" /></p>
        <p>Sie haben sich erfolgreich registriert.</p>
        <form name="login" method="post" action="index.php">
            <input type="hidden" name="login" value="<?php echo $loginname; ?>"/>
            <input type="hidden" name="pass" value="<?php echo $passwort_plain; ?>"/>
            <input type="submit" value="Einloggen!"/>
        </form>
    </center>
<?php
    require_once 'inc/_footer.php';
}
