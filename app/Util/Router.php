<?php
    namespace App\Util;

    Class Router
    {
        public $uri;
        public $route;
        public $method;
        private $routes;

        public function __construct() {
            $this->uri = $_SERVER["REQUEST_URI"];
            $this->route = explode("?", $this->uri)[0];
            $this->method = $_SERVER["REQUEST_METHOD"];
        }

        public static function getPath() {
            return $_GET["path"] ?? getcwd();
        }

        public function get($route, $callback) {
            $this->add("get", $route, $callback);
        }

        public function add($method, $route, $callback) {
            return $this->routes[$method][$route] = $callback;
        }

        private function find($method, $route) {
            return $this->routes[strtolower($method)][strtolower($route)] ?? null;
        }

        public function execute() {
            $route_found = self::find($this->method, $this->route);
            if ($route_found == null) {
                http_response_code(404);
                echo "Not found";
                exit;
            }
            return $route_found($this);
        }
    }