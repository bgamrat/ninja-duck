<?php
class Student extends Base {

	private $_course_data = array();
	private $_report_card = null;

	public function __construct($properties) {
		$this->_course_data = null;
		$this->_report_card = null;

		$this->_properties = array(
			'id'=>array(
				'required' => false,
				'default' => null,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => PHP_INT_MAX)),
			'firstName' => array(
				'required' => true,
				'default' => null,
				'filter' => FILTER_VALIDATE_REGEXP,
	                        'options' => array('regexp' => '/^[\w\,\.\'\-\(\)\$ ]{3,}$/')),
			'lastName' => array(
				'required' => true,
				'default' => null,
				'filter' => FILTER_VALIDATE_REGEXP,
	                        'options' => array('regexp' => '/^[\w\,\.\'\-\(\)\$ ]{3,}$/')));
		return parent::__construct($properties);
	}

	public function getCourseData($course_id) {
		return $this->_course_data[$course_id];
	}

	public function addCourseData($course_data) {
		$this->_course_data[$course_data->course_id] = $course_data;
	}

	public function removeCourseData($course_id) {
		unset($this->_course_data[$course_id]);
	}

	public function createReportCard() {
		foreach ($this->_course_data as $k => $course_data) {
			$this->_course_data[$k]->computeScore();
		}
		if ($this->_report_card === null) {
			$report_card = new ReportCard();
		} else {
			$report_card = $this->_report_card;
		}
		foreach ($this->_course_data as $course_data) {
			$report_card->addGrade($course_data->course_id, $course_data->isCore, $course_data->score);
		}
		$report_card->computeGPA();
		$this->_report_card = $report_card;
		return $this->_report_card;
	}

	public function getReportCard() {
		return $this->_report_card;
	}
}
