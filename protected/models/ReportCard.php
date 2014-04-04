<?php
class ReportCard extends Base {

	private $_grades = array();

	public function __construct($properties = null) {
		$this->_properties = array(
			'student_id'=>array(
				'required' => false,
				'default' => null,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => PHP_INT_MAX)),
			'issued' => array(
				'required' => false,
				'default' => false,
				'filter' => FILTER_VALIDATE_BOOLEAN),
			'GPA' => array(
				'required' => false,
				'default' => 0,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => MAX_GPA)),
			'coreGPA' => array(
				'required' => false,
				'default' => 0,
				'filter' => FILTER_VALIDATE_INT,
				'options' => array('min_range' => 0, 'max_range' => MAX_GPA)));
		// Check for existing report card, load it if it exists
		// Set existing flag
		return parent::__construct($properties);
	}

	public function getGrades() {
		return $this->_grades;
	}

	public function setGrade($course_id, $isCore, $score) {
		global $GRADES, $GRADING_SCALE;
		$grade = floor($score);
                foreach ($GRADES as $min => $letter) {
                    if ($grade >= $min) {
                        $letter_grade = $letter;
                        break;
                    }
                }
                
		$this->_grades[$course_id] = array('grade' => $grade, 
			'letter' => $letter_grade,
			'isCore' => $isCore);
	}

	public function addGrade($course_id,$grade,$isCore) {
		$this->setGrade($course_id,$grade,$isCore);
	}

	public function updateGrade($course_id,$grade,$isCore) {
		if (isset($this->_grades[$course_id])) {
			$this->setGrade($course_id,$grade,$isCore);
		}
	}
	
	public function computeGPA() {
		if ($this->issued) return;
		global $GPA_MAP;
		$total = $total_core = 0;
		$number_of_grades = count($this->_grades);
		$number_of_core_grades = 0;
		foreach ($this->_grades as $grade) {
			$gpa_grade = $GPA_MAP[$grade['letter']];
			if ($grade['isCore'] === true) {
				$total_core += $gpa_grade;
				$number_of_core_grades++;
			}
			$total += $gpa_grade;
		}
		$this->GPA = sprintf('%6.2f',$total / $number_of_grades);
		if ($number_of_core_grades > 0) {
			$this->coreGPA = sprintf('%6.2f',$total_core / $number_of_core_grades);
		} else {
			$this->coreGPA = 'N/A';
		}
	}

	public function issue() {
		$this->issued = true;
	}
}	
