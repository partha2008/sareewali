<?php
class Reviewdata extends CI_Model {

	public function grab_review($cond = array(), $like = array(), $limit = array()){
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
		$query = $this->db->get(TABLE_REVIEW);
		
		return $query->result();
	}

	public function grab_review_user_list($cond = array()){	
		$this->db->select('*')
        	->from(TABLE_REVIEW)
         	->join(TABLE_USER, TABLE_REVIEW.'.email = '.TABLE_USER.'.email')
         	->where($cond);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function insert_review($data = array()){

		$this->db->insert(TABLE_REVIEW, $data); 
		
		return true;
	}
	
	public function update_review($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_REVIEW, $data); 
		
		return true;
	}
	
	public function delete_review($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_REVIEW);
		
		return true;
	}
}