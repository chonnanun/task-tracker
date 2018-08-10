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

$route['default_controller'] = "login";
$route['404_override'] = 'error';


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
// $route['dashboard'] = 'task/dashboard';
 $route['dashboard'] = 'task/taskListing';
 $route['task-tracker'] = 'task/taskListing';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";

$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

$route['tasks/report'] = "task/report/";
$route['tasks/report/monthly/(:num)/(:num)'] = "task/reportMonthly/$1/$2";
$route['tasks/report/(:any)/(:any)/(:any)/(:any)'] = "task/report/$1/$2/$3/$4";


$route['tasks'] = "task/taskListing";
$route['tasks/genJsons'] = "task/genJsons";
$route['tasks/(:num)'] = "task/taskListing/$1";
$route['tasks/(:any)/(:any)'] = "task/taskListing/$1/$2";
$route['taskListing'] = "task/taskListing";
$route['taskListing/(:num)'] = "task/taskListing/$1";
$route['addNewTask'] = "task/addNew";
$route['editTask'] = "task/editTask";
$route['tasks/edit/(:num)'] = "task/edit/$1";
$route['assignTask/(:num)/(:num)'] = "task/assignTask/$1/$2";

$route['tasks/view/(:num)'] = "task/view/$1";
$route['tasks/deleteTask'] = "task/deleteTask";



$route['nbapi/gethawb/(:any)'] = "netbay/netbayApi_getShipment/$1";
$route['npts/gethawb/(:any)'] = "npts/getShipmentFormNptsApi/$1";

$route['api/dashboard'] = "netbay/getDashboard/";
$route['api/dashboard/(:any)/(:any)/(:any)/(:any)/(:any)'] = "netbay/getDashboard/$1/$2/$3/$4/$5";


$route['test/tasks'] = "task/testTaskListing";
$route['tasks/(:num)'] = "task/taskListing/$1";
$route['tasks/(:any)/(:any)'] = "task/taskListing/$1/$2";





/* End of file routes.php */
/* Location: ./application/config/routes.php */