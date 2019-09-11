<?php
/**
 * FileManager version 0.1
 * it helps uploading files
 *
 * todo:
 * 1. need check if a file is image or not.
 */
namespace App\Helpers;

use Storage;

class FileManager {

    private $file;
    private $fileEdited;
    private $fileProperties;
    private $path;
    private $storageType; // public, s3
    private $isUniqueName;

    function __construct($file, $path='', $storageType='public', $isUniqueName=false) {
        $this->file = $file;
        $this->path = $path;
        $this->storageType = $storageType;
        $this->isUniqueName = $isUniqueName;

        $this->fileProperties = $this->generateFileProperties();

        // print_r($this->fileProperties);
    }

    public function upload() {
        $filename = $this->isUniqueName ? $this->makeUniqueName($this->fileProperties['original_name'], $this->fileProperties['extension']) : $this->fileProperties['original_name'];
        $dir = ($this->path ? $this->path . '/' : '') . $filename;

        switch ($this->storageType) {
            case 's3':
                return $this->uploadToS3($dir, $filename);
            case 'public':
                return $this->uploadToPublic($dir, $filename);
            default:
                throw new \Exception('Unsupported storage type');
        }
    }

    public function edit($fn) {
        $file = clone $this->file;
        $this->fileEdited = $fn($file);
    }

    private function generateFileProperties() {
        $file = $this->file;
        if (is_object($file)) {

            switch (get_class($file)) {
                // File based on the laravel file class.
                case 'Illuminate\Http\UploadedFile':
                    return $this->extractFilePropertiesFromLaravelFileClass($file);
                default: 
                    return [];
            }

        } else {

            // File based on base64
            if ($matches = $this->getMimeTypeFromBase64($file)) {
                $extension = $matches[2] === 'jpeg' ?  'jpg' : $matches[2];

                return [
                    'mime' => $matches[1],
                    'original_name' => microtime() . '.' . $extension,
                    'extension' => $extension,
                    // 'size' => null
                ];
            }
        }

        throw new \Exception('Unregistered file type');
    }

    private function uploadToS3($dir, $filename) {
        $this->put('s3', $dir);

        return [
            'file' => $this->file,
            'uploaded_file_information' => [
                'storage' => 's3',
                'mime' => $this->fileProperties['mime'],
                'extension' => $this->fileProperties['extension'],
                'original_filename' => $this->fileProperties['original_name'],
                'directory' => $dir,
                'filename' => $filename,
                'filesize' => Storage::disk('s3')->size($dir)
            ]
        ];
    }

    private function uploadToPublic($dir, $filename) {
        // Directory: storage/app/public/
        $this->put('public', $dir);

        return [
            'file' => $this->file,
            'uploaded_file_information' => [
                'storage' => 'local',
                'mime' => $this->fileProperties['mime'],
                'extension' => $this->fileProperties['extension'],
                'original_filename' => $this->fileProperties['original_name'],
                'directory' => 'storage/app/public/' . $dir,
                'filename' => $filename,
                'filesize' => Storage::disk('public')->size($dir)
            ]
        ];
    }

    private function put($disk, $dir) {
        if ($this->fileEdited) {
            Storage::disk($disk)->put($dir, $this->fileEdited);
        } else {
            Storage::disk($disk)->put($dir, file_get_contents($this->file));
        }
        
    }

    private function makeUniqueName($fileName, $fileExtension) {
        return md5($fileName.microtime()) . '.' . $fileExtension;
    }

    private function getMimeTypeFromBase64($stringBase64) {
        preg_match('/^data:(\w+\/(\w+));/', $stringBase64, $matches);
        return $matches;
    }

    private function extractFilePropertiesFromLaravelFileClass($fileClass) {
        return [
            'mime' => $fileClass->getMimeType(),
            'original_name' => $fileClass->getClientOriginalName(),
            'extension' => $fileClass->getClientOriginalExtension(),
            // 'size' => $fileClass->getClientSize()
        ];
    }

    private function extractFilePropertiesFromInvention($fileClass) {
        return [
            'mime' => $fileClass->mime(),
            'original_name' => $fileClass->getClientOriginalName(),
            'extension' => $fileClass->getClientOriginalExtension(),
            // 'size' => $fileClass->filesize()
        ];   
    }
}