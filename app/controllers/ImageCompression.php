<?php
namespace app\controllers\ImageCompression;

class ImageHelper {
    public static function compressImage($source, $destination) {
        $info = getimagesize($source);
        
        // Création de la ressource selon le format
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return false; 
        }

        // Compression et sauvegarde en JPG (Qualité 75%)
        imagejpeg($image, $destination, 75);
        
        // Nettoyage de la mémoire
        imagedestroy($image);
        return $destination;
    }
}