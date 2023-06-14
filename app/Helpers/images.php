<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

if (!function_exists("storeUploadedImage")) {
    function storeUploadedImage(UploadedFile $image, string $name, string $folder, string $oldImage = null) {
        /**
         * Store a new image inside the specified path
         * @param string name
         * @param string path
         * @param string oldImage
         */
        
        if ($oldImage !== null) {
            // Delete pld image
            Storage::delete($folder.'/'.$oldImage);
        }
        
        // Store new image
        $image->storeAs($folder, $name);
    }
}