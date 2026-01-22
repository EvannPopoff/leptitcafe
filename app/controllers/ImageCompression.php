<?php
namespace app\controllers;

class ImageCompression {
    public static function compressImage($source, $destination) {
        $info = getimagesize($source);
        if (!$info) return false;

        // On crée la ressource PHP
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return false;
        }

        // On compresse et on sauvegarde en JPG
        $result = imagejpeg($image, $destination, 75);
        imagedestroy($image);

        return $result ? $destination : false;
    }
}