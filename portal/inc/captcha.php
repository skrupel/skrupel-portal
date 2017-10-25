<?php
session_start();

// Größe des Bildes
$size_x = 150;
$size_y = 75;
$font = 'starcraft';

if (!file_exists('../font/'.$font.'.ttf')) {
    $font = 'pdark';
}


// Erzeuge eine Zufallszahl
$zufallszahl = mt_rand('100000', '999999');

// Zufallszahl der Session-Variablen übergeben
$_SESSION['captcha'] = $zufallszahl;

// Erstelle das Bild mit der angegebenen Größe!
$bild = imageCreate($size_x, $size_y);

// Erstelle einen weißen Hintergrund
imageColorAllocate($bild, 255, 255, 255);

// Zufallsfarbe (RGB) erstellen
$farbe1 = mt_rand('0', '175');
$farbe2 = mt_rand('0', '175');
$farbe3 = mt_rand('0', '175');

// Verteile die Farben
$rahmen = imageColorAllocate($bild, 0, 0, 0); // Rahmenfarbe
$farbe = imageColorAllocate($bild, $farbe1, $farbe2, $farbe3); // Textfarbe

// Hole die Zahlen der Punkte zum Zeichnen
$alle_punkte = ($size_x * $size_y) / 15;

// Zeichne viele Punkte mit der selben Farbe des Textes
for ($zaehler = 0; $zaehler < $alle_punkte; $zaehler++) {
    // Erzeuge die Zufallspositionen der Punkte
    $pos_x = mt_rand('0', $size_x);
    $pos_y = mt_rand('0', $size_y);

    // Zeichne die Punkte
    imageSetPixel($bild, $pos_x, $pos_y, $farbe);
};

// Zeichne den Rahmen
imageRectangle($bild, 0, 0, $size_x - 1, $size_y - 1, $rahmen);

// Koordinaten der Position von der Zufallszahl
$pos_x = 7; // links
$pos_y = 45; // oben

// Zeichne die Zufallszahl
// imageString($bild, 5, $pos_x, $pos_y, $zufallszahl, $farbe);
imageTTFtext($bild, 20, 0, $pos_x, $pos_y, $farbe, '../font/'.$font.'.ttf', $zufallszahl);

// Sende "browser header"
header('Content-Type: image/png');

// Sende das Bild zum Browser
echo imagePNG($bild);

// Lösche das Bild
imageDestroy($bild);
