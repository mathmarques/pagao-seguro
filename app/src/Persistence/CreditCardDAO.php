<?php
namespace App\Persistence;

use App\Model\CreditCard;
use App\Model\User;
use Doctrine\ORM\EntityManager;

class CreditCardDAO extends BaseDAO
{

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }

    /**
     * @param $user
     * @return CreditCard[] |null
     */
    public function getAllByUser($user)
    {
        try {
            $query = $this->db->createQuery("SELECT cc FROM App\Model\CreditCard AS cc WHERE cc.user = :user");
            $query->setParameter('user', $user);
            $creditCards = $query->getResult();
        } catch (\Exception $e) {
            $creditCards = null;
        }

        return $creditCards;
    }

    /**
     * @param $user
     * @param $id
     * @return CreditCard | null
     */
    public function getByUserAndId($user, $id)
    {
        try {
            $query = $this->db->createQuery("SELECT cc FROM App\Model\CreditCard AS cc WHERE cc.user = :user AND cc.id = :id");
            $query->setParameter('user', $user);
            $query->setParameter('id', $id);
            $creditCard = $query->getOneOrNullResult();
        } catch (\Exception $e) {
            $creditCard = null;
        }

        return $creditCard;
    }

}
