<?php
class People_model extends CI_Model {
  // Create a function for creating new People entries.
  function insert_entry($login_hash, $user_name, $role, $f_name, $l_name) {
    // Use an active record function to insert the People.
    $this->db->insert('People', array('LoginHash'	=> $login_hash,
				      'UserName'	=> $user_name,
				      'Role'		=> $role,
				      'FName'		=> $f_name,
				      'LName'		=> $l_name));
  }
  
  // Create a function to get all records from the People table.
  function get_all() {
    // Return all of the results from People.
    return $this->db->get('People');
  }
  
  // Create a function to search the table based on ID
  function get_ID($id) {
    // Return only the results where ID matches a given ID.
    return $this->db->get_where('People', array('PersonID' => $id));
  }
  
  // Create a function to search the table based on user name
  function get_user_name($un) {
    return $this->db->get_where('People', array('UserName' => $un));
  }
  
  // Create a function to search the table based on role
  function get_role($role) {
    return $this->db->get_where('People', array('Role' => $role));
  }
  
  // Create a function to search the table based on first name
  function get_first_name($fn){
    return $this->db->get_where('People', array('FName' => $fn));
  }
  
  // Create a function to search the table based on last name.
  function get_last_name($ln) {
    return $this->db->get_where('People', array('LName' => $ln));
  }
  
  // Create a function to search the table based on full name
  // I did last name, first name because usually when you use a comma it is
  // 	with the last name first.
  function get_full_name($ln, $fn) {
    return $this->db->get_where('People', array('FName' => $fn, 
						'LName' => $ln));
  }
  
  // Create a function for updating a person
  function update($id, $lh, $un, $role, $fn, $ln) {
    // Use an active record to update the person
    // Commands can be chained now.
    $this->db->where('PersonID', $id)
	     ->update('People', array('LoginHash'	=> $lh,
				      'UserName'	=> $un,
				      'Role'		=> $role,
				      'FName'		=> $fn,
				      'LName'		=> $ln));
  }
  
  // Create a function for deleting a record.
  function delete($id) {
    // Use an active record for deleting a specific person.
    $this->db->delete('People', array('PeronID' => $id));
  }
  
  // The following code was inspired by a code snippet at http://www.codefactorycr.com/login-with-codeigniter-php.html
  function login($username, $password){
	  $query = $this->db->get_where('People', 
		array('UserName'	=> $username,
			  'LoginHash'	=> $password)
	  );
	  if($query->num_rows() != 1) return FALSE;
	  
	  // Else unecessary due to return statements.
	  return $query->result();
  }
};
?>
