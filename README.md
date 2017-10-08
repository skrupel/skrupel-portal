Skrupel-Portal
==============

**Autor:** Till Affeldt (PseudoPsycho)

**Aktuelle Verion:** 2.0.2


Beschreibung
------------

Vielen Dank, dass Sie sich für die Nutzung dieses Portals entschieden haben. Es ermöglicht eine Vielzahl an Funktionen:

- Neue Registrierung
- Neuer, interaktiver Loginbereich auf jeder Seite
- Spieler können sich PNs schicken
- Flash-Filme und Screenshots von Skrupel.de
- Info über dom. Spezies und Planetenklassen
- News auch als RSS-Feed
- RSS-Addon auch als HTML-Dokument
- Eingeloggt bleiben via Cookies
- Vollständig neues Layout + Shadowboxen
- Von Spielern wählbare Designs
- Sortierbare Mitglieder-Statistik ("KI-freundlich")
- Serverinfos (wie in UsedComm)
- Bugfreie und "KI-freundliche" Spiel-Erstellung (vollständig neu)
- Bugfreie meta_optionen.php (vollständig neu)
- Admin-Funktionen / vollständig ausgelagerter Admin-Bereich
- Automatisches Update-Panel
- Board und Chat ausgelagert, samt Schreibmöglichkeit
- Über die finished.php auf XStats zugreifen
- Bessere Detail-Übersicht über Spiele
- Servername, Keywords und Seitenbeschreibung in conf.php definierbar
- Chatnachricht bei Login, Logout und Registrierung
- Neues Partnersystem (Linkliste)
- Navigation an Spieleinstellungen angepasst

Viel Spaß mit Ihrem neuen Portal!


Installation
------------

### 1. Neue Dateien

Der beigelegte `portal`-Ordner muss einfach in das Skrupel-Verzeichnis kopiert werden.


### 2. Setup

Rufen Sie die Datei `install.php` auf. Folgen Sie den Anweisungen des Assistenten, bis die Installation abgeschlossen ist.

Um ein Update von einer früheren Version oder dem Tiramon-Portal auszuführen, wählen Sie im ersten Schritt die entsprechende Version aus.
Um die vollständigen Datenbank-Strukturen zu installieren, wählen Sie "neu installieren".

Falls die Installation nicht fehlerfrei ausgeführt werden kann, fragen Sie im [Forum](http://board.skrupel.de/viewtopic.php?f=9&t=20914) um Hilfe
oder führen Sie stattdessen die beigelegte `install.sql` in phpMyAdmin aus.


### 3. Zusätzliche (optionale) Dateien

Im Ordner `skrupel` (außerhalb des Portal-Ordners) sind die beiden Dateien `index.php` und `login.php` beigelegt:

- Ersetzen Sie die `index.php` Ihrer Skrupel-Version, wenn Sie eine automatische Weiterleitung zum Portal einrichten wollen.
- Sie können zusätzlich die Datei `login.php` in das Verzeichnis kopieren, wenn Sie dennoch den alten Login-Bereich beibehalten wollen.


Konfiguration
-------------

### Installation von zusätzlichen Templates

In der Grundversion sind zunächst nur die Templates "Classic" und "ClassicX" beigelegt.
Ziehen Sie weitere Templates einfach in das Verzeichnis `portal/styles/`.


### Hinzufügen von Screenshots

In der Grundversion sind die 8 Screenshots enthalten, welche auch auf Skrupel.de zu finden sind.
Um weitere Bilder zu ergänzen, genügt es, sie im Verzeichnis `screenshots/` zu platzieren.
Das Portal erkennt diese dann und bindet sie automatisch ein. Das Format ist beliebig.


Sonstiges
---------

### ToDo

- Datenbankabfragen sicher machen (!)
- Template-System einbauen / Trennung von Logik und Design
- Übersicht: Mitglieder online, anhand der letzten Aktivität im Portal
- Profil für jeden Spieler
- Besucher-Statistiken im (ausgelagerten) Admin-Bereich
- Panel zur Erstellung der `inc/conf.php`
- Bei der Spielerstellung soll es möglich sein, die Einstellungen nachträglich zu ändern
- Statt der "wartet auf Spieler"-Funktion sollte es möglich sein, bestimmte Spieler einzuladen

### Gestrichene Funktionen

- News als Newsletter abonnierbar
- Besucher- und Login-Statistik
- Ruhmeshalle - wer ist der Beste worin?
- Kontaktformular (Stattdessen: Portalinterne Anfragen / PN)
