<div class="container">
	<?php
		// Load the form helper. This is mainly a form.
		$this->load->helper("form");
		
		// Show the validation errors
		echo validation_errors();
		
		// We're going to validate this data because we have certain
		//	requirements the data must meet.
		echo form_open("professor/course_validate");
		
		echo form_label('Department', 'department');
		$department = array(
			'department'	=> 'department',
			'id'			=> 'department',
			'value'			=> set_value('department'),
			'name'			=> 'department',
			'maxlength'		=> '5'
		);
		echo form_input($department);
		
		echo form_label('Course Number', 'coursenum');
		$coursenum = array(
			'coursenum'		=> 'coursenum',
			'id'			=> 'coursenum',
			'value'			=> set_value('000'),
			'name'			=> 'coursenum',
		);
		echo form_input($coursenum);
		echo form_submit('submit', 'Go');
		echo form_close();
	?>
</div>
