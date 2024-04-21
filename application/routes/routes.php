<?php
use Http\Controllers\HomeController;
use Http\Controllers\ItemController;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use Helpers\HttpHelpers;
use Laminas\Diactoros\ServerRequest;

$router = Router::create();

//item
$router->get('/item', [ItemController::class, 'findAll']);
$router->get('/item/{id}', function($id){
    $controller = new ItemController();
    return $controller->find($id);
});
$router->post('/item', function (ServerRequest $r){
    $controller = new ItemController(); 
    return $controller->create(HttpHelpers::getBodyFromRequest($r));
});
$router->patch('/item/{id}', function ($id, ServerRequest $r){
    $controller = new ItemController(); 
    return $controller->update($id, HttpHelpers::getBodyFromRequest($r));
});
$router->delete('/item/{id}', function ($id){
    $controller = new ItemController(); 
    return $controller->delete($id);
});

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    echo(HttpHelpers::generalJsonResponse(404, 'error', 'Resource not found'));
} catch (Throwable $e) {
    echo(HttpHelpers::generalJsonResponse(500, 'error', $e->getMessage() . " line ". $e->getLine() . " of file: " . $e->getFile() ));
}
