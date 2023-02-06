<?php
    namespace app\Controller;
    
    use app\Model\Directories;

    Class DirectoryLister
    {
        public $ls;

        public function __construct() {
            $directories = new Directories();
            $this->ls = $directories->ls;
        }
    }