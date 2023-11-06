<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('home');
	}

	function register()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('userType', 'User Type', 'required');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $userType = $this->input->post('userType');
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $data = array(
                'username' => $username,
                'password' => $hashed_password,
                'user_type' => $userType
            );

            $this->load->model('user_model');
            $this->user_model->insertuser($data); 
            $this->session->set_flashdata('success','Successfully User Created');
            redirect(base_url('welcome/index'));
        }
        else
        {
            echo validation_errors();
        }
    }
}

function login()
{
	$this->load->view('login');
}

function loginnow()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == TRUE)
        {
            $username = $this->input->post('username'); // Changed from 'email' to 'username'
            $password = $this->input->post('password');

            $this->load->model('user_model');
            $user = $this->user_model->getUserByUsername($username);

            if ($user != false && password_verify($password, $user->password))
            {
                $session_data = array(
                    'username' => $username,
                    'user_type' => $user->user_type,
                    'teacher_id' => $user->id
                );

                $this->session->set_userdata('UserLoginSession', $session_data);

                if ($user->user_type == 'teacher')
                {
                	redirect(base_url('welcome/teacher_dashboard'));
                } elseif ($user->user_type == 'student') {
                	redirect(base_url('welcome/student_dashboard'));
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Username or password is wrong');
                redirect(base_url('welcome/login'));
            }
        } 
        else
        {
            $this->session->set_flashdata('error', 'Fill all the required fields');
            redirect(base_url('welcome/login'));
        }
    }
}

	function teacher_dashboard()
	{
		$user = $this->session->userdata('UserLoginSession');
		if ($user && $user['user_type'] == 'teacher') {
			$this->load->view('teacher_dashboard');
		} else {
			redirect(base_url('welcome/login'));
		}
		
	}

	function student_dashboard()
	{
		$user = $this->session->userdata('UserLoginSession');
		if ($user && $user['user_type'] == 'student') {
			$this->load->view('student_dashboard');
		}

		else {
			redirect(base_url('welcome/login'));
		}
	}

}
