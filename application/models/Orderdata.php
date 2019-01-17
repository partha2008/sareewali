<?php
class Orderdata extends CI_Model {

	public function grab_order($cond = array(), $like = array(), $limit = array()){
		if(!empty($cond)){
			$this->db->where($cond);			
		}	
		if(!empty($like)){
			$this->db->or_like($like);
		}
		if(!empty($limit)){
			$per_page = $limit[0];
			$offset = $limit[1];
			$start = max(0, ( $offset -1 ) * $per_page);
			$this->db->limit($per_page, $start);
		}
		$query = $this->db->get(TABLE_ORDER);
		
		return $query->result();
	}
	
	public function insert_order($data = array()){

		$this->db->insert(TABLE_ORDER, $data); 
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
	public function update_order($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_ORDER, $data); 
		
		return true;
	}
	
	public function delete_order($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_ORDER);
		
		return true;
	}

	public function insert_order_details($data = array()){

		$this->db->insert(TABLE_ORDER_DETAILS, $data); 
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
}