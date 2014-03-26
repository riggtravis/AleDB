<?php
class Professor extends CI_controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		// Load the professor control center
		// Get the username of the currently logged in user.
		$this->load->helper("cookie");
		$this->load->model("people_model");
		$cookie = get_cookie("username");
		
		// We know that username has to be unique.
		$data['professor'] = $this->people_model->get_user_name($cookie)->result()[0];
		
		// Add a field for the title.
		$data['title'] = $data['professor']->FName . ' ' . $data['professor']->LName;
		$this->load->view("header", $data);
		$this->load->view("professor_control_center", $data);
		// TODO: Load actual information into this area.
		//	Preferably all students under the current professor.
		
		$this->load->view("footer", $data);
	}
	
	public function create_course() {
		// Load the form creation form.
		$data["title"] = "Create Course";
		$this->load->view("header", $data);
		$this->load->view("professor_control_center", $data);
		$this->load->view("create_course", $data);
		$this->load->view("footer", $data);
	}
	
	public function course_validate() {
		// Validate the entry from the course form.
		$this->load->library('form_validation');
		
		// The error types needs to be changed.
		$this->form_validation->set_error_delimiters(
			'<div class="error">', '</div>');
		
		// Set the validation rules
		$this->form_validation->set_rules('department','department',
			'required|max_length[20]|xss_clean');
		$this->form_validation->set_rules('coursenum','coursenum',
			'required|xss_clean');
		
		if($this->form_validation->run()){
			// Add the entry.
			$this->load->model('courses_model');
			$this->courses_model->insert_entry(
				$this->input->post('department'),
				$this->input->post('coursenum')
			);
			
			// Display the courses page.
			$this->view_courses();
		}
		else{
			$data['title'] = 'Create a Course';
			$this->load->view('header', $data);
			$this->load->view('professor_control_center');
			$this->load->view('create_course');
			$this->load->view('footer');
		}
	}
	
	public function view_courses() {
		$this->load->model('courses_model');
		
		// We're going to load the page that shows all of the courses.
		$data['course'] = $this->courses_model->get_all()->result();
		
		// Create a variable to pass to the header that will contain
		//	the title of the page.
		$data['title'] = "Courses";
		$this->load->view('header', $data);
		$this->load->view('professor_control_center', $data);
		$this->load->view('courses', $data);
		$this->load->view('footer');
	}
	
	public function view_course() {
		$this->load->model('courses_model');
		$this->load->model('groups_model');
		$this->load->model('people_model');
		
		// We're going to use these a lot so grab them now.
		// I stashed the course number in the URI earlier.
		$department	= $this->uri->segment(3);
		$coursenum	= $this->uri->segment(4);
		
		// I would be lying to you if I said that there wasn't some
		//	hacking going on beyond this point in the function.
		
		// This time we are only loading one individual course.
		$data['course'] = $this->courses_model->get_courseNum($department, $coursenum);
		if(count($data['course']) != 0){
			$data['course'] = $data['course']->result();
			
			// Now use that course to go and get groups.
			if(count($data['course'])){
				$data['group'] = $this->groups_model->get_course($data['course']->CourseID);
				if($data['group']){
					$data['group']->result();
				}
			}
			else $data['group'] = array();
		}
		
		if(count($data['group'])){
			foreach($data['group'] as $group)
				$data['community_partner'][] = $this->people_model->get_ID($group->CommunityPartner)->result()[0];
			
			// Use that group to get the community partner of the group.
			// We know that there will only be one result.
			$community_partner = $this->people_model->get_ID($data['group']->CommunityPartner);
			
			// Make sure there is something in the database before moving on.
			if($community_partner){
				$community_partner = $community_partner->result()[0];
				$data['community_partner'] = $community_partner->FName . $community_partner->LName;
			}
		}
		
		// This is where the hacking ends.
		
		$data['title'] = $department . $coursenum;
		$this->load->view('header', $data);
		$this->load->view('professor_control_center', $data);
		$this->load->view('course', $data);
		$this->load->view('footer', $data);
	}
	
	public function add_person() {
		// Direct the user to the create user form.
		$data['title'] = "Add Person";
		$this->load->view('login_header', $data);
		$this->load->view('professor_control_center', $data);
		$this->load->view('add_person', $data);
		$this->load->view('footer', $data);
	}

	public function person_validate() {
		// Load the validation library.
		$this->load->library('form_validation');

		// Change the error type.
		$this->form_validation->set_error_delimiters(
			'<div class="error">', '</div>'
		);

		// Set the validation rules.
		$this->form_validation->set_rules('username', 'username',
			'trim|required|max_length[20]|xss_clean|callback_username_check');
		$this->form_validation->set_rules('password', 'password',
			'trim|required|xss_clean');
		
		// Create a rule that forces confirm and password to equal.
		$this->form_validation->set_rules('confirm', 'confirm',
			'trim|required|xss_clean|equals_password['.$this->input->post('password').']');

		$this->form_validation->set_rules('fname', 'fname',
			'trim|required|xss_clean');
		$this->form_validation->set_rules('lname', 'lname',
			'trim|required|xss_clean');

		if($this->form_validation->run()){	
			// Add the new entry.
			$this->load->model('people_model');
			$this->people_model->insert_entry(
				$this->input->post('password'),
				$this->input->post('username'),
				$this->input->post('role'),
				$this->input->post('fname'),
				$this->input->post('lname')
			);
			$this->index();
		}
		else{
			$data['title'] = "Add Person";
			$this->load->view('login_header', $data);
			$this->load->view('professor_control_center', $data);
			$this->load->view('add_person', $data);
			$this->load->view('footer', $data);
		}
	}
	
	public function create_group() {
		// Load needed models
		$this->load->model('people_model');
		$this->load->model('courses_model');
		
		// Get the course info from the URI.
		$department	= $this->uri->segment(3);
		$coursenum	= $this->uri->segment(4);
		
		// Load the create group form.
		//TODO: Look up the create group form in the views.
		//	If it is not there, then:
		//		TODO: Crate the create group form.
		
		// Get all of the community partners from the database.
		$data['partner']	= $this->people_model->get_role(1)->result();
		
		// Get all of courses from the database.
		$data['course']		= $this->courses_model->get_all()->result();
		
		$data['title']		= 'Add a Group';
		
		$this->load->view('header', $data);
		$this->load->view('professor_control_center', $data);
		$this->load->view('create_group', $data);
		$this->load->view('footer', $data);
	}
	
	public function group_validate(){
		// Load the validation helper
		$this->load->library('form_validation');
		
		// Change the error type.
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		// The only needed rule is to make sure the year has been entered. Everything else is a dropdown.
		$this->form_validation->set_rules('year', 'year', 'trim|required|xss_clean');
		
		if($this->form_validation->run()){
			// Add the new entry.
			$this->load->model('groups_model');
			$this->groups_model->insert_entry(
				$this->input->post('partners'),
				$this->input->post('courses'),
				$this->input->post('terms'),
				$this->input->post('year')
			);
		}
		else{
			$this->load->model('people_model');
			$this->load->model('courses_model');
			$data['title']		= "Add Group";
			$data['partner']	= $this->people_model->get_role(1)->result();
			$data['course']		= $this->courses_model->get_all()->result();
			$this->load->view('login_header', $data);
			$this->load->view('professor_control_center', $data);
			$this->load->view('create_group', $data);
			$this->load->view('footer', $data);
		}
	}

	// Create a function to check the username against what's in the database
	public function username_check($str) {
		// This function needs the validation library
		$this->load->library('form_validation');

		// Make sure the user didn't just tab into the next field.
		if($str == 'username'){
			// Create a message to display when the username wasn't filled
			$this->form_validation->set_message('username_check',
				'The %s field cannot be "username."');

			// Return false because the test has failed.
			return FALSE;
		}

		// Check to see if the username is found in the database.
		$this->load->model('people_model');
		if($this->people_model->get_user_name($str)->num_rows != 0){
			$this->form_validation->set_message('username_check',
				'%s is already taken.');
			return FALSE;
		}
		return TRUE;
	}

	public function equals_password($confirm, $password) {
		// Make sure to load the validation library
		$this->load->library('form_validation');

		if ($password != $confirm) {
			$this->form_validation->set_message('equals_password',
				'Passwords must match.');
			return false;
		}

		return true;
	}
};
?>
