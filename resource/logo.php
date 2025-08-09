<?php
header('Content-Type: image/png');

if (isset($_GET['company'])){
	$text = $_GET['company']; // Dinamik yazı
} else {
	$text = "onlineNIC";
}
$font = __DIR__ . "/verdana-pro-black-italic.ttf"; // Font dosyası
$fontSize = 18;

// Renkler
$lightGreen = [180, 215, 138]; // Açık yeşil
$darkGreen  = [127, 209, 0];   // Koyu yeşil

// Boyut hesapla
$bbox = imagettfbbox($fontSize, 0, $font, $text);
$width=177; //$width = abs($bbox[2] - $bbox[0]) + 100;
$height=66; //$height = abs($bbox[5] - $bbox[3]) + 10;

// Görsel oluştur (alfa kanallı)
$image = imagecreatetruecolor($width, $height);
imagesavealpha($image, true);

// Şeffaf arka plan
$transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $transparent);

// Yazı çiz
$x = 5;
$y = $height - 5;

for ($i = 0; $i < strlen($text); $i++) {
    $char = $text[$i];
    if (ctype_upper($char)) {
        $color = imagecolorallocate($image, $darkGreen[0], $darkGreen[1], $darkGreen[2]);
    } else {
        $color = imagecolorallocate($image, $lightGreen[0], $lightGreen[1], $lightGreen[2]);
    }
    imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $char);

    // Harf genişliği
    $charBox = imagettfbbox($fontSize, 0, $font, $char);
    $x += abs($charBox[2] - $charBox[0]);
}

// PNG olarak gönder
imagepng($image);
imagedestroy($image);
?>
