<?php

namespace oorrwullie\components;

use yii;

class getAllRoutes {

    public function __construct() {

	$paths = [];
	$routes = [];

	$modules = Yii::$app->Modules;
	foreach ($modules as $key => $value) {
	    array_push($routes, $key);
	    if ($key !== 'debug' && $key !== 'gii') {
		$class = new \ReflectionClass($value['class']);
		$paths[] = substr($class->getFileName(), 0, strrpos($class->getFileName(), '/')) . '/controllers';
	    }
	}
	array_push($paths, '../controllers');

	foreach ($paths as $path) {
	    $controllerlist = [];
	    if ($handle = scandir($path)) {
		foreach ($handle as $file) {
		    if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
			$controllerlist[] = $file;
		    }
		}
	    }

	    foreach ($controllerlist as $controller) {
		array_push($routes, lcfirst(substr($controller, 0, -14)));
		$handle = fopen($path . '/' . $controller, "r");
		if ($handle) {
		    while (($line = fgets($handle)) !== false) {
			if (preg_match('/public function action(.*?)\(/', $line, $display)) {
			    if (strlen($display[1]) > 2) {
				array_push($routes, strtolower($display[1]));
			    }
			}
		    }
		}
		fclose($handle);
	    }
	}
	$routes = array_unique($routes);

	$this->routes = $routes;
    }
}
