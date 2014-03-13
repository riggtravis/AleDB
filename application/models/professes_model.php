<?php
class ProfessesModel extends CI_Model {
  // Create a function for creating new professes entries.
  function insert_entry($course, $professor) {
    // Use an active record function to insert the relational entity
    $this->db->insert('Professes', array('Course'	=> $course,
					 'Professor'	=> $professor));
  }
  
  // Create a function to get all records from the professes table.
  function get_all() {
    // Return all of the results from professes.
    return $this->db->get('Professes');
  }
  
  // Create a function to search the table based on ID
  function get_ID($id) {
    // Return only the results where ID matches a given ID.
    return $this->db->get_where('Professes', array('ProfessesID' => $id));
  }
  
  // Create a function to search the table based on course
  function get_course($course) {
    return $this->db->get_where('Professes', array('course' => $course);
  }
  
  // Create a function to search the table based on professor
  function get_professor($prof) {
    return $this->db->get_where('Professes', array('Professor' => $prof));
  }
  
  // Create a function for updating a professes relational entity
  function update($id, $course, $prof) {
    // Use an active record to update the professes relational entity
    // Commands can be chained now.
    $this->db->where('ProfessesID', $id)
	     ->update('Professes', array('Course'	=> $course,
					 'Professor'	=> $prof));
  }
  
  // Create a function for deleting a record.
  function delete($id) {
    // Use an active record for deleting a specific professes entity
    $this->db->delete('Professes', array('ProfessesID' => $id));
  }
};
?>