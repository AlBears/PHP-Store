<?php

namespace App\Classes;

class UploadFile
{
    protected $filemame;
    protected $msx_filesize = 2097152;
    protected $extension;
    protected $path;

    public function getName()
    {
        return $this->filename;
    }

    protected function setName($file, $name = "")
    {
        if($name === "")
        {
            $name = pathinfo($file, PATHINFO_FILENAME);
        }

        $name = strtolower(str_replace(['-', ' '], '-', $name));
        $hash = md5(microtime());
        $ext = $this->fileExtension();

        $this->filename = "{$name}-{$hash}.{$ext}";
    }

    protected function fileExtension($file)
    {
        return $this->extension = pathinfo($file, PATHINFO_EXTENSION);
    }

    public static function fileSize($file)
    {
        $fileObj = new static;
        return $file > $fileObj->max_filesize ? true : false;
    }

    
    /**
     * Validate file upload
     *
     * @param [type] $file
     * @return boolean
     */
    public static function isImage($file)
    {
        $fileObj = new static;
        $ext = $fileObj->fileExtension($file);
        $validExt = array('jpg', 'jpeg', 'png', 'bmp', 'gif');

        if(!in_array(strtolower($ext), $validExt)) {
            return false;
        }

        return true;
    }

    public function path()
    {
        return $this->path;
    }

    /**
     * Move the file to intended location
     *
     * @param [type] $temp_path
     * @param [type] $folder
     * @param [type] $file
     * @param [type] $new_filename
     * @return void
     */
    public static function move($temp_path, $folder, $file, $new_filename)
    {
        $fileObj = new static;
        $ds = DIRECTORY_SEPARATOR;

        $fileObj->setName($file, $new_filename);
        $file_name = $fileObj->getName();

        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }

        $fileObj->path = "{$folder}{$ds}{$file_name}";
        $absolute_path = BASE_PATH."{$ds}public{$ds}$fileObj->path";

        if(move_uploaded_file($temp_path, $absolute_path)){
            return $fileObj;
        }

        return null;
    }


}