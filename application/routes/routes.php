<?php
use Http\Controllers\HomeController;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use Helpers\HttpHelpers;

$router = Router::create();

$router->get('/', [HomeController::class, 'home']);

$router->get('/{id}', function ($id) {
    echo ("Rota dinâmica " . $id);
});

$router->post('/testePost', function () {
    echo ('post!');
});

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    echo(HttpHelpers::generalJsonResponse(404, 'error', 'Resource not found'));
} catch (Throwable $e) {
    echo(HttpHelpers::generalJsonResponse(500, 'error', $e->getMessage() . " line ". $e->getLine() . " of file: " . $e->getFile() ));
}
