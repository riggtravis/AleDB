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
		$this->load->view("professor_control_center");
		$this->load->view("footer");
	}
	
	public function create_course() {
		// Load the form creation form.
		$data["title"] = "Create Course";
		$this->load->view("header", $data);
		$this->load->view("professor_control_center");
		$this->load->view("create_course");
		$this->load->view("footer");
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
		$this->load->view('course', $data);
		$this->load->view('footer', $data);
	}
	
	public function create_group() {
		// Get the course info from the URI.
		$department	= $this->uri->segment(3);
		$coursenum	= $this->uri->segment(4);
	}
};
?>
