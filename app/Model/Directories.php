<?php
    namespace App\Model;

    use App\Util\Router as Router;

    Class Directories
    {
        public $ls;
        
        public function __construct() {
            $path = Router::getPath();

            if ($path == getcwd()) {
                $list = array_diff(
                    preg_grep("/^([^.])/", scandir($path)),
                    ['.', '..', 'app', 'resources', 'vendor', 'index.php']
                );
            } else {
                $list = array_diff(
                    preg_grep("/^([^.])/", scandir($path)),
                    ['.', '..']
                );
            }

            $folders = array();
            $files = array();

            foreach ($list as $file) {
                $path_file = $path . "/" . $file;
                $path_link = str_replace(getcwd() . "/", "", $path_file);

                if (is_dir($path_file)) {
                    $folders[] = array(
                        "type" => "folder",
                        "name" => $file,
                        "size" => "-",
                        "date" => date("Y-m-d H:i:s", filemtime($path_file)),
                        "path" => $path_link
                    );
                } else {
                    $files[] = array(
                        "type" => "file",
                        "name" => $file,
                        "size" => number_format(filesize($path_file), 0, ',', '.') . " bytes",
                        "date" => date("Y-m-d H:i:s", filemtime($path_file)),
                        "path" => $path_link
                    );
                }
            }

            $this->ls = array_merge($folders, $files);
        }
    }