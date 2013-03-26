<?php
if (!isset($_SESSION['attempt_count'])) {
	$_SESSION['attempt_count'] = 0;
}

$page = 'login';
$url = $_SERVER['REQUEST_URI'];
$last_slash = strrpos($url,'/');
$url = ($last_slash === strlen($url)-1) ? '' : substr($url, $last_slash+1);
$question_mark = strrpos($url,'?');
if (false !== $question_mark) {
	$query_parm = substr($url,$question_mark+1);
	$url = substr($url, 0, $question_mark);
} else {
	$query_parm = null;
}
switch($url) {
	case 'auth':
		require _PROTECTED_ . '/controllers/auth.php';
		break;
	case 'index':
		if (isset($_SESSION['logged_in'])) {
			$privileged = (isset($_SESSION['role']) && $_SESSION['role'] == 'privileged');
			$page = 'index';
			require _PROTECTED_ . '/controllers/students.php';
		}
		break;
	case 'logout':
		end_session();
	case '';
		$page = 'login';
		break;
	default: 
		$page = 'error';
		break;
}
