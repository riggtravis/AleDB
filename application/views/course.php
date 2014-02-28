<!--create a table for the groups.-->
<div class="container">
	<table class="table">
		<tr>
			<th>GroupID</th>
			<th>Community Partner</th>
			<th>Course</th>
			<th>Term</th>
			<th>Year</th>
		</tr>
		<tr>
			<?php $loopcounter = 0;?>
			<?php foreach ($group as $g): ?>
				<td>
					<?php echo $g->GroupID; ?>
				</td>
				<td>
					<?php
						echo $community_partner[$loopcounter];
						$loopcounter = $loopcounter + 1;
					?>
				</td>
				<td>
					<!--We don't need to load up the course. That's already the
						title of the page-->
					<?php echo $g->Term; ?>
				</td>
				<td>
					<?php echo $g->Year; ?>
				</td>
			<?php endforeach; ?>
		</tr>
	</table>
	<!--Create a link for adding groups.-->
	<?php
		$this->load->helper('url');
		$department = $this->uri->segment(3);
		$coursenum	= $this->uri->segment(4);
		echo anchor("pofessor/create_group/$department/$coursenum", "Create a Group");
	?>
</div>
