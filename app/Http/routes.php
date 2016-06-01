<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$detect = new Mobile_Detect;

$app->get('/', function () use ($app) {
	
    //Get route prefix based on env and pass it to frontend
    $env = getenv('APP_ENV');
    $route_prefix = $env == "development" ? 'df/' : '';   
    return view('index', ['route_prefix' => $route_prefix]);
});

$app->post('/', function () use ($app) {

    //Get route prefix based on env and pass it to frontend
    $env = getenv('APP_ENV');
    $route_prefix = $env == "development" ? 'df/' : '';   
    return view('index', ['route_prefix' => $route_prefix]);
});


$app->get('/bo', function () use ($app) {    
    $env = getenv('APP_ENV');
    $route_prefix = $env == "development" ? 'df/' : '';   
    return view('bo', ['route_prefix' => $route_prefix]);
});


$app->group(['namespace' => 'App\Http\Controllers'], function($group){       
    $group->GET('/api/faqs', 'FAQController@getAllFaq');      
    $group->GET('/api/faq/{id}', 'FAQController@getFaq');
    $group->GET('/api/faqByCat/{cat_id}', 'FAQController@getFaqByCategory');
    $group->GET('/api/faqArchived', 'FAQController@getFaqArchived');
    
    $group->POST('/api/login', 'FAQController@login');     
});

$app->group(['namespace' => 'App\Http\Controllers', 'middleware' => 'jwt'], function($group){         
    $group->POST('/api/updateFaq', 'FAQController@updateFaq');
    //$group->POST('/api/deleteFaq', 'FAQController@deleteStoreData');
    $group->POST('/api/saveFaq', 'FAQController@saveFaq');    
});


