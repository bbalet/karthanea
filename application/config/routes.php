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
|	http://codeigniter.com/user_guide/general/routing.html
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

//Admin : user management
$route['users/employees'] = 'users/employees';
$route['users/export'] = 'users/export';
$route['users/import'] = 'users/import';
$route['users/reset/(:num)'] = 'users/reset/$1';
$route['users/create'] = 'users/create';
$route['users/edit/(:num)'] = 'users/edit/$1';
$route['users/delete/(:num)'] = 'users/delete/$1';
$route['users/check/login'] = 'users/check_login';
$route['users'] = 'users';

//Session management
$route['connection/login'] = 'connection/login';
$route['connection/logout'] = 'connection/logout';
$route['connection/forgetpassword'] = 'connection/forgetpassword';

//Client management
$route['clients/(:num)/contracts'] = 'clients/contracts/$1';
$route['clients/(:num)/bills'] = 'clients/bills/$1';
$route['clients/(:num)/dashboard'] = 'clients/dashboard/$1';
$route['clients/(:num)/dashboardTree'] = 'clients/dashboardTree/$1';
$route['clients/search'] = 'clients/search';
$route['clients/search/ajax'] = 'clients/ajaxSearch';
$route['clients/search/any'] = 'clients/doSearch';
$route['clients/create'] = 'clients/create';
$route['clients/(:num)/edit'] = 'clients/edit/$1';

//Bill/Invoice management
$route['bills/create'] = 'bills/create';
$route['bills/(:num)/view'] = 'bills/view/$1';
$route['bills/(:num)/edit'] = 'bills/edit/$1';
$route['bills/(:num)/export'] = 'bills/export/$1';

//Contract management
$route['contracts/create'] = 'contracts/create';
$route['contracts/(:num)/view'] = 'contracts/view/$1';
$route['contracts/(:num)/edit'] = 'contracts/edit/$1';
$route['contracts/(:num)/bills'] = 'contracts/bills/$1';
$route['contracts/(:num)/export'] = 'contracts/export/$1';

//Call center management
$route['calls/unlinked'] = 'calls/unlinked';
$route['calls/create'] = 'calls/create';
$route['calls/search'] = 'calls/search';
$route['calls/results'] = 'calls/results';
$route['calls/(:num)/edit'] = 'calls/edit/$1';
$route['calls/search/ajax'] = 'calls/ajaxSearch';
$route['calls/search/any'] = 'calls/doSearch';
$route['calls'] = 'calls/index';

//REST API
$route['api/getClients'] = 'api/getClients';
$route['api/getClient/(:num)'] = 'api/getClient/$1';

$route['default_controller'] = 'clients/search';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
