<?php
namespace App\Library;

use App\Model\Token;
use Interop\Container\ContainerInterface;
use Smarty_Internal_Template;

class TokenPlugin
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function tokenHash($params, Smarty_Internal_Template $template)
    {
        if (!isset($params['id'])) {
            throw new \Exception('Miss id Param tokenHash');
        }

        /** @var Security $security */
        $security = $this->container->get('security');

        return $security->encodeHashids($params['id']);
    }

}