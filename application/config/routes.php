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
$route['404_override'] = 'welcome';
$route['translate_uri_dashes'] = FALSE;
/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/

// $route['api/request-inquiry'] = 'api/inquiry_payment';
// $route['api/request-payment'] = 'api/payment';


$route['api/version/(:num)/(:any)'] = 'api/general/version/nonce/$1/key/$2';

//GENERAL
$route['api/upload/product'] = 'api/general/product_upload';
$route['api/upload/logo'] = 'api/general/logo_upload';
$route['api/upload/file'] = 'api/general/file_upload';
$route['api/send/email'] = 'api/general/email';

//USER
// $route['api/user/list/(:any)/(:num)/(:any)'] = 'api/user/list/username/$1/nonce/$2/key/$3';
// $route['api/user/list/(:any)/(:num)/(:any)/(:any)'] = 'api/user/list/username/$1/nonce/$2/key/$3/id_user/$4';

//SATKER
$route['api/satker/add'] = 'api/user/satker';
$route['api/satker/update'] = 'api/user/satker';
$route['api/satker/delete'] = 'api/user/satker_delete';
$route['api/satker/list'] = 'api/user/satker_list';

//PRODUCT
// $route['api/product/list/(:any)/(:num)/(:any)/(:any)'] = 'api/product/list/username/$1/nonce/$2/key/$3/type/$4';
// $route['api/product/detail/(:any)/(:num)/(:any)/(:any)'] = 'api/product/detail/username/$1/nonce/$2/key/$3/product_code/$4';
// $route['api/product/list/(:any)/(:num)/(:any)/(:any)/(:any)'] = 'api/product/list/username/$1/nonce/$2/key/$3/type/$4/id/$5';

//CATEGORY
$route['api/category/add'] = 'api/product/category';
$route['api/category/update'] = 'api/product/category_update';
$route['api/category/delete'] = 'api/product/category_delete';
$route['api/category/list'] = 'api/product/category';

//RETAILER
// $route['api/retailer/list/(:any)/(:num)/(:any)'] = 'api/retailer/list/username/$1/nonce/$2/key/$3';
// $route['api/retailer/list/(:any)/(:num)/(:any)/(:any)'] = 'api/retailer/list/username/$1/nonce/$2/key/$3/id_agen/$4';

//DISTRIBUTOR
// $route['api/distributor/list/(:any)/(:num)/(:any)'] = 'api/distributor/list/username/$1/nonce/$2/key/$3';
// $route['api/distributor/list/(:any)/(:num)/(:any)/(:any)'] = 'api/distributor/list/username/$1/nonce/$2/key/$3/id_distributor/$4';

//EMPLOYEE
$route['api/employee/add'] = 'api/distributor/employee';
$route['api/employee/update'] = 'api/distributor/employee_update';
$route['api/employee/delete'] = 'api/distributor/employee_delete';
$route['api/employee/list'] = 'api/distributor/employee_list';

//ORDER
// $route['api/order/list/(:any)/(:num)/(:any)/(:any)/(:any)'] = 'api/order/list/username/$1/nonce/$2/key/$3/type/$4/data/$5';
// $route['api/order/list/(:any)/(:num)/(:any)/(:any)/(:any)/(:any)'] = 'api/order/list/username/$1/nonce/$2/key/$3/type/$4/id/$5/data/$6';
$route['api/order/detail/(:any)/(:num)/(:any)/(:any)'] = 'api/order/detail/username/$1/nonce/$2/key/$3/invoice/$4';
$route['api/cart/list'] = 'api/order/cart';
$route['api/cart/add'] = 'api/order/cart';
$route['api/cart/delete'] = 'api/order/cart_delete';
$route['api/cart/update'] = 'api/order/cart_update';

$route['api/kegiatan/list'] = 'api/order/kegiatan';
$route['api/kegiatan/add'] = 'api/order/kegiatan';
$route['api/kegiatan/delete'] = 'api/order/kegiatan_delete';

$route['api/notification/list'] = 'api/notifications/list';
$route['api/notification/read'] = 'api/notifications/read';