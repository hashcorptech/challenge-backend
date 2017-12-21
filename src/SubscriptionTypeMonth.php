<?php

namespace App;

use DateTime;

/**
 * Tipo de inscrição Mensal
 * Class SubscriptionTypeMonth
 * @package App\Models
 */
class SubscriptionTypeMonth extends SubscriptionType
{

    public function __construct()
    {
        $this->setEvaluationPeriod(self::FIVE_DAYS);

        $this->setType(self::TYPE_MONTH);

        $this->setValue(1.99);
    }

    /**
     * Notifica algum endereço de e-mail sobre cupom de oferta.
     * @param $to
     * @param $message
     */
    public function sendCouponOfferMail($to)
    {
        $message = sprintf("Congratulations! Your receive the discount coupon [ %s ] of 5%% to Semester subscription.", uniqid());

        $this->sendMail($to, $message);
    }
}