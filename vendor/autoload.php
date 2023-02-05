<?php
	spl_autoload_register(function($className) {
		$className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

		$class = __DIR__ . "/../" . $className . ".php";

		is_file($class) AND require_once $class;
	});
?>