<?php
    namespace App\Controller;

    use App\View\Files as Files;

    Class CodeViewer
    {
        public static function file() {
            return Files::view();
        }
    }