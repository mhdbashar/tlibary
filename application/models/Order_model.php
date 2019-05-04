<?php
 
class Order_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get order by id
     */
    function get_order($id)
    {
        return $this->db->get_where('orders',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all orders count
     */
    function get_all_orders_count()
    {
        $this->db->from('orders');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all orders
     */
    function get_all_orders($params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('orders')->result_array();
    }
        
    /*
     * function to add new order
     */
    function add_order($params)
    {
        $this->db->insert('orders',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update order
     */
    function update_order($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('orders',$params);
    }
    
    /*
     * function to delete order
     */
    function delete_order($id)
    {
        return $this->db->delete('orders',array('id'=>$id));
    }
}
