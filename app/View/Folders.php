<?php
    namespace App\View;

    use App\Util\Router as Router;

    Class Folders {
        private static function openAs($extension) {
            $extensions = array_map("trim", explode(",", str_replace(array("[", "]", "'", "\""), "", $_ENV["VIEW_FILES_AS_CODE"])));
            if (in_array($extension, $extensions)) {
                return "/code?path=";
            }
        }

        private static function renderContent($page, $ls) {
            $content = "";
            foreach ($ls as $files) {
                switch ($files["type"]) {
                    case "folder":
                        $name = $files["name"] . "/";
                        $icon = "folder-fill";
                        $path = "/?path=" . $files["path"];
                        break;
                    case "file":
                        $name = $files["name"];
                        $extension = explode(".", $files["name"]);
                        $icon = "filetype-" . $extension[1];
                        $path = self::openAs($extension[1]) . $files["path"];
                }
                $content .= "<a class='line' href='" . $path . "'>";                                
                    $content .= "<div class='name'>";
                        $content .= "<i class='bi bi-" . $icon . "'></i>";
                        $content .= $name;
                    $content .= "</div>";
                    $content .= "<div class='size'>" . $files["size"] . "</div>";
                    $content .= "<div class='date'>" . $files["date"] . "</div>";
                $content .= "</a>";
            }

            return str_replace("{{content}}", $content, $page);
        }

        private static function renderButton($page) {
            $path = Router::getPath();
            $button = "<a href='/'><i class='bi bi-house-fill'></i></a>";

            if ($path != getcwd()) {
                $folder = "";
                $folders = explode("/", $path);
                for ($f = 0; $f < count($folders); $f++) {
                    $folder .= ($f > 0 ? "/" : "");
                    $folder .= $folders[$f];
                    $button .= "<a href='?path=" . $folder . "'>" . $folders[$f] . "</a>";
                }
            }
            return str_replace("{{button}}", $button, $page);
        }   

        public static function page($ls = []) {
            $page = file_get_contents('resources/view/pages/lister.html');
            $rendered_page = self::renderContent($page, $ls);
            return self::renderButton($rendered_page);  
        }
    }