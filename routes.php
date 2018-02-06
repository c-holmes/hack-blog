<?php
function CallController($controller, $req, $uri) {
	require_once('controllers/' . $controller . '_controller.php');

	switch($controller) {
		case 'registration':
			$controller = new RegistrationController();
			if ($req === 'GET'){
				$action = 'create';
			} elseif ($req === 'POST'){
				die('aaa');
			}
			break;
		case 'post':
		    require_once('models/post.php');
			$controller = new PostController();
			if ($req === 'GET' && $uri === '/'){
				$action = 'index';
			} elseif ($req === 'GET' && $_GET['id']){
				$action = 'show';
			}
			break;
		default:
			$controller = new PagesController();
			$action = 'error';
			break;
	}

	// call the action
	if(isset($action)){
		$controller->{ $action }();
	} else {
		$controller->{ 'error' }();
	}
}

/**
 * Get Controller by URL
 * Nginx has a rewrite inplace that rewrites url into URL parameter
 * rewrite ^/(.*)$ /index.php?controller=$1;
 */
function GetController(){
	if (isset($_GET['controller'])){
		$controller = $_GET['controller'];
	} else {
		$controller = 'post';
	}

	// Allowed controllers
	$controllers = array('pages','post','registration');

	if (in_array($controller, $controllers)) {
		$req = $_SERVER['REQUEST_METHOD'];
		$uri = $_SERVER["REQUEST_URI"];
		CallController($controller, $req, $uri);
	} else {
		require_once('views/layouts/error.php');
	}
}

GetController();