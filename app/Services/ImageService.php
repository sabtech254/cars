<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    /**
     * Resize and optimize an image
     *
     * @param string $path Path to the image file
     * @param int $width Target width
     * @param int $height Target height
     * @param string $fit Fit method (crop, contain)
     * @return string Path to the resized image
     */
    public static function resizeAndOptimize($path, $width = 250, $height = 250, $fit = 'crop')
    {
        $image = Image::make(Storage::path($path));
        
        if ($fit === 'crop') {
            // Resize and crop
            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        } else {
            // Resize to fit within dimensions while maintaining aspect ratio
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        // Optimize the image
        $image->encode('jpg', 80); // Convert to JPG and set quality to 80%

        // Generate new filename
        $directory = dirname($path);
        $filename = pathinfo($path, PATHINFO_FILENAME);
        $newPath = "{$directory}/{$filename}_{$width}x{$height}.jpg";

        // Save the optimized image
        Storage::put($newPath, $image->stream());

        return $newPath;
    }

    /**
     * Generate all required image sizes for a car
     *
     * @param string $path Original image path
     * @return array Array of generated image paths
     */
    public static function generateCarImageSizes($path)
    {
        return [
            'card' => self::resizeAndOptimize($path, 250, 250, 'crop'),
            'thumbnail' => self::resizeAndOptimize($path, 100, 100, 'crop'),
            'detail' => self::resizeAndOptimize($path, 800, 600, 'contain'),
        ];
    }
}
