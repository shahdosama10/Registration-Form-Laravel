<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;

class ImageUploader {
    private $uploadDir;

    public function __construct($uploadDir = 'uploads/') {
        $this->uploadDir = $uploadDir;
    }

    public function uploadImage($file) {
        if(request()->hasFile($file) && request()->file($file)->isValid()) {
            // Get file name
            $fileName = request()->file($file)->getClientOriginalName();
    
            // Store the file to the server
            if (Storage::putFileAs($this->uploadDir, request()->file($file), $fileName)) {
                return "Image uploaded successfully.";
            } else {
                return "Error uploading file.";
            }
        } else {
            return "Invalid request or file not provided.";
        }
    }
    
    
}

?>
