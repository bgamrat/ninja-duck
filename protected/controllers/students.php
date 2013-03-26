<?php

require _INCLUDE_ . '/data.php';
require _CONFIGS_ . '/constants.php';

$students = array();
if (is_file(_DATA_FILE_)) {
	$students = unserialize(file_get_contents(_DATA_FILE_));
} else {
	for ($i = 0; $i < NUMBER_OF_STUDENTS; $i++) {
		$id = $i + 1;
		$students[$id] = new Student(array('id' => $id, 'firstName' => 'Student', 'lastName' => $names[$i]));
		foreach ($assignment_scores[$i] as $course_scores) {
			$course_data = new StudentCourseData(array(
				'course_id' => $course_scores['course_id'], 'isCore' => $courses[$course_scores['course_id']]->isCore));
			foreach ($course_scores['scores'] as $k => $score) {
				$assignment = new Assignment(array('id' => $k, 'score' => $score));
				$course_data->addAssignment($assignment);
			}
			$students[$id]->addCourseData($course_data);
		}
		$students[$id]->createReportCard();
	}
}

if (isset($_POST) && !empty($_POST)) {
	if ($_POST['action'] !== 'start_over') {
		$coreonly = isset($_POST['coreonly']);
		foreach ($_POST['student'] as $k => $v) {
			$id = $k;
			if (isset($students[$id])) {
				foreach ($v as $kk => $vv) {
					foreach ($vv['score'] as $kkk => $vvv) {
						$assignment = new Assignment(array('id' => $kkk, 'score' => $vvv));
						$students[$id]->getCourseData($kk)->addAssignment($assignment);
					}
					if ($vv['assigned_grade'] !== $vv['existing_grade']) {
						$students[$id]->getCourseData($kk)->assignScore($vv['assigned_grade']);
					}
				}
				$students[$id]->createReportCard();
			}
		}		
	}
	switch ($_POST['action']) {
		case 'save':
			file_put_contents(_DATA_FILE_, serialize($students));
			break;
		case 'issue_report_cards':
			foreach ($students as $student) {
				$student->getReportCard()->issue();
			}
			file_put_contents(_DATA_FILE_, serialize($students));
			break;
		case 'start_over':
			unlink(_DATA_FILE_);
			header('Location: index');
			exit;
			break;
	}
}
