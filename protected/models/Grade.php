<?php
class Grade extends Base {

	public function __construct($properties) {
		$this->_properties = array(
			'course_id'=>array(
				'required' => true,
				'default' => null,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => PHP_INT_MAX)),
			'computedGrade' => array(
				'required' => true,
				'default' => 0,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => 110)),
			'assignedGrade' => array(
				'required' => false,
				'default' => null,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => 110)),
			'letterGrade' => array(
				'required' => false,
				'default' => null,
				'filter' => FILTER_VALIDATE_REGEX,
				'options' => array('regexp' => '/^[A-DF]$/')));

		return parent::_construct($properties);
	}

	public function assignGrade($grade) {
		if (filter_var($grade,
			$this->_properties['assigned_grade']['filter'],
			$this->_properties['assigned_grade']['options']) !== false) {
			$this->assignedGrade = $grade;
		}
	}
}
