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
|	https://codeigniter.com/userguide3/general/routing.html
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
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Public routes
$route['category/(:any)'] = 'home/category/$1';
$route['subcategory/(:any)/(:any)'] = 'home/subcategory/$1/$2';
$route['search'] = 'home/search';
$route['product/(:num)'] = 'home/product_details/$1';

// Admin routes
$route['admin'] = 'admin/dashboard';
$route['admin/login'] = 'admin/auth/login';
$route['admin/logout'] = 'admin/auth/logout';
$route['admin/products'] = 'admin/products';
$route['admin/products/add'] = 'admin/products/add';
$route['admin/products/edit/(:num)'] = 'admin/products/edit/$1';
$route['admin/products/delete/(:num)'] = 'admin/products/delete/$1';



// Add these routes to your existing routes.php file:

// Admin subcategory routes
$route['admin/subcategories'] = 'admin/subcategories/index';
$route['admin/subcategories/add'] = 'admin/subcategories/add';
$route['admin/subcategories/edit/(:num)'] = 'admin/subcategories/edit/$1';
$route['admin/subcategories/delete/(:num)'] = 'admin/subcategories/delete/$1';

// Admin category routes  
$route['admin/categories'] = 'admin/categories/index';
$route['admin/categories/add'] = 'admin/categories/add';
$route['admin/categories/edit/(:num)'] = 'admin/categories/edit/$1';
$route['admin/categories/delete/(:num)'] = 'admin/categories/delete/$1';
