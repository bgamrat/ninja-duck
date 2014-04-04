<?php
if (defined('_CONSTANTS_')) return;
define('_CONSTANTS_',true);

define('MAX_GPA',4.6);
define('MAX_SCORE', 110);

// GRADING SCALES
$GRADING_SCALE = array(
	'A' => array('min' => 90, 'max' => 100, 'gpa' => 4.0),
	'B' => array('min' => 80, 'max' => 89, 'gpa' => 3.0),
	'C' => array('min' => 70, 'max' => 79, 'gpa' => 2.0),
	'D' => array('min' => 60, 'max' => 69, 'gpa' => 1.0),
	'F' => array('min' => 0, 'max' => 59, 'gpa' => 0.0),
	);

$GPA_MAP = array('A' => 4, 'B' => 3, 'C' => 2, 'D' => 1, 'F' => 0);

$GRADES = array(90 => 'A', 80 => 'B', 70 => 'C', 60 => 'D', 0 => 'F');
