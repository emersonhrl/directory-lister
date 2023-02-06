<?php
    require_once __DIR__ . "/vendor/autoload.php";

    use app\Config\Env as Env;
    use app\Util\Router as Router;
    use app\Controller\DirectoryLister as DirectoryLister;
    use app\Controller\CodeViewer as CodeViewer;
    use app\View\Folders as Folders;

    Env::create(__DIR__);

    $router = new Router;

    $router->get("/", function() {
        $lister = new DirectoryLister();
        echo Folders::page($lister->ls);
    });

    $router->get("/code", function() {
        echo CodeViewer::file();
    });

    $router->execute();