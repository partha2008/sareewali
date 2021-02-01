<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller{
	
	public $data = array();
	
	public function __construct(){
		parent::__construct();

		$this->load->model('productdata');
			
		$this->data = $this->defaultdata->getBackendDefaultData();
	}
	
	public function notify() {
		$general_settings = $this->data['general_settings'];
		$admin_profile = $this->data['admin_profile'];

		$this->data['site_title'] = rtrim(preg_replace("(^https?://www.)", "",$general_settings->siteaddress), '/');
		$this->data['site_logo'] = UPLOAD_LOGO_PATH.$general_settings->logoname;
		$this->data['site_url'] = $general_settings->siteaddress;
		$this->data['site_name'] = $general_settings->sitename;					
		$this->data['fb_img'] = base_url('resources/images/facebook.jpg'); 
		$this->data['fb_link'] = $general_settings->facebook_page_url; 
		$this->data['tw_img'] = base_url('resources/images/twitter.jpg');
		$this->data['tw_link'] = ''; 
		$this->data['email_banner'] = base_url('resources/images/email-banner.jpg');
		$this->data['boder'] = base_url('resources/images/boder.jpg');	

		$notify = $this->productdata->grab_notify(array("is_mail_send" => "N"));

		if(!empty($notify)){
			foreach ($notify as $key => $value) {
				if($value->size){
					$sql = " SELECT ".TABLE_PRODUCT_SIZE.".size, ".TABLE_PRODUCT.".name, ".TABLE_PRODUCT_IMAGES.".path FROM ".TABLE_PRODUCT_SIZE." INNER JOIN ".TABLE_PRODUCT." ON ".TABLE_PRODUCT_SIZE.".product_id = ".TABLE_PRODUCT.".product_id INNER JOIN ".TABLE_PRODUCT_IMAGES." ON ".TABLE_PRODUCT_SIZE.".product_id = ".TABLE_PRODUCT_IMAGES.".product_id WHERE ".TABLE_PRODUCT_SIZE.".product_id=".$value->product_id." AND ".TABLE_PRODUCT_SIZE.".size=".$value->size." AND ".TABLE_PRODUCT_SIZE.".quantity > 0 AND ".TABLE_PRODUCT_IMAGES.".status='Y' AND ".TABLE_PRODUCT_IMAGES.".is_featured='Y' ";

					$query = $this->db->query($sql);					
					$product_data = $query->result();

				}else{
					$sql = "SELECT ".TABLE_PRODUCT.".name, ".TABLE_PRODUCT_IMAGES.".path FROM ".TABLE_PRODUCT." INNER JOIN ".TABLE_PRODUCT_IMAGES." ON ".TABLE_PRODUCT.".product_id = ".TABLE_PRODUCT_IMAGES.".product_id WHERE ".TABLE_PRODUCT.".product_id='".$value->product_id."' AND ".TABLE_PRODUCT.".quantity > 0 AND ".TABLE_PRODUCT_IMAGES.".status='Y' AND ".TABLE_PRODUCT_IMAGES.".is_featured='Y'";
					
					$query = $this->db->query($sql);					
					$product_data = $query->result();
				}	

				if(!empty($product_data)){
					foreach ($product_data as $key => $val) {

						$this->data['prd_image'] = ROOT_URL.$val->path;
						$this->data['prd_name'] = $val->name;
						if(isset($val->size)){
							$this->data['prd_size'] = $val->size;
						}else{
							$this->data['prd_size'] = '';
						}

						$message = $this->load->view('admin/email_template/notify', $this->data, true);
						$mail_config = array(
							"from" => $admin_profile->email,
							"to" => array($value->email),
							"subject" => $general_settings->sitename.": Product Available",
							"message" => $message
						);

						if($this->defaultdata->_send_mail($mail_config)){
							$this->productdata->update_notify(array("notify_id" => $value->notify_id), array("is_mail_send" => "Y"));
						}
					}
				}
			}
		}
	}
}