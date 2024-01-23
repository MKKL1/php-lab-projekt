<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    //TODO this should for sure be a facade
    public function store(UploadedFile $file) {
        $name = 'images/'.Str::uuid();
        Storage::disk('public')->put($name,file_get_contents($file));
        return Image::create([
            'path' => $name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
    public function remove(Image $image) {
        Storage::disk('public')->delete($image->path);
        $image->delete();
    }
}
