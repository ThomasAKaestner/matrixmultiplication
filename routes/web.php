<?php
use Illuminate\Http\Request;
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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/matrixmulti',"MatrixMultiController@get");
$router->post("/matrixmulti",["middleware"=> "auth","uses"=> "MatrixMultiController@post"]);
$router->post("/matrixmulti/test",["middleware"=> "auth","uses"=> "MatrixMultiController@test"]);
