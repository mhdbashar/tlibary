<?php
 
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get user by id
     */
    function get_user($id)
    {
        return $this->db->get_where('users',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all users count
     */
    function get_all_users_count()
    {
        $this->db->from('users');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all users
     */
    function get_all_users($params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('users')->result_array();
    }
        
    /*
     * Get user by email
     */
    public function get_by_email($email)
    {   
  
        $this->db->from('users');
        $this->db->where('email', $email);

        $query = $this->db->get();

        $row=$query->row();
         if(isset($row))
         return $query->row();

         return false;
    }

    /*
     * function to add new user
     */
    function add_user($params)
    {
        $this->db->insert('users',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update user
     */
    function update_user($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('users',$params);
    }
    
    /*
     * function to delete user
     */
    function delete_user($id)
    {
        return $this->db->delete('users',array('id'=>$id));
    }
}
