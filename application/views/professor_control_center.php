<div class="navbar navbar-default navbar-static-top" >
	<div class="container">
		<?php $this->load->helper('url'); ?>
		
		<!--create course-->
		<?php 
			echo anchor(
				"professor/create_course", 
				"Create a Course",
				array('class' => 'btn btn-default', 'role' => 'button')
			); 
		?>
		
		<!--view courses-->
		<?php 
			echo anchor(
				"professor/view_courses", 
				"View Courses",
				array('class' => 'btn btn-default', 'role' => 'button')
			); 
		?>
		
		<!--view courses by term-->
		<!--add person-->
		<!--TODO: Add person is needed immediately for other functionality to work.-->
		<?php 
			echo anchor(
				"professor/add_person", 
				"Add a Person",
				array('class' => 'btn btn-default', 'role' => 'button')
			); 
		?>
		<!--search for person by lastname-->
		<!--search group by partners-->
	</div>
</div>
