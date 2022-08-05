<?php

namespace Core;

class Uploader
{
    private $file;
    public $name;

    public function __construct($file)
    {
        $this->file =  $file;
    }

    public function upload($path): bool
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
        $name = $this->file['name'];

        if(!is_dir($path))
            mkdir($path);

        if(move_uploaded_file($this->file["tmp_name"],$path.'/' . time() . $name)) {
            $this->name = time() .$name;
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    public function delete($path)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $path;

        unlink($path.'/' . $this->file);

        if (count(scandir($path)) === 2) {
            rmdir($path);
        }
    }
}
