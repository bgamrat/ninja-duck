<div class="column">
<form action="index" method="post">
<input type="hidden" value="<?php echo $xcsrf ?>" name="X-xcsrf">
<?php if (isset($_POST['action']) && ($_POST['action'] == "compute")) :?>
	<p class="warning">Grades have <strong>NOT</strong> been saved</p>
<?php endif ?>
<div id="buttons">
<button type="submit" name="action" value="compute">Compute</button>
<button type="submit" name="action" value="save">Save</button>
<button type="reset">Reset</button>
<?php if ($privileged) : ?>
<button type="submit" name="action" value="issue_report_cards">Issue Report Cards</button>
<button name="action" value="start_over">Reset System/Clear Data/Start Over</button>
<?php endif ?>
<label class="small"><input type="checkbox" name="coreonly" class="small"<?php if (isset($_POST['coreonly'])) echo ' checked' ?>>Compute GPA with core courses only</label>
</div>
<?php foreach ($students as $student) : ?>
<div class="report_card">
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
		<tr<?php if ($report_card->issued) echo ' class="issued"' ?>>
			<td><?php echo (($coreonly && $courses[$course_id]->isCore) ? '*' : '').htmlentities($courses[$course_id]->name) ?><br>
				<?php $course_data = $student->getCourseData($course_id); $assignments = $course_data->getAssignments();
					foreach ($assignments as $k => $a) :?>
						<span>
						<label class="tiny">Assignment <?php echo $k+1 ?>
						<input type="text" name="<?php echo $base_name.'[score]['.$k.']' ?>" value="<?php echo htmlentities($a->score) ?>">
						</label>
						</span>
					<?php endforeach ?>
					<span>
						<label class="tiny">Computed Score
						<input type="text" value="<?php echo htmlentities($course_data->computedScore) ?>" readonly>
						</label>
					</span>
			</td>
			
			<td>
				<input type="text" name="<?php echo $base_name ?>[assigned_grade]" value="<?php echo htmlentities($grade['grade']) ?>" <?php if (!$privileged) : ?>readonly<?php endif ?>>%
				<input type="hidden" name="<?php echo $base_name ?>[existing_grade]" value="<?php echo htmlentities($grade['grade']) ?>" readonly>
			</td>
			<td><?php echo htmlentities($grade['letter']) ?></td>
		</tr>
		<?php endforeach ?>
		<tr>
			<td colspan="3"><strong>GPA</strong><?php echo ($coreonly) ? htmlentities($report_card->coreGPA) : htmlentities($report_card->GPA) ?></td>
		</tr>
	</table>
	<?php if ($coreonly) : ?>
		<p class="small">GPA reflects core courses only.  Core courses are marked with an asterisk (*).</p>
	<?php endif ?>
</div>
<?php endforeach ?>
</form>
</div>
<div class="column">
<h4>Notes</h4>
<dl>
<dt>Principal and Guidance</dt>
<dd>The principal and guidance personnel can override all grades, except the computed score for a course.  Changes to assignment scores do not affect the report card score and grade if the report card has been issued.  They can also issue the report cards.  Issuing saves the data.</dd>
<dt>Teachers</dt>
<dd>Teachers can modify assignment grades, when they click Save, the course score will be recomputed.  If the report card has been issued, changes to assignment grades will not affect it.</dd>
<dt>Issued report cards</dt>
<dd>If the report card has been issued, the score and grade are <span class="issued">bolded and blue</span>.</dd>
</dl>
</div>
