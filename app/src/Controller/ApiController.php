<?php

namespace App\Controller;

use App\Library\Security;
use App\Model\Token;
use App\Model\Transaction;
use App\Persistence\TokenDAO;
use App\Persistence\TransactionDAO;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ApiController
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function transactionAction(Request $request, Response $response, $args)
    {
        $tokenDAO = new TokenDAO($this->container->get('db'));

        if(empty($request->getParsedBodyParam('value')) || ($value = intval($request->getParsedBodyParam('value'))) == 0)
            return $response->withJson(['error' => 'Valor inválido']);

        /** @var Security $security */
        $security = $this->container->get('security');

        $tokenId = $security->decodeHashids($request->getParsedBodyParam('token'));
        if(empty($tokenId) || ($token = $tokenDAO->getById($tokenId)) == null)
            return $response->withJson(['error' => 'Token inválido']);

        if($token->getStatus() != Token::AWAITING)
            return $response->withJson(['error' => 'Token Expirado ou Utilizado', 'status' => $token->getStatus()]);

        if($token->getLimite() > 0 && $value > $token->getLimite())
            return $response->withJson(['error' => 'Valor maior do que o limite', 'limit' => $token->getLimite()]);

        $transactionDAO = new TransactionDAO($this->container->get('db'));

        $transaction = new Transaction();
        $transaction->setApi($request->getAttribute('api'));
        $transaction->setToken($token);
        $transaction->setValue($value);
        $transaction->setDate(time());

        $transactionDAO->save($transaction);

        return $response->withJson(['status' => 'success', 'cardInfo' => [
            'cardName' => $token->getCreditCard()->getName(),
            'cardNumber' => $security->decryptBase64($token->getCreditCard()->getCard()),
            'cardSecurity' => $security->decryptBase64($token->getCreditCard()->getSecure()),
            'cardValidUntil' => $token->getCreditCard()->getValid()
        ]]);
    }


}