<?php
    namespace app\Controller;

    use app\Util\Router as Router;

    Class Download
    {
        public static function init() {
            $path = Router::getPath();

            if(file_exists($path)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($path) . '"');
                header('Content-Length: ' . filesize($path));
                header('Pragma: public');
                
                //Clear system output buffer
                flush();
                
                //Read the size of the file
                readfile($path,true);
            }
        }
    }