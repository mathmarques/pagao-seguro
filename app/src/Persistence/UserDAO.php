<?php
namespace App\Persistence;

use App\Model\User;
use Doctrine\ORM\EntityManager;

class UserDAO extends BaseDAO
{

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }

    /**
     * @param $id
     * @return User |null
     */
    public function getById($id)
    {
        try {
            $query = $this->db->createQuery("SELECT u FROM App\Model\User AS u WHERE u.id = :id");
            $query->setParameter('id', $id);
            $user = $query->getOneOrNullResult();
        } catch (\Exception $e) {
            $user = null;
        }

        return $user;
    }

    /**
     * @param $email
     * @param $password
     * @return User|null
     */
    public function getByEmailPass($email, $password)
    {
        try {
            $query = $this->db->createQuery("SELECT u FROM App\Model\User AS u WHERE u.email = :email AND u.password = :password");
            $query->setParameter('email', $email);
            $query->setParameter('password', $password);
            $user = $query->getOneOrNullResult();
        } catch (\Exception $e) {
            $user = null;
        }

        return $user;
    }

}
