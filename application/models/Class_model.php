<?php

class Class_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create_class($data) {
    if ($this->db->insert('classes', $data)) {
        return true;
    } else {
        var_dump($this->db->error());
        die(); 
        return false; 
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
