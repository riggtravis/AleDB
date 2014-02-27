<!--We need to create a table with two fields-->
<table class="table">
	<tr>
		<th>Department</th>
		<th>Course Number</th>
	</tr>
	<!--There will be multiple rows in this based on how many courses
		there are.-->
	<!--Linkify all of the course numbers in order to open the
		group view-->
	<?php $this->load->helper("url"); ?>
	<?php foreach ($course as $c): ?>
		<tr>
			<td>
				<?php
					$department = $c->Department;
					echo $department;
				?>
			</td>
			<td>
				<?php 
				$coursenum = $c->CourseNum;
				echo anchor("professor/view_course/$department/$coursenum", 
					$coursenum)
				?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
