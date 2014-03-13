<div class="container">
  <!-- Load the form helper -->
  <?php
  $this->load->helper('form');
  
  // This is to display any errors that were encountered when the data
  //	was entered
  echo validation_errors();
  
  // This form is for the login.
  // Add bootstrap information.
  echo form_open('login/validate', array('class' => 'form-horizontal', 'role' => 'form'));
  
  // We need to get the user name and the password.
  // Set the maximum length for the username to what it is in the database.
  $username = array(
    'username'	=> 'username',
    'id'			  => 'username',
    'value'		  => set_value('username'),
    'name'		  => 'username',
    'maxlength'	=> '20'
  );
  
  // Add a label before the input.
  echo form_label('Username', 'username');
  echo form_input($username);
  
  // We also need to store an ID for the password for later.
  $password = array(
    'password'	=> 'password',
    'id'			  => 'password',
    'value'		  => set_value('password'),
    'name'		  => 'password'
  );
  
  // Add a label before the input
  echo form_label('Password', 'password');
  echo form_password($password);
  
  // Make sure that when the button is clicked the hash function is
  //	performed.
  $js = 'onClick="hash()"';
  echo form_submit('submit', 'Go', $js);
  echo form_close();
  ?>
</div>
