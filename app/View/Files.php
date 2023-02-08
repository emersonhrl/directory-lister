<?php
    namespace app\View;

    use app\Util\Router as Router;

    Class Files {
        private static function renderContent($file, $page) {
            return str_replace("{{content}}", htmlentities($file), $page);
        }

        private static function renderButtons($page) {
            $path = str_replace("/" . basename(Router::getPath()), "", Router::getPath());
            $buttons = "<a href='./?path=" . $path . "'><i class='bi bi-arrow-left'></i></a>";
            $buttons .= "<a href='./download?path=" . Router::getPath() . "'><i class='bi bi-cloud-arrow-down-fill'></i></a>";
            $buttons .= "<a href='./" . Router::getPath() . "'><i class='bi bi-play-fill'></i></a>";

            return str_replace("{{buttons}}", $buttons, $page);
        }

        public static function view() {
            $page = file_get_contents('resources/view/pages/code.html');
            $file = file_get_contents(Router::getPath());
            $rendered_page = self::renderContent($file, $page);
            return self::renderButtons($rendered_page);
        }
    }