<?php
  include "inc/conf.php";
  require ($skrupel_path."inc.conf.php");
  include "inc/initial.php";
$page_name="Impressum";
  require_once ("inc/_header.php");

// Angaben gemäß §5 TMG (Impressumspflicht)
$vorname = $impressum_vorname;
$nachname = $impressum_nachname;
$strasse = $impressum_strasse;
$hausnummer = $impressum_hausnummer;
$postleitzahl = $impressum_postleitzahl;
$ortsname =$impressum_ortsname;
$email = $impressum_email;

// Impressumsaufbau (0 für deaktiviert, 1 für aktiviert)
$haftungsausschluss = $impressum_settings_haftung;
$facebook_datenschutz = $impressum_settings_facebook;

?><h1>Impressum</h1><p>Angaben gem&auml;&szlig; § 5 TMG:<br/><br/></p>
<p><?php 
$test=$vorname.$nachname.$strasse.$hausnummer.$postleitzahl.$ortsname;
if (empty($test) || $test=="" || ! isset($test))
{ echo "<big>Impressum noch nicht bearbeitet</big>"; }
else { echo $vorname." ".$nachname."<br />";
echo $strasse." ".$hausnummer."<br />";
echo $postleitzahl." ".$ortsname; }
?></p>
<h2>Kontakt:</h2>
<table><tr><td><p>E-Mail:</p></td>
<td><a href="<?php echo $email; ?>"><?php echo $email; ?></a></td>
<tr><td colspan="2"><a href="kontakt.php">Kontaktformular</a></td></tr>
</tr></table>
<p> </p>
<p>Quelle: <i>Impressum erstellt durch den <a href="http://www.e-recht24.de" target="_blank">Impressum-Generator von S&ouml;ren Siebert, Anwalt f&uuml;r Internetrecht</a></i></p>
<?php if ($haftungsausschluss!=0) { ?>
<h2>Haftungsausschluss:</h2>
<p><strong>Haftung f&uuml;r Inhalte</strong></p>
    <p>Die Inhalte unserer Seiten wurden mit gr&ouml;&szlig;ter Sorgfalt erstellt. 
      F&uuml;r die Richtigkeit, Vollst&auml;ndigkeit und Aktualit&auml;t der Inhalte 
      k&ouml;nnen wir jedoch keine Gew&auml;hr &uuml;bernehmen. Als Diensteanbieter sind wir gem&auml;&szlig; § 7 Abs.1 TMG f&uuml;r 
      eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. 
      Nach § 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht 
      verpflichtet, &uuml;bermittelte oder gespeicherte fremde Informationen zu 
      &uuml;berwachen oder nach Umst&auml;nden zu forschen, die auf eine rechtswidrige 
      T&auml;tigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der 
      Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon 
      unber&uuml;hrt. Eine diesbez&uuml;gliche Haftung ist jedoch erst ab dem 
      Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung m&ouml;glich. Bei 
      Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte 
      umgehend entfernen.</p>
    <p><strong>Haftung f&uuml;r Links</strong></p>
    <p>Unser Angebot enth&auml;lt Links zu externen Webseiten Dritter, auf deren 
      Inhalte wir keinen Einfluss haben. Deshalb k&ouml;nnen wir f&uuml;r diese 
      fremden Inhalte auch keine Gew&auml;hr &uuml;bernehmen. F&uuml;r die Inhalte 
      der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der 
      Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung 
      auf m&ouml;gliche Rechtsverst&ouml;&szlig;e &uuml;berpr&uuml;ft. Rechtswidrige 
      Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente 
      inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte 
      einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen 
      werden wir derartige Links umgehend entfernen.</p>
    <p><strong>Urheberrecht</strong></p>
    <p>Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten 
      unterliegen dem deutschen Urheberrecht. Die Vervielf&auml;ltigung, Bearbeitung, Verbreitung und 
      jede Art der Verwertung au&szlig;erhalb der Grenzen des Urheberrechtes bed&uuml;rfen 
      der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads 
      und Kopien dieser Seite sind nur f&uuml;r den privaten, nicht kommerziellen 
      Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, 
      werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche 
      gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. 
      Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.</p>
    <p><strong>Datenschutz</strong></p>
    <p>Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten m&ouml;glich. Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, 
      Anschrift oder eMail-Adressen) erhoben werden, erfolgt dies, soweit m&ouml;glich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdr&uuml;ckliche Zustimmung nicht an Dritte weitergegeben.   
    </p>
    <p>Wir weisen darauf hin, dass die Daten&uuml;bertragung im Internet (z.B. 
      bei der Kommunikation per E-Mail) Sicherheitsl&uuml;cken aufweisen kann. 
      Ein l&uuml;ckenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht 
      m&ouml;glich. </p>
    <p>Der Nutzung von im Rahmen der Impressumspflicht ver&ouml;ffentlichten Kontaktdaten 
      durch Dritte zur &Uuml;bersendung von nicht ausdr&uuml;cklich angeforderter 
      Werbung und Informationsmaterialien wird hiermit ausdr&uuml;cklich widersprochen. 
      Die Betreiber der Seiten behalten sich ausdr&uuml;cklich rechtliche Schritte 
      im Falle der unverlangten Zusendung von Werbeinformationen, etwa durch Spam-Mails, 
      vor.</p><p> </p><?php } if ($facebook_datenschutz!=0){?>
<p><strong>Datenschutzerkl&auml;rung f&uuml;r die Nutzung von Facebook-Plugins
		 (Like-Button)</strong></p>
		 <p>Auf unseren Seiten sind Plugins des sozialen Netzwerks Facebook,
		 1601 South California Avenue, Palo Alto, CA 94304, USA integriert.
		 Die Facebook-Plugins erkennen Sie an dem Facebook-Logo oder
		 dem "Like-Button" ("Gef&auml;llt mir") auf unserer Seite. Eine &Uuml;bersicht
		 &uuml;ber die Facebook-Plugins finden Sie hier:
		 <a href="http://developers.facebook.com/docs/plugins/" 
		 target="_blank">http://developers.facebook.com/docs/plugins/</a>.<br />
		 Wenn Sie unsere Seiten
		 besuchen, wird &uuml;ber das Plugin eine direkte Verbindung zwischen Ihrem
		 Browser und dem Facebook-Server hergestellt. Facebook erh&auml;lt dadurch
		 die Information, dass Sie mit Ihrer IP-Adresse unsere Seite
		 besucht haben. Wenn Sie den Facebook "Like-Button" anklicken w&auml;hrend
		 Sie in Ihrem Facebook-Account eingeloggt sind, k&ouml;nnen Sie die Inhalte
		 unserer Seiten auf Ihrem Facebook-Profil verlinken. Dadurch kann
		 Facebook den Besuch unserer Seiten Ihrem Benutzerkonto zuordnen. Wir
		 weisen darauf hin, dass wir als Anbieter der Seiten keine Kenntnis vom
		 Inhalt der &uuml;bermittelten Daten sowie deren Nutzung durch Facebook
		 erhalten. Weitere Informationen hierzu finden Sie in der
		 Datenschutzerkl&auml;rung von facebook unter
		 <a href="http://de-de.facebook.com/policy.php" target="_blank">
		 http://de-de.facebook.com/policy.php</a></p>
     <p>Wenn Sie nicht w&uuml;nschen, dass Facebook den Besuch unserer Seiten Ihrem Facebook-Nutzerkonto zuordnen kann, loggen Sie sich bitte aus Ihrem Facebook-Benutzerkonto aus.</p><p> </p>
<p><i>Quellverweis: <a href="http://www.e-recht24.de/muster-disclaimer.htm" target="_blank">Disclaimer eRecht24</a>, <a href="http://www.e-recht24.de/artikel/datenschutz/6590-facebook-like-button-datenschutz-disclaimer.html" target="_blank">Facebook Datenschutzerkl&auml;rung</a></i></p><?php } ?>
<?
  require_once ("inc/_footer.php");
?>
