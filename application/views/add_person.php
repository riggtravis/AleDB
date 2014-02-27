<body>
  <?php
    // Load the form helper. It will come in handy.
    $this->load->helper("form");
    
    // Show the validation errors();
    echo validation_errors();
    
    // Send the data to a validation function.
    echo form_open("professor/person_validate");
    
    $username = array(
      'username'  => 'username',
      'id'        => 'username',
      'value'     => set_value('username'),
      'name'      => 'username',
      'maxlength' => '20'
    );
    
    // Yeah. We're definitely going to need the login header.
    $password = array(
      'password'  => 'password',
      'id'        => 'password',
      'value'     => set_value('username'),
      'name'      => 'username'
    );
    
    $fname = array(
      'fname'     => 'fname',
      'id'        => 'fname',
      'value'     => set_value('Firt Name'),
      'name'      => 'fname',
      'maxlength' => '18'
    );
    
    $lname = array(
      'lname'     => 'lname',
      'id'        => 'lname',
      'value'     => set_value('Last Name'),
      'name'      => 'lname',
      'maxlength' => '18'
    );
    
    $role = array(
      'role'      => 'role',
      'id'        => 'role',
      'value'     => '2',
      'name'      => 'role',
      'maxlength' => '1'
    );
    
    echo form_input($username);
    echo form_password($password);
    echo form_input($fname);
    echo form_input($lname);
    
    $roles = array(
      0 => "Professor",
      1 => "Community Partner",
      2 => "Student"
    );
    
    echo form_dropdown('role', $roles, 'Student');
    
    $js = 'onClick="hash()"';
    echo form_submit('submit', 'Go', $js);
    echo form_close();
  ?>