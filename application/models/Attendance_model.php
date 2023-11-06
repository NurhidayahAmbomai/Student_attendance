<?php

class Attendance_model extends CI_Model {

    public function get_students_by_class($class_id) {
         $query = $this->db->get_where('students', array('class_id' => $class_id));
    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return array(); // Return an empty array instead of null
    }
    }

    public function add_record($record) {
        return $this->db->insert('attendance', $record);
    }
    
    // Other methods for handling attendance data
}
