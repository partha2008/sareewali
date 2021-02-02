<?php
class Seodata extends CI_Model {

	public function grab_seo($cond = array(), $like = array(), $limit = array(), $order_by = array()){
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
		if(!empty($order_by)){
			foreach($order_by as $key => $val){
				$this->db->order_by($key, $val);	
			}
		}	
		$query = $this->db->get(TABLE_SEO);
		
		return $query->result();
	}

	public function insert_seo($data = array()){

		$this->db->insert(TABLE_SEO, $data); 
		
		return true;
	}
	
	public function update_seo($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_SEO, $data); 
		
		return true;
	}
}
?>