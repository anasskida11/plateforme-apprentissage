<?php

$words = ['chat', 'chien', 'lapin', 'oiseau'];
$width = 400;
$height = 300;

foreach ($words as $word) {
    // Créer une nouvelle image
    $image = imagecreatetruecolor($width, $height);
    
    // Définir les couleurs
    $bg_color = imagecolorallocate($image, 240, 240, 240); // Gris clair
    $text_color = imagecolorallocate($image, 0, 0, 0); // Noir
    $border_color = imagecolorallocate($image, 200, 200, 200); // Gris pour la bordure
    
    // Remplir le fond
    imagefill($image, 0, 0, $bg_color);
    
    // Dessiner une bordure
    imagerectangle($image, 0, 0, $width-1, $height-1, $border_color);
    
    // Ajouter le texte
    $text = strtoupper($word);
    $font = 5; // Utiliser la plus grande police intégrée
    
    // Obtenir les dimensions du texte
    $text_width = imagefontwidth($font) * strlen($text);
    $text_height = imagefontheight($font);
    
    // Centrer le texte
    $x = ($width - $text_width) / 2;
    $y = ($height - $text_height) / 2;
    
    // Dessiner le texte
    imagestring($image, $font, $x, $y, $text, $text_color);
    
    // Sauvegarder l'image
    if (!is_dir('assets/images/words')) {
        mkdir('assets/images/words', 0777, true);
    }
    
    imagejpeg($image, "assets/images/words/{$word}.jpg", 90);
    
    // Libérer la mémoire
    imagedestroy($image);
    
    echo "Image générée : {$word}.jpg\n";
}

echo "\nToutes les images ont été générées avec succès !\n";
?> 