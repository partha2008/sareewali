<?php
class Orderdata extends CI_Model {

	public function grab_order($cond = array(), $like = array(), $limit = array(), $order_by = false){
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
		if($order_by){
			$this->db->order_by('date_added','desc');
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

	public function grab_order_details($cond = array(), $like = array(), $limit = array()){
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
		$query = $this->db->get(TABLE_ORDER_DETAILS);
		
		return $query->result();
	}

	public function fetch_order_list(){
		$sql = "SELECT ".TABLE_ORDER.".orderid, ".TABLE_ORDER.".order_status, ".TABLE_ORDER.".date_added, ".TABLE_ORDER_DETAILS.".order_data FROM ".TABLE_ORDER." INNER JOIN ".TABLE_ORDER_DETAILS." ON ".TABLE_ORDER.".order_id = ".TABLE_ORDER_DETAILS.".order_id WHERE ".TABLE_ORDER.".user_id='".$this->session->userdata('user_id')."' ORDER BY ".TABLE_ORDER.".order_id DESC LIMIT 0, 10";
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
}