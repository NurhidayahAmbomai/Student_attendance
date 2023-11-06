<?php

class User_model extends CI_Model 
{
    function insertuser($data)
    {
        return $this->db->insert('users', $data);
    }

    function getUserByUsername($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}
