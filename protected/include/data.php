<?php
define('NUMBER_OF_STUDENTS',4);

$names = array('One','Two','Three','Four');

$courses = array(
new Course(array('id' => 0, 'name' => 'Math', 'isCore' => true)),
new Course(array('id' => 1, 'name' => 'Social Studies', 'isCore' => false)));

$assignment_scores = array(
array(array('course_id' => 0, 'scores' => array(100,66,85,87)), array('course_id' => 1, 'scores' => array(87,83,92,97))),
array(array('course_id' => 0, 'scores' => array(52,83,75,72)), array('course_id' => 1, 'scores' => array(91,87,85,93))),
array(array('course_id' => 0, 'scores' => array(87,76,75,70)), array('course_id' => 1, 'scores' => array(95,73,84,86))),
array(array('course_id' => 0, 'scores' => array(92,94,97,90)), array('course_id' => 1, 'scores' => array(86,84,89,84))));
