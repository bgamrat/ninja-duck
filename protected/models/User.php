<?php
class User {
	const UNAUTHORIZED = 'unauthorized';

	private $_users = array ('principal' => 'privileged', 'guidance' => 'privileged', 'teacher' => '');
	private $_role = self::UNAUTHORIZED;

	public function __construct($userid, $password) {
		if (isset($this->_users[$userid])) {
			$this->_role = $this->_users[$userid];
		} else {
			$this->_role = self::UNAUTHORIZED;
		}
	}

	public function auth($role) {
		return ($this->_role === self::UNAUTHORIZED) ? false : (($this->_role === $role) ? 'yes' : 'no');
	}
}
