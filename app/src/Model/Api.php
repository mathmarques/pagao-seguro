<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * App\Model\Api
 *
 * @ORM\Entity()
 * @ORM\Table(name="api")
 */
class Api
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $publicHash;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $privateHash;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="apis")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="api")
     * @ORM\JoinColumn(name="id", referencedColumnName="api")
     */
    protected $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \App\Model\Api
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
     * Set the value of name.
     *
     * @param string $name
     * @return \App\Model\Api
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of nome.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPublicHash()
    {
        return $this->publicHash;
    }

    /**
     * @param mixed $publicHash
     * @return \App\Model\Api
     */
    public function setPublicHash($publicHash)
    {
        $this->publicHash = $publicHash;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrivateHash()
    {
        return $this->privateHash;
    }

    /**
     * @param mixed $privateHash
     * @return \App\Model\Api
     */
    public function setPrivateHash($privateHash)
    {
        $this->privateHash = $privateHash;

        return $this;
    }

    /**
     * Set User entity (many to one).
     *
     * @param \App\Model\User $user
     * @return \App\Model\Api
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get User entity (many to one).
     *
     * @return \App\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get Api entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

}