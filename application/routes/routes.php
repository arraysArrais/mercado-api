<?php
use Http\Controllers\ItemController;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use Helpers\HttpHelpers;

$router = Router::create();

//item
$router->post('/item', [ItemController::class, 'create']);
$router->get('/item', [ItemController::class, 'findAll']);
$router->get('/item/{id}', [ItemController::class, 'find']);
$router->patch('/item/{id}', [ItemController::class, 'update']);
$router->delete('/item/{id}', [ItemController::class, 'delete']);

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    echo(HttpHelpers::generalJsonResponse(404, 'error', 'Resource not found'));
} catch (Throwable $e) {
    echo(HttpHelpers::generalJsonResponse(500, 'error', $e->getMessage() . " line ". $e->getLine() . " of file: " . $e->getFile() ));
}
