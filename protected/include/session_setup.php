<?php

session_start();

if (isset($_POST['X-xcsrf']) && isset($_SESSION['xcsrf'])) {
	if ($_POST['X-xcsrf'] !== $_SESSION['xcsrf']) {
		unset($_POST);
	}
}

/* XCSRF handling */
$xcsrf = bin2hex(openssl_random_pseudo_bytes(16));
header('X-xcsrf: '.$xcsrf);
function shutdown($xcsrf) {
	$_SESSION['xcsrf'] = $xcsrf;
}
register_shutdown_function('shutdown',$xcsrf);
/* /XCSRF handling */

/* User error handling */
function error_handler($errno,$errstr,$errfile,$errline,$errcontext=null) {
		echo 'USER['.$errno.']: '.$errstr.' '.$errfile.'('.$errline.')';
	error_log('USER['.$errno.']: '.$errstr.' '.$errfile.'('.$errline.')');
	die();
}
set_error_handler('error_handler',E_USER_ERROR|E_USER_WARNING|E_USER_NOTICE);
/* /User error handling */

/* Utility functions */
function end_session() {
	// Unset all of the session variables.
	$_SESSION = array();

	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
	        	$params["secure"], $params["httponly"]
		);
	}

	// Finally, destroy the session.
	session_destroy();
}
/* /Utility function */
