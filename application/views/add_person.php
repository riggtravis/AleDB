<body>
  <div class="container">
    <?php
      // Load the form helper. It will come in handy.
      $this->load->helper("form");
      
      // Show the validation errors
      echo validation_errors();
      
      // Send the data to a validation function.
      // Add bootstrap information into the attributes parameter.
      echo form_open("professor/person_validate", array('class' => 'form-horizontal', 'role' => 'form'));
      
      $username = array(
        'username'  => 'username',
        'id'        => 'username',
        'value'     => set_value('username'),
        'name'      => 'username',
        'maxlength' => '20',
	'class'	    => 'form-control'
      );
      
      // Yeah. We're definitely going to need the login header.
      $password = array(
        'password'  => 'password',
        'id'        => 'password',
        'value'     => set_value('password'),
        'name'      => 'password',
	'class'	    => 'form-control'
      );
      
      $confirm = array(
        'confirm'   => 'confirm',
        'id'        => 'confirm',
        'value'     => set_value('confirm'),
        'name'      => 'confirm',
	'class'	    => 'form-control'
      );
      
      $fname = array(
        'fname'     => 'fname',
        'id'        => 'fname',
        'value'     => set_value('Firt Name'),
        'name'      => 'fname',
        'maxlength' => '18',
	'class'	    => 'form-control'
      );
      
      $lname = array(
        'lname'     => 'lname',
        'id'        => 'lname',
        'value'     => set_value('Last Name'),
        'name'      => 'lname',
        'maxlength' => '18',
	'class'	    => 'form-control'
      );
      
      $role = array(
        'role'      => 'role',
        'id'        => 'role',
        'value'     => '2',
        'name'      => 'role',
        'maxlength' => '1',
	'class'	    => 'form-control'
      );
    ?>
    <div class='form-group'>
	    <?php
	      // Add labels to all of the inputs using the form helper label function.
	      echo form_label('Username', 'username', array('class' => 'col-sm-1 col-md-1 col-lg-1'));
	    ?>
	    <div class='col-sm-1 col-md-1 col-lg-1'>
	      <?php
					echo form_input($username);
	      ?>
	    </div>
		</div>
		<div class='form-group'>
	    <?php
	      echo form_label('Password', 'password', array('class' => 'col-sm-1 col-md-1 col-lg-1'));
	    ?>
	    <div class='col-sm-1 col-md-1 col-lg-1'>
	      <?php
					echo form_password($password);
	      ?>
	    </div>
	  </div>
	  <div class='form-group'>
	    <?php
	      echo form_label('Confirm', 'confirm', array('class' => 'col-sm-1 col-md-1 col-lg-1'));
	    ?>
	    <div class='col-sm-1 col-md-1 col-lg-1'>
	      <?php
					echo form_password($confirm);
	      ?>
	    </div>
	  </div>
	  <div class='form-group'>
	    <?php
	      echo form_label('Firstname', 'fname', array('class' => 'col-sm-1 col-md-1 col-lg-1'));
	    ?>
	    <div class='col-sm-1 col-md-1 col-lg-1'>
	      <?php
					echo form_input($fname);
	      ?>
	    </div>
	  </div>
	  <div class='form-group'>
	    <?php
	      echo form_label('Lastname', 'lname', array('class' => 'col-sm-1 col-md-1 col-lg-1'));
	    ?>
	    <div class='col-sm-1 col-md-1 col-lg-1'>
	      <?php
					echo form_input($lname);
	      ?>
	    </div>
	  </div>
    <?php
      
      $roles = array(
        0 => "Professor",
        1 => "Community Partner",
        2 => "Student"
      );
    ?>
    <div class='form-group'>
	    <?php
	      echo form_label('Role', 'role', array('class' => 'col-sm-1 col-md-1 col-lg-1'));
	    ?>
	    <div class='col-sm-1 col-md-1 col-lg-1'>
	      <?php
					echo form_dropdown('role', $roles, 'Student');
	      ?>
	    </div>
    </div>
    <?php
      $js = 'onClick="hash()"';
    ?>
    <div class='form-group'>
	    <?php
	      echo form_label('submit', 'submit', array('class' => 'col-sm-1 col-md-1 col-lg-1'));
	      echo form_submit('submit', 'Go', $js);
	    ?>
    </div>
    <?php
      echo form_close();
    ?>
  </div>
