<?php
if ($_SESSION['attempt_count'] < ATTEMPT_LIMIT) {
	if (!isset($_SESSION['logged_in'])) {
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$user = new User($_POST['username'], $_POST['password']);
			switch ($user->auth('privileged')) {
				case 'yes':
					$_SESSION['role'] = 'privileged';
				case 'no':
					$_SESSION['logged_in'] = true;
					$_SESSION['username'] = $_POST['username'];
					header('Location:index');
					exit;
					break;
				case false:
					$error = 'Credentials mismatch or permissions issue';
					$_SESSION['attempt_count']++;
					die ($error);
					break;
			}
		} else {
			if ($_SESSION['attempt_count'] > 0) {
				$error = 'You must enter credentials';
				$page = 'login';
			}
		}
	}
} else {
	$page = 'block';
}
