<?php
class StudentCourseData extends Base {

	private $_assignments = array();

	public function __construct($properties) {
		$this->_properties = array(
			'course_id'=>array(
				'required' => true,
				'default' => null,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => PHP_INT_MAX)),
			'isCore' => array(
				'required' => true,
				'default' => true,
				'filter' => FILTER_VALIDATE_BOOLEAN),
			'computedScore' => array(
				'required' => false,
				'default' => 0,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => MAX_SCORE)),
			'assignedScore' => array(
				'required' => false,
				'default' => 0,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => MAX_SCORE)));
		parent::__construct($properties);
		if (!isset($properties['assignedScore'])) {
			$this->assignedScore = null;
		}
		return $this->_data;
	}

	public function addAssignment($assignment) {
		$this->_assignments[$assignment->id] = $assignment;
	}

	public function getAssignments() {
		return $this->_assignments;
	}

	public function assignScore($score) {
		$assignedScore = $this->_properties['assignedScore'];
		$score = filter_var($score,$assignedScore['filter'],$assignedScore['options']);
		if ($score !== false) {
			$this->assignedScore = $score;
		}
	}

	public function __get($property) {
		if ($property === 'score') {
			if ($this->assignedScore !== null) {
				return $this->assignedScore;
			} else {
				return $this->computedScore;
			}
		}
		return parent::__get($property);
	}
	
	public function computeScore() {
		$total = 0;
		$number_of_assignments = count($this->_assignments);
		if ($number_of_assignments !== 0) {
			foreach ($this->_assignments as $assignment) {
				$total += $assignment->score;
			}
			$this->computedScore = $total / $number_of_assignments;
		}
		return $this->computedScore;
	}
}
