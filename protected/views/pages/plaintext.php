<?php 

foreach ($students as $student) {
	echo str_repeat('-',50).PHP_EOL;
	echo $student->firstName.' '.$student->lastName.PHP_EOL;
	printf ("%30s\t%s\n",'Course','Grade');
	$report_card = $student->getReportCard();
	$grades = $report_card->getGrades();
	foreach ($grades as $course_id => $grade) { 
		printf("%30s\t%s\t%s\n",(($coreonly && $courses[$course_id]->isCore===true)?'*':' ').$courses[$course_id]->name,$grade['grade'],$grade['letter']); 
	}
	echo "\t\t\t\t".'GPA: ';
	echo (($coreonly) ? $report_card->coreGPA : $report_card->GPA).PHP_EOL;
	if ($coreonly) {
		echo 'GPA reflects core courses only.  Core courses are marked with an asterisk (*).'.PHP_EOL;
	}
	echo str_repeat('-',50).PHP_EOL;
	echo PHP_EOL.PHP_EOL;
}
