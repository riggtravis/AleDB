<?php
class Courses_model extends CI_Model {
  // Create a function for creating new course entries.
  function insert_entry($department, $courseNum) {
    // Use an active record function to insert the course.
    $this->db->insert('Courses', array('Department'	=> $department, 
				       'CourseNum'	=> $courseNum));
  }
  
  // Create a function to get all records from the courses table.
  function get_all() {
    // Return all of the results from Courses.
    return $this->db->get('Courses');
  }
  
  // Create a function to search the table based on ID
  function get_ID($id) {
    // Return only the results where ID matches a given ID.
    return $this->db->get_where('Courses', array('CourseID' => $id));
  }
  
  // Create a function to search the table based on Department
  function get_department($department) {
    return $this->db->get_where('Courses', array('Department' => $department));
  }
  
  // Create a function to search the table based on CourseNum
  function get_courseNum($courseNum) {
    return $this->db->get_where('Courses', array('CourseNum' => $courseNum));
  }
  
  // Create a function to search the table for a specific course
  function get_course($department, $coursenum) {
	  return $this->db->get_where('Courses', array(
		'Department' => $department, 
		'courseNum' => $coursenum)
	);
  }
  
  // Create a function for updating a course
  function update($id, $department, $courseNum) {
    // Use an active record to update the course
    // Commands can be chained now.
    $this->db->where('CourseID', $id)
	     ->update('Courses', array('Department'	=> $department, 
				       'CourseNum'	=> $courseNum));
  }
  
  // Create a function for deleting a record.
  function delete($id) {
    // Use an active record for deleting a specific course.
    $this->db->delete('Courses', array('CourseID' => $id));
  }
};
?>
