<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Attendance_model');
    }

    public function check_in() {
        $user_session_data = $this->session->userdata('UserLoginSession');
        if ($user_session_data !== null && isset($user_session_data['teacher_id'])) {
        $teacher_id = $user_session_data['teacher_id'];
        echo "Logged-in Teacher ID: " . $teacher_id;
    } else {
     redirect('login');
        return;
    }

    $this->load->model('Class_model');
    $classes = $this->Class_model->get_classes_by_teacher($teacher_id);
    $class_id = $this->input->post('class_id');
        $data['class_id'] = $class_id ? $class_id : '';
        $data['students'] = array();
        if ($class_id) {
            $class_belongs_to_teacher = false;
            foreach ($classes as $class) {
                if ($class['class_id'] == $class_id && $class['teacher_id'] == $teacher_id) {
                    $class_belongs_to_teacher = true;
                    break;
                }
            }
            
            if ($class_belongs_to_teacher) {
                $students = $this->Attendance_model->get_students_by_class($class_id);
                $data['students'] = $students;
            } else {
            }
        }
        
        $data['classes'] = $classes; // Pass classes for the dropdown
        $this->load->view('attendance/check_in', $data);
    }

    public function store() {
        $attendance_data = $this->input->post('attendance');
        $class_id = $this->input->post('class_id');
        
        foreach ($attendance_data as $student_id => $status) {
            $record = array(
                'student_id' => $student_id,
                'class_id' => $class_id,
                'status' => $status,
                'date' => date('Y-m-d') // Current date
            );
            $this->Attendance_model->add_record($record);
        }

         $this->session->set_flashdata('success', 'Attendance submitted successfully.');
        redirect('attendance/check_in');
    }
}
