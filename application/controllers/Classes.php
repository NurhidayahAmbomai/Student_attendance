<?php

class Classes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Class_model');
        // Ensure user is authenticated, etc.
    }

    // Display form for creating a new class
    public function create() {
        $data['teacher_id'] = $this->session->userdata('teacher_id');
        $this->load->view('classes/create', $data);
    }

    private function get_logged_in_teacher_id() {
    // For example, if you're storing the user's info in session
    $teacher_id = $this->session->userdata('teacher_id');
    return $teacher_id;
}

    // Store a new class in the database
    // Store a new class in the database
public function store() {
    // Retrieve the teacher_id from the session
    $user = $this->session->userdata('UserLoginSession');
    $teacher_id = isset($user['teacher_id']) ? $user['teacher_id'] : null;

    // Prepare the data array for insertion
    $data = array(
        'teacher_id' => $teacher_id,
        'class_name' => $this->input->post('class_name'),
        'date'       => $this->input->post('date'),
        'time'       => $this->input->post('time')
    );

    // Insert the data into the database
    if ($this->Class_model->create_class($data)) {
        // Redirect to a success page or show a success message
        // e.g., redirect('classes/index');
    } else {
        // Handle the error case
    }
}


    // Display classes for the logged-in teacher
    public function index() {
        $teacher_id = $this->session->userdata('teacher_id');

        $data['classes'] = $this->Class_model->get_classes_by_teacher($teacher_id);
        $this->load->view('classes/index', $data);
    }

    // Other methods for updating, deleting, etc.
}
