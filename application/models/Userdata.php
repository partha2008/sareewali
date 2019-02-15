<?php
class Userdata extends CI_Model {

	public function grab_backend_user_details($cond = array(), $limit = array(), $like = array(), $where = null){
		if(!empty($cond)){
			$this->db->where($cond);			
		}
		if($where){
			$this->db->where($where);	
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
		$query = $this->db->get(TABLE_ADMIN);
		
		return $query->result();
	}

	public function update_backend_user_details($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_ADMIN, $data); 
		
		return true;
	}
	
	public function grab_user_details($cond = array(), $limit = array(), $like = array(), $where = null){
		if(!empty($cond)){
			$this->db->where($cond);			
		}
		if($where){
			$this->db->where($where);	
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
		$this->db->order_by('date_added','desc');
		$query = $this->db->get(TABLE_USER);
		
		return $query->result();
	}
	
	public function insert_user($data = array()){

		$this->db->insert(TABLE_USER, $data); 
		
		return $this->db->insert_id();;
	}
	
	public function update_user_details($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_USER, $data); 
		
		return true;
	}
	
	public function update_settings_details($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_SETTINGS, $data); 
		
		return true;
	}
	
	public function delete_user($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_USER);
		
		return true;
	}
	
	public function get_cms_content($cond = array()){
		if(!empty($cond)){
			$this->db->where($cond);
		}
		
		$query = $this->db->get(TABLE_CMS);
        $result = $query->result();
		
		return $result[0];
	}
	
	public function update_cms_content($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_CMS, $data); 
		
		return true;
	}

	public function get_newsletter($cond = array(), $limit = array(), $like = array(), $where = null){
		if(!empty($cond)){
			$this->db->where($cond);			
		}
		if($where){
			$this->db->where($where);	
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
		$query = $this->db->get(TABLE_NEWLETTER);
		
		return $query->result();
	}

	public function insert_newsletter($data = array()){

		$this->db->insert(TABLE_NEWLETTER, $data); 
		
		return true;
	}

	public function update_newsletter($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_NEWLETTER, $data); 
		
		return true;
	}

	public function insert_wishlist($data = array()){

		$this->db->insert(TABLE_WISHLIST, $data); 
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	public function grab_wishlist($cond = array(), $like = array(), $limit = array(), $order_by = array()){
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
		$query = $this->db->get(TABLE_WISHLIST);
		
		return $query->result();
	}

	public function grab_product_wishlist_list($start, $perpage){	
		$sql = "SELECT ".TABLE_PRODUCT.".product_id, ".TABLE_PRODUCT.".prd_dic_chk, ".TABLE_PRODUCT.".discounted_price, ".TABLE_PRODUCT.".slug, ".TABLE_PRODUCT.".name as prd_name, ".TABLE_PRODUCT.".price, ".TABLE_PRODUCT_IMAGES.".name as prd_img_name FROM ".TABLE_PRODUCT." INNER JOIN ".TABLE_PRODUCT_IMAGES." ON ".TABLE_PRODUCT.".product_id = ".TABLE_PRODUCT_IMAGES.".product_id INNER JOIN ".TABLE_WISHLIST." ON ".TABLE_PRODUCT.".product_id = ".TABLE_WISHLIST.".product_id  WHERE ".TABLE_WISHLIST.".user_id='".$this->session->userdata('user_id')."' AND ".TABLE_PRODUCT_IMAGES.".status='Y' AND ".TABLE_PRODUCT_IMAGES.".is_featured='Y' ORDER BY ".TABLE_WISHLIST.".date_added LIMIT ".$start.", ".$perpage;
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}

	public function delete_wishlist($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_WISHLIST);
		
		return true;
	}
}