<?php

namespace App\Http\Controllers\Company;

use Faker\Provider\Uuid;
use Intervention\Image\Facades\Image;

class StoreCompanyImage
{
    public static function storeImage($src_image)
    {
        //jpeg以外も行けるようにする
        $image = Image::make($src_image)->encode('jpg');

        $image_path = 'storage/' . Uuid::uuid() . '.' . 'jpg';

        $image->save($image_path);

        return $image_path;
    }
}
