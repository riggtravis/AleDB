<?php
class RatingsModel extends CI_Model {
  // Create a function for creating new rating entries.
  function insert_entry($group, $student, $rating, $comments, $release) {
    // Use an active record function to insert the rating
    $this->db->insert('Ratings', array('GroupID'	=> $group,
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
    return $this->db->get_where('Ratings', array('RatingID' => $id));
  }
  
  // Create a function to search the table based on group
  function get_group($group) {
    return $this->db->get_where('Ratings', array('GroupID' => $group);
  }
  
  // Create a function to search the table based on student
  function get_student($student) {
    return $this->db->get_where('Ratings', array('Student' => $student));
  }
  
  // Create a function to search the table based on release date.
  function get_date($date) {
    return $this->db->get_where('Ratings', array('ReleaseDate' => date);
  }
  
  // You might notice that I did not create searches for rating or comments.
  // 	This did not make sense to me. However, it does make sense to me to
  // 	search for grades below or above something. So I created functions
  // 	for these actions.
  
  // Create a function for searching for grades below a certain value.
  function get_score_less_than($value) {
    return $this->db->get_where('Ratings', array('Rating <=' => $value);
  }
  
  // Create a function for searching for grades above a certain value.
  function get_score_more_than($value) {
    return $this->db->get_where('Ratings', array('Rating >=' => $value);
  }
  
  // Create a function for updating a rating for the professor
  function prof_update($id, $group, $student, $release) {
    // Use an active record to update the rating
    // Commands can be chained now.
    $this->db->where('RatingID', $id)
	     ->update('Rating', array('GroupID'		=> $group,
				      'Student'		=> $student,
				      'ReleaseDate'	= $release));
  }
  
  // Create a function for updating a rating for the community partner.
  function cp_update($id, $rating, $comments) {
    $this->db->where('RatingID', $id)
	     ->update('Rating', array('Rating'		=> $rating, 
				      'Comments'	=> $comments));
  }
  
  // Create a function for deleting a record.
  function delete($id) {
    // Use an active record for deleting a specific rating
    $this->db->delete('Professes', array('RatingID' => $id));
  }
};
?>