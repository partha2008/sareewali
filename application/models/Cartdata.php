<?php

class Cartdata extends CI_Model {

	

	public function grab_cart($cond = array(), $like = array(), $limit = array()){

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

		$query = $this->db->get(TABLE_CART);

		

		return $query->result();

	}



	public function grab_cart_image_list($cond = array()){	

		$this->db->select('*')

        	->from(TABLE_CART)

         	->join(TABLE_PRODUCT_IMAGES, TABLE_CART.'.product_id = '.TABLE_PRODUCT_IMAGES.'.product_id')

         	->where($cond);

		

		$query = $this->db->get();

		

		return $query->result();

	}

	

	public function insert_cart($data = array()){



		$this->db->insert(TABLE_CART, $data); 



		$insert_id = $this->db->insert_id();

		

		return $insert_id;

	}

	public function update_cart_items($cond = array(), $data = array()){

		$this->db->where($cond);
		$this->db->update(TABLE_CART, $data); 
		
		return true;
	}

	

	public function update_cart($cond = array()){

		$this->db->set('prd_count', 'prd_count+1', FALSE);

		$this->db->where($cond);

		$this->db->update(TABLE_CART);

		

		return true;

	}



	public function update_cart_decrease($cond = array()){

		$this->db->set('prd_count', 'prd_count-1', FALSE);

		$this->db->where($cond);

		$this->db->update(TABLE_CART);

		

		return true;

	}

	

	public function delete_cart($cond = array()){

		$this->db->where($cond);

		

		$this->db->delete(TABLE_CART);

		

		return true;

	}

	

}