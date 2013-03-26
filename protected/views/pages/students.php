<form action="update" method="post">
<input type="hidden" value="<?php echo $xcsrf ?>" name="X-xcsrf">
<?php foreach ($students as $student) : ?>
<div class="report_card">
	<?php if ($privileged) : ?>
	<form action="update" method="post">
	<input type="hidden" value="<?php echo $xcsrf ?>" name="X-xcsrf">
	<?php endif ?>
	<h3><?php echo htmlentities($student->firstName.' '.$student->lastName) ?></h3>
	<table>
		<tr>
			<th>Course</th>
			<th>Score</th>
			<th>Grade</th>
		</tr>
		<?php 
			$report_card = $student->getReportCard();
			$grades = $report_card->getGrades();	
			foreach ($grades as $course_id => $grade) : $base_name = htmlentities('student['.$student->id.']['.$course_id.']'); ?>
		<tr>
			<td><?php echo (($coreonly && $courses[$course_id]->isCore) ? '*' : '').htmlentities($courses[$course_id]->name) ?><br>
				<?php $course_data = $student->getCourseData($course_id)->getAssignments();
					foreach ($course_data as $k => $cd) :?>
						<span>
						<label class="tiny">Assignment <?php echo $k ?>
						<input type="text" name="<?php echo $base_name.'['.$k.']' ?>" value="<?php echo htmlentities($cd->score) ?>"></label>
						</span>
					<?php endforeach ?>
			</td>
			
			<td><input type="text" name="student[<?php echo htmlentities($student->id) ?>][<?php echo htmlentities($course_id) ?>]" value="<?php echo htmlentities($grade['grade']) ?>" <?php if (!$privileged) : ?>readonly<?php endif ?>>%</td>
			<td><?php echo htmlentities($grade['letter']) ?></td>
		</tr>
		<?php endforeach ?>
		<tr>
			<td colspan="3"><strong>GPA</strong><?php echo ($coreonly) ? htmlentities($report_card->coreGPA) : htmlentities($report_card->GPA) ?></td>
		</tr>
	</table>
	<?php if ($coreonly) : ?>
		<p>GPA reflects core courses only.  Core courses are marked with an asterisk (*).</p>
	<?php endif ?>
</div>
<?php endforeach ?>
<button type="submit" name="save">Save</button>
<button type="reset">Reset</button>
<?php if ($privileged) : ?>
<button type="submit" name="issue">Issue Report Cards</button>
<button type="reset" name="reset">Reset System/Clear Data/Start Over</button>
<?php endif ?>
</form>
