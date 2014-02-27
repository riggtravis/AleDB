<?php
class Login extends CI_Controller {
	// There is something wrong with the extends keyword.
	//	The solution is to include a constructor that explicity says that it is
	//	Based on the constructor of the class that is being extended.
	function __construct() {
		parent::__construct();
	}

	public function index() {
		// Load the login view
		// I changed how the title is entered, so we are going to need a data array to contain the title.
		$data['title'] = 'Login';
		$this->load->view('login_header', $data);
		$this->load->view('login_body');
		$this->load->view('footer');
	}

	// Create a function that checks the username and the mda5 hash of the pwd
	//	against what has been stored in the database.
	public function validate() {
		// What is this even doing?
		// $this->input->post('password');

		// Validate the form
		$this->load->library('form_validation');

		// Change the error types to div tags so that we can change the
		//	colors of the text later.
		$this->form_validation->set_error_delimiters('<div class="error">', 
			'</div>');

		// Set the validation rules
		$this->form_validation->set_rules('username','username',
			'trim|required|max_length[20]|xss_clean|callback_username_check');
		$this->form_validation->set_rules('password','password',
			'required|callback_password_check');
		if($this->form_validation->run()){
			// Check the user's role, and then display the landing page
			// The first step is to use the login function of the
			//	people model
			$this->load->model('people_model');
			
			// Get the posted values of username and password.
			$person = $this->people_model->login($this->input->post('username'), 
				$this->input->post('password'));
			
			// Check to see if the query to the people model
			//	returned anything.
			// If it did not inform the user that the username and password
			//	do not match.
			if(!$person){
				$this->load->view('login_header');
				$this->load->view('login_retry');
				$this->load->view('login_body');
				$this->load->view('footer');
			}
			else{
				// person is an array with only one element.
				$person = $person[0];
				
				// A cookie is best used for logins.
				$this->load->helper('cookie');
				
				// No matter what the role is, they have a username.
				$cookie = array(
					'name'		=> 'username',
					'value'		=> $person->UserName,
					// This value was selected based on the assumption
					//	that expire is measured in seconds. This would
					//	30 minutes.
					'expire'	=> '108000'
				);
				
				// Create the cookie.
				set_cookie($cookie);
				
				// Check the role of the person.
				if($person->Role == 0){
					$this->load->library(
						'../controllers/professor'
					);
					$this->professor->index();
				}
				else if($person->Role == 1){
					$this->load->library(
						'../controllers/community_partner'
					);
					$this->community_partner->index();
				}
			}
		}
		else{
				$this->load->view('login_header');
				$this->load->view('login_body');
				$this->laod->view('footer');
		}
	}

	public function username_check($str) {
		// Load the form validation library because this is a form
		//	validation function.
		$this->load->library('form_validation');

		// Make sure the user didn't just tab into the next field
		if($str == 'username'){
			// Create a message to display when the username was 
			//	not filled
			$this->form_validation->set_message('username_check', 
			'The %s field cannot be "username."');

			// Return false because the test has failed.
			return FALSE;
		}

		// Check to see if the username is found in the database.
		// No else is needed because if the function enters an if branch,
		//	a return statement will be reached.
		$this->load->model('people_model');
		if($this->people_model->get_user_name($str)->num_rows != 1){
			$this->form_validation->set_message('username_check',
			'%s not found.');
			return FALSE;
		}
		return TRUE;
	}

	public function password_check($str) {
		// Load the form validation library because this is a form
		//	validation function.
		$this->load->library('form_validation');

		// Load the security helper to help hash some known values that
		//	might get hashed by the javascript hash function.
		$this->load->helper('security');
		// Make sure the user actually entered something
		if($str == do_hash('', 'md5') 
			|| $str == do_hash('password', 'md5')){
				$this->form_validation->set_message('password_check',
				'The %s field cannot be blank, and must contain a valid password.');

				// Return false because the test has failed.
				return FALSE;
		}
		// Else unnecessary due to return statements.
		return TRUE;
	}
};
?>
