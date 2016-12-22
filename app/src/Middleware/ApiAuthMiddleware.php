<?php

namespace App\Middleware;

use App\Library\Security;
use App\Persistence\ApiDAO;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ApiAuthMiddleware
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke( Request $request, Response $response, callable $next) {

        $apiDAO = new ApiDAO($this->container->get('db'));

        if(empty($request->getHeader('X-API-Public')) || ($api = $apiDAO->getByPublicHash($request->getHeader('X-API-Public')[0])) == null )
            return $response->withJson(['error' => 'Unknown Public'], 401);

        /** @var Security $security */
        $security = $this->container->get('security');

        if(empty($request->getHeader('X-API-Hash')) ||  $security->doHash($request->getBody(), $api->getPrivateHash()) != $request->getHeader('X-API-Hash')[0])
            return $response->withJson(['error' => 'Invalid Hash'], 401);

        $newRequest = $request->withAttribute('api', $api);

        return $next($newRequest, $response);
    }
}