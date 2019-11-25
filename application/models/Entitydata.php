<?php
class Entitydata extends CI_Model {
	
	public function grab_entity($cond = array(), $like = array(), $limit = array(), $order_by = array()){
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
		}else{
			$this->db->order_by('date_added','desc');	
		}	

		$query = $this->db->get(TABLE_ENTITY);
		
		return $query->result();
	}

	public function grab_random_entity($cond = array(), $limit = array()){
		if(!empty($cond)){
			$this->db->where($cond);
		}	
		if(!empty($limit)){
			$per_page = $limit[0];
			$offset = $limit[1];
			$start = max(0, ( $offset -1 ) * $per_page);
			$this->db->limit($per_page, $start);
		}
		$this->db->order_by('rand()');	

		$query = $this->db->get(TABLE_ENTITY);
		
		return $query->result();
	}

	public function grab_random_product_entity($cond = array(), $limit = array()){
		if(!empty($cond)){
			$this->db->where($cond);
		}	
		if(!empty($limit)){
			$per_page = $limit[0];
			$offset = $limit[1];
			$start = max(0, ( $offset -1 ) * $per_page);
			$this->db->limit($per_page, $start);
		}
		$this->db->order_by('rand()');	

		$query = $this->db->get(TABLE_PRODUCT_ENTITY);
		
		return $query->result();
	}
	
	public function insert_entity($data = array()){

		$this->db->insert(TABLE_ENTITY, $data); 
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
	public function update_entity($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_ENTITY, $data); 
		
		return true;
	}
	
	public function delete_entity($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_ENTITY);
		
		return true;
	}

	public function insert_entity_attribute($data = array()){

		$this->db->insert(TABLE_ENTITY_ATTRIBUTE, $data); 
		
		return true;
	}

	public function delete_entity_attribute($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_ENTITY_ATTRIBUTE);
		
		return true;
	}

	public function grab_attr($cond = array(), $like = array(), $limit = array()){
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
		$query = $this->db->get(TABLE_ATTR);
		
		return $query->result();
	}

	public function insert_attr($data = array()){

		$this->db->insert(TABLE_ATTR, $data); 
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	public function grab_entity_attribute($entity_id){	
		$sql = "SELECT ".TABLE_ATTR.".attr_id, ".TABLE_ATTR.".name FROM ".TABLE_ATTR." INNER JOIN ".TABLE_ENTITY_ATTRIBUTE." ON ".TABLE_ATTR.".attr_id = ".TABLE_ENTITY_ATTRIBUTE.".attr_id WHERE ".TABLE_ENTITY_ATTRIBUTE.".entity_id=".$entity_id;
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
}