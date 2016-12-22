<?php

//$app->add(\Psr7Middlewares\Middleware::Https());

// Routes

$app->map(['GET', 'POST'],'/login', '\App\Controller\UserController:loginAction')->setName('login');
$app->map(['GET', 'POST'],'/register', '\App\Controller\UserController:registerAction')->setName('register');

$app->group('', function () {

    $this->get('/', '\App\Controller\HomeController:indexAction')->setName('home');
    $this->get('/logout', '\App\Controller\UserController:logoutAction')->setName('logout');

    $this->map(['GET', 'POST'], '/panel/credit_card', '\App\Controller\PanelController:creditCardAction')->setName('credit_card');
    $this->map(['GET', 'POST'], '/panel/apis', '\App\Controller\PanelController:apisAction')->setName('apis');
    $this->map(['GET', 'POST'], '/panel/token', '\App\Controller\PanelController:tokenAction')->setName('token');

})->add('\App\Middleware\AuthMiddleware');

$app->group('/api', function () {

    $this->post('/transaction', '\App\Controller\ApiController:transactionAction')->setName('transaction');

})->add('\App\Middleware\ApiAuthMiddleware');

