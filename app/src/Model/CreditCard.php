<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * App\Model\CreditCard
 *
 * @ORM\Entity()
 * @ORM\Table(name="credit_card")
 */
class CreditCard
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="creditCards")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $card;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $valid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $secure;

    /**
     * @ORM\OneToMany(targetEntity="Token", mappedBy="creditCard")
     * @ORM\JoinColumn(name="id", referencedColumnName="creditCard")
     */
    protected $tokens;


    public function __construct()
    {
        $this->apis = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \App\Model\CreditCard
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
     * @return \App\Model\CreditCard
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
     * Set User entity (many to one).
     *
     * @param \App\Model\User $user
     * @return \App\Model\CreditCard
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
     * @return mixed
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param mixed $card
     * @return \App\Model\CreditCard
     */
    public function setCard($card)
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param mixed $valid
     * @return \App\Model\CreditCard
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * @param mixed $secure
     * @return \App\Model\CreditCard
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;

        return $this;
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