<?php
class Defaultdata extends CI_Model {

	private $data = array();
	private $mydata = array();
	private $headerdata = array();
	
	function __construct()
	{
		parent::__construct();
	}
	public function getBackendDefaultData()
	{
		$this->mydata["tot_segments"] = $this->getUrlSegments();
		$this->mydata['general_settings'] = $this->grabSettingData();
		$this->mydata['admin_profile'] = $this->grabProfileData();			
		$this->mydata["sidebar"] = $this->load->view('admin/partials/sidebar', null, true);
		$this->data = $this->mydata;
		$this->headerdata = $this->mydata;
		$this->data["header"] = $this->load->view('admin/partials/header', $this->headerdata, true);		
		$this->data["head"] = $this->load->view('admin/partials/head', $this->headerdata, true);
		$this->data["footer"] = $this->load->view('admin/partials/footer', null, true);
		
		return $this->data;
	}

	public function getFrontendDefaultData()
	{
		$this->mydata["tot_segments"] = $this->getUrlSegments();
		$this->mydata['general_settings'] = $this->grabSettingData();
		$this->mydata["modal"] = $this->load->view('partials/modal', null, true);	
		$this->mydata['admin_profile'] = $this->grabProfileData();		
		$this->mydata['final_tree'] = $this->grabTree();
		$this->mydata['prd_cat'] = $this->entitydata->grab_entity(array("level" => "1", "status" => "Y"));		
		$this->data = $this->mydata;
		$this->headerdata = $this->mydata;
		$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));
		$count = 0;
		$total_price = 0;
		if(!empty($cart_data)){
			foreach ($cart_data as $key => $value) {
				if((int)$value->prd_discounted_price > 0){
					$total_price = $total_price + $value->prd_discounted_price*$value->prd_count;
				}else{
					$total_price = $total_price + $value->prd_price*$value->prd_count;
				}
				$count++;
			}
		}

		$this->headerdata['total_price'] = number_format($total_price, 2);
		$this->headerdata['count'] = $count;
		$this->headerdata['cart'] = $this->load->view('partials/cart', $this->headerdata, true);
		$this->data["header"] = $this->load->view('partials/header', $this->headerdata, true);			
		$this->data["head"] = $this->load->view('partials/head', null, true);
		$this->data["upper_footer"] = $this->load->view('partials/upper_footer', $this->headerdata, true);
		$this->data["footer"] = $this->load->view('partials/footer', null, true);
		$this->data["foot"] = $this->load->view('partials/foot', null, true);
		
		return $this->data;
	}
	public function grabTree(){
		$tree = $this->entitydata->grab_entity(array(), array(), array(), array("entity_id" => "asc"));

		return $this->buildTree($tree);
	}
	public function is_session_active()
	{
		$sess_id = $this->session->userdata('usrid');
		if (isset($sess_id)==true && $sess_id!="")
			return 1;
		else
			return 0;
	}
	public function is_user_session_active()
	{
		$sess_id = $this->session->userdata('user_id');
		if (isset($sess_id)==true && $sess_id!="")
			return 1;
		else
			return 0;
	}
	public function CheckFilename($page_filename)
	{
		$page_filename=str_replace(" ","-",$page_filename); //blank space is converted into blank
		$special_char=array("/",".htm",".","!","@","#","$","^","&","*","(",")","=","+","|","\\","{","}",":",";","'","<",">",",",".","?","\"","%");
		$page_filename=str_replace($special_char,"",$page_filename); // dot is converted into blank
		return strtolower($page_filename);      
	}
	public function getUrlSegments()
	{
		$all_segment=$this->uri->segment_array();
		if(sizeof($all_segment)==0)
		{
			$all_segment[1]=$this->router->class;
		}
		if(sizeof($all_segment)==1)
		{
			$all_segment[2]=$this->router->method;
		}
		return $all_segment;
	}
	
	public function returnPartString($string,$length)
	{
		$string = strip_tags($string);
		$s_length=strlen($string);
		if($s_length > $length)
		{
			if(strpos($string," ",$length) !== false)
			{
				$string=substr($string,0,strpos($string," ",$length));
			}
			else
			{
				$string=substr($string,0,$length);
			}
		} 
		else
		{
			$string=$string;
		}
		return stripslashes($string);
	}
	public function grabSettingData(){
		$query = $this->db->get(TABLE_SETTINGS);
		
		return $query->row();
	}
	public function grabProfileData(){
		$query = $this->db->get(TABLE_ADMIN);
		
		return $query->row();
	}
	public function grabCountryData($cond = array()){
		if(!empty($cond)){
			$this->db->where($cond);			
		}
		$query = $this->db->get(TABLE_COUNTRY);
		
		return $query->result();
	}
	public function grabStateData($cond = array()){
		if(!empty($cond)){
			$this->db->where($cond);			
		}
		$query = $this->db->get(TABLE_STATE);
		
		return $query->result();
	}
	public function secureInput($data)
	{
		$return_data = array();
		foreach($data as $field => $inp_data)
		{
			$return_data[$field] = $this->security->xss_clean(trim($inp_data));
		}
		return $return_data;
	}
	public function setLoginSession($user_data = array())
	{
		if(count($user_data) > 0)
		{
			$this->session->set_userdata('usrid', $user_data->admin_id);
			$this->session->set_userdata('usrname', $user_data->username);
			$this->session->set_userdata('usremail', $user_data->email);
		}
	}
	public function unsetLoginSession()
	{
		$this->session->unset_userdata('usrid');
		$this->session->unset_userdata('usrname');
		$this->session->unset_userdata('usremail');	
	}
	public function setFrontendLoginSession($user_data = array())
	{
		if(count((array)$user_data) > 0)
		{
			$this->session->set_userdata('user_id', $user_data->user_id);
			$this->session->set_userdata('user_email', $user_data->email);
		}
	}
	public function unsetFrontendLoginSession()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('active_coupon_code');
		$this->session->unset_userdata('active_coupon');	
	}
	public function getSha256Base64Hash($s) {
		return base64_encode(hash("sha256", $s, True));
	}	
	public function getGeneratedPassword( $length = 6 ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		$password = substr( str_shuffle( $chars ), 0, $length );	
		
		return $password;
	}
	public function generatedRandString( $length = 6 ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$strgen = substr( str_shuffle( $chars ), 0, $length );	
		
		return $strgen;
	}
	public function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}
	
	public function checkEmailFormat($email){
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		  return true;
		} else {
		  return false;
		}
	}
	
	// Encrypt Function
	function mc_encrypt($encrypt, $key){
		$encrypt = serialize($encrypt);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
		$key = pack('H*', $key);
		$mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
		$passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
		$encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
		
		return $encoded;
	}
	
	// Decrypt Function
	function mc_decrypt($decrypt, $key){
		$decrypt = explode('|', $decrypt.'|');
		$decoded = base64_decode($decrypt[0]);
		$iv = base64_decode($decrypt[1]);
		if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
		$key = pack('H*', $key);
		$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
		$mac = substr($decrypted, -64);
		$decrypted = substr($decrypted, 0, -64);
		$calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
		if($calcmac!==$mac){ return false; }
		$decrypted = unserialize($decrypted);
		
		return $decrypted;
	}
	
	public function _send_mail($config = array()){		
		$this->email->initialize($this->config->item('smtp'));
		
		$this->email->from($config['from']);
		$this->email->to($config['to']);
		if(array_key_exists("cc", $config)){
			$this->email->cc($config['cc']);
		}
		if(array_key_exists("bcc", $config)){		
			$this->email->bcc($config['bcc']);
		}

		$this->email->subject($config['subject']);
		$this->email->message($config['message']);

		if(isset($config['attachment']) && $config['attachment']){
			$this->email->attach($config['attachment']);
		}

		if($this->email->send()){
			return true;
		}else{
			return false;
		}
	}

	public function parseTree($tree, $root = null) {
        $return = array();
        # Traverse the tree and search for direct children of the root
        foreach($tree as $child => $parent) {
            # A direct child is found
            if($parent == $root) {
                # Remove item from tree (we don't need to traverse this again)
                unset($tree[$child]);
                # Append the child into result array and parse its children
                $return[] = array(
                    'name' => $child,
                    'children' => $this->parseTree($tree, $child)
                );
            }
        }
        return empty($return) ? null : $return;    
    }

	public function buildTree(array $elements, $parentId = 0) {
	    $branch = array();

	    foreach ($elements as $element) {
	        if ($element->parent_id == $parentId) {
	            $children = $this->buildTree($elements, $element->entity_id);
	            if ($children) {
	                $element->children = $children;
	            }
	            $branch[] = $element;
	        }
	    }

	    return $branch;
	}

    public function create_thumb($file_path, $marker, $width, $height){
		$config['image_library'] = 'gd2';  
		$config['source_image'] = $file_path;  
		$config['create_thumb'] = TRUE;
		$config['thumb_marker'] = $marker;
		$config['maintain_ratio'] = FALSE;  
		$config['quality'] = '90%';  
		$config['width'] = $width;  
		$config['height'] = $height;  
		$config['new_image'] = $file_path;

		$this->image_lib->initialize($config);
	    $this->image_lib->resize();
	    $this->image_lib->clear();
	}

	public function in_assoc($key, $val, $array)
	{
	    $return = false;
		foreach($array as $struct) {
		    if ($val == $struct->$key) {
		        $return = true;
		        break;
		    }
		}

		return $return;
	}

	public function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

	public function parse_number($number, $dec_point=null) {
	    if (empty($dec_point)) {
	        $locale = localeconv();
	        $dec_point = $locale['decimal_point'];
	    }

	    return floatval(str_replace($dec_point, '.', preg_replace('/[^\d'.preg_quote($dec_point).']/', '', $number)));
	}

	public function getDomain($url){
	    $pieces = parse_url($url);
	    $domain = isset($pieces['host']) ? $pieces['host'] : '';
	    if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
	        return $regs['domain'];
	    }
	    return FALSE;
	}

	/*
	* @param1 : Plain String
	* @param2 : Working key provided by CCAvenue
	* @return : Decrypted String
	*/
	public function encrypt($plainText,$key)
	{
		$key = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		$encryptedText = bin2hex($openMode);
		return $encryptedText;
	}

	/*
	* @param1 : Encrypted String
	* @param2 : Working key provided by CCAvenue
	* @return : Plain String
	*/
	public function decrypt($encryptedText,$key)
	{
		$key = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText = $this->hextobin($encryptedText);
		$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		return $decryptedText;
	}

	public function hextobin($hexString) 
	{ 
		$length = strlen($hexString); 
		$binString="";   
		$count=0; 
		while($count<$length) 
		{       
		    $subString =substr($hexString,$count,2);           
		    $packedString = pack("H*",$subString); 
		    if ($count==0)
		    {
				$binString=$packedString;
		    } 
		    
		    else 
		    {
				$binString.=$packedString;
		    } 
		    
		    $count+=2; 
		} 
	    
	    return $binString; 
	} 
}
?>