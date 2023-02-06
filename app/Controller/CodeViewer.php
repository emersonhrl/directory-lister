<?php
    namespace app\Controller;

    use app\View\Files as Files;

    Class CodeViewer
    {
        public static function file() {
            return Files::view();
        }
    }