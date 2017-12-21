<?php

namespace App;

/**
 * Tipo de Inscrição Anual
 * Class SubscriptionTypeYearly
 * @package App\Models
 */
class SubscriptionTypeYearly extends SubscriptionType
{

    public function __construct()
    {
        $this->setEvaluationPeriod(self::FIFTEEN_DAYS);

        $this->setType(self::TYPE_YEARLY);

        $this->setValue(1.70*12);
    }

    /**
     * Notifica algum endereço de e-mail sobre cupom de oferta.
     * @param $to
     * @param $message
     */
    public function sendCouponOfferMail($to)
    {
        $message = sprintf("Congratulations! Your receive the discount coupon [ %s ] of 20%% to anual subscription renovation.", uniqid());

        $this->sendMail($to, $message);
    }
}