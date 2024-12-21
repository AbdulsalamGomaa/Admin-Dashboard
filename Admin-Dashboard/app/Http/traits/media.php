<?php

namespace App\Http\traits;

trait media {

    public function uploadImage($image,$folder) {

        $imageName = uniqid() . '.' . $image->extension();
        $image->move(public_path('/dist/img/'.$folder),$imageName);
        return $imageName;
    }

    public function deleteImage($imagePath) {

        if(file_exists($imagePath)) {
            unlink($imagePath);
            return true;
        }
        return false;
    }
}
