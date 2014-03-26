<?php
	// Start by loading the form helper.
	$this->load->helper('form');
	
	echo form_open('professor/group_validate/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	
	// The department and course number have already been loaded via
	//	the controller.
	
	// The Community Partners will all have to be loaded into a
	//	drop down menu.
	foreach($partner as $p){
		$p_options[$p->PersonID] = $p->FName . ' ' . $p->LName;
	}
	
	// Get a key value from $p_options
	echo form_dropdown('partners', $p_options, key($p_option));
	
	// Do the same for the courses.
	foreach($course as $c){
		$c_options[$c->CourseID] = $c->Department . ' ' . $c->CourseNum;
	}
	echo form_dropdown('courses', $c_options, key($c_options));
	
	// Term should be a drop down.
	$term = array(
		'spring'	=> 'Spring',
		'summer1'	=> 'Summer I',
		'summer2'	=> 'Summer II',
		'summer'	=> 'Summer',
		'fall'		=> 'Fall'
	);
	echo form_dropdown('terms', $term, 'spring');
	
	// Year should be input by hand.
	$year = array(
		'year'		=> 'year',
		'name'		=> 'year',
		'id'		=> 'year',
		'value'		=> set_value('year'),
		'maxlength'	=> '4'
	);
	echo form_input($year)
	
	// Need us a submit button.
	$data = array(
		'submit'	=> 'submit',
		'name'		=> 'submit',
		'id'		=> 'submit'
	);
	echo form_button($submit);
	
	// We're done here.
	echo form_close();
?>
