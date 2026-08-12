<?php
function resizeAndSave($source, $destination, $maxWidth, $maxHeight, $quality = 85) {
    echo "Processing $source...\n";
    if (!file_exists($source)) {
        echo "File not found: $source\n";
        return false;
    }

    $info = getimagesize($source);
    $mime = $info['mime'];
    $width = $info[0];
    $height = $info[1];

    if ($mime == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
    } elseif ($mime == 'image/png') {
        $image = imagecreatefrompng($source);
    } else {
        echo "Unsupported image type: $mime\n";
        return false;
    }

    $ratio = min($maxWidth / $width, $maxHeight / $height);
    // Only downscale, don't upscale
    if ($ratio > 1) {
        $ratio = 1;
    }
    
    $newWidth = (int)($width * $ratio);
    $newHeight = (int)($height * $ratio);

    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    
    // preserve transparency for PNGs (although we are saving as JPG, just in case)
    if ($mime == 'image/png') {
        $white = imagecolorallocate($newImage, 255, 255, 255);
        imagefill($newImage, 0, 0, $white);
    }

    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    imagejpeg($newImage, $destination, $quality);
    imagedestroy($image);
    imagedestroy($newImage);
    echo "Saved optimized image to $destination\n";
    return true;
}

$dir = __DIR__ . '/public/images/';

// Optimize hero background (max 1920px wide)
resizeAndSave($dir . 'beranda_utama.png', $dir . 'beranda_utama_bg.jpg', 1920, 1080, 80);

// Optimize floating image 1 thumbnail (max 600px)
resizeAndSave($dir . 'beranda_utama.png', $dir . 'beranda_utama_thumb.jpg', 600, 600, 85);

// Optimize floating image 2 thumbnail (max 600px)
resizeAndSave($dir . 'ambulance.png', $dir . 'ambulance_thumb.jpg', 600, 600, 85);

echo "Done!\n";
