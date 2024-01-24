<?php

namespace App\Core;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image as ResizeImage;

class ImageManager
{
    public static function store($name, $contents) {
        $path = 'images/'. $name;
        Storage::disk('public')->put($path, $contents);
        return Image::create([
            'path' => $path,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
    public static function storeFile(UploadedFile $file) {
        $filename = uniqid(). '.' . File::extension($file->getClientOriginalName());
        return self::store($filename, file_get_contents($file));
    }
    public static function remove(Image $image): void
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();
    }

    public static function removeIfNotUsed(Image $image, $limit = 0): void
    {
        error_log('To delete' . $image->id);
        //Print all relations of $image
        error_log($image->products()->get());
        if($image->products()->count() <= $limit) {
            self::remove($image);
        }
    }
}
