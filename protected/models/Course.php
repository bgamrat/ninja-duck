<?php
class Course extends Base {

	public function __construct($properties) {
		$this->_properties = array(
			'id'=>array(
				'required' => false,
				'default' => null,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => PHP_INT_MAX)),
			'name' => array(
				'required' => true,
				'default' => null,
				'filter' => FILTER_VALIDATE_REGEXP,
	                        'options' => array('regexp' => '/^[\w\,\.\'\-\(\)\$ ]{3,}$/')),
			'isCore' => array(
				'required' => true,
				'default' => true,
				'filter' => FILTER_VALIDATE_BOOLEAN));

		return parent::__construct($properties);
	}
}
