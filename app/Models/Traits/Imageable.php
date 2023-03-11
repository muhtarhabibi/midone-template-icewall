<?php

/**
  * Copyright 2018 Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Models\Traits;
use Illuminate\Http\UploadedFile;
use Storage;
use Image;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use Log;
use H;

trait Imageable
{
    protected function ImageOrDefault($image_path, $default_img = null)
    {
        if(!$default_img)
            $default_img = env('DEFAULT_IMAGE_PATH', '');
            
        return $image_path ?? asset($default_img);
    }

    protected function PDFOrDefault($file_path)
    {
        if(empty($file_path)) {
            return '<i class="far fa-file fs-42 disabled"></i>';
        }

        return '<a href="' . $file_path . '" target="_blank"><i class="fas fa-file-pdf fs-42"></i></a>';
    }

    public function saveImage(UploadedFile $image, $field, $dir = null, $width = null, $height = null, $filename = null, $mime_field = null)
    {
        $disk = Storage::disk('public');
        if(isset($width) || isset($height)) {
            $small_image = Image::make($image)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $small_image->getCore()->stripImage();

            if($filename)
                $img_path = $dir .'/'. $filename;
            else
                $img_path = $dir .'/'. hexdec(uniqid()) . "_" . $image->getClientOriginalName();
            $disk->put($img_path, $small_image->stream()->__toString());
        } else {
            if($filename)
                $img_path = $disk->putFileAs($dir, $image, $filename);
            else
                $img_path = $disk->putFile($dir, $image);
        }


        if(!empty($mime_field)) {
            $this->{$mime_field} = $image->getMimeType();
        } else if($this->hasAttribute('mime_type')) {
            $this->mime_type = $image->getMimeType();
        }
        
        
        $this->{$field} = $disk->url($img_path);
    }

    protected function hasAttribute($attr)
    {
        return array_key_exists($attr, $this->attributes);
    }
    
    public function isImage($mime_field = null)
    {
        if(!empty($mime_field)) {
            $mime = $this->{$mime_field};
        } else {
            $mime = $this->mime_type;
        }

        if(!empty($mime) && H::mimeIsImage($mime)) {
            return true;
        }
        
        return false;
    }
}