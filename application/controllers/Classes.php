<?php

class Classes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Class_model');
    }
    public function create() {
        $data['teacher_id'] = $this->session->userdata('teacher_id');
        $this->load->view('classes/create', $data);
    }

    private function get_logged_in_teacher_id() {
    $teacher_id = $this->session->userdata('teacher_id');
    return $teacher_id;
}

public function store() {
    
    $user = $this->session->userdata('UserLoginSession');
    $teacher_id = isset($user['teacher_id']) ? $user['teacher_id'] : null;

    $data = array(
        'teacher_id' => $teacher_id,
        'class_name' => $this->input->post('class_name'),
        'date'       => $this->input->post('date'),
        'time'       => $this->input->post('time')
    );

    if ($this->Class_model->create_class($data)) {
    } else {
    }
}

    public function index() {
        $teacher_id = $this->session->userdata('teacher_id');

        $data['classes'] = $this->Class_model->get_classes_by_teacher($teacher_id);
        $this->load->view('classes/index', $data);
    }

    public function list_classes() {
    $teacher_id = $this->session->userdata('teacher_id');

    $this->load->model('Class_model');

    $data['classes'] = $this->Class_model->get_classes_by_teacher($teacher_id);

    $this->load->view('classes/list_classes_view', $data);
}

}
