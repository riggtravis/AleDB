<?php

	// Load the form helper.
	$this->load->helper("form")

	echo validation_errors();

	echo form_open("professor/validate_ratings");
	
	// Any one of these three changes should result in the correct student.
	//	Username should take first priority, then name, then id.
	$name = array(
		'name'	=> 'name',
		'id'	=> 'name',
		'value'	=> set_value('name')
	);
	
	$id = array(
		'name'	=> 'id',
		'id'	=> 'id',
		'value'	=> set_value('id')
	);
	
	$username = array(
		'username'	=> 'username',
		'name'		=> 'username',
		'id'		=> 'username',
		'value'		=> set_value('username'),
		'maxlength'	=> '20'
	);
	
	$submit = array(
		'submit'	=> 'submit',
		'name'		=> 'submit',
		'id'		=> 'username',
		'value'		=> 'Go'
	);
	
	echo form_input($name);
	echo form_input($id);
	echo form_input($username);
	echo form_submit($submit);
?>