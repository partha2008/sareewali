<?php
class Bannerdata extends CI_Model {

	public function grab_banner($cond = array(), $like = array(), $limit = array()){
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
		$query = $this->db->get(TABLE_BANNER);
		
		return $query->result();
	}
	
	public function insert_banner($data = array()){

		$this->db->insert(TABLE_BANNER, $data); 
		
		return true;
	}
	
	public function update_banner($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_BANNER, $data); 
		
		return true;
	}
	
	public function delete_banner($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_BANNER);
		
		return true;
	}
}