<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * App\Model\User
 *
 * @ORM\Entity()
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="email_UNIQUE", columns={"email"})})
 */
class User
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
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;

    /**
     * @ORM\OneToMany(targetEntity="Api", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="user")
     */
    protected $apis;

    /**
     * @ORM\OneToMany(targetEntity="CreditCard", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="user")
     */
    protected $creditCards;

    /**
     * @ORM\OneToMany(targetEntity="Token", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="user")
     */
    protected $tokens;

    public function __construct()
    {
        $this->apis = new ArrayCollection();
        $this->creditCards = new ArrayCollection();
        $this->tokens = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \App\Model\User
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
     * @return \App\Model\User
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
     * Set the value of email.
     *
     * @param string $email
     * @return \App\Model\User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of password.
     *
     * @param string $password
     * @return \App\Model\User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add Api entity to collection (one to many).
     *
     * @param \App\Model\Api $api
     * @return \App\Model\User
     */
    public function addApi(Api $api)
    {
        $this->apis[] = $api;

        return $this;
    }

    /**
     * Remove Api entity from collection (one to many).
     *
     * @param \App\Model\Api $api
     * @return \App\Model\User
     */
    public function removeApi(Api $api)
    {
        $this->apis->removeElement($api);

        return $this;
    }

    /**
     * Get Api entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApis()
    {
        return $this->apis;
    }

    /**
     * Get Api entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreditCards()
    {
        return $this->creditCards;
    }

    /**
     * Get Api entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTokens()
    {
        return $this->tokens;
    }
}