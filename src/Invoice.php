<?php

namespace App;


use DateTime;

/**
 * Entidade que representa a fatura
 * Class Invoice
 * @package App
 */
class Invoice
{

    /**
     * ID auto gerado
     * @var
     */
    private $id;

    /**
     * Data de criação da fatura
     * @var
     */
    private $createdAt;


    /**
     * Valor da fatura.
     * @var
     */
    private $value;

    /**
     * Assinatura que gerou o invoice.
     * @var
     */
    private $subscription;

    /**
     * Invoice constructor.
     */
    public function __construct(Subscription $subscription)
    {
        $this->setId();

        $this->subscription = $subscription;
    }

    /**
     * @param mixed $id
     */
    private function setId()
    {
        $this->id = uniqid();
    }


    /**
     * Calcula valor da fatura com base em alguns requisitos:
     *  1. Caso o cliente cancele a assinatura dentro do periodo gratuito,
     *  o sistema deve gerar uma fatura com o valor de R$ 0,00
     * @param mixed $value
     */
    public function calculateValue()
    {
        echo 'Generating invoice ... Please, wait...';

        if($this->getSubscription()->isEvaluatePeriod())
            $this->value = 0.0;
        else
            $this->value = $this->calculateProportionalValue();

        echo sprintf("<br>Your invoice Nº %s is generated with value R$ %s <br>", $this->getId(), $this->getValue());
    }

    /**
     * Realiza calculo da fatura desconsiderando os dias de teste
     * e cobrando o valor proporcional aos dias de uso.
     */
    private function calculateProportionalValue()
    {
        $daysOfUse = $this->getDaysOfUse();

        $valueOfOneDay = $this->calculateOneDayValue();

        if ($daysOfUse > 0)
        {
            return $daysOfUse * $valueOfOneDay;
        }

        return $valueOfOneDay;
    }

    /**
     * Método auxiliar para ajudar a calcular um dia a partir do valor total.
     * @return float|int
     */
    private function calculateOneDayValue()
    {
        $daysInMonth = $this->getDaysMonth();

        return $this->getSubscription()->getSubscriptionType()->getValue() / $daysInMonth;
    }

    /**
     * Obtém a quantidade de dias em uso da assinatura.
     * @return bool|\DateInterval|int
     */
    private function getDaysOfUse()
    {
        $dateNow = new DateTime("now");

        $dateInterval = $dateNow->diff($this->getSubscription()->getCreatedAt());

        $daysOfUse = $dateInterval->days - $this->getSubscription()->getSubscriptionType()->getEvaluationPeriod();

        return $daysOfUse <= 0 ? 0 : $daysOfUse;
    }

    /**
     * Método auxiliar para obter os dias que 1 mês possui.
     * @return string
     */
    private function getDaysMonth()
    {
        $now = new DateTime("now");

        return $now->format("t");
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getSubscription()
    {
        return $this->subscription;
    }
}