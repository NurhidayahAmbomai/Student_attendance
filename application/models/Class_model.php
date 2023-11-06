<?php

class Class_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load database library
        $this->load->database();
    }

    public function create_class($data) {
    	 if ($this->db->insert('classes', $data)) {
        return true; // Data inserted successfully
    } else {
        // Debugging: Print out database errors
        var_dump($this->db->error());
        die(); // Halt the script to see the output
        return false; // Failed to insert data
    }
    }

    public function get_classes_by_teacher($teacher_id) {
        $this->db->select('*');
        $this->db->from('classes');
        $this->db->where('teacher_id', $teacher_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    

    public function update_class($class_id, $data) {
        $this->db->where('id', $class_id);
        return $this->db->update('classes', $data);
    }

    public function delete_class($class_id) {
        $this->db->where('id', $class_id);
        return $this->db->delete('classes');
    }
}
