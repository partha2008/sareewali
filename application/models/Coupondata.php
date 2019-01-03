<?php
class Coupondata extends CI_Model {

	public function grab_coupon($cond = array(), $like = array(), $limit = array()){
		if(!empty($cond)){
			$this->db->where($cond);			
		}	
		if(!empty($like)){
			$this->db->like($like);
		}
		if(!empty($limit)){
			$per_page = $limit[0];
			$offset = $limit[1];
			$start = max(0, ( $offset -1 ) * $per_page);
			$this->db->limit($per_page, $start);
		}
		$query = $this->db->get(TABLE_COUPON);
		
		return $query->result();
	}
	
	public function insert_coupon($data = array()){

		$this->db->insert(TABLE_COUPON, $data); 
		
		return true;
	}
	
	public function update_coupon($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_COUPON, $data); 
		
		return true;
	}
	
	public function delete_coupon($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_COUPON);
		
		return true;
	}
}