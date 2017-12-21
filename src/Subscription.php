<?php

namespace App;

use DateTime;

use Exception;

/**
 * Entidade que representa a assinatura
 * Class Subscription
 * @package App\Models
 */
class Subscription
{

    /**
     * ID auto gerado e unico para cada inscrição.
     * @var
     */
    private $id;

    /**
     * Data de criação da Inscrição
     * @var
     */
    private $createdAt;

    /**
     * Tipo da assinatura
     * @var
     */
    private $subscriptionType;

    /**
     * Usuário dono da Assinatura
     * @var
     */
    private $user;

    /**
     * Flag para validar se Assinatura está ativa.
     * @var bool
     */
    private $isActive = false;

    /**
     * Subscription constructor.
     * @param $subscriptionType
     * @param $user
     */
    public function __construct(SubscriptionType $subscriptionType, User $user)
    {
        $this->setId();
        $this->subscriptionType = $subscriptionType;
        $this->user = $user;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Atribui um valor ao campo ID.
     * @param mixed $id
     */
    private function setId()
    {
        $this->id = sha1(uniqid());
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    private function setCreatedAt()
    {
        $dateNow = new DateTime("now");
        $this->createdAt = $dateNow;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionType()
    {
        return $this->subscriptionType;
    }

    /**
     * @param mixed $subscriptionType
     */
    public function setSubscriptionType($subscriptionType)
    {
        $this->throwExceptionIfSubscriptionTypeIsInvalid($subscriptionType);

        $this->subscriptionType = $subscriptionType;
    }

    /**
     * Método auxiliar para checar se o tipo de inscrição é uma instância válida.
     * @param $subscriptionType
     */
    private function throwExceptionIfSubscriptionTypeIsInvalid($subscriptionType)
    {
        if(! $subscriptionType instanceof SubscriptionType)
            throw new Exception("The subscription type is invalid");
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->throwExceptionIfUserIsInvalid($user);

        $this->user = $user;
    }

    /**
     * Método auxiliar para checar se o usuário é valido.
     * @param $subscriptionType
     */
    private function throwExceptionIfUserIsInvalid($user)
    {
        if(! $user instanceof User)
            throw new Exception("The user is invalid");
    }

    /**
     * Seta a assinatura como ativa.
     * @return bool
     */
    private function activeSubscription()
    {
        $this->isActive = true;

        echo 'Subscription is active!' . '<br>';
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * Realiza fluxo de contratação da assinatura
     */
    public function hire()
    {
        $this->setCreatedAt();

        if($this->sendPayment())
        {
            $this->activeSubscription();

            $this->getSubscriptionType()->sendCouponOfferMail($this->getUser()->getEmail());

            return true;
        }

        return false;
    }

    /**
     * Envia pagamento para Gateway.
     */
    private function sendPayment()
    {
        echo 'Starting payment...Wait one moment...' .'<br>';
        echo 'Succesfully payment!';
        echo '<br>';
        return true; //for tests purposes
    }

    /**
     * Realiza fluxo de cancelamento da assinatura.
     */
    public function revoke()
    {
        $invoice = new Invoice($this);

        $invoice->calculateValue();

        return true;
    }

    /**
     * Realiza verificação se a assinatura está no período de teste.
     * @return bool
     */
    public function isEvaluatePeriod()
    {
        $dateNow = new Datetime("now");

        $dateInterval = $dateNow->diff($this->getCreatedAt());

        return $dateInterval->days <= $this->getSubscriptionType()->getEvaluationPeriod();
    }
}