<?php

namespace App\Controller;

use App\Model\User;
use App\Persistence\UserDAO;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Library\Exception\ValidationException;

class UserController
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function loginAction(Request $request, Response $response, $args)
    {

        if ($request->isPost()) {
            $userDAO = new UserDAO($this->container->get('db'));
            $user = $userDAO->getByEmailPass($request->getParsedBodyParam('email'),
                sha1($request->getParsedBodyParam('password')));
            if ($user) {
                $_SESSION['id'] = $user->getId();

                return $response->withRedirect($this->container->get('router')->pathFor('home'));
            } else {
                $this->container->get('view')['error'] = 'Login e/ou senha inválidos!';
            }
        }

        return $this->container->get('view')->render($response, 'user_login.tpl');
    }

    public function logoutAction(Request $request, Response $response, $args)
    {
        unset($_SESSION['id']);

        return $response->withRedirect($this->container->get('router')->pathFor('home'));
    }

    public function registerAction(Request $request, Response $response, $args)
    {
        if ($request->isPost()) {
            $newUser = null;
            try {
                $newUser = new User();
                $newUser->setName($request->getParsedBodyParam('name'));
                $newUser->setEmail($request->getParsedBodyParam('email'));
                $newUser->setPassword(sha1($request->getParsedBodyParam('password')));

                if(empty($newUser->getName()) || empty($newUser->getEmail()) || empty($newUser->getEmail()))
                    throw new ValidationException('Preencha todos os campos');

                $userDAO = new UserDAO($this->container->get('db'));
                $userDAO->save($newUser);

                $this->container->get('view')['sucess'] = true;
            } catch (ValidationException $v) {
                $this->container->get('view')['newUser'] = $newUser;
                $this->container->get('view')['error'] = $v->getMessage();
            }
        }

        return $this->container->get('view')->render($response, 'user_register.tpl');
    }

}