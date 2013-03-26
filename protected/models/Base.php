<?php
Abstract Class Base {

	protected $_properties = null;
	protected $_data = array();
	protected $_valid = false;
	protected $_error_message = array();

	function __construct($properties = null) {
		if (is_array($properties)) {
			foreach ($this->_properties as $k => $v) {
				if (isset($properties[$k])) {
					$p = $properties[$k];
					if (is_string($p)) {
						$p = trim($p);
						if ($p === "") {
							if (empty($p) && $v['required']) {  // this should never happen
								return null;
							} 
						}
					}
				} else {
					$p = $v['default'];
				}
				$this->_data[$k] = $p;
			}
			$filter = filter_var_array($this->_data,$this->_properties);
			if ($filter === false || in_array(false,$filter,true)) {
				foreach ($filter as $k => $v) {
					if (($v === false) && 
						($this->_properties[$k]['filter'] !== FILTER_VALIDATE_BOOLEAN)) {
						trigger_error('Invalid data');
					}
				}
			}	
		}
		return $this->_data;
	}

	function __get($property) {
		return isset($this->_data[$property]) ? $this->_data[$property] : null;
	}

	function __set($property, $value) {
		$this->_data[$property] = $value;
	}

	function toJson() {
		return json_encode($this->_data);
	}

	function isValid($property = null) {
		if ($property === null)
			return $this->_valid || (count($this->_error_message) == 0);
		else
			return !isset($this->_error_message[$property]);
	}

	function error($property) {
		if (isset($this->_error_message[$property])) {
			return $this->_error_message[$property];
		} else {
			return '';
		}
	}
}
