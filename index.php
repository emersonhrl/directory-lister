<?php
    require_once __DIR__ . "/vendor/autoload.php";

    use App\Config\Env as Env;
    use App\Util\Router as Router;
    use App\Controller\DirectoryLister as DirectoryLister;
    use App\Controller\CodeViewer as CodeViewer;
    use App\View\Folders as Folders;

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