<?php
use Http\Controllers\ItemController;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use Helpers\HttpHelpers;
use Http\Controllers\CategoryController;

$router = Router::create();


$router->post('/item', [ItemController::class, 'create']);
$router->get('/item', [ItemController::class, 'findAll']);
$router->get('/item/{id}', [ItemController::class, 'find']);
$router->patch('/item/{id}', [ItemController::class, 'update']);
$router->delete('/item/{id}', [ItemController::class, 'delete']);

$router->post('/category', [CategoryController::class, 'create']);
$router->get('/category', [CategoryController::class, 'findAll']);
$router->get('/category/{id}', [CategoryController::class, 'find']);
$router->patch('/category/{id}', [CategoryController::class, 'update']);
$router->delete('/category/{id}', [CategoryController::class, 'delete']);


try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    echo(HttpHelpers::generalJsonResponse(404, 'error', 'Resource not found'));
} catch (Throwable $e) {
    echo(HttpHelpers::generalJsonResponse(500, 'error', $e->getMessage() . " line ". $e->getLine() . " of file: " . $e->getFile() ));
}
