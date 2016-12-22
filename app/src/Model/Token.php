<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * App\Model\Token
 *
 * @ORM\Entity()
 * @ORM\Table(name="token")
 */
class Token
{
    const AWAITING = 0;

    const USED = 1;

    const EXPIRED = 2;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tokens")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $expires;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $limite;

    /**
     * @ORM\ManyToOne(targetEntity="CreditCard", inversedBy="tokens")
     * @ORM\JoinColumn(name="creditCard", referencedColumnName="id")
     */
    protected $creditCard;

    /**
     * @ORM\OneToOne(targetEntity="Transaction", mappedBy="token")
     */
    protected $transaction;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \App\Model\Token
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
     * Set User entity (many to one).
     *
     * @param \App\Model\User $user
     * @return \App\Model\Token
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
     * @return integer
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param integer $expires
     * @return \App\Model\Token
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLimite()
    {
        return $this->limite;
    }

    /**
     * @param integer $limite
     * @return \App\Model\Token
     */
    public function setLimite($limite)
    {
        $this->limite = $limite;

        return $this;
    }

    /**
     * Set CreditCard entity (many to one).
     *
     * @param \App\Model\CreditCard $creditCard
     * @return \App\Model\Token
     */
    public function setCreditCard(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;

        return $this;
    }

    /**
     * Get CreditCard entity (many to one).
     *
     * @return \App\Model\CreditCard
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * Set Transaction entity (one to one).
     *
     * @param \App\Model\Transaction $transaction
     * @return \App\Model\Token
     */
    public function setTransaction(Transaction $transaction)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get Transaction entity (one to one).
     *
     * @return \App\Model\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    public function getStatus()
    {
        $status = Token::AWAITING;

        if($this->getTransaction() != null)
            $status = Token::USED;
        else if($this->getExpires() < time())
            $status = Token::EXPIRED;

        return $status;
    }

    public function getStatusClass()
    {
        switch ($this->getStatus()) {
            case Token::USED:
                $status = 'success';
                break;
            case Token::EXPIRED:
                $status = 'danger';
                break;

            default:
                $status = 'active';
        }

        return $status;
    }

    public function getStatusMessage()
    {
        switch ($this->getStatus()) {
            case Token::USED:
                $status = 'Utilizado em: '.$this->getTransaction()->getApi()->getName() . ' no valor de R$'.$this->getTransaction()->getValue();
                break;
            case Token::EXPIRED:
                $status = 'Expirado';
                break;

            default:
                $status = 'Aguardando Utilização';
        }

        return $status;
    }

}