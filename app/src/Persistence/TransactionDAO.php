<?php
namespace App\Persistence;

use App\Model\Api;
use Doctrine\ORM\EntityManager;

class TransactionDAO extends BaseDAO
{

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }

}
