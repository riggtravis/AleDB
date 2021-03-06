<div class="container">
	<?php
		// Load the form helper. This is mainly a form.
		$this->load->helper("form");
		
		// Show the validation errors
		echo validation_errors();
		
		// We're going to validate this data because we have certain
		//	requirements the data must meet.
		// Add the bootstrap information
		echo form_open("professor/course_validate", array('class' => 'form-horizontal', 'role' => 'form'));
	?>
	<div class="form-group">
		<?php
			echo form_label(
				'Department', 
				'department',
				array('class' => 'col-sm-1 col-md-1 col-lg-1 control-label')
			);
		?>
		<div class = 'col-sm-2 col-md-2 col-lg-2'>
			<?php
				$department = array(
					'department'	=> 'department',
					'id'			=> 'department',
					'value'			=> set_value('department'),
					'name'			=> 'department',
					'maxlength'		=> '5',
					'class'	=> 'form-control'
				);
				echo form_input($department);	
			?>
		</div>
	</div>
	<div class="form-group">
		<?php
			echo form_label(
				'Course Number', 
				'coursenum',
				array('class' => 'col-sm-1 col-md-1 col-lg-1 control-label')
			);
		?>
		<div class="col-sm-2 col-md-2 col-lg-2">
			<?php
				$coursenum = array(
					'coursenum'		=> 'coursenum',
					'id'			=> 'coursenum',
					'value'			=> set_value('000'),
					'name'			=> 'coursenum',
					'class' => 'form-control'
				);
				echo form_input($coursenum);
			?>
		</div>
	</div>
	<div class="form-group">
		<?php
			echo form_label(
				'Submit',
				'submit',
				array('class' => 'col-sm-1 col-md-1 col-lg-1 control-label')
			);
		?>
		<div class = 'col-sm-1 col-md-1 col-lg-1'>
			<?php
				$go = array(
					'submit'	=> 'submit',
					'id'		=> 'submit',
					'name'		=> 'submit',
					'value'		=> 'Go',
					'class' => 'form-control'
				);
				echo form_submit($go);
			?>
		<div>
	</div>
	<?php
		echo form_close();
	?>
</div>
