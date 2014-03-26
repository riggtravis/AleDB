<?php
class Groups_model extends CI_Model {
  // Create a function for creating new Group entries.
  function insert_entry($communityPartner, $course, $term, $year) {
    // Use an active record function to insert the Group.
    $this->db->insert('Groups', array(
						'CommunityPartner'		=> $communityPartner, 
						'Course'			=> $course,
						'Term'		 		=> $term,
						'Year'		  		=> $year)
	);
  }
  
  // Create a function to get all records from the Groups table.
  function get_all() {
    // Return all of the results from Groups.
    return $this->db->get('Groups');
  }
  
  // Create a function to search the table based on ID
  function get_ID($id) {
    // Return only the results where ID matches a given ID.
    return $this->db->get_where('Groups', array('GroupID' => $id));
  }
  
  // Create a function to search the table based on CommunityPartner
  function get_community_partner($cp) {
    return $this->db->get_where('Groups', array('CommunityPartner' => $cp));
  }
  
  // Create a function to search the table based on course
  function get_department($course) {
    return $this->db->get_where('Groups', array('Course' => $course));
  }
  
  // Create a function to search the table based on Course
  function get_course($course) {
    return $this->db->get_where('Groups', array('Course' => $course));
  }
  
  // Create a function to search the table based on Term
  function get_term($term){
    return $this->db->get_where('Groups', array('Term' => $term));
  }
  
  // Create a function to search the table based on year.
  function get_year($year) {
    return $this->db->get_where('Groups', array('Year' => $year));
  }
  
  // Create a function to search the table based on year and term.
  function get_term_and_year($term, $year) {
    return $this->db->get_where('Groups', array('Term' => $term, 
						'Year' => $year));
  }
  
  // Create a function for updating a group
  function update($id, $cp, $course, $term, $year) {
    // Use an active record to update the group
    // Commands can be chained now.
    $this->db->where('GrupID', $id)
	     ->update('Groups', array('CommunityPartner' => $cp, 
				      'Course'		 => $course,
				      'Term'		 => $term, 
				      'Year'		 => $year));
  }
  
  // Create a function for deleting a record.
  function delete($id) {
    // Use an active record for deleting a specific group.
    $this->db->delete('Groups', array('GroupID' => $id));
  }
};
?>
