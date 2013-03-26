<?php
class Assignment extends Base {

	public function __construct($properties) {
		$this->_properties = array(
			'id'=>array(
				'required' => false,
				'default' => null,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => PHP_INT_MAX)),
			'score'=>array(
				'required' => false,
				'default' => null,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => MAX_SCORE)));
		return parent::__construct($properties);
	}
}
