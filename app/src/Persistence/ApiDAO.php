<?php
namespace App\Persistence;

use App\Model\Api;
use Doctrine\ORM\EntityManager;

class ApiDAO extends BaseDAO
{

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }

    /**
     * @param $user
     * @return Api[] |null
     */
    public function getAllByUser($user)
    {
        try {
            $query = $this->db->createQuery("SELECT a FROM App\Model\Api AS a WHERE a.user = :user");
            $query->setParameter('user', $user);
            $api = $query->getResult();
        } catch (\Exception $e) {
            $api = null;
        }

        return $api;
    }

    /**
     * @param $publicHash
     * @return Api |null
     */
    public function getByPublicHash($publicHash)
    {
        try {
            $query = $this->db->createQuery("SELECT a FROM App\Model\Api AS a WHERE a.publicHash = :publicHash");
            $query->setParameter('publicHash', $publicHash);
            $api = $query->getOneOrNullResult();
        } catch (\Exception $e) {
            $api = null;
        }

        return $api;
    }

}
