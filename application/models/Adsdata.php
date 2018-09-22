<?php
class Adsdata extends CI_Model {

	public function grab_ads_section($cond = array(), $like = array(), $limit = array(), $order_by = array()){
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
		$query = $this->db->get(TABLE_ADS_SECTION);
		
		return $query->result();
	}

	public function insert_ads_section($data = array()){

		$this->db->insert(TABLE_ADS_SECTION, $data); 
		
		return true;
	}
	
	public function update_ads_section($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_ADS_SECTION, $data); 
		
		return true;
	}
	
	public function delete_ads_section($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_ADS_SECTION);
		
		return true;
	}

	public function grab_ads($cond = array(), $like = array(), $limit = array(), $order_by = array()){
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
		$query = $this->db->get(TABLE_ADS);
		
		return $query->result();
	}
	
	public function insert_ads($data = array()){

		$this->db->insert(TABLE_ADS, $data); 
		
		return true;
	}
	
	public function update_ads($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_ADS, $data); 
		
		return true;
	}
	
	public function delete_ads($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_ADS);
		
		return true;
	}
}
?>