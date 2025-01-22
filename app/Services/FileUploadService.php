<?php

namespace App\Services;

use Illuminate\Http\Request;

class FileUploadService
{
    /**
     * Handle the logo file upload.
     *
     * @param Request $request
     * @param string $inputName
     * @param string $directory
     * @return string
     */
    public function uploadFile(Request $request, string $inputName, string $directory): string
    {
        $fileExtension = $request->file($inputName)->getClientOriginalExtension();
        $fileName = $directory . '_' . now()->format('YmdHis') . '.' . $fileExtension;
        $path = $request->file($inputName)->storeAs($directory, $fileName, 'public');

        return 'storage/' . $path;
    }
}
