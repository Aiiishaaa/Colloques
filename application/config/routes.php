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


// routes par défaut
$route['default_controller'] = 'maincontroller';
$route['404_override'] = '';
$config['index_page'] = '';
$route['translate_uri_dashes'] = FALSE;

// routes vers des pages statiques (sans paramètres dans la requete)
$route['index'] = 'maincontroller/index'; // deux moyens d'accéder à l'index
$route['home'] = 'maincontroller/index';
$route['mentionslegales'] = 'maincontroller/mentionslegales';
$route['contact'] = 'maincontroller/contact';


// routes pour chaque type de données, avec paramètre dans l'url
$route['thematique/(:any)'] = 'maincontroller/thematique/$1';
$route['ressource/(:any)'] = 'maincontroller/ressource/$1';
$route['intervenant/(:any)'] = 'maincontroller/intervenant/$1';
$route['conference/(:any)'] = 'maincontroller/conference/$1';

// résultats de la recherche
$route['rechercher'] = 'maincontroller/search';

// route de test, pour tester quelque chose en dehors d'une vraie page
//$route['test'] = 'maincontroller/test'; // disparaitra en prod
