<?php

namespace App\Http\Controllers\Company;

use Exception;
use Faker\Provider\Uuid;
use Intervention\Image\Facades\Image;

class StoreCompanyImage
{
    public static function storeImage($src_image)
    {
        $width = 360;
        $height = 240;

        //jpeg以外も行けるようにする
        $image = Image::make($src_image)
            ->encode('jpg')
            ->fit($width, $height);

        if ($image->width() < $width) throw new Exception('WidthSizeMismatchedError');
        if ($image->height() < $height) throw new Exception('HeightSizeMismatchedError');

        $image_path = 'storage/' . Uuid::uuid() . '.' . 'jpg';

        $image->save($image_path);

        return $image_path;
    }
}
