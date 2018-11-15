<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['myaccount'] = 'home/myaccount';
$route['orderhistory'] = 'home/orderhistory';
$route['mywishlist'] = 'home/mywishlist';
$route['changepassword'] = 'home/changepassword';
$route['logout'] = 'home/logout';

$route['term'] = 'home/cms';
$route['privacy'] = 'home/cms';
$route['return'] = 'home/cms';
$route['shipping'] = 'home/cms';
$route['about'] = 'home/cms';
$route['contact'] = 'home/contact';
$route['feedback'] = 'home/cms';

$route['product-details/(:any)'] = 'product/product_details/$1';
$route['product-list/(:any)'] = 'product/product_list/$1';
$route['product-list/(:any)/(:any)'] = 'product/product_list/$1/$2';

$route['cart'] = 'cart/index';
$route['checkout'] = 'cart/checkout';

$route['admin'] = 'admin/user/index';

$route['admin/forget-password'] = 'admin/user/forget_password';
$route['admin/ads'] = 'admin/user/ads';
$route['admin/dashboard'] = 'admin/user/dashboard';
$route['admin/profile'] = 'admin/user/profile';
$route['admin/settings'] = 'admin/user/settings';
$route['admin/term'] = 'admin/user/cms';
$route['admin/privacy'] = 'admin/user/cms';
$route['admin/return'] = 'admin/user/cms';
$route['admin/shipping'] = 'admin/user/cms';
$route['admin/about'] = 'admin/user/cms';
$route['admin/contact'] = 'admin/user/cms';
$route['admin/feedback'] = 'admin/user/cms';
$route['admin/newsletter'] = 'admin/user/newsletter';
$route['admin/newsletter-edit/(:num)/(:any)'] = 'admin/user/newsletter_edit/$1/$2';

$route['admin/banner-list'] = 'admin/banner/banner_list';
$route['admin/banner-add'] = 'admin/banner/banner_add';
$route['admin/banner-edit/(:num)'] = 'admin/banner/banner_edit/$1';

$route['admin/review-list'] = 'admin/review/review_list';
$route['admin/review-add'] = 'admin/review/review_add';
$route['admin/review-edit/(:num)'] = 'admin/review/review_edit/$1';

$route['admin/user-list'] = 'admin/user/user_list';
$route['admin/user-add'] = 'admin/user/user_add';
$route['admin/user-edit/(:num)'] = 'admin/user/user_edit/$1';

$route['admin/entity-list'] = 'admin/entity/entity_list';
$route['admin/entity-add'] = 'admin/entity/entity_add';
$route['admin/entity-edit/(:any)'] = 'admin/entity/entity_edit/$1';

$route['admin/product-list'] = 'admin/product/product_list';
$route['admin/product-add'] = 'admin/product/product_add';
$route['admin/product-edit/(:any)'] = 'admin/product/product_edit/$1';

$route['admin/order-list'] = 'admin/order/order_list';
$route['admin/failed-order-list'] = 'admin/order/failed_order_list';
$route['admin/order-edit/(:any)'] = 'admin/order/order_edit/$1';

$route['admin/coupon-list'] = 'admin/coupon/coupon_list';
$route['admin/coupon-add'] = 'admin/coupon/coupon_add';
$route['admin/coupon-edit/(:num)'] = 'admin/coupon/coupon_edit/$1';
