<?php
namespace App\Persistence;

use App\Library\Exception\PersistException;

abstract class BaseDAO
{

    protected $db;

    public function save($object)
    {
        try {
            $this->db->persist($object);
            $this->db->flush();
        } catch (\Exception $exception) {
            throw new PersistException($exception->getMessage());
        }
    }

    public function delete($object)
    {
        try {
            $this->db->remove($object);
            $this->db->flush();
        } catch (\Exception $exception) {
            throw new PersistException($exception->getMessage());
        }
    }
}
