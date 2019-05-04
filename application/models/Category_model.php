<?php

class Category_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get category by id
     */
    function get_category($id)
    {
        return $this->db->get_where('categories',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all categories count
     */
    function get_all_categories_count()
    {
        $this->db->from('categories');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all categories
     */
    function get_all_categories($params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('categories')->result_array();
    }
        
    /*
     * function to add new category
     */
    function add_category($params)
    {
        $this->db->insert('categories',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update category
     */
    function update_category($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('categories',$params);
    }
    
    /*
     * function to delete category
     */
    function delete_category($id)
    {
        return $this->db->delete('categories',array('id'=>$id));
    }
}
