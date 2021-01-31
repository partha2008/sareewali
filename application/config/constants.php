<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// User-defined global values
switch(ENVIRONMENT){
	case "development":
		define('ROOT_URL', 'http://localhost/sareewali/');
	break;
	default:
		define('ROOT_URL', 'https://www.sareewali.com/');
	break;
}

define('PAGINATION_PER_PAGE', 10);

define('UPLOAD_PATH', ROOT_URL.'uploads/');
define('UPLOAD_LOGO_PATH', UPLOAD_PATH.'logo/');
define('UPLOAD_BANNER_PATH', UPLOAD_PATH.'banner/');
define('UPLOAD_PRODUCT_PATH', UPLOAD_PATH.'product/');
define('UPLOAD_ENTITY_PATH', UPLOAD_PATH.'entity/');
define('UPLOAD_ADS_PATH', UPLOAD_PATH.'ads/');
define('UPLOAD_INVOICE_PATH', UPLOAD_PATH.'invoice/');
define('UPLOAD_PROFILE_IMAGE_PATH', UPLOAD_PATH.'profile/');

define('UPLOAD_RELATIVE_PATH', 'uploads/');
define('UPLOAD_RELATIVE_LOGO_PATH', UPLOAD_RELATIVE_PATH.'logo/');
define('UPLOAD_RELATIVE_BANNER_PATH', UPLOAD_RELATIVE_PATH.'banner/');
define('UPLOAD_RELATIVE_PRODUCT_PATH', UPLOAD_RELATIVE_PATH.'product/');
define('UPLOAD_RELATIVE_ENTITY_PATH', UPLOAD_RELATIVE_PATH.'entity/');
define('UPLOAD_RELATIVE_ADS_PATH', UPLOAD_RELATIVE_PATH.'ads/');
define('UPLOAD_RELATIVE_INVOICE_PATH', UPLOAD_RELATIVE_PATH.'invoice/');
define('UPLOAD_RELATIVE_PROFILE_IMAGE_PATH', UPLOAD_RELATIVE_PATH.'profile/');

define('TABLE_PREFIX', 'saree_');

define('TABLE_ADMIN', TABLE_PREFIX.'admin');
define('TABLE_SETTINGS', TABLE_PREFIX.'settings');
define('TABLE_BANNER', TABLE_PREFIX.'banner');
define('TABLE_NEWLETTER', TABLE_PREFIX.'newsletter');
define('TABLE_USER', TABLE_PREFIX.'users');
define('TABLE_ENTITY', TABLE_PREFIX.'entity');
define('TABLE_PRODUCT', TABLE_PREFIX.'product');
define('TABLE_COUPON', TABLE_PREFIX.'coupon');
define('TABLE_LOG', TABLE_PREFIX.'log');
define('TABLE_CMS', TABLE_PREFIX.'cms');
define('TABLE_ATTRIBUTE', TABLE_PREFIX.'attribute');
define('TABLE_PRODUCT_ATTRIBUTE', TABLE_PREFIX.'product_attribute');
define('TABLE_PRODUCT_IMAGES', TABLE_PREFIX.'product_images');
define('TABLE_PRODUCT_ENTITY', TABLE_PREFIX.'product_entity');
define('TABLE_COUNTRY', TABLE_PREFIX.'country');
define('TABLE_STATE', TABLE_PREFIX.'state');
define('TABLE_ADS', TABLE_PREFIX.'ads');
define('TABLE_ADS_SECTION', TABLE_PREFIX.'ads_section');
define('TABLE_PRODUCT_TAG', TABLE_PREFIX.'product_tags');
define('TABLE_REVIEW', TABLE_PREFIX.'review');
define('TABLE_CART', TABLE_PREFIX.'cart');
define('TABLE_ORDER', TABLE_PREFIX.'order');
define('TABLE_ORDER_DETAILS', TABLE_PREFIX.'order_details');
define('TABLE_WISHLIST', TABLE_PREFIX.'wishlist');
define('TABLE_PINCODE', TABLE_PREFIX.'pincode');
define('TABLE_ENTITY_ATTRIBUTE', TABLE_PREFIX.'entity_attribute');
define('TABLE_ATTR', TABLE_PREFIX.'attr');
define('TABLE_PRODUCT_SIZE', TABLE_PREFIX.'product_size');
define('TABLE_NOTIFY', TABLE_PREFIX.'notify');