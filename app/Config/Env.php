<?php
    namespace App\Config;

    Class Env
    {
        private static function load($dir, $server = false, $unsafe = false) {
            $fileEnv = file_get_contents($dir."/.env");
            $lines = array_filter(explode("\n", $fileEnv));
            foreach ($lines as $line) {
                $variable = explode("=", $line);
                $name = $variable[0];
                $value = $variable[1];
                $_ENV[$name] = $value;
                if ($server)
                    $_SERVER[$name] = $value;
                if ($unsafe)
                    putenv($line);
            }
        }
        public static function create($dir, $server = false, $unsafe = false) {
            Env::load($dir, $server, $unsafe);
        }
    }
?>