<?php
class Productdata extends CI_Model {
	
	public function grab_product($cond = array(), $like = array(), $limit = array()){
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
		$this->db->order_by('date_added','desc');		
		$query = $this->db->get(TABLE_PRODUCT);
		
		return $query->result();
	}

	public function grab_product_list_all($entity, $start, $perpage, $order_by = null, $where=null, $join=null){	
		if(!$order_by){
			//$order_by = TABLE_PRODUCT.".date_added DESC";
			$order_by = "RAND()";
		}

		$sql = "SELECT  ".TABLE_PRODUCT.".prd_dis_amt, ".TABLE_PRODUCT.".prd_dis_mode, ".TABLE_PRODUCT.".product_id, ".TABLE_PRODUCT.".prd_dic_chk, ".TABLE_PRODUCT.".discounted_price, ".TABLE_PRODUCT.".slug, ".TABLE_PRODUCT.".name as prd_name, ".TABLE_PRODUCT.".price, ".TABLE_PRODUCT_IMAGES.".name as prd_img_name,"
			."(CASE WHEN ".TABLE_PRODUCT.".product_id IN (
				SELECT ".TABLE_PRODUCT.".product_id from ".TABLE_PRODUCT."
				INNER JOIN ".TABLE_PRODUCT_ENTITY." ON ".TABLE_PRODUCT.".product_id = ".TABLE_PRODUCT_ENTITY.".product_id 
				INNER JOIN ".TABLE_ENTITY." ON ".TABLE_PRODUCT_ENTITY.".entity_id = ".TABLE_ENTITY.".entity_id  
				WHERE ".TABLE_ENTITY.".slug = 'new'
				) 
				THEN 'YES' ELSE 'No' END) 
				is_new"
			." FROM ".TABLE_PRODUCT
			." INNER JOIN ".TABLE_PRODUCT_IMAGES." ON ".TABLE_PRODUCT.".product_id = ".TABLE_PRODUCT_IMAGES.".product_id"
			." INNER JOIN ".TABLE_PRODUCT_ENTITY." ON ".TABLE_PRODUCT.".product_id = ".TABLE_PRODUCT_ENTITY.".product_id"
			." INNER JOIN ".TABLE_ENTITY." ON ".TABLE_PRODUCT_ENTITY.".entity_id = ".TABLE_ENTITY.".entity_id"
			." LEFT JOIN ".TABLE_PRODUCT_TAG." ON ".TABLE_PRODUCT.".product_id = ".TABLE_PRODUCT_TAG.".product_id"

			.$join

			." WHERE ".TABLE_PRODUCT.".status='Y'"
			." AND ".TABLE_PRODUCT_IMAGES.".status='Y'"
			." AND ".TABLE_PRODUCT_IMAGES.".is_featured='Y'"
			." AND ".TABLE_ENTITY.".slug = '".$entity."' ".$where
			." GROUP BY ".TABLE_PRODUCT.".slug"
			." ORDER BY ".$order_by
			." LIMIT ".$start.", ".$perpage;
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}

	public function grab_parent_entity($child){
		$sql = "SELECT T2.entity_id, T2.name, T2.slug
				FROM (
				    SELECT
				        @r AS _id,
				        (SELECT @r := parent_id FROM ".TABLE_ENTITY." WHERE entity_id = _id) AS parent_id,
				        @l := @l + 1 AS lvl
				    FROM
				        (SELECT @r := ".$child.", @l := 0) vars,
				        ".TABLE_ENTITY." h
				    WHERE @r <> 0) T1
				JOIN ".TABLE_ENTITY." T2
				ON T1._id = T2.entity_id
				WHERE T2.parent_id != 0
				ORDER BY T1.lvl DESC";

				$query = $this->db->query($sql);
		
				return $query->result();
	}

	public function grab_product_list(){	
		$sql = "SELECT ".TABLE_PRODUCT.".discounted_price, ".TABLE_PRODUCT.".prd_dic_chk, ".TABLE_PRODUCT.".prd_dis_amt, ".TABLE_PRODUCT.".prd_dis_mode, ".TABLE_PRODUCT.".product_id, ".TABLE_PRODUCT.".slug, ".TABLE_PRODUCT.".name as prd_name, ".TABLE_PRODUCT.".price, ".TABLE_PRODUCT_IMAGES.".name as prd_img_name FROM ".TABLE_PRODUCT." INNER JOIN ".TABLE_PRODUCT_IMAGES." ON ".TABLE_PRODUCT.".product_id = ".TABLE_PRODUCT_IMAGES.".product_id INNER JOIN ".TABLE_PRODUCT_ENTITY." ON ".TABLE_PRODUCT.".product_id = ".TABLE_PRODUCT_ENTITY.".product_id INNER JOIN ".TABLE_ENTITY." ON ".TABLE_PRODUCT_ENTITY.".entity_id = ".TABLE_ENTITY.".entity_id WHERE ".TABLE_PRODUCT.".status='Y' AND ".TABLE_PRODUCT_IMAGES.".status='Y' AND ".TABLE_PRODUCT_IMAGES.".is_featured='Y' AND ".TABLE_ENTITY.".name = 'New' ORDER BY RAND() DESC LIMIT 0, 10";
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}

	public function grab_product_entity($cond = array(), $like, $limit = array()){	
		$limits = '';	
		if(!empty($limit)){
			$per_page = $limit[0];
			$offset = $limit[1];
			$limits = " LIMIT ".$offset.", ".$per_page;
		}
		
		if($like){
			$like = "WHERE ".TABLE_PRODUCT.".name LIKE '%".$like."%' OR ".TABLE_PRODUCT.".sku LIKE '%".$like."%' ";
		}

		$sql = "SELECT ".TABLE_PRODUCT.".slug, ".TABLE_PRODUCT.".name, (CASE WHEN ".TABLE_PRODUCT.".status = 'Y' THEN 'Active' ELSE 'Inactive' END) status, ".TABLE_PRODUCT.".sku, ".TABLE_PRODUCT.".quantity, ".TABLE_PRODUCT.".price FROM ".TABLE_PRODUCT." ".$like." ORDER BY ".TABLE_PRODUCT.".date_modified DESC".$limits;
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}

	public function grab_product_attribute($cond = array()){	
		$this->db->select(TABLE_ATTRIBUTE.'.name, '.TABLE_PRODUCT_ATTRIBUTE.'.unit, '.TABLE_PRODUCT_ATTRIBUTE.'.value, '.TABLE_PRODUCT_ATTRIBUTE.'.product_attribute_id')
         ->from(TABLE_ATTRIBUTE)
         ->join(TABLE_PRODUCT_ATTRIBUTE, TABLE_ATTRIBUTE.'.attribute_id = '.TABLE_PRODUCT_ATTRIBUTE.'.attribute_id')
         ->where($cond);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function insert_product($data = array()){

		$this->db->insert(TABLE_PRODUCT, $data); 

		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
	public function update_product($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_PRODUCT, $data); 
		
		return true;
	}
	
	public function delete_product($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_PRODUCT);
		
		return true;
	}

	public function insert_attribute($data = array()){

		$this->db->insert(TABLE_ATTRIBUTE, $data); 
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	public function grab_attribute($cond = array(), $like = array(), $limit = array()){
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
		$query = $this->db->get(TABLE_ATTRIBUTE);
		
		return $query->result();
	}

	public function insert_product_attribute($data = array()){

		$this->db->insert(TABLE_PRODUCT_ATTRIBUTE, $data); 
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	public function delete_product_attribute($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_PRODUCT_ATTRIBUTE);
		
		return true;
	}

	public function grab_product_image($cond = array(), $like = array(), $limit = array()){
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
		$this->db->order_by('is_featured','asc');		
		$query = $this->db->get(TABLE_PRODUCT_IMAGES);
		
		return $query->result();
	}

	public function insert_product_image($data = array()){

		$this->db->insert(TABLE_PRODUCT_IMAGES, $data); 
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	public function delete_product_image($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_PRODUCT_IMAGES);
		
		return true;
	}

	public function update_product_image($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_PRODUCT_IMAGES, $data); 
		
		return true;
	}

	public function grab_product_entity_attribute($product_id)
	{
	    $this->db->select('c.name');
	    $this->db->distinct('c.name');
	    $this->db->from(TABLE_PRODUCT_ENTITY.' a'); 
	    $this->db->join(TABLE_ENTITY_ATTRIBUTE.' b', 'b.entity_id=a.entity_id', 'inner');
	    $this->db->join(TABLE_PREFIX.'attr c', 'c.attr_id=b.attr_id', 'inner');
	    $this->db->where('a.product_id', $product_id);
	    $this->db->order_by('c.name','asc');         
	    $query = $this->db->get(); 
	    if($query->num_rows() != 0)
	    {
	        return $query->result_array();
	    }
	    else
	    {
	        return false;
	    }
	}

	public function grab_product_entity_rel($cond = array(), $like = array(), $limit = array()){
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
		$query = $this->db->get(TABLE_PRODUCT_ENTITY);
		
		return $query->result();
	}

	public function insert_product_entity_rel($data = array()){

		$this->db->insert(TABLE_PRODUCT_ENTITY, $data); 
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	public function delete_product_entity_rel($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_PRODUCT_ENTITY);
		
		return true;
	}

	public function grab_product_tag($cond = array(), $like = array(), $limit = array()){
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
		$query = $this->db->get(TABLE_PRODUCT_TAG);
		
		return $query->result();
	}

	public function insert_product_tag($data = array()){

		$this->db->insert(TABLE_PRODUCT_TAG, $data); 
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	public function delete_product_tag($cond = array()){
		$this->db->where($cond);
		
		$this->db->delete(TABLE_PRODUCT_TAG);
		
		return true;
	}

	public function grab_pincode($cond = array(), $like = array(), $limit = array()){
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
		$query = $this->db->get(TABLE_PINCODE);
		
		return $query->result();
	}
}