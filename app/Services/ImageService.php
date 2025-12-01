<?php

namespace App\Services;

use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    public function uploadWithThumbnail($file, $path, $thumbPath, $width = 300, $height = 300)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;

        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }
        if (!file_exists(public_path($thumbPath))) {
            mkdir(public_path($thumbPath), 0777, true);
        }

        $file->move(public_path($path), $filename);

        $fullImagePath = public_path("$path/$filename");
        $thumbImagePath = public_path("$thumbPath/$filename");

        Image::read($fullImagePath)
            ->scaleDown(width: $width, height: $height)
            ->save($thumbImagePath);

        return $filename;
    }
}