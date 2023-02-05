<?php
    namespace App\Controller;
    
    use App\Model\Directories;

    Class DirectoryLister
    {
        public $ls;

        public function __construct() {
            $directories = new Directories();
            $this->ls = $directories->ls;
        }
    }