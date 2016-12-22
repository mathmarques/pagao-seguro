<?php
namespace App\Persistence;

use App\Model\Token;
use Doctrine\ORM\EntityManager;

class TokenDAO extends BaseDAO
{

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }

    /**
     * @param $user
     * @return Token[] |null
     */
    public function getAllByUser($user)
    {
        try {
            $query = $this->db->createQuery("SELECT t, cc, tr, tra FROM App\Model\Token AS t JOIN t.creditCard AS cc LEFT JOIN t.transaction AS tr LEFT JOIN tr.api AS tra WHERE t.user = :user ORDER BY t.expires DESC");
            $query->setParameter('user', $user);
            $tokens = $query->getResult();
        } catch (\Exception $e) {
            $tokens = null;
        }

        return $tokens;
    }

    /**
     * @param $id
     * @return Token |null
     */
    public function getById($id)
    {
        try {
            $query = $this->db->createQuery("SELECT t, cc, tr, tra FROM App\Model\Token AS t JOIN t.creditCard AS cc LEFT JOIN t.transaction AS tr LEFT JOIN tr.api AS tra WHERE t.id = :id");
            $query->setParameter('id', $id);
            $token = $query->getOneOrNullResult();
        } catch (\Exception $e) {
            $token = null;
        }

        return $token;
    }

}
