<?php
    namespace App\View;

    use App\Util\Router as Router;

    Class Files {
        private static function renderContent($file) {
            return "<pre> <code>" . htmlentities($file) . " </code> </pre>";
        }

        public static function view() {
            $file = file_get_contents(Router::getPath());
            return self::renderContent($file);
        }
    }