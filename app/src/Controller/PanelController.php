<?php

namespace App\Controller;

use App\Library\Security;
use App\Model\Api;
use App\Model\CreditCard;
use App\Model\Token;
use App\Model\User;
use App\Persistence\ApiDAO;
use App\Persistence\CreditCardDAO;
use App\Persistence\TokenDAO;
use App\Persistence\UserDAO;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Library\Exception\ValidationException;

class PanelController
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function creditCardAction(Request $request, Response $response, $args)
    {
        $creditCardDAO = new CreditCardDAO($this->container->get('db'));

        if ($request->isPost()) {
            try {
                if(empty($request->getParsedBodyParam('name')) || empty($request->getParsedBodyParam('card')) ||
                    empty($request->getParsedBodyParam('valid')) || empty($request->getParsedBodyParam('secure')))
                    throw new ValidationException('Preencha todos os campos');

                /** @var Security $security */
                $security = $this->container->get('security');

                $creditCard = new CreditCard();
                $creditCard->setUser($request->getAttribute('user'));
                $creditCard->setName($request->getParsedBodyParam('name'));
                $creditCard->setCard($security->encryptBase64($request->getParsedBodyParam('card')));
                $creditCard->setValid($request->getParsedBodyParam('valid'));
                $creditCard->setSecure($security->encryptBase64($request->getParsedBodyParam('secure')));

                $creditCardDAO->save($creditCard);
            } catch (ValidationException $v) {
                $this->container->get('view')['error'] = $v->getMessage();
            }
        }

        $this->container->get('view')['creditCardList'] = $creditCardDAO->getAllByUser($request->getAttribute('user'));

        return $this->container->get('view')->render($response, 'creditcard.tpl');
    }

    public function apisAction(Request $request, Response $response, $args)
    {
        $apiDAO = new ApiDAO($this->container->get('db'));

        if ($request->isPost()) {
            try {
                if(empty($request->getParsedBodyParam('name')))
                    throw new ValidationException('Preencha todos os campos');

                /** @var Security $security */
                $security = $this->container->get('security');

                $api = new Api();
                $api->setUser($request->getAttribute('user'));
                $api->setName($request->getParsedBodyParam('name'));
                $api->setPrivateHash($security->generateRandomHash());
                $api->setPublicHash($security->generateRandomHash());

                $apiDAO->save($api);
            } catch (ValidationException $v) {
                $this->container->get('view')['error'] = $v->getMessage();
            }
        }

        $this->container->get('view')['apisList'] = $apiDAO->getAllByUser($request->getAttribute('user'));

        return $this->container->get('view')->render($response, 'apis.tpl');
    }

    public function tokenAction(Request $request, Response $response, $args)
    {
        $tokenDAO = new TokenDAO($this->container->get('db'));
        $creditCardDAO = new CreditCardDAO($this->container->get('db'));

        if ($request->isPost()) {
            try {
                $card = $creditCardDAO->getByUserAndId($request->getAttribute('user'), $request->getParsedBodyParam('creditCard'));

                $token = new Token();
                $token->setUser($request->getAttribute('user'));
                $token->setCreditCard($card);
                $token->setLimite(intval($request->getParsedBodyParam('limit')));
                $token->setExpires(strtotime("+30 minutes"));

                $tokenDAO->save($token);
            } catch (\Exception $e) {
                $this->container->get('view')['error'] = $e->getMessage();
            }
        }

        $this->container->get('view')['creditCardList'] = $creditCardDAO->getAllByUser($request->getAttribute('user'));
        $this->container->get('view')['tokenList'] = $tokenDAO->getAllByUser($request->getAttribute('user'));

        return $this->container->get('view')->render($response, 'token.tpl');
    }
}