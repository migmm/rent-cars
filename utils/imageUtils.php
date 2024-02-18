<?php

function resizeAndSaveImage($sourcePath, $targetPath, $newWidth, $newHeight) {
        if (!file_exists($sourcePath)) {
            die("Source image doesn't exist.");
        }
    
        list($originalWidth, $originalHeight) = getimagesize($sourcePath);
    
        // Check if image dimensions are valid
        if ($originalWidth == 0 || $originalHeight == 0) {
            die("Invalid image dimensions.");
        }
    
        $ratio = $originalWidth / $originalHeight;
        if ($newWidth / $newHeight > $ratio) {
            $newWidth = $newHeight * $ratio;
        } else {
            $newHeight = $newWidth / $ratio;
        }
    
        $sourceImage = imagecreatefromjpeg($sourcePath);
    
        $newWidth = round($newWidth);
        $newHeight = round($newHeight);
    
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
        imagecopyresampled(
            $resizedImage,
            $sourceImage,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $originalWidth,
            $originalHeight
        );
    
        imagejpeg($resizedImage, $targetPath);
    
        imagedestroy($sourceImage);
        imagedestroy($resizedImage);
    }

    ?>