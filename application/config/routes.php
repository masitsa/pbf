<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "site";
$route['404_override'] = '';

/*
*	Site Routes
*/
$route['home'] = 'site/home_page';
$route['flights'] = 'site/flights';

/*
*	Settings Routes
*/
$route['settings'] = 'admin/settings';
$route['dashboard'] = 'admin/index';

/*
*	Login Routes
*/
$route['login-admin'] = 'login/login_admin';
$route['logout-admin'] = 'login/logout_admin';

/*
*	Users Routes
*/
$route['all-users'] = 'admin/users';
$route['all-users/(:num)'] = 'admin/users/index/$1';
$route['add-user'] = 'admin/users/add_user';
$route['edit-user/(:num)'] = 'admin/users/edit_user/$1';
$route['delete-user/(:num)'] = 'admin/users/delete_user/$1';
$route['activate-user/(:num)'] = 'admin/users/activate_user/$1';
$route['deactivate-user/(:num)'] = 'admin/users/deactivate_user/$1';
$route['reset-user-password/(:num)'] = 'admin/users/reset_password/$1';
$route['admin-profile/(:num)'] = 'admin/users/admin_profile/$1';

/*
*	Admin Routes
*/

//airlines
$route['administration/all-airlines'] = 'admin/airlines/index';
$route['administration/all-airlines/(:num)'] = 'admin/airlines/index/$1';//with a page number
$route['administration/add-airline'] = 'admin/airlines/add_airline';
$route['administration/edit-airline/(:num)'] = 'admin/airlines/edit_airline/$1';
$route['administration/activate-airline/(:num)/(:num)'] = 'admin/airlines/activate_airline/$1/$2';
$route['administration/deactivate-airline/(:num)/(:num)'] = 'admin/airlines/deactivate_airline/$1/$2';
$route['administration/delete-airline/(:num)/(:num)'] = 'admin/airlines/delete_airline/$1/$2';

//visitors
$route['administration/all-visitors'] = 'admin/visitors/index';
$route['administration/all-visitors/(:num)'] = 'admin/visitors/index/$1';//with a page number
$route['administration/add-visitor'] = 'admin/visitors/add_visitor';
$route['administration/edit-visitor/(:num)'] = 'admin/visitors/edit_visitor/$1';
$route['administration/activate-visitor/(:num)/(:num)'] = 'admin/visitors/activate_visitor/$1/$2';
$route['administration/deactivate-visitor/(:num)/(:num)'] = 'admin/visitors/deactivate_visitor/$1/$2';
$route['administration/delete-visitor/(:num)/(:num)'] = 'admin/visitors/delete_visitor/$1/$2';

//airplane types: admin
$route['administration/all-airplane-types'] = 'admin/airplane_types/index';
$route['administration/all-airplane-types/(:num)'] = 'admin/airplane_types/index/$1';//with a page number
$route['administration/add-airplane-type'] = 'admin/airplane_types/add_airplane_type';
$route['administration/edit-airplane-type/(:num)'] = 'admin/airplane_types/edit_airplane_type/$1';
$route['administration/activate-airplane-type/(:num)/(:num)'] = 'admin/airplane_types/activate_airplane_type/$1/$2';
$route['administration/deactivate-airplane-type/(:num)/(:num)'] = 'admin/airplane_types/deactivate_airplane_type/$1/$2';
$route['administration/delete-airplane-type/(:num)/(:num)'] = 'admin/airplane_types/delete_airplane_type/$1/$2';

//airplane types: airline
$route['airline/all-airplane-types'] = 'airline/airplane_types/index';
$route['airline/all-airplane-types/(:num)'] = 'airline/airplane_types/index/$1';//with a page number
$route['airline/add-airplane-type'] = 'airline/airplane_types/add_airplane_type';
$route['airline/edit-airplane-type/(:num)'] = 'airline/airplane_types/edit_airplane_type/$1';
$route['airline/activate-airplane-type/(:num)/(:num)'] = 'airline/airplane_types/activate_airplane_type/$1/$2';
$route['airline/deactivate-airplane-type/(:num)/(:num)'] = 'airline/airplane_types/deactivate_airplane_type/$1/$2';
$route['airline/delete-airplane-type/(:num)/(:num)'] = 'airline/airplane_types/delete_airplane_type/$1/$2';

//airports
$route['administration/all-airports'] = 'admin/airports/index';
$route['administration/all-airports/(:num)'] = 'admin/airports/index/$1';//with a page number
$route['administration/add-airport'] = 'admin/airports/add_airport';
$route['administration/edit-airport/(:num)'] = 'admin/airports/edit_airport/$1';
$route['administration/activate-airport/(:num)/(:num)'] = 'admin/airports/activate_airport/$1/$2';
$route['administration/deactivate-airport/(:num)/(:num)'] = 'admin/airports/deactivate_airport/$1/$2';
$route['administration/delete-airport/(:num)/(:num)'] = 'admin/airports/delete_airport/$1/$2';

//airports: airline
$route['airline/all-airports'] = 'airline/airports/index';
$route['airline/all-airports/(:num)'] = 'airline/airports/index/$1';//with a page number
$route['airline/add-airport'] = 'airline/airports/add_airport';
$route['airline/edit-airport/(:num)'] = 'airline/airports/edit_airport/$1';
$route['airline/activate-airport/(:num)/(:num)'] = 'airline/airports/activate_airport/$1/$2';
$route['airline/deactivate-airport/(:num)/(:num)'] = 'airline/airports/deactivate_airport/$1/$2';
$route['airline/delete-airport/(:num)/(:num)'] = 'airline/airports/delete_airport/$1/$2';

//flight types
$route['administration/all-flight-types'] = 'admin/flight_types/index';
$route['administration/all-flight-types/(:num)'] = 'admin/flight_types/index/$1';//with a page number
$route['administration/add-flight-type'] = 'admin/flight_types/add_flight_type';
$route['administration/edit-flight-type/(:num)'] = 'admin/flight_types/edit_flight_type/$1';
$route['administration/activate-flight-type/(:num)/(:num)'] = 'admin/flight_types/activate_flight_type/$1/$2';
$route['administration/deactivate-flight-type/(:num)/(:num)'] = 'admin/flight_types/deactivate_flight_type/$1/$2';
$route['administration/delete-flight-type/(:num)/(:num)'] = 'admin/flight_types/delete_flight_type/$1/$2';

//flight types: airline
$route['airline/all-flight-types'] = 'airline/flight_types/index';
$route['airline/all-flight-types/(:num)'] = 'airline/flight_types/index/$1';//with a page number
$route['airline/add-flight-type'] = 'airline/flight_types/add_flight_type';
$route['airline/edit-flight-type/(:num)'] = 'airline/flight_types/edit_flight_type/$1';
$route['airline/activate-flight-type/(:num)/(:num)'] = 'airline/flight_types/activate_flight_type/$1/$2';
$route['airline/deactivate-flight-type/(:num)/(:num)'] = 'airline/flight_types/deactivate_flight_type/$1/$2';
$route['airline/delete-flight-type/(:num)/(:num)'] = 'airline/flight_types/delete_flight_type/$1/$2';

//flight: airline
$route['airline/all-flights'] = 'airline/flights/index';
$route['airline/all-flights/(:num)'] = 'airline/flights/index/$1';//with a page number
$route['airline/add-flight'] = 'airline/flights/add_flight';
$route['airline/edit-flight/(:num)'] = 'airline/flights/edit_flight/$1';
$route['airline/activate-flight/(:num)/(:num)'] = 'airline/flights/activate_flight/$1/$2';
$route['airline/deactivate-flight/(:num)/(:num)'] = 'airline/flights/deactivate_flight/$1/$2';
$route['airline/delete-flight/(:num)/(:num)'] = 'airline/flights/delete_flight/$1/$2';

/*
*	Airline Routes
*/
$route['airline/sign-in'] = 'login/login_airline';
$route['airline/sign-up/airline-details'] = 'airline/airline_signup1';
$route['airline/sign-up/user-details'] = 'airline/airline_signup2';
$route['airline/sign-up/review'] = 'airline/airline_signup3';
$route['airline/account'] = 'airline/account';
$route['airline-login'] = 'login/login_airline';

/*
*	Flights Routes
*/
$route['flights/search-flights'] = 'site/search';
$route['flights/search/(:any)'] = 'site/flights/$1';
$route['flights/airline/(:num)'] = 'site/flights/__/$1';
$route['flights/search'] = 'site/flights';
$route['flights/price-range/(:any)'] = 'site/flights/__/0/0/created/$1';
$route['flights/destination/(:num)'] = 'site/flights/__/0/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */