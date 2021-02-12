<?php

use core\Router;
use core\Application;
use app\controllers\defaultController;

/*
|--------------------------------------------------------------------------
|Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the public/index.php file
|--------------------------------------------------------------------------
*/
Router::get('/', 'welcome');
//Router::get('/test','home',['name'=>'Joe Biden']);
//Router::get('/contact', function(){
//    $content = Application::$app->view->fetch('partialviews/contact');
//    Application::$app->view->display('layouts/main', [
//        'content' => $content,
//        'title' => 'Oefeningen',
//        'subTitle' => 'professioneel Webdesign in een MVC structuur',
//        'bigTitle' => 'PHP en MySql',
//        ]);
//});
//Router::get('/', [defaultController::class, 'home']);
