<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * App\Model\Transaction
 *
 * @ORM\Entity()
 * @ORM\Table(name="transaction")
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Api", inversedBy="transactions")
     * @ORM\JoinColumn(name="api", referencedColumnName="id")
     */
    protected $api;

    /**
     * @ORM\OneToOne(targetEntity="Token", inversedBy="transaction")
     * @ORM\JoinColumn(name="token", referencedColumnName="id")
     */
    protected $token;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $value;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $date;


    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \App\Model\Transaction
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return \App\Model\Transaction
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return \App\Model\Transaction
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Set Api entity (many to one).
     *
     * @param \App\Model\Api $api
     * @return \App\Model\Transaction
     */
    public function setApi(Api $api)
    {
        $this->api = $api;

        return $this;
    }

    /**
     * Get Api entity (many to one).
     *
     * @return \App\Model\Api
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Set Token entity (one to one).
     *
     * @param \App\Model\Token $token
     * @return \App\Model\Transaction
     */
    public function setToken(Token $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get Token entity (one to one).
     *
     * @return \App\Model\Token
     */
    public function getToken()
    {
        return $this->token;
    }

}