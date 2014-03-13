<div id="topbar">
	<?php $this->load->helper('url'); ?>
	
	<!--create course-->
	<?php echo anchor("professor/create_course", "Create a Course"); ?>
	
	<!--view courses-->
	<?php echo anchor("professor/view_courses", "View Courses"); ?>
	<!--view courses by term-->
	<!--add person-->
	<!--TODO: Add person is needed immediately for other functionality to work.-->
	<?php echo anchor("professor/add_person", "Add a Person"); ?>
	<!--search for person by lastname-->
	<!--search group by partners-->
</div>
