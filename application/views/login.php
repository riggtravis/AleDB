  <body>
  <!-- Load the form helper -->
  <?php
    $this->load->helper('form');
    
    // This is to display any errors that were encountered when the data
    //	was entered
    echo validation_errors();
    
    // This form is for the login.
    echo form_open('login/validate');
    
    // We need to get the user name and the password.
    // Set the maximum length for the username to what it is in the database.
    $username = array(
      'username'	=> 'username',
      'id'			=> 'username',
      'value'		=> set_value('username'),
      'name'		=> 'username',
      'maxlength'	=> '20'
    );
    echo form_input($username);
    
    // We also need to store an ID for the password for later.
    $password = array(
	  'password'	=> 'password',
	  'id'			=> 'password',
	  'value'		=> 'password',
	  'name'		=> 'password'
	);
    echo form_password($password);
    
    // Make sure that when the button is clicked the hash function is
    //	performed.
    $js = 'onClick="hash()"';
    echo form_submit('submit', 'Go', $js);
    echo form_close();
  ?>
  </body>
</html>
