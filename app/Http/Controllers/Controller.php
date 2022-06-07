<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function fileUploadHandler($image, $filePath)
    {
        $finalImage = null;

        $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        $imageNewName = $fileName."-".time().".".$image->getClientOriginalExtension();

        $image->move($filePath, $imageNewName);
        $finalImage = $imageNewName;

        return $finalImage;
    }
}
