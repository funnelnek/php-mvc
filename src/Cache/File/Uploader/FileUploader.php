<?php

declare(strict_types=1);

namespace Funnelnek\Cache\File\Uploader;

use Funnelnek\Configuration\Constant\Settings;

class FileUploader
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: http://127.0.0.1:5501");
        if (!empty($_FILES['file'])) {
            $this->filename = $_FILES['file']['name'];
            $this->temp = $_FILES['file']['tmp_name'];
            $this->fileUpName = time() . '-' . $this->filename;
        }
    }

    private string $filename;
    private string $temp;
    private string $fileUpName;

    public function upload()
    {
        if (!empty($this->filename)) {
            $storage = Settings::FILE_STORAGE . '/' . $this->fileUpName;
            move_uploaded_file($this->temp, $storage);
        }
    }
}
